<?php 
header("Access-Control-Allow-Origin: *");
require dirname(__DIR__, 1) . '/includes/classes/curl/CurlAthleteStats.php';
require dirname(__DIR__, 1) . '/includes/classes/curl/CurlAthleteNewAuthToken.php';

require dirname(__DIR__, 1) . '/includes/classes/database/DatabaseAthlete.php';
// https://stackoverflow.com/questions/16700960/how-to-use-curl-to-get-json-data-and-decode-the-data

// $endpoint = 'https://jsonplaceholder.typicode.com/comments';


// $params = array('postId' => '1');
// // $result = file_get_contents($url);

// $url = $endpoint . '?' . http_build_query($params);

// $curlInit = curl_init();

// curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

// curl_setopt($curlInit, CURLOPT_URL, $url);

// $result = curl_exec($curlInit);

// curl_close($curlInit);

// echo $result;

// $tokenExpiresAt = $databaseAthlete->getTokenExpiresAt($userId);

// curl -X POST https://www.strava.com/api/v3/oauth/token \
//   -d client_id=94702 \
//   -d client_secret=cc7de5dea65e248c912898647081be8a10bc2291 \
//   -d grant_type=refresh_token \
//   -d refresh_token=bfb54d055b2b615e5b561c05f806661f05857330 
  

// $tokenExpiresAt = 1664897726;
// $curretTimePlus5Min = time() + 300;
    $databaseAthlete = new DatabaseAthlete();

    $userId = 'yxTBwLMO05VN7zmYUcjqNdadkkt2';

    // echo $databaseAthlete->getTokenExpiresAt($userId);

    $tokenExpiresAt = $databaseAthlete->getTokenExpiresAt($userId);
    // ADD 5 MINS TO CURRENT TIME SO TOKEN EXPIRES EARLY
    $currentTimePlus5Min = time() + 300;
    
    if ($tokenExpiresAt <= $currentTimePlus5Min) {
           
            $clientSecret = $databaseAthlete->getClientSecret($userId);
            $clientId = $databaseAthlete->getClientId($userId);
            $refreshToken = $databaseAthlete->getRefreshToken($userId);
        
            $postFields = [
                'client_id'=>$clientId,
                'client_secret'=>$clientSecret,
                'grant_type'=>'refresh_token',
                'refresh_token'=>$refreshToken
            ];
            
            $curlAthleteNewAuthToken = new CurlAthleteNewAuthToken("oauth/token", array('Content-Type: application/json', 'client_id=94702',
            'client_secret=cc7de5dea65e248c912898647081be8a10bc2291', 'grant_type=refresh_token', 'refresh_token=bfb54d055b2b615e5b561c05f806661f05857330'));
            $newAccessToken = $curlAthleteNewAuthToken->getNewAuthToken($clientId, $clientSecret, $refreshToken);
            var_dump($newAccessToken);
            $databaseAthlete->setNewAccessToken($userId, $newAccessToken['access_token'], $newAccessToken['refresh_token'], 
            $newAccessToken['expires_at'], $newAccessToken['expires_in']);
        } 


// echo $curretTimeMinus5Min;
// if ($tokenExpiresAt <= $curretTimePlus5Min) {
//     $userId = 'yxTBwLMO05VN7zmYUcjqNdadkkt2';
//     $databaseAthlete = new DatabaseAthlete();
//     echo 'trrrrue';
//     $clientSecret = $databaseAthlete->getClientSecret($userId);
//     $clientId = $databaseAthlete->getClientId($userId);
//     $refreshToken = $databaseAthlete->getRefreshToken($userId);

//     // $clientSecret = 'cc7de5dea65e248c912898647081be8a10bc2291';
//     // $clientId = '94702';
//     // $refreshToken = 'bfb54d055b2b615e5b561c05f806661f05857330';
//     $postFields = [
//         'client_id'=>$clientId,
//         'client_secret'=>$clientSecret,
//         'grant_type'=>'refresh_token',
//         'refresh_token'=>$refreshToken
//     ];
//     var_dump($postFields);
//     $curlAthleteRefresh = new CurlAthleteNewAuthToken("oauth/token", array('Content-Type: application/json', 'client_id=94702',
//     'client_secret=cc7de5dea65e248c912898647081be8a10bc2291', 'grant_type=refresh_token', 'refresh_token=bfb54d055b2b615e5b561c05f806661f05857330'));
//     $newAccessToken = $curlAthleteRefresh->getAuthToken($postFields);
//     var_dump($newAccessToken);
//     // $databaseAthlete->setNewAccessToken();

//     // $curlAthleteStats = new CurlAthleteStats('athletes/' . $stravaAthleteId . '/stats', array(
//     //     'Content-Type: application/json', 'Authorization: Bearer ' . $accessToken));
// } else {
//     echo 'false';
// }
?>