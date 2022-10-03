<?php
session_start();
if(isset($_SESSION["usuario"])){
	if($_POST){
		require("conexion.php");
        $_SESSION["blockmenu"] = 1;
		$u = $_POST["cedula"];
		// $conexion -> setAtribute(PDO::ATTR_ERRMODE, PDO::ERRRMODE_EXCEPTION);
		$query = $conexion ->prepare("SELECT * FROM Users WHERE USRIdentificationNumber = :u");
		$query->bindParam(":u", $u);
		$query->execute();
		$usuario = $query->fetch(PDO::FETCH_ASSOC);
		if($usuario){
			$query1 = $conexion ->prepare("SELECT TOP 1 * FROM FormPagadurias WHERE USRIdentificationNumberApplicant = :u ORDER BY Created DESC");
			$query1->bindParam(":u", $u);
			$query1->execute();
			$usuario1 = $query1->fetch(PDO::FETCH_ASSOC);	
			if($usuario1){ $queryB = $conexion ->prepare("SELECT * FROM Users WHERE USRIdentificationNumber = :u");
				$queryB->bindParam(":u", $usuario1["USRIdentificationNumberManager"]);
				$queryB->execute();
				$usuarioB = $queryB->fetch(PDO::FETCH_ASSOC);
			}
				
			$formulario=true;
		}else{	
			$formulario = false;
		}
	}else
	if($_GET){
		require("conexion.php");
        $_SESSION["blockmenu"] = 1;
		$u = $_GET["cedula"];
		// $conexion -> setAtribute(PDO::ATTR_ERRMODE, PDO::ERRRMODE_EXCEPTION);
		$query = $conexion ->prepare("SELECT * FROM Users WHERE USRIdentificationNumber = :u");
		$query->bindParam(":u", $u);
		$query->execute();
		$usuario = $query->fetch(PDO::FETCH_ASSOC);
		if($usuario){
			$query1 = $conexion ->prepare("SELECT TOP 1 * FROM FormPagadurias WHERE USRIdentificationNumberApplicant = :u ORDER BY Created DESC");
			$query1->bindParam(":u", $u);
			$query1->execute();
			$usuario1 = $query1->fetch(PDO::FETCH_ASSOC);	
			if($usuario1){ $queryB = $conexion ->prepare("SELECT * FROM Users WHERE USRIdentificationNumber = :u");
				$queryB->bindParam(":u", $usuario1["USRIdentificationNumberManager"]);
				$queryB->execute();
				$usuarioB = $queryB->fetch(PDO::FETCH_ASSOC);
			}
				
			$formulario=true;
		}else{	
			$formulario = false;
		}
	}else{ $formulario = false;}
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
    .bg-CreditosCardonaDark {
        background-color: #13804c;
        color: #ffffff;
    }

    .bg-CreditosCardonaLight {
        background-color: #89c64e;
        color: #ffffff;
    }

    .ocultoInput {
        display: none;
    }

    .vistoInput {
        display: block;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include("sidebar.php"); ?>
        <div class="main">
            <?php include("navbar.php"); ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>Administrar</strong> Clientes</h1>
                    <!-- Escribir aqui el codigo -->
                    <div class="row" style="<?php if($formulario===false) {echo "height: 400px;";} ?>">
                        <div class="col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <?php if($formulario===false) { ?>
                                    <div>
                                        <form action="clientes.php" method="POST">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="text" name="cedula" id="cedula" class="form-control" required
                                                        placeholder="Buscar por cédula de solicitante" />
                                                </div>
                                                <div class="col-6">
                                                    <input type="submit" class="btn btn-success" value="Buscar" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php }else{ ?>
                                    <div>
                                        <form action="guardarcliente.php" method="POST">
                                            <div class="row">
                                                <!-- <input type="text" style="display: none;" name="cedulamanager" id="cedulamanager" class="" placeholder="" value="<?php echo $_SESSION["cedula"]; ?>" />
										<input type="text" style="display: none;" name="idcedulamanager" id="cedulamanager" class="" placeholder="" value="<?php echo $usuario["TotalDevengado"]; ?>" /> -->
                                                <div class="col-md-12"
                                                    style="border-bottom: 1px solid #ebedf2; margin-bottom: 20px;">
                                                    <h3>Capacidad</h3>
                                                </div>
                                                <div class="col-12">
                                                    <h6><b>Tipo de pagaduría</b></h6>
                                                    <select class="form-select mb-3" id="pagaduria" name="pagaduria">
                                                        <?php 
													require("conexion.php");
													$query = $conexion ->prepare("SELECT * FROM Pagadurias");
													$query->execute();
													$data = $query->fetchAll();
													foreach ($data as $valores):
													?>
                                                        <option value="<?php echo $valores["idPagaduria"]; ?>"
                                                            <?php if($valores["idPagaduria"] === $usuario["Pagaduria"]){echo 'selected'; }?>>
                                                            <?php echo $valores["nombrePagaduria"]; ?></option>
                                                        <?php
													endforeach;
													?>
                                                        <option value="0">Otro fondo priv. de pensión</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <h6><b>Estrategia de captación</b></h6>
                                                    <select class="form-select mb-3" onchange="changeOtherInput()"
                                                        id="estrategia" name="estrategia">
                                                        <?php 
													require("conexion.php");
													$query = $conexion ->prepare("SELECT * FROM Captacion");
													$query->execute();
													$data = $query->fetchAll();
													foreach ($data as $valores):
													?>
                                                        <option value="<?php echo $valores["idCaptacion"]; ?>"
                                                            <?php if($valores["idCaptacion"] === $usuario["Captacion"]){echo 'selected'; }?>>
                                                            <?php echo $valores["nameCaptacion"]; ?></option>
                                                        <?php
													endforeach;
													?>
                                                    </select>
                                                    <input type="text" name="otroinput" id="otroinput"
                                                        class="form-control mb-3 <?php if($usuario){if($usuario["Captacion"] != 7){ echo "ocultoInput"; }} ?> "
                                                        placeholder="Cual?"
                                                        value="<?php if($usuario){ echo $usuario["otraCaptacion"]; } ?>" />
                                                </div>
                                                <div class="col-12">
                                                    <h6><b>Estado actual:</b></h6>
                                                    <select class="form-select mb-3" onchange="changeSelectEstado()"
                                                        id="status" name="status">
                                                        <?php 
													require("conexion.php");
													$query = $conexion ->prepare("SELECT * FROM RequestStatus");
													$query->execute();
													$data = $query->fetchAll();
													foreach ($data as $valores):
													?>
                                                        <option value="<?php echo $valores["RESid"]; ?>"
                                                            <?php if($valores["RESid"] === $usuario["status"]){echo 'selected'; }?>>
                                                            <?php echo $valores["RESName"]; ?></option>
                                                        <?php
													endforeach;
													?>

                                                    </select>
                                                    <select
                                                        class="form-select mb-3 <?php if($usuario){if($usuario["status"] != 5){ echo "ocultoInput"; }} ?> "
                                                        name="city" id="city">
                                                        <?php if($usuario["ciudadTransito"]==NULL || $usuario["ciudadTransito"]=="" ) {?>
                                                        <option value="0">Cual ciudad?</option>
                                                        <?php } ?>
                                                        <?php 
													require("conexion.php");
													$query = $conexion ->prepare("SELECT * FROM Citys  ORDER BY city ASC");
													$query->execute();
													$data = $query->fetchAll();
													foreach ($data as $valores):
													?>
                                                        <option value="<?php echo $valores["CITid"]; ?>"
                                                            <?php if($valores["CITid"] === $usuario["ciudadTransito"]){echo 'selected'; }?>>
                                                            <?php echo $valores["city"]; ?></option>
                                                        <?php
													endforeach;
													?>

                                                    </select>
                                                    <select
                                                        class="form-select mb-3 <?php if($usuario){if($usuario["status"] != 10){ echo "ocultoInput"; }} ?> "
                                                        name="devo" id="devo">

                                                        <?php 
													require("conexion.php");
													$query = $conexion ->prepare("SELECT * FROM DevolucionEstado");
													$query->execute();
													$data = $query->fetchAll();
													foreach ($data as $valores):
													?>
                                                        <option value="<?php echo $valores["idDev"]; ?>"
                                                            <?php if($valores["idDev"] === $usuario["idDevolucion"]){echo 'selected'; }?>>
                                                            <?php echo $valores["nombreDev"]; ?></option>
                                                        <?php
													endforeach;
													?>

                                                    </select>
                                                    <select
                                                        class="form-select mb-3 <?php if($usuario){if($usuario["status"] != 12){ echo "ocultoInput"; }} ?> "
                                                        name="neg" id="neg">

                                                        <?php 
													require("conexion.php");
													$query = $conexion ->prepare("SELECT * FROM NegadoEstado");
													$query->execute();
													$data = $query->fetchAll();
													foreach ($data as $valores):
													?>
                                                        <option value="<?php echo $valores["idNeg"]; ?>"
                                                            <?php if($valores["idNeg"] === $usuario["idNegado"]){echo 'selected'; }?>>
                                                            <?php echo $valores["nombreNegado"]; ?></option>
                                                        <?php
													endforeach;
													?>

                                                    </select>
                                                    <select
                                                        class="form-select mb-3 <?php if($usuario){if($usuario["status"] != 11){ echo "ocultoInput"; }} ?> "
                                                        name="rechaz" id="rechaz">

                                                        <?php 
													require("conexion.php");
													$query = $conexion ->prepare("SELECT * FROM RechazadoEstado");
													$query->execute();
													$data = $query->fetchAll();
													foreach ($data as $valores):
													?>
                                                        <option value="<?php echo $valores["idRechaz"]; ?>"
                                                            <?php if($valores["idRechaz"] === $usuario["idRechazado"]){echo 'selected'; }?>>
                                                            <?php echo $valores["nombreRechazado"]; ?></option>
                                                        <?php
													endforeach;
													?>

                                                    </select>
                                                    <textarea class="form-control mb-3" rows="4"
                                                        placeholder="Descripcion del estado" name="statusdes"
                                                        id="statusdes"><?php if($usuario){ echo $usuario["comentStatus"]; } ?></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <h6>Ubicacion del cliente:</h6>
                                                    <select class="form-select mb-3" name="cityclient" id="cityclient">
                                                        <?php if($usuario["ubicacionC"]==NULL || $usuario["ubicacionC"]=="" ) {?>
                                                        <option value="0">Cual ciudad?</option>
                                                        <?php } ?>
                                                        <?php 
													require("conexion.php");
													$query = $conexion ->prepare("SELECT * FROM Citys  ORDER BY city ASC");
													$query->execute();
													$data = $query->fetchAll();
													foreach ($data as $valores):
													?>
                                                        <option value="<?php echo $valores["CITid"]; ?>"
                                                            <?php if($valores["CITid"] === $usuario["ubicacionC"]){echo 'selected'; }?>>
                                                            <?php echo $valores["city"]; ?></option>
                                                        <?php
													endforeach;
													?>

                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <h6>Número de cédula del cliente:</h6>
                                                    <input type="text" name="ncedula" id="ncedula" class="form-control"
                                                        placeholder="Número de cedula"
                                                        value="<?php if($usuario){ echo $usuario["USRIdentificationNumber"]; } ?>"
                                                        readonly />
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <h6>Nombres del cliente:</h6>
                                                    <input type="text" name="naneclient" id="nameclient" class="form-control"
                                                        placeholder="Nombres"
                                                        value="<?php if($usuario){ echo $usuario["USRFirstName"]." ".$usuario["USRFirstSurname"]; } ?>"
                                                        readonly />
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <h6>Celular del cliente:</h6>
                                                    <input type="text" name="cellphoneclient" id="cellphoneclient" class="form-control"
                                                        placeholder="Celular"
                                                        value="<?php if($usuario){ echo $usuario["USRCellphone"]; } ?>"
                                                        readonly />
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <h6>Nombre del asesor que realizó el estudio:</h6>
                                                    <input type="text" name="asesor" id="asesor" class="form-control"
                                                        placeholder="Nombre del Asesor"
                                                        value="<?php if($usuarioB){echo $usuarioB["USRFirstName"]." ".$usuarioB["USRFirstSurname"]; } ?>"
                                                        readonly />
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="mb-3">
                                                                <h6>TOTAL DEVENGADO:</h6>
                                                                <input onkeyup="formateo(this)" type="text"
                                                                    name="totald" id="totald" class="form-control"
                                                                    placeholder="Total devengado"
                                                                    value="<?php if($usuario1){ echo $usuario1["TotalDevengado"]; } ?>" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>SALUD:</h6>
                                                                <input onkeyup="format(this)" type="text" name="salud"
                                                                    id="salud" class="form-control" placeholder="Salud"
                                                                    value="<?php if($usuario1){ echo $usuario1["Salud"]; } ?>" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>PENSION:</h6>
                                                                <input onkeyup="format(this)" type="text" name="pension"
                                                                    id="pension" class="form-control"
                                                                    placeholder="Pension"
                                                                    value="<?php if($usuario1){ echo $usuario1["Pension"]; } ?>" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>CAPROVIMPO:</h6>
                                                                <input onkeyup="format(this)" type="text"
                                                                    name="caprovimpo" id="caprovimpo"
                                                                    class="form-control" placeholder="Caprovimpo"
                                                                    value="<?php if($usuario1){ echo $usuario1["Caprovimpo"]; } ?>" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>PRIORDPUB:</h6>
                                                                <input onkeyup="format(this)" type="text"
                                                                    name="priordpub" id="priordpub" class="form-control"
                                                                    placeholder="Priordpublico"
                                                                    value="<?php if($usuario1){ echo $usuario1["PriOrdPublico"]; } ?>" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>BONORDPUB:</h6>
                                                                <input onkeyup="format(this)" type="text"
                                                                    name="bonordpub" id="bonordpub" class="form-control"
                                                                    placeholder="Bonordpublico"
                                                                    value="<?php if($usuario1){ echo $usuario1["Bonordepub"]; } ?>" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>PRESPE:</h6>
                                                                <input onkeyup="format(this)" type="text" name="prespe"
                                                                    id="prespe" class="form-control"
                                                                    placeholder="Prespe"
                                                                    value="<?php if($usuario1){ echo $usuario1["Prespe"]; } ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="mb-3">
                                                                <h6>&nbsp;</h6>
                                                                <input class="form-control" style="display: none;" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>PRICOM:</h6>
                                                                <input onkeyup="format(this)" type="text" name="pricom"
                                                                    id="pricom" class="form-control"
                                                                    placeholder="Pricom"
                                                                    value="<?php if($usuario1){ echo $usuario1["Pricom"]; } ?>" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>PARTIALI:</h6>
                                                                <input onkeyup="format(this)" type="text"
                                                                    name="partiali" id="partiali" class="form-control"
                                                                    placeholder="Partiali"
                                                                    value="<?php if($usuario1){ echo $usuario1["Partiali"]; } ?>" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>SALARIO MINIMO:</h6>
                                                                <input onkeyup="formateo(this)" type="text"
                                                                    name="salmin" id="salmin" class="form-control"
                                                                    placeholder="Salario minimo"
                                                                    value="<?php if($usuario1){ echo $usuario1["Salmin"]; } ?>" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>DEVOPARTIALIMENT:</h6>
                                                                <input onkeyup="format(this)" type="text"
                                                                    name="devopartialiment" id="devopartialiment"
                                                                    class="form-control" placeholder="Devopartialiment"
                                                                    value="<?php if($usuario1){ echo $usuario1["Devopartialiment"]; } ?>" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>4% SERVICIMEDI:</h6>
                                                                <input onkeyup="format(this)" type="text"
                                                                    name="servicimedi" id="servicimedi"
                                                                    class="form-control" placeholder="4% servicimedi"
                                                                    value="<?php if($usuario1){ echo $usuario1["Servicimedi"]; } ?>" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>1% CASURAUTOM:</h6>
                                                                <input onkeyup="format(this)" type="text"
                                                                    name="casurautom" id="casurautom"
                                                                    class="form-control" placeholder="1% casurautom"
                                                                    value="<?php if($usuario1){ echo $usuario1["Casurautom"]; } ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 mb-3"><input onkeyup="format(this)"
                                                                onchange="format(this)" type="text"
                                                                name="devengadorestas" id="devengadorestas"
                                                                class="form-control" placeholder=""
                                                                style="background-color: #2BB454; color: white;"
                                                                readonly
                                                                value="<?php if($usuario1){ echo $usuario1["Total1"]; } ?>" />
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-3"><input onkeyup="format(this)"
                                                                onchange="format(this)" type="text"
                                                                name="devengadorestasmitad" id="devengadorestasmitad"
                                                                class="form-control" placeholder=""
                                                                style="background-color: #2BB454; color: white;"
                                                                readonly
                                                                value="<?php if($usuario1){ echo $usuario1["Total1_2"]; } ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="row mb-3">
                                                        <div class="col-12 col-md-6">
                                                            <h6>Descuentos:</h6><input onkeyup="formateo(this)"
                                                                type="text" name="descuentos" id="descuentos"
                                                                class="form-control" placeholder="Descuentos"
                                                                value="<?php if($usuario1){ echo $usuario1["Descuentos1"]; } ?>" />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <h6>&nbsp; </h6><input onkeyup="format(this)" type="text"
                                                                name="descuentosalud" id="descuentosalud"
                                                                class="form-control" placeholder=""
                                                                style="background-color: #2BB454; color: white;"
                                                                readonly
                                                                value="<?php if($usuario1){ echo $usuario1["Descuentos_2"]; } ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <input onkeyup="format(this)" type="text"
                                                                name="descuentoscuota" id="descuentoscuota"
                                                                class="form-control" placeholder=""
                                                                style="background-color: #2BB454; color: white;"
                                                                readonly
                                                                value="<?php if($usuario1){ echo $usuario1["TotalDescuentos"]; } ?>" />
                                                        </div>
                                                        <div class="col-12 col-md-6"></div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-12 col-md-6 mb-3"></div> -->
                                                <div class="col-12 col-md-6 mb-3 mt-3">
                                                    <h4>COMPRAS DE CARTERA:</h4>
                                                    <div class="row mb-3">
                                                        <div class="col-12 col-md-6">
                                                            <h6>Cartera 1:</h6><input type="text" onkeyup="mayus(this)"
                                                                name="nombrecartera1" id="nombrecartera1"
                                                                class="form-control" placeholder="Nombre"
                                                                value="<?php if($usuario1){ echo $usuario1["Cartera1"]; } ?>" />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <h6>&nbsp; </h6><input onkeyup="formateo(this)" type="text"
                                                                name="valorcartera1" id="valorcartera1"
                                                                class="form-control" placeholder="Valor"
                                                                value="<?php if($usuario1){ echo $usuario1["ValorCartera1"]; } ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-12 col-md-6">
                                                            <h6>Cartera 2:</h6><input type="text" onkeyup="mayus(this)"
                                                                name="nombrecartera2" id="nombrecartera2"
                                                                class="form-control" placeholder="Nombre"
                                                                value="<?php if($usuario1){ echo $usuario1["Cartera2"]; } ?>" />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <h6>&nbsp; </h6><input onkeyup="formateo(this)" type="text"
                                                                name="valorcartera2" id="valorcartera2"
                                                                class="form-control" placeholder="Valor"
                                                                value="<?php if($usuario1){ echo $usuario1["ValorCartera2"]; } ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-12 col-md-6">
                                                            <h6>Cartera 3:</h6><input type="text" onkeyup="mayus(this)"
                                                                name="nombrecartera3" id="nombrecartera3"
                                                                class="form-control" placeholder="Nombre"
                                                                value="<?php if($usuario1){ echo $usuario1["Cartera3"]; } ?>" />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <h6>&nbsp; </h6><input onkeyup="formateo(this)" type="text"
                                                                name="valorcartera3" id="valorcartera3"
                                                                class="form-control" placeholder="Valor"
                                                                value="<?php if($usuario1){ echo $usuario1["ValorCartera3"]; } ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-12 col-md-6">
                                                            <h6>Cartera 4:</h6><input type="text" onkeyup="mayus(this)"
                                                                name="nombrecartera4" id="nombrecartera4"
                                                                class="form-control" placeholder="Nombre"
                                                                value="<?php if($usuario1){ echo $usuario1["Cartera4"]; } ?>" />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <h6>&nbsp; </h6><input onkeyup="formateo(this)" type="text"
                                                                name="valorcartera4" id="valorcartera4"
                                                                class="form-control" placeholder="Valor"
                                                                value="<?php if($usuario1){ echo $usuario1["ValorCartera4"]; } ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-12 col-md-6">
                                                            <h6>Cartera 5:</h6><input type="text" onkeyup="mayus(this)"
                                                                name="nombrecartera5" id="nombrecartera5"
                                                                class="form-control" placeholder="Nombre"
                                                                value="<?php if($usuario1){ echo $usuario1["Cartera5"]; } ?>" />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <h6>&nbsp; </h6><input onkeyup="formateo(this)" type="text"
                                                                name="valorcartera5" id="valorcartera5"
                                                                class="form-control" placeholder="Valor"
                                                                value="<?php if($usuario1){ echo $usuario1["ValorCartera5"]; } ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-12 col-md-6">
                                                            <h6>Cartera 6:</h6><input type="text" onkeyup="mayus(this)"
                                                                name="nombrecartera6" id="nombrecartera6"
                                                                class="form-control" placeholder="Nombre"
                                                                value="<?php if($usuario1){ echo $usuario1["Cartera6"]; } ?>" />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <h6>&nbsp; </h6><input onkeyup="formateo(this)" type="text"
                                                                name="valorcartera6" id="valorcartera6"
                                                                class="form-control" placeholder="Valor"
                                                                value="<?php if($usuario1){ echo $usuario1["ValorCartera6"]; } ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <input onkeyup="format(this)" onchange="formateo(this)"
                                                                type="text" name="totalcompracartera"
                                                                id="totalcompracartera" class="form-control"
                                                                placeholder=""
                                                                style="background-color: #2BB454; color: white;"
                                                                readonly
                                                                value="<?php if($usuario1){ echo $usuario1["TotalValoresCartera"]; } ?>" />
                                                        </div>
                                                        <div class="col-12 col-md-6"></div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-12 col-md-6 mb-3"></div> -->
                                                <div class="col-12 col-md-6 mb-3 mt-3">
                                                    <div class="mb-3">
                                                        <h6>CAPACIDAD CUOTA:</h4>
                                                            <input onkeyup="format(this)" onchange="format(this)"
                                                                type="text" name="capacidadcuota" id="capacidadcuota"
                                                                class="form-control" placeholder=""
                                                                style="background-color: #2BB454; color: white;"
                                                                readonly
                                                                value="<?php if($usuario1){ echo $usuario1["CapacidadCuota"]; } ?>" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6><b>FACTOR</b></h6>
                                                        <h6>Entidad</h6>
                                                        <select class="form-select mb-3" onchange="changeEntity()"
                                                            name="entidad" id="entidad">
                                                            <option value="1">BAYPORT</option>
                                                            <option value="2">EXCEL CREDIT</option>
                                                            <option value="3">CREDIVALORES</option>
                                                            <option value="4">CREDIFINANCIERA</option>
                                                            <!-- <option>BANCO POPULAR</option> -->
                                                        </select>
                                                        <h6>Rango de edad*</h6>
                                                        <select class="form-select mb-3" name="edad" id="edad"
                                                            onchange="changeAge()">
                                                            <option value="1">
                                                                < 76 Años</option>
                                                            <option value="2"> > 76 Años</option>
                                                        </select>
                                                        <h6>Tasa*</h6>
                                                        <select class="form-select mb-3" name="tasa" id="tasa"
                                                            onchange="changeRate()">
                                                            <option value="1">1.09%</option>
                                                            <option value="2">1.11%</option>
                                                            <option value="3">1.13%</option>
                                                            <option value="4">1.15%</option>
                                                            <option value="5">1.17%</option>
                                                            <option value="6">1.19%</option>
                                                            <option value="7">1.25%</option>
                                                            <option value="8">1.28%</option>
                                                            <option value="9">1.30%</option>
                                                            <option value="10">1.31%</option>
                                                            <option value="11">1.34%</option>
                                                            <option value="12">1.35%</option>
                                                            <option value="13">1.36%</option>
                                                            <option value="14">1.37%</option>
                                                            <option value="15">1.39%</option>
                                                            <option value="16">1.40%</option>
                                                            <option value="17">1.41%</option>
                                                            <option value="18">1.42%</option>
                                                            <option value="19">1.43%</option>
                                                            <option value="20">1.45%</option>
                                                            <option value="21">1.46%</option>
                                                            <option value="22">1.47%</option>
                                                            <option value="23">1.48%</option>
                                                            <option value="24">1.49%</option>
                                                            <option value="25">1.50%</option>
                                                            <option value="26">1.51%</option>
                                                            <option value="27">1.53%</option>
                                                            <option value="28">1.55%</option>
                                                            <option value="29">1.56%</option>
                                                            <option value="90">1.90%</option>
                                                            <option value="91">1.95%</option>
                                                            <option value="92">2.00%</option>
                                                            <option value="93">2.05%</option>
                                                            <option value="94">2.10%</option>
                                                        </select>
                                                        <h6>N° Cuotas*</h6>
                                                        <select class="form-select mb-3" name="factcuo" id="factcuo"
                                                            onchange="setValorCuota()">
                                                            <option value="0">Seleccionar</option>
                                                            <option value="0.0927686">12</option>
                                                            <option value="0.0648979">18</option>
                                                            <option value="0.0510327">24</option>
                                                            <option value="0.0373064">36</option>
                                                            <option value="0.0305797">48</option>
                                                            <option value="0.0266499">60</option>
                                                            <option value="0.0241154">72</option>
                                                            <option value="0.0223751">84</option>
                                                            <option value="0.0211281">96</option>
                                                            <option value="0.0202072">108</option>
                                                            <option value="0.0195116">120</option>
                                                            <option value="0.0189773">132</option>
                                                            <option value="0.0185617">144</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>MONTO:</h6>
                                                        <div class="input-group">
                                                            <input onkeyup="changeMonto(this)" type="text" name="monto"
                                                                id="monto" class="form-control" placeholder=""
                                                                style="background-color: #2BB454; color: white;"
                                                                readonly
                                                                value="<?php if($usuario1){ echo $usuario1["Monto"]; } ?>" />
                                                            <div class="input-group-append">
                                                                <div
                                                                    style="padding: 5px; border-color: gray; border-width:1px; border-style: solid; border-radius: 0 5px 5px 0;">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="checkmonto" name="checkmonto" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>AVAL:</h6>
                                                        <select class="form-select mb-3" name="optionaval"
                                                            id="optionaval" onchange="setAval()">
                                                            <?php 
														require("conexion.php");
														$query = $conexion ->prepare("SELECT * FROM avales");
														$query->execute();
														$data = $query->fetchAll();
														foreach ($data as $valores):
														?>
                                                            <option value="<?php echo $valores["valorAval"]; ?>"
                                                                <?php if($usuario1){ if($valores["valorAval"] === $usuario1["idAval"]){echo 'selected'; } } ?>>
                                                                <?php echo $valores["nombreAval"]; ?></option>
                                                            <?php
														endforeach;
														?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Valor AVAL:</h6>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input onkeyup="format(this)" onchange="format(this)"
                                                            type="text" name="vaval" id="vaval" class="form-control"
                                                            placeholder=""
                                                            style="background-color: #2BB454; color: white;" readonly
                                                            value="<?php if($usuario1){ echo $usuario1["Vaval"]; } ?>" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Total - AVAL:</h6>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input onkeyup="format(this)" onchange="format(this)"
                                                            type="text" name="aval" id="aval" class="form-control"
                                                            placeholder=""
                                                            style="background-color: #2BB454; color: white;" readonly
                                                            value="<?php if($usuario1){ echo $usuario1["ValorAval"]; } ?>" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>BENEFICIO:</h6>
                                                        <select class="form-select mb-3" onchange="setBeneficio()"
                                                            name="optionbeneficios" id="optionbeneficios">
                                                            <?php 
														require("conexion.php");
														$query = $conexion ->prepare("SELECT * FROM beneficios");
														$query->execute();
														$data = $query->fetchAll();
														foreach ($data as $valores):
														?>
                                                            <option value="<?php echo $valores["idBeneficios"]; ?>"
                                                                <?php if($usuario1){ if($valores["idBeneficios"] === $usuario1["idBeneficio"]){echo 'selected'; } } ?>>
                                                                <?php echo $valores["nombreBeneficios"]; ?></option>
                                                            <?php
														endforeach;
														?>
                                                            <!-- <option>$XXXXX</option> -->
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>TOTAL - Beneficios:</h6>
                                                        <input onchange="format(this)" type="text" name="beneficios"
                                                            id="beneficios" class="form-control" placeholder=""
                                                            style="background-color: #2BB454; color: white;" readonly
                                                            value="<?php if($usuario1){ echo $usuario1["TotalBeneficios"]; } ?>" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>SALDO CARTERA A RECOGER:</h6>
                                                        <input onkeyup="formatteo(this)" type="text" name="saldocartera"
                                                            id="saldocartera" class="form-control" placeholder=""
                                                            value="<?php if($usuario1){ echo $usuario1["saldoCarteraR"]; } ?>" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>REFINANCIACION:</h6>
                                                        <input onkeyup="formateoo(this)" type="text" name="refi"
                                                            id="refi" class="form-control" placeholder=""
                                                            value="<?php if($usuario1){ echo $usuario1["Refinanciacion"]; } ?>" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>COMISION ASESOR:</h6>
                                                        <select class="form-select mb-3" onchange="setComAs()"
                                                            name="optioncomis" id="optioncomis">
                                                            <?php 
														require("conexion.php");
														$query = $conexion ->prepare("SELECT * FROM ComisionAsesor");
														$query->execute();
														$data = $query->fetchAll();
														foreach ($data as $valores):
														?>
                                                            <option value="<?php echo $valores["valorCA"]; ?>"
                                                                <?php if($usuario1){ if($valores["valorCA"] == $usuario1["idComision"]){echo 'selected'; } } ?>>
                                                                <?php echo $valores["nombreCA"]; ?></option>
                                                            <?php
														endforeach;
														?>
                                                            <!-- <option>$XXXXX</option> -->
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>TOTAL REMANENTE:</h6>
                                                        <input onkeyup="format(this)" onchange="format(this)"
                                                            type="text" name="remanente" id="remanente"
                                                            class="form-control" placeholder=""
                                                            style="background-color: #2BB454; color: white;" readonly
                                                            value="<?php if($usuario1){ echo $usuario1["totalRemanente"]; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-3 mt-2">
                                                    <div class="card-body text-center">
                                                        <div class="btn btn-success btn-lg" id="BotonCalcular"
                                                            onclick="calcularPropuesta()">Calcular</div>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit"
                                                            class="btn btn-success" value="Guardar" />
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
					// echo $usuario1["FEDTotalDevengadoLibreInversion"]; 
					?>
                </div>
            </main>
            <?php include("footer.php"); ?>
        </div>
    </div>

    <!-- Modal Crear usuario -->
    <div class="modal fade" id="modalCrearUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="registrarusaurios.php" method="POST">
                    <div class="modal-body">
                        <div class="m-sm-4">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <input class="form-control form-control-lg" type="number" name="cedula"
                                        placeholder="Número de identifcación" required />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <input class="form-control form-control-lg" type="text" name="name"
                                        placeholder="Primer nombre" required />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <input class="form-control form-control-lg" type="text" name="lastname"
                                        placeholder="Primer apellido" required />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <input class="form-control form-control-lg" type="email" name="mail"
                                        placeholder="Email" required />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <input class="form-control form-control-lg" type="number" name="phone"
                                        placeholder="Número de celular" required />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <input class="form-control form-control-lg" type="text" name="password"
                                        placeholder="contraseña" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-success" value="Registrar" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Crear Propuesta -->
    <div class="modal fade" id="modalCrearPropuesta" tabindalex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Propuesta de</b> <b class="text-CreditosCardonaDark">Crédito</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container">
                        <div class="form-group m-form__group row">
                            <label id="labelPropuestaCedula" class="col-12 col-form-label"><b>Cliente:</b> CC.
                                <?php if($usuario){ echo $usuario["USRIdentificationNumber"]; } ?></label>
                            <div class="container">
                                <div class="row">
                                    <label class="col-sm pl-5 font-weight-bold bg-CreditosCardonaDark">Crédito
                                        &nbsp;</label>
                                    <label class="col-sm font-weight-bold bg-CreditosCardonaLight">&nbsp; Libre
                                        Inversión &nbsp;</label>
                                    <!-- <div class="col-sm"></div>						 -->
                                </div>
                            </div>
                            <p class="col-12 col-form-label text-justify">
                            <p id="modalPropuestaLibreInversion"></p>
                            <a href="" target="_blank" style="font-size:20px; color:#25d366;" id="enlacewlibre">
                                <i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp; Enviar por whatsapp
                            </a>
                            </p>

                            <div class="container">
                                <div class="row">
                                    <label class="col-sm pl-5 font-weight-bold bg-CreditosCardonaDark">Crédito
                                        &nbsp;</label>
                                    <label class="col-sm font-weight-bold bg-CreditosCardonaLight">&nbsp; Compra de
                                        Cartera &nbsp;</label>
                                    <!-- <div class="col-sm"></div> -->
                                </div>
                            </div>
                            <p class="col-12 col-form-label text-justify">
                            <p id="modalPropuestaCompraCartera"></p>

                            <!-- arreglar el href IMPORTANTE-->
                            <a href="" target="_blank" style="font-size:20px; color:#25d366; display:none;"
                                id="enlacewcompra">
                                <i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp; Enviar por whatsapp
                            </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>

    <script>
    <?php if($usuario1["Monto"] != ""){ ?>
    let capacidadGeneral = <?php echo str_replace(".", "", $usuario1["Monto"]); ?>;
    <?php } ?>
    <?php if($usuario1["idEntidad"] != ""){ ?>
    var EntidadResult = <?php echo $usuario1["idEntidad"]; ?>;
    <?php } ?>
    <?php if($usuario1["idEdad"] != ""){ ?>
    var EdadResult = <?php echo $usuario1["idEdad"]; ?>;
    <?php } ?>
    <?php if($usuario1["idTasa"] != ""){ ?>
    var TasaResult = <?php echo $usuario1["idTasa"]; ?>;
    <?php } ?>
    <?php if($usuario1["Factor"] != ""){ ?>
    var factorResult = <?php echo $usuario1["Factor"]; ?>;
    <?php }  ?>
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.1.0/papaparse.min.js">
    </script>

    <script src="js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/factores.js"></script>

    <script>
    function mayus(e) {
        e.value = e.value.toUpperCase();
    }

    function formateo(input) {
        var num = input.value.replace(/\./g, "");
        if (!isNaN(num)) {
            num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split("").reverse().join("").replace(/^[\.]/, "");
            input.value = num;
        } else {
            alert("Solo se permiten numeros");
            input.value = input.value.replace(/[^\d\.]*/g, "");
        }
    }

    function format(input) {
        var num = input.value.replace(/\./g, "");
        if (!isNaN(num)) {
            num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split("").reverse().join("").replace(/^[\.]/, "");
            input.value = num;
        } else {
            alert("Solo se permiten numeros");
            input.value = input.value.replace(/[^\d\.]*/g, "");
        }

        // let totaldevengado = document
        // 	.getElementById("totald")
        // 	.value;

        let totaldevengado = document
            .getElementById("totald")
            .value.replaceAll(".", "");
        console.log(totaldevengado)
        let salud = document.getElementById("salud").value.replaceAll(".", "");
        let pension = document.getElementById("pension").value.replaceAll(".", "");
        let caprovimpo = document
            .getElementById("caprovimpo")
            .value.replaceAll(".", "");
        let pricom = document.getElementById("pricom").value.replaceAll(".", "");
        let partiali = document.getElementById("partiali").value.replaceAll(".", "");
        let salmin = document.getElementById("salmin").value.replaceAll(".", "");
        // let deducciones = document.getElementById('deducciones').value.replaceAll('.', '');
        let pagadur = document
            .getElementById("pagaduria")
            .value
        let priordpub = document
            .getElementById("priordpub")
            .value.replaceAll(".", "");
        let bonordpub = document
            .getElementById("bonordpub")
            .value.replaceAll(".", "");
        let prespe = document.getElementById("prespe").value.replaceAll(".", "");
        let devopartialiment = document
            .getElementById("devopartialiment")
            .value.replaceAll(".", "");
        let servicimedi = document
            .getElementById("servicimedi")
            .value.replaceAll(".", "");
        let casurautom = document
            .getElementById("casurautom")
            .value.replaceAll(".", "");
        let descuentos = document
            .getElementById("descuentos")
            .value.replaceAll(".", "");
        let result =
            Math.round(totaldevengado) -
            Math.round(salud) -
            Math.round(pension) -
            Math.round(caprovimpo) -
            Math.round(priordpub) -
            Math.round(bonordpub) -
            Math.round(prespe) -
            Math.round(pricom) -
            Math.round(partiali) -
            Math.round(salmin) -
            Math.round(devopartialiment) -
            Math.round(servicimedi) -
            Math.round(casurautom)
        // - Math.round(descuentos);
        console.log(result)
        //Continuar aqui....
        if (pagadur == 1 || pagadur == 4 || pagadur == 8 || pagadur == 3 || pagadur == 5 || pagadur == 11) {
            if (result <= 2000000) {
                console.log("Por debajo de 2000000")
                Swal.fire({
                    title: "Información",
                    text: "El resultado esta por debajo de $2'000.000, posible respetando el salario minimo!",
                    icon: "info",
                    showCancelButton: false,
                    confirmButtonColor: "#2BB454",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "A revisar",
                    cancelButtonText: "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // console.log("confirmado")
                        document.getElementById("salud").value = "";
                        document.getElementById("pension").value = "";
                        document.getElementById("caprovimpo").value = "";
                        document.getElementById("priordpub").value = "";
                        document.getElementById("bonordpub").value = "";
                        document.getElementById("prespe").value = "";
                        document.getElementById("pricom").value = "";
                        document.getElementById("partiali").value = "";
                        document.getElementById("salmin").value = "";
                        document.getElementById("devopartialiment").value = "";
                        document.getElementById("servicimedi").value = "";
                        document.getElementById("casurautom").value = "";
                        document.getElementById("descuentos").value = "";
                    }
                })
            }
        }
    }

    function formateoo(input) {
        var num = input.value.replace(/\./g, "");
        if (!isNaN(num)) {
            num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split("").reverse().join("").replace(/^[\.]/, "");
            input.value = num;
        } else {
            alert("Solo se permiten numeros");
            input.value = input.value.replace(/[^\d\.]*/g, "");
        }

        let monto = document
            .getElementById("monto")
            .value.replaceAll(".", "");
        let refi = document
            .getElementById("refi")
            .value.replaceAll(".", "");
        let saldocartera = document
            .getElementById("saldocartera")
            .value.replaceAll(".", "");
        let aval = document
            .getElementById("optionaval")
            .value;
        let avalvalue = document
            .getElementById("vaval");
        let avalvalue2 = document
            .getElementById("aval");
        let rema = document
            .getElementById("remanente");

        let optionbeneficios = document.getElementById('optionbeneficios');
        let benn = optionbeneficios.options[optionbeneficios.selectedIndex].text;

        let nuevoaval = Math.round(Math.round(Math.round(monto) - Math.round(refi)) * parseFloat(aval));
        avalvalue.value = new Intl.NumberFormat('de-DE').format(nuevoaval);
        avalvalue2.value = new Intl.NumberFormat('de-DE').format(Math.round(Math.round(monto) - Math.round(nuevoaval)));
        let resultadof = Math.round(monto) - Math.round(refi) - Math.round(benn) - nuevoaval - Math.round(saldocartera);

        rema.value = new Intl.NumberFormat('de-DE').format(resultadof);

    }

    function formatteo(input) {
        var num = input.value.replace(/\./g, "");
        if (!isNaN(num)) {
            num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split("").reverse().join("").replace(/^[\.]/, "");
            input.value = num;
        } else {
            alert("Solo se permiten numeros");
            input.value = input.value.replace(/[^\d\.]*/g, "");
        }

        let beneficios = document
            .getElementById("beneficios")
            .value.replaceAll(".", "");
        let refi = document
            .getElementById("refi")
            .value.replaceAll(".", "");
        let saldoc = document
            .getElementById("saldocartera")
            .value.replaceAll(".", "");
        let rema = document
            .getElementById("remanente");

        let resultadof = Math.round(beneficios) - Math.round(saldoc);

        rema.value = new Intl.NumberFormat('de-DE').format(resultadof);



    }

    function calcularPropuesta() {
        let enti = document.getElementById('entidad').value;
        let totalCarteras = document.getElementById('totalcompracartera').value;
        let optionbeneficios = document.getElementById('optionbeneficios');
        let benef = optionbeneficios.options[optionbeneficios.selectedIndex].text;
        let tiempo = document.getElementById('factcuo');
        let cuotaLibre = document.getElementById('descuentoscuota').value.replaceAll('.', '');
        let valorfactor = tiempo.value;
        let montoCarteraLibre = Math.round((Math.round(cuotaLibre)) / parseFloat(valorfactor));
        let montoCartera = document.getElementById('monto').value.replaceAll('.', '');
        let cuota = document.getElementById('capacidadcuota').value.replaceAll('.', '');
        let optionaval = document.getElementById('optionaval').value;
        let aval = (Math.round(montoCartera)) * parseFloat(optionaval);
        let aval2 = Math.round((Math.round(montoCarteraLibre)) * parseFloat(optionaval));
        let t = tiempo.options[tiempo.selectedIndex].text;
        let resultdescuentos = document.getElementById('beneficios').value.replaceAll('.', '');
        let resultdescuentosLibre = montoCarteraLibre - aval2 - Math.round(benef);
        console.log("VOY A VER ESTO2--->", resultdescuentosLibre)
        let carte1 = document.getElementById('nombrecartera1').value;
        let carte2 = document.getElementById('nombrecartera2').value;
        let carte3 = document.getElementById('nombrecartera3').value;
        let carte4 = document.getElementById('nombrecartera4').value;
        let carte5 = document.getElementById('nombrecartera5').value;
        let carte6 = document.getElementById('nombrecartera6').value;
        let carte1ra = document.getElementById('valorcartera1').value.replaceAll('.', '');
        let carte2ra = document.getElementById('valorcartera2').value.replaceAll('.', '');
        let carte3ra = document.getElementById('valorcartera3').value.replaceAll('.', '');
        let carte4ra = document.getElementById('valorcartera4').value.replaceAll('.', '');
        let carte5ra = document.getElementById('valorcartera5').value.replaceAll('.', '');
        let carte6ra = document.getElementById('valorcartera6').value.replaceAll('.', '');
        // let enti = document.getElementById('entidad').value;
        let saldoc = document.getElementById('saldocartera').value.replaceAll('.', '');
        let refi = document.getElementById('refi').value.replaceAll('.', '');
        let comas = document.getElementById('optioncomis').value;
        let monto = document.getElementById('monto').value.replaceAll('.', '');
        // let optionaval = document.getElementById('optionaval').value;
        // let nocompracartera = 'Sin compra de cartera'
        let nocompracartera = '<p style="color: red;">Sin compra de cartera</p>';
        if (enti == 3) {
            let comcred = 150000;
            let ivacomcred = comcred * 0.19;
            let cheque = 3000;
            let ivacheque = cheque * 0.19;
            let segvid = (Math.round(monto) * 1066) / 1000000;
            let av = (Math.round(monto)) * parseFloat(optionaval);
            let ivav = Math.round(av) * 0.19;
            let cargfij = comcred + ivacomcred + cheque + ivacheque + segvid + Math.round(av) + ivav;
            let com = Math.round(Math.round(monto) * parseFloat(comas))
            let resultado = Math.round(monto) - com - Math.round(saldoc) - Math.round(refi) - Math.round(cargfij);
            let resultadoLib = Math.round(montoCarteraLibre) - com - Math.round(cargfij);
            let resultCar = Math.round(cargfij + com);
            let segvid2 = (Math.round(montoCarteraLibre) * 1066) / 1000000;
            let av2 = (Math.round(montoCarteraLibre)) * parseFloat(optionaval);
            let ivav2 = Math.round(av2) * 0.19;
            let cargfij2 = comcred + ivacomcred + cheque + ivacheque + segvid2 + Math.round(av2) + ivav2;
            let com2 = Math.round(Math.round(montoCarteraLibre) * parseFloat(comas))
            let resultado2 = Math.round(montoCarteraLibre) - com2 - Math.round(saldoc) - Math.round(refi) - Math.round(
                cargfij2);
            let resultadoLib2 = Math.round(montoCarteraLibre) - com2 - Math.round(cargfij2);
            let resultCar2 = Math.round(cargfij2 + com2);
            let compracarteracredi = document.getElementById('saldocartera').value.replaceAll('.', '');
            // IMPORTNTE!!! ----colocar el textoURL en vez de todo lo que dice ahi, es decir
            //se crea el texto y se coloca en vez de como se esta haciendo solo se utiliza una.
            let textoURLLibre = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(montoCarteraLibre))}* 
						y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(cuotaLibre)}* 
						la entidad financiera le realiza un descuento de *$${new Intl.NumberFormat('de-DE').format(Math.round(resultCar2))}* 
						de costos fijos. Se le consignara a su cuenta un total de 
						*$${new Intl.NumberFormat('de-DE').format(Math.round(resultadoLib2))}*`;
            let txtURLCompra = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(montoCartera))}* 
							y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(cuota)}* 
							la entidad financiera le realiza un descuento de 
							*$${new Intl.NumberFormat('de-DE').format(Math.round(resultCar))}* de costos fijos. 
							De esta capacidad se paga ${compracarteracredi != "" ? `la cartera total de de *$${new Intl.NumberFormat('es-MX').format(saldoc)}*` : `la cartera de *$${totalCarteras}*`} y el remanente a consignar a su cuenta 
							es de *$${new Intl.NumberFormat('de-DE').format(Math.round(resultado))}*.`;
            console.log(Math.round(document.getElementById('totalcompracartera').value))
            document.getElementById('modalPropuestaLibreInversion').innerHTML = textoURLLibre;

            //ESTE ES NUEVO Y ESTARE PENDIENTE
            // console.log("OJO",refinanciacion)
            let avalR = document.getElementById('vaval').value.replaceAll('.', '');
            let descu = document.getElementById('remanente').value.replaceAll('.', '');
            if (cuota != cuotaLibre) {
                if (Math.round(cuota) < Math.round(cuotaLibre)) {
                    console.log("SI ESTA F");
                    // document.getElementById('modalPropuestaLibreInversion').innerHTML = textoURLLibre;
                    let txtL = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(monto))}* 
							y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuota))}* 
							la entidad financiera le realiza un descuento de *${parseInt(parseFloat(optionaval)*100)}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(aval)}* 
							y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
							*$${new Intl.NumberFormat('de-DE').format(Math.round(descu))}*`;
                    document.getElementById('modalPropuestaLibreInversion').innerHTML = txtL;
                } else {
                    //verificar si totalcompracartera vacio o cero sino restarlo de la cuota
                    if (document.getElementById('totalcompracartera').value.replaceAll('.', '') != "") {
                        // console.log(document.getElementById('totalcompracartera').value)
                        console.log("AQUI")
                        if (Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', '')) > 0) {
                            console.log("AQUI2")
                            let txtL =
                                `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(  Math.round(Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))) /  parseFloat(valorfactor) )   )}* 
								y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))))}* 
								la entidad financiera le realiza un descuento de *${parseInt(parseFloat(optionaval)*100)}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(  Math.round(Math.round(Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))) /  parseFloat(valorfactor)) * parseFloat(optionaval) ) )}* 
								y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
								*$${new Intl.NumberFormat('de-DE').format(	Math.round(		Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))) /  parseFloat(valorfactor) -  Math.round(Math.round(Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))) /  parseFloat(valorfactor)) * parseFloat(optionaval))	- Math.round(benef) )	)}*`;
                            document.getElementById('modalPropuestaLibreInversion').innerHTML = txtL;
                        } else {
                            let txtL = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(monto))}* 
								y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuota))}* 
								la entidad financiera le realiza un descuento de *${parseInt(parseFloat(optionaval)*100)}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(aval)}* 
								y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
								*$${new Intl.NumberFormat('de-DE').format(Math.round(descu))}*`;
                            document.getElementById('modalPropuestaLibreInversion').innerHTML = txtL;
                        }
                    } else {
                        let txtL = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(monto))}* 
                        y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuota))}* 
                        la entidad financiera le realiza un descuento de *${parseInt(parseFloat(optionaval)*100)}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(aval)}* 
                        y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
                        *$${new Intl.NumberFormat('de-DE').format(Math.round(descu))}*`;
                        document.getElementById('modalPropuestaLibreInversion').innerHTML = txtL;
                        // document.getElementById('modalPropuestaLibreInversion').innerHTML = textoURLLibre;
                    }
                }
            } else {
                document.getElementById('modalPropuestaLibreInversion').innerHTML = textoURLLibre;
            }


            if (compracarteracredi != "") {
                document.getElementById('modalPropuestaCompraCartera').innerHTML = txtURLCompra;
                document.getElementById('enlacewcompra').style.display = "block";
            } else {
                if (document.getElementById('totalcompracartera').value != "") {
                    if (Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', '')) > 0) {
                        document.getElementById('modalPropuestaCompraCartera').innerHTML = txtURLCompra;
                        document.getElementById('enlacewcompra').style.display = 'block';
                    } else {
                        document.getElementById('modalPropuestaCompraCartera').innerHTML = nocompracartera;
                    }
                } else {
                    document.getElementById('modalPropuestaCompraCartera').innerHTML = nocompracartera;
                }
            }
            let URLLibre = `https://wa.me/57<?php echo $usuario["USRCellphone"]; ?>?text=${textoURLLibre}`;
            let URLCompra = `https://wa.me/57<?php echo $usuario["USRCellphone"]; ?>?text=${txtURLCompra}`;
            document.getElementById("enlacewlibre").href = URLLibre;
            document.getElementById("enlacewcompra").href = URLCompra;

        } else if (enti == 4) {
            let comcred = 150000;
            let ivacomcred = comcred * 0.19;
            let cheque = 3000;
            let ivacheque = cheque * 0.19;
            let segvid = (Math.round(monto) * 969) / 1000000;
            let av = (Math.round(monto)) * parseFloat(optionaval);
            let ivav = Math.round(av) * 0.19;
            let segVol = 13020;
            let cargfij = comcred + ivacomcred + cheque + ivacheque + segvid + av + ivav + segVol;
            let com = Math.round(Math.round(monto) * parseFloat(comas))
            let resultado = Math.round(monto) - com - Math.round(saldoc) - Math.round(refi) - Math.round(cargfij);
            let resultCar = Math.round(cargfij + com);
            let resultadoLib = Math.round(monto) - com - Math.round(cargfij);
            let segvid2 = (Math.round(montoCarteraLibre) * 969) / 1000000;
            let av2 = (Math.round(montoCarteraLibre)) * parseFloat(optionaval);
            let ivav2 = Math.round(av2) * 0.19;
            // let segVol = 13020;
            let cargfij2 = comcred + ivacomcred + cheque + ivacheque + segvid2 + av2 + ivav2 + segVol;
            let com2 = Math.round(Math.round(montoCarteraLibre) * parseFloat(comas))
            let resultado2 = Math.round(montoCarteraLibre) - com2 - Math.round(saldoc) - Math.round(refi) - Math.round(
                cargfij2);
            let resultCar2 = Math.round(cargfij2 + com2);
            let resultadoLib2 = Math.round(montoCarteraLibre) - com2 - Math.round(cargfij2);
            let compracarteracredi = document.getElementById('saldocartera').value.replaceAll('.', '');
            // IMPORTNTE!!! ----colocar el textoURL en vez de todo lo que dice ahi, es decir
            //se crea el texto y se coloca en vez de como se esta haciendo solo se utiliza una.
            let textoURLLibre = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(montoCarteraLibre))}* 
						y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(cuotaLibre)}* 
						la entidad financiera le realiza un descuento de *$${new Intl.NumberFormat('de-DE').format(Math.round(resultCar2))}* 
						de costos fijos. Se le consignara a su cuenta un total de 
						*$${new Intl.NumberFormat('de-DE').format(Math.round(resultadoLib2))}*`;
            let txtURLCompra = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(montoCartera))}* 
							y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(cuota)}* 
							la entidad financiera le realiza un descuento de 
							*$${new Intl.NumberFormat('de-DE').format(Math.round(resultCar))}* de costos fijos. 
							De esta capacidad se paga ${compracarteracredi != "" ? `la cartera total de de *$${new Intl.NumberFormat('es-MX').format(saldoc)}*` : `la cartera de *$${totalCarteras}*`} y el remanente a consignar a su cuenta 
							es de *$${new Intl.NumberFormat('de-DE').format(Math.round(resultado))}*.`;
            console.log(Math.round(document.getElementById('totalcompracartera').value))
            document.getElementById('modalPropuestaLibreInversion').innerHTML = textoURLLibre;

            //ESTE ES NUEVO Y ESTARE PENDIENTE
            // console.log("OJO",refinanciacion)
            let avalR = document.getElementById('vaval').value.replaceAll('.', '');
            let descu = document.getElementById('remanente').value.replaceAll('.', '');
            if (cuota != cuotaLibre) {
                if (Math.round(cuota) < Math.round(cuotaLibre)) {
                    console.log("SI ESTA F");
                    // document.getElementById('modalPropuestaLibreInversion').innerHTML = textoURLLibre;
                    let txtL = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(monto))}* 
							y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuota))}* 
							la entidad financiera le realiza un descuento de *${parseInt(parseFloat(optionaval)*100)}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(aval)}* 
							y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
							*$${new Intl.NumberFormat('de-DE').format(Math.round(descu))}*`;
                    document.getElementById('modalPropuestaLibreInversion').innerHTML = txtL;
                } else {
                    //verificar si totalcompracartera vacio o cero sino restarlo de la cuota
                    if (document.getElementById('totalcompracartera').value.replaceAll('.', '') != "") {
                        // console.log(document.getElementById('totalcompracartera').value)
                        console.log("AQUI")
                        if (Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', '')) > 0) {
                            console.log("AQUI2")
                            console.log("TTT--->", parseInt(parseFloat(optionaval) * 100))
                            let txtL =
                                `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(  Math.round(Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))) /  parseFloat(valorfactor) )   )}* 
								y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))))}* 
								la entidad financiera le realiza un descuento de *${parseInt(parseFloat(optionaval)*100)}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(  Math.round(Math.round(Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))) /  parseFloat(valorfactor)) * parseFloat(optionaval) ) )}* 
								y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
								*$${new Intl.NumberFormat('de-DE').format(	Math.round(		Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))) /  parseFloat(valorfactor) -  Math.round(Math.round(Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))) /  parseFloat(valorfactor)) * parseFloat(optionaval))	- Math.round(benef) )	)}*`;
                            document.getElementById('modalPropuestaLibreInversion').innerHTML = txtL;
                        } else {
                            let txtL = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(monto))}* 
								y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuota))}* 
								la entidad financiera le realiza un descuento de *${parseInt(parseFloat(optionaval)*100)}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(aval)}* 
								y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
								*$${new Intl.NumberFormat('de-DE').format(Math.round(descu))}*`;
                            document.getElementById('modalPropuestaLibreInversion').innerHTML = txtL;
                        }
                    } else {
                        let txtL = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(monto))}* 
                        y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuota))}* 
                        la entidad financiera le realiza un descuento de *${parseInt(parseFloat(optionaval)*100)}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(aval)}* 
                        y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
                        *$${new Intl.NumberFormat('de-DE').format(Math.round(descu))}*`;
                        document.getElementById('modalPropuestaLibreInversion').innerHTML = txtL;
                        // document.getElementById('modalPropuestaLibreInversion').innerHTML = textoURLLibre;
                    }
                }
            } else {
                document.getElementById('modalPropuestaLibreInversion').innerHTML = textoURLLibre;
            }

            if (compracarteracredi != "") {
                document.getElementById('modalPropuestaCompraCartera').innerHTML = txtURLCompra;
                document.getElementById('enlacewcompra').style.display = 'block';
            } else {
                if (document.getElementById('totalcompracartera').value != "") {
                    if (Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', '')) > 0) {
                        document.getElementById('modalPropuestaCompraCartera').innerHTML = txtURLCompra;
                        document.getElementById('enlacewcompra').style.display = 'block';
                    } else {
                        document.getElementById('modalPropuestaCompraCartera').innerHTML = nocompracartera;
                    }
                } else {
                    document.getElementById('modalPropuestaCompraCartera').innerHTML = nocompracartera;
                }
            }

            let URLLibre = `https://wa.me/57<?php echo $usuario["USRCellphone"]; ?>?text=${textoURLLibre}`;
            let URLCompra = `https://wa.me/57<?php echo $usuario["USRCellphone"]; ?>?text=${txtURLCompra}`;
            document.getElementById("enlacewlibre").href = URLLibre;
            document.getElementById("enlacewcompra").href = URLCompra;
        } else {
            let refinanciacion = document.getElementById('refi').value.replaceAll('.', '');
            let textoURLLibre = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(montoCarteraLibre))}* 
						y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuotaLibre))}* 
						la entidad financiera le realiza un descuento de *${parseFloat(optionaval)*100}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(aval2)}* 
						y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
						*$${new Intl.NumberFormat('de-DE').format(Math.round(resultdescuentosLibre))}*`;
            let txtURLCompra = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(montoCartera)}* 
							y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(cuota)}* 
							la entidad financiera le realiza un descuento de *${parseFloat(optionaval)*100}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(aval)}* 
							y *$${benef}* de Beneficio. 
							De esta capacidad se paga la cartera de ${carte1 != "" ? carte1+" que equivale a $"+Math.round(carte1ra)+"," : ""}${carte2 != "" ? carte2+" que equivale a $"+Math.round(carte2ra)+"," : ""}
							${carte3 != "" ? carte3+" que equivale a $"+Math.round(carte3ra)+"," : ""} ${carte4 != "" ? carte4+" que equivale a $"+Math.round(carte4ra)+"," : ""} ${carte5 != "" ? carte5+" que equivale a $"+Math.round(carte5ra)+"," : ""}
							${carte6 != "" ? carte6+" que equivale a $"+Math.round(carte6ra)+"," : ""} esto se ve reflejado en su desprendible y el remanente a consignar a su cuenta despues de descuentos  
							es de *$${new Intl.NumberFormat('de-DE').format(resultdescuentos)}*.`;
            let compracarteracredi = document.getElementById('saldocartera').value.replaceAll('.', '');
            console.log(Math.round(document.getElementById('totalcompracartera').value))
            // console.log("OJO",refinanciacion)
            let avalR = document.getElementById('vaval').value.replaceAll('.', '');
            let descu = document.getElementById('remanente').value.replaceAll('.', '');
            let textoURLLibreR = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(montoCartera)}* 
							y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(cuota)}* 
							la entidad financiera le realiza un descuento de *${parseFloat(optionaval)*100}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(avalR)}* 
							y *$${benef}* de Beneficio. 
							De esta capacidad se paga la cartera de ${carte1 != "" ? carte1+" que equivale a *$"+Math.round(carte1ra)+"*," : ""}${carte2 != "" ? carte2+" que equivale a *$"+Math.round(carte2ra)+"*," : ""}
							${carte3 != "" ? carte3+" que equivale a *$"+Math.round(carte3ra)+"*," : ""} ${carte4 != "" ? carte4+" que equivale a *$"+Math.round(carte4ra)+"*," : ""} ${carte5 != "" ? carte5+" que equivale a *$"+Math.round(carte5ra)+"*," : ""}
							${carte6 != "" ? carte6+" que equivale a *$"+Math.round(carte6ra)+"*," : ""} esto se ve reflejado en su desprendible y el remanente a consignar a su cuenta despues de descuentos  
							es de *$${new Intl.NumberFormat('de-DE').format(descu)}*.`;
            console.log("CUOTA", cuota)
            console.log("CUOTALIBRE", cuotaLibre)
            if (cuota != cuotaLibre) {
                if (Math.round(cuota) < Math.round(cuotaLibre)) {
                    console.log("SI ESTA F");
                    // document.getElementById('modalPropuestaLibreInversion').innerHTML = textoURLLibre;
                    let txtL = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(monto))}* 
							y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuota))}* 
							la entidad financiera le realiza un descuento de *${parseFloat(optionaval)*100}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(aval)}* 
							y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
							*$${new Intl.NumberFormat('de-DE').format(Math.round(descu))}*`;
                    document.getElementById('modalPropuestaLibreInversion').innerHTML = txtL;
                } else {
                    //verificar si totalcompracartera vacio o cero sino restarlo de la cuota
                    if (document.getElementById('totalcompracartera').value.replaceAll('.', '') != "") {
                        // console.log(document.getElementById('totalcompracartera').value)
                        console.log("AQUI")
                        if (Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', '')) > 0) {
                            console.log("AQUI2")
                            let txtL =
                                `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(  Math.round(Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))) /  parseFloat(valorfactor) )   )}* 
								y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))))}* 
								la entidad financiera le realiza un descuento de *${parseFloat(optionaval)*100}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(  Math.round(Math.round(Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))) /  parseFloat(valorfactor)) * parseFloat(optionaval) ) )}* 
								y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
								*$${new Intl.NumberFormat('de-DE').format(	Math.round(		Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))) /  parseFloat(valorfactor) -  Math.round(Math.round(Math.round(cuota -  Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', ''))) /  parseFloat(valorfactor)) * parseFloat(optionaval))	- Math.round(benef) )	)}*`;
                            document.getElementById('modalPropuestaLibreInversion').innerHTML = txtL;
                        } else {
                            let txtL = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(monto))}* 
								y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuota))}* 
								la entidad financiera le realiza un descuento de *${parseFloat(optionaval)*100}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(aval)}* 
								y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
								*$${new Intl.NumberFormat('de-DE').format(Math.round(descu))}*`;
                            document.getElementById('modalPropuestaLibreInversion').innerHTML = txtL;
                        }
                    } else {
                        let txtL = `Usted tiene capacidad para un crédito de *$${new Intl.NumberFormat('de-DE').format(Math.round(monto))}* 
                        y va a cancelar *${t}* cuotas de *$${new Intl.NumberFormat('de-DE').format(Math.round(cuota))}* 
                        la entidad financiera le realiza un descuento de *${parseFloat(optionaval)*100}%* de aval, que equivale a *$${new Intl.NumberFormat('de-DE').format(aval)}* 
                        y *$${benef}* de Beneficio. Se le consignara a su cuenta un total de 
                        *$${new Intl.NumberFormat('de-DE').format(Math.round(descu))}*`;
                        document.getElementById('modalPropuestaLibreInversion').innerHTML = txtL;
                        // document.getElementById('modalPropuestaLibreInversion').innerHTML = textoURLLibre;
                    }
                }
            } else {
                document.getElementById('modalPropuestaLibreInversion').innerHTML = textoURLLibre;
            }

            if (refinanciacion != "") {
                if (compracarteracredi != "") {
                    document.getElementById('modalPropuestaCompraCartera').innerHTML = textoURLLibreR;
                    document.getElementById('enlacewcompra').style.display = 'block';
                } else {
                    if (document.getElementById('totalcompracartera').value.replaceAll('.', '') != "") {
                        // console.log(document.getElementById('totalcompracartera').value)
                        if (Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', '')) > 0) {
                            document.getElementById('modalPropuestaCompraCartera').innerHTML = textoURLLibreR;
                            document.getElementById('enlacewcompra').style.display = 'block';
                        } else {
                            document.getElementById('modalPropuestaCompraCartera').innerHTML = nocompracartera;
                            document.getElementById('enlacewcompra').style.display = 'none';
                        }
                    } else {
                        document.getElementById('modalPropuestaCompraCartera').innerHTML = nocompracartera;
                        document.getElementById('enlacewcompra').style.display = 'none';
                    }
                }
                let URLLibre = `https://wa.me/57<?php echo $usuario["USRCellphone"]; ?>?text=${textoURLLibre}`;
                let URLCompra = `https://wa.me/57<?php echo $usuario["USRCellphone"]; ?>?text=${textoURLLibreR}`;
                document.getElementById("enlacewlibre").href = URLLibre;
                document.getElementById("enlacewcompra").href = URLCompra;
            } else {
                if (compracarteracredi != "") {
                    document.getElementById('modalPropuestaCompraCartera').innerHTML = textoURLLibreR;
                    document.getElementById('enlacewcompra').style.display = 'block';
                } else {
                    if (document.getElementById('totalcompracartera').value.replaceAll('.', '') != "") {

                        if (Math.round(document.getElementById('totalcompracartera').value.replaceAll('.', '')) > 0) {
                            console.log(Math.round(document.getElementById('totalcompracartera').value.replaceAll('.',
                                '')))
                            document.getElementById('modalPropuestaCompraCartera').innerHTML = textoURLLibreR;
                            document.getElementById('enlacewcompra').style.display = 'block';
                        } else {
                            document.getElementById('modalPropuestaCompraCartera').innerHTML = nocompracartera;
                            document.getElementById('enlacewcompra').style.display = 'none';
                        }
                    } else {
                        document.getElementById('modalPropuestaCompraCartera').innerHTML = nocompracartera;
                        document.getElementById('enlacewcompra').style.display = 'none';
                    }
                }
                let URLLibre = `https://wa.me/57<?php echo $usuario["USRCellphone"]; ?>?text=${textoURLLibre}`;
                let URLCompra = `https://wa.me/57<?php echo $usuario["USRCellphone"]; ?>?text=${textoURLLibreR}`;
                document.getElementById("enlacewlibre").href = URLLibre;
                document.getElementById("enlacewcompra").href = URLCompra;
            }



        }

        var modalCP = new bootstrap.Modal(document.getElementById("modalCrearPropuesta"), {
            keyboard: false
        })
        modalCP.show()

    }

    function changeOtherInput() {
        let estrategia = document.getElementById("estrategia");
        var otroInput = document.getElementById('otroinput');
        // console.log(estrategia.value)
        if (estrategia.value == "7") {
            otroInput.classList.remove('ocultoInput');
            otroInput.classList.add('vistoInput');
        } else {
            otroInput.classList.add('ocultoInput');
            otroInput.classList.remove('vistoInput');
        }

    }

    function changeSelectEstado() {
        let state = document.getElementById("status");
        var selectCity = document.getElementById('city');
        var negado = document.getElementById('neg');
        var devolucion = document.getElementById('devo');
        var rechazado = document.getElementById('rechaz');
        if (state.value == "5") {
            selectCity.classList.remove('ocultoInput');
            selectCity.classList.add('vistoInput');
            negado.classList.add('ocultoInput');
            negado.classList.remove('vistoInput');
            devolucion.classList.add('ocultoInput');
            devolucion.classList.remove('vistoInput');
            rechazado.classList.add('ocultoInput');
            rechazado.classList.remove('vistoInput');
        } else if (state.value == "12") {
            negado.classList.remove('ocultoInput');
            negado.classList.add('vistoInput');
            selectCity.classList.add('ocultoInput');
            selectCity.classList.remove('vistoInput');
            devolucion.classList.add('ocultoInput');
            devolucion.classList.remove('vistoInput');
            rechazado.classList.add('ocultoInput');
            rechazado.classList.remove('vistoInput');
        } else if (state.value == "11") {
            rechazado.classList.remove('ocultoInput');
            rechazado.classList.add('vistoInput');
            selectCity.classList.add('ocultoInput');
            selectCity.classList.remove('vistoInput');
            negado.classList.add('ocultoInput');
            negado.classList.remove('vistoInput');
            devolucion.classList.add('ocultoInput');
            devolucion.classList.remove('vistoInput');
        } else if (state.value == "10") {
            devolucion.classList.remove('ocultoInput');
            devolucion.classList.add('vistoInput');
            selectCity.classList.add('ocultoInput');
            selectCity.classList.remove('vistoInput');
            negado.classList.add('ocultoInput');
            negado.classList.remove('vistoInput');
            rechazado.classList.add('ocultoInput');
            rechazado.classList.remove('vistoInput');
        } else {
            selectCity.classList.add('ocultoInput');
            selectCity.classList.remove('vistoInput');
            negado.classList.add('ocultoInput');
            negado.classList.remove('vistoInput');
            devolucion.classList.add('ocultoInput');
            devolucion.classList.remove('vistoInput');
            rechazado.classList.add('ocultoInput');
            rechazado.classList.remove('vistoInput');
        }
    }
    </script>
    <script>function saveClientFinish() {
  Swal.fire(
    'No tan rapido!',
    'Guarda tu cliente para poder continuar',
    'info'
  )
}</script>

    <?php if($_POST){if($formulario == false){
		echo	'<script type="text/javascript">
		Swal.fire({
			title: "Información",
			text: "El usuario no existe, deseas crearlo?!",
			icon: "info",
			showCancelButton: true,
			confirmButtonColor: "#2BB454",
			cancelButtonColor: "#d33",
			confirmButtonText: "Si",
			cancelButtonText: "No"
		}).then((result) => {
			if (result.isConfirmed) {
				var modalCU = new bootstrap.Modal(document.getElementById("modalCrearUsuario"), {
					keyboard: false
				  })
				//var modalCU = document.getElementById("modalCrearUsuario");
				modalCU.show()
				//$("#modalCrearUsuario").modal("show")
			}
		})
	</script>';
	}}
	?>

    <?php
		if($_SESSION["status_register"] == "ERROR"){
			echo	'<script type="text/javascript">
						Swal.fire({
							title: "Error",
							text: "No se puede procesar la informacion, campos incompletos",
							icon: "error",
							confirmButtonText: "Entendido",
							confirmButtonColor: "#2BB454",
						})
					</script>';
			$_SESSION["status_register"] = "";
		}elseif($_SESSION["status_register"] == "EMPTY"){
			echo	'<script type="text/javascript">
						Swal.fire({
							title: "Informción",
							text: "Los campos no pueden estar vacios, completelos por favor",
							icon: "info",
							confirmButtonText: "Entendido",
							confirmButtonColor: "#2BB454",
						})
					</script>';
			$_SESSION["status_register"] = "";
		}elseif($_SESSION["status_register"] == "OK"){
			echo	'<script type="text/javascript">
						Swal.fire({
							title: "Información",
							text: "Usuario creado con exito, haga una nueva busqueda para realizar el estudio de crédito",
							icon: "info",
							confirmButtonText: "Entendido",
							confirmButtonColor: "#2BB454",
						})
					</script>';
			$_SESSION["status_register"] = "";
		}elseif($_SESSION["status_register"] == "OKSTATUS"){
			echo	'<script type="text/javascript">
						Swal.fire({
							title: "Información",
							text: "Actualización del estado de usuario exitosa",
							icon: "info",
							confirmButtonText: "Entendido",
							confirmButtonColor: "#2BB454",
						})
					</script>';
			$_SESSION["status_register"] = "";
		}

	?>

</body>

</html>
<?php
}else{
	header("location:index.php");
}
?>