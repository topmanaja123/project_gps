<?php
session_start();
if (!isset($_SESSION['userid'])) {
  header("location:/project_gps/auth");
}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GreenboxGps</title>
</head>
<style>
.grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 10px;
}
.span-col-4{grid-column: span 4 / auto;}

.span-col-3{grid-column: span 3 / auto;}

.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   max-height: 30px;
   height : 3vh;
   background-color: #28A745;
   color: white;
   text-align: center;
}
</style>
<body>
    <?php 
    require'css.php';
    include('nav.php');
    require'js.php';
    require_once('all_functions.php');
    
    ?>
    
    <?php
          $page=isset($_GET['p']) ? $_GET['p'] : '' ;
          switch ($page) {
            case 'page_position': include('page_position.php') ;break;
            case 'page_history' : include('page_history.php') ;break;
            case 'page_report' : include('page_report.php') ;break;
            case 'page_notifications' : include('page_notifications.php') ;break;
            case 'page_zone' : include('page_zone.php') ;break;
            default:
              include('page_position.php') ;
            break;
          }
          ?>
          <div class="footer">
  <p>Copyright © 2019 www.greenboxgps.com All rights reserved</p>
</div>

</body>

</html>