<style media="screen">
  .bg-green {
    background-color: #e2e2e2;
  }
  .full-block{
    height: 100%;
    width: 100vw;
  }
</style>
<div class="form-row">
  <div class="col-lg-3 col-md-12 full-block">
    <?php
    include('page_report_menu.php')
     ?>
  </div>
  <div class="col-lg-9">
    <?php
      switch ($_GET[r]){
        case 'report_trip': include('page_report_trip.php') ; break;
        case 'report_distance': include('page_report_distance.php') ; break;
        default:
          // code...
          break;
      }
    ?>
  </div>
</div>
  