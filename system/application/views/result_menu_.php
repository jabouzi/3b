<div id="centercontent2">
<p id="main"><a href="/3B/index.php/main/main_data">Faire une autre s&eacute;l&eacute;ction</a></p>
<p>
<!--<input type="radio" name="selection_type" id="tableau" value"1" <?php echo $checked[0];?>onclick="pige()"/><b>Tableau crois&eacute;</b>
<input type="radio" name="selection_type" id="tableau" value"1" <?php echo $checked[1];?>onclick="graphes()"/><b>Graphes</b>
<input type="radio" name="selection_type" id="tableau" value"1" <?php echo $checked[2];?>onclick="pdf()"/><b>PDF</b>
<input type="radio" name="selection_type" id="tableau" value"1" <?php echo $checked[3];?>onclick="Carte()"/><b>Carte</b>
<form id="rForm">
<select id="rmenu" size="1">
<option value="http://localhost/3B/index.php/main/afficher" selected="selected">Tableau crois&eacute;</option>
<option value="http://localhost/3B/index.php/main/afficher_graphes">Graphes</option>
<option value="http://localhost/3B/index.php/main/pdf">PDF</option>
<option value="">Carte</option>
</select>
</form>-->
<form id="rform">
<select id="rselect" onchange="change()">
<option value="http://localhost/3B/index.php/main/afficher">Tableau crois&eacute;</option>
<option value="http://localhost/3B/index.php/main/afficher_graphes">Graphes</option>
<option value="http://localhost/3B/index.php/main/pdf">PDF</option>
<option value="">Carte</option>
</SELECT>
</form>
</p>


