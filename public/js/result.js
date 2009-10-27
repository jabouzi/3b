function graphes()
{
    alert(getHost());
    window.location = "http://dev.media3b.com/index.php/main/afficher_graphes";
}

function pige()
{
    window.location = "http://dev.media3b.com/index.php/main/afficher";
}

function pdf()
{
    window.location = "http://dev.media3b.com/index.php/main/rapport";
}

function carte()
{
    window.location = "http://dev.media3b.com/index.php/main/afficher_carte";
}

function getHost() 
{
    var url = window.location;
    var urlparts = url.split("/");
    var host = urlparts[2];
    return host;
}

