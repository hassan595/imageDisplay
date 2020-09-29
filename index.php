<?php
  include 'config.php';
  session_start();
  
  if(isset($_POST['submit']))
  {    
    $Email = $_POST["Email"];
    $Password = $_POST["Password"];
      
    if($Email !="" || $Password!="")
    {
      
      $result = mysqli_query($con, "SELECT UserID FROM users WHERE Email='$Email' and Password='$Password' ");
         
      if(mysqli_num_rows($result) == 1){
    
        if(!empty($_POST["remember"])) 
        {
          setcookie ("Email",$_POST["Email"],time()+ 3600);
          setcookie ("Password",$_POST["Password"],time()+ 3600);
        }
        else 
        {
          setcookie("Email","");
          setcookie("Password","");
          echo "Cookies Not Set";
        }

          $row=mysqli_fetch_assoc( $result );
          $userid=$row['UserID'];
          $_SESSION['UserID'] = $userid; 
         header("location: home.php"); 
      }
      else{
        echo "Incorrect Email or Password";        

      }


    }

  } 


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Signin Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">

    <form action="" method="post" class="form-signin">
    
        <h1 class="h3 mb-3 font-weight-normal">Sign-In</h1><br>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="Email" class="form-control" placeholder="Email address" value="<?php if(isset($_COOKIE["Email"])) { echo $_COOKIE["Email"]; } ?>" required autofocus><br><br>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="Password" class="form-control" placeholder="Password"value="<?php if(isset($_COOKIE["Password"])) { echo $_COOKIE["Password"]; } ?>" required>
      
      <div class="checkbox mb-3">
        <label>
            <input type="checkbox" name="remember"> Remember me
          </label>
      </div>
  
      <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted"></p>

      <a href="signup.php">Create Account </a>


    </form>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
  </body>


</html>