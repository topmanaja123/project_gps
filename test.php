<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
     
    <br><br>
     
    <div class="container-fluid" style="margin:auto;width:65%;position:relative;height:300px;">      
<table class="table table-striped" style="width:500px;position:relative;">
      <thead>
       <tr class="bg-warning">
           <td colspan="4" class="text-center" id="place_show">
 
           </td>
       </tr>
        <tr class="bg-warning" style="display: table;width:100vw;">
          <td style="width:50px;">#</td>
          <td style="width:150px;">First Name</td>
          <td style="width:150px;">Last Name</td>
          <td style="width:150px;">Username</td>
        </tr>
      </thead>
<!--      ค่า top 114px คือค่าที่ต้องการยับจากด้านบนออกจากส่วนของ thead-->
      <tbody id="place_data" style="
        position: absolute;
        width: 100%;
        display: table-column-group;
        height: 200px;
        overflow: auto;
         ">
          <?php for($i=1;$i<20;$i++){?>
          <tr style="display: table;width:100%;">
          <td style="width:50px;"><?=$i?></td>
          <td style="width:150px;">Mark </td>
          <td style="width:150px;">Otto</td>
          <td style="width:150px;">@mdo</td>
        </tr>
          <?php } ?>
          <?php for($i=21;$i<51;$i++){?>
          <tr style="display: table;width:100%;">
          <td style="width:50px;"><?=$i?></td>
          <td style="width:150px;">Larry </td>
          <td style="width:150px;">the Bird</td>
          <td style="width:150px;">@twitter</td>
        </tr>
          <?php } ?>          
          <?php for($i=51;$i<81;$i++){?>          
        <tr style="display: table;width:100%;">
          <td style="width:50px;"><?=$i?></td>
          <td style="width:150px;">Jacob</td>
          <td style="width:150px;">Thornton</td>
          <td style="width:150px;">@fat</td>
        </tr>
          <?php } ?>
      </tbody>
    </table>        
    </div>   
     
    <br style="clear:both;">    
    <br style="clear:both;">   
 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
<script type="text/javascript">
$(function(){
 
    var objTR = $("#place_data").find("tr"); // อ้างอิง tr ใน tbody
     
    // เก็บตัวแปรค่าของข้อมูลของแถวแรก ในตารางส่วนขงอ tbody คอลัมน์ที่ 2 (ค่าในโปรแกรมเป็น 1)
    var dataTopic = objTR.eq(0).find("td:eq(1)").text();
    $("#place_show").html("Name: "+dataTopic); // แสดงค่าเริ่มต้น   
     
    // เมื่อ tbody มีการเลื่อน
    $("#place_data").scroll(function () {
        var pos_one=null; // ไว้เก็บตัวแปรตำแหน่ง tr ที่จะใช้งาน
        // วน tr ใน tbody
        objTR.each(function(i,v){
            var pos_val = objTR.eq(i).offset(); // เก็บค่าตำแหน่ง tr
            if(pos_val.top>=$("#place_data").offset().top){
                pos_one=i; // เก็บค่า index ของ tr
                return false; // ยกเลิกการวนลูป
            }
        });
        // เก็บค่าข้อมูลใน tr จากตำแหน่งที่ได้จากค่า pos_one โดยใช้ค่าในคอลัมน์ 2 (ในโค้ด 1)
        var dataTopic = objTR.eq(pos_one).find("td:eq(1)").text();
        $("#place_show").html("Name: "+dataTopic); // แสดงค่าข้อมูล
 
    });
     
});
</script>    
</body>
</html>