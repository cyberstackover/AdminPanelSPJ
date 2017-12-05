<!DOCTYPE html>
<html>
    <head>
        <link href='fonts.googleapis.com/css.css' rel='stylesheet' type='text/css'>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Get Mapquest directions between any 2 points in the world, featuring traffic conditions. View driving directions on interactive maps.">
        <title>Mapquest driving directions and maps</title>
                    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
            <link rel="stylesheet" href="css/sticky-footer-navbar.css" type="text/css" />
            <link rel="stylesheet" href="css/gps-coordinates.css" type="text/css" />
               <link rel="icon" type="image/x-icon" href="../img/logo.ico" />
       
        
                <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="/js/html5shiv.js"></script>
        <script src="/js/respond.min.js"></script>

        <![endif]-->
                
        <script src="http://www.mapquestapi.com/sdk/js/v7.1.s/mqa.toolkit.js?key=Fmjtd%7Cluur20012g%2C80%3Do5-9a1x00"></script>
        <style type="text/css">
            /* This css classname is not styled by the toolkit, and is intentionally
            left for the developer to customize window content. */
            .mqabasicwnd-content {
                font-size: 13px;
                font-weight: bold;
                white-space: nowrap;
            }

            table, th, td { border: 1px solid #000; }

            table { border-collapse: collapse; }
        </style>

        <script type="text/javascript" src="http://www.mapquestapi.com/sdk/js/v7.1.s/mqa.toolkit.js?key=Kmjtd%7Cluua2qu7n9%2C7a%3Do5-lzbgq"></script>

        <script type="text/javascript">

            MQA.EventUtil.observe(window, 'load', function() {
                var options = {
                    elt: document.getElementById('map_canvas'),            // ID of map element on page
                    zoom: 7,                                        // initial zoom level of the map
                    latLng: { lat: -7.176188, lng: 112.650710 }     // center of map in latitude/longitude
                };

                // construct an instance of MQA.TileMap with the options object
                window.map = new MQA.TileMap(options);
		
                MQA.withModule('largezoom','traffictoggle','viewoptions','geolocationcontrol','insetmapcontrol', function() {
		    map.addControl(
			 new MQA.LargeZoom(),
			 new MQA.MapCornerPlacement(MQA.MapCorner.TOP_LEFT, new MQA.Size(5,5))
		       );
		     
		       map.addControl(new MQA.TrafficToggle());
		     
		       map.addControl(new MQA.ViewOptions());
		     
		       map.addControl(
			 new MQA.GeolocationControl(),
			 new MQA.MapCornerPlacement(MQA.MapCorner.TOP_RIGHT, new MQA.Size(10,50))
		       );
		});
	    });

  function directions()
  {
    document.getElementById('directionsPanel').innerHTML = '';
    document.getElementById('loader').innerHTML = '&nbsp;<img src="images/loader.gif" />';
    var origin = document.getElementById("address").value;
    var destination = document.getElementById("addressDest").value;
    var travelMode = document.getElementById("travelMode").value;
    var unit = document.getElementById("unit").value
    var tolls = document.getElementById("tolls").value    
    var fullUnit = ' km';
    if (unit=='Mile') {unit='m'; fullUnit=" miles"}
    else unit='k';
    
    if (tolls=='Avoid') tolls='toll road';
    else tolls = "";
		// download the modules
                MQA.withModule('new-route', function() {

                    var opt = {
                        request: {
                            locations: [ origin, destination ],

                            options: {
                                avoids: [tolls],
                                avoidTimedConditions: false,
                                doReverseGeocode: true,
                                shapeFormat: 'raw',
                                generalize: 0,
                                routeType: travelMode,
                                timeType: 1,
                                locale: 'en_US',
                                unit: unit,
                                enhancedNarrative: true,
                                drivingStyle: 2,
                                highwayEfficiency: 21.0
                            }
                        },

                        display: {
                            color: '#800000',
                            borderWidth: 10
                        },

                        // on success, display the route narrative
                        success: function displayNarrative(data) {
                            document.getElementById('loader').innerHTML = '';
			    if (data.route) {
                                var legs = data.route.legs,
                                    html = '',
                                    i = 0,
                                    j = 0,
                                    trek,
                                    maneuver;

                                html += '<strong>distance</strong>: '+Math.round(data.route.distance*10)/10+fullUnit+'<br>';
				
                                html += '<strong>time</strong>: '+conversion_seconde_heure(data.route.time)+'<br><br>';
				
				html += '<table><tbody>';

                                for (; i<legs.length; i++) {
                                    for (j=0; j<legs[i].maneuvers.length; j++) {
                                        maneuver = legs[i].maneuvers[j];
                                        html += '<tr>';
                                        html += '<td>';

                                        if (maneuver.iconUrl) {
                                            html += '<img src="' + maneuver.iconUrl + '" />  ';
                                        }

                                        for (k=0; k<maneuver.signs.length; k++) {
                                            var sign = maneuver.signs[k];

                                            if (sign && sign.url) {
                                                html += '<img src="' + sign.url + '" />  ';
                                            }
                                        }

                                        html += '</td><td>' + maneuver.narrative + '</td><td>' + Math.round(maneuver.distance*10)/10 + fullUnit + '</td>';
                                        html += '</tr>';
                                    }
                                }

                                html += '</tbody></table>';
                                document.getElementById('directionsPanel').innerHTML = html;
                            }
                        },
			
			error: function displayError(data) {
                          document.getElementById('loader').innerHTML = '';
			  if (data.info.messages!="") alert(data.info.messages);
			  else alert("Undefined error");
			},
                    }

                    map.addRoute(opt);
   });
    
  }
	   
  function conversion_seconde_heure(time) {
    var reste=time;
    var result='';
  
    var nbJours=Math.floor(reste/(3600*24));
    reste -= nbJours*24*3600;
  
    var nbHours=Math.floor(reste/3600);
    reste -= nbHours*3600;
  
    var nbMinutes=Math.floor(reste/60);
    reste -= nbMinutes*60;
  
    var nbSeconds=reste;
  
    if (nbJours>0)
	    result=result+nbJours+'d ';
  
    if (nbHours>0)
	    result=result+nbHours+'h ';
  
    if (nbMinutes>0)
	    result=result+nbMinutes+'min ';
  
    if (nbSeconds>0)
	    result=result+nbSeconds+'s ';
  
    return result;
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
              <li ><a href="index.php" title="Home">Home</a></li>
			  
              <li><a href="driving-directions.php" title="Driving Directions">Driving Directions</a></li>
              <li class="active"><a href="mapquest-directions.php" title="Map Quest Directions">Map Quest Directions</a></li>
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
        <div class="row">
            <div class="col-md-4">
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
			    <option>fastest</option>
			    <option>shortest</option>
			    <option>pedestrian</option>
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
            <script type="text/javascript">
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js?onload=onLoadCallback';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
    </body>
</html>
