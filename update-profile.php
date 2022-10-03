<?php

session_start();
require("conexion.php");
$email = $_POST["email"];
$ciudad = $_POST["ciudad"];
$apellido = $_POST["papel"];
$nombre = $_POST["pname"];
$number = $_POST["cellphone"];
$cedula = $_SESSION['cedula'];

if(isset($number) && $number != NULL && $number != ""){
    $query = $conexion->prepare("UPDATE Users SET USRCellphone = :a, ubicacionC = :b, USRFirstName = :c, USREmail = :d, USRFirstSurname = :e WHERE USRIdentificationNumber = $cedula");
    $query->bindParam(":a", $number);
    $query->bindParam(":b", $ciudad);
    $query->bindParam(":c", $nombre);
    $query->bindParam(":d", $email);
    $query->bindParam(":e", $apellido);
    $query->execute();
    // $_SESSION["status_register"] = "OKSTATUS";
    header("location:pages-profile.php");
}


?>