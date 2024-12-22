<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/weapon.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';

header('Content-Type: application/json');

// Vérification de la méthode HTTP
if (!methodIsAllowed('delete')) {
    returnError(405, 'Method not allowed');
    return;
}

 if (isset($_GET['id'])) {
    $weaponId = $_GET['id'];
    
     $deleted = deleteWeaponAndUpdateVikings($weaponId); 

    if ($deleted === true) {
         http_response_code(204);  
    } elseif ($deleted === false) {
         returnError(500, 'Could not delete the weapon or update vikings');  
    } else {
         returnError(404, 'Weapon not found');  
    }
} else {
     returnError(400, 'Missing parameter: id');  
}
?>
