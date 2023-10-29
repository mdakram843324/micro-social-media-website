
<?php
include ('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>signup page</title>
    <link rel="stylesheet" href="styleforsignup.css">
</head>
<body>
    <div class="container">
        <div class="right-section">
          <p class="text">It's free and always will be.</p>
          <form action="" method="post" id="formSection">
              <div class="form-group">
                  <input type="text" class="control half" placeholder="First Name" required name="fName">
                  <input type="text" class="control half" placeholder="Last Name" required name="lName">
              </div>
              <div class="form-group">
                  <input type="email" class="control" placeholder="Email" required name="email">
              </div>
              <div class="form-group">
                <input type="email" class="control" placeholder="Re-Email" required name="re_email">
            </div>
              <div class="form-group">
                  <input type="password" class="control" placeholder="New Password" required name="password">
              </div>
              <div class="form-group">
                  <input type="date" class="control"  required name="dob">
              </div>
              <div class="form-group" for="">
                  <input type="radio" name="gender" id="" value="Male"><Span>Male</Span>
                  <input type="radio" name="gender" id="" value="Female"><Span>Female</Span>
                  <input type="radio" name="gender" id="" value="Other"><Span>Other</Span>
              </div>
              <div class="form-group">
                  <p class="someText">By clicking Sign Up, you agree to our Terms, Data Policy and Cookie Policy. You may receive SMS notifications from us and can opt out at any time.</p>
              </div>
              <div class="form-group">
                  <button type="submit"  class="btn" name="submit">Sign Up</button>
              </div>
          </form>
        </div>
    </div>
</body>
</html>
<?php
    if(isset($_POST['submit'])){
          $fName= mysqli_real_escape_string($con, $_POST['fName']);
          $lName=mysqli_real_escape_string($con,  $_POST['lName']);
          $email= mysqli_real_escape_string($con, $_POST['email']);
          $re_email=mysqli_real_escape_string($con,  $_POST['re_email']);
          $password	=mysqli_real_escape_string($con,  $_POST['password']);
          $dob=mysqli_real_escape_string($con,  $_POST['dob']);
          $gender	=mysqli_real_escape_string($con,  $_POST['gender']);

          //password encryption
          $password = password_hash($password,PASSWORD_BCRYPT);

          //finding dublicate email before creating an account

          $emailQuery= " SELECT * FROM Users where email='$email' ";
          $query  = mysqli_query($con, $emailQuery);

          $emailCount =  mysqli_num_rows($query);

          if($emailCount>0){
           ?>
           <script>
              alert("Email already exist");
           </script>
           <?php
          }
          else{
            if($email != $re_email){
              ?>
              <script>
                alert("Email doesn't matching");
              </script>
              <?php
            }
            else{
              $insertQuery= "INSERT INTO users( `fName`, `lName`, `email`, `re_email`, `password`,`dob`,`gender`) VALUES ('$fName','$lName','$email','$re_email','$password','$dob','$gender')";
              $query = mysqli_query($con, $insertQuery);
              ?>
              <script>
                alert("Registerd successfully !");
                </script>
              <?php
              header ('location:homepage.php');
            }
          }

    }
    ?>
