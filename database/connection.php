<?php

$server = 'localhost';
$user = 'root';
$password = '';
$db = 'simpo';

$conn = mysqli_connect($server,$user,$password,$db);

if(!$conn) {
    echo ' not connected';
}