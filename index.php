<?php  
error_reporting(E_ALL ^ E_WARNING);

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true){
  header("location:login.php");
  exit;
}

$insert = false;
$update = false;
$delete = false;

//include database connection
include 'db/dbconnect.php';

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
    echo $sno;exit;

  $delete = true;
  $sql = "DELETE FROM `list` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];


  // Sql query to be executed
  $sql = "UPDATE `list` SET `title` = '$title' , `description` = '$description', `created_on` = 'current_timestamp()'  WHERE `list`,`task_id` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $title       = $_POST["title"];
    $description = $_POST["description"];
    $user_id     = $_SESSION['user_id'];
  // Sql query to be executed
  $sql = "INSERT INTO `list` (`title`, `description`,`user_id`,`created_on`) VALUES ('$title', '$description','$user_id',current_timestamp())";
  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  } 
}
}
?>
  <?php
  include('include/header.php');
?>
  <div class="container my-4">
    
    <div class="container">
    <div class="alert alert-success" role="alert">
  <h1 class="alert-heading"<h1><center>WELCOME <?php echo $_SESSION['username'] ?><center></h1>
  <hr>.
  <h2><center>Create a New Task<center></h2>
</div>
    </div>
   
    <form action="index.php" method="POST">
      <div class="form-group">
        <label for="title">List Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>

      <div class="form-group">
        <label for="desc"> List Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Task</button>
    </form>
  </div>

  <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Created Date</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $userId =   $_SESSION['user_id'];
          $sql = "SELECT * FROM `list` WHERE user_id='$userId'";
          $result = mysqli_query($conn, $sql);
          $count = 0;
          while($row = mysqli_fetch_assoc($result)){
            $count = $count+1;
            ?>
           
         <tr>
            <th scope='row'><?php echo $count; ?></th>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['description'];?></td>
            <td><?php echo  $row['created_on'];?></td>
           <td>
           <a href="editTask.php?edit=<?php echo $row['task_id'];?>" class="btn btn-warning">Edit</a>
           <a href="editTask.php?delete=<?php echo $row['task_id'];?>" class="btn btn-danger">Delete</a>
           
                                     
          </td>
          </tr>
       <?php } 
        ?>


      </tbody>
    </table>
  </div>
<?php include('include/footer.php')?>