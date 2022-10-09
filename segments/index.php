<?php
header("Access-Control-Allow-Origin: *");

require dirname(__DIR__, 1) . '/includes/classes/database/DatabaseSegments.php';

$userId = $_GET['userId'];

$databaseConnection = new DatabaseSegments();

$userSegments = $databaseConnection->getAthleteSegmentsJson($userId);

echo json_encode($userSegments);

?>