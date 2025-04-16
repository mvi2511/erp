<!DOCTYPE html>
<html>
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
		<!-- menu popup -->
	    <a class="trigger_popup_fricc btn btn-black">MENÚ</a>
	    <div class="hover_bkgr_fricc">
	        <span class="helper"></span>
	        <div>
	            <div class="popupCloseButton">&times;</div>
	            <p><a class="menu" href="../index.html">Home</a></p>
	            <p><a class="menu" href="../html/clientes.html">Clientes</a></p>
	            <p><a class="menu" href="../html/pedidos.html">Pedidos</a></p>
	            <p><a class="menu" href="../html/stock.html">Stock</a></p>
	        </div>
	    </div>
    <!-- end of menu --> 
		<div class="container">
			<h4>RESUMEN DEL PEDIDO</h4>
			<?php 
				//$RefPe ="";			
				$nombre = ($_GET['refPed']);
				//include order header
				include 'cabeceraPedido.php';
				cabeceraPedidos($nombre);
				echo "<p class='container'>Referencia de Pedido: ". $nombre ."</p>";
				//end of header
				//query for order lines
				$sqlselect2 = "SELECT * FROM LineasPedido WHERE Id_Pedido LIKE '%".$nombre."%'";
				$con = new SQLite3('erpeqem.db');
							$result2 = $con->query($sqlselect2);
				//array for push the order lines to a table, to show them
				while($lineas = $result2->fetchArray(SQLITE3_ASSOC)){
					$prod[] = $lineas['Id_Botella'];
					$cant[] = $lineas['Cantidad'];		
				}	
				$con->close();
				print ("<table border=2 width=300>");
				print ("<tr><td align=center>Producto</td><td align=center>Cantidad</td></tr>"); 
			 	foreach ($prod as $indice => $valor) {	
			 		print ("<tr>");
			    	$prod = $valor;
			    	$cantidad = $cant[$indice];	
			    		print ("<td align=center>".$prod."</td><td align=center>".$cantidad."</td>");
			    	print ("</tr>");
				}
				print("</table>");
			 ?>
		</div>
	</body>
</html>



