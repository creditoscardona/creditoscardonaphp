<?php

$idUser = $_POST["idUser"];
$rol = $_POST["rol"];

require("conexion.php");
$query = $conexion ->prepare("UPDATE Users
SET ROLid = $rol
WHERE USRid = $idUser");
$query->execute();

$arr = array('success' => true, 'message' => 'Rol cambiado con exito');

echo json_encode($arr);

?>