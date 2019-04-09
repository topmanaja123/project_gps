<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Document</title>
</head>
<script>
  
function getDataFromDb()
{
	$.ajax({ 
				url: "getPositions.php" ,
				type: "POST",
				data: 'result',
			  success:function(result) { 
				var obj = jQuery.parseJSON(result);
					if(obj != '')
					{
						  //$("#myTable tbody tr:not(:first-child)").remove();
						  $("#myBody").empty();
						  $.each(obj, function(key, val) {
									var tr = "<tr>";
									tr = tr + "<td>" + val["CustomerID"] + "</td>";
									tr = tr + "<td>" + val["Name"] + "</td>";
									tr = tr + "<td>" + val["Email"] + "</td>";
									tr = tr + "<td>" + val["CountryCode"] + "</td>";
									tr = tr + "<td>" + val["Budget"] + "</td>";
									tr = tr + "<td>" + val["Used"] + "</td>";
									tr = tr + "</tr>";
									$('#myTable > tbody:last').append(tr);
						  });
					}
        }
      });
  }
setInterval(getDataFromDb, 1000);   // 1000 = 1 second
</script>
<body>
<center>
<h1>My Web</h1>

<table width="600" border="1" id="myTable">
<!-- head table -->
<thead>
  <tr>
    <td width="91"> <div align="center">CustomerID </div></td>
    <td width="98"> <div align="center">Name </div></td>
    <td width="198"> <div align="center">Email </div></td>
    <td width="97"> <div align="center">CountryCode </div></td>
    <td width="59"> <div align="center">Budget </div></td>
    <td width="71"> <div align="center">Used </div></td>
  </tr>
</thead>
<!-- body dynamic rows -->
<tbody id="myBody"></tbody>
</table>

 <center>
</body>
</html>