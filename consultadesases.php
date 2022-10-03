<?php
require("conexion.php");
if(isset($_POST["anio"]) && isset($_POST["mes"])){
    $anio = $_POST["anio"];
    $mes = $_POST["mes"];
}else{
    $anio = date("Y");
    $mes = date("n");
}
$resp = array();
$query17 = $conexion ->prepare("SELECT Us.USRFirstName, Us.USRFirstSurname,  SUM( CAST(replace(Monto, '.', '') AS INT) - CAST(replace(P.Refinanciacion, '.', '') AS INT) ) ValueTotal FROM FormPagadurias AS P
INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
INNER JOIN Users AS Us ON P.USRIdentificationNumberManager = Us.USRIdentificationNumber
WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio  
GROUP BY Us.USRFirstName, Us.USRFirstSurname");
$query17->execute();
$data17 = $query17->fetchAll();
foreach ($data17 as $valores17):
$resp[]='
<tr>
    <td>'.$valores17["USRFirstName"].' '.$valores17["USRFirstSurname"].'
    </td>
    <td class="text-end">'.number_format($valores17["ValueTotal"], 0, ",", ".").'
    </td>
</tr>
';
endforeach;

echo json_encode($resp)

?>