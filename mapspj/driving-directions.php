<!DOCTYPE html>
<html>
    <head>
        <link href='fonts.googleapis.com/css.css' rel='stylesheet' type='text/css'>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Get Google Maps directions between any 2 gps points located by their address or their GPS coordinates. View directions in Google Maps.">
        <title>Google Maps driving directions</title>
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
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();

  function initialize() {
    var input = document.getElementById('address');
    var inputDest = document.getElementById('addressDest');
    var options = {
    };
    autocomplete = new google.maps.places.Autocomplete(input, options);  
    autocompleteDest = new google.maps.places.Autocomplete(inputDest, options);  
    directionsDisplay = new google.maps.DirectionsRenderer();

    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(40.7143528, -74.0059731);
    var myOptions = {
      zoom: 10,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById("directionsPanel"));
    bookUp("New York", 40.7143528, -74.0059731);

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
	      infowindow.setContent('<div id="info_window"><strong>Geolocation :</strong> <span id="geocodedAddress">' + results[0].formatted_address + '</span><br/><strong>Latitude :</strong> ' + Math.round(position.coords.latitude*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(position.coords.longitude*1000000)/1000000 + '<br/><br/><span id="buttonSet"><button type="button" class="btn btn-primary" onclick="setOrigin()">Set as Origin</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" onclick="setDest()">Set as Destination</button></span>' + bookmark() + '</div>');
	      bookUp(results[0].formatted_address, position.coords.latitude, position.coords.longitude);
	      infowindow.open(map, marker);
	    }
	  } else {
	      if (marker != null) marker.setMap(null);
	      marker = new google.maps.Marker({
		  position: pos,
		  map: map
	      });
	      infowindow.setContent('<div id="info_window">' + '<strong>No resolved address</strong>' + '<br/><strong>Latitude :</strong> ' + Math.round(lat*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(lng*1000000)/1000000 + '</div>');
	      bookUp("No resolved address", position.coords.latitude, position.coords.longitude);
	      infowindow.open(map, marker);
	  }
	});
	
	
	//infowindow.setContent('<div id="info_window">' + 'Geolocation:<br/>Latitude : ' + Math.round(position.coords.latitude*1000000)/1000000 + '<br/>Longitude : ' + Math.round(position.coords.longitude*1000000)/1000000 + '<br/><br/><span id="altitude"><button type="button" class="btn btn-primary" onclick="getElevation()">Get Altitude</button></span></div>');
	//infowindow.open(map, marker);
	//document.getElementById("latitude").value=position.coords.latitude;
	//document.getElementById("longitude").value=position.coords.longitude;
	//document.getElementById("address").value="";
          
	  
	  
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
  
  function codeLatLng(origin) {
    var lat = parseFloat(document.getElementById("latitude").value) || 0;
    var lng = parseFloat(document.getElementById("longitude").value) || 0;
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
	  if (marker != null) marker.setMap(null);
	  marker = new google.maps.Marker({
              position: latlng,
              map: map
          });
          infowindow.setContent('<div id="info_window"><strong>Address :</strong> <span id="geocodedAddress">' + results[0].formatted_address + '</span><br/><strong>Latitude :</strong> ' + Math.round(lat*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(lng*1000000)/1000000 + '<br/><br/><span id="buttonSet"><button type="button" class="btn btn-primary" onclick="setOrigin()">Set as Origin</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" onclick="setDest()">Set as Destination</button></span>' + bookmark() + '</div>');
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
          infowindow.setContent('<div id="info_window">' + '<strong>No resolved address</strong>' + '<br/><strong>Latitude :</strong> ' + Math.round(lat*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(lng*1000000)/1000000 + bookmark() + '</div>');
          infowindow.open(map, marker);
          bookUp(document.getElementById("address").value, lat, lng);
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
	  infowindow.setContent('<div id="info_window"><strong>Address :</strong> <span id="geocodedAddress">' + results[0].formatted_address + '</span><br/><strong>Latitude :</strong> ' + Math.round(lat*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(lng*1000000)/1000000 + '<br/><br/><span id="buttonSet"><button type="button" class="btn btn-primary" onclick="setOrigin()">Set as Origin</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" onclick="setDest()">Set as Destination</button></span>' + bookmark() + '</div>');
          infowindow.open(map, marker);
          bookUp(results[0].formatted_address, lat, lng);
        }
      } else {
	  if (marker != null) marker.setMap(null);
	  marker = new google.maps.Marker({
              position: latlng,
              map: map
          });
          map.setCenter(latlng);
	  infowindow.setContent('<div id="info_window">' + '<strong>No resolved address</strong>' + '<br/><strong>Latitude :</strong> ' + Math.round(lat*1000000)/1000000 + ' | <strong>Longitude :</strong> ' + Math.round(lng*1000000)/1000000 + bookmark() + '</div>');
          infowindow.open(map, marker);
	  document.getElementById("address").value='No resolved address';
	  document.getElementById("latitude").value=lat;
	  document.getElementById("longitude").value=lng;
          bookUp('No resolved address', lat, lng);
	  ddversdms();
	alert("Geocoder failed due to: " + status);
	
      }
    });
  }

function setOrigin()
{
  document.getElementById("address").value=document.getElementById("geocodedAddress").innerHTML;
  document.getElementById("buttonSet").innerHTML="<strong>This location is your new starting point.</strong>";
}

function setDest()
{
  document.getElementById("addressDest").value=document.getElementById("geocodedAddress").innerHTML;
  document.getElementById("buttonSet").innerHTML="<strong>This location is your new destination.</strong>";
}
  
  function directions()
  {
    document.getElementById('directionsPanel').innerHTML = '';
    document.getElementById('loader').innerHTML = '&nbsp;<img src="images/loader.gif" />';
    var travelMode = document.getElementById("travelMode").value
    var unit = document.getElementById("unit").value
    var highways = document.getElementById("highways").value
    var tolls = document.getElementById("tolls").value    
    var origin = document.getElementById("address").value;
    var destination = document.getElementById("addressDest").value;
  
    if (marker != null) marker.setMap(null);
  
    if (travelMode=='Bicycling') travelMode=google.maps.TravelMode.BICYCLING;
    else if (travelMode=='Transit') travelMode=google.maps.TravelMode.TRANSIT;
    else if (travelMode=='Walking') travelMode=google.maps.TravelMode.WALKING;
    else travelMode=google.maps.TravelMode.DRIVING;
    
    if (unit=='Mile') unit=google.maps.UnitSystem.IMPERIAL;
    else unit=google.maps.UnitSystem.METRIC;
    
    if (highways=='Avoid') highways=true;
    else highways = false;
    
    if (tolls=='Avoid') tolls=true;
    else tolls = false;
    
    var request = {
      origin:origin,
      destination:destination,
      travelMode: travelMode,
      unitSystem: unit,
      avoidHighways: highways,
      avoidTolls: tolls
    };
    directionsService.route(request, function(result, status) {
      document.getElementById('loader').innerHTML = '';
      if (status == google.maps.DirectionsStatus.OK) {
	directionsDisplay.setDirections(result);
      }
      else
      {
	document.getElementById('directionsPanel').innerHTML = '<p>Calculating error or invalid route.</p>';
      }
  });
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
              <li><a href="index.php" title="Home">Home</a></li>
			 
              <li class="active"><a href="driving-directions.php" title="Driving Directions">Driving Directions</a></li>
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
                <script async src="pagead2.googlesyndication.com/pagead/js/f.txt"></script>
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
                <script async src="pagead2.googlesyndication.com/pagead/js/f.txt"></script>
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
        <div class="row">
            <div class="col-md-4">
                <form class="form-horizontal" role="form">
                    <h4>Locate a GPS point on the map</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="latitude">Latitude</label>
                        <div class="col-md-9">
                            <input id="latitude" class="form-control" type="textbox">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="longitude">Longitude</label>
                        <div class="col-md-9">
                            <input id="longitude" class="form-control" type="textbox">
                        </div>
                    </div>
 
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-4">
                          <button type="button" class="btn btn-primary" onclick="codeLatLng(1)">View on the Map</button>
                        </div>
                    </div>
                        
                </form>
            
		<form class="form-horizontal" role="form">
                    <h4>Directions from / to</h4>
		    <div class="form-group">
                        <label for="address" class="col-md-3 control-label">Origin</label>
                        <div class="col-md-9">
                            <input id="address" class="form-control" type="textbox" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-md-3 control-label">Destination</label>
                        <div class="col-md-9">
                            <input id="addressDest" class="form-control" type="textbox" value="">
                        </div>
                    </div>
		    <div class="form-group">
			<label class="col-md-3 control-label" for="travelMode">Mode</label>
			<div class="col-md-9">
			  <select id="travelMode" class="form-control">
			    <option>Driving</option>
			    <option>Bicycling</option>
			    <option>Transit</option>
			    <option>Walking</option>
			  </select>
			</div>
		    </div>

		    <div class="form-group">
			<label class="col-md-3 control-label" for="unit">Unit</label>
			<div class="col-md-9">
			  <select id="unit" class="form-control">
			    <option>Kilometer</option>
			    <option>Mile</option>
			  </select>
			</div>
		    </div>

		    <div class="form-group">
			<label class="col-md-3 control-label" for="highways">Highways</label>
			<div class="col-md-9">
			  <select id="highways" class="form-control">
			    <option>Ok</option>
			    <option>Avoid</option>
			  </select>
			</div>
		    </div>

		    <div class="form-group">
			<label class="col-md-3 control-label" for="tolls">Tolls</label>
			<div class="col-md-9">
			  <select id="tolls" class="form-control">
			    <option>Ok</option>
			    <option>Avoid</option>
			  </select>
			</div>
		    </div>
		<div class="form-group">
		    <div class="col-md-offset-3 col-md-4">
		      <button type="button" class="btn btn-primary" onclick="directions();">Get Directions<span id="loader"></span></button>
		    </div>
		</div>
		</form>
                
            </div>
            <div class="col-md-8">
                <div id="map_canvas"></div>
            
		<div id="directionsPanel"></div>
	    </div>
        </div>
	
        <div class="row">
            <div class="col-md-12 pub" id="ad-bottom">
                <script async src="pagead2.googlesyndication.com/pagead/js/f.txt"></script>
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
