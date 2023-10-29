<?php
    include ('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Login Page</title>
    <link rel="stylesheet" href="styleforloginform.css">
  </head>
  <body>
    <div class="container flex">
      <div class="facebook-page flex">
        <div class="text">
          <h1>minifacebook</h1>
          <p>Connect with friends and the world </p>
          <p> around you on Facebook.</p>
        </div>
        <form action="" method="post">
          <input type="text" placeholder="Email or phone number" required name="email">
          <input type="password" placeholder="Password" required name="password">
          <div class="link">
            <button type="submit" name="submit" class="login">Login</button>
          
            <a href="forgot-password.php" class="forgot">Forgot password?</a>
          </div>
          <hr>
          <div class="button">
            <a href="signup.php">Create new account</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>

<?php

if(isset($_POST['submit'])){
  $email= $_POST['email'];
  $password	= $_POST['password'];

  $emailSearch="SELECT * FROM USERS WHERE email= '$email' ";
  $query= mysqli_query($con,$emailSearch);

  $emailCount= mysqli_num_rows($query);

  if($emailCount ==1){
    $email_pass= mysqli_fetch_assoc($query);
    $db_pass=$email_pass['password'];
    $password_decode= password_verify($password,$db_pass);
    if($password_decode){
      header ('location:homepage.php');
    }
    else{
      ?>
      <script>
        alert("Login Faild");
      </script>
      <?php
    }

  }
  else{
    ?>
      <script>
        alert("Account doesn't exist");
      </script>
      <?php
  }




}





?>
