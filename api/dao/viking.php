<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/database.php';

function findOneViking(string $id) {
    $db = getDatabaseConnection();
    $sql = "SELECT v.id, v.name, v.health, v.attack, v.defense, v.weaponId
            FROM viking v
            LEFT JOIN Weapon w ON v.weaponId = w.id
            WHERE v.id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id]);

    if ($res) {
        $viking = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Si le viking a une arme, ajouter un lien HATEOAS
        if ($viking['weaponId'] !== null) {
            $viking['weapon'] = "/api/weapon/findOne.php?id=" . $viking['weaponId'];
        } else {
            $viking['weapon'] = "";
        }

        return [
            "id" => $viking['id'],
            "name" => $viking['name'],
            "health" => $viking['health'],
            "attack" => $viking['attack'],
            "defense" => $viking['defense'],
            "weapon" => $viking['weapon']
        ];
    }
    
    return null;
}


function findAllVikings(string $name = "", int $limit = 10, int $offset = 0) {
    $db = getDatabaseConnection();
    $params = [];
    $sql = "SELECT v.id, v.name, v.health, v.attack, v.defense, v.weaponId
            FROM viking v";

    if ($name) {
        $sql .= " WHERE v.name LIKE :name";
        $params['name'] = "%" . $name . "%";
    }

    $sql .= " LIMIT $limit OFFSET $offset ";

    $stmt = $db->prepare($sql);
    $res = $stmt->execute($params);

    if ($res) {
        $vikings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];

        // Pour chaque viking, ajouter le lien vers l'arme si elle existe
        foreach ($vikings as $viking) {
            $vikingData = [
                "id" => $viking['id'],
                "name" => $viking['name'],
                "health" => $viking['health'],
                "attack" => $viking['attack'],
                "defense" => $viking['defense'],
                "weapon" => $viking['weaponId'] !== null ? "api/weapon/findOne.php?id=" . $viking['weaponId'] : ""
            ];
            $result[] = $vikingData;
        }

        return $result;
    }

    return null;
}


function createViking(string $name, int $health, int $attack, int $defense, int $weaponId) {
    $db = getDatabaseConnection();

     if ($weaponId !== null) {
        $sql = "SELECT id FROM Weapon WHERE id = :weaponId";
        $stmt = $db->prepare($sql);
        $stmt->execute(['weaponId' => $weaponId]);
        $weapon = $stmt->fetch(PDO::FETCH_ASSOC);

         if (!$weapon) {
            returnError(400, "Weapon with ID $weaponId does not exist. Viking cannot be created.");
            return;
        }
    }

     $sql = "INSERT INTO viking (name, health, attack, defense, weaponId) VALUES (:name, :health, :attack, :defense, :weaponId)";
    $stmt = $db->prepare($sql);
    
     $res = $stmt->execute([
        'name' => $name,
        'health' => $health,
        'attack' => $attack,
        'defense' => $defense,
        'weaponId' => $weaponId ?? null
    ]);

    if ($res) {
        return $db->lastInsertId();  
    }

     returnError(500, "Could not create the viking.");
}


function updateViking(int $id, string $name, int $health, int $attack, int $defense, int $weaponId) {
    $db = getDatabaseConnection();

     $sql = "SELECT id FROM viking WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id' => $id]);
    $viking = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$viking) {
        returnError(404, "Viking with ID $id not found.");
    }

     if ($weaponId !== null) {
        $sql = "SELECT id FROM Weapon WHERE id = :weaponId";
        $stmt = $db->prepare($sql);
        $stmt->execute(['weaponId' => $weaponId]);
        $weapon = $stmt->fetch(PDO::FETCH_ASSOC);

         if (!$weapon) {
            $weaponId = null; // Désassocier l'arme
        }
    }

    // Mise à jour du viking
    $sql = "UPDATE viking SET name = :name, health = :health, attack = :attack, defense = :defense, weaponId = :weaponId WHERE id = :id";
    $stmt = $db->prepare($sql);

    $res = $stmt->execute([
        'name' => $name,
        'health' => $health,
        'attack' => $attack,
        'defense' => $defense,
        'weaponId' => $weaponId ?? null, 
        'id' => $id
    ]);

    if ($res) {
        return $stmt->rowCount(); // Mise à jour réussie, pas de contenu à retourner
    }

    returnError(500, "Could not update the viking.");
}


function deleteViking(string $id) {
    $db = getDatabaseConnection();
    $sql = "DELETE FROM viking WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id]);
    if ($res) {
        return $stmt->rowCount();
    }
    return null;
}

 
function addWeaponToViking(int $vikingId, int $weaponId) {
    $db = getDatabaseConnection();
    $sql = "UPDATE viking SET weaponId = :weaponId WHERE id = :vikingId";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['vikingId' => $vikingId, 'weaponId' => $weaponId]);
    if ($res) {
        return $stmt->rowCount(); 
    }
    return null;
}

function findVikingsByWeapon(int $weaponId) {
    $db = getDatabaseConnection();

     $sql = "SELECT id, name FROM viking WHERE weaponId = :weaponId";
    $stmt = $db->prepare($sql);
    $stmt->execute(['weaponId' => $weaponId]);

     return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
