<link rel="stylesheet" href="css/nav-realtime.css">

<!-- Header  -->
<div class="header">
    <div id="page-content-wrapper">
        <nav class="navbar navbar-dark bg-success fix-header ">
            <h5 class="text-white m-0">GREENBOXGPS</h5>
            <button class="navbar-toggler navbar-color btn-sm" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="fas fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="form-row p-3" style="height : 5vh">
                    <div class="form-group font-mar text-white align-self-center">ค้นหา</div>
                    <div class="form-group col ">
                        <input class="form-control form-control-sm" type="text" id="sc" name="sc" onkeyup="keySearch()"
                            placeholder="ทะเบียนรถ">
                    </div>
                </div>
                
                <br />
                <!-- header table  -->
                <table class="table table-bordered table-hover table-sm mb-0 m-0 p-0 table-h">
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

                <!-- list table  -->
                <div class="table-wrapper-scroll-y my-custom-scrollbar m-0 p-0" style="height : 50vh">
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