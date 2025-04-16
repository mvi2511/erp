<!DOCTYPE html>
<!-- search customers to create an order -->
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
	<main role="main">
		<!-- Start Service -->		
		<div class="container margen-arriba-3">
			<h2>RESULTADOS DE LA BUSQUEDA</h2>
			<?php			
				//call the file to remove the accents
				include 'eliminarTildes.php';	

				if(isset($_GET['busqueda'])){
					$busqueda = $_GET['busqueda'];
					//as in the upload to the database, the accents, ñ and cedilla are eliminated for the search
					$busqueda = eliminar_tildes($busqueda);
					$sql = "SELECT NIF_CIF, Nombre, Direccion, Pais, Telefono, IVA FROM Clientes WHERE Nombre LIKE '%".$busqueda."%'";
					
				}else if(isset($_GET['buscnif'])){
					$buscnif = $_GET['buscnif'];
					
					$sql = "SELECT NIF_CIF, Nombre, Direccion, Pais, Telefono, IVA FROM Clientes WHERE NIF_CIF LIKE '%".$buscnif."%'";

				}else if(isset($_GET['busctel'])){
					$busctel = $_GET['busctel'];
					
					$sql = "SELECT NIF_CIF, Nombre, Direccion, Pais, Telefono, IVA FROM Clientes WHERE Telefono LIKE '%".$busctel."%'";
				}
				
				$con = new SQLite3('erpeqem.db');
				
				$res = $con->query($sql);

				if($res){

					?>
					<!-- with the select in js we give the option to choose the appropriate client through the index of this select -->
					<select id="cliSelect">
						<?php 
						//flag para comprobar que el cliente existe
						$noe = 0;
							while($datos = $res->fetchArray(SQLITE3_ASSOC)){
								$nombre = $datos['Nombre'];
								$nif = $datos['NIF_CIF'];
								$direccion = $datos['Direccion'];
								$pais = $datos['Pais'];	
								$telefono = $datos['Telefono'];
								$IVA = $datos['IVA'];
								//This is how the information of the clients that match the search criteria is displayed
								//to choose the one we are looking for.
								echo "
									<option>
										Nombre: $nombre | NIF: $nif |
										 Dirección: $direccion | $pais 
										| Teléfono: $telefono | IVA: $IVA
										| id ~$nif~
									</option>
								";
								$noe = 1;
								//put edit button, do with url on uploadCli.php
							}
						?>
					</select>
					<!-- button that chooses client with a js function-->
					<button class="margen-arriba-1" type="button" onclick="escogeCliente()">Escoger cliente</button>						
					<?php 
					//message when the client does not exist
				}
				if($noe == 0){	
				//mejorar esta parte para que no aparezca la parte de "resultados de la busqueda... etc"
				?>
					<div class="container margen-arriba-3">
						<a class="btn btn-black" href="../html/crearPedidos.html">VOLVER</a>
						<p class="padding-error-nocli rojo padding-error big">El cliente no existe</p>

					</div>
				<?php				
				}			
				$con->close();
			?>					
		</div>
		<!-- End Service -->    
  </body>
</html>