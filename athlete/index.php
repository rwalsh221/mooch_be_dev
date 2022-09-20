<?php
header("Access-Control-Allow-Origin: *");

require dirname(__DIR__, 1) . '/includes/classes/curl/CurlAthlete.php';

$authToken = '294def39c971838b61602ebe3cc61f04d52c5ade';

$getAthlete = new CurlAthlete('/athlete', array(
    'Content-Type: application/json', 'Authorization: Bearer ' . $authToken));

$getAthlete->getAthlete();

?>