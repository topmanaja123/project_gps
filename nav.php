  <head>
      <!-- <link rel="stylesheet" href="/fontawesome/css/all.css"> -->
      <style media="screen">
      .navbar-dark .navbar-nav .nav-link {
        color: #ffffff;
      }
      .nav-item {
          border: 1px solid #06810f !important;
      }
      #mNav:visited ,#mNav:link {
        color: #ffffff;
        text-decoration:none;
       }
      #mNav:hover {
        color: #bdbcbd;
        text-decoration:none;
       }
       #btnTg {
         border-color: #e9ecef;
         background-color: background-color;
       }
      </style>
  </head>
  <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-success">
          <label class="navbar-brand"> GreenBox GPS</label>
          <button id="btnTg" class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="navbar-collapse collapse" id="navbarCollapse" style="">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item shadow  mb-0">
                <a class="nav-link " href="?p=page_position">
                  <i class="fal fa-map-marker-alt"></i>
                   ตำแหน่งปัจจุบัน
                 </a>
              </li>
              <li class="nav-item  shadow  mb-0">
                <a class="nav-link" href="?p=page_history">
                  <i class="fal fa-route"></i>
                  เส้นทางย้อนหลัง
                </a>
              </li>

              <!-- <li class="nav-item shadow  mb-0 ">
                <a class="nav-link " href="?p=page_notifications">
                  <i class="fal fa-exclamation-circle"></i>
                  การแจ้งเตือน</a>
              </li> -->

              <li class="nav-item shadow  mb-0" >
                <a class="nav-link" href="?p=page_report">
                  <i class="fal fa-file-alt"></i>
                  รายงาน</a>
              </li>

              <!-- <li class="nav-item shadow  mb-0 ">
                <a class="nav-link " href="?p=page_zone">
                  <i class="fal fa-draw-polygon"></i>
                   เขตพื้นที่
                </a>
              </li> -->

              <li class="nav-item shadow  mb-0 d-md-none">
                <div class="form-inline row">
                  <div class="col data-toggle="tooltip" data-placement="top" title="ข้อมูลส่วนตัว"">
                    <a class="nav-link" alt="ข้อมูลส่วนตัว" href="#"> <i class="fal fa-address-card"></i> ข้อมูลส่วนตัว </a>
                  </div>
                  <div class="col ">
                    <a class="nav-link" href="#"> <i class="fal fa-sign-out-alt"></i> ออกจากระบบ </a>
                  </div>
                </div>
              </li>
            </ul>
            <div class="form-inline mt-2 mt-md-0 mr-4">
                <a id="mNav" href="#" data-toggle="tooltip" title="ข้อมูลส่วนตัว"><i  class="fad fa-address-card d-none d-md-block fa-2x"></i></a>
            </div>
            <div class="form-inline mt-2 mt-md-0 mr-4">
                <a id="mNav" href="auth/logout.php" data-toggle="tooltip" title="ออกจากระบบ"><i class="fad fa-sign-out-alt d-none d-md-block fa-2x"></i></a>
            </div>
          </div>
        </nav>
  <div class="row-clearfix">

  </div>
