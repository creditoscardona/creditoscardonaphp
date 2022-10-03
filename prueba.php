<?php 

require("conexion.php");
$anio = date("Y");
$mes = date("n");
$query = $conexion ->prepare("SELECT Us.USRIdentificationNumber, RESName as ESTADO, COUNT(USRIdentificationNumberManager) AS TOTAL FROM FormPagadurias AS P
INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
INNER JOIN Users AS Us ON P.USRIdentificationNumberManager = Us.USRIdentificationNumber
INNER JOIN RequestStatus AS C ON U.status = C.RESid
WHERE MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY Us.USRIdentificationNumber, RESName");
$query->execute();
$busqueda = $query->fetchAll();

$query2 = $conexion ->prepare("SELECT USRIdentificationNumber, USRFirstName, USRFirstSurname
FROM Users
WHERE ROLid BETWEEN 1 AND 2");
$query2->execute();
$asesores = $query2->fetchAll();

$resultado = array();
foreach($busqueda as $busq){
    $resultado[] = $busq[1];
}

$new_array=array();
foreach ($resultado as $valor){
   if (!in_array($valor,$new_array)){
      $new_array[]=$valor;
   }
}

$bryan = array();
for($j=0;$j<count($asesores);$j++){
    $bryan2 = array();
    
    for($i=0;$i<count($new_array);$i++){    
        $busqeda = array('USRIdentificationNumber'=>$asesores[$j][0], 'ESTADO'=>$new_array[$i]);
        $val = search($busqueda, $busqeda);
        if(count($val)>0){
            $setval = $val[0][2];
        }else{
            $setval = 0;
        }
        $bryan2[] = $setval;
    }    

    $bryan[]= $bryan2;
}

function search($array, $search_list) {   
    $result = array(); 
    // Iterate over each array element
    foreach ($array as $key => $value) {  
        // Iterate over each search condition
        foreach ($search_list as $k => $v) {      
            // If the array element does not meet
            // the search condition then continue
            // to the next element
            if (!isset($value[$k]) || $value[$k] != $v)
            {                  
                // return 0;
                continue 2;
            }            
        }      
        $result[] = $value;
    }  

    return $result;

}

echo json_encode($bryan)
// echo "<pre>";
// var_dump($bryan);
// echo "</pre>";

?>