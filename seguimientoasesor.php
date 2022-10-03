<?php
session_start();
$_SESSION["status_profile"] = "";
if(isset($_SESSION["usuario"])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/logo.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-profile.php" />

    <title>Creditos Cardona</title>

    <link href="css/app.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"> -->
</head>

<body>
    <div class="wrapper">
        <?php include("sidebar.php"); ?>
        <div class="main">
            <?php include("navbar.php"); ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row p-5">
                            <div class="row">
                                <label for="selectMes" class="col-1">Mes:</label>
                                <div class="col-2">
                                    <select class="form-control" id="selectMes" name="selectMes">
                                        <?php                                            
                                        $mes = date("n");
                                            
                                        $array = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                                        foreach ($array as $clave => $valor) {                                            
                                        ?>
                                        <option <?php if($clave+1 == $mes){echo "selected"; }?>
                                            value="<?php echo $clave+1; ?>"><?php echo $valor; ?>
                                        </option>
                                        <?php  
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                                <label for="inputPassword" class="col-1">Año:</label>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="anio" name="anio" placeholder="2022"
                                        value="<?php echo date("Y"); ?>">
                                </div>
                                <div class="col-6"><button class="btn btn-success" id="botonbusqueda">Ver</button></div>
                            </div>
                    </div>

                    <div class="mb-3">
                        <h1 class="h3 d-inline align-middle">Seguimiento en tabla</h1>
                    </div>

                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Cedula Asesor</th>
                                <th scope="col">Nombre Asesor</th>
                                <th scope="col">Cedula Cliente</th>
                                <th scope="col">Nombre Cliente</th>
                                <th scope="col">Pagaduria</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Tipo Credito</th>
                                <th scope="col">Descripcion del Estado</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Actualizado el</th>                                
                            </tr>
                        </thead>                        
                        <tfoot>
                            <tr>
                                <th>Cedula Asesor</th>
                                <th>Nombre Asesor</th>
                                <th>Cedula Cliente</th>
                                <th>Nombre Cliente</th>
                                <th>Pagaduria</th>
                                <th>Monto</th>
                                <th>Tipo Credito</th>
                                <th>Descripcion del Estado</th>
                                <th>Estado</th>
                                <th>Actualizado el</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </main>

            <?php include("footer.php"); ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
    <script src="js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script> -->

    <script src="js/seguimientoasesores.js"></script>


</body>

</html>

<?php
}else{
	header("location:index.php");
}
?>