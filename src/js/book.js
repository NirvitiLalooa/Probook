function getXmlHttpRequest( ) {
    var xmlHttpObj;
    if (window.XMLHttpRequest) {
        xmlHttpObj = new XMLHttpRequest( );
    } else {
        try {
            xmlHttpObj = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlHttpObj = new
                ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                xmlHttpObj = false;
            }
        }
    }
    return xmlHttpObj;
}

function getRecipe( ) {
    if (!xmlhttp){
        xmlhttp = getXmlHttpRequest( );
    }
    if (!xmlhttp)
        return;

    var book =
        encodeURIComponent(document.getElementById('input').value);
    var qry = 'search=' + book;
    var url = 'result.html?' + qry;
    xmlhttp.open('GET', url, true);
    xmlhttp.onreadystatechange = printRecipe();
    console.log('that');
    xmlhttp.send(null);
}

function printRecipe() {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    alert(xmlhttp.getAllResponseHeaders( ));
    alert(xmlhttp.responseText);
    console.log(xmlhttp.responseText);
    }
}