<div id="centercontent2">
<!--<p id="main"><a href="/main/main_data">Cliquer ici pour faire une autre s&eacute;l&eacute;ction</a></p>-->
<p>

<input type="radio" name="selection_type" id="tableau" class="tab" value="1" <?php echo $checked[0];?>onclick="pige()"/><b>Tableau</b>
<input type="radio" name="selection_type" id="tableau" class="tab" value="1" <?php echo $checked[1];?>onclick="graphes()"/><b>Graphes</b>
<input type="radio" name="selection_type" id="tableau" class="tab" value="1" <?php echo $checked[3];?>onclick="carte()"/><b>Carte</b>

</p>
<input class="btn_rapport" type="button" name="selection_type" id="tableau" value="" <?php echo $checked[2];?>onclick="pdf()"/>
<a href="#" class="retour" ><img src="http://dev.media3b.com/public/images/retour.gif" alt="" width="63" height="59" border="0"  class="btn_retour" /></a>





