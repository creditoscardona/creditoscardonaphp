<?php
session_start();
if(isset($_SESSION["usuario"])){
	header("location:home.php");
}else{
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

	<title>Créditos Cardona</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<style>
		.bg { 
			/* The image used */
			background-image: url("img/bg-3.jpg");

			/* Full height */
			height: 100%; 

			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
	</style>
</head>

<body>
	<div class="bg"><main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
					<div class="text-center">
										<img src="img/CreditoCardonaLogo.png" alt="Charles Hall" class="img-fluid" width="132" height="132" />
									</div>
									<div class="text-center mt-4">
							<h1 class="h2">Registro</h1>
						</div>
						<div>
							<div class="card-body">
								<div class="m-sm-4">
									<form>
										<div class="row">
											<input class="form-control form-control-lg" type="hidden" name="valor" value="<?php if(isset($_GET["valor"])){echo $_GET["valor"];} ?>" />
											<input class="form-control form-control-lg" type="hidden" name="pagaduria" value="<?php if(isset($_GET["pagaduria"])){echo $_GET["pagaduria"];} ?>" />
											<div class="mb-3 col-12">
												<input class="form-control form-control-lg" type="text" name="name" placeholder="Número de identificación (cédula colombiana)" />
											</div>
											<div class="mb-3 col-12 col-md-6">
												<input class="form-control form-control-lg" type="text" name="company" placeholder="Primer nombre" />
											</div>
											<div class="mb-3 col-12 col-md-6">
												<input class="form-control form-control-lg" type="email" name="email" placeholder="Primer apellido" />
											</div>
											<div class="mb-3 col-12 col-md-6">
												<input class="form-control form-control-lg" type="password" name="password" placeholder="Email" />
											</div>
											<div class="mb-3 col-12 col-md-6">
												<input class="form-control form-control-lg" type="password" name="password" placeholder="N° Celular" />
											</div>
											<div class="mb-3 col-12 col-md-6">
												<input class="form-control form-control-lg" type="password" name="password" placeholder="Contraseña" />
											</div>
											<div class="mb-3 col-12 col-md-6">
												<input class="form-control form-control-lg" type="password" name="password" placeholder="Repetir contraseña" />
											</div>
											<div class="text-center mt-3">
												<!-- <a href="index.html" class="btn btn-lg btn-primary">Sign up</a> -->
												<button type="submit" class="btn btn-lg btn-success">Registrarse</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main></div>
	

	<script src="js/app.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

<?php

if($_POST){
	require("conexion.php");
	$u = $_POST["email"];
	$p = $_POST["password"];
	// $conexion -> setAtribute(PDO::ATTR_ERRMODE, PDO::ERRRMODE_EXCEPTION);
	$query = $conexion ->prepare("SELECT * FROM Users WHERE USRIdentificationNumber = :u AND USRPassword = :p");
	$query->bindParam(":u", $u);
	$query->bindParam(":p", $p);
	$query->execute();
	$usuario = $query->fetch(PDO::FETCH_ASSOC);
	if($usuario){
		$_SESSION["usuario"] = $usuario["USRFirstName"];
		header("location:home.php");
	}else{
		echo "Credenciales incorrectas";
	}
}

?>

</html>

<?php
}	
?>