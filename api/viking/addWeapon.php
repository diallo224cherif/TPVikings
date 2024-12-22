<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/weapon.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/weapon.php';
header('Content-Type: application/json');

 if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
    returnError(405, 'Method not allowed');
    return;
}

 if (!isset($_GET['id'])) {
    returnError(400, 'Missing parameter: id');
}

$vikingId = intval($_GET['id']);

 $data = getBody();

 if (!isset($data['weaponId'])) {
    returnError(400, 'Missing parameter: weaponId');
}

$weaponId = $data['weaponId'];

// Vérification si l'arme existe dans la base de données
$weapon = findOneWeapon($weaponId);
if (!$weapon) {
    returnError(404, 'Weapon not found');
}

// Association de l'arme au viking
$updated = addWeaponToViking($vikingId, $weaponId);
if ($updated === 1) {
    http_response_code(200);
    echo json_encode(['message' => 'Weapon successfully added to Viking']);
} elseif ($updated === 0) {
    returnError(404, 'Viking not found');
} else {
    returnError(500, 'Could not add the weapon to the viking');
}

