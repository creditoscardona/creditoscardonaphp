<?php
session_start();
require("conexion.php");
$directorio = 'Uploads/Desprendibles/';
$fechaActual = date("dmYhis");
$hoy = date("Y-m-d H:i:s.v");
$num = 1;
// strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$file_ext1=strtolower(pathinfo($_FILES['desprendible_ultimo']['name'], PATHINFO_EXTENSION));
$file_ext2=strtolower(pathinfo($_FILES['desprendible_penultimo']['name'], PATHINFO_EXTENSION));
if($_FILES['c-th-cl']['name'] != null){
  $file_ext3=strtolower(pathinfo($_FILES['c-th-cl']['name'], PATHINFO_EXTENSION));
}

$subir_archivo = $directorio.$_SESSION["cedula"]."_".$fechaActual."_Ultimo-Mes.".$file_ext1;
$subir_archivo1 = $directorio.$_SESSION["cedula"]."_".$fechaActual."_Penultimo-Mes.".$file_ext2;
$n_archivo = $_SESSION["cedula"]."_".$fechaActual."_Ultimo-Mes.".$file_ext1;
$n_archivo1 = $_SESSION["cedula"]."_".$fechaActual."_Penultimo-Mes.".$file_ext2;
if($_FILES['c-th-cl']['name'] != null){
$subir_archivo2 = $directorio.$_SESSION["cedula"]."_".$fechaActual."_Certificado_(Tiempo-haberes_o_Laboral).".$file_ext3;
$tamano3 = $_FILES["c-th-cl"]["size"];
$n_archivo2 = $_SESSION["cedula"]."_".$fechaActual."_Certificado_(Tiempo-haberes_o_Laboral).".$file_ext2;
}

$desprendible = $_FILES["desprendible_ultimo"]['name'];
$desprendible2 = $_FILES["desprendible_penultimo"]['name'];

$tamano1 = $_FILES["desprendible_ultimo"]["size"];
$tamano2 = $_FILES["desprendible_penultimo"]["size"];



if($tamano1 < 52428800 && $tamano2 < 52428800){
  if($desprendible != null && $desprendible2 != null){
    if($_FILES['c-th-cl']['name'] != null){
        if (move_uploaded_file($_FILES['desprendible_ultimo']['tmp_name'], $subir_archivo) &&
              move_uploaded_file($_FILES['desprendible_penultimo']['tmp_name'], $subir_archivo1)
              && move_uploaded_file($_FILES['c-th-cl']['tmp_name'], $subir_archivo2)) {
                    $query = $conexion ->prepare("INSERT INTO DetachableDocuments VALUES (:o,:p,:q,:r,:s,:t,:u)");
                    $query->bindParam(":o", $n_archivo);
                    $query->bindParam(":p", $_SESSION["id"]);
                    $query->bindParam(":q", $hoy);
                    $query->bindParam(":r", $hoy);
                    $query->bindParam(":s", $_SESSION["id"]);
                    $query->bindParam(":t", $_SESSION["id"]);
                    $query->bindParam(":u", $num);
                    $query->execute();  
                    $query2 = $conexion ->prepare("INSERT INTO DetachableDocuments VALUES (:o,:p,:q,:r,:s,:t,:u)");
                    $query2->bindParam(":o", $n_archivo1);
                    $query2->bindParam(":p", $_SESSION["id"]);
                    $query2->bindParam(":q", $hoy);
                    $query2->bindParam(":r", $hoy);
                    $query2->bindParam(":s", $_SESSION["id"]);
                    $query2->bindParam(":t", $_SESSION["id"]);
                    $query2->bindParam(":u", $num);
                    $query2->execute(); 
                    $query3 = $conexion ->prepare("INSERT INTO DetachableDocuments VALUES (:o,:p,:q,:r,:s,:t,:u)");
                    $query3->bindParam(":o", $n_archivo2);
                    $query3->bindParam(":p", $_SESSION["id"]);
                    $query3->bindParam(":q", $hoy);
                    $query3->bindParam(":r", $hoy);
                    $query3->bindParam(":s", $_SESSION["id"]);
                    $query3->bindParam(":t", $_SESSION["id"]);
                    $query3->bindParam(":u", $num);
                    $query3->execute();          
                    $_SESSION["status_desprendible"] = "OK";
                    header("location:desprendibles.php");              
        }else{
            $_SESSION["status_desprendible"] = "FAIL";
            header("location:desprendibles.php");
        }
    } else {
          if (move_uploaded_file($_FILES['desprendible_ultimo']['tmp_name'], $subir_archivo) &&
          move_uploaded_file($_FILES['desprendible_penultimo']['tmp_name'], $subir_archivo1)) {
                $query = $conexion ->prepare("INSERT INTO DetachableDocuments VALUES (:o,:p,:q,:r,:s,:t,:u)");
                $query->bindParam(":o", $n_archivo);
                $query->bindParam(":p", $_SESSION["id"]);
                $query->bindParam(":q", $hoy);
                $query->bindParam(":r", $hoy);
                $query->bindParam(":s", $_SESSION["id"]);
                $query->bindParam(":t", $_SESSION["id"]);
                $query->bindParam(":u", $num);
                $query->execute();  
                $query2 = $conexion ->prepare("INSERT INTO DetachableDocuments VALUES (:o,:p,:q,:r,:s,:t,:u)");
                $query2->bindParam(":o", $n_archivo1);
                $query2->bindParam(":p", $_SESSION["id"]);
                $query2->bindParam(":q", $hoy);
                $query2->bindParam(":r", $hoy);
                $query2->bindParam(":s", $_SESSION["id"]);
                $query2->bindParam(":t", $_SESSION["id"]);
                $query2->bindParam(":u", $num);
                $query2->execute();
                $_SESSION["status_desprendible"] = "OK";
                header("location:desprendibles.php");              
            }else{
                $_SESSION["status_desprendible"] = "FAIL";
                header("location:desprendibles.php");
            }
      }

  }else{  
    $_SESSION["status_desprendible"] = "EMPTY";
    header("location:desprendibles.php");
  }
}else{
  $_SESSION["status_desprendible"] = "MAXSIZE";
  header("location:desprendibles.php");
}
?>