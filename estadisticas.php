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
	$query = $conexion ->prepare("SELECT Us.USRFirstName, Us.USRFirstSurname,  SUM( CAST(replace(Monto, '.', '') AS INT) - CAST(replace(P.Refinanciacion, '.', '') AS INT) ) ValueTotal FROM FormPagadurias AS P
	INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
	INNER JOIN Users AS Us ON P.USRIdentificationNumberManager = Us.USRIdentificationNumber
	WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio  
	GROUP BY Us.USRFirstName, Us.USRFirstSurname");
	$query->execute();
	$data = $query->fetchAll();
    foreach ($data as $valores):
        $nomb_des_ases[] = $valores["USRFirstName"]." ".$valores["USRFirstSurname"];
        $total_des_ases[] = $valores["ValueTotal"];												
    endforeach;

    $nomb_des_ases1 = array();
	$total_des_ases1 = array();
	$query1 = $conexion ->prepare("SELECT Us.USRFirstName, Us.USRFirstSurname,  SUM(CAST (replace(P.Refinanciacion, '.', '') AS INT)) ValueTotal FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN Users AS Us ON P.USRIdentificationNumberManager = Us.USRIdentificationNumber
    WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio AND P.idEntidad = 1
    AND P.Refinanciacion <> ''
    GROUP BY Us.USRFirstName, Us.USRFirstSurname");
	$query1->execute();
	$data1 = $query1->fetchAll();
    foreach ($data1 as $valores1):
        $nomb_des_ases1[] = $valores1["USRFirstName"]." ".$valores1["USRFirstSurname"];
        $total_des_ases1[] = $valores1["ValueTotal"];												
    endforeach;

    $nomb_des_ases2 = array();
	$total_des_ases2 = array();
	$query2 = $conexion ->prepare("SELECT Us.USRFirstName, Us.USRFirstSurname, COUNT(idBeneficio) AS TOTAL FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN Users AS Us ON P.USRIdentificationNumberManager = Us.USRIdentificationNumber
    WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio AND P.idBeneficio = 2 AND P.idEntidad = 1
    GROUP BY Us.USRFirstName, Us.USRFirstSurname");
	$query2->execute();
	$data2 = $query2->fetchAll();
    foreach ($data2 as $valores2):
        $nomb_des_ases2[] = $valores2["USRFirstName"]." ".$valores2["USRFirstSurname"];
        $total_des_ases2[] = $valores2["TOTAL"];												
    endforeach;

    $nomb_des_ases3 = array();
	$total_des_ases3 = array();
	$query3 = $conexion ->prepare("SELECT Pr.NombreProveedor,  SUM( CAST(replace(Monto, '.', '') AS INT) - CAST(replace(P.Refinanciacion, '.', '') AS INT) ) ValueTotal FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN proveedoresEntidades AS Pr ON  P.idEntidad = Pr.idProveedor
    WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio  
    GROUP BY Pr.NombreProveedor");
	$query3->execute();
	$data3 = $query3->fetchAll();
    foreach ($data3 as $valores3):
        $nomb_des_ases3[] = $valores3["NombreProveedor"];
        $total_des_ases3[] = $valores3["ValueTotal"];												
    endforeach;

    $nomb_des_ases4 = array();
	$total_des_ases4 = array();
	$query4 = $conexion ->prepare("SELECT nombrePagaduria, COUNT(Pagaduria) AS TOTAL FROM FormPagadurias AS P
	INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
	INNER JOIN Pagadurias AS Pag ON U.Pagaduria = Pag.idPagaduria
	WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY nombrePagaduria");
	$query4->execute();
	$data4 = $query4->fetchAll();
    foreach ($data4 as $valores4):
        $nomb_des_ases4[] = $valores4["nombrePagaduria"];
        $total_des_ases4[] = $valores4["TOTAL"];												
    endforeach;

    $nomb_des_ases5 = array();
	$total_des_ases5 = array();
	$query5 = $conexion ->prepare("SELECT nameCaptacion, COUNT(Captacion) AS TOTAL FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN Captacion AS C ON U.Captacion = C.idCaptacion
    WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY nameCaptacion");
	$query5->execute();
	$data5 = $query5->fetchAll();
    foreach ($data5 as $valores5):
        $nomb_des_ases5[] = $valores5["nameCaptacion"];
        $total_des_ases5[] = $valores5["TOTAL"];												
    endforeach;

    $nomb_des_ases6 = array();
	$total_des_ases6 = array();
	$query6 = $conexion ->prepare("SELECT RESName, COUNT(USRIdentificationNumberManager) AS TOTAL FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN RequestStatus AS C ON U.status = C.RESid
    WHERE MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY RESName");
	$query6->execute();
	$data6 = $query6->fetchAll();
    foreach ($data6 as $valores6):
        $nomb_des_ases6[] = $valores6["RESName"];
        $total_des_ases6[] = $valores6["TOTAL"];												
    endforeach;
}else{
    $anio = date("Y");
    $mes = date("n");
    //Buscar las estadisticas para mostrar en tablas
    $nomb_des_ases = array();
	$total_des_ases = array();
	$query = $conexion ->prepare("SELECT Us.USRFirstName, Us.USRFirstSurname,  SUM( CAST(replace(Monto, '.', '') AS INT) - CAST(replace(P.Refinanciacion, '.', '') AS INT) ) ValueTotal FROM FormPagadurias AS P
	INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
	INNER JOIN Users AS Us ON P.USRIdentificationNumberManager = Us.USRIdentificationNumber
	WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio  
	GROUP BY Us.USRFirstName, Us.USRFirstSurname");
	$query->execute();
	$data = $query->fetchAll();
    foreach ($data as $valores):
        $nomb_des_ases[] = $valores["USRFirstName"]." ".$valores["USRFirstSurname"];
        $total_des_ases[] = $valores["ValueTotal"];												
    endforeach;

    $nomb_des_ases1 = array();
	$total_des_ases1 = array();
	$query1 = $conexion ->prepare("SELECT Us.USRFirstName, Us.USRFirstSurname,  SUM(CAST (replace(P.Refinanciacion, '.', '') AS INT)) ValueTotal FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN Users AS Us ON P.USRIdentificationNumberManager = Us.USRIdentificationNumber
    WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio AND P.idEntidad = 1
    AND P.Refinanciacion <> ''
    GROUP BY Us.USRFirstName, Us.USRFirstSurname");
	$query1->execute();
	$data1 = $query1->fetchAll();
    foreach ($data1 as $valores1):
        $nomb_des_ases1[] = $valores1["USRFirstName"]." ".$valores1["USRFirstSurname"];
        $total_des_ases1[] = $valores1["ValueTotal"];												
    endforeach;

    $nomb_des_ases2 = array();
	$total_des_ases2 = array();
	$query2 = $conexion ->prepare("SELECT Us.USRFirstName, Us.USRFirstSurname, COUNT(idBeneficio) AS TOTAL FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN Users AS Us ON P.USRIdentificationNumberManager = Us.USRIdentificationNumber
    WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio AND P.idBeneficio = 2 AND P.idEntidad = 1
    GROUP BY Us.USRFirstName, Us.USRFirstSurname");
	$query2->execute();
	$data2 = $query2->fetchAll();
    foreach ($data2 as $valores2):
        $nomb_des_ases2[] = $valores2["USRFirstName"]." ".$valores2["USRFirstSurname"];
        $total_des_ases2[] = $valores2["TOTAL"];												
    endforeach;

    $nomb_des_ases3 = array();
	$total_des_ases3 = array();
	$query3 = $conexion ->prepare("SELECT Pr.NombreProveedor,  SUM( CAST(replace(Monto, '.', '') AS INT) - CAST(replace(P.Refinanciacion, '.', '') AS INT) ) ValueTotal FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN proveedoresEntidades AS Pr ON  P.idEntidad = Pr.idProveedor
    WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio  
    GROUP BY Pr.NombreProveedor");
	$query3->execute();
	$data3 = $query3->fetchAll();
    foreach ($data3 as $valores3):
        $nomb_des_ases3[] = $valores3["NombreProveedor"];
        $total_des_ases3[] = $valores3["ValueTotal"];												
    endforeach;

    $nomb_des_ases4 = array();
	$total_des_ases4 = array();
	$query4 = $conexion ->prepare("SELECT nombrePagaduria, COUNT(Pagaduria) AS TOTAL FROM FormPagadurias AS P
	INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
	INNER JOIN Pagadurias AS Pag ON U.Pagaduria = Pag.idPagaduria
	WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY nombrePagaduria");
	$query4->execute();
	$data4 = $query4->fetchAll();
    foreach ($data4 as $valores4):
        $nomb_des_ases4[] = $valores4["nombrePagaduria"];
        $total_des_ases4[] = $valores4["TOTAL"];												
    endforeach;

    $nomb_des_ases5 = array();
	$total_des_ases5 = array();
	$query5 = $conexion ->prepare("SELECT nameCaptacion, COUNT(Captacion) AS TOTAL FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN Captacion AS C ON U.Captacion = C.idCaptacion
    WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY nameCaptacion");
	$query5->execute();
	$data5 = $query5->fetchAll();
    foreach ($data5 as $valores5):
        $nomb_des_ases5[] = $valores5["nameCaptacion"];
        $total_des_ases5[] = $valores5["TOTAL"];												
    endforeach;

    $nomb_des_ases6 = array();
	$total_des_ases6 = array();
	$query6 = $conexion ->prepare("SELECT RESName, COUNT(USRIdentificationNumberManager) AS TOTAL FROM FormPagadurias AS P
    INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
    INNER JOIN RequestStatus AS C ON U.status = C.RESid
    WHERE MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY RESName");
	$query6->execute();
	$data6 = $query6->fetchAll();
    foreach ($data6 as $valores6):
        $nomb_des_ases6[] = $valores6["RESName"];
        $total_des_ases6[] = $valores6["TOTAL"];												
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
                        <form action="estadisticas.php" method="POST">
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

                                    <h5 class="card-title mb-0">Estado general de los creditos</h5>
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

                                    <h5 class="card-title mb-0">Estado de los creditos por asesor</h5>
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

                                    <h5 class="card-title mb-0">Desembolsos Nuevos</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-barvarius"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Refinanciaciones BAYPORT</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-bar-1"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Polizas</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-bar-2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Entidad - Proveedores</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-bar-3"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Tipo de Pagaduria</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-bar-4"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Estrategia de Captación</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-bar-5"></canvas>
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
                labels: <?php echo json_encode($nomb_des_ases6); ?>,
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
                    data: <?php echo json_encode($total_des_ases6); ?>,
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
                labels: <?php echo json_encode($nomb_des_ases6); ?>,
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
                    data: d[1],
                    barPercentage: .75,
                    categoryPercentage: .5
                },
                {
                    label: "Alba Sanchez",
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
                    data: d[2],
                    barPercentage: .75,
                    categoryPercentage: .5
                },
                {
                    label: "Daniela Toloza",
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
                    data: d[3],
                    barPercentage: .75,
                    categoryPercentage: .5
                },
                {
                    label: "Camila Lizcano",
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
                    data: d[4],
                    barPercentage: .75,
                    categoryPercentage: .5
                },
                {
                    label: "Daniela Giraldo",
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
                    data: d[5],
                    barPercentage: .75,
                    categoryPercentage: .5
                },
                {
                    label: "Mchell Rincon",
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
                    data: d[6],
                    barPercentage: .75,
                    categoryPercentage: .5
                },
                {
                    label: "Heillyn Rodriguez",
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
                    data: d[7],
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
       
    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-barvarius"), {
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
                    }
                    // {
                    //     label: "este mes",
                    //     backgroundColor: window.theme.secondary,
                    //     borderColor: window.theme.secondary,
                    //     hoverBackgroundColor: window.theme.secondary,
                    //     hoverBorderColor: window.theme.secondary,
                    //     data: [23, 18, 15],
                    //     barPercentage: .75,
                    //     categoryPercentage: .5
                    // },
                    // {
                    //     label: "este mes",
                    //     backgroundColor: window.theme.success,
                    //     borderColor: window.theme.success,
                    //     hoverBackgroundColor: window.theme.success,
                    //     hoverBorderColor: window.theme.success,
                    //     data: [21, 25, 17],
                    //     barPercentage: .75,
                    //     categoryPercentage: .5
                    // }
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
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-bar-1"), {
            type: "pie",
            data: {
                labels: <?php echo json_encode($nomb_des_ases1);?>,
                datasets: [{
                    data: <?php echo json_encode($total_des_ases1);?>,
                    backgroundColor: [
                        "#ade656",
                        "#4c63b9",
                        "#11958b",
                        "#997465",
                        "#bb49fa",
                        "#64a538",
                        "#f71e83",
                        "#77c0f5",
                        "#4e4e8e",
                        "#5c398a",
                        "#8f4b07",
                    ],
                    borderWidth: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Refinanciaciones BAYPORT'
                    }
                }
            },
        });
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-bar-2"), {
            type: "bar",
            data: {
                labels: <?php echo json_encode($nomb_des_ases2); ?>,
                datasets: [{
                    label: "Polizas",
                    backgroundColor: [
                        "#bb49fa",
                        "#64a538",
                        "#f71e83",
                        "#77c0f5",
                        "#ade656",
                        "#4c63b9",
                        "#11958b",
                        "#997465",
                        "#4e4e8e",
                        "#5c398a",
                        "#8f4b07",
                    ],
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: <?php echo json_encode($total_des_ases2); ?>,
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                indexAxis: 'y',
                // Elements options apply to all of the options unless overridden in a dataset
                // In this case, we are setting the border of each horizontal bar to be 2px wide
                elements: {
                    bar: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                        hiden: true
                    },
                    title: {
                        display: true,
                        text: 'Polizas'
                    }
                }
            },
        });
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-bar-3"), {
            type: "polarArea",
            data: {
                labels: <?php echo json_encode($nomb_des_ases3); ?>,
                datasets: [{
                    data: <?php echo json_encode($total_des_ases3); ?>,
                    label: "Proveedor",
                    backgroundColor: [
                        "#ade656",
                        "#4c63b9",
                        "#11958b",
                        "#bb49fa",
                        "#64a538",
                        "#f71e83",
                        "#77c0f5",
                        "#997465",
                        "#4e4e8e",
                        "#5c398a",
                        "#8f4b07",
                    ]
                    // borderColor: window.theme.primary,
                    // hoverBackgroundColor: window.theme.primary,
                    // hoverBorderColor: window.theme.primary,

                    // barPercentage: .75,
                    // categoryPercentage: .5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Entidad - Proveedores'
                    }
                }
            },
        });
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-bar-4"), {
            type: "bar",
            data: {
                labels: <?php echo json_encode($nomb_des_ases4); ?>,
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
                        data: <?php echo json_encode($total_des_ases4); ?>,
                        barPercentage: .75,
                        categoryPercentage: .5
                    }
                    // {
                    //     label: "este mes",
                    //     backgroundColor: window.theme.secondary,
                    //     borderColor: window.theme.secondary,
                    //     hoverBackgroundColor: window.theme.secondary,
                    //     hoverBorderColor: window.theme.secondary,
                    //     data: [23, 18, 15],
                    //     barPercentage: .75,
                    //     categoryPercentage: .5
                    // },
                    // {
                    //     label: "este mes",
                    //     backgroundColor: window.theme.success,
                    //     borderColor: window.theme.success,
                    //     hoverBackgroundColor: window.theme.success,
                    //     hoverBorderColor: window.theme.success,
                    //     data: [21, 25, 17],
                    //     barPercentage: .75,
                    //     categoryPercentage: .5
                    // }
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
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-bar-5"), {
            type: "doughnut",
            data: {
                labels: <?php echo json_encode($nomb_des_ases5);?>,
                datasets: [{
                    data: <?php echo json_encode($total_des_ases5);?>,
                    backgroundColor: [
                        "#bb49fa",
                        "#64a538",
                        "#f71e83",
                        "#77c0f5",
                        "#ade656",
                        "#4c63b9",
                        "#11958b",
                        "#997465",
                        "#4e4e8e",
                        "#5c398a",
                        "#8f4b07",
                    ],
                    borderWidth: 5
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Estrtegia de Captación'
                    }
                },
                cutoutPercentage: 75
            }
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