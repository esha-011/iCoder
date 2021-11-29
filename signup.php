<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // check whether this username exists


    $existsql= "SELECT * FROM `users` WHERE username='$username'";
    $result = mysqli_query($conn, $existsql);
    $numExistRows= mysqli_num_rows($result);


    if($numExistRows>0)
    {
      
      $showError = "Username already exists";

      }

      else{
        
            if($password == $cpassword) {
                $hash=password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result){
                    $showAlert = true;
                }
            }
            else{
                $showError = "Passwords do not match or Username already exists";
            }
        

      }
}
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


    <link rel="stylesheet" href="style.css">
    
    

    <title>signup</title>
  </head>
  <body>

  <?php require'partials/nav2.php' ?>


  
  <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>

  <div class="container my-5 " >

  <h1 class="text-center">Signup to our website</h1>

  <form  action="/login/signup.php" method="post" >
  <div class="form-group edit"  >

    <label for="username">Username</label>

    <input type="text" maxlength="11" class="form-control col-md-6" id="username" name="username" aria-describedby="emailHelp"  placeholder="Enter your username" >
    
  </div>

  <div class="form-group edit">
    <label for="password">Password</label>
    <input type="password" maxlength="23" class="form-control col-md-6" id="password" name="password"  placeholder="Enter your password">
  </div>

  <div class="form-group edit">
    <label for="cpassword"> Confirm Password</label>
    <input type="password" class="form-control col-md-6" id="cpassword" name="cpassword" placeholder="Enter your password again to confirm">
    <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
  </div>

  <div class="edit">
  
  <button type="submit" class="btn btn-danger col-md-6 ">Signup</button>
  </div>
 
</form>
  
  
  
  </div>



 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>