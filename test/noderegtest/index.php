<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");


require dirname(__DIR__, 2) . '/includes/classes/database/DatabaseAthlete.php';
require dirname(__DIR__, 2) . '/includes/classes/curl/CurlAthleteStats.php';
require dirname(__DIR__, 2) . '/includes/classes/curl/CurlAthleteNewAuthToken.php';
require dirname(__DIR__, 2) . '/includes/classes/curl/CurlAthlete.php';


$databaseAthlete = new DatabaseAthlete();
$curlAthleteNewAuthToken = new CurlAthleteNewAuthToken();


// 1, receive  user UID, client secret, client id, access token, refresh token and email from front end. = $signUpData
// var_dump( file_get_contents('php://input'));
// $body = file_get_contents('php://input');
// var_dump('hello php');
// var_dump($body);
// $signUpData = json_decode($body, true);
// var_dump($signUpData);
// echo json_last_error_msg();
// if($signUpData === null) {
//     echo 'signupdata null';
//     http_response_code(400);        
//     exit;
// }

$signUpData = $_GET;

// extract($urlParams, $flags=EXTR_SKIP);

// 2, request refresh token from strava to get token exipres_in and expires_at. = $tokenData

$getTokenExpires = $curlAthleteNewAuthToken->getNewAuthToken($signUpData['clientId'], $signUpData['clientSecret'],$signUpData['refreshToken']);

$tokenExpiresAt = $getTokenExpires['expires_at'];
$tokenExpiresIn = $getTokenExpires['expires_in'];

// 3, request athlete info from strava to get athleteID, first and last name, profile img, = $athleteProfileData
$curlAthlete = new CurlAthlete('athlete', ["Authorization: Bearer {$signUpData['accessToken']}"]);
$athleteProfileData = $curlAthlete->getAthlete();
var_dump($athleteProfileData);
// 4 send curl request to get ATHLETE STATS FROM STRAVA. = $athleteStatsData

$curlAthleteStats = new CurlAthleteStats('athletes/' . $athleteProfileData['id'] . '/stats', array(
    'Content-Type: application/json', 'Authorization: Bearer ' . $signUpData['accessToken']));

$athleteStatsData = $curlAthleteStats->getAthleteStats();
var_dump($athleteStatsData);

$databaseAthlete->registerAthlete($signUpData['uid'] ,$signUpData['email'] ,$athleteProfileData['id'], $athleteProfileData['firstname'], $athleteProfileData['lastname'], 
$athleteProfileData['profile_medium'], $tokenExpiresAt, $tokenExpiresIn, $signUpData['clientId'], $signUpData['clientSecret'], $signUpData['accessToken'], $signUpData['refreshToken']);




// echo json_encode($athleteStats);

$databaseAthlete->insertAthleteStats($signUpData['uid'], $athleteStatsData);
http_response_code(200);

?>