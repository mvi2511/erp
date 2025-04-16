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
				$flag = 1;
				if($res){
					while($datos = $res->fetchArray(SQLITE3_ASSOC)){
						$nombre = $datos['Nombre'];
						$nif = $datos['NIF_CIF'];
						$direccion = $datos['Direccion'];
						$pais = $datos['Pais'];	
						$telefono = $datos['Telefono'];
						$IVA = $datos['IVA'];
						echo "
							<p><b>Nombre o razón social: </b>$nombre<p></p><b>NIF/CIF: </b>$nif</p>
							<p><b>Dirección: </b>$direccion<p></p><b>País: </b>$pais</p>
							<p><b>Teléfono: </b>$telefono<p></p><b>Tipo de IVA: </b>$IVA</p>
							<hr>
						";
						//poner botón de editar, hacer con url sobre subirCli.php
						$flag = 0;
					}
				} 
				if($flag == 1){
					?>
						<div class="container margen-arriba-3">
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