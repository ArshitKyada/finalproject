<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'auction';

$conn = mysqli_connect($host,$user,$password,$database);

if(!$conn){
    echo 'connection problem';
}

?>