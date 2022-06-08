<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include database connection
include 'db/dbconnect.php';
session_start();
$loggedUser = $_SESSION['user_id'];
$insert = false;
$update = false;
$delete = false;

//edit functionality 
if(isset($_REQUEST['edit'])) {
    $taskId = $_REQUEST['edit'];

//updated the task

if(isset($_POST['update'])) {   

    $title = $_POST["title"];
    $description = $_POST["description"];
    $sql = "UPDATE `list` SET `title` = '$title' , `description` = '$description', `created_on` = current_timestamp()  WHERE `task_id` = $taskId";
    $result = mysqli_query($conn, $sql);
    if($result){
      $update = true;
      header("location:index.php");

  }
  else{
      echo "Something went wrong Task is not created due to error". mysqli_error($conn);
  }

}


//edit the task 
    $sql = "SELECT * FROM `list` WHERE task_id='$taskId'";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){ 

?>
<?php

include('include/header.php');
?>

 <div class="container my-4">
    
    <div class="container">
    <div class="alert alert-success" role="alert">
  <h1 class="alert-heading"<h1><center>WELCOME <?php echo $_SESSION['username'] ?><center></h1>
  <hr>.
  <h2><center>Update todo<center></h2>
</div>
    </div>
   
    <form action="" method="POST">
      <div class="form-group">
        <label for="title">List Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title'];?>">
      </div>

      <div class="form-group">
        <label for="desc"> List Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?php echo $row['description'];?></textarea>
      </div>
      <button type="submit" class="btn btn-primary" name="update">Updated Todo</button>
    </form>
  </div>
  <?php }}



//delete the Task 
if(isset($_REQUEST['delete'])) {
    $taskId = $_REQUEST['delete'];
    $sql = "DELETE FROM `list` WHERE `task_id` = $taskId";
    $result = mysqli_query($conn, $sql);
    if($result){
        $delete = true;
        header("location:index.php");
    }
 }
