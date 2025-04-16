<?php
	//get the ajax array
	$arraysProdu = $_POST['arraysProd'];
	$refPed = $_POST['refP'];
	//separate the multiarray in both: products and quantities
	$productos = $arraysProdu[0];
	$cantidades =  $arraysProdu[1];
	//function for delete the null elements from the array
	$products = array_filter($productos);
	$cantidaes =  array_filter($cantidades);
	//Connection with the database
	$con = new SQLite3('erpeqem.db');
	//array for getting products with the correspondent quantity 	
	//valor is the value of the first array, indices es index of the array products is the array that we want to fecth
    foreach ($products as $indice => $valor) {	  
    	$producto = $valor;
    	$cant = $cantidaes[$indice];				
		$sql = "INSERT INTO LineasPedido(Id_Pedido,Id_Botella,Cantidad) VALUES('$refPed','$producto','$cant')";
		$sqlcant = "UPDATE Productos SET Cantidad = (Cantidad - '$cant') WHERE Ref LIKE '$producto'";
		$res = $con->query($sql);
		$res2 = $con->query($sqlcant);	
	}

	$con->close();
  	//$refPedido = $_POST['refped'];
  	
?>