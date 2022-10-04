<?php 
header("Access-Control-Allow-Origin: *");
// https://stackoverflow.com/questions/16700960/how-to-use-curl-to-get-json-data-and-decode-the-data

// $endpoint = 'https://jsonplaceholder.typicode.com/comments';


// $params = array('postId' => '1');
// // $result = file_get_contents($url);

// $url = $endpoint . '?' . http_build_query($params);

// $curlInit = curl_init();

// curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

// curl_setopt($curlInit, CURLOPT_URL, $url);

// $result = curl_exec($curlInit);

// curl_close($curlInit);

// echo $result;

echo (time() - 300);
$test = getenv('DATABASE_URL');
var_dump($test);

?>