<?php 
header("Access-Control-Allow-Origin: *");

// require dirname(__DIR__, 2) . '/includes/classes/database/DatabaseSettings.php';
require dirname(__DIR__, 2) . '/includes/classes/database/DatabaseAthlete.php';

// phpinfo();

$test = new DatabaseAthlete;

$test->getAthleteStats();

?>