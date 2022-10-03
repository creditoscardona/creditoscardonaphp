<?php
require("conexion.php");
if(isset($_GET["anio"]) && isset($_GET["mes"])){
    $anio = $_GET["anio"];
    $mes = $_GET["mes"];
}else{
    $anio = date("Y");
    $mes = date("n");
}

$query = $conexion ->prepare("SELECT fp.USRIdentificationNumberManager 'CedulaAsesor', usr.USRFirstName 'NombreAsesor', usr.USRFirstSurname 'ApellidoAsesor',
fp.USRIdentificationNumberApplicant 'CedulaCliente', us.USRFirstName 'NombreCliente',
us.USRFirstSurname 'ApellidoCliente', P.nombrePagaduria, fp.Monto, fp.Refinanciacion, fp.saldoCarteraR,
fp.idBeneficio, us.comentStatus, RS.RESName, us.USRUpdated
FROM FormPagadurias fp
INNER JOIN Users us
ON fp.USRIdentificationNumberApplicant = us.USRIdentificationNumber
INNER JOIN Users usr
ON fp.USRIdentificationNumberManager = usr.USRIdentificationNumber
INNER JOIN Pagadurias as P ON
us.Pagaduria = P.idPagaduria
INNER JOIN RequestStatus as RS ON
us.status = RS.RESid
WHERE MONTH(Updated) = $mes AND YEAR(Updated) = $anio ORDER BY Updated DESC");
$query->execute();
$data = $query->fetchAll();

echo json_encode($data);

?>