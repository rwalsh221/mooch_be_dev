<?php 

$url = 'https://jsonplaceholder.typicode.com/posts';

$result = file_get_contents($url);

echo $result;

?>