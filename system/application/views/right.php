

<!-- start right box -->

<div id="rightcontent">


	<br />
    <div class="rightcontent"><h4>R&eacute;sum&eacute; de la s&eacute;l&eacute;ction</h4>
	<div id="right"></div> 
    </div>
    <?php echo form_open('main/afficher',array('name' => 'formData','id' =>  'formData'));?>           
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
        <div class="buttoncontent"><input type="button" value="&nbsp;&nbsp;Afficher&nbsp;&nbsp;" onclick="send(); return false;"/><input type="button" value="R&eacute;initialiser" onclick="cancel()"/></div>			
    </form>
	<!--<div class="buttoncontent"><button onclick="afficher()">Afficher</button><button onclick="cancel()">R&eacute;initialiser</button></div>-->
    
</div>


<!-- end right box -->
