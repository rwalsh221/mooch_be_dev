<?php
header("Access-Control-Allow-Origin: *");

require dirname(__DIR__, 3) . '/includes/classes/curl/CurlAthleteStats.php';
require dirname(__DIR__, 3) . '/includes/classes/curl/CurlAthleteNewAuthToken.php';

require dirname(__DIR__, 3) . '/includes/classes/database/DatabaseAthlete.php';

$userId = $_GET['userId'];

$databaseAthlete = new DatabaseAthlete();

// $tokenExpiresAt = $databaseAthlete->getTokenExpiresAt($userId);

// if ($tokenExpiresAt > (time() - 300)) {
    
//     $clientSecret = $databaseAthlete->getClientSecret($userId);
//     $clientId = $databaseAthlete->getClientId($userId);
//     $refreshToken = $databaseAthlete->getRefreshToken($userId);

//     $curlAthleteRefresh = new CurlAthleteNewAuthToken("oauth/token?client_id=$clientId&client_secret=$clientSecret&refresh_token=$refreshToken&grant_type=refresh_token
//     ", null);
//     $newAccessToken = $curlAthleteRefresh->getAuthToken();
//     echo $newAccessToken;
//     // $databaseAthlete->setNewAccessToken();
// }

$accessToken = $databaseAthlete->getAccessToken($userId);
$stravaAthleteId = $databaseAthlete->getStravaAthleteId($userId);

$curlAthleteStats = new CurlAthleteStats('athletes/' . $stravaAthleteId . '/stats', array(
    'Content-Type: application/json', 'Authorization: Bearer ' . $accessToken));

$curlAthleteStats = $curlAthleteStats->getAthleteStats();


$databaseAthlete->updateAthleteStats($userId, $curlAthleteStats);


?>