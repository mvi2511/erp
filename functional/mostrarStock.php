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
    <?php 
    //Connection with the database
    $cons = new SQLite3('erpeqem.db');
    //stock angelita
    $sql = "SELECT Cantidad FROM Productos WHERE Ref LIKE '5'";
    $resang = $cons->query($sql);  
    while($datos = $resang->fetchArray(SQLITE3_ASSOC)){
                    //$nombre = $datos['Descripcion'];
                    $stockang = $datos['Cantidad'];
                }
    //stock jurisdicción
    $sqlj = "SELECT Cantidad FROM Productos WHERE Ref LIKE '3'";
    $resjur = $cons->query($sqlj);  
    while($datosj = $resjur->fetchArray(SQLITE3_ASSOC)){
                    //$nombre = $datos['Descripcion'];
                    $stockjur = $datosj['Cantidad'];
                }
     //stock lof
    $sqll = "SELECT Cantidad FROM Productos WHERE Ref LIKE '1'";
    $reslof = $cons->query($sqll);  
    while($datosl = $reslof->fetchArray(SQLITE3_ASSOC)){
                    //$nombre = $datos['Descripcion'];
                    $stocklof = $datosl['Cantidad'];
                }
     //stock mata
    $sqlm = "SELECT Cantidad FROM Productos WHERE Ref LIKE '2'";
    $resmat = $cons->query($sqlm);  
    while($datosm = $resmat->fetchArray(SQLITE3_ASSOC)){
                    //$nombre = $datos['Descripcion'];
                    $stockmat = $datosm['Cantidad'];
                }
     //stock font
    $sqlf = "SELECT Cantidad FROM Productos WHERE Ref LIKE '4'";
    $resfon = $cons->query($sqlf);  
    while($datosf = $resfon->fetchArray(SQLITE3_ASSOC)){
                    //$nombre = $datos['Descripcion'];
                    $stockfon = $datosf['Cantidad'];
                }
    $cons->close();
    ?>
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
        <div class="row">            
            <div class="col">
                <div class="contProd">
                    <img class="image" src="..\images\bottles\angeli_dibujo.png">
                    <div class="overlay chard">
                        <div>
                            <p class="texto-stock">Sotck: <?php echo "$stockang"; ?></p>
                            <p class="texto-stock">Ficha:<br><a href="../uploads/ang_es.pdf" target="_blank" rel="noopener noreferrer"><img src="..\images\desc.PNG"></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="contProd">
                    <img class="image" src="..\images\bottles\godello_dibujo.png">
                    <div class="overlay jur">
                        <div>
                            <p class="texto-stock">Sotck: <?php echo "$stockjur"; ?></p>
                            <p class="texto-stock">Ficha:<br><a href="../uploads/jur_es.pdf" target="_blank" rel="noopener noreferrer"><img src="..\images\desc.PNG"></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="contProd">
                    <img class="image" src="..\images\bottles\lof18_dibujo.png">
                    <div class="overlay lof">
                        <div>
                            <p class="texto-stock">Sotck: <?php echo "$stocklof"; ?></p>
                            <p class="texto-stock">Ficha:<br><a href="../uploads/lof_es.pdf" target="_blank" rel="noopener noreferrer"><img src="..\images\desc.PNG"></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="contProd">
                    <img class="image" src="..\images\bottles\matalospardos_dibujo.png">
                    <div class="overlay mata">
                        <div>
                            <p class="texto-stock">Sotck: <?php echo "$stockmat"; ?></p>
                            <p class="texto-stock">Ficha:<br><a href="../uploads/mata_es.pdf" target="_blank" rel="noopener noreferrer"><img src="..\images\desc.PNG"></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="contProd">
                    <img class="image" src="..\images\bottles\font_dibujo.png">
                    <div class="overlay font">
                        <div>
                            <p class="texto-stock">Sotck: <?php echo "$stockfon"; ?></p>
                            <p class="texto-stock">Ficha:<br><a href="../uploads/font_es.pdf" target="_blank" rel="noopener noreferrer"><img src="..\images\desc.PNG"></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>  
    
</body>
</html>