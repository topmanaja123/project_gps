<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Greenboxgps</title>

    <style>
    body {
        padding-top: 56px;
    }

    nav {
        margin-left: -10px;
        margin-right: -10px;
    }

    .font-mar {
        margin-left: 10px;
        margin-right: -10px;
    }

    .color-head-table {
        background-color: white;
    }

    .navbar-color.navbar-toggler {
        background-color: #46c837;
    }
    </style>
</head>

<body Onload="onLoad();">
    <?php
      require'cssAjs.php';
    ?>
    <div class="d-flex" id="wrapper">
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-dark bg-success fixed-top">
                <button class="navbar-toggler navbar-color mar-left" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <div class="form-row p-1" style="height : 5vh">
                        <div class="form-group font-mar">ค้นหา</div>
                        <div class="form-group col">
                            <input class="form-control" type="text" id="sc" name="sc" onkeyup="keySearch()"
                                placeholder="ทะเบียนรถ">
                        </div>
                    </div>
                    <br />
                    <table class="table table-bordered table-hover table-sm mb-0">
                        <thead>
                            <tr class="header color-head-table table-head">
                                <th width="40%">
                                    <div align="center">ทะเบียนรถ</div>
                                </th>
                                <th width="50%">
                                    <div align="center">เชื่อมต่อล่าสุด</div>
                                </th>
                                <th width="10%">
                                    <div align="center"><i class="far fa-tachometer-alt-fast"></i>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="table-wrapper-scroll-y my-custom-scrollbar " style="height : 50vh">
                        <table class="table table-bordered table-hover table-sm" id="myTable" style="overflow:hidden;">

                            <!-- body dynamic rows -->
                            <tbody id='myBody'>

                            </tbody>
                        </table>
                    </div>
                </div>
            </nav>
            <div class="col lockH marginMap">
                <div id="map" style="height : 100vh" class="marginMap"></div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>

</html>

<script src="app/map.js"></script>