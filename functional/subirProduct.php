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
</head>
<body>
	<?php
	//call the file to remove the accents
	include 'eliminarTildes.php';

	//we connect the php variables with their correspondences in the html form	
	$cant = $_POST['cant'];	
	$descript = $_POST['descript'];
	$descript = eliminar_tildes($descript);
	$vintage = $_POST['vintage'];

	//to create a new conection to the data base.
	$con = new SQLite3('erpeqem.db');

	
	//by default select this database (tener en cuenta esta sentencia por el tema del cifrado)
	//mysqli_select_db($con, "usuario", "contraseña");
	//statement that inserts data into the database
	$sql = "INSERT INTO Productos(Cantidad,Descripcion,Vintage) VALUES('$cant','$descript','$vintage')";
	$res = $con->query($sql);
	$con->close();
	?>
		<!--screen that is shown if the product has been created correctly -->
		<!--  -->
		<a class="btn btn-black" href="../html/stock.html">VOLVER</a>		
		<!--  -->
		<div class="container margen-arriba-3">
			<p class="padding-error-nocli azul padding-error big">Producto creado satisfactoriamente</p>
		</div>
	</body>
</html>