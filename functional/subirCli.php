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
	<?php
	//we call the file to remove the accents
	include 'eliminarTildes.php';

	//we connect the php variables with their correspondences in the html form
	$nombre = $_POST['nombre'];
	$nombre = eliminar_tildes($nombre);
	$nif = $_POST['nif'];
	$direccion = $_POST['direccion'];
	$pais = $_POST['pais'];
	$telefono = $_POST['telefono'];
	$IVA = $_POST['IVA'];
	$fechacrea = date("Y-m-d");
    $horacrea = date("H:i:s");

	//to create a new conection to the data base.
	$con = new SQLite3('erpeqem.db');
	//comprobation of NIF_CIF doesn´t exist
	$compronif = "SELECT NIF_CIF FROM Clientes";
	$result = $con->query($compronif);
	//check that the NIF_CIF of the database is not = than the one entered by the user
	//whether it is uppercase or lowercase
	$dup = 0;
	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		if(strtoupper($row['NIF_CIF']) == strtoupper($_POST['nif'])){
			$dup = 1;
		}
	}
	if($dup == 1){
	?>
		
		<div class="container margen-arriba-3">
			<p class="rojo padding-error">El CIF o NIF ya existe</p>
		</div>
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
	    <!-- js -->
	    <script type="text/javascript" src="../js/jquery.js"></script>
	    <script type="text/javascript" src="../js/main.js"></script>
	</body>
	</html>
	<?php
	}else{
		//by default select this database (tener en cuenta esta sentencia por el tema del cifrado)
		//mysqli_select_db($con, "usuario", "contraseña");
		//statement that inserts data into the database
		$sql = "INSERT INTO Clientes(NIF_CIF,Nombre,Direccion,Pais,Telefono,IVA,fechacrea,horacrea) VALUES('$nif','$nombre','$direccion','$pais','$telefono','$IVA','$fechacrea','$horacrea')";

		$res = $con->query($sql);

		$con->close();
		?>
			<!-- screen that is shown if the client has been created correctly -->
			<a class="btn btn-black" href="../html/clientes.html">VOLVER</a>
			<div class="container margen-arriba-3">
				<p class="padding-error-nocli azul padding-error big">Cliente creado satisfactoriamente</p>
			</div>
		<?php			
	}
?>