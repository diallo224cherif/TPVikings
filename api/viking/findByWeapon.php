<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';

header('Content-Type: application/json');

 if (!methodIsAllowed('read')) {
    returnError(405, 'Method not allowed');
    return;
}

 if (isset($_GET['id'])) {
    $weaponId = $_GET['id'];

     $vikings = findVikingsByWeapon($weaponId);

    if ($vikings !== null) {
         $response = [];
        foreach ($vikings as $viking) {
            $response[] = [
                'name' => $viking['name'],
                'link' => "/api/viking/findOne.php?id=" . $viking['id']
            ];
        }

         echo json_encode($response);
    } else {
         returnError(404, 'No vikings found with this weapon');
    }
} else {
     returnError(400, 'Missing parameter: id');
}
?>
