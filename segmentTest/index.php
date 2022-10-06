<?php 
require dirname(__DIR__, 1) . '/includes/classes/curl/CurlSegments.php';
require dirname(__DIR__, 1) . '/includes/classes/curl/CurlAthleteNewAuthToken.php';

require dirname(__DIR__, 1) . '/includes/classes/database/DatabaseSegments.php';

$accessToken = '9ee3fe6ecbb896bceed3cf6cfe20ba50600fe077';
$userId = '6JcYQOLPqnWLPusYIG3LD4fAQsS2';

$databaseSegments = new DatabaseSegments();

$segments = $databaseSegments->getSegmentIds();

$segmentIdArray = array();
$segmentTimeArray = array();

// echo $segments[0]['segmentId'];

foreach($segments as $segment) {
    array_push($segmentIdArray, $segment['segmentId']);
}

foreach($segmentIdArray as $segmentId) {
    $curlSegment = new CurlSegments('segments/' . $segmentId , array(
            'Content-Type: application/json', 'Authorization: Bearer ' . $accessToken));

    $segmentJson = $curlSegment->getSegment();

    $segmentJsonDecode = json_decode($segmentJson, true);

    $athleteSegmentTime = $segmentJsonDecode['athlete_segment_stats']['pr_elapsed_time'];

   if($athleteSegmentTime === null) {
    echo 'segment is null';
    continue;
   };
   
   array_push($segmentTimeArray, ['segmentId'=>$segmentId,'segmentTime'=>$athleteSegmentTime]);
//    var_dump($segmentTimeArray);
}

foreach($segmentTimeArray as $segmentTimeArrayIndex) {
    $databaseSegments->updateUserSegementTime($segmentTimeArrayIndex['segmentId'], $userId, $segmentTimeArrayIndex['segmentTime']);
}

var_dump($databaseSegments->getAthleteSegments($userId));

// ADDS USER TIME TO DB WORKING

// var_dump(empty($test));

?>