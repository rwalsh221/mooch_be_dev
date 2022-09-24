<?php
header("Access-Control-Allow-Origin: *");

require dirname(__DIR__, 3) . '/includes/classes/curl/CurlAthleteStats.php';
require dirname(__DIR__, 3) . '/includes/classes/database/DatabaseAthlete.php';

// $authToken = '294def39c971838b61602ebe3cc61f04d52c5ade';

// $getAthlete = new CurlAthleteStats('athletes/17138502/stats', array(
//     'Content-Type: application/json', 'Authorization: Bearer ' . $authToken));

// $getAthlete->getAthleteStats();
echo'hello';
$userId = $_GET['userId'];
echo $userId;
$authToken = 'c2efce4749fc617895b3394ed965089b38c6937b';

$getAthlete = new CurlAthleteStats('athletes/17138502/stats', array(
    'Content-Type: application/json', 'Authorization: Bearer ' . $authToken));

$databaseConnection = new DatabaseAthlete();

$athleteStats = $getAthlete->getAthleteStats();
var_dump($athleteStats);

$databaseConnection->insertAthleteStats($userId, $athleteStats);

?>