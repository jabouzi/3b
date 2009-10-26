function init()
{	
	var handleSubmit = function() { 
		if (document.getElementById("human").value == "")  
		{     
    		var ok = validate();
			//alert(ok);
			if (ok){      
				checkLogin(document.getElementById("username").value,document.getElementById("password").value);  
			//YAHOO.send2friend.wait.show();
					//this.submit();
			}
		}
};

var validate = function() {
    //var data = this.getData();
    //var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var ok = 0;
    if (document.getElementById("username").value == "") {
        alert("SVP entrez votre nom!!.");
        ok++;
    }	
    else if (document.getElementById("password").value == "") {
        alert("SVP entrez votre mot de passe.");
        ok++;
    }
    if (0 == ok){
        return true;
    }
    else {
        return false;
    }
 };
 
var checkLogin = function(username,password){
    YAHOO.util.Connect.asyncRequest('POST', '/3B/index.php/login/check_login/'+username+'/'+password, callback);    
};

var submit = function(data){
	var postData = "name="+data[0]+"&email="+data[2]+"&type="+data[3]+"&permissions="+data[5];	
    YAHOO.util.Connect.asyncRequest('POST', '/3B/index.php/main/do_submit', callbackSubmit, postData);    
};

var handleSuccess = function(o) {	
	var result = o.responseText.split('#');
    //alert(result)
	if (1 == result.length)
	{ 
		alert("Les données entrées sont incorrectes");
	}
	else if (1 == result[4] && 2 == result[3])
	{
		window.location = "http://localhost/3B/index.php/main/do_submit";
	}
	else if (1 == result[4] && 1 == result[3])
	{
		window.location = "http://localhost/3B/index.php/admin";
	}
	else alert("Votre compte n'est pas actif");
 	//document.getElementById('content').innerHTML = o.responseText;
 	//init(); 	
};

var handleSuccessSubmit = function(o) {	
		
};

var callback =
{
    success:handleSuccess,
    failure:handleFailure
};

var callbackSubmit =
{
    success:handleSuccessSubmit,
    failure:handleFailure
};

var handleFailure = function(o) {
    alert("Submission failed: " + o.status);
};
 
	YAHOO.util.Event.addListener("loginButton", "click", handleSubmit);
}


//BrowserDetect.init();
YAHOO.util.Event.onDOMReady(init);
