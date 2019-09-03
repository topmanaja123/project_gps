<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="fontawesome/all.css">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

</head>

<body>
  <div id="particles-js"></div>
  <!-- /.particles div -->
  <div class="background-wrap">
  <div class="background"></div>
</div>

<form id="accesspanel" action="" method="post">
  <h1 id="litheader">AECEND</h1>
  <div class="inset">
    <p>
      <input type="text" name="username" id="email" placeholder="Email address">
    </p>
    <p>
      <input type="password" name="password" id="password" placeholder="Access code">
    </p>
    <div style="text-align: center;">
      <div class="checkboxouter">
        <input type="checkbox" name="rememberme" id="remember" value="Remember">
        <label class="checkbox"></label>
      </div>
      <label for="remember">Remember me for 14 days</label>
    </div>
    <input class="loginLoginValue" type="hidden" name="service" value="login" />
  </div>
  <p class="p-container">
    <input type="submit" name="Login" id="go" value="Authorize">
  </p>
</form>
</body>

</html>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<script src="vendor\login\particles.js"></script>
<script src="js/login.js"></script>