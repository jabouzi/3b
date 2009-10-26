function init() {
try{
    YAHOO.alert.simpledialog1 = new YAHOO.widget.SimpleDialog("simpledialog",
    {
        width: "250px",
        fixedcenter: true,
        modal: false,
        visible: false,
        draggable: true,
        close: true,
        text: '',
        constraintoviewport: false
    } );

    YAHOO.alert.simpledialog1.setHeader("Alerte<hr>");
    YAHOO.alert.simpledialog1.render("info");
}
catch(e){

}
    var handleOK = function() {
        this.hide();
    };

    // surcharger la fonction alert de javascript
    var _alert = window.alert;
    // Add your code here!
    if(this._alert==null){
        // save old alert function
        this._alert=window.alert;
        // redefine alert function
        window.alert=function(message){
            YAHOO.alert.simpledialog1.show();
            YAHOO.alert.simpledialog1.cfg.setProperty("text", '<center><strong>'+message+'</strong><br><br><p class="submitbutton center"><button id="ok">ok</button></p></center>');
            YAHOO.util.Event.addListener("ok", "click", handleOK, YAHOO.alert.simpledialog1, true);
        }
    }   

}

YAHOO.util.Event.addListener(window, "load", init);
