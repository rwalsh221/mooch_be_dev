<?php
header("Access-Control-Allow-Origin: *");

require dirname(__DIR__, 2) . '/includes/classes/database/DatabaseAthlete.php';

$body = file_get_contents('php://input');
$data = json_decode($body, true);

$athlete = new DatabaseAthlete();

$athlete->registerAthlete($data['userId'],$data['athlete']['firstname'],$data['athlete']['lastname'], $data['athlete']['profile_medium'], 
$data['expires_at'], $data['expires_in'], $data['access_token'], $data['refresh_token']);

// $initRegisterAthlete->registerAthlete('test1','test2','test3','test4',1,2,'test7','test8',)

// echo json_encode($data['athlete']['firstname']);
?>