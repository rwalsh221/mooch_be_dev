<?php
header("Access-Control-Allow-Origin: *");

require dirname(__DIR__, 2) . '/includes/classes/curl/CurlAthleteStats.php';
// require dirname(__DIR__, 2) . '/includes/classes/database/DataBaseAthlete.php';

// $authToken = '294def39c971838b61602ebe3cc61f04d52c5ade';

// $getAthlete = new CurlAthleteStats('athletes/17138502/stats', array(
//     'Content-Type: application/json', 'Authorization: Bearer ' . $authToken));

// $getAthlete->getAthleteStats();

// $authToken = '294def39c971838b61602ebe3cc61f04d52c5ade';

// $getAthlete = new CurlAthleteStats('athletes/17138502/stats', array(
//     'Content-Type: application/json', 'Authorization: Bearer ' . $authToken));

// $dataBaseConnection = new DatabaseAthlete();

// $athleteStats = $getAthlete->getAthleteStats();

// $dataBaseConnection->insertAthleteStats($userId, $athleteStats);

?>