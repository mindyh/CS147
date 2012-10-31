<!DOCTYPE html> 
<html>

<head>
	<title>Lab6 Optout | Map!</title> 
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="jquery.mobile-1.2.0.css" />
	<link rel="stylesheet" href="style.css" />
	<link rel="apple-touch-icon" href="appicon.png" />
	
	<script src="jquery-1.8.2.min.js"></script>
	<script src="jquery.mobile-1.2.0.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<	<script src="http://maps.google.com/maps/api/js?sensor=false"  type="text/javascript" ></script>
	<style>
		.success{
		} 
		
		#status{
		}
	</style>
</head> 


<body> 

<div data-role="page" id="mapPage">

	<div data-role="header" style="margin:0;">
	<h1>Map!</h1>
		<a href="#" data-icon="check" id="logout" class="ui-btn-right">Logout</a>
	</div><!-- /header -->

	<div data-role="content" style="padding:0;">
		<article id="status"></article>
		<script type="text/javascript">
			function success(position) {
				  var s = $('#status');
				  if (s.className == 'success') {
					return; 
				  } 
				  s.addClass("success");
				  
				  var mapcanvas = document.createElement('div');
				  mapcanvas.id = 'mapcanvas';
				  mapcanvas.style.position = 'absolute';
				  mapcanvas.style.height = '100%';
				  mapcanvas.style.width = '100%';
					
				  $('article').append(mapcanvas);
				  
				  var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				  var myOptions = {
					zoom: 15,
					center: latlng,
					mapTypeControl: false,
					navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
					mapTypeId: google.maps.MapTypeId.ROADMAP
				  };
				  var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);
				  
				  var infowindow = new google.maps.InfoWindow({
					content: "<b>Location</b> </br>" + latlng
				  });
				  
				  var marker = new google.maps.Marker({
					  position: latlng, 
					  map: map, 
					  title:"You are here!"
				  });
				  
				  google.maps.event.addListener(map, 'click', function(event) {
					latlng = event.latLng
					marker.setPosition(latlng);
					infowindow.open(map,marker);
				  });
			}
			
			function error(msg) {
			  var s = document.querySelector('#status');
			  s.innerHTML = typeof msg == 'string' ? msg : "failed";
			  s.className = 'fail';
			}  
 
		//	$("#mapPage").bind('pageinit', function() { 
				 if (navigator.geolocation) {
				   navigator.geolocation.getCurrentPosition(success, error);
				 } else {
				   error('not supported');
				 }
		//	});


			</script> 
		</div> <!--content-->
		
	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
		<div data-role="navbar" class="nav-glyphish-example" data-grid="b">
			<ul>
				<li><a href="index.php" id="home" data-icon="custom" >Home</a></li>
				<li><a href="login.php" id="key" data-icon="custom" >Login</a></li>
				<li><a href="map.php" id="map" data-icon="custom" class="ui-btn-active">Map</a></li>
			</ul>
		</div>
	</div> <!--footer-->	
</div>


</body>
</html>