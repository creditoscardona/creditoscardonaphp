<?php
session_start();
$_SESSION["status_desprendible"] = "";
if(isset($_SESSION["usuario"])){
	// $formulario = false;
	$user = null;
	$userName = null;
	$userCedula = null;
	if($_POST){
		require("conexion.php");
		$u = $_POST["cedula"];
		$userCedula = $_POST["cedula"];
		// $conexion -> setAtribute(PDO::ATTR_ERRMODE, PDO::ERRRMODE_EXCEPTION);
		$query = $conexion ->prepare("SELECT * FROM Users WHERE USRIdentificationNumber = :u");
		$query->bindParam(":u", $u);
		$query->execute();
		$usuario = $query->fetch(PDO::FETCH_ASSOC);
		if($usuario){
			$user = $usuario["USRid"];
			$userName = $usuario["USRFirstName"].' '.$usuario["USRFirstSurname"];
			$formulario=true;			
		}else{			
			$formulario=false;
		}
	}else{ $formulario = false; }
	if($_SESSION["rolId"] == 3){
		$formulario=true;
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
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/logo.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Creditos Cardona</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

					<h1 class="h3 mb-3"><strong>Acciones</strong> para Desprendibles</h1>

					<!-- Escribir aqui el codigo -->
					<div class="row" style="<?php if($formulario===false) {echo "height: 400px;";} ?>">
						<div class="col-12">
							<div class="card h-100">
								<div class="card-body">									
											<?php if($_SESSION["rolId"] == 3){ ?>
											<div class="row">
												<div class="col-12 col-md-9"></div>
												<div class="col-12 col-md-3">
												<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
													Subir desprendibles
												</button>												
												</div>
											</div>
											<?php }else{ ?>										
											
												<?php if($formulario == false){ ?>
												<form action="desprendibles.php" method="POST">
													<div class="row">
														<div class="col-6">
															<input type="text" name="cedula" id="cedula" class="form-control" placeholder="Buscar por cédula de solicitante">
														</div>
														<div class="col-6">
															<input type="submit" class="btn btn-success" value="Buscar" />
														</div>
													</div>
												</form>
												<?php }else{ ?>	
													<div class="row">												
														<div class="col-12">
															<div class="table-responsive">
																<table class="table">
																	<thead>
																		<tr>
																		<th scope="col">Cedula Solicitante</th>
																		<th scope="col">Nombre Solicitante</th>
																		<th scope="col">Nombre archivo</th>
																		<th scope="col">Fecha</th>
																		</tr>
																	</thead>
																	<tbody>															
																	<?php
																	$query2 = $conexion ->prepare("SELECT * FROM DetachableDocuments WHERE USRid = :u");
																	$query2->bindParam(":u", $user);
																	$query2->execute();
																	$data = $query2->fetchAll();															
																	if($data){													
																		foreach ($data as $valores):
																			$newDateTime = date('d/m/y h:i A', strtotime($valores["DEDCreated"]));
																			echo '<tr>
																			<td>'.$userCedula.'</td>
																			<td>'.$userName.'</td>
																			<td><a href="https://plataforma.creditoscardona.com/Uploads/Desprendibles/'.$valores["DEDName"].'" target="_blank">'.$valores["DEDName"].'</a></td>
																			<td>'.$newDateTime.'</td>
																			</tr>';													
																		endforeach;
																	}else{
																		$_SESSION["status_desprendible"] = "NOTFOUND";
																	}
																	?>														
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												<?php } 
											} ?>								
										
									
										<div class="row">
											<?php if($_SESSION["rolId"] == 3){ ?>
												<div class="col-12">
													<div class="table-responsive">													
														<table class="table table-striped mt-5 my-5">
															<thead>
																<tr>
																<th scope="col">Nombre Archivo</th>
																<th scope="col">Fecha</th>
																</tr>
															</thead>
															<tbody>
																<?php
																require("conexion.php");
																$query = $conexion ->prepare("SELECT * FROM DetachableDocuments WHERE USRid = :u");
																$query->bindParam(":u", $_SESSION["id"]);
																$query->execute();
																$data = $query->fetchAll();
																if($data){$formulario = true;}
																foreach ($data as $valores):
																$newDateTime = date('d/m/y h:i A', strtotime($valores["DEDCreated"]));
																echo '<tr>														
																<td><a href="https://plataforma.creditoscardona.com/Uploads/Desprendibles/'.$valores["DEDName"].'" target="_blank">'.$valores["DEDName"].'</a></td>
																<td>'.$newDateTime.'</td>
																</tr>
																<tr>';
																endforeach;
																?>
															</tbody>
														</table>
													</div>
												</div>
											<?php }else{ ?>
											<div class="col-6">
												
											</div>
											<div class="col-6">
												
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>					
					</div>
			</main>
			<!-- Modal -->
			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Subir desprendible</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="POST" action="subirdesprendible.php" enctype="multipart/form-data">
					<div class="modal-body">
						<p>Desprendibles en pdf, jpg, jpeg, png.</p><br>
						<span>Desprendible último mes:</span>
						<input type="file" name="desprendible_ultimo" required /><br><br><br>
						<span>Desprendible penúltimo mes:</span>
						<input type="file" name="desprendible_penultimo" required /><br><br><br>
						<span>En militares y policias</span><br>
						<span>Certificado de Tiempos y Haberes ó Constancia laboral:</span>
						<input type="file" name="c-th-cl"	 />
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-success">Subir</button>
					</div>
					</div>
				</form>
			</div>
			</div>
			<?php include("footer.php"); ?>
		</div>
	</div>

	

	<script src="js/app.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<?php if($_POST){if($formulario == false){
		echo	'<script type="text/javascript">
		Swal.fire({
			title: "Información",
			text: "El usuario no existe",
			icon: "info",
			confirmButtonText: "Entendido",
			confirmButtonColor: "#2BB454",
		})
	</script>';		
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
	$_SESSION["status_desprendible"] = "";
	}}
	?>

	<?php
		if($_SESSION["status_desprendible"] == "OK"){
			echo	'<script type="text/javascript">
						Swal.fire({
							title: "Información",
							text: "Desprendibles subidos correctamente",
							icon: "success",
							confirmButtonText: "Entendido",
							confirmButtonColor: "#2BB454",
						})
					</script>';
			$_SESSION["status_desprendible"] = "";
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
			$_SESSION["status_desprendible"] = "";
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
			$_SESSION["status_desprendible"] = "";
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
			$_SESSION["status_desprendible"] = "";
		}
	?>

</body>

</html>

<?php
}else{
	header("location:index.php");
}
?>