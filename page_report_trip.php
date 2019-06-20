<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <style media="screen">
    .select2-container--bootstrap4 .select2-selection {
      /* background-color: #fff; */
      /* outline: 0; */
      /* display: inline-block; */
      /* border: 1px solid #ced4da; */
      /* border-radius: .10rem; */
      /* width: 100%; */
      height: calc(1.8rem + 2px);
      padding: .200rem .50rem;
      line-height: 1.5;
      color: #495057;
    }
    #head-card {
      color: White;
      text-shadow: 2px 2px 5px black;
    }
    </style>
    <title></title>
  </head>
  <body>
    <p></p>
    <div class="card">
      <div class="card-header bg-success">
        <div class="text-center">
          <span id="head-card"> <strong>รายงานการเดินทาง</strong> </span>
        </div>
      </div>
      <div class="card-body">
        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="input1">อุปกรณ์</label>
              <select class="form-control form-control-sm " id="simple-single-select">
                <option>ลอง1</option>
                <option>2อง1</option>
              </select>
            </div>
            <div class="col">
              <label for="input1">แยกโดย</label>
              <select class="form-control form-control-sm ">
                <option>ลอง1</option>
                <option>2อง1</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-xs-12 col-sm">
              <label for="input1">จากเวลา</label>
              <input type="datetime-local" class="form-control form-control-sm" id="input1" placeholder="">
            </div>
            <div class="col-xs-12 col-sm">
              <label for="input1">ถึงเวลา</label>
              <input type="datetime-local" class="form-control form-control-sm" id="input1" placeholder="">
            </div>
          </div>
        </div>
        <div class="col-md-4 offset-md-4 text-center">
          <a href="?p=page_report&r=report_triplist" class="btn btn-info btn-block " role="button">ค้นหา</a>

          </a>

        </div>
      </div>
  </div>
  <!-- scrip select2 -->
  <script type="text/javascript">
    $("#simple-single-select, #simple-multiple-select, #input-group-single-select, #input-group-multiple-select").select2({
      width: "100%",
      theme: "bootstrap4",
      placeholder: "เลือกอุปกรณ์",
      allowClear: true
    });
    $("#disabled-single-select").select2({
      width: "100%",
      theme: "bootstrap4",
      disabled: true
    });
    $("#disabled-multiple-select").select2({
      width: "100%",
      theme: "bootstrap4",
      allowClear: true
    });
    $("#form-single-select, #form-multiple-select").select2({
      width: "100%",
      theme: "bootstrap4"
    });
  </script>
  <!-- /// scrip select2 -->

  </body>
</html>
