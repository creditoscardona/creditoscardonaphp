<?php
session_start();
require("conexion.php");

$_SESSION["status_profile"] = "";
if(isset($_SESSION["usuario"])){

if($_POST["anio"]){
    $anio = $_POST["anio"];
    $mes = $_POST["selectMes"];
    //Buscar las estadisticas para mostrar en tablas
    $nomb_des_ases = array();
	$total_des_ases = array();
	$query = $conexion ->prepare("SELECT DEPName,  COUNT(USRIdentificationNumberApplicant) AS TOTAL FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN Citys AS C ON U.ubicacionC = C.CITid
    INNER JOIN Departments AS D ON C.idDEP = D.DEPid
    WHERE MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY DEPName ORDER BY TOTAL DESC");
	$query->execute();
	$data = $query->fetchAll();
    foreach ($data as $valores):
        $nomb_des_ases[] = $valores["DEPName"];
        $total_des_ases[] = $valores["TOTAL"];												
    endforeach;

    $nomb_des_ases1 = array();
	$total_des_ases1 = array();
	$query1 = $conexion ->prepare("SELECT city, COUNT(USRIdentificationNumberApplicant) AS TOTAL FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN Citys AS C ON U.ubicacionC = C.CITid
    WHERE MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY city ORDER BY TOTAL DESC");
	$query1->execute();
	$data1 = $query1->fetchAll();
    foreach ($data1 as $valores1):
        $nomb_des_ases1[] = $valores1["city"];
        $total_des_ases1[] = $valores1["TOTAL"];												
    endforeach;
}else{
    $anio = date("Y");
    $mes = date("n");
    //Buscar las estadisticas para mostrar en tablas
    $nomb_des_ases = array();
	$total_des_ases = array();
	$query = $conexion ->prepare("SELECT DEPName,  COUNT(USRIdentificationNumberApplicant) AS TOTAL FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN Citys AS C ON U.ubicacionC = C.CITid
    INNER JOIN Departments AS D ON C.idDEP = D.DEPid
    WHERE MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY DEPName ORDER BY TOTAL DESC");
	$query->execute();
	$data = $query->fetchAll();
    foreach ($data as $valores):
        $nomb_des_ases[] = $valores["DEPName"];
        $total_des_ases[] = $valores["TOTAL"];												
    endforeach;

    $nomb_des_ases1 = array();
	$total_des_ases1 = array();
	$query1 = $conexion ->prepare("SELECT city, COUNT(USRIdentificationNumberApplicant) AS TOTAL FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN Citys AS C ON U.ubicacionC = C.CITid
    WHERE MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY city ORDER BY TOTAL DESC");
	$query1->execute();
	$data1 = $query1->fetchAll();
    foreach ($data1 as $valores1):
        $nomb_des_ases1[] = $valores1["city"];
        $total_des_ases1[] = $valores1["TOTAL"];												
    endforeach;
}
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
</head>

<body>
    <div class="wrapper">
        <?php include("sidebar.php"); ?>
        <div class="main">
            <?php include("navbar.php"); ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="mb-3">
                        <h1 class="h3 d-inline align-middle">Estadisticas</h1>
                    </div>
                    <div class="row p-5">
                        <form action="estadisticaubicacion.php" method="POST">
                            <div class="row">
                                <label for="selectMes" class="col-1">Mes:</label>
                                <div class="col-2">
                                    <select class="form-control" id="selectMes" name="selectMes">
                                        <?php

                                            if($_POST["selectMes"]){
                                                $mes = $_POST["selectMes"];
                                            }else{
                                               $mes = date("n"); 
                                            }
                                            
                                            $anio = date("Y");
                                            
                                        $array = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                                        foreach ($array as $clave => $valor) {                                            
                                        ?>
                                        <option <?php if($clave+1 == $mes){echo "selected"; }?>
                                            value="<?php echo $clave+1; ?>"><?php echo $valor; ?>
                                        </option>
                                        <?php  
                                        }
                                        ?>
                                        <!-- <option>Enero</option>
                                        <option>Febrero</option>
                                        <option>Marzo</option>
                                        <option>Abri</option>
                                        <option>Mayo</option>
                                        <option>Junio</option>
                                        <option>Julio</option>
                                        <option>Agosto</option>
                                        <option>Septiembre</option>
                                        <option>Octubre</option>
                                        <option>Noviembre</option>
                                        <option>Diciembre</option> -->
                                    </select>
                                </div>
                                <label for="inputPassword" class="col-1">Año</label>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="anio" name="anio" placeholder="2022"
                                        value="<?php if($_POST["anio"]){ echo $_POST["anio"]; }else{echo $anio;} ?>">
                                </div>
                                <div class="col-6"><button class="btn btn-success">Ver</button></div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Localización de clintes por departamento</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-bargenstatus"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Localización de clintes por ciudad</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-barstatusases"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Tabla General</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">

                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Ciudad</td>
                                                    <th scope="col">Departamento</td>
                                                    <th scope="col">Total</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                                $query2 = $conexion ->prepare("SELECT city, DEPName,  COUNT(USRIdentificationNumberApplicant) AS TOTAL FROM FormPagadurias AS P
                                                INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
                                                INNER JOIN Citys AS C ON U.ubicacionC = C.CITid
                                                INNER JOIN Departments AS D ON C.idDEP = D.DEPid
                                                WHERE MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY city, DEPName ORDER BY TOTAL DESC");
                                                $query2->execute();
                                                $data2 = $query2->fetchAll();
                                                foreach ($data2 as $valores2):
                                                    echo '<tr><td>'.$valores2["city"].'</td><td>'.$valores2["DEPName"].'</td><td>'.$valores2["TOTAL"].'</td></tr>';											
                                                endforeach;

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </main>

            <?php include("footer.php"); ?>
        </div>
    </div>

    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-bargenstatus"), {
            type: "bar",
            data: {
                labels: <?php echo json_encode($nomb_des_ases); ?>,
                datasets: [{
                    label: "Desembolsos nuevos del mes",
                    backgroundColor: [
                        "#4c63b9",
                        "#11958b",
                        "#997465",
                        "#4e4e8e",
                        "#5c398a",
                        "#8f4b07",
                        "#bb49fa",
                        "#64a538",
                        "#f71e83",
                        "#77c0f5",
                        "#ade656",
                    ],
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: <?php echo json_encode($total_des_ases); ?>,
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                        hiden: true
                    },
                }

            }
        });
    });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('prueba.php')
        .then(response => response.json())
        .then(d => {
            console.log(d)
             // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-barstatusases"), {
            type: "bar",
            data: {
                labels: <?php echo json_encode($nomb_des_ases1); ?>,
                datasets: [{
                    label: "Alfonso Cardona",
                    backgroundColor: [
                        "#4c63b9",
                        "#11958b",
                        "#997465",
                        "#4e4e8e",
                        "#5c398a",
                        "#8f4b07",
                        "#bb49fa",
                        "#64a538",
                        "#f71e83",
                        "#77c0f5",
                        "#ade656",
                    ],
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: <?php echo json_encode($total_des_ases1); ?>,
                    barPercentage: .75,
                    categoryPercentage: .5
                },
                ]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                        hiden: true
                    },
                }

            }
        });
        });
       
    });
    </script>



<script>function saveClientFinish() {
  Swal.fire(
    'No tan rapido!',
    'Guarda tu cliente para poder continuar',
    'info'
  )
}</script>

    <?php
		if($_SESSION["status_profile"] == "OK"){
			echo	'<script type="text/javascript">
						Swal.fire({
							title: "Información",
							text: "Desprendibles subidos correctamente",
							icon: "success",
							confirmButtonText: "Entendido",
							confirmButtonColor: "#2BB454",
						})
					</script>';
			$_SESSION["status_profile"] = "";
		}elseif($_SESSION["status_desprendible"] == "FAIL"){
			echo	'<script type="text/javascript">
						Swal.fire({
							title: "Información",
							text: "Hubo un problema en la carga de los archivos, intente nuevamente",
							icon: "error",
							confirmButtonText: "Volver a intentarlo",
							confirmButtonColor: "#2BB454",
						})
					</script>';
			$_SESSION["status_profile"] = "";
		}elseif($_SESSION["status_desprendible"] == "EMPTY"){
			echo	'<script type="text/javascript">
						Swal.fire({
							title: "Información",
							text: "Los archivos a subir no pueden estar vacios, intente nuevamente",
							icon: "info",
							confirmButtonText: "De nuevo!",
							confirmButtonColor: "#2BB454",
						})						
					</script>';
			$_SESSION["status_profile"] = "";
		}elseif($_SESSION["status_desprendible"] == "MAXSIZE"){
			echo	'<script type="text/javascript">
						Swal.fire({
							title: "Información",
							text: "Los archivos a subir no pueden exceder los 5Mb, intente nuevamente",
							icon: "info",
							confirmButtonText: "De nuevo!",
							confirmButtonColor: "#2BB454",
						})						
					</script>';
			$_SESSION["status_profile"] = "";
		}elseif($_SESSION["status_desprendible"] == "NOTFOUND"){
			echo	'<script type="text/javascript">
			Swal.fire({
				title: "Información",
				text: "El usuario no tiene despredibles, solicite subirlos?!",
				icon: "info",
				confirmButtonText: "Lo haré",
				confirmButtonColor: "#2BB454",
			})
			.then((result) => {
				if (result.isConfirmed) {
					location.href = "home.php";
				}
			})
		</script>';
		$_SESSION["status_profile"] = "";
		}
	?>

</body>

</html>

<?php
}else{
	header("location:index.php");
}
?>