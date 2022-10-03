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

	<title>Creditos Cardona</title>

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
							<h1 class="h2">Registrarse</h1>
						</div>

						<div>
							<div class="card-body">
								<div class="m-sm-4">									
									<form action="register.php" method="POST">
										<div class="row">
											<div class="col-12 col-md-6 mb-3">
											<input class="form-control form-control-lg" type="number" name="cedula" placeholder="Número de identifcación" required />
											</div>
											<div class="col-12 col-md-6 mb-3">
											<input class="form-control form-control-lg" type="text" name="name" placeholder="Primer nombre" required />
											</div>
											<div class="col-12 col-md-6 mb-3">
											<input class="form-control form-control-lg" type="text" name="lastname" placeholder="Primer apellido" required />
											</div>
											<div class="col-12 col-md-6 mb-3">
											<input class="form-control form-control-lg" type="email" name="mail" placeholder="Email" required />
											</div>
											<div class="col-12 col-md-6 mb-3">
											<input class="form-control form-control-lg" type="number" name="phone" placeholder="Número de celular" required />
											</div>
											<div class="col-12 col-md-6 mb-3">
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Contraseña" required />
											</div>											
										</div>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
											<label class="form-check-label" for="flexCheckDefault">
												Acepto <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">terminos y condiciones. </a> 
											</label>
										</div>
										<div class="text-center mt-3">
											<input type="submit" class="btn btn-lg btn-success" value="Registrarse">
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
										</div>
									</form>
								</div>
								<div class="row">
									<div class="col-12 text-center">
										<label class="form-check-label" for="flexCheckDefault">
												Tienes cuenta? <a href="index.php">Ingresa. </a> 
										</label>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Terminos y Condiciones</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
		El atraso en el pago genera intereses de mora, gastos de cobranza y reporte en las centrales de riesgo.<br><br>

		CREDITOS CARDONA NUNCA comparte información de clientes con terceras personas o cobra comisiones 
		o gastos por anticipado.Usamos asesores financieros para diligenciar, estudiar o agilizar tu solicitud 
		o desembolsar y procesar tu crédito.NO se deje engañar y comuníquese con nosotros para reportar cualquier 
		oferta que reciba en este sentido al correo electrónico soporte@creditoscardona.com <br><br>

		En armonía con lo preceptuado en la Ley 1581 de 2012, sobre régimen general de protección de datos personales,
		 y su Decreto Reglamentario 1377 de 2013, los usuarios autorizan a CREDITOS CARDONA, para que reúna la 
		 información solicitada dentro del proceso de solicitud de cupo y para que investigue sus antecedentes en los 
		 bancos de datos legalmente establecidos en Colombia, y los guarde para uso exclusivo de los servicios ofrecidos.<br><br>

		Como titular de los datos personales, podre ejercer mis derechos a conocer, actualizar, rectificar y suprimir mi
		 información personal, así como, el derecho de revocar el consentimiento otorgado para el tratamiento de mis 
		 datos personales; autorizar o no el tratamiento de datos personales. (Ejemplo: huella dactilar, imagen y otros 
		 datos biométricos) y contestar voluntariamente las preguntas que versen sobre mis datos personales sensibles,
		  Los canales dispuestos por Créditos Cardona, para la atención de solicitudes son: las líneas de atención al 
		  cliente: Celular 3187848470 página web www.creditoscardona.com o el anteriormente mencionado correo 
		  electrónico soporte@creditoscardona.com.
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
		</div>
		</div>
	</div>
	</div>

	<script src="js/app.js"></script>

</body>

<?php

if($_POST){
	session_start();
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