<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <style type="text/css">
    body {
        font-family: system-ui, -apple-system, BlinkMacSystemFont, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    .pic_preview {
        height: auto;
        padding-bottom: 100%;
        background-size: cover;
        background-position: center;
    }

    .price {
        font-size: 18px;
        font-weight: 500;
        color: #f57224;
    }

    .discount_price {
        font-size: 10px;
        color: #9e9e9e;
    }

    .cus-icon:before {
        width: 30px;
        height: 30px;
    }

    /*sidemenu ด้านซ้าย*/
    .l-sidenav {
        position: fixed;
        z-index: 1040;
        top: 0;
        left: 0;
        height: 100%;
        width: 0;
        overflow-x: hidden;
    }

    /*คลุมดำพื้นที่เนื้อหา*/
    .page-overlay-bg {
        position: absolute;
        z-index: 1040;
        width: 0;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }
    </style>
</head>

<body>

    <!-- sidemenu ด้านซ้าย-->
    <nav class="l-sidenav bg-light">
        <div class="card bg-warning">
            <div class="navbar navbar-light">
                <a class="invisible"></a>
                <button type="button" class="close close-l-sidenav btn pl-2">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="card-body pt-1 text-center">
                <img src="https://www.ninenik.com/images/9.jpg" class="rounded-circle" style="width:75px;height:75px;">
                <h6 class="card-title">หัวข้อ หรือ ชื่อผู้ใช้</h6>
                <p class="card-text">
                    ข้อความอธิบายเพิ่มเติม
                </p>
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                รายการเมนู 1
                <span class="badge badge-primary badge-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                รายการเมนู 2
                <span class="badge badge-primary badge-pill">2</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                รายการเมนู 3
                <span class="badge badge-primary badge-pill">1</span>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">ตัวเลือก 1</li>
            <li class="list-group-item">ตัวเลือก 2</li>
            <li class="list-group-item">ตัวเลือก 3</li>
        </ul>
    </nav>

    <div class="page-main w-100">
        <!-- page-main-->
        <div class="page-overlay-bg"></div>
        <!-- ส่วนของการใช้งาน navbar-->
        <nav class="navbar navbar-light bg-warning">
            <!-- ปุมด้านซ้าย แสดงเมนู-->
            <button class="navbar-toggler border-0 px-0 open-l-sidenav" type="button">
                <i class="fas fa-bars cus-icon fa-fw py-1"></i>
            </button>
            <!--  ส่วนแสดงชื่อโปรเจ็ค หรือหัวข้อที่ต้องการ-->
            <!--  <a class="navbar-brand" href="#">Navbar</a>-->
            <!-- ปุมด้านขวา แสดงเมนู  -->
            <div class="btn-group">
                <button type="button" class="navbar-toggler border-0 px-2" onClick="$('#subnavbar').toggle()">
                    <i class="fas fa-search cus-icon py-1"></i>
                </button>
                <button type="button" class="navbar-toggler border-0 px-2">
                    <i class="fas fa-user cus-icon py-1"></i>
                </button>
            </div>
        </nav>
        <nav class="navbar navbar-light sticky-top collapse" id="subnavbar" style="background-color:#f9ffbc;">
            <form class="w-100">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-warning" type="button">
                            <i class="fas fa-search cus-icon py-1"></i>
                        </button>
                    </div>
                </div>
            </form>
        </nav>

        <div class="container-fluid m-0 p-0">
            <!--container-fluid-->
            <div class="row no-gutters px-1">
                <!--row-->
                <?php for($i=1;$i<=7;$i++){?>
                <div class="col-6 col-sm-4 col-md-3 bg-light px-1">
                    <a href="javascript:void(0);">
                        <div class="bg-warning pic_preview"
                            style="background-image:url('https://www.ninenik.com/images/4.jpg')">

                        </div>
                        <div class="bg-white mb-2 shadow-sm">
                            <div>หัวเรื่องรายการทดสอบ This is test title</div>
                            <div class="price">฿1,500</div>
                            <div class="discount_price">฿2,500 <span>-50%</span></div>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
            <!--row-->
        </div>
        <!--container-fluid-->

    </div><!-- page-main-->

    <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(function() {
        /*เมื่อปุ่มปิด หรือ เปิด เมนูด้านซ้ายถูกคลิก*/
        $(".close-l-sidenav,.open-l-sidenav").on("click", function() {
            var toggleWidth = ($(".l-sidenav").width() == 0) ? 250 : 0;
            $(".l-sidenav").width(toggleWidth);
            var toggleMarginLeft = toggleWidth; /*ให้ขยับส่วนของคลุมดำออกไปเท่ากับความกว้างของเมนูที่ขยับเข้ามา*/
            var toggleOverlayWidth = ($(".page-overlay-bg").width() == 0) ? "100%" : 0; /*ซ่อนหรือแสดงโดยการกำหนดค่าความกว้าง*/
            var fullHeight = $(".page-main").height(); /* ความสูงของเนื้อหา*/
            $(".page-overlay-bg").css("margin-left", toggleMarginLeft); /*ขยับพื้นที่คลุมดำตามการแสดงของเมนูด้านซ้าย*/
            $(".page-overlay-bg").height(fullHeight); /*ให้ความสูงของพื้นที่คลุมดำเท่ากับเนื้อหา*/
            $(".page-overlay-bg").width(toggleOverlayWidth); /*ให้ความกว้างของพื้นที่คลุมดำเท่ากับ 100% หรือ 0*/
        });
    });
    </script>
</body>

</html>