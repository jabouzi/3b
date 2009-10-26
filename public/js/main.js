/*
 * Skander Jabouzi 2009 main.js
 * 
 * */


//variables globales
var annonceurs = new Object();
var campagnes = new Object();
var marques = new Object();
var regies = new Object();
var rues = new Object();
var formats = new Object();
var order = 0;

/*
 * fonction pour ajouter une selection
 * 
 * */
function add(type)
{    
	if (document.getElementById(type))
	{
		var div = document.getElementById(type);					
	}
	else
	{
        order++;
		var parent = document.getElementById('right');
		parent.innerHTML += '<div id="'+type+'"><h3>'+type+'</h3></div>';
        document.getElementById('o_'+type).value = order;	
        var div = document.getElementById(type);		
	}
	if ('annonceur' == type) {
		printData(annonceurs,div,'1');
		removeElements(annonceurs,1,'1');	
	}	
	else if ('campagne' == type) {
		printData(campagnes,div,'2');		
		removeElements(campagnes,1,'2');	
	}
	else if ('marque' == type) {
		printData(marques,div,'3');		
		removeElements(marques,1,'3');	
	}
	else if ('regie' == type) {
		printData(regies,div,'4');		
		removeElements(regies,1,'4');	
	}
	else if ('rue' == type) {
		printData(rues,div,'5');		
		removeElements(rues,1,'5');	
	}
	else {
		printData(formats,div,'6');
		removeElements(formats,1,'6');
	}    
    filter(1);
}

/*
 * fonction pour filtrer les résulats
 * 
 * */
function filter(flag)
{	
	var data = new Array(4);
    data['annonceur'] = new Array();
    data['campagne'] = new Array();
    data['marque'] = new Array();
    data['regie'] = new Array();
    data['rue'] = new Array();
    data['format'] = new Array();
    var types = ['annonceur','campagne','marque','regie','rue','format'];
    for (var i = 0; i < types.length; i++)
	{
        var childs = document.getElementById('h_'+types[i]).childNodes;                   
        for (var child = 0; child < childs.length; child++)
        {
                data[types[i]][child] = childs[child].value;
        }            
    }

    var postData=getObjPostValues(data); 
    getFiltredContent(postData,'annonceur',flag);	
    getFiltredContent(postData,'marque',flag);	
    getFiltredContent(postData,'campagne',flag);	
    getFiltredContent(postData,'regie',flag);	
    getFiltredContent(postData,'rue',flag);	
    getFiltredContent(postData,'format',flag);	
}

/*
 * fonction xmlhttp pour réafficher le contenue filtré
 * 
 * */
var getFiltredContent = function(postData,type,flag){
    if (flag == 1)
        YAHOO.util.Connect.asyncRequest('POST', '/3B/index.php/main/filter/'+type, callback, postData); 
    else   
        YAHOO.util.Connect.asyncRequest('POST', '/3B/index.php/main/filter/'+type, callback3, postData);    
};

/*
 * fonction pour annuler les filtres
 * 
 * */
var cancel = function(){ 
    document.getElementById('right').innerHTML = ""; 	
    YAHOO.util.Connect.asyncRequest('POST', '/3B/index.php/main/refresh', callback2);    
};

/*
 * fonction pour vérifier si un element est dans un tableau
 * 
 * */
function inArray(elem,arr,index)
{
  var ok = false;
  for (var i = 0; i < arr.length; i++)
  {
	  if (elem == 'p'+index+arr[i])
	  {
		  ok = true;
		  break;
	  }
  }
  return ok; 
}

/*
 * fonction pour afficher ou caher les checkboxes des choix à faire
 * 
 * */
var updateDivs = function(index,arr,flag)
{
    var div = document.getElementById('div'+arr[0]);
    if (flag == 1)
    {  
        ps = div.getElementsByTagName('p');
        img = div.getElementsByTagName('img');
        input = div.getElementsByTagName('input');
        for(var i=0; i < input.length; i++) 
        {	
    	    input[i].checked = '';           	
        }
        for(var i=0; i < img.length; i++) 
        {	
            document.getElementById(img[i].id).src=imgFalse;            	
        }
        for(var i=0; i < ps.length; i++) 
        {
            if (!inArray(ps[i].id,arr,index))
            {		                    
                    var elem = document.getElementById(ps[i].id);
                    elem.src = imgFalse; 
                    elem.style.display = 'none';
            }		
        }
    }
    else 
    {
        imgs = div.getElementsByTagName('p');

        for(var i=0; i < imgs.length; i++) 
        {		
            var elem = document.getElementById(imgs[i].id);                    
            elem.style.display = 'none';  
            elem.src = imgFalse;
        }        
        var childs = document.getElementById('h_'+arr[0]).childNodes;         
        
        for (var j = 1; j < arr.length; j++)     
        {   
            var exists = false;
            for (var child = 0; child < childs.length; child++)
            {
                 if (arr[j]  == childs[child].value)
                 { 
                    exists = true;
                    break;
                 }
            }            
            if (!exists)
            {
                document.getElementById('p'+index+arr[j]).style.display = 'block';
            }
        }
    }
}

/*
 * fonction qui gère le resultat de xmlhttp et met à jours les choix de selections
 * 
 * */
var handleSuccess = function(o) {
 	var arr = o.responseText.split('@');
 	if ('annonceur' == arr[0])
 		updateDivs('1',arr,1);
 	else if ('campagne' == arr[0])
 	 	updateDivs('2',arr,1);
 	else if ('marque' == arr[0])
 		updateDivs('3',arr,1);
 	else if ('regie' == arr[0])
 		updateDivs('4',arr,1);
 	else if ('rue' == arr[0])
 		updateDivs('5',arr,1);
 	else 
 		updateDivs('6',arr,1);
};

/*
 * fonction qui gère le resultat de xmlhttp et met à jours les choix de selections
 * 
 * */
var handleSuccess3 = function(o) {
 	var arr = o.responseText.split('@');
 	if ('annonceur' == arr[0])
 		updateDivs('1',arr,2);
 	else if ('campagne' == arr[0])
 	 	updateDivs('2',arr,2);
 	else if ('marque' == arr[0])
 		updateDivs('3',arr,2);
 	else if ('regie' == arr[0])
 		updateDivs('4',arr,2);
 	else if ('rue' == arr[0])
 		updateDivs('5',arr,2);
 	else 
 		updateDivs('6',arr,2);
};

/*
 * fonction qui gère le resultat de xmlhttp et met à jours les choix de selections lors d'une annulation
 * 
 * */
var handleSuccess2 = function(o) {
 	document.getElementById('content').innerHTML = o.responseText;
    init(); 
};

/*
 * fonction callback de xmlhttp
 * 
 * */
var callback =
{
    success:handleSuccess,
    failure:handleFailure
};

/*
 * fonction callback de xmlhttp
 * 
 * */
var callback2 =
{
    success:handleSuccess2,
    failure:handleFailure
};

/*
 * fonction callback de xmlhttp
 * 
 * */
var callback3 =
{
    success:handleSuccess3,
    failure:handleFailure
};

var handleFailure = function(o) {
    alert("Submission failed: " + o.status);
};


//global variables that can be used by ALL the function son this page.
var inputs;
var imgFalse = '../../public/css/images/false.png';
var imgTrue = '../../public/css/images/true.png';

//this function runs when the page is loaded, put all your other onload stuff in here too.
function init() {
    replaceChecks();
}

function replaceChecks() {
	
	//get all the input fields on the page
	inputs = document.getElementsByTagName('input');

	//cycle trough the input fields
	for(var i=0; i < inputs.length; i++) {

		//check if the input is a checkbox
		if(inputs[i].getAttribute('type') == 'checkbox') {
			
			//create a new image
			var img = document.createElement('img');
			
			//check if the checkbox is checked
			/*if(inputs[i].checked) {
				img.src = imgTrue;
			} else {*/
				img.src = imgFalse;
			//}

			//set image ID and onclick action
			img.id = 'checkImage'+inputs[i].id;
			//set image 
			img.onclick = new Function('checkChange('+i+')');
			//place image in front of the checkbox
			inputs[i].parentNode.insertBefore(img, inputs[i]);
			
			//hide the checkbox
			inputs[i].style.display='none';
		}
	}
}

//change the checkbox status and the replacement image
function checkChange(i) {

	if(inputs[i].checked) {
	    if ('annonceur' == getId(inputs[i])){
	        delete annonceurs[inputs[i].id];			
        }        
        else if('campagne' == getId(inputs[i])){
	        delete campagnes[inputs[i].id];
        }
        else if('marque' == getId(inputs[i])){
	        delete marques[inputs[i].id];
        }
        else if('regie' == getId(inputs[i])){
	        delete regies[inputs[i].id];
        }
        else if('rue' == getId(inputs[i])){
	        delete rues[inputs[i].id];
        }
        else{
	        delete formats[inputs[i].id];
        }
		inputs[i].checked = '';
		document.getElementById('checkImage'+inputs[i].id).src=imgFalse;
	} else {
	    if ('annonceur' == getId(inputs[i])){
	        annonceurs[inputs[i].id] = inputs[i].id;		
        }        
        else if('campagne' == getId(inputs[i])){
	        campagnes[inputs[i].id] = inputs[i].id;
        }
        else if('marque' == getId(inputs[i])){
	        marques[inputs[i].id] = inputs[i].id;
        }
        else if('regie' == getId(inputs[i])){
	        regies[inputs[i].id] = inputs[i].id;
        }	    
        else if('rue' == getId(inputs[i])){
	        rues[inputs[i].id] = inputs[i].id;
        }	    
        else{
	        formats[inputs[i].id] = inputs[i].id;
        }	    
		inputs[i].checked = 'checked';
		document.getElementById('checkImage'+inputs[i].id).src=imgTrue;
	}
}

var size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};


function getId(elem)
{
    temp = elem.id.split('_');
    return temp[0];
}

function getValue(elem)
{
    temp = elem.split('_');
    return temp[1];
}

function getValues(obj)
{
    for (var i in obj)
	{
		alert('obj[\''+i+'\'] is ' + obj[i])
	}
}

function printData(obj,div,index)
{
	indice = index+10;
    hidden_div = document.getElementById("h_"+div.id);
	for (var data in obj)
	{
		div.innerHTML += '<p id="'+indice+getValue(data)+'"><a href="javascript:restore('+index+','+"'"+getValue(data).replace(/'/g,"\\'")+"'"+')"><img src= "../../public/css/images/remove.gif" alt="" border="0"/></a> '+getValue(data)+'</p>';	
        hidden_div.innerHTML += '<input type="hidden" name="'+div.id+'[]" id="'+indice+getValue(data)+'" value="'+getValue(data)+'" />';
    }
}

function getObjPostValues(arr)
{
   var postData = '';
   var types = ['annonceur','campagne','marque','regie','rue','format'];
   var index = 0;
   for (val in arr)
   {      
       
       if (index > 0) postData += '&';
       index++;
       postData += 'nb'+val+'='+arr[val].length;
       for (i in arr[val])
       {
           
           postData += '&'+val+i+'='+arr[val][i].replace(/\+/g, "*plus");
       }
   }   
   return postData;
}

function removeElements(obj,flag,index){
	for (var i in obj)
	{
		var elem = document.getElementById('p'+index+getValue(obj[i]));
		elem.style.display = 'none';
		document.getElementById(obj[i]).checked = '';
		document.getElementById('checkImage'+obj[i]).src=imgFalse;
		if (flag == 1)
			delete obj[inputs[i].id];
	}
}

function restore(index,data)
{
	var types = ['annonceur','campagne','marque','regie','rue','format'];
	if (types[parseInt(index)-1] == 'annonceur')
    {		
		delete annonceurs['annonceur_'+data];
    }
	if (types[parseInt(index)-1] == 'campagne')	
    {	
		delete campagnes['campagne_'+data];
    }
	if (types[parseInt(index)-1] == 'marque')
    {		
		delete marques['marque_'+data];
    }
	if (types[parseInt(index)-1] == 'regie')	
    {	
		delete regies['regie_'+data];
    }
	if (types[parseInt(index)-1] == 'rue')	
    {	
		delete regies['rue_'+data];
    }
	if (types[parseInt(index)-1] == 'format')	
    {	
		delete regies['format_'+data];
    }
	var parent = document.getElementById(types[parseInt(index)-1]);
  	var child = document.getElementById(index.toString()+'10'+data);
  	child.parentNode.removeChild(child);	
    document.getElementById("h_"+types[parseInt(index)-1]).removeChild(document.getElementById(index.toString()+'10'+data));
    filter(2);  
    if (document.getElementById('annonceur'))
    {
        if (document.getElementById('annonceur').innerHTML == '<h3>annonceur</h3>')
            document.getElementById('right').removeChild(document.getElementById('annonceur'));        
    }
    if (document.getElementById('campagne'))
    {
        if (document.getElementById('campagne').innerHTML == '<h3>campagne</h3>')
            document.getElementById('right').removeChild(document.getElementById('campagne'));        
    }
    if (document.getElementById('marque'))
    {
        if (document.getElementById('marque').innerHTML == '<h3>marque</h3>')
            document.getElementById('right').removeChild(document.getElementById('marque'));       
    }
    if (document.getElementById('regie'))
    {
        if (document.getElementById('regie').innerHTML == '<h3>regie</h3>')
            document.getElementById('right').removeChild(document.getElementById('regie'));         
    }   
    if (document.getElementById('rue'))
    {
        if (document.getElementById('rue').innerHTML == '<h3>rue</h3>')
            document.getElementById('right').removeChild(document.getElementById('rue'));         
    }   
    if (document.getElementById('format'))
    {
        if (document.getElementById('format').innerHTML == '<h3>format</h3>')
            document.getElementById('right').removeChild(document.getElementById('format'));         
    }   
    
    if (document.getElementById('right').innerHTML == '')
    {
        cancel();
    }
}

function afficher()
{ 
    if (document.getElementById('right').innerHTML == '')
    {
        document.getElementById("messageAdmin").style.display = "block";
        document.getElementById("messageAdmin").style.width="265px";
        document.getElementById("messageAdmin").innerHTML = "Il faut faire au moins un choix";
        counter(5);
    }
    else{
        if (document.getElementById('annonceur'))
        {
            if (document.getElementById('annonceur').innerHTML == '<h3>annonceur</h3>')
                document.getElementById('right').removeChild(document.getElementById('annonceur'));
        }
        if (document.getElementById('campagne'))
        {
            if (document.getElementById('campagne').innerHTML == '<h3>campagne</h3>')
                document.getElementById('right').removeChild(document.getElementById('campagne'));
        }
        if (document.getElementById('marque'))
        {
            if (document.getElementById('marque').innerHTML == '<h3>marque</h3>')
                document.getElementById('right').removeChild(document.getElementById('marque'));
        }
        if (document.getElementById('regie'))
        {
            if (document.getElementById('regie').innerHTML == '<h3>regie</h3>')
                document.getElementById('right').removeChild(document.getElementById('regie')); 
        }   
        if (document.getElementById('rue'))
        {
            if (document.getElementById('rue').innerHTML == '<h3>rue</h3>')
                document.getElementById('right').removeChild(document.getElementById('rue')); 
        }   
        if (document.getElementById('format'))
        {
            if (document.getElementById('format').innerHTML == '<h3>format</h3>')
                document.getElementById('right').removeChild(document.getElementById('format')); 
        }   
    }
}

function counter(time)
{    
  var t=setTimeout("removeMessage()",time*1000);
}

function removeMessage()
{
    document.getElementById("messageAdmin").innerHTML = "";
    document.getElementById("messageAdmin").style.display = "none";
}

function send()
{
    if (document.getElementById('right').innerHTML == '')
    {
        document.getElementById("messageAdmin").style.display = "block";
        document.getElementById("messageAdmin").style.width="330px";
        document.getElementById("messageAdmin").innerHTML = "Il faut faire au moins une s&eacute;l&eacute;ction.";
        window.scrollTo(0,0);
        counter(5);
    }
    else{
        document.getElementById("messageAdmin").style.display = "block";
        document.getElementById("messageAdmin").style.width="330px";
        document.getElementById("messageAdmin").innerHTML = "<blink>SVP veuillez patientez...</blink>";
        window.scrollTo(0,0);
        document.formData.submit();
    }
}

window.onload = init;
