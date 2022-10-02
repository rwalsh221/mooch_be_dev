<?php
header("Access-Control-Allow-Origin: *");

require dirname(__DIR__, 3) . '/includes/classes/curl/CurlRegisterAthlete.php';

$body = file_get_contents('php://input');
$data = json_decode($body, true);

$registerAthlete = new CurlRegisterAthlete($data['clientId'], $data['clientSecret'], $data['authCode']);

$registerAthleteResponse = $registerAthlete->curlPost();

echo $registerAthleteResponse;
?>