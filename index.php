<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>INDEX</title>
    
      <style media="screen">
      #map {
        background-color: black;
      }
      .full-screen {
        width: 100vw;
      }
      </style>
  </head>

  <body>
    <?php
    require'css.php';
    include('nav.php');
    ?>
      <div class="row" >
        <div class="col">
          <?php
          $page=isset($_GET['p']) ? $_GET['p'] : '' ;
          switch ($page) {
            case 'page_position': include('page_position.php') ;break;
            case 'page_history' : include('page_history.php') ;break;
            case 'page_report' : include('page_report.php') ;break;
            case 'page_notifications' : include('page_notifications.php') ;break;
            case 'page_zone' : include('page_zone.php') ;break;
            // default:
            //   include('page_position.php') ;
            // break;
          }
          ?>
        </div>
      </div>
  </body>
</html>
<?php 
  require'js.php';
?>
