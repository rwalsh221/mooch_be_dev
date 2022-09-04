<?php
$endpoint = 'https://www.strava.com/api/v3/athletes/17138502/stats';

$authToken = '86e487c768c0ce1630788d5f1ce1af11045ca2f4';

$params = array('postId' => '1');
// $result = file_get_contents($url);

$url = $endpoint . '?' . http_build_query($params);

$curlInit = curl_init();

curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curlInit, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $authToken
));

curl_setopt($curlInit, CURLOPT_URL, $url);

$result = curl_exec($curlInit);

curl_close($curlInit);

echo $result;
?>