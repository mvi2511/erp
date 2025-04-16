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
	    <script type="text/javascript" src="../js/orderline.js"></script>
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
		<?php

		//to create a new conection to the data base.
		$con = new SQLite3('erpeqem.db');	
		//conectamos las variables de php con sus correspondencias en el formulario html
		$nifPedido = $_POST['nifPedido'];	
		/*$cant = $_POST['cant'];
		$bot = $_POST['bot'];*/
		$fechacrea = date("Y-m-d");
	    $horacrea = date("H:i:s");
	    // query for create the order
		$sql = "INSERT INTO Pedidos(Cliente,Fechacrea,Horacrea) VALUES('$nifPedido','$fechacrea','$horacrea')";
		// we save the id of the order we just created
		$sqlmostrar = "SELECT Ref_Pedido FROM Pedidos ORDER BY fechacrea DESC, horacrea DESC LIMIT 1";
		$res = $con->query($sql);
		$resid = $con->query($sqlmostrar);
		while($datos = $resid->fetchArray(SQLITE3_ASSOC)){
			$nombre = $datos['Ref_Pedido'];
		}
		//echo($nombre);	
		$con->close();
		//nombre is the variable that includes the order reference number
		//include order header
		include 'cabeceraPedido.php';
		cabeceraPedidos($nombre);
		//end of header
		
		?>
		<form>
			<div class="container">
				<p>Referencia de Pedido: <input type="text" name="refped" id="refped" value="<?php echo $nombre ?>" readonly></p><br />		
				<p class="font-italic">Selecciona el producto, fija la cantidad y pulsa sobre "Añadir Línea"</p>	
		        <select id="product" placeholder="Producto">
		        <?php 	            
	                $sqlselectbot = "SELECT * FROM Productos"; 
	                $con2 = new SQLite3('../functional/erpeqem.db'); $resultado = $con2->query($sqlselectbot);
	                while($products = $resultado->fetchArray(SQLITE3_ASSOC)){
                        $ref = $products['Ref'];
                        $stock = $products['Cantidad'];
                        $description = $products['Descripcion']; $vintag = $products['Vintage']; 
                        //we show all the products to choose the one we want in the order
                        echo "
                            <option>
                                    $description | Stock: $stock | id ~$ref~
                            </option>
                        ";
                    }
		        ?>
		        </select>
		        <input type="number" id="canti" placeholder="Cantidad">
		        <input type="button" onclick="comprobstock()" value="Comprobar stock">
		        <input type="button" class="add-row" value="Añadir línea">
		        <!-- table for filling the order lines -->
			    <table class="bordes-table width-table margen-arriba-1 margen-abajo-1">
			        <thead class="bordes-table">
			            <tr class="bordes-table">
			                <th class="bordes-table">Borrar</th>
			                <th class="bordes-table">Producto</th>
			                <th class="bordes-table">Cantidad</th>
			            </tr>
			        </thead>
			        <tbody class="bordes-table">
			            <tr class="bordes-table" style="display: none;">
			                <td class="bordes-table"><input type="checkbox" name="record"></td>
			                <td class="bordes-table"></td>
			                <td class="bordes-table"></td>
			            </tr>
			        </tbody>
			    </table>
			    <button type="button" class="delete-row">Borrar seleccionados</button><br /><br />
			    <p class="font-italic">Cuando presiones "Confirmar Pedido" no podrás modificarlo.</p>
			    <button type="button" class="show">Confirmar Pedido</button>
			</div>
		</form>		
	</body>
</html>
	  
	