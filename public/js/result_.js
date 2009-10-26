
function change()
{
    var select = document.getElementById('rselect');
    var form = document.getElementById('rform');
    form.action = select.options[select.selectedIndex].value;
    form.submit();
    
    //window.location = select.options[select.selectedIndex].value);
    //this.options[this.selectedIndex].selected=true;
}


