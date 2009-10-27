function graphes()
{   
    window.location = "http://"+ getHost()+"/main/afficher_graphes";
}

function pige()
{
    window.location = "http://"+ getHost()+"/main/afficher";
}

function pdf()
{
    window.location = "http://"+ getHost()+"/main/rapport";
}

function carte()
{
    window.location = "http://"+ getHost()+"/main/afficher_carte";
}

function getHost() 
{
    var url = window.location.href;
    var urlparts = url.split("/");
    var host = urlparts[2];
    return host;
}

