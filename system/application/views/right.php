<a href="#" ><img src="http://dev.media3b.com/public/images/retour.gif" alt="" width="63" height="59" border="0"  class="btn_retour" /></a>

<div id="rightcontent">
<div class="rightcontent" id='selection'>
    <div class="resume">R&eacute;sum&eacute; de la s&eacute;l&eacute;ction</div>
        <div class="liste">
            <div id="right"></div>
        </div>
</div>
    <?php echo form_open('main/afficher',array('name' => 'formData','id' =>  'formData', 'class' => 'selection'));?>           
        <div id="h_annonceur"></div>        
        <div id="h_marque"></div>
        <div id="h_campagne"></div>
        <div id="h_regie"></div>
        <div id="h_rue"></div>
        <div id="h_format"></div>
        <input type="hidden" name="o_annonceur" id="o_annonceur" value="">     
        <input type="hidden" name="o_marque" id="o_marque" value="">        
        <input type="hidden" name="o_regie" id="o_regie" value="">     
        <input type="hidden" name="o_campagne" id="o_campagne" value="">       
        <input type="hidden" name="o_rue" id="o_rue" value="">       
        <input type="hidden" name="o_format" id="o_format" value="">     
        <input type="button" value="&nbsp;&nbsp;Afficher&nbsp;&nbsp;" onclick="send(); return false;" class="btn_afficher"/>
        <input type="button" value="R&eacute;initialiser" onclick="cancel()" class="btn_renitialiser"/>


    </form>    
</div>
