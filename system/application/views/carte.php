<?

$myFile = "/var/www/3b/httpdocs/system/xml/panneaux.xml";
$fh = fopen($myFile, 'w');
$stringData = "<markers>\n";
fwrite($fh, $stringData);
foreach ($panneaux as $panneau)
{
    $stringData = '<marker lat="' . $panneau->y/110846 . '" lng="' . $panneau->x/59570 . '" html="' . $panneau->rue . '" label="' .  $panneau->rue. '"/>'."\n";
    fwrite($fh, $stringData);
}
$stringData = "</markers>\n";
fwrite($fh, $stringData);
fclose($fh);

?>

<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAADK2Z-2Uhvnv0BtjasvfxpBQFvZdgKRPIgaJRXB6kUsLd8Cj1dxTUxJdZZE2drj3OvirRkEPXxJ8K_w"></script>

<table style="border-style: solid;border-color: rgb( 100, 100, 255);">
      <tr>
        <td>
           <div id="map" style="width: 550px; height: 600px"></div>
        </td>
        <td width = 250 valign="top" style="text-decoration: underline; color: #4444ff;">
           <div id="side_bar"  style="overflow:auto; height:600px;"></div>
        </td>
      </tr>

    </table>   


    <noscript><b>JavaScript must be enabled in order for you to use Google Maps.</b> 
      However, it seems JavaScript is either disabled or not supported by your browser. 
      To view Google Maps, enable JavaScript by changing your browser options, and then 
      try again.
    </noscript>


    <script type="text/javascript">
    //<![CDATA[

    if (GBrowserIsCompatible()) {
      
      // this variable will collect the html which will eventually be placed in the side_bar
      var side_bar_html = "";
    
      // arrays to hold copies of the markers and html used by the side_bar
      // because the function closure trick doesnt work there
      var gmarkers = [];
	  
	  
      // A function to create the marker and set up the event window
      function createMarker(point,name,html) {
		var icon = new GIcon();
		icon.image = "http://maps.google.com/mapfiles/kml/pal2/icon13.png";
        icon.iconSize = new GSize(25,25);
        icon.iconAnchor = new GPoint(14,25);
        icon.infoWindowAnchor = new GPoint(14,14);
        var marker = new GMarker(point,icon);
        GEvent.addListener(marker, "click", function() {
          marker.openInfoWindowHtml(html);
        });
        // save the info we need to use later for the side_bar
        gmarkers.push(marker);
        // add a line to the side_bar html
        side_bar_html += '<a href="javascript:myclick(' + (gmarkers.length-1) + ')">' + name + '<\/a><br>';
         return marker;
      }


      // This function picks up the click and opens the corresponding info window
      function myclick(i) {
        GEvent.trigger(gmarkers[i], "click");
      }      

		//var request = GXmlHttp.create();

	  //var xmlDoc = GXml.parse(request.responseText);

	  //var markers = xmlDoc.documentElement.getElementsByTagName("marker");
		//alert(markers);
      // create the map
      //var iconImage = markers[1].getAttribute("icon");

      
      var map = new GMap2(document.getElementById("map"));
      map.addControl(new GLargeMapControl());
      map.addControl(new GMapTypeControl());
      map.setCenter(new GLatLng( 34.75966612466248,9.7119140625), 7);


      // Read the data from example.xml
      GDownloadUrl("/system/xml/panneaux.xml", function(doc) {
        var xmlDoc = GXml.parse(doc);
        var markers = xmlDoc.documentElement.getElementsByTagName("marker");
          
        for (var i = 0; i < markers.length; i++) {
          // obtain the attribues of each marker
          var lat = parseFloat(markers[i].getAttribute("lat"));
          var lng = parseFloat(markers[i].getAttribute("lng"));
          var point = new GLatLng(lat,lng);
          var html = markers[i].getAttribute("html");
          var label = markers[i].getAttribute("label");
          // create the marker
          var marker = createMarker(point,label,html);
          map.addOverlay(marker);
        }
        // put the assembled side_bar_html contents into the side_bar div
        document.getElementById("side_bar").innerHTML = side_bar_html;
      });
    }



    else {
      alert("Sorry, the Google Maps API is not compatible with this browser");
    }

    // This Javascript is based on code provided by the
    // Community Church Javascript Team
    // http://www.bisphamchurch.org.uk/   
    // http://econym.org.uk/gmap/

    //]]>
    </script>

