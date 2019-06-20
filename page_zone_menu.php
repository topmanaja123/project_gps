<head>
  <?php //include('css.php') ?>
  <meta charset="utf-8">
  <title>Examples</title>
  <style>
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
#table-control {
  margin-top: : 10px;
}
#history_head {
  background-color: ;
}
#hr_1 {
    margin-top: 0rem;
    margin-bottom: 0rem;
    border: 0;
    border-top: 1px solid #333333;
}
#hr_2 {
    margin-top: -1rem;
    margin-bottom: 0rem;
    border: 0;
    border-top: 1px solid #333333;
}

  </style>
</head>

  <p></p>

<div class="row">
  <!-- table control -->
  <table id="table-control" class="table table-sm table-respondsive">
    <!-- <tr>
      <td>
        <div class="container">
          <div class="form-row">
            <div class="col-3 text-right">
              <span>อุปกรณ์</span>
            </div>
            <div class="col">
              <select class="form-control form-control-sm " id="simple-single-select">
                <option>ลอง1</option>
                <option>2อง1</option>
              </select>
            </div>
          </div>
        </div>

      </td>
    </tr> -->
    <!-- <tr>
      <td>
        <div class="container">
          <div class="form-row">
            <div class="col-3 text-right">
              <span>จากเวลา</span>
            </div>
            <div class="col">
              <input type="datetime-local" class=" form-control form-control-sm">
            </div>
          </div>
        </div>
      </td>
    </tr> -->
    <tr>
      <td>
        <div class="container">
          <div class="form-row text-right">
            <div class="col-md-4 offset-md-8">
              <button class="btn btn-success btn-sm" type="button" name="button">
                <i class="fas fa-plus"></i>
                เพิ่ม
              </button>
            </div>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="container">
          <div class="form-row">
            <div class="col-sm-2">
              <span>ค้นหา</span>
            </div>
            <div class="col-sm-6">
              <input type="text" class=" form-control form-control-sm">
            </div>
            <div class="col-sm-4">
              <button class="btn btn-info btn-sm btn-block" type="submit" name="button"><i class="fas fa-search"></i>ค้นหา</button>
            </div>
          </div>
        </div>
      </td>
    </tr>
  </table>
</div>

<hr  id="hr_1">

<div class="row">

  <!-- table list -->
  <table class="table table-bordered table-sm">
    <tr id="history_head">
      <td class="text-center"> <i class="far fa-flag"></i> </td>
      <td class="text-center"  style="width:60%"><i class="far fa-draw-polygon"> พื้นที่ </i> </td>
      <td class="text-center"> <i class="far fa-trash-alt"></i> </td>
    </tr>
  </table>
</div>
<!-- เส้นที่ 2  -->
<hr id="hr_2">

<!-- script  -->
<?php //include('js.php') ?>
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
