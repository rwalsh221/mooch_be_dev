<?php 
require dirname(__DIR__, 2) . '/includes/classes/curl/CurlSegments.php';
require dirname(__DIR__, 2) . '/includes/classes/curl/CurlAthleteNewAuthToken.php';

require dirname(__DIR__, 2) . '/includes/classes/database/DatabaseSegments.php';
require dirname(__DIR__, 2) . '/includes/classes/database/DatabaseAthlete.php';


$accessToken = '89a67ea07426fa292dc25f5284073e3c7d4b114d';
$userId = 'yxTBwLMO05VN7zmYUcjqNdadkkt2';

$databaseAthlete = new DatabaseAthlete();

// $databaseAthlete->getAllAthleteNames();

$databaseSegments = new DatabaseSegments();

$testArray = array();

$json = ["segmentIdACTUAL" => ["uidActual"=>["time"=>"time",
                                              "user"=>"user"]]];

                                              $json2 = ["segmentIdACTUAL" => [["time"=>"time",
                                              "user"=>"user"]]];

$jsonTest = array();

$athleteSegements = $databaseSegments->getAthleteSegments($userId);

// var_dump($databaseSegments->getAthleteSegments($userId));
echo '<br>';

foreach($athleteSegements as $athleteSegementsKey) {
    echo'hello';
    var_dump($athleteSegementsKey);
    echo 'hello';
    array_push($testArray, $databaseSegments->getSegmentTimes($athleteSegementsKey[0]['segmentId']));
    $jsonTest[$athleteSegementsKey[0]["segmentId"]] = [["time"=>"time",
    "user"=>"user"]];
}
echo '<br>';
// var_dump($testArray);
// ADDS USER TIME TO DB WORKING
var_dump($jsonTest)
// var_dump(empty($test));

?>