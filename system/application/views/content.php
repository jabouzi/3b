<div id="content">
    <div style="float:left;width:740px;">
    
        <div id="bloc_filtre">
           <div id="bloc_filtre_left">
                <div class="centercontent"><h4>&nbsp;&nbsp;Annonceur</h4>
                    <div class="data" id="divannonceur">    
                        <?php foreach($annonceur as $item):?>
                        <p id="p1<?php echo $item;?>"><input type="checkbox" value="<?php echo $item;?>" name="annonceur_<?php echo $item;?>" id="annonceur_<?php echo $item;?>" /><?php echo $item;?></p>
                        <?php endforeach;?>
                    </div>
                </div>
                <button id="btn"  onclick="add('annonceur')">Ajouter</button>
            </div>
            <div id="bloc_filtre_right">
                <div class="centercontent"><h4>&nbsp;&nbsp;Campagne</h4>
                    <div class="data" id="divcampagne">
                        <?php foreach($campagne as $item):?>
                        <p id="p2<?php echo $item;?>"><input type="checkbox" value="<?php echo $item;?>" name="campagne_<?php echo $item;?>" id="campagne_<?php echo $item;?>" /><?php echo $item;?></p>
                        <?php endforeach;?>
                    </div>
                </div>
                <button id="btn" onclick="add('campagne')">Ajouter</button>
            </div>
            <div id="bloc_filtre_right2">
                <div class="centercontent"><h4>&nbsp;&nbsp;Marque</h4>
                    <div class="data" id="divmarque">
                        <?php foreach($marque as $item):?>
                        <p id="p3<?php echo $item;?>"><input type="checkbox" value="<?php echo $item;?>" name="marque_<?php echo $item;?>" id="marque_<?php echo $item;?>" /><?php echo $item;?></p>
                        <?php endforeach;?>
                    </div>
                </div>
                <button id="btn" onclick="add('marque')">Ajouter</button>
            </div>
        </div>
        
        <div id="tab">
            <div id="onglet">
              <div class="onglet1" id="onglet_outdoor" onclick="javascript:change_onglet('outdoor');"><span>Outdoor</span></div>
              <div class="onglet2" id="onglet_indoor" onclick="javascript:change_onglet('indoor');"><span>Indoor</span></div>
            </div>
            <div class="onglet_body_indoor" id="contenu_body_indoor">
              <div id="bloc_onglet_left">
                <div class="centercontent"><h4>R&eacute;gie</h4>
                    <div id="divregie" class="data">
                        <?php foreach($regie as $item):?>
                        <p id="p4<?php echo $item;?>"><input type="checkbox" value="<?php echo $item;?>" name="regie_<?php echo $item;?>" id="regie_<?php echo $item;?>"/><?php echo $item;?></p>
                        <?php endforeach;?>
                    </div>
                </div>
                <button id="btn" onclick="add('regie')">Ajouter</button>
            </div>
            <div id="bloc_onglet_right">
                <div class="centercontent"><h4>R&eacute;gion</h4>
                    <div id="divrue" class="data">
                        <?php foreach($rue as $item):?>
                        <p id="p5<?php echo $item;?>"><input type="checkbox" value="<?php echo $item;?>" name="rue_<?php echo $item;?>" id="rue_<?php echo $item;?>"/><?php echo $item;?></p>
                        <?php endforeach;?>
                    </div>
                </div>
                <button id="btn" onclick="add('rue')">Ajouter</button>
            </div>
            <div id="bloc_onglet_right2">
                <div class="centercontent"><h4>Format</h4>
                    <div id="divformat" class="data">
                        <?php foreach($format as $item):?>
                        <p id="p6<?php echo $item;?>"><input type="checkbox" value="<?php echo $item;?>" name="format_<?php echo $item;?>" id="format_<?php echo $item;?>"/><?php echo $item;?></p>
                        <?php endforeach;?>
                    </div>
                </div>
                <button id="btn" onclick="add('format')">Ajouter</button>
            </div>
        </div>
        
    </div>
</div>
</div>

