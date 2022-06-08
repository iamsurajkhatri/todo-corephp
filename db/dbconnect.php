<?php
$host='localhost';
$username='root';
$password='';
$database='todo_core_php';
// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
?>