<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>
    

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    
</head>

<body>
    <?php 
    require'css.php';
    require'js.php';
    require_once('all_functions.php');
    ?>
    <div class="d-flex" id="wrapper">
        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-light bg-light border-bottom">

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <div class="form-row" style="height : 5vh">
                                <div class="form-group">ค้นหา</div>
                                <div class="form-group col">
                                    <input class="form-control" type="text" id="sc" name="sc" onkeyup="keySearch()"
                                        placeholder="ทะเบียนรถ">
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="style-3"
                                style="height : 91.5vh">
                                <table class="table table-bordered table-hover table-sm" id="myTable">
                                    <thead>
                                        <tr class="header">
                                            <th width="30%">
                                                <div align="center">ทะเบียนรถ</div>
                                            </th>
                                            <th width="auto">
                                                <div align="center">เชื่อมต่อล่าสุด</div>
                                            </th>
                                            <th>
                                                <div align="center"><i class="far fa-tachometer-alt-fast"></i>
                                                </div>
                                            </th>
                                            <th>
                                                <div align="center"><i class="fas fa-gas-pump"></i></div>
                                            </th>
                                        </tr>
                                    </thead>

                                    <!-- body dynamic rows -->
                                    <tbody id='myBody'>

                                    </tbody>
                                </table>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
            <!-- <div id="map" style="height : 100vh" class="marginMap"></div> -->
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="app/realtime.js"></script>
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>

<!-- <script src="app/map.js"></script> -->