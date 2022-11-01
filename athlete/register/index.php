<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

require dirname(__DIR__, 2) . '/includes/classes/database/DatabaseAthlete.php';
require dirname(__DIR__, 2) . '/includes/classes/curl/CurlAthleteStats.php';
require dirname(__DIR__, 2) . '/includes/classes/curl/CurlAthleteNewAuthToken.php';
require dirname(__DIR__, 2) . '/includes/classes/curl/CurlAthlete.php';

// 1, receive  user UID, client secret, client id, access token, refresh token and email from front end. = $signUpData
$body = file_get_contents('php://input');
$signUpData = json_decode($body, true);

if($signUpData === null) {
    http_response_code(400);
    exit;
}

// 2, request refresh token from strava to get token exipres_in and expires_at. = $tokenData
$curlAthleteNewAuthToken = new CurlAthleteNewAuthToken();
$getTokenExpires = $curlAthleteNewAuthToken->getNewAuthToken($signUpData['clientId'], $signUpData['clientSecret'],$signUpData['refreshToken']);

$tokenExpiresAt = $getTokenExpires['expires_at'];
$tokenExpiresIn = $getTokenExpires['expires_in'];

// 3, request athlete info from strava to get athleteID, first and last name, profile img, = $athleteProfileData
$curlAthlete = new CurlAthlete('athlete', ["Authorization: Bearer {$signUpData['accessToken']}"]);
$athleteProfileData = $curlAthlete->getAthlete();

// 4, send curl request to get ATHLETE STATS FROM STRAVA. = $athleteStatsData
$curlAthleteStats = new CurlAthleteStats('athletes/' . $athleteProfileData['id'] . '/stats', array(
    'Content-Type: application/json', 'Authorization: Bearer ' . $signUpData['accessToken']));

$athleteStatsData = $curlAthleteStats->getAthleteStats();

// 5, set athlete database with new athlete
$databaseAthlete = new DatabaseAthlete();

$databaseAthlete->registerAthlete($signUpData['uid'] ,$signUpData['email'] ,$athleteProfileData['id'], $athleteProfileData['firstname'], $athleteProfileData['lastname'], 
$athleteProfileData['profile_medium'], $tokenExpiresAt, $tokenExpiresIn, $signUpData['clientId'], $signUpData['clientSecret'], $signUpData['accessToken'], $signUpData['refreshToken']);

// 6, set athleteStats database with new athlete
$databaseAthlete->insertAthleteStats($signUpData['uid'], $athleteStatsData);

?>