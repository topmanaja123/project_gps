<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
    html,
    body {
        height: 100%;
        margin: 0;
    }

    nav {
        margin-left: -10px;
        margin-right: -10px;
    }

    .font-mar {
        margin-left: 10px;
        margin-right: -10px;
    }

    .wrapper {
        height: 100%;
        width: 100%;
        display: table;
    }

    .header,
    .content,
    .footer {
        display: table-row;
    }

    .header,
    .footer {
        background: silver;
    }

    .inner {
        display: table-cell;
    }

    .content .inner {
        height: 100%;
        position: relative;
        background: pink;
    }

    .scrollable {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        overflow: auto;
    }

    .navbar-toggler{
          font-size: 16px !important;
    }
    </style>
</head>

<body  Onload="onLoad();">
    <?php
require'cssAjs.php';
?>
    <div class="wrapper">

        <!-- Header  -->
        <div class="header">
        <div id="page-content-wrapper">
            <nav class="navbar navbar-dark bg-success fix-header ">

                <button class="navbar-toggler navbar-color mar-left btn-sm" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <div class="form-row p-3" style="height : 5vh">
                        <div class="form-group font-mar text-white align-self-center">ค้นหา</div>
                        <div class="form-group col ">
                            <input class="form-control form-control-sm" type="text" id="sc" name="sc"
                                onkeyup="keySearch()" placeholder="ทะเบียนรถ">
                        </div>
                    </div>
                    <br />
                    <table class="table table-bordered table-hover table-sm mb-0">
                        <thead>
                            <tr class="header table-head">
                                <th width="35%">
                                    <div align="center">ทะเบียนรถ</div>
                                </th>
                                <th width="50%">
                                    <div align="center">เชื่อมต่อล่าสุด</div>
                                </th>
                                <th width="15%">
                                    <div align="center"><i class="far fa-tachometer-alt-fast"></i>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="table-wrapper-scroll-y my-custom-scrollbar " style="height : 50vh">
                        <table class="table table-bordered table-sm" id="myTable" style="overflow:hidden;">

                            <!-- body dynamic rows -->
                            <tbody id='myBody'>

                            </tbody>
                        </table>
                    </div>
                </div>

            </nav>
        </div>
        </div>
        <!-- end Header  -->

        <!-- content -->
        <div class="content">
            <div class="inner">
                <div class="scrollable">
                    <div class="col lockH marginMap">
                        <div id="map" class="lockH"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end content -->

        <!-- footer -->
        <div class="footer">
            <div class="form-row">
            <button type="button" class="col btn-success">แสดง</button>
            <button type="button" class="col btn-info">55</button>
            <button type="button" class="col btn-danger">555</button>
            </div>
        </div>
        <!-- end footer -->
    </div>


</body>

</html>

<script src="app/map.js"></script>