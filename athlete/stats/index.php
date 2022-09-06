<?php
header("Access-Control-Allow-Origin: *");

require dirname(__DIR__, 2) . '/includes/classes/curl/CurlSettings.php';

$authToken = '3a38f64e0d147f1527fb805ea5739bd0cd2efd91';

$getAthlete = new CurlSettings('athletes/17138502/stats', array(
    'Content-Type: application/json', 'Authorization: Bearer ' . $authToken));

$getAthlete->curlInit();
?>