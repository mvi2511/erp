/***** POP UP ********************************/
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
$(window).on("load",function () {
    $(".trigger_popup_fricc").click(function(){
       $('.hover_bkgr_fricc').show();
    });
    $('.hover_bkgr_fricc').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
    $('.popupCloseButton').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
});

/***** function for search ********************/  
/***** client *********************************/
/*check that conf search returns a message from the database, otherwise
  no result will be obtained in the search, because that client does not exist */
var botonbuscar = document.getElementById("confbuscar");
if(botonbuscar){
    //retrieve the information from the confsearch button from html/mostrarCli.html
    document.getElementById("confbuscar").addEventListener("click", enviar, false);
        
    function enviar(){
        //url calls the search.php file to display the searched client.
        //the if selects which radio button has been selected in the html document
        if (document.querySelector('input[name="modobusc"]:checked').value == "nombre"){
            //search by name
            var busqueda = document.getElementById('buscar').value;
            var url = "../functional/buscar.php?busqueda="+busqueda;
        }else{
            //search by nif
            if(document.querySelector('input[name="modobusc"]:checked').value == "nif"){
                var buscnif =  document.getElementById('buscanif').value;
                url = "../functional/buscar.php?buscnif="+buscnif;
            } else {
                //búsqueda by phone
                if(document.querySelector('input[name="modobusc"]:checked').value == "telefono")
                var busctel =  document.getElementById('buscatel').value;
                url = "../functional/buscar.php?busctel="+busctel;
            }
        }
        if (url){
            window.location = url;
        } 
    }
}
/***** orders *********************************/
/***** create order *********************************/
/*check the returns of a message from the database, otherwise
  no result will be obtained in the search, because that client does not exist */
var botonbuscar = document.getElementById("buscarCliPedidos");
if(botonbuscar){
    //retrieve the button information buscarClPedidos from html/mostrarCli.html
    document.getElementById("buscarCliPedidos").addEventListener("click", enviar2, false);
        
    function enviar2(){
        //buscar = id in input html 
        //busqueda = var js to connect with php (subirPedido.php)
        //url calls the uploadOrder.php file to display the searched customer.
        //the if selects which radio button has been selected in the html document
        if (document.querySelector('input[name="modobusCliPed"]:checked').value == "nombre"){
            //search by name
            var busqueda = document.getElementById('buscar').value;
            var url = "../functional/subirPedido.php?busqueda="+busqueda;
        }else{
            //search by nif
            if(document.querySelector('input[name="modobusCliPed"]:checked').value == "nif"){
                var buscnif =  document.getElementById('buscanif').value;
                url = "../functional/subirPedido.php?buscnif="+buscnif;
            } else {
                //search by phone
                if(document.querySelector('input[name="modobusCliPed"]:checked').value == "telefono")
                var busctel =  document.getElementById('buscatel').value;
                url = "../functional/subirPedido.php?busctel="+busctel;
            }
        }
        if (url){
            window.location = url;
        } 
    }
}
/**** searching orders *******/
var botonbuscped = document.getElementById("confpedido");
if(botonbuscped){
    //retrieve the information from the confsearch button from html/mostrarCli.html
    document.getElementById("confpedido").addEventListener("click", buscapedido, false);
        
    function buscapedido(){
        //url calls the search.php file to display the searched client.
        //the if selects which radio button has been selected in the html document
        if (document.querySelector('input[name="buscpedido"]:checked').value == "ref"){
            //search by name
            var buscaref = document.getElementById('buscaref').value;
            var url = "../functional/buscarPedido.php?buscaref="+buscaref;
        }else{
            //search by nif
            if(document.querySelector('input[name="buscpedido"]:checked').value == "nif"){
                var buscarnif =  document.getElementById('buscarnif').value;
                url = "../functional/buscarPedido.php?buscarnif="+buscarnif;
            } else {
                if(document.querySelector('input[name="buscpedido"]:checked').value == "fechas"){
                    var primfecha =  document.getElementById('primfecha').value;
                    var segfecha =  document.getElementById('segfecha').value;
                    url = "../functional/buscarPedido.php?primfecha="+primfecha+"&segfecha="+segfecha;
                }
            }
        }
        if (url){
            window.location = url;
        } 
    }
}
//select customer in database to create order
function escogeCliente() {
    var x = document.getElementById("cliSelect");
    var value = x.options[x.selectedIndex].value;
    //document.write("valor de x" + x + "<br> valor de value: " + value + "<br>");
    //with ~ we delimit the id, in our case the ID, which is unique and we will use it to designate the client we are referring to
    //with match, what goes inside these two markers is separated
    var id = value.match("~(.*)~");
    //document.write("valor de id " + id[1]);
    var id = id[1];
    if (id){
        window.location = "../functional/subirPedCont.php?id="+id;
    }
}

//test if there is available stock of this product
function comprobstock(){
    var cant = document.getElementById("canti").value;
    var productstock = document.getElementById("product").value;
    var matches = productstock.match(/\|(.*?)\|/);
    var matches = matches[1];
    var stockcomprob = parseInt(matches.match(/\d+/g));
    
    if (cant > stockcomprob) {
        window.alert("STOCK INSUFICIENTE");
    } else {
        window.alert("Stock disponible");
    }
}
