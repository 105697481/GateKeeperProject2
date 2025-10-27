<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'gate_keeper';

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn) {
    die("<p> ❌ Database connection failed: " . mysqli_connect_error() . "</p>"); # Stops the execution and shows an error message 
}