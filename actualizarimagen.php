<?php
session_start();
require("conexion.php");
$directorio = 'ProfilePhotos/';
$fechaActual = date("dmYhis");
$hoy = date("Y-m-d H:i:s.v");
$num = 1;
// strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$file_ext1=strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));
$subir_archivo = $directorio.$_SESSION["cedula"]."_".$fechaActual."_".$_FILES["profile_picture"]['name'];
$n_archivo = "https://plataforma.creditoscardona.com/ProfilePhotos/".$_SESSION["cedula"]."_".$fechaActual."_".$_FILES["profile_picture"]['name'];

$desprendible = $_FILES["profile_picture"]['name'];
$tamano1 = $_FILES["profile_picture"]["size"];

if($tamano1 < 52428800){
  if($desprendible != null){    
          if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $subir_archivo)) {
                $query = $conexion ->prepare("UPDATE Users SET urlPhoto = :o WHERE USRid = :p");
                $query->bindParam(":o", $n_archivo);
                $query->bindParam(":p", $_SESSION["id"]);
                $query->execute();  
                $_SESSION["status_profile"] = "OK";
                header("location:pages-profile.php");   
                $_SESSION["urlPhoto"] = $n_archivo;           
            }else{
                $_SESSION["status_profile"] = "FAIL";
                header("location:pages-profile.php");
            }
      

  }else{  
    $_SESSION["status_profile"] = "EMPTY";
    header("location:pages-profile.php");
  }
}else{
  $_SESSION["status_profile"] = "MAXSIZE";
  header("location:pages-profile.php");
}
?>