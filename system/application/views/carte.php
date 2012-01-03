<?
$myFile = $_SERVER['DOCUMENT_ROOT']."/public/xml/panneaux_".$this->session->userdata['user_key'].".xml";
$fh = fopen($myFile, 'w') or die("impossible");
$stringData = "<markers>\n";
fwrite($fh, $stringData);
foreach ($panneaux as $panneau)
{
    $stringData = '<marker lat="' . $panneau->latitude . '" lng="' . $panneau->longitude . 
    '" annonceur="' . $panneau->annonceur . '" regie="' . $panneau->regie . '" campagne="' . $panneau->campagne .
    '" format="' . $panneau->format . '" type="' . $panneau->type .'" rue="' .  $panneau->rue .
    '" ville="' .  $panneau->ville . '" latv="' .  $panneau->latitude_ville . '" lngv="' .  $panneau->longitude_ville . 
    '" img="' .  $panneau->visuel . '"/>'."\n";
    fwrite($fh, $stringData);
}
$stringData = "</markers>\n";
fwrite($fh, $stringData);
fclose($fh);

$myFile = $_SERVER['DOCUMENT_ROOT']."/public/xml/villes_".$this->session->userdata['user_key'].".xml";
$fh = fopen($myFile, 'w') or die("impossible");
$stringData = "<markers>\n";
fwrite($fh, $stringData);
foreach ($villes as $ville)
{
    $stringData = '<marker ville="' .  $ville->ville . '" latv="' .  $ville->latitude_ville . '" lngv="' .  $ville->longitude_ville . '"/>'."\n";
    fwrite($fh, $stringData);
}
$stringData = "</markers>\n";
fwrite($fh, $stringData);
fclose($fh);

?>


<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAADK2Z-2Uhvnv0BtjasvfxpBSnCILwoVJizvpJquV19dYdp7D0NBTtB2tKYBqa_mQBzGZ7LRl1GHWKVQ"></script>
<br/>

<table class="tcarte">
      <tr>
        <td>
           <div id="map" style="width: 600px; height: 600px"></div>
        </td>
        <td class="carte" valign="top">
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
      function createMarker(point,html) {
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
         return marker;
      }
      
      function createSidebar(ville,latv,lngv)
      {
          // add a line to the side_bar html
        side_bar_html += '<a href="javascript:map.setCenter(new GLatLng( ' + latv + ',' + lngv + '), 12);">'+ville+'<\/a><br>';
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
      GDownloadUrl("/public/xml/panneaux_<?=$this->session->userdata['user_key']?>.xml", function(doc) {
        var xmlDoc = GXml.parse(doc);
        var markers = xmlDoc.documentElement.getElementsByTagName("marker");
          
        for (var i = 0; i < markers.length; i++) {
          // obtain the attribues of each marker
          var lat = parseFloat(markers[i].getAttribute("lat"));
          var lng = parseFloat(markers[i].getAttribute("lng"));
          var point = new GLatLng(lat,lng);
          var html = "Annonceur : "+markers[i].getAttribute("annonceur")+"<br/>Regie : "+markers[i].getAttribute("regie")+"<br/>Type : "+markers[i].getAttribute("type")+"<br/>Format : "+markers[i].getAttribute("format")+"<br/>Campagne : "+markers[i].getAttribute("campagne")+"<br/>Adresse : "+markers[i].getAttribute("rue")+'<br/><img src="/public/campagne/'+markers[i].getAttribute("img")+'.jpg" width=150 height=150>';
          //alert('<img src="/public/campagne/'+markers[i].getAttribute("img")+'.png">');
          // create the marker
          var marker = createMarker(point,html);
          map.addOverlay(marker);
        }
      });
      
      
      GDownloadUrl("/public/xml/villes_<?=$this->session->userdata['user_key']?>.xml", function(doc) {
        var xmlDoc = GXml.parse(doc);
        var markers = xmlDoc.documentElement.getElementsByTagName("marker");
          
        for (var i = 0; i < markers.length; i++) {          // obtain the attribues of each marker
          
          var ville = markers[i].getAttribute("ville");
          var latv = parseFloat(markers[i].getAttribute("latv"));
          var lngv = parseFloat(markers[i].getAttribute("lngv"));          
          createSidebar(ville,latv,lngv);  
        }
        // put the assembled side_bar_html contents into the side_bar div
        document.getElementById("side_bar").innerHTML = side_bar_html;
      });
      
      
      
    }



    else {
      alert("La cl&eacute; de google map api n'est pas valide.");
    }


    //]]>
    </script>

