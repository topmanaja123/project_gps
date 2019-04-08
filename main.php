
<div class="row">
  <?php

  switch ($_GET[p]) {
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
</div>
