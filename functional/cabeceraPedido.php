<?php
/*file that pastes a header in the order or from where the function is called, the name parameter is the order id*/
	//We extract NIF from the order
	$sqlnif = "SELECT Cliente FROM Pedidos WHERE Ref_Pedido LIKE '%".$nombre."%'";
	$con = new SQLite3('erpeqem.db');
	$resnif = $con->query($sqlnif);
	while($datoNif = $resnif->fetchArray(SQLITE3_ASSOC)){
		$nifCli = $datoNif['Cliente'];
	}
	//sql statement to extract customer data
	$sqlselect = "SELECT Nombre, Direccion, Pais, Telefono, IVA FROM Clientes WHERE NIF_CIF LIKE '%".$nifCli."%'";
	$resultCli = $con->query($sqlselect);		
	while($datosCli = $resultCli->fetchArray(SQLITE3_ASSOC)){
		$cliente = $datosCli['Nombre'];
		$direccion = $datosCli['Direccion'];
		$pais = $datosCli['Pais'];	
		$telefono = $datosCli['Telefono'];
		$IVA = $datosCli['IVA'];			
	}			
	$con->close();
	function cabeceraPedidos($RefPedido){}
?>
<div class="container margen-arriba-3">
    <p>Nombre y apellidos / Razón social: <?php echo $cliente ?> </p>
    <p>Dirección: <?php echo $direccion ?></p>
    <p>Teléfono: <?php echo $telefono ?></p>
    <p>País: <?php echo $pais ?> <span class="margen-izda-2">Tipo de IVA: <?php echo $IVA ?></span></p>            
	<p>NIF / CIF: <input type="text" name="nifPedido" value="<?php echo $nifCli ?>" readonly></p>            	
</div>