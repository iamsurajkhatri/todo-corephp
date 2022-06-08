<?php
$showAlert=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
include 'db/dbconnect.php';
$username=$_POST["username"];
$password=$_POST["password"];
$cpassword=$_POST["cpassword"];

if(!$username) {
  $showError = "Username Cannot be blank";
}
if(!$password) {
  $showError = "Password field cannot be empty";
}

if(!$username && !$password) {
  $showError = "Username and Password cannot be empty";
}


$existSql = "SELECT * FROM `users` WHERE username = '$username'";
$result = mysqli_query($conn, $existSql);
$numExistRows = mysqli_num_rows($result);
if($numExistRows > 0){
    // $exists = true;
    $showError = "Username Already Exists";
}
else{


if($username && $password) {  
if(($password == $cpassword)){
  $hash=password_hash($password, PASSWORD_DEFAULT);
  $sql= "INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$username', '$hash', current_timestamp())";
    $result=mysqli_query($conn, $sql);
    if($result){
      $showAlert =true;
    }
}
else{
  $showError = "Passwords do not match";
}
}

else {
  $showError = "Username and password cannot be empty";
}

} 
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>SIGN UP</title>
  </head>
  <body>
      <?php

      include('include/header.php');
     ?>
      <div class="container my-4">
      <h1 class="text-center">User Registration</h1>
      <form action="signup.php" method="POST">
          <div class="mb-3 offset-lg-3 col-md-6">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            
          <div class="mb-3 ">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="mb-3 ">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="cpassword" class="form-control" id="cpassword" name="cpassword">
            <div id="emailHelp" class="form-text">Make sure to type same password.</div>
          </div>
          </div>
          <button type="submit" class="btn btn-primary col-md-3 offset-lg-5 text-center">Sign Up</button>
        </form>
      </div>

    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>