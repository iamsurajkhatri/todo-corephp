
  <?php 
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Task has been Created successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Task has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }

  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Task has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }

if(!$_SESSION['user_id']){

  if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Your Account is created.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              
    </div>';
  }

  if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> '.$showError.'
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              
    </div>';
  }

  if($login){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> You are LOGGED IN.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               
     </div>';
   }
}

?>