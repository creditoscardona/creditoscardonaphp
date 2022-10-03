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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	
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
							<h1 class="h2">Inicio de sesión</h1>
						</div>

						<div>
							<div class="card-body">
								<div class="m-sm-4">
									
									<form action="index.php" method="POST">
										<div class="mb-3">
											<!-- <label class="form-label">Email</label> -->
											<input class="form-control form-control-lg" type="number" name="email" placeholder="Número de identifcación" required />
										</div>
										<div class="mb-3">
											<!-- <label class="form-label">Password</label> -->
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Contraseña" required />
											<small>
            <!-- <a href="index.html">Forgot password?</a> -->
          </small>
										</div>
										<div>
											<!-- <label class="form-check">
            <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
            <span class="form-check-label">
              Remember me next time
            </span>
          </label> -->
										</div>
										<div class="text-center mt-3">
											<input type="submit" class="btn btn-lg btn-success" value="Ingresar">
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
										</div>
									</form>
								</div>
							</div>
							<div class="row">
									<div class="col-12 text-center">								
										<label class="form-check-label" for="flexCheckDefault">
												No tienes cuenta? <a href="register.php">Crea una. </a> 
										</label>
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
		$_SESSION["usuario"] = $usuario["USRFirstName"]." ".$usuario["USRFirstSurname"];
		$_SESSION["urlPhoto"] = $usuario["urlPhoto"];
		$_SESSION["rolId"] = $usuario["ROLid"];
		$_SESSION["cedula"] = $usuario["USRIdentificationNumber"];
		$_SESSION["id"] = $usuario["USRid"];
		$_SESSION["blockmenu"] = 0;
		$_SESSION["idEstado"] = $usuario["status"];
		header("location:home.php");
	}else{
		echo	'<script type="text/javascript">
						Swal.fire({
							title: "Error",
							text: "Credenciales incorrectas",
							icon: "error",
							confirmButtonColor: "#2BB454",
							confirmButtonText: "Intentar de nuevo"
						})
					</script>';
	}
}

?>

</html>

<?php
}	
?>