<?php
header("Access-Control-Allow-Origin: *");

require dirname(__DIR__, 1) . '/includes/classes/curl/CurlAthlete.php';
require dirname(__DIR__, 1) . '/includes/classes/database/DatabaseAthlete.php';


// $authToken = 'c2efce4749fc617895b3394ed965089b38c6937b';

// $getAthlete = new CurlAthlete('/athlete', array(
//     'Content-Type: application/json', 'Authorization: Bearer ' . $authToken));

// $getAthlete->getAthlete();

$userId = $_GET['userId'];

$databaseConnection = new DatabaseAthlete();

$userInfo = $databaseConnection->getAthlete($userId);

echo json_encode($userInfo);

?>