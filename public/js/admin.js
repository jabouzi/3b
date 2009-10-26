
var familles = new Object();

function init() {
	//replaceChecks();
}

function get_familles()
{
    YAHOO.util.Connect.asyncRequest('POST', '/3B/index.php/admin/get_familles', callback3);
    //return obj.conn[responseText];
    //alert(text.conn['responseText']);
    //alert(familles.conn.responseText);
}

function change_data(type)
{
    //alert(familles);
    var id = document.getElementById('id').value;
    var nom = document.getElementById('nom').value;
    var email = document.getElementById('email').value;
    if (2 == type)
    {
        var contact = document.getElementById('contact').value;
        var tel = document.getElementById('tel').value;
        var address = document.getElementById('address').value;
    }
    else{
        var prenom = document.getElementById('prenom').value;
    }
    var active = document.getElementById('activeCheckbox').checked;
    permissions = '';
    if (3 == type)
    {
        familles = [0,0,1,2,3];
    }
    for (var index = 1; index < familles.length; index++)
    {        
        if (document.getElementById('f_'+familles[index]).checked)
        {
            permissions += familles[index]+'#';
        }
    }
    if (2 == type)
    {
        var postData = "id="+id+"&nom="+nom+"&email="+email+"&contact="+contact+"&tel="+tel+"&address="+address+"&active="+active+"&permissions="+permissions;
    }
    else
    {
        var postData = "id="+id+"&nom="+nom+"&email="+email+"&prenom="+prenom+"&active="+active+"&permissions="+permissions;
    }
    YAHOO.util.Connect.asyncRequest('POST', '/3B/index.php/admin/change_data/'+type, callback4, postData);
}

function change_notes()
{   
    var id = document.getElementById('id').value;
    var nom = document.getElementById('nom').value;
    var notes = document.getElementById('notes').value;
    var postData = "id="+id+"&nom="+nom+"&notes="+notes;
    YAHOO.util.Connect.asyncRequest('POST', '/3B/index.php/admin/change_notes_data', callback4, postData);
}

function get_data(type)
{
    //removeMessage();
    var radios = document.getElementsByName('activeRadio');
    var len = radios.length
    var res = 0;
    for (var index = 0; index < len; index++)
    {
        if (radios[index].checked == true) 
        {
            res = radios[index].value;  
            break;          
        }
    }
    if (res != 0)
    {
        YAHOO.util.Connect.asyncRequest('POST', '/3B/index.php/admin/get_data/'+res+'/'+type, callback); 
        YAHOO.util.Connect.asyncRequest('POST', '/3B/index.php/admin/get_right_data/'+res, callback2);  
        YAHOO.util.Connect.asyncRequest('POST', '/3B/index.php/admin/get_familles', callback3);
        document.getElementById('applyclient').disabled = false; 
    }
    else{
         document.getElementById("messageAdmin").style.display = "block";
         document.getElementById("messageAdmin").style.width="190px";
         document.getElementById("messageAdmin").innerHTML = "Il faut faire un choix";
         counter(5);
    }
}

var handleSuccess = function(o) {	
	document.getElementById('divdonnees').innerHTML = o.responseText;    
};

var handleSuccess2 = function(o) {	
	document.getElementById('right').innerHTML = o.responseText;    
};

var handleSuccess3 = function(o) {	
	familles = o.responseText.split('#');        
};

var handleSuccess4 = function(o) {	
	if (o.responseText.length == 0) 
    {
        document.getElementById("messageAdmin").style.display = "block";
        document.getElementById("messageAdmin").style.width="330px";
        document.getElementById("messageAdmin").innerHTML = "Changements effectu&eacute;s avec succ&egrave;s";    
        get_data(document.getElementById("type").value);
    }
    else{
        document.getElementById("messageAdmin").style.display = "block";
        document.getElementById("messageAdmin").style.width="225px";
        document.getElementById("messageAdmin").innerHTML = "erreur contacter l'admin";        
    }
    counter(10);
};

var callback =
{
    success:handleSuccess,
    failure:handleFailure
};

var callback2 =
{
    success:handleSuccess2,
    failure:handleFailure
};

var callback3 =
{
    success:handleSuccess3,
    failure:handleFailure
};

var callback4 =
{
    success:handleSuccess4,
    failure:handleFailure
};

var handleFailure = function(o) {
    alert("Submission failed: " + o.status);
};

function getObj(obj)
{
   for (var data in obj)
   {
       //if (data == 'responseText')
		    alert(data + " " + obj[data]);		
   }   
}

function encode_utf8( s )
{
  for(var c, i = -1, l = (s = s.split("")).length, o = String.fromCharCode; ++i < l;
			s[i] = (c = s[i].charCodeAt(0)) >= 127 ? o(0xc0 | (c >>> 6)) + o(0x80 | (c & 0x3f)) : s[i]
     );
  return s.join("");

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

function upload()
{
    //document.uploadForm.submit();
    document.getElementById("loading").innerHTML = '<blink>SVP Patientez pendant que les donn&eacute;es sont enregistr&eacute;es...<blink>';
    
}

window.onload = init;
