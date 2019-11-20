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
     <p></p>
  </div>

  <div class="col-lg-9">
    <?php
    switch ($_GET[r]){
      case 'report_trip': include('report/report_trip_day.php') ; break;
      case 'report_feul': include('report/report_feul.php') ; break;
      default:
        // code...
        break;
    }
     ?>
  </div>

  </div>
