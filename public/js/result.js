function graphes()
{   
    window.location = "http://"+ getHost()+"/index.php/main/afficher_graphes";
}

function pige()
{
    window.location = "http://"+ getHost()+"/index.php/main/afficher";
}

function pdf()
{
    window.location = "http://"+ getHost()+"/index.php/main/rapport";
}

function carte()
{
    window.location = "http://"+ getHost()+"/index.php/main/afficher_carte";
}

function getHost() 
{
    var url = window.location.href;
    var urlparts = url.split("/");
    var host = urlparts[2];
    return host;
}

