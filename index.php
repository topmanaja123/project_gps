<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>INDEX</title>
</head>

<body>
    <?php 
    require'css.php';
    include('nav.php');
    require'js.php';
    ?>
    
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
</body>

</html>
<?php 

?>