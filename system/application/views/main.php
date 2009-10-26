<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?=base_url();?>public/yui/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="<?=base_url();?>public/yui/build/connection/connection-min.js"></script>
<script type="text/javascript" src="<?=base_url();?>public/js/main.js"></script>
<title>Multi-column layout via CSS</title>

<style type="text/css">
/* <![CDATA[ */

	body {
		margin:0; padding:0;
		font-size:80%;
		font-family: sans-serif;
		}
	p{
		color:white;
		font-size:120%;
		font-weight:bold;
	}

  #header {
    display: block;
    width: 80%;
    margin: auto;
    }

	#container {
	  width: 80%;
	  margin: auto;
		padding:0;
		display: table;
		border: 1px solid black;
		}

  #row  {
    display: table-row;
    }

	#left {
		width:150px;
		padding:1em;
		background: #EEF;
		display: table-cell;
		}

	#right {
		width:300px;
		padding:2em;
		background:#7F7F7F;
    	display: table-cell;
		}

	#middle {
		padding: 1em;
		background:#BFBFBF;
    	display: table-cell;
		}

/* ]]> */
</style>

</head>
<body>
	<div id="header">
		<p>...</a></p>
	</div>

<div id="container">
  <div id="row">

  	<div id="middle">
		<table border=0>
		  <tbody>
			<tr>
			  <td>
				  <b>Annonceurs</b><br/><br/><?=form_dropdown('annonceur', $annonceur,'','id=annonceur')?><br/><br/>
				  <div id="id1" style="display:block"><button id="select1"  onclick="filter(1)">Selectionner</button></div>
				  <br/><br/><br/>
				  </td>
				  <td>
				  <b>Familles</b><br/><br/><?=form_dropdown('famille', $famille,'','id=famille')?><br/><br/>
				  <div id="id2" style="display:block"><button id="select2"  onclick="filter(2)">Selectionner</button></div>
				  <br/><br/><br/>
				  <?=count($famille)?>
			  </td>
			</tr>
			<tr>
			  <td>
				  <b>Compagnes</b><br/><br/><?=form_dropdown('campagne', $campagne,'','id=campagne')?><br/><br/>
				  <div id="id3" style="display:block"><button id="select3" onclick="filter(3)">Selectionner</button></div>
				  <br/><br/><br/>
				  <?=count($campagne)?>
				  </td>
				  <td>
				  <b>Marques</b><br/><br/><?=form_dropdown('marque', $marque,'','id=marque')?><br/><br/>
				  <div id="id4" style="display:block"><button id="select4" onclick="filter(4)">Selectionner</button></div>
				  <br/><br/><br/>
				  <?=count($marque)?>
			  </td>
			</tr>
			<tr>
			  <td>
				  <b>Regies</b><br/><br/><?=form_dropdown('regie', $regie,'','id=regie')?><br/><br/>
				  <div id="id5" style="display:block"><button id="select5" onclick="filter(5)">Selectionner</button></div>
				  <br/><br/><br/>
				  <?=count($regie)?>
				  </td>
			  <td>
			  </td>
			</tr>
		  </tbody>
		</table>  	
		<button id="apply">Vas-y!</button>	<button id="cancel">Annuler</button>
  	</div>

  	<div id="right">
		<table border=0>
		  <tbody>
			<tr>
			  <td><b>Annonceurs</b><br/>
			  <div id='list1'>
			  </div>
			  </td>
			  <td><b>Familles</b><br/>
			  <div id='list2'>
			  </div>
			  </td>
			</tr>
			<tr>
			  <td><b>Compagnes</b><br/>
			  <div id='list3'>
			  </div>
			  </td>
			  </td>
			  <td><b>Marques</b><br/>
			  <div id='list4'>
			  </div>
			  </td>
			  </td>
			</tr>
			<tr>
			  <td><b>Regies</b><br/>
			  <div id='list5'>
			  </div>
			  </td>
			  </td>
			  <td></td>
			</tr>
		  </tbody>
		</table>  	
		
    	<?php echo form_open('main/do_select','id=mainform');?>
		<input type='hidden' name='year1'  id='year1' value="<?=$year1?>"/>
		<input type='hidden' name='month1'  id='month1' value="<?=$month1?>"/>
		<input type='hidden' name='year2'  id='year2' value="<?=$year2?>"/>
		<input type='hidden' name='month2'  id='month2' value="<?=$month2?>"/>
		<input type='hidden' name='nb_annonceurs'  id='nb_annonceurs' value=''/>
		<input type='hidden' name='nb_familles'  id='nb_familles' value=''/>
		<input type='hidden' name='nb_campagnes'  id='nb_campagnes' value=''/>
		<input type='hidden' name='nb_marques'  id='nb_marques' value=''/>
		<input type='hidden' name='nb_regies'  id='nb_regies' value=''/>
		<input type="submit" value="ok" />
		</form>
  	</div>

	</div>
</div>

</body>
</html>
