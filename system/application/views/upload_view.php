    <?php echo $error;?>
    <div id="basic" class="myform2"> 
        <?php echo form_open_multipart('upload/do_upload',array('name' => 'uploadForm'));?>
        <h1>Ajouter des donn&eacute;es</h1>
        <p class="top">&nbsp;</p>
        <label>Choisir un fichier excel
            <span class="small">en bonne format</span>
        </label>
        <input class="input" type="file" name="userfile"/>
                
        <button  type="submit" onclick="submit">Ajouter</button>
        <div class="spacer"></div>
        <div id="loading" class="loading"></div>
      </form>
      
    </div>    
    </body>
</html>



	
