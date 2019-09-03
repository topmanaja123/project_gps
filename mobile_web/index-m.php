<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link href="../css/simple-sidebar.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="" />

    <link rel="stylesheet" href="../css/mystyle.css">
    <link rel="stylesheet" href="css/map.css">
   
    <!-- end css -->


    <!-- js -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>

    <!-- marker -->
    <script rel="stylesheet" src="../js/leaflet.rotatedMarker.js"></script>

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <!-- http://code.jquery.com/jquery-latest.js -->

    <script src="../js/leaflet-realtime.js"></script>

    <script src="app/realtime.js"></script>
    <!-- end js -->

    <style>
        html,
        body {
            height: 100%;
            width : 100%;
            margin: 0;
            overflow: hidden;
            position:fixed;
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

        .inner {
            display: table-cell;
        }

        .content .inner {
            height: 100%;
            position: relative;
            background: pink;
        }
    </style>
</head>

<body Onload="onLoad();">
    <div class="wrapper">

        <!-- navbar -->
        <?php
        $m=$_GET['m'];
        switch ($m) {
            case 'm-real': include'navbar/nav-realtime.php' ;break;
            
            default: include'navbar/nav-realtime.php' ;break;
        }
        
        ?>

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
        <?php
        require 'footer.php';
        ?>
    </div>


</body>

</html>

<script src="../app/map.js"></script>