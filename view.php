<html>
<head>
            <!-- HTTP 1.1 -->
        <meta http-equiv="Cache-Control" content="no-store"/>
        <!-- HTTP 1.0 -->
        <meta http-equiv="Pragma" content="no-cache"/>
        <!-- Prevents caching at the Proxy Server -->
        <meta http-equiv="Expires" content="0"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="icon" href="/images/favicon.ico"/>

    <title>  GPS TRACKING</title>
	<meta name="keywords" content=" ">

    <link rel="stylesheet" type="text/css" media="all" href="/styles/default/theme.css" />
    <link rel="stylesheet" type="text/css" media="print" href="/styles/default/print.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/styles/default/jquery-ui-1.8.16.custom.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/styles/default/timepicker.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/styles/default/usermap.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/styles/default/timepicker.css" />

    <script type="text/javascript" src="/scripts/global.js"></script>
    <script type="text/javascript" src="/scripts/jquery-1.7.1.js"></script>
	<script type="text/javascript" src="/scripts/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="/scripts/timepicker/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="/scripts/jquery.blockUI.js"></script>
    <script type="text/javascript" src="/scripts/google-analytics.js"></script>
    <script type="text/javascript" src="/scripts/jquery-plugins/jQueryRotate.2.2.js"></script>

    <link rel="stylesheet" type="text/css" media="all" href="/scripts/datatable/css/demo_page.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/scripts/openlayers/theme/default/style.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/scripts/openlayers/theme/default/google.css" />
 	<link rel="stylesheet" type="text/css" media="all" href="/scripts/datatable/css/demo_table.css" />
 	<link rel="stylesheet" type="text/css" media="all" href="/scripts/qtip/jquery.qtip.css" />
 	<link rel="stylesheet" type="text/css" media="all" href="/styles/tipsy.css" />



 	<script src="http://maps.google.com/maps/api/js?v=3.2&amp;sensor=false"></script>
 	<script src="../scripts/openlayers/OpenLayers.js"></script>
 	<script src="../scripts/openlayers/OpenStreetMap.js"></script>
 	<script src="../scripts/openlayers/google-v3.js"></script>
 	<script src="../scripts/usermap.js"></script>
 	<script src="../scripts/reports/reports.js"></script>
 	<script src="../scripts/geofences/geofences.js"></script>
 	<script src="../scripts/admin/admin.users.js"></script>
 	<script src="../scripts/admin/admin.panel.js"></script>
 	<script src="../scripts/admin/admin.devices.js"></script>

 	<script type="text/javascript" src="/scripts/jqplot/jquery.jqplot.min.js"></script>
	<script type="text/javascript" src="/scripts/jqplot/plugins/jqplot.barRenderer.min.js"></script>
	<script type="text/javascript" src="/scripts/jqplot/plugins/jqplot.pieRenderer.min.js"></script>
	<script type="text/javascript" src="/scripts/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
	<script type="text/javascript" src="/scripts/jqplot/plugins/jqplot.pointLabels.min.js"></script>
	<script type="text/javascript" src="/scripts/jqplot/plugins/jqplot.highlighter.min.js"></script>
	<script type="text/javascript" src="/scripts/jqplot/plugins/jqplot.cursor.min.js"></script>
	<script type="text/javascript" src="/scripts/jqplot/plugins/jqplot.pointLabels.min.js"></script>

	<script type="text/javascript" src="/scripts/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
	<script type="text/javascript" src="/scripts/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>

    <script type="text/javascript" src="/scripts/tracking/oltracking-map.js"></script>
    <script type="text/javascript" src="/scripts/tracking/toolbar-tracking.js"></script>
 	<script type="text/javascript" src="/scripts/datatable/js/jquery.dataTables.js"></script>
 	<script type="text/javascript" src="/scripts/qtip/jquery.qtip.js"></script>

	<script src="http://api.longdo.com/map/?key=andamantracking"></script>

	<script type="text/javascript">
		$(document).ready( function(){
			initMap();
			if (navigator.userAgent.indexOf('Firefox') != -1) {
				$("#date_from").attr("size", 11);
				$("#date_to").attr("size", 11);
			}
			$.blockUI.defaults.message = '<h1>' + getBlockUIMessage() + '</h1>';
			$.blockUI.defaults.css = {};



		});

		$(function() {
	  		$("#vert-draggable-div").draggable({
	  				axis: "x",
					containment: ([305, 0, $(document).width() - 240, $(document).height()]),
	  				stop: function(){
	  					resizeMapElements();
	  				},
	  				cursor: "e-resize"
	  		});
	 	});


		var disconnectStatus="ขาดการติดต่อ";
		var moveStatus="เคลื่อนที่";
		var staticStatus="หยุดนิ่ง";
		var idleStatus="จอดติดเครื่องยนต์";

	//alert(disconnectStatus);

	</script>
	<meta name="menu" content="UserMap"/>
</head>
<body>
    <div id="page">
        <div id="navigationPanel">
		    <div id="nav">
	           <div class="wrapper">
<span class="logo">

  <!--  <img src="../../images/logo.png" />-->

</span>
<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix"
	style="float: left; padding-top: 1px;">
			<li>
  			<a href="/tracking-map.html" title="ตำแหน่งปัจจุบัน" class="current"
  				>
  				<span class="horiz horiz-menu-height">ตำแหน่งปัจจุบัน</span>
  			</a>
  		</li>
    			<li class="menuItem">
	      	<a href="/history.html" title="เส้นทางย้อนหลัง"
	      		>
	      		<span class="horiz horiz-menu-height">เส้นทางย้อนหลัง</span>
	  		</a>
    	</li>
		<li class="menuItem">
	      	<a href="/reports.html" title="รายงาน"
	      		>
	      		<span class="horiz horiz-menu-height">รายงาน</span>
	  		</a>
    	</li>

				<!--menu:displayMenu name="Reports2Menu" /-->

				<!--menu:displayMenu name="Maintenance" /-->
  			<li class="menuItem">
	      	<a href="/notifications.html" title="การแจ้งเตือน"
	      		>
	      		<span class="horiz horiz-menu-height">การแจ้งเตือน</span>
	  		</a>
    	</li>
  			<li class="menuItem">
	      	<a href="/geozones.html" title="เขตพื้นที่"
	      		>
	      		<span class="horiz horiz-menu-height">เขตพื้นที่</span>
	  		</a>
    	</li>
</ul>
     </div>
	        </div><!-- end nav -->

	        <div id="top_right_menu" style="float: right">
	        	<table>
	        		<tr>
			<td id="language_cell" style="padding-right: 5px;">
								<span>
	        						<a href="/tracking-map-lang.html?locale=en"
	        							style=""
										title="English"
										onclick="return true"
										class="">
										<img src="../images/langs/en_US.png"/>
									</a>
								</span>
								</td>
	        					<td id="language_cell" style="padding-right: 30px;">
	        					<span>
	        						<a href="/tracking-map-lang.html?locale=th"
	        							style="border-radius: 4px; cursor:auto"
										title="Thai"
										onclick="return false"
										class="current_language">
										<img src="../images/langs/th_TH.png"/>
									</a>
								</span>
								</td>
			<td>
									<a href="/ajax/user-profile.html">
										<img src="../../images/user-icon-24.png">
									</a>
								</td>
								<td>
									<a href="/logout.jsp" style="padding-left: 15px;">
										<img src="../../images/exit-24.png">
									</a>
								</td>
		</tr>
	        	</table>
			</div>
        </div>

	    <div id="content">
	        <div id="main">
	            <table id="mainTable" style="width: 100%; height: 85%;" cellpadding="0" cellspacing="0">
	<tr>
		<td id="accordionTD" class="accordion">
			<div id="left-menu" style="width: 100%; overflow: auto;">
<style>
		.tracking_display td{
			padding : 3px;
		}
		.tracking_display .main_td {
			width : 300px;
		}
		.tracking_display th {
			padding: 3px;
			border-bottom: 1px solid black;
		}
</style>
<table class="tracking_display" id="mndevices-tbl" style="width: 100%">
	<thead>
	<tr>
		<th><input type="checkbox" id="device-view-head" style="cursor: pointer;" checked="checked"/></th>
		<th>&nbsp;</th>
		<th class="name-header"><img id="device-name-head" src="../../images/minicar-24.png"/></th>
<th class="txt-center device-fuel"><img id="device-fuel-head" src="../../images/fuel.png"/></th>
		<th class="txt-center device-speed">kmh</th>
		<th class="txt-center"><img id="device-motion-head" src="../../images/move-state.png"/></th>
		<th class="txt-center"><img id="device-gps-head" src="../../images/gps-icon.png"/></th>
		<th class="txt-center"><img id="device-tracking-head" src="../../images/devices.png"/></th>
		<!-- <th class="txt-center"><img id="device-cmd-head" src="../../images/command-16.png"/></th> -->
		<!-- <th class="txt-center"><img id="device-notif-head" src="../../images/warning-icon.png"/></th> -->
	<!-- 	<th><img id="device-veh-profile-head" src="../../images/pencil.png"/></th> -->
	</tr>
	</thead>
	<tbody>
	<tr id='devrow-11779'>
	<td style="display: none">
		</td>
		<td><input type="checkbox" id="devchk-11779" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-11779" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">0352503090559458 noom</td>
		<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-11779" class="devtrck" style="cursor: pointer;"/></td>
	</tr>
	<tr id='devrow-7562'>
		<td style="display: none">
		</td>
		<td><input type="checkbox" id="devchk-7562" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-7562" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">0359857080304694</td>
	<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-7562" class="devtrck" style="cursor: pointer;"/></td>
	</tr>

	<tr id='devrow-10358'>
		<td style="display: none">

		</td>
		<td><input type="checkbox" id="devchk-10358" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-10358" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">0359857080502933 noom</td>
	<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-10358" class="devtrck" style="cursor: pointer;"/></td>
	</tr>

	<tr id='devrow-14567'>
		<td style="display: none">

		</td>
		<td><input type="checkbox" id="devchk-14567" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-14567" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">0359857081301947(ทดสอบแรงดันไฟรถปูน)</td>
		<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-14567" class="devtrck" style="cursor: pointer;"/></td>
	</tr>
	<tr id='devrow-5809'>
		<td style="display: none">
		</td>
		<td><input type="checkbox" id="devchk-5809" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-5809" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">863835027879282(test data)</td>
		<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-5809" class="devtrck" style="cursor: pointer;"/></td>
	</tr>
	<tr id='devrow-4877'>
		<td style="display: none">
		</td>
		<td><input type="checkbox" id="devchk-4877" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-4877" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">Accord</td>
	<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-4877" class="devtrck" style="cursor: pointer;"/></td>
	</tr>

	<tr id='devrow-12998'>
		<td style="display: none">

		</td>
		<td><input type="checkbox" id="devchk-12998" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-12998" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">Honda waveน้ำเงิน-ป้ายแดง</td>
		<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-12998" class="devtrck" style="cursor: pointer;"/></td>
	</tr>

	<tr id='devrow-13002'>
		<td style="display: none">

		</td>
		<td><input type="checkbox" id="devchk-13002" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-13002" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">NV- สีเขียว  อาร์ม</td>
		<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-13002" class="devtrck" style="cursor: pointer;"/></td>
	</tr>
	<tr id='devrow-14312'>
		<td style="display: none">
		</td>
		<td><input type="checkbox" id="devchk-14312" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-14312" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">Vigo-9768(T333)</td>
		<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-14312" class="devtrck" style="cursor: pointer;"/></td>
	</tr>
	<tr id='devrow-6869'>
		<td style="display: none">
		</td>
		<td><input type="checkbox" id="devchk-6869" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-6869" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">Wave-19-497</td>
		<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-6869" class="devtrck" style="cursor: pointer;"/></td>
	</tr>
	<tr id='devrow-16691'>
		<td style="display: none">
		</td>
		<td><input type="checkbox" id="devchk-16691" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-16691" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">กข-1529 (เสี่ยว)</td>
		<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-16691" class="devtrck" style="cursor: pointer;"/></td>
	</tr>
	<tr id='devrow-14745'>
		<td style="display: none">
		</td>
		<td><input type="checkbox" id="devchk-14745" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-14745" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">ญค-7549 (อั๋น)</td>
		<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-14745" class="devtrck" style="cursor: pointer;"/></td>
	</tr>

	<tr id='devrow-15316'>
		<td style="display: none">
		</td>
		<td><input type="checkbox" id="devchk-15316" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-15316" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">บห-6032 (พี่ภู)</td>
		<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-15316" class="devtrck" style="cursor: pointer;"/></td>
	</tr>
	<tr id='devrow-7675'>
		<td style="display: none">
		</td>
		<td><input type="checkbox" id="devchk-7675" class="devcheck" checked="checked"/></td>
		<td class="connection-state"><img src="../../images/u_offline.gif"/></td>
		<td id="devname-7675" class="main_td" style="cursor: pointer;"
			canEditVehProfile="true" canSendCmds="true">เร็ด</td>
		<td class="fuel-level device-fuel" style="text-align: right;">0.0</td>
		<td class="movement-state device-speed" style="text-align: right;">0.0</td>
		<td class="motion-state" style="text-align: right;"><img class="motion-state-img" src="../../images/state-stop-3.png"/></td>
		<td class="gps-state" style="cursor: pointer;">
			<div>
				<img class="gps-bar-1" src="../../images/gps-low.png"/>
				<img class="gps-bar-2" src="../../images/gps-low.png"/>
			</div>
		</td>
		<td><input type="checkbox" id="devtrck-7675" class="devtrck" style="cursor: pointer;"/></td>
	</tr>

	</tbody>
</table>
		    </div>
		</td>
		<td id="draggingCell">
			<div id="vert-draggable-div" class="ui-widget-content" style="cursor: e-resize; position: relative">
				<img id="vert-separator" src="../../images/draggable/vert-separator.png">
			</div>
		</td>
		<td style="vertical-align: top;" id="mapTableTD" >
			<div id="map"></div>
		</td>
	</tr> <!-- map -->
</table>

<div id="settings-panel" title="Settings panel" style="display: none">
</div>
<div id="reports-panel" title="Reports panel" style="display: none">
</div>
<div id="admin-panel" title="Admin panel" style="display: none">
</div>
<div id="notifier-panel" title="Notifier panel" style="display: none">
</div>
<div id="geofence-panel" title="Geofence panel" style="display: none">
</div>

<div id="device-extinfo" title="Basic dialog" style="display:none;" class="device-popup">
	<a href="#"></a>
	<a id="popup-dialog-close" href="#" class="ui-dialog-titlebar-close ui-corner-all" style="top: 0%; padding: 0px 0px 0px 0px; margin: 0px 0 0 0; z-index: 1002;"><span class="ui-icon ui-icon-closethick">close</span></a>
	<div id="tabs-extinfo">
		<ul>
			<li><a href="#tab-device-summary">รายงานสถานะ</a></li>
			<li><a href="#additional-actions">คำสั่ง</a></li>
			<li><a href="#vehicle-profile">โปรไฟล์</a></li>
			<!-- li><a href="#tab-geo-fence">แสดงผลที่อยู่</a></li-->
		</ul>
		<div id="tab-device-summary" class="popup-tab-content">
			<table>
					<tr>
						<td class="bottom-border popup-label">ชื่ออุปกรณ์ :</td>
						<td class="bottom-border" id="dash-vehicle"></td>
					</tr>
					<tr>
						<td class="bottom-border popup-label">ข้อมูลเมื่อเวลา :</td>
						<td class="bottom-border" id="dash-lastmessage"></td>
					</tr>
					<tr>
						<td class="bottom-border popup-label">เวลารับข้อมูล :</td>
						<td class="bottom-border" id="dash-lastmessage-gsm"></td>
					</tr>
					<tr>
						<td class="bottom-border popup-label">สถานะ :</td>
						<td class="bottom-border" id="dash-motionstate"></td>
					</tr>
					<tr>
						<td class="bottom-border popup-label">ความเร็ว :</td>
						<td class="bottom-border" id="dash-speed"></td>
					</tr>
					<tr>
						<td class="bottom-border popup-label">เลขไมล์ :</td>
						<td class="bottom-border" id="dash-odometer"></td>
					</tr>
					<tr>
						<td class="bottom-border popup-label">สถานะเครื่องยนต์ :</td>
						<td class="bottom-border" id="dash-ignition"></td>
					</tr>
					<tr class="dash-fuel-tr" style="display: none;">
						<td class="bottom-border popup-label">ระดับน้ำมัน :</td>
						<td class="bottom-border" id="dash-fuel"></td>
					</tr>
					<tr class="dash-temp-tr" style="display: none;">
						<td class="bottom-border popup-label">อุณหภูมิ :</td>
						<td class="bottom-border" id="dash-temp"></td>
					</tr>
					<tr>
						<td class="bottom-border popup-label">สถานที่ :</td>
						<td class="bottom-border" id="dash-location"></td>
					</tr>
					<tr>
						<td class="bottom-border popup-label">พิกัด</td>
						<td class="bottom-border" id="dash-latlon"></td>
					</tr>
					<tr class="dash-satellites-tr">
						<td class="bottom-border popup-label">GSM/GPS</td>
						<td class="bottom-border" id="dash-satellites"></td>
					</tr>
					<tr class="dash-driverId-tr">
						<td class="bottom-border popup-label">คนขับ</td>
						<td class="bottom-border" id="dash-driverId"></td>
					</tr>
					<tr class="dash-carpower-tr" >
						<td class="bottom-border popup-label">แรงดันไฟรถ</td>
						<td class="bottom-border" id="dash-carpower"></td>
					</tr>

					<tr class="tr-dash-ac" >
						<td class="bottom-border popup-label">A/C state</td>
						<td class="bottom-border" id="dash-ac"></td>
					</tr>
					<tr class="tr-dash-pto" style="display: none">
						<td class="bottom-border popup-label">PTO state</td>
						<td class="bottom-border" id="dash-pto"></td>
					</tr>
					<tr class="tr-dash-door" style="display: none">
						<td class="bottom-border popup-label">Door state</td>
						<td class="bottom-border" id="dash-door"></td>
					</tr>
					<tr >
						<td class="bottom-border popup-label">ชาร์ตไฟ</td>
						<td class="bottom-border" id="dash-isCharge"></td>
					</tr>
					<tr >
						<td class="bottom-border popup-label">วันหมดอายุ</td>
						<td class="bottom-border" id="dash-expireDate"></td>
					</tr>
				</table>
		</div><!-- End of device summary -->
		<div id="additional-actions" class="popup-tab-content">
		</div>
		<div id="vehicle-profile" class="popup-tab-content">
		</div>

		<!-- div id="tab-geo-fence" class="popup-tab-content">
		<tr>
						<td class="bottom-border popup-label">สถานะเครื่องยนต์ :</td>
						<td class="bottom-border" id="dash-ignition"></td>
					</tr>
		</div-->
	</div>
</div>
<div id="replay-toolbar" title="Replay toolbar" style="display:none">
	<div id="replay-slider"></div>
	<div id="amount" style="padding-top: 5px">delay 1 secs</div>

	<div id="check-replay" style="padding-top: 10px">
		<input type="checkbox" id="replay-track" checked="checked" /><label id="replay-track-lbl" for="replay-track"><img src="../../images/pause-16.png" /></label>
		<!--  <input type="checkbox" id="pause-track"/><label id="pause-track-lbl" for="pause-track"><img src="../../images/pause-16.png" /></label> -->
		<input type="checkbox" id="rinsight-track" checked="checked"/><label  id="rinsight-track-lbl" for="rinsight-track"><img src="../../images/eyes-16.png" /></label>
		<!--  <input type="checkbox" id="pushpin-track" checked="checked"/><label id="pushpin-track-lbl" for="pushpin-track"><img src="../../images/pushpin.png" /></label> -->
	</div>
</div>
<div id="view-map" title="Map" style="display: none"></div>

<span id="country"    style="display:none"></span>
<span id="centre-lat" style="display:none"></span>
<span id="centre-lon" style="display:none"></span>
<span id="ismobile"   style="display:none">false</span>
<script type="text/javascript">
	$(document).ready(function(){
		$('input#button-add-sdata').click(function(e){
			addSensorParameter();
		});
		$(".delete-sdata").live('click', function(e){
			$(this).parent().parent().remove();
		});
	});
</script>
<div id="sensor-form" title="Add new sensor" style="display:none">
	<input id="device_input_id" name="device_input_id" type="hidden">
	<div style="padding-top:10px">
		<table>
			<tbody>
				<tr>
					<td><label class="desc">Device input</label></td>
					<td><select id="deviceInput" name="deviceInput" class="text medium" style="width: 150px;"></select></td>
				</tr>
				<tr>
					<td><label class="desc">Sensor type</label></td>
					<td><select id="deviceSensor" name="deviceSensor" class="text medium" style="width: 150px;"></select></td>
				</tr>
				<tr id="row-imps-liter" style="display:none">
					<td><label class="desc">Imps</label></td>
					<td><input id="imps-liter" name="imps-liter" type="text" maxlength="25"></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="sensor-datas" style="padding-top:10px; display: none;">
		<div style="display: block">
			<div style="display: inline-block">
				<label class="desc">Key</label>
			</div>
			<div style="display: inline-block;">
				<input id="sensor-key" name="sensor-key" type="text" maxlength="15" style="width: 100px;">
			</div>
			<div style="display: inline-block">
				<label class="desc">Value</label>
			</div>
			<div style="display: inline-block;">
				<input id="sensor-value" name="sensor-value" type="text" maxlength="15" style="width: 100px;">
			</div>
			<div style="display: inline-block">
				<input type="submit" class="button" id="button-add-sdata" value="Add"/>
			</div>

		</div>
		<table id="tbl-sensor-props" cellpadding="0" cellspacing="0" border="0" class="display">
			<thead>
			<tr>
				<th>Key</th>
				<th>Value</th>
				<th>Delete</th>
			</tr>
			</thead>

			<tbody>
			</tbody>
		</table>
	</div>
</div><!-- End of sensor form -->
<div id="relay-form" title="Add new relay" style="display:none">
	<input id="device_output_id" name="device_output_id" type="hidden">
	<div style="padding-top:10px">
		<table>
			<tbody>
				<tr>
					<td><label class="desc">Device output</label></td>
					<td><select id="deviceOutput" name="deviceOutput" class="text medium" style="width: 150px;"></select></td>
				</tr>
				<tr>
					<td><label class="desc">Relay type</label></td>
					<td><select id="deviceRelay" name="deviceRelay" class="text medium" style="width: 150px;"></select></td>
				</tr>
			</tbody>
		</table>
	</div>
</div><!-- End of relay form -->
<script type="text/javascript">


function getVoltHigh(){
	return '{0} {2} แรงดันไฟตอนนี้ {7} โวลต์เวลา {3} สถานที่ {4}  http://maps.google.com/maps?f=q&q={5}&z=16';
}

function getVoltLow(){
	return '{0} {2} แรงดันไฟตอนนี้ {7} โวลต์ เวลา {3} สถานที่ {4}  http://maps.google.com/maps?f=q&q={5}&z=16';
}

function getEnginOverHeat(){
	return '{0} {2} เวลา {3} สถานที่ {4}  http://maps.google.com/maps?f=q&q={5}&z=16';
}

function getExternalPowerTemplate(){
	return '{0} มีการใช้แบตสำรองจาก GPS เมื่อ {3} สถานที่ {4} http://maps.google.com/maps?f=q&q={5}&z=16';
}
function getSOSTemplate(){
	return 'อุปกรณ์ {0} ส่งสัญญาณ SOS เมื่อ {3}. จากสถานที่ {4} พิกัด http://maps.google.com/maps?f=q&q={5}&z=16';
}
function getConnLoss(){
	return 'ไม่สามารถเชื่อมต่อกับอุปกรณ์  {0} ได้';
}
function getGPSLoss(){
	return '{0} ไม่สามารถระบุพิกัดจากดาวเทียมได้';
}
function getOverSpeed(){
	return 'รถยนต์ {0} เคลื่อนที่ด้วยความเร็วเกิน {2} ที่ {3}. รถยนต์เคลื่อนที่ด้วยความเร็ว {6} จากสถานที่ {4}, พิกัด http://maps.google.com/maps?f=q&q={5}&z=16';
}
function getMaintenance(){
	return 'แจ้งเตือนการซ่อมบำรุงสำหรับ  {0}';
}
function getIdle(){
	return 'แจ้งเตือนการจอดรถยนต์ {0} โดยไม่ดับเครื่อง เวลา {3} สถานที่ {4} พิกัด http://maps.google.com/maps?f=q&q={5}&z=16 เป็นเวลา {7}';
}
function getGeofence(){
	return 'อุปกรณ์ {0} ได้มีการผ่านเข้า/ออกจากพื้นที่ {1} เมื่อเวลา {3}. ขณะนี้  อุปกรณ์อยู่ที่ {4} พิกัด http://maps.google.com/maps?f=q&q={5}&z=16';
}
function getIoTemplate(){
	return 'แจ้งเตือนการทำงานของอุปกรณ์เสริม {0} ';
}
function getAlertTypeLbl(){
	return 'Notification Type';
}
function getAlertVehicleLbl(){
	return 'Vehicle';
}
function getAlertDateLbl(){
	return 'Date';
}
function getAlertMsgLbl(){
	return 'Message';
}
function getAlertShowLbl(){
	return 'Show on map';
}
function getAlertGotoLbl(){
	return 'Go to alert';
}
function getAlertCloseLbl(){
	return 'Close alert';
}
function getCantDRepl(){
	return 'userMap.message.cantdrepl';
}
function getBlockUIMessage(){
	return 'Please wait ...';
}
function getMonitoringViewLbl(){
	return 'แสดงบนแผนที่';
}
function getMonitoringDeviceNameLbl(){
	return 'ชื่ออุปกรณ์';
}
function getMotionStateLbl(){
	return 'สถานการณ์ปัจจุบัน';
}
function getMonitoringTrackingLbl(){
	return 'แสดงเส้นทางการวิ่ง';
}
function getMonitoringAdmenuLbl(){
	return 'menu เสริม';
}
function getMonitoringGPSStateLbl(){
	return 'GPS state';
}
function getMonitoringConnOffLbl(){
	return 'ขาดการติดต่อ';
}
function getMonitoringConnOnLbl(){
	return 'เชื่อมต่อปรกติ';
}
function getMonitoringMotionState1Lbl(){
	return 'รถยนต์เคลื่อนที่, เครื่องยนต์ทำงาน';
}
function getMonitoringMotionState2Lbl(){
	return 'รถยนต์เคลื่อนที่, เครื่องยนต์ไม่ทำงาน';
}
function getMonitoringMotionState3Lbl(){
	return 'รถยนต์เคลื่อนที่, ขาดการติดต่อ';
}
function getMonitoringMotionState4Lbl(){
	return 'จอด, เครื่องยนต์ทำงาน';
}
function getMonitoringMotionState5Lbl(){
	return 'จอด, เครื่องยนต์ไม่ทำงาน';
}
function getMonitoringMotionState6Lbl(){
	return 'จอด, ขาดการติดต่อ';
}
function getPopupDeviceLbl(){
	return 'อุปกรณ์';
}
function getPopupTimeLbl(){
	return 'ณ.เวลา';
}
function getPopupStaticLbl(){
	return 'Static';
}
function getPopupSpeedLbl(){
	return 'Speed';
}
function getPopupAddressLbl(){
	return 'Address';
}
function getDashboardActionsViewVehicle(){
	return 'แสดงชื่อ';
}
function getDashboardActionsCommands(){
	return 'ส่งคำสั่งไปยังรถ';
}
function getDashboardActionsNotifications(){
	return 'ดูการแจ้งเตือน';
}

function getDeviceNameReqError(){
	return 'โปรดระบุชื่ออุปกรณ์';
}

function getDeviceNameNotuniqueError(){
	return 'ชื่ออุปกรณ์ไม่สามารถซ้ำกันได้';
}

function getMobileDeviceDetails(){
	return 'Device Details';
}

function getMobileDeviceName(){
	return 'Name';
}

function getMobileDeviceDetail(){
	return 'Detail';
}

function getMobileDeviceGSM(){
	return 'GSM';
}

function getMobileDeviceGPS(){
	return 'GPS';
}

function getMobileDeviceStatus(){
	return 'Status';
}

function getMobileDeviceSpeed(){
	return 'Speed';
}

function getMobileDeviceLocation(){
	return 'Location';
}

function getMobileDeviceLatitude(){
	return 'Latitude';
}

function getMobileDeviceLongitude(){
	return 'Longitude';
}

</script>
	        </div>
	    </div>

    </div>
</body>
</html>
