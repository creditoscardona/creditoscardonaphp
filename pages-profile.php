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
</head>

<body>
    <div class="wrapper">
        <?php include("sidebar.php"); ?>
        <div class="main">
            <?php include("navbar.php"); ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="mb-3">
                        <h1 class="h3 d-inline align-middle">Perfil</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Detalles de Perfil</h5>
                                </div>
                                <div class="card-body text-center">
                                    <img src="<?php echo $_SESSION["urlPhoto"]; ?>"
                                        alt="<?php echo $_SESSION["usuario"]; ?>" class="img-fluid rounded-circle mb-2"
                                        width="128" height="128" />
                                    <h5 class="card-title mb-0"><?php echo $_SESSION["usuario"]; ?></h5>
                                    <div class="text-muted mb-2">
                                        <?php
											switch ($_SESSION["rolId"]) {
												case 1:
													# code...
													echo "Administrador";
													break;
												case 2:
													echo "Asesor";
													# code...
													break;												
												case 3:
													echo "Cliente";
													# code...
													break;														
												default:
													# code...
													break;
											}
										?>
                                    </div>
                                    <br>
                                    <br>

                                    <form method="POST" action="actualizarimagen.php" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input class="form-control form-control-sm" type="file"
                                                name="profile_picture" required /><br>
                                            <button type="submit" class="btn btn-success">Actualizar imagen</button>
                                        </div>
                                    </form>


                                </div>

                            </div>
                        </div>

                        <?php
							require("conexion.php");
							// $_SESSION["cedula"];
							$query2 = $conexion ->prepare("SELECT * FROM Users WHERE USRIdentificationNumber = :u");
							$query2->bindParam(":u", $_SESSION["cedula"]);
							$query2->execute();
							$usuario = $query2->fetch(PDO::FETCH_ASSOC);
							if($usuario){}
						?>

                        <div class="col-md-8 col-xl-9">
                            <div class="card">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Actualizar Datos</h5>
                                </div>
                                <div class="card-body h-100">
                                    <form action="update-profile.php" method="POST">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <h6>Número de Identificación:</h6>
                                                    <input type="text" name="cedula" id="cedula" class="form-control"
                                                        placeholder="Cedúla de ciudadania" readonly
                                                        value="<?php echo $usuario["USRIdentificationNumber"] ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <h6>Primer Nombre:</h6>
                                                    <input type="text" name="pname" id="pname" class="form-control"
                                                        placeholder="Primer nombre"
                                                        value="<?php echo $usuario["USRFirstName"] ?>">
                                                </div>
                                            </div>
                                            <!-- <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <h6>Segundo Nombre:</h6>
                                                    <input type="text" name="sname" id="sname" class="form-control"
                                                        placeholder="Segundo nombre">
                                                </div>
                                            </div> -->
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <h6>Primer Apellido:</h6>
                                                    <input type="text" name="papel" id="papel" class="form-control"
                                                        placeholder="Primer apellido"
                                                        value="<?php echo $usuario["USRFirstSurname"] ?>">
                                                </div>
                                            </div>
                                            <!-- <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <h6>Segundo Apellido:</h6>
                                                    <input type="text" name="sapel" id="sapel" class="form-control"
                                                        placeholder="Segundo apellido">
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <h6>Ubicacion del Cliente:</h6>
                                                    <select class="form-select mb-3">
                                                        <?php 
													// require("conexion.php");
													// $query = $conexion ->prepare("SELECT * FROM Departments");
													// $query->execute();
													// $data = $query->fetchAll();
													// foreach ($data as $valores):
													// echo '<option value="'.$valores["DEPid"].'">'.$valores["DEPName"].'</option>';
													// endforeach;
													?>
                                                    </select>
                                                </div>
                                            </div> -->
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <h6>Ubicación del cliente:</h6>
                                                    <select class="form-select mb-3" name="ciudad" id="ciudad">
                                                        <?php 
													require("conexion.php");
													$query = $conexion ->prepare("SELECT * FROM Cities  ORDER BY CITName ASC");
													$query->execute();
													$data = $query->fetchAll();
													foreach ($data as $valores):
													?>
                                                        <option value="<?php echo $valores["CITid"]; ?>"
                                                            <?php if($valores["CITid"] === $usuario["ubicacionC"]){echo 'selected'; }?>>
                                                            <?php echo $valores["CITName"]; ?></option>
                                                        <?php
													endforeach;
													?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <h6>Email:</h6>
                                                    <input type="text" name="email" id="email" class="form-control"
                                                        placeholder="Fecha de Expedición"
                                                        value="<?php echo $usuario["USREmail"] ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <h6>Número de Celular:</h6>
                                                    <input type="text" name="cellphone" id="cellphone"
                                                        class="form-control" placeholder="Fecha de Expedición"
                                                        value="<?php echo $usuario["USRCellphone"] ?>">
                                                </div>
                                            </div>


                                            <div class="col-12 mb-3 mt-2">
                                                <div class="card-body text-center"><button type="submit"
                                                        class="btn btn-success btn-lg">Guardar</button></div>
                                            </div>
                                        </div>
                                    </form>

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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