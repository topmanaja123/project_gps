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
          <span id="head-card"> <strong>รายละเอียด</strong> </span>
        </div>
      </div>
    <div class="container">
      <p></p>
  		<table id="table_id" class="display">
  			<thead>
  				<tr>
            <th width="1%"><input type="checkbox" name="allbox" id="activate" onchange="un_check()"></th>
  					<th>ลำดับที่</th>
  					<th>เริ่มเมื่อเวลา</th>
  					<th>สิ้นสุดเมื่อเวลา</th>
  					<th>รวมเวลา</th>
  					<th>ระยะทาง</th>
            <th>เริ่มการเดินทางที่</th>
  					<th>สิ้นสุดการเดินทางที่</th>
  					<th>การแจ้งเตือน</th>
  				</tr>
  			</thead>
  			<tbody id="showtrip">
          <tr>
            <th><center><input type="checkbox" name="checkbox[]" id="checkbox[]" onchange="un_check()"></th>
            <td>top1</td>
            <td>za</td>
            <td>na</td>
            <td>ja</td>
            <td>55</td>
            <td>55</td>
            <td>55</td>
            <td>66</td>
          </tr>
          <tr>
            <th><center><input type="checkbox" name="checkbox[]" id="checkbox[]" onchange="un_check()"></th>
            <td>top2</td>
            <td>za2</td>
            <td>na2</td>
            <td>ja2</td>
            <td>552</td>
            <td>552</td>
            <td>552</td>
            <td>662</td>
          </tr>
          <tr>
            <th><center><input type="checkbox" name="checkbox[]" id="checkbox[]" onchange="un_check()"></th>
            <td>top2</td>
            <td>za2</td>
            <td>na2</td>
            <td>ja2</td>
            <td>552</td>
            <td>552</td>
            <td>552</td>
            <td>662</td>
          </tr>
          <tr>
            <th><center><input type="checkbox" name="checkbox[]" id="checkbox[]" onchange="un_check()"></th>
            <td>top2</td>
            <td>za2</td>
            <td>na2</td>
            <td>ja2</td>
            <td>552</td>
            <td>552</td>
            <td>552</td>
            <td>662</td>
          </tr>

  			</tbody>
  		</table><br>
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
