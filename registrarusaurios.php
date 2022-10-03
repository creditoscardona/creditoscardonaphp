<?php
session_start();
require("conexion.php");
$hoy = date("Y-m-d H:i:s.v");
$genero = -1;
$tipo_documento = 1;
$rol = 3;
$estonose = 1;
$pagaduria = 1;
$urlFoto = "https://plataforma.creditoscardona.com/ProfilePhotos/default.jpg";
$status = 3;
if($_POST["cedula"] && $_POST["name"] 
&& $_POST["lastname"] && $_POST["phone"] 
&& $_POST["mail"] && $_POST["password"]){

    if($_POST["cedula"] !== null && $_POST["name"] !== null 
&& $_POST["lastname"] !== null && $_POST["phone"] !== null
&& $_POST["mail"] !== null && $_POST["password"] !== null){

    $query = $conexion ->prepare("INSERT INTO Users (USRPassword,
    USRFirstName,
    USRFirstSurname,
    USREmail,
    USRCellphone,
    USRIdGender,
    USRDocumentType,
    USRIdentificationNumber,
    ROLid,
    USRCreated,
    USRUpdated,
    ACTid,
    USRCreatedBy,
    USRUpdatedBy,
    urlPhoto) VALUES (:o,:p,:q,:r,:s,:t,:u,:j,:k,:l,:m,:n,:c,:d,:a)");
    $query->bindParam(":o", $_POST["password"]);
    $query->bindParam(":p", $_POST["name"]);
    $query->bindParam(":q", $_POST["lastname"]);
    $query->bindParam(":r", $_POST["mail"]);
    $query->bindParam(":s", $_POST["phone"]);
    $query->bindParam(":t", $genero);
    $query->bindParam(":u", $tipo_documento);
    $query->bindParam(":j", $_POST["cedula"]);
    $query->bindParam(":k", $rol);
    $query->bindParam(":l", $hoy);
    $query->bindParam(":m", $hoy);
    $query->bindParam(":n", $estonose);
    $query->bindParam(":c", $_SESSION["id"]);
    $query->bindParam(":d", $_SESSION["id"]);
    $query->bindParam(":a", $urlFoto);
    $query->execute();  
    $query2 = $conexion ->prepare("INSERT INTO Userinfo (USRIdentificationNumber, USICreado, USIActualizado) VALUES (:v,:w,:x)");
    $query2->bindParam(":v", $_POST["cedula"]);
    $query2->bindParam(":w", $hoy);
    $query2->bindParam(":x", $hoy);
    $query2->execute();
    $_SESSION["status_register"] = "OK";
    header("location:clientes.php");    
}else{
    $_SESSION["status_register"] = "EMPTY";
    header("location:clientes.php");
}

}else{
    $_SESSION["status_register"] = "ERROR";
    header("location:clientes.php");
}
?>