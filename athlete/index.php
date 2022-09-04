<?php

require dirname(__DIR__, 1) . '/includes/classes/curl/CurlSettings.php';

$authToken = '86e487c768c0ce1630788d5f1ce1af11045ca2f4';

$getAthlete = new CurlSettings('/athlete', array(
    'Content-Type: application/json', 'Authorization: Bearer ' . $authToken));

$getAthlete->curlInit();

?>