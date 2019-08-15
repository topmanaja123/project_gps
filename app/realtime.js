//รับค่าจาก getPositions.php
function getDataFromDb() {
    var sc = $("#sc").val();
  
    // console.log("Debug : " + sc);
    $.ajax({
      url: "./getPositionsT.php",
      type: "POST",
      data: {
        data: sc
      },
  
      success: function(result) {
        // console.log(result)
        var data2 = "";
        var obj = jQuery.parseJSON(result);
        if (obj != "") {
          //$("#myTable tbody tr:not(:first-child)").remove();
          $("#myBody").empty();
          markers.clearLayers();
          $.each(obj, function(key, val) {
            // console.log(devi_name);
            var tr =
              "<tr style='background-color : " + status(val["devicetime"]) + "'>";
            tr = tr + "<td id='" + val[""] + "' onclick='myPanto(" + val["devi_id"] +  "," +  val["lat"] + "," + val["lng"] + ")' style=cursor:pointer; >" +
              val["name"] + "</td>";
            tr = tr + "<td>" + dateTime(val["devicetime"]) + "</td>";
            tr = tr + "<td>" + val["speed"] + "</td>";
            tr = tr + "<td>" + "</td>";
            tr = tr + "</tr>";
            $("#myTable > tbody:last").append(tr);
  
            data2 = {
              id: val["id"],
              name: val["name"],
              uniqueid: val["uniqueid"],
              positionid: val["positionid"],
              // 'rfid_name': val["rfid_name"],
              // 'rfid_number': val["rfid_number"],
              devicetime: val["devicetime"],
              servertime: val["servertime"],
              fixtime: val["fixtime"],
              attributes: val["attributes"],
              lat: val["lat"],
              lng: val["lng"],
              speed: val["speed"],
              course: val["course"],
              // 'attributes':attributes,
              valid: val["valid"],
              // 'state': val["state"],
              photo: val["photo"]
            };
            dataRealtime(data2);
          });
          search();
        }
      }
    });
  }
  // setInterval(getDataFromDb, 5000); // 1000 = 1 second
  
  var markers = L.layerGroup();
  
  var markerX = {};
  // var dataArr = data2;
  var arrayData = [];
  
  var LeafIcon = L.Icon.extend({
    options: {
      iconSize: [100, 100],
      iconAnchor: [50, 50]
    }
  });
  var LeafIcon1 = L.Icon.extend({
    options: {
      iconSize: [22, 45],
      iconAnchor: [11, 22],
      popupAnchor: [0, -7]
    }
  });
  
  var myCustomColour = "	#7FFF00";
  
  var markerHtmlStyles = `
    background-color: ${myCustomColour};
    width: 20px;
    height: 20px;
    display: block;
    position: relative;
    border-radius: 3rem 3rem 0;
    transform: rotate(45deg);
    border: 1px solid #FFFFFF`;
  
  //realtime marker
  function dataRealtime(Data) {
    var dataArr = Data;
    // console.log(dataArr['course'])
  
    if (!markers.hasOwnProperty(dataArr["id"])) {
      var greenIcon = new LeafIcon1({
        iconUrl: "images/show/" + dataArr["photo"]
      });
  
      var myIcon = L.divIcon({
        className: "my-custom-pin",
      //   iconSize: [22, 45],
        iconAnchor: [11, 22],
        popupAnchor: [0, -7],
        html: `<span style="${markerHtmlStyles}" />`
      });
      // console.log(greenIcon);
  
      markerX[dataArr["id"]] = new L.Marker([dataArr["lat"], dataArr["lng"]], {
        icon: myIcon,
        rotationAngle: dataArr["course"],
        rotationOrigin: "center center"
      })
        .bindPopup(
          "รายละเอียด" +
            "<br>ทะเบียน : " +
            dataArr["name"] +
            "<br>ความเร็ว : " +
            dataArr["speed"] +
            "<br>เวลา : " +
            dataArr["devicetime"] +
            "<br>ตำแหน่ง : " +
            dataArr["lat"] +
            "," +
            dataArr["lng"]
        )
        .bindTooltip(dataArr["name"], {
          permanent: true,
          direction: "bottom",
          offset: [0, 20],
          interactive: false,
          opacity: 15,
          className: "myCSSClass"
        })
        .openTooltip();
      markerX[dataArr["id"]].previousLatLngs = [];
      markers.addLayer(markerX[dataArr["id"]]);
    } else {
      markerX[dataArr["id"]].previousLatLngs.push(
        markerX[dataArr["id"]].getLatLng()
      );
      markerX[dataArr["id"]].setLatLng([dataArr["lat"], dataArr["lng"]]);
    }
    markers.addTo(map);
  }
  
  // format date time
  function dateTime(dateT) {
    if (dateT == "0000-00-00 00:00:00") {
      return "NOT TIME";
    } else {
      var date = new Date(dateT);
      var day = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getFullYear();
      var Hours = date.getHours();
      var Minutes = date.getMinutes();
      var Seconds = date.getSeconds();
      var strTime = Hours + ":" + Minutes + ":" + Seconds;
      var strDate = day + "/" + month + "/" + year;
      return strDate + "&nbsp; &nbsp;" + strTime;
    }
  }
  
  //เปลี่ยนสี สถานะรถ offline & online
  function status(date) {
    if (date == "0000-00-00 00:00:00") {
      return "#FFB1B1";
    } else {
      var date1 = new Date(date);
      var date2 = new Date();
  
      var diff = date2.getTime() - date1.getTime();
  
      var msec = diff;
  
      var hh = Math.floor(msec / 1000 / 60 / 60);
      msec -= hh * 1000 * 60 * 60;
      var mm = Math.floor(msec / 1000 / 60);
      msec -= mm * 1000 * 60;
      var ss = Math.floor(msec / 1000);
      msec -= ss * 1000;
  
      if ((hh == "0" && mm >= "5") || (hh == "0" && mm >= "5") || hh > "0") {
        return "#FFB1B1";
      } else if ((hh == "0" && mm >= "2") || (hh == "0" && mm < "5")) {
        return "#FFFF8D";
      } else {
        return "#BDFF73";
      }
    }
  }
  
  //click panto to marker
  function myPanto(id, lat, lng) {
    map.setView([lat, lng], 16, {
      animate: true,
      noMoveStart: true
    });
  }
  
  // Realtime 10 Seconds
  function onLoad() {
    getDataFromDb();
    setTimeout("doLoop();", 10000);
  }
  
  function doLoop() {
    onLoad();
  }
  
  // click popup to canter
  map.on("popupopen", function(centerMarker) {
    var cM = map.project(centerMarker.popup._latlng);
    cM.y -=
      centerMarker.popup._container.clientHeight /
      map.setView(map.unproject(cM), 20, {
        markerZoomAnimation: true,
        animate: true
      });
  });
  
  // filter table
  function search() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("sc");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  