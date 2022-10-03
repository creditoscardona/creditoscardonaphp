<?php
session_start();
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

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Créditos Cardona</title>

    <link href="css/light.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery-jvectormap-2.0.5.css">
</head>

<body>
    <div class="wrapper">
        <?php include("sidebar.php"); ?>
        <div class="main">
            <?php include("navbar.php"); ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>Analiticas</strong> Generales</h1>
                    <?php if($_SESSION["rolId"]==1){ ?>
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
                    <div class="row">
                        <div class="col-xl-6 col-xxl-5 d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Efectividad</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="users"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Aqui es donde debe ir el porcentaje de efectividad -->
                                                <!-- <div class="text-center">
                                                    <div class="spinner-grow text-success me-2" role="status" id="cargaporcentaje">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div> -->
                                                <h1 class="mt-1 mb-3" id="porcentaje">00%</h1>
                                                <!-- <div class="mb-0">
													<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
													<span class="text-muted">Since last week</span>
												</div> -->
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Desembolsos Nuevos</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="spinner-grow text-success me-2" role="status" id="cargadesnue">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3" id="desnue"></h1>
                                                <!-- <div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
													<span class="text-muted">Since last week</span>
												</div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Desembolsos refinanciados</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="spinner-grow text-success me-2" role="status" id="cargadesref">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3" id="desref"></h1>
                                                <!-- <div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
													<span class="text-muted">Since last week</span>
												</div> -->
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Total Desembolsos</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="spinner-grow text-success me-2" role="status" id="cargatotdes">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3" id="totdes"></h1>
                                                <!-- <div class="mb-0">
                                                    <span class="text-danger"> <i
                                                            class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
                                                    <span class="text-muted">Since last week</span>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-xxl-7">
                            <div class="card flex-fill w-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Total Desembolsos por Mes</h5>
                                </div>
                                <div class="text-center">
                                    <div class="spinner-grow text-success me-2" role="status" id="cargatotdesmes">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <div class="chart chart-sm">
                                        <canvas id="chartjs-dashboard-line"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Total Desembolsos por Asesor</h5>
                                </div>
                                <div class="text-center">
                                    <div class="spinner-grow text-success me-2" role="status" id="cargadesases">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="card-body d-flex">
                                    <div class="align-self-center w-100">
                                        <div class="py-3">
                                            <div class="chart chart-xs">
                                                <canvas id="chartjs-dashboard-pie"></canvas>
                                            </div>
                                        </div>

                                        <table class="table mb-0" id="asesoresdes">
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Ubicacion de clientes</h5>
                                </div>
                                <div class="text-center">
                                    <div class="spinner-grow text-success me-2" role="status" id="cargaciryclient">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="card-body px-4">
                                    <div id="world_map" style="height:350px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Desembolso por pagaduria</h5>
                                </div>
                                <div class="text-center">
                                    <div class="spinner-grow text-success me-2" role="status" id="cargadespag">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="card-body d-flex w-100">                                    
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-bar"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php }elseif($_SESSION["rolId"]==2){ ?>

                    <div class="row">
                        <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Latest Projects</h5>
                                </div>
                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th class="d-none d-xl-table-cell">Start Date</th>
                                            <th class="d-none d-xl-table-cell">End Date</th>
                                            <th>Status</th>
                                            <th class="d-none d-md-table-cell">Assignee</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Project Apollo</td>
                                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                                            <td><span class="badge bg-success">Done</span></td>
                                            <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                        </tr>
                                        <tr>
                                            <td>Project Fireball</td>
                                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                                            <td><span class="badge bg-danger">Cancelled</span></td>
                                            <td class="d-none d-md-table-cell">William Harris</td>
                                        </tr>
                                        <tr>
                                            <td>Project Hades</td>
                                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                                            <td><span class="badge bg-success">Done</span></td>
                                            <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                        </tr>
                                        <tr>
                                            <td>Project Nitro</td>
                                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                                            <td><span class="badge bg-warning">In progress</span></td>
                                            <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                        </tr>
                                        <tr>
                                            <td>Project Phoenix</td>
                                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                                            <td><span class="badge bg-success">Done</span></td>
                                            <td class="d-none d-md-table-cell">William Harris</td>
                                        </tr>
                                        <tr>
                                            <td>Project X</td>
                                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                                            <td><span class="badge bg-success">Done</span></td>
                                            <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                        </tr>
                                        <tr>
                                            <td>Project Romeo</td>
                                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                                            <td><span class="badge bg-success">Done</span></td>
                                            <td class="d-none d-md-table-cell">Christina Mason</td>
                                        </tr>
                                        <tr>
                                            <td>Project Wombat</td>
                                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                                            <td><span class="badge bg-warning">In progress</span></td>
                                            <td class="d-none d-md-table-cell">William Harris</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Monthly Sales</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-bar"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php }else{ ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <h5 class="card-title">Estado del Crédito</h5>
                                        <?php 
													require("conexion.php");
													$u = $_SESSION["idEstado"];
													// $conexion -> setAtribute(PDO::ATTR_ERRMODE, PDO::ERRRMODE_EXCEPTION);
													$query = $conexion ->prepare("SELECT * FROM RequestStatus WHERE RESid = :u");
													$query->bindParam(":u", $u);
													$query->execute();
													$usuario = $query->fetch(PDO::FETCH_ASSOC);
													if($usuario){
														echo '<p><b>'.$usuario["RESName"].'</b></p>'; 
													}
												?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </main>
            <?php include("footer.php"); ?>
        </div>
    </div>

    <script src="js/app.js"></script>
    <script src="js/index.js"></script>

    <script type="text/javascript" src="js/jquery.min.js"></script>

    <script type="text/javascript" src="js/jquery-jvectormap-2.0.5.min.js"></script>
    <script type="text/javascript" src="js/jquery-jvectormap-world-mill.js"></script>
    <script type="text/javascript" src="js/jquery-jvectormap-co-mill.js"></script>
    <script type="text/javascript" src="js/jquery-jvectormap-co-merc.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
        var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
        document.getElementById("datetimepicker-dashboard").flatpickr({
            inline: true,
            prevArrow: "<span title=\"Previous month\">&laquo;</span>",
            nextArrow: "<span title=\"Next month\">&raquo;</span>",
            defaultDate: defaultDate
        });
    });
    </script> -->
    <script>function saveClientFinish() {
  Swal.fire(
    'No tan rapido!',
    'Guarda tu cliente para poder continuar',
    'info'
  )
}</script>

</body>

</html>

<?php
}else{
	header("location:index.php");
}
?>