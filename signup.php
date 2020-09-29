<!-- Backend php code -->
<?php

include 'config.php';
   

    if(isset($_POST['submit']))
    {
    
      $Password = $_POST["Password"];
      $Email = $_POST["Email"];
        
        
    
      if($Password=="" || $Email==""  )
      {
    
        echo '<script>alert("Some Fields are left empty")</script>';
        
      }
      else
      {       
        $email_chk = mysqli_query($con, "SELECT Email FROM users WHERE Email='$Email' ");
    
        if(mysqli_num_rows($email_chk) >=1){
    
          echo '<script>alert("User Already Exists")</script>';        
    
        }
        else
        {   
            $sql = "INSERT INTO users (Email, Password )
            VALUES ( '$Email', '$Password');";


          if (mysqli_query($con, $sql))
          {
              echo '<script>alert("Account Created Successfully")</script>'; 
                header("location: index.php");             
          } 
          else{
              echo "Error: Debugging PHP " . $sql . "<br>" . mysqli_error($con);
          }
    
        }
      }
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sign up Forms</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="registration-form">
        <form  action="" method="post"  id="sign_up">
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
                <input type="email" class="form-control item" name="Email" placeholder="Email" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" name="Password" placeholder="Password" required>
            </div>
            
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-block create-account">Create Account</button>
            </div>
            <a href="userlogin.php">Already have an account?</a>
        </form>
        <div class="social-media">
            <h5>Follow Us On social media</h5>
            <div class="social-icons">
                <a href="#"><i class="icon-social-facebook" title="Facebook"></i></a>
                <a href="#"><i class="icon-social-instagram" title="Google"></i></a>
                <a href="#"><i class="icon-social-twitter" title="Twitter"></i></a>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
