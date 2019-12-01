<style media="screen">
body{
  overflow-x : hidden;
}
  .bg-green {
    background-color: #e2e2e2;
  }
  .full-block{
    height: calc(100vh - 64px - 3vh);
    width: 100vw;
  }
  .bg-gray{
    background-color: #A9A9A9;
  }
  
</style>
<div class="row">
  <div class="col-sm-5 col-md-4  col-lg-3 full-block bg-gray">
    <?php
    include('page_report_menu.php')
     ?>
     <p></p>
  </div>

  <div class="col-sm-7 col-md-8 col-lg-9 ">
    <?php
    $page=isset($_GET['r']) ? $_GET['r'] : '' ;
    switch ($page){
      case 'report_trip': include('report/report_trip_day.php') ; break;
      case 'report_feul': include('report/report_feul.php') ; break;
      default:
        // code...
        break;
    }
     ?>
  </div>

  </div>
