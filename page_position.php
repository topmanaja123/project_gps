<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
        integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
        crossorigin="" />
    <link rel="stylesheet" href="css/mystyle.css">
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
        integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
        crossorigin=""></script>

    <!-- marker -->
    <script rel="stylesheet" src="js/leaflet.rotatedMarker.js"></script>

    <!-- realtime -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/leaflet-realtime.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <!-- realtimeJs  -->
    <script src="app/realtime.js"></script>
    <title>Document</title>
    <style>

    </style>
</head>



<body Onload="onLoad();">
    <div class="form-row row m-0">
        <div class="col-sm-6 col-md-5 col-lg-4 col-xl-3 lockH marginMap">
            <p>
                <form>
                    <div class="form-row margin-form" style="height : 5vh">
                        <div class="form-group mb-0 ">ค้นหา</div>
                        <div class="form-group col mb-0">
                            <input class="form-control" type="text" id="sc" name="sc" onkeyup="getDataFromDb()"
                                placeholder="ทะเบียนรถ">
                        </div>
                    </div>
                </form>
                <div class="table-wrapper-scroll-y my-custom-scrollbar" id="style-3" style="height : 91.5vh">
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
                                    <div align="center">ความเร็ว</div>
                                </th>
                                <th>
                                    <div align="center">น้ำมัน</div>
                                </th>
                            </tr>
                        </thead>

                        <!-- body dynamic rows -->
                        <tbody id='myBody'>

                        </tbody>
                    </table>
                </div>
        </div>

        <div class="col-sm-6 col-md-7 col-lg-8 col-xl-9 lockH marginMap">
            <div id="map" style="height : 100vh" class="marginMap"></div>
        </div>

    </div>
</body>

</html>
<!-- Map Leaflet -->
<script src="app/map.js"></script>