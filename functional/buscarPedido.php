<!DOCTYPE html>
<!-- codigo para buscar pedidos, pte de hacer -->
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
	<script type="text/javascript"></script>
	
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
		<div class="container">
			<p class="big">RESULTADOS DE LA BUSQUEDA</p>
			<hr>			
			<?php
				//include order header
				//include 'cabeceraPedido.php';
				//search order
				if(isset($_GET['buscaref'])){
					$buscref = $_GET['buscaref'];
					//even is redundant, is much less code with this query
					$sql = "SELECT Ref_Pedido FROM Pedidos WHERE Ref_Pedido LIKE '%".$buscref."%'";

				}else if(isset($_GET['buscarnif'])){
					$buscnif = $_GET['buscarnif'];
					
					$sql = "SELECT Ref_Pedido FROM Pedidos WHERE Cliente LIKE '%".$buscnif."%'";

				}else if(isset($_GET['primfecha']) && isset($_GET['segfecha'])){
					$primfecha = $_GET['primfecha'];
					$segfecha = $_GET['segfecha'];
					
					$sql = "SELECT Ref_Pedido FROM Pedidos WHERE Fechacrea BETWEEN '".$primfecha."' AND '".$segfecha."'";
					
				}
				
				$con = new SQLite3('erpeqem.db');
				
				$res = $con->query($sql);
				
				if($res){
					while($datos = $res->fetchArray(SQLITE3_ASSOC)){	
						$refPed[] = $datos['Ref_Pedido'];
					}
					$con->close();
					if (is_null($refPed)) {
						?>
						<div class="container margen-arriba-3">
							<p class="padding-error-nocli rojo padding-error big">El pedido no existe</p>
						</div>
					<?php
					} else {
					
						foreach ($refPed as $key => $value) {	
							$refPedido = $value;
							//----------------- header ---------------------//		 		
							$sqlnif = "SELECT Cliente, Cancelado FROM Pedidos WHERE Ref_Pedido LIKE '%".$refPedido."%'";
							$con = new SQLite3('erpeqem.db');
							$resnif = $con->query($sqlnif);
							
							while($datoNif = $resnif->fetchArray(SQLITE3_ASSOC)){
								$nifCli = $datoNif['Cliente'];
								$cancel = $datoNif['Cancelado'];
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
							// comprobation if the order is cancel in order to show details
							if($cancel == 1){
								echo "
									<p style='color: #F24747'><b>CANCELADO</b></p>
									<p style='color: #C8C8C8'><b>Referencia de pedido: </b><span id='refBorrar'>$refPedido</span><p></p>
									<p style='color: #C8C8C8'><b>Nombre o razón social: </b>$cliente</p>
									<p style='color: #C8C8C8'><b>NIF/CIF: </b>$nifCli</p>
									<p style='color: #C8C8C8'><b>Dirección: </b>$direccion</p>
									<p style='color: #C8C8C8'><b>País: </b>$pais</p>
									<p style='color: #C8C8C8'><b>Teléfono: </b>$telefono</p>
									<p style='color: #C8C8C8'><b>Tipo de IVA: </b>$IVA</p>
								";
							} else {
								echo "
									<p><b>Referencia de pedido: </b><span id='refBorrar'>$refPedido</span></p>
									<p><b>Nombre o razón social: </b>$cliente</p><p><b>NIF/CIF: </b>$nifCli</p>
									<p><b>Dirección: </b>$direccion<p></p><b>País: </b>$pais</p>
									<p><b>Teléfono: </b>$telefono</p><p><b>Tipo de IVA: </b>$IVA</p>
								";
							}
							//----------------- end of header ---------------------//	
							//----------------- order lines ---------------------//	
							//query for order lines
							$sqlselect2 = "SELECT * FROM LineasPedido WHERE Id_Pedido LIKE '%".$refPedido."%'";
							$con = new SQLite3('erpeqem.db');
							$result2 = $con->query($sqlselect2);
							
							//array for push the order lines to a table, to show them
							//in order to avoid the error (Uncaught Error: [] operator not supported for strings) is mandatory declare the arrays
							$prod = array();
							$cant = array();
							while($lineas = $result2->fetchArray(SQLITE3_ASSOC)){
								$prod[] = $lineas['Id_Botella'];
								$cant[] = $lineas['Cantidad'];		
							}	
							$con->close();
							print ("<table border=2 width=300>");
							if($cancel == 1){
								print ("<tr><td align=center style='color: #C8C8C8'>Producto</td><td align=center  style='color: #C8C8C8'>Cantidad</td></tr>"); 
							 	foreach ($prod as $indice => $valor) {	
							 		print ("<tr style='color: #C8C8C8'>");
							    	$prod = $valor;
							    	$cantidad = $cant[$indice];	
							    		print ("<td align=center>".$prod."</td><td align=center>".$cantidad."</td>");
							    	print ("</tr>");
								}
							}else{
								print ("<tr><td align=center>Producto</td><td align=center>Cantidad</td></tr>"); 
							 	foreach ($prod as $indice => $valor) {	
							 		print ("<tr>");
							    	$prod = $valor;
							    	$cantidad = $cant[$indice];	
							    		print ("<td align=center>".$prod."</td><td align=center>".$cantidad."</td>");
							    	print ("</tr>");
								}
							}
							print("</table><br />");
							//-------------- end order lines ---------------------//	
							// comprobation if the order is cancel in order to show or not the button
							if($cancel == 0){
								print("<button type='submit' onclick='cancelaPedido(".$refPedido.")'>Cancelar Pedido</button>");
							}
							?>
							<script type="text/javascript">
								//cancel an order
								function cancelaPedido(x) {
								   
								        window.location = "../functional/borrarPedido.php?borrar="+x;
								    
								}
							</script>
							<?php 
							print("<hr>");
						}					
					}
				}	
			?>
		</div>
  	</body>
</html>