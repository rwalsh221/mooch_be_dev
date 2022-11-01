<?php
header("Access-Control-Allow-Origin: *");

require dirname(__DIR__, 2) . '/includes/classes/database/DatabaseAthlete.php';
require dirname(__DIR__, 2) . '/includes/classes/curl/CurlAthleteStats.php';

$body = file_get_contents('php://input');
$data = json_decode($body, true);

$databaseAthlete = new DatabaseAthlete();

// 1, receive  user UID, client secret, client id, access token, refresh token and email from front end. = $signUpData

// 2, request refresh token from strava to get token exipres_in and expires_at. = $tokenData

// 3, request athlete info from strava to get athleteID, first and last name, profile img, = $athleteData

// 4 send curl request to get ATHLETE STATS FROM STRAVA. = $getAthleteStats

$databaseAthlete->registerAthlete($data['userId'] ,$data['email'] ,$data['athlete']['id'], $data['athlete']['firstname'],$data['athlete']['lastname'], $data['athlete']['profile_medium'], 
$data['expires_at'], $data['expires_in'], $data['clientId'], $data['clientSecret'], $data['access_token'], $data['refresh_token']);

$getAthleteStats = new CurlAthleteStats('athletes/' . $data['athlete']['id'] . '/stats', array(
    'Content-Type: application/json', 'Authorization: Bearer ' . $data['access_token']));

$athleteStats = $getAthleteStats->getAthleteStats();
echo json_encode($athleteStats);

$databaseAthlete->insertAthleteStats($data['userId'], $athleteStats);

?>