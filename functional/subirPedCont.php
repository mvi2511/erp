<!DOCTYPE html>
<html>
<!-- Shows the customer in the order -->
<head>
	<title>ERPeqEmp: Bodega VinosLOF</title>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <meta name="author" content="Maria del Valle Iglesias">
    <!-- description -->
    <meta name="description" content="ERP for small companies">
    <!-- favicon -->
    <link rel="shortcut icon" href="../images/favicon.png">
    <!-- bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- style -->
    <link rel="stylesheet" href="../css/style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="../css/responsive.css" /> 
    <!-- js -->    
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>   
</head>
<body> 
	<?php
		if(isset($_GET['id'])){
			//we create variable nif from the client id
			$nif = $_GET['id'];
			//sql statement to extract customer data
			$sqlselect = "SELECT Nombre, Direccion, Pais, Telefono, IVA FROM Clientes WHERE NIF_CIF LIKE '%".$nif."%'";
			//Connection with bbdd
			$con = new SQLite3('erpeqem.db');
			$result = $con->query($sqlselect);
			
			while($datos = $result->fetchArray(SQLITE3_ASSOC)){
				$nombre = $datos['Nombre'];
				$direccion = $datos['Direccion'];
				$pais = $datos['Pais'];	
				$telefono = $datos['Telefono'];
				$IVA = $datos['IVA'];				
			}	
	?>
		<div class="container margen-arriba-3">
			<form action="../functional/subirPedCont2.php" method="post">				
	            <p>Nombre y apellidos / Razón social: <?php echo $nombre ?> </p>
	            <p>Dirección: <?php echo $direccion ?></p>
	            <p>Teléfono: <?php echo $telefono ?></p>
	            <p>País: <?php echo $pais ?> <span class="margen-izda-2">Tipo de IVA: <?php echo $IVA ?></span></p>            
            	<p>NIF / CIF: <input type="text" name="nifPedido" value="<?php echo $nif ?>" readonly></p>
            	<input type="submit" name="submit" value="Añadir líneas de pedido"/>
            </form>
        </div>	         
	<?php 
		$con->close();
	}
?>