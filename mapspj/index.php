<!DOCTYPE html>
<html>
    <head>
        <link href='fonts.googleapis.com/css.css' rel='stylesheet' type='text/css'>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Find GPS Coordinates for any address | Find any address from its GPS coordinates | Get Latitude and Longitude of GPS location | Map coordinates">
        <title>GPS coordinates Google Maps, latitude and longitude</title>
                    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
            <link rel="stylesheet" href="css/sticky-footer-navbar.css" type="text/css" />
            <link rel="stylesheet" href="css/gps-coordinates.css" type="text/css" />
              <link rel="icon" type="image/x-icon" href="../img/logo.ico" />
        
        
                <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="/js/html5shiv.js"></script>
        <script src="/js/respond.min.js"></script>

        <![endif]-->
                
        <script type="text/javascript" src="maps.googleapis.com/maps/api/js.JS"></script>
<script>
var geocoder;
  var map;
  var infowindow = new google.maps.InfoWindow();
  var marker = null;
  var elevator;
  
  function initialize() {
    var input = document.getElementById('address');
    var options = {
    };
    autocomplete = new google.maps.places.Autocomplete(input, options);  
    
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-7.299812, 112.448502);  <!-- mulyorejo surabaya
    var myOptions = {
      zoom: 10,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    elevator = new google.maps.ElevationService();
    bookUp("Mulyorejo Surabaya", -7.299812, 112.448502);		<!-- mulyorejo surabaya
    
    if(navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(function(position) {
        var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	marker = new google.maps.Marker({
            map: map,
            position: pos
        });
        map.setCenter(pos);
	
        geocoder.geocode({'latLng': pos}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
              if (marker != null) marker.setMap(null);
              marker = new google.maps.Marker({
                  position: pos,
                  map: map
              });
              infowindow.setContent('<div id="info_window"><strong>Geolocation :</strong> <span id="geocodedAddress">' + results[0].formatted_address + '</span><br/><strong>Latitude :</strong> ' + Math.round(position.coords.latitude*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(position.coords.longitude*1000000)/1000000 + '<br/><br/><span id="altitude"><button type="button" class="btn btn-primary" onclick="getElevation()">Get Altitude</button></span>' + bookmark() + '</div>');
              document.getElementById("latitude").value=position.coords.latitude.toFixed(6);
              document.getElementById("longitude").value=position.coords.longitude.toFixed(6);
              document.getElementById("address").value=results[0].formatted_address;
              bookUp(results[0].formatted_address, position.coords.latitude, position.coords.longitude);
              infowindow.open(map, marker);
            }
          } else {
              if (marker != null) marker.setMap(null);
              marker = new google.maps.Marker({
                  position: pos,
                  map: map
              });
              infowindow.setContent('<div id="info_window"><strong>Geolocation :</strong> <span id="geocodedAddress">' + 'No resolved address' + '</span><br/><strong>Latitude :</strong> ' + Math.round(position.coords.latitude*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(position.coords.longitude*1000000)/1000000 + '<br/><br/><span id="altitude"><button type="button" class="btn btn-primary" onclick="getElevation()">Get Altitude</button></span>' + bookmark() + '</div>');
              document.getElementById("latitude").value=position.coords.latitude.toFixed(6);
              document.getElementById("longitude").value=position.coords.longitude.toFixed(6);
              document.getElementById("address").value="No resolved address";
              bookUp("No resolved address", position.coords.latitude, position.coords.longitude);
              infowindow.open(map, marker);
          }
        });

          }, function() {
	marker = new google.maps.Marker({
            map: map,
            position: latlnginit
        });
	infowindow.setContent('Geolocation error.');
	infowindow.open(map, marker);
            
          });
    }
    else
    {
    }
    google.maps.event.addListener(map, 'click', codeLatLngfromclick);
  }

  function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
	if (marker != null) marker.setMap(null);
	marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
	latres = results[0].geometry.location.lat();;
	lngres = results[0].geometry.location.lng();
        infowindow.setContent('<div id="info_window">' + document.getElementById("address").value + '<br/><strong>Latitude :</strong> ' + Math.round(latres*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(lngres*1000000)/1000000 + '<br/><br/><span id="altitude"><button type="button" class="btn btn-primary" onclick="getElevation()">Get Altitude</button></span>' + bookmark() + '</div>'  );
        infowindow.open(map, marker);
	document.getElementById("latitude").value=latres.toFixed(6);
	document.getElementById("longitude").value=lngres.toFixed(6);
        bookUp(document.getElementById("address").value, latres, lngres);
        ddversdms();
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
  
  function codeLatLng(origin) {
    var lat = parseFloat(document.getElementById("latitude").value) || 0;
    var lng = parseFloat(document.getElementById("longitude").value) || 0;
    var latlng = new google.maps.LatLng(lat, lng);
    if (origin==1) ddversdms();
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
	  if (marker != null) marker.setMap(null);
	  marker = new google.maps.Marker({
              position: latlng,
              map: map
          });
          infowindow.setContent('<div id="info_window">' + results[0].formatted_address + '<br/><strong>Latitude :</strong> ' + Math.round(lat*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(lng*1000000)/1000000 + '<br/><br/><span id="altitude"><button type="button" class="btn btn-primary" onclick="getElevation()">Get Altitude</button></span>' + bookmark() + '</div>');
          infowindow.open(map, marker);
	  document.getElementById("address").value=results[0].formatted_address;
          bookUp(document.getElementById("address").value, lat, lng);
        }
      } else {
	  if (marker != null) marker.setMap(null);
	  marker = new google.maps.Marker({
              position: latlng,
              map: map
          });
          infowindow.setContent('<div id="info_window">' + 'No resolved address' + '<br/><strong>Latitude :</strong> ' + Math.round(lat*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(lng*1000000)/1000000 + '<br/><br/><span id="altitude"><button type="button" class="btn btn-primary" onclick="getElevation()">Get Altitude</button></span>' + bookmark() + '</div>');
          infowindow.open(map, marker);
	  document.getElementById("address").value='No resolved address';
          bookUp(document.getElementById("address").value, lat, lng);
	alert("Geocoder failed due to: " + status);
      }
    });
    map.setCenter(latlng);
  }
  
  function codeLatLngfromclick(event) {
    var lat = event.latLng.lat();
    var lng = event.latLng.lng();
    var latlng = event.latLng;
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
	  if (marker != null) marker.setMap(null);
	  marker = new google.maps.Marker({
              position: latlng,
              map: map
          });
          map.setCenter(latlng);
	  infowindow.setContent('<div id="info_window">' + results[0].formatted_address + '<br/><strong>Latitude :</strong> ' + Math.round(lat*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(lng*1000000)/1000000 + '<br/><br/><span id="altitude"><button type="button" class="btn btn-primary" onclick="getElevation()">Get Altitude</button></span>' + bookmark() + '</div>');
          infowindow.open(map, marker);
	  document.getElementById("address").value=results[0].formatted_address;
	  document.getElementById("latitude").value=lat.toFixed(6);
	  document.getElementById("longitude").value=lng.toFixed(6);
          bookUp(document.getElementById("address").value, lat, lng);
          ddversdms();
        }
      } else {
	  if (marker != null) marker.setMap(null);
	  marker = new google.maps.Marker({
              position: latlng,
              map: map
          });
          map.setCenter(latlng);
	  infowindow.setContent('<div id="info_window">' + 'No resolved address' + '<br/><strong>Latitude :</strong> ' + Math.round(lat*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(lng*1000000)/1000000 + '<br/><br/><span id="altitude"><button type="button" class="btn btn-primary" onclick="getElevation()">Get Altitude</button></span>' + bookmark() + '</div>');
          infowindow.open(map, marker);
	  document.getElementById("address").value='No resolved address';
	  document.getElementById("latitude").value=lat.toFixed(6);
	  document.getElementById("longitude").value=lng.toFixed(6);
          bookUp(document.getElementById("address").value, lat, lng);
          ddversdms();
	alert("Geocoder failed due to: " + status);
	
      }
    });
  }

function getElevation() {

  var locations = [];

  // Retrieve the clicked location and push it on the array
  var clickedLocation = new google.maps.LatLng(marker.position.lat(),marker.position.lng());
  locations.push(clickedLocation);

  // Create a LocationElevationRequest object using the array's one value
  var positionalRequest = {
    'locations': locations
  }

  // Initiate the location request
  elevator.getElevationForLocations(positionalRequest, function(results, status) {
    if (status == google.maps.ElevationStatus.OK) {

      // Retrieve the first result
      if (results[0]) {

        // Open an info window indicating the elevation at the clicked position
        document.getElementById("altitude").innerHTML = "<strong>Altitude :</strong> " + Math.floor(results[0].elevation) + " kilometer";
      } else {
        document.getElementById("altitude").innerHTML = "No results found";
      }
    } else {
      document.getElementById("altitude").innerHTML = "Elevation service failed due to: " + status;
    }
  });
}  
  function ddversdms() {
    var lat, lng, latdeg, latmin, latsec, lngdeg, lngmin, lngsec;
    lat=parseFloat(document.getElementById("latitude").value) || 0;	
    lng=parseFloat(document.getElementById("longitude").value) || 0;
    if (lat>=0) document.getElementById("nord").checked=true;
    if (lat<0) document.getElementById("sud").checked=true;
    if (lng>=0) document.getElementById("est").checked=true;
    if (lng<0) document.getElementById("ouest").checked=true;
    lat=Math.abs(lat);	
    lng=Math.abs(lng);
    latdeg=Math.floor(lat);
    latmin=Math.floor((lat-latdeg)*60);
    latsec=Math.round((lat-latdeg-latmin/60)*1000*3600)/1000;
    lngdeg=Math.floor(lng);
    lngmin=Math.floor((lng-lngdeg)*60);
    lngsec=Math.floor((lng-lngdeg-lngmin/60)*1000*3600)/1000;
    document.getElementById("latitude_degres").value=latdeg;
    document.getElementById("latitude_minutes").value=latmin;
    document.getElementById("latitude_secondes").value=latsec;
    document.getElementById("longitude_degres").value=lngdeg;
    document.getElementById("longitude_minutes").value=lngmin;
    document.getElementById("longitude_secondes").value=lngsec;
  }
  
  function dmsversdd() {
    var lat, lng, nordsud, estouest, latitude_degres, latitude_minutes, latitude_secondes, longitude_degres, longitude_minutes, longitude_secondes;
    if (document.getElementById("sud").checked) nordsud=-1;
    else nordsud=1;
    if (document.getElementById("ouest").checked) estouest=-1;
    else estouest=1;
    latitude_degres=parseFloat(document.getElementById("latitude_degres").value) || 0;
    latitude_minutes=parseFloat(document.getElementById("latitude_minutes").value) || 0;
    latitude_secondes=parseFloat(document.getElementById("latitude_secondes").value) || 0;
    longitude_degres=parseFloat(document.getElementById("longitude_degres").value) || 0;
    longitude_minutes=parseFloat(document.getElementById("longitude_minutes").value) || 0;
    longitude_secondes=parseFloat(document.getElementById("longitude_secondes").value) || 0;
    lat=nordsud * (latitude_degres + latitude_minutes/60 + latitude_secondes/3600);
    lng=estouest * (longitude_degres + longitude_minutes/60 + longitude_secondes/3600);
    document.getElementById("latitude").value=Math.round(lat*10000000)/10000000;
    document.getElementById("longitude").value=lng;
    setTimeout(codeLatLng(2),1000);
  }
  
    
  function bookmark() {
            return "";
      }
  
  function bookUp(address, latitude, longitude) {
        return false;
  }
  
  function simulateClick(latitude, longitude) {
    var mev = {
        stop: null,
        latLng: new google.maps.LatLng(latitude, longitude)
    }
    google.maps.event.trigger(map, 'click', mev);
  }

</script>
        
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-27565784-1', 'auto');
  ga('send', 'pageview');

</script>

    </head>
    <body onload="initialize();">
        
    <!-- Wrap all page content here -->
    <div id="wrap">
                
        <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
        
            <div id="top_top">
            <img src="../img/semen_indonesia.png" height="85px" align="right">   
                <div id="top_account" class="pull-right">
               
                </div>
                <div id="plus-one" class="pull-right"></div>
            </div>
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav nav-tabs">
              <li class="active"><a href="index.php" title="Home">Home</a></li>
			 
              <li><a href="driving-directions.php" title="Driving Directions">Driving Directions</a></li>
              <li><a href="mapquest-directions.php" title="Map Quest Directions">Map Quest Directions</a></li>
               <li><a href="../index.php" title="Dashboard">Dashboard</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
            
      <!-- Begin page content -->
            <div class="container">
         
        <div class="row">
            <div class="col-md-12 pub" id="ad-top">
              
                <!-- gps-coordinates-smart-top -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-9379737428903517"
                     data-ad-slot="1546070180"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
           
       
        <div class="row">
            <div id="ad-content" class="col-md-12 pub">
               
                <!-- gps-coordinates-smart-content -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-9379737428903517"
                     data-ad-slot="3022803382"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>	
        </div>
             
			 
     <!--    <form method="post" name="input" action="insert.php" > --> 
        <div class="row">
            <div class="col-md-4">
                <form method="post" name="input" type="textbox" action="insert.php" class="form-horizontal" role="form">
                  
					<div class="form-group">	
                        <label for="name" class="col-md-3 control-label">Toko</label>
                        <div class="col-md-9">
                            <input id="toko" name="name" class="form-control" type="textbox" value="">
                        </div>
                    </div>

				  <div class="form-group">	
                        <label for="address" class="col-md-3 control-label">Address</label>
                        <div class="col-md-9">
                            <input id="address" name="address" class="form-control" type="textbox" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-4">
                          <button type="button" class="btn btn-primary" onclick="codeAddress()">Get GPS Coordinates</button>
                        </div>
                    </div>
					
					<!---test-->
					<h4>Location</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="latitude">Latitude</label>
                        <div class="col-md-9">
                            <input id="latitude" name="lat" class="form-control" type="textbox">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="longitude">Longitude</label>
                        <div class="col-md-9">
                            <input id="longitude" name="lng" class="form-control" type="textbox">
                        </div>
                    </div>
 
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-4">
                          <button type="button" class="btn btn-primary" onclick="codeLatLng(1)">Get Address</button><br><br>
						  
                        </div>
                    </div>
						<!---endtest-->
					
						<!-- saved me bos -->	  
						  <input type="submit" name="Submit" class="btn btn-primary" value="Save on the server to store static location" />  
						<!-- END saved me bos -->
                </form>
                
			
                <form class="form-horizontal" role="form">
                    <h4>DMS (degrees, minutes, secondes)*</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="latitude">Latitude</label>
                        <div class="col-md-9">
                            <label class="radio-inline">
                                <input type="radio" name="latnordsud" value="nord" id="nord" checked/>
                                N
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="latnordsud" value="sud" id="sud" />    
                                S
                            </label>
                        
                            <input class="form-control sexagesimal" id="latitude_degres" type="textbox">
                            <label for="latitude_degres">&deg;</label>
                            <input class="form-control sexagesimal" id="latitude_minutes" type="textbox">
                            <label for="latitude_minutes">'</label>
                            <input class="form-control sexagesimalsec" id="latitude_secondes" type="textbox">
                            <label for="latitude_secondes">''</label>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="longitude">Longitude</label>
                        <div class="col-md-9">
                            <label class="radio-inline">
                                <input type="radio" name="lngestouest" value="est" id="est" checked/>
                                E
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="lngestouest" value="ouest" id="ouest" />    
                                W
                            </label>
    
                            <input class="form-control sexagesimal" id="longitude_degres" type="textbox">
                            <label for="longitude_degres">&deg;</label>
    

                            <input class="form-control sexagesimal" id="longitude_minutes" type="textbox">
                            <label for="longitude_minutes">'</label>
                            <input class="form-control sexagesimalsec" id="longitude_secondes" type="textbox">
                            <label for="longitude_secondes">''</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-4">
                          <button type="button" class="btn btn-primary" onclick="dmsversdd()">Get Address</button>
                        </div>
                    </div>
                </form>
                <span class="help-block"><small>* World Geodetic System 84 (WGS 84)</small></span>
            </div>
            <div class="col-md-8">
                <div id="map_canvas"></div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 pub" id="ad-bottom">
               
                <!-- gps-coordinates-smart-bottom -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-9379737428903517"
                     data-ad-slot="4499536583"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
        
        
        <div class="row">
    <div class="col-md-12">
            </div>
</div>
    


    <div id="footer">
      <div class="container">
        <p class="text-muted credit"><small>Copyright &copy; 2014</small> | <a href="#">Contact</a> | <a href="#">Privacy</a></p>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        $(document).ready(function() {
          $("form").keypress(function(e) {
            //Enter key
            if (e.which == 13) {
              return false;
            }
          });
        });
    </script>
        <script>
    $(document).ready(function() {
        
        $('#wrap').on('click', '.favorite', function(e) {
            $('#dp_pointbundle_point_submit').trigger('click');
            $(this).replaceWith('<button type="button" class="bookmarked btn btn-primary"><span class="glyphicon glyphicon-star"></span></button>');
        });
        
        $('#form_wrap').on('submit', 'form', function(e) {
            e.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                cache: false,
                url: $(this).attr('action'), 
                data: $(this).serialize(),
                dataType: "json",
                success: function(data){
        
                    if (data.responseCode==200) {}
                    else if (data.responseCode==400) alert(data.message);
                    else alert("ok");
                
                    $.ajax({
                        url: "/point/update",
                        cache: false,
                        success: function(data2){
                
                            if (data2.responseCode==200) $('#bookmarks_wrap').html(data2.updated);
                            //else if (data2.responseCode==400) alert(data2.message);
                            //else alert("ok");
                            
                            
                            
                            
                            
                        },
                        error: function(xhr, err){
                
                            //alert("This is taking too long. You may have internet connectivity issues or the server is down.");
                        }
                    });
                
                },
                error: function(xhr, err){
        
                    alert("Error. You may have internet connectivity issues or the server is down.");
                }
            });
        
            return false;
        });                        
  
        $('#bookmarks_wrap').on('submit', 'form', function(e) {
            e.preventDefault();
            $(this).replaceWith('<img src="images/loader.gif" style="margin-left: 25px; margin-top: 8px;"/>');
            $.ajax({
                type: $(this).attr('method'),
                cache: false,
                url: $(this).attr('action'), 
                data: $(this).serialize(),
                dataType: "json",
                success: function(data){
        
                    if (data.responseCode==200) {}
                    else if (data.responseCode==400) alert(data.message);
                    else alert("ok");
                    
                    
                    $.ajax({
                        url: "/point/update",
                        cache: false,
                        success: function(data2){
                
                            if (data2.responseCode==200) $('#bookmarks_wrap').html(data2.updated);
                           // else if (data2.responseCode==400) alert(data2.message);
                            //else alert("Error");
                            
                            
                            
                            
                            
                        },
                        error: function(xhr, err){
                
                            //alert("Error");
                        }
                    });
                    
                    
                },
                error: function(xhr, err){
        
                    alert("Error. You may have internet connectivity issues or the server is down.");
                }
            });
        
            return false;
        });                        
    
    });                    

</script>

    <script type="text/javascript">
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js?onload=onLoadCallback';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
    </body>
</html>
