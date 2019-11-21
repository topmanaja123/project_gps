<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/myStyle/table-fixed.css">
    <link rel="stylesheet" href="css/myStyle/realtime-style.css">
    <title>Document</title>
    <style>
    body {
        margin: 0;
        height: 100%;
        overflow: hidden;
    }
    </style>
    <script src="app/realtime.js"></script>
</head>

<body Onload="onLoad();">
    <div class="form-row m-0">
        <div class="col-4 marginMap">
            <form class="m-0">
                <div class="form-row margin-form mb-1 mt-1" style="height:10vh">
                    <div class="form-group mb-0 align-self-center">
                        <span class="fas fa-search"></span> ค้นหา</div>
                    <div class="form-group col mb-0 align-self-center">
                        <input class="form-control form-control-sm" type="text" id="sc" name="sc" onkeyup="keySearch()"
                            placeholder="ทะเบียนรถ" autocomplete='off'>
                    </div>
                </div>
            </form>
            <div class="form-row m-0">
                <table class="table table-striped table-fixed table-sm table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th class="col-sm-4">
                                <div align="center">ทะเบียนรถ</div>
                            </th>
                            <th class="col-sm-4">
                                <div align="center">เชื่อมต่อล่าสุด</div>
                            </th>
                            <th class="col-sm-2">
                                <div align="center">ความเร็ว</div>
                            </th>
                            <th class="col-sm-2">
                                <div align="center">น้ำมัน</div>
                            </th>
                        </tr>
                    </thead>
                    <!-- body dynamic rows -->
                    <tbody class="" id='myBody'>

                    </tbody>
                </table>
            </div>

        </div>

        <div class="col-6 lockH marginMap">
            <div id="map" class="marginMap"></div>
        </div>

    </div>
</body>

</html>
<!-- Map Leaflet -->
<script src="app/map.js"></script>