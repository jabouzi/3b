
<div id="rightcontent">
    <div class="rightcontent" id='selection'>
       
<div class="resume">R&eacute;sum&eacute; de la s&eacute;l&eacute;ction</div>
	   <div class="liste">

            <div id="date_selected">
                <div id="d1"></div>
                <div id="d2"></div>
                <div id="d3"></div>
            </div>
        </div>
    </div>
</div>
<?php echo form_open('main/main_data');?>
<p><input type="hidden" name="in" id="in"></p>
<p><input type="hidden" name="out" id="out"></p>
<p><input type="hidden" name="year" id="year" value=""></p>
<p><input type="hidden" name="month" id="month" value=""></p>
<p><input type="hidden" name="flag" id="flag" value="on"></p>
<div class="buttoncontent2">

<input id="btn" class="btn_valider" type="submit" value="Valider" onclick="cancel()"/>
<input  id="btn" type="button" value="R&eacute;initialiser" onclick="cancel()" class="btn_renitialiser"/>






</div>
</form>




