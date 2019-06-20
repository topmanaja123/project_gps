<head>
  <?php //include('css.php') ?>
  <meta charset="utf-8">
  <title>Examples</title>
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
#table-control {
  margin-top: : 10px;
}
#history_head {
  background-color: ;
}
  </style>
</head>

  <p></p>

<div class="row">
  <!-- table control -->
  <table id="table-control" class="table table-bordered table-sm">
    <tr>
      <td>
        <div class="container">
          <div class="form-row">
            <div class="col-3 text-right">
              <span>อุปกรณ์ :</span>
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
    </tr>
    <tr>
      <td>
        <div class="container">
          <div class="form-row">
            <div class="col-3 text-right">
              <span>จากเวลา :</span>
            </div>
            <div class="col">
              <input type="datetime-local" class=" form-control form-control-sm">
            </div>
          </div>
        </div>

      </td>
    </tr>
    <tr>
      <td>
        <div class="container">
          <div class="form-row">
            <div class="col-3 text-right">
              <span>ถึงเวลา :</span>
            </div>
            <div class="col">
              <input type="datetime-local" class=" form-control form-control-sm">
            </div>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="container">
          <div class="form-row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-info" type="button" name="button">
                <i class="fas fa-search"></i>
                ค้นหา
              </button>
            </div>
          </div>
        </div>

      </td>
    </tr>
  </table>

  <hr style="color:black;">
  <!-- table list -->
  <table class="table table-bordered table-sm">
    <tr id="history_head">
      <td class="text-center"> <i class="fas fa-check-circle"></i> </td>
      <td class="text-center"> <i class="fas fa-location-arrow"></i> </td>
      <td class="text-center"><i class="far fa-shipping-fast"></i> </td>
      <td class="text-center"> <i class="far fa-map-marked-alt"></i> </td>
      <td class="text-center"><i class="fas fa-history"></i> </td>
      <td class="text-center"> <i class="fas fa-ban"></i> </td>
    </tr>
  </table>

</div>


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
