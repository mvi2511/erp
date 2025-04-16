$(document).ready(function(){
    $(".add-row").click(function(){
        var product = $("#product").val();
        var canti = $("#canti").val();
        var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + product + "</td><td>" + canti + "</td></tr>";
        $("table tbody").append(markup);
    });
    
    // Find and remove selected table rows
    $(".delete-row").click(function(){
        $("table tbody").find('input[name="record"]').each(function(){
            if($(this).is(":checked")){
                $(this).parents("tr").remove();
            }
        });
    });
    //declare the arrays for the products and quantities 
    var idPrLin = [];	
	var idCantLin = [];	
    //to take the values
    $(".show").click(function(){
    	//to find the fields in the dinamic table for sent to th database
        $("table tbody").find('input[name="record"]').each(function(){
            var valores = ($(this).parents("tr").children("td").text());
            //separate the values for this symbol and take the position of the array that we want 
        	valores = valores.split("~");	                	
            idPrLin.push(valores[1]);	
            idCantLin.push(valores[2]);	
            //merge in one array
            
        });
        var arraysProd = [idPrLin, idCantLin];
        var refPed = $('#refped').val();
    	//ajax for pass the array to php in order to upload to the database 
        $.ajax(
        {
        	method: "POST",
	        url: "subirPedLineasPed.php",
	        data: {arraysProd:arraysProd, refP:refPed}, 
	        success: function(){
	            window.location.href = "../functional/resumen.php?refPed="+refPed;		                	
			},
			error: function() {
		        alert('There was some error performing the AJAX call!');
		    }
       	}); 
    }); 
});    