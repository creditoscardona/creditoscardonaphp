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
    <style>
    .swal2-loader {
        border-color: #fff transparent #fff transparent !important;
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

                    <div class="row">
                        <div class="col-8"><h1 class="h3 d-inline align-middle">Usuarios</h1></div>
                        <div class="col-4"><a href="descargarusuarios.php" class="btn btn-secondary mb-5">Descargar usuarios</a></div>
                    </div>

                    <div class="row">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Cedula</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Tipo Usuario (Rol)</th>
                                    <th scope="col">Actualizado el</th>
                                    <th scope="col">Editar Rol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 	
                                    require("conexion.php");
                                    $query = $conexion ->prepare("SELECT USRid,USRIdentificationNumber,USRFirstName,USRFirstSurname,ROLid,USRUpdated
                                    FROM Users");
                                    $query->execute();
                                    $data = $query->fetchAll();
                                    foreach ($data as $valores): 
                                ?>
                                <tr>
                                    <!-- <tr
                                    onclick="window.location='clientes.php?cedula=<?php //echo $valores["CedulaCliente"]; ?>';"> -->
                                    <td><?php echo $valores["USRIdentificationNumber"]; ?></td>
                                    <td><?php echo $valores["USRFirstName"]; ?> <?php echo $valores["USRFirstSurname"]; ?>
                                    </td>
                                    <td><?php switch ($valores["ROLid"]){
                                    case 1:
                                        echo "Administrador";
                                        break;
                                    case 2:
                                        echo "Asesor comercial";
                                        break;
                                    case 3:
                                        echo "Usuario";
                                        break;
                                } ?></td>
                                    <td><?php echo $valores["USRUpdated"]; ?></td>
                                    <td><a href="javascript:editClient(<?php echo $valores["USRid"]; ?>, '<?php echo $valores["USRFirstName"]; ?> <?php echo $valores["USRFirstSurname"]; ?>')"
                                            class="btn btn-secondary">Editar</a>
                                    </td>
                                </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">Cedula</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Tipo Usuario (Rol)</th>
                                    <th scope="col">Actualizado el</th>
                                    <th scope="col">Editar Rol</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

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

    async function editClient(id, name) {
        const {
            value: formValues
        } = await Swal.fire({
            title: 'Editar Rol de Usuario',
            html: '<p class=".text-primary">' + name + '<p>' +
                '<div class="mb-3">' +
                '<select class="form-select" aria-label="Rol de Usuario" id="rolUser">' +
                '<option selected value="0">Seleccione el rol</option>' +
                '<option value="1">Administrador</option>' +
                '<option value="2">Asesor comercial</option>' +
                '<option value="3">Usuario</option>' +
                '</select>' +
                '</div>',
            // +
            // '<div class="form-floating mb-3">'+
            //     '<input type="email" class="form-control" id="email" placeholder="info@empresa.com">'+
            //     '<label for="email">Email</label>'+
            // '</div>'+
            // '<div class="form-floating mb-3">'+
            //     '<input type="text" class="form-control" id="phone" placeholder="+57320000000">'+
            //     '<label for="phone">Teléfono (+57)</label>'+
            // '</div>'+
            // '<select class="form-select form-select-lg mb-3" id="city">'+
            //     '<option value="" selected>Seleccione una ciudad</option>'+
            //     '<option value="Cúcuta">Cúcuta</option>'+
            //     '<option value="Ibague">Neiva</option>'+
            // '</select>'+
            // '<div class="form-floating mb-3">'+
            //     '<input type="password" class="form-control" id="password" placeholder="*********">'+
            //     '<label for="password">Contraseña</label>'+
            // '</div>'+
            // '<div class="form-floating mb-3">'+
            //     '<input type="password" class="form-control" id="confirm-password" placeholder="*********">'+
            //     '<label for="confirm-password">Confirmar contraseña</label>'+
            // '</div>',
            focusConfirm: false,
            confirmButtonText: "Editar",
            confirmButtonColor: "#13804c",
            customClass: {
                title: 'title',
                htmlContainer: '',
                input: '',
                inputLabel: ''
            },
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            allowOutsideClick: false,
            preConfirm: () => {

                let rolU = document.getElementById('rolUser');
                // console.log(rolU.value)

                if (rolU.value == 0) {
                    Swal.showValidationMessage(
                        'Debe seleccionar un rol'
                    )
                } else {
                    return [
                        rolU.value,
                    ]
                }
            }
        })

        if (formValues) {

            Swal.fire({
                title: 'Cambiando rol de usuario',
                background: '#13804c',
                customClass: {
                    title: 'text-light',
                },
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            })

            let formData = new FormData();

            formData.append('rol', formValues[0]);
            formData.append('idUser', id);

            fetch('changeroluser.php', {
                    method: "POST",
                    body: formData
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        swal.fire({
                            icon: 'success',
                            title: "Edición Exitosa",
                            willClose: () => {
                                // companies.ajax.reload();
                                window.location.href = 'usuarios.php';
                            }
                        })
                    } else {
                        swal.fire({
                            icon: 'error',
                            title: "Fallo en la edición"
                        })
                    }
                })
        }
    }
    </script>

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