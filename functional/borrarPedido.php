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
			<?php
				$borrar ="";			
				$borrar = ($_GET['borrar']);
				$con = new SQLite3('erpeqem.db');

				$sqlselect = "SELECT * FROM LineasPedido WHERE Id_Pedido LIKE '%".$borrar."%'";
				$result = $con->query($sqlselect);
				//array for push the order lines to a table, to show them
				while($sqlselect = $result->fetchArray(SQLITE3_ASSOC)){
					$prod[] = $sqlselect['Id_Botella'];
					$cant[] = $sqlselect['Cantidad'];	
				}	

				foreach ($prod as $indice => $valor){	  
			    	$prod = $valor;
					$cantidad = $cant[$indice];	
					$sql = "UPDATE Productos SET Cantidad = (Cantidad + '$cantidad') WHERE Ref LIKE '$prod'";
					$res = $con->query($sql);
				}
				$sqlpedido = "UPDATE Pedidos SET Cancelado = (Cancelado + '1') WHERE Ref_Pedido LIKE '%".$borrar."%'";
				$res2 = $con->query($sqlpedido);
				$con->close();
			?>
			<!-- screen that is shown if the client has been created correctly -->
			<div class="container margen-arriba-3">
				<p class="padding-error-nocli azul padding-error big">Pedido borrado satisfactoriamente</p>
			</div>
		</body>
</html>



