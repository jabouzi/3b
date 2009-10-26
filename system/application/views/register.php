    <div class="error_message" align="center">
    <?php echo validation_errors(); ?>      
    </div>
    <div id="basic" class="myform">
      <?php echo form_open('login/register'); ?>
        <h1>Cr&eacute;er un compte</h1>
        <p class="top">&nbsp;</p>
        <label>Nom de la compagnie
            <span class="small">...</span>
        </label>
        <input class="input" type="text" id="nom" name="nom" value="<?php echo set_value('nom'); ?>"/>  
        <label>Nom d'utilisateur
            <span class="small">min 5 carac </span>
        </label>
        <input class="input" type="text" id="username" name="username" value="<?php echo set_value('username'); ?>"/>
        <label>Email
            <span class="small">un email valide</span>
        </label>
        <input class="input" type="text" id="email" name="email" value="<?php echo set_value('email'); ?>"/>
        <label>Mot de passe
            <span class="small">min 6 car</span>
        </label>
        <input class="input" type="password" id="password1" name="password1" value="<?php echo set_value('password1'); ?>"/>
         <label>Mot de passe (confirmer) 
            <span class="small">confirmer min 6 car</span>
        </label>
        <input class="input" type="password" id="password2" name="password2" value="<?php echo set_value('password2'); ?>"/> 
        <label>Contact
            <span class="small">personne responsable</span>
        </label>
        <input class="input" type="text" id="contact" name="contact" value="<?php echo set_value('contact'); ?>"/>
        <label>T&eacute;l&eacute;phone
            <span class="small">ex : 11223344</span>
        </label>
        <input class="input" type="text" id="telephone" name="telephone" value="<?php echo set_value('telephone'); ?>"/>
        <label>Adresse
            <span class="small">une adresse valide</span>
        </label>
        <input class="input" type="text" id="address" name="address" value="<?php echo set_value('address'); ?>"/>
        <button  type="submit">Ajouter</button>
        <div class="spacer"></div>

      </form>
    </div>     

</body>
</html>
