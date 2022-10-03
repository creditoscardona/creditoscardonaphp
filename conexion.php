<?php

$conexion = null;
$serverName = "89.22.112.154\SQLEXPRESS";
$bd = "prod_creditoscardona";
$user = "creditoscardona_admin";
$pass = "PasswordCardona$$";

try {
    // new PDO("sqlsrv:server=$rutaServidor;database=$nombreBaseDeDatos", $usuario, $contraseña);
    $conexion = new PDO("sqlsrv:server=$serverName;database=$bd", $user, $pass);
}catch(PDOException $e){
    echo "Error de conexion!".$e;
    exit;
}

return $conexion;

