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
                                <!-- <th>Age</th>
                <th>Start date</th>
                <th>Salary</th> -->
                            </tr>
                        </thead>
                        <tbody id="bodyseguimiento">                            
                        </tbody>
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
                                <!-- <th>Age</th>
                <th>Start date</th>
                <th>Salary</th> -->
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

    <script>
    $(document).ready(function() {
        $('#example').DataTable({
			ajax: {
				url: 'searchfollowas.php',
				dataSrc: ''
			},
    		// columns: [ ... ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por pagina",
                "zeroRecords": "Lo sentimos, no se encuentra ningun resultado",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Ninguna información dispónible",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "loadingRecords": "Cargando información...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primera",
                    "last": "Ultima",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
    </script>

	<!-- <script>
		window.addEventListener('DOMContentLoaded', (event) => {
				fetch("searchfollowas.php")
				.then(function(res){ return res.json(); })
    			.then(function(data){  console.log(json)})
				.catch(err => console.log(err));
				// .then()
				// .catch()
		});
	</script> -->

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