	<?php foreach($data as $item):?>
    <p>
    <label>Cr&eacute;&eacute; le : </label><?php echo $item->createdAt;?>
    <br />
    <label>Modifi&eacute; le : </label><?php echo $item->modifiedAt;?>
    <br />
    <label>Notes : </label><textarea rows="22" cols="33" name="notes" id="notes"><?php echo $item->notes;?></textarea>
    </p>
    <?php endforeach;?>
    <button id="btnotes" onclick="change_notes()">Changer</button>
