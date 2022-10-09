<?php 
require dirname(__DIR__, 2) . '/includes/classes/curl/CurlSegments.php';
require dirname(__DIR__, 2) . '/includes/classes/curl/CurlAthleteNewAuthToken.php';

require dirname(__DIR__, 2) . '/includes/classes/database/DatabaseSegments.php';
require dirname(__DIR__, 2) . '/includes/classes/database/DatabaseAthlete.php';


$accessToken = '89a67ea07426fa292dc25f5284073e3c7d4b114d';
$userId = 'yxTBwLMO05VN7zmYUcjqNdadkkt2';

$databaseAthlete = new DatabaseAthlete();
$databaseSegments = new DatabaseSegments();

// WORKING BELOW
$segmentTimesArray = array();
// $segmentTimes = $databaseSegments->getSegmentTimes3(850707);
$athleteSegements = $databaseSegments->getAthleteSegments($userId);
foreach($athleteSegements as $athleteSegementsKey) {

$segmentId = $athleteSegementsKey[0]['segmentId'];
$segmentTimes = $databaseSegments->getSegmentTimes3($segmentId);

foreach($segmentTimes as $segmentTimesKey) {
    // var_dump($segmentTimesKey);
    $time = $segmentTimesKey['segmentTime'];
    $userId = $segmentTimesKey['userId'];
    $name = $databaseAthlete->getAthleteName($segmentTimesKey['userId'])[0]['firstName']; // METHOD RETURNS ARRAY FROM DB
    // var_dump($name);
    // var_dump($time);
    $segmentTimesArray["$segmentId"]["$userId"]["name"]=$name;
    $segmentTimesArray["$segmentId"]["$userId"]["time"]=$time;

}
}

var_dump($segmentTimesArray);

// 
// forech (segmenttime from db) {
    // function getnamefromdb(segmttime[userid])

    // segmtentimearray.pus(uid=>[time=>time
    // uid=>uid]) 
// 

// could sort by time in new array with segmentid as key and time as value then pass index into segment time array to get leadboard position.
// might do leaderboard in js
?>