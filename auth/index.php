<!DOCTYPE html>
<?php
ob_start();
session_start();
        if(isset($_POST['username']) && isset($_POST['password'])){
				//connection
                  include("../config.php");
        //รับค่า user & password
                 $username = $_POST['username'];
                 $password = $_POST['password'];
				//query 
                  $sql="SELECT * from users where name = '$username'";
                  $result = mysqli_query($conn,$sql);
                  $row = mysqli_fetch_array($result);
                  
                  if ($row) {
                    $hashedPassword = hashedPassword($_POST['password'], $row['salt']);
                    if ($hashedPassword === $row['hashedpassword']) {
                      $_SESSION['userid'] = $row['id'];
                    echo"<script>alert('เข้าสู่ระบบสำเร็ว')</script>";
                    Header("Location: ../index.php");
                    }else{
                      echo"<script>alert('รหัสผ่านไม่ถูกต้อง')</script>";
                      
                    }
                  }else{
                    // Header("Location: ../index.php");
                    echo"<script>alert('ไม่พบชื่อผู้ใช้')</script>";
                  }
        }else{
          echo "";
        }

        function hashedPassword($password, $salt){
          // $string = mcrypt_create_iv(24, MCRYPT_DEV_URANDOM);
          $salt = hex2bin($salt);


          $hash = hash_pbkdf2("sha1", $password, $salt , 1000, 24, true);
          $hash = strtoupper(bin2hex($hash));
          return $hash;
        }
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="login-style.css">
  <link rel="stylesheet" href="../fontawesome/css/all.css">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

</head>

<body class="align">
<div id="particles-js"></div>
  <!-- /.particles div -->
  
  </body>
	

  <div class="grid">

    <div id="login">

      <h2><span class="fontawesome-lock"></span>Greenbox GPS</h2>
      <form action="" method="POST">
        <fieldset>
          <p><label for="email">Username</label></p>
          <p><input type="text"  name="username" placeholder="username"></p>

          <p><label for="password">Password</label></p>
          <p><input type="password"  name="password" placeholder="password"></p>

          <p><input type="submit" value="login"><p>

        </fieldset>

      </form>

    </div> <!-- end login -->

  </div>

</body>	


</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="particles.js"></script>
<script src="login.js"></script>