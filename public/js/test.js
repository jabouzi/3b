function init_divs()
{
    document.getElementById('year').value = '';
    document.getElementById("month").value = '';
    document.getElementById('in').value = '';
    document.getElementById('out').value = '';
}

function ajouter(id)
{
    if (1 == id)
    {
        var radios = document.getElementsByName('annee');
        var len = radios.length
        var annee = 0;
        for (var index = 0; index < len; index++)
        {
            if (radios[index].checked == true) 
            {
                annee = radios[index].value;  
                break;          
            }
        }
        //alert(annee[annee.selectedIndex].value);
        document.getElementById('d1').innerHTML = "<p><label>Ann&eacute;e: "+annee+"</label></p>";        
        document.getElementById('year').value =annee;
        cal.cfg.setProperty("pagedate", 1 + "/" + annee);
        cal.render();
    }
    else if (2 == id)
    {
        var radios = document.getElementsByName('annee');
        var len = radios.length
        var annee = 0;
        for (var index = 0; index < len; index++)
        {
            if (radios[index].checked == true) 
            {
                annee = radios[index].value;  
                break;          
            }
        }
        var radios = document.getElementsByName('mois');
        var len = radios.length
        var mois = 0;
        var smois = '';
        for (var index = 0; index < len; index++)
        {
            if (radios[index].checked == true) 
            {
                smois = radios[index].value; 
                mois = index+1;  
                break;          
            }
        }
        document.getElementById('d1').innerHTML = "<p><label>Ann&eacute;e: "+annee+"</label></p>";        
        document.getElementById('year').value =annee;
        document.getElementById('d2').innerHTML = "<p><label>Mois: "+smois+"</label></p>";
        document.getElementById('month').value = mois;
        cal.cfg.setProperty("pagedate", mois + "/" + annee);
        cal.render();
    }
    else if (3 == id)
    {
        var in_ = document.getElementById('in').value;
        var out = document.getElementById('out').value;
        document.getElementById('d3').innerHTML = "<p><label>D&eacute;but: "+in_+"</label></p><p><label>Fin: "+out+"</label></p>";
        
    }
}

YAHOO.util.Event.onDOMReady(init_divs);
