<?php
$host = 'localhost';
$user = 'root';
$password = '123456';
//$password = '';
$db = 'ronen';

// connection
$link = mysqli_connect($host, $user, $password, $db) or die("Error ".mysqli_error($link));