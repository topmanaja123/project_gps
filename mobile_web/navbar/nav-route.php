<link rel="stylesheet" href="css/nav-realtime.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../fontawesome/css/all.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
    integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
    crossorigin="" />
<link rel="stylesheet" href="../css/mystyle.css">
<link rel="stylesheet" href="../vendor/Lightpick/css/lightpick.css">
<link rel="stylesheet" href="css/map.css">

<!-- end css -->

<!-- js -->
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
    integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
    crossorigin=""></script>

<script src="../js/moment.js"></script>
<script src="../vendor/Lightpick/lightpick.js"></script>
<script src="../app/history.js"></script>


<?php
 require "../config.php";
 require "../all_functions.php";
 $sql = "SELECT `devices`.* FROM `devices`";
 $result = $conn->query($sql);
?>

<?php
    // date_default_timezone_set("Asia/Bangkok");
    if (isset($_POST['serach'])) {
        $dateRange = $_POST['dateRange'];
        $dateRangeArr = explode("-", $dateRange);

        $dateStart = trim($dateRangeArr['0']);
        $dateEnd = trim($dateRangeArr['1']);

        // Creating time from given date
        $dateStart = DateYMD($dateStart);
        $dateEnd = DateYMD($dateEnd);

        // // Creating new date format from that timestamp
        // $dateStart = date("Y-d-m", $dateStart);
        // // echo "--";
        // $dateEnd = date("Y-d-m", $dateEnd);

        echo $sqlPosition = "SELECT * FROM positions WHERE deviceid = $_POST[deviceid] AND fixtime BETWEEN '$dateStart' AND '$dateEnd'";

        //Query For List Position
        $resultPosition = $conn->query($sqlPosition);

        // Query For Marker
        $resultPositionLine = $conn->query($sqlPosition);
        $resultNums = $resultPosition->num_rows;

        $resultNums;
    }
    ?>
<style>
.btn-egg {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    background-color: #64da73;
}
</style>

<div class="header">
    <div id="page-content-wrapper">
        <nav class="navbar navbar-dark bg-success fix-header ">
            <h5 class="text-white m-0">GREENBOXGPS</h5>
            <button class="navbar-toggler navbar-color btn-sm" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="fas fa-bars"></span>
            </button>
            <!-- content in nav -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form action="" method="post">

                    <div class="form-group row m-0 mt-3 p-0">
                        <div class="form-group p-0 pr-2 col-4 text-white text-right align-self-center">
                            เลือกอุปกรณ์
                        </div>
                        <div class="form-group p-0 col-8 ">
                            <select class="form-control form-control-sm select2" style="width: 100%" name="deviceid" id="deviceid">
                            <option value="" disabled selected>---------เลือกอุปกรณ์---------</option>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                 
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row m-0 mt-0 p-0">
                        <div class="form-group p-0 pr-2 col-4 text-white text-right align-self-center">
                            เลือกวันที่
                        </div>
                        <div class="form-group p-0 col-8 mb-0">
                            <input class="form-control form-control-sm" type="text" name="dateRange" id="datepicker"
                                readonly>
                        </div>
                        <div class="form-group col-md-12 col-lg-12 text-center m-0 mt-0">
                            <button type="submit" name="serach" class="btn  btn-sm  btn-egg">ค้นหา</button>
                        </div>
                    </div>

                </form>
            </div>
        </nav>
    </div>
</div>


