<?php
require("conexion.php");
if(isset($_POST["anio"]) && isset($_POST["mes"])){
    $anio = $_POST["anio"];
    $mes = $_POST["mes"];
}else{
    $anio = date("Y");
    $mes = date("n");
}

$tipo_consulta = $_POST["query"];

// echo $tipo_consulta;

switch ($tipo_consulta) {
    case 'desembolsostotales':
        # code...
        $resp = array();
        $query = $conexion ->prepare("SELECT SUM(CAST (replace(Monto, '.', '') AS INT)) ValueTotal
        FROM FormPagadurias AS P
        INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
        WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio");
        $query->execute();
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        $desembolsostotales = number_format($usuario["ValueTotal"], 0, ",", ".");
        $resp[] = $desembolsostotales; 
        echo json_encode($resp);
        break;
    case 'desembolsosrefinanciados':
        # code...
        $resp = array();
        $query = $conexion ->prepare("SELECT SUM(CAST (replace(Refinanciacion, '.', '') AS INT)) ValueTotal
        FROM FormPagadurias AS P
        INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
        WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio AND P.Refinanciacion <> ''");
        $query->execute();
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        $desembolsostotales = number_format($usuario["ValueTotal"], 0, ",", ".");
        $resp[] = $desembolsostotales; 
        echo json_encode($resp);
        break; 
    case 'desembolsosnuevos':
        # code...
        $resp = array();
        $query = $conexion ->prepare("SELECT SUM( CAST(replace(Monto, '.', '') AS INT) - CAST(replace(P.Refinanciacion, '.', '') AS INT) ) ValueTotal FROM FormPagadurias AS P
        INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
        WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio");
        $query->execute();
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        $desembolsostotales = number_format($usuario["ValueTotal"], 0, ",", ".");
        $resp[] = $desembolsostotales; 
        echo json_encode($resp);
        break;
    case 'totaldesembolsospormes':
        $resp = array();
        for ($i=0; $i < 12; $i++) { 
            # Los tres primeros meses el año entrante 2023 debe eliminarse solo quedaria el query...
            if($i == 0){
                $resp[] = 456442206;
            }else if($i == 1){
                $resp[] = 281683068;
            }else if($i == 2){
                $resp[] = 404512010;
            }else if($i == 3){
                $resp[] = 219495009;
            }
            else{
                $query = $conexion ->prepare("SELECT SUM(CAST (replace(Monto, '.', '') AS INT)) ValueTotal
                FROM FormPagadurias AS P
                INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
                WHERE U.status = 9 AND MONTH(Updated) = $i+1 AND YEAR(Updated) = $anio");
                $query->execute();
                $usuario = $query->fetch(PDO::FETCH_ASSOC);
                $value_month = $usuario["ValueTotal"];
                $ab = 0;
                if($value_month != NULL){$ab = $value_month;}
                $resp[] = $ab;
            }
        }
        echo json_encode($resp);
        break;
    case 'desembolsospagadurias':
            # code...
            $resp = array();
            $nomb_paga = array();
            $total_paga = array();
            $query = $conexion ->prepare("SELECT nombrePagaduria, COUNT(Pagaduria) AS TOTAL FROM FormPagadurias AS P
            INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
            INNER JOIN Pagadurias AS Pag ON U.Pagaduria = Pag.idPagaduria
            WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY nombrePagaduria");
            $query->execute();
            $data = $query->fetchAll();
            foreach ($data as $valores):
                $nomb_paga[] = $valores["nombrePagaduria"];
                $total_paga[] = $valores["TOTAL"];
            endforeach;
            if(sizeof($nomb_paga)>0){
                $resp[] = $nomb_paga; 
                $resp[] = $total_paga;
            }
            
            echo json_encode($resp);
            break;
    case 'desembolsosasesores':
        # code...
        $resp = array();
        $nomb_des_ases = array();
        $total_paga = array();
        $total_des_ases = array(); 
        $query = $conexion ->prepare("SELECT Us.USRFirstName, Us.USRFirstSurname,  SUM( CAST(replace(Monto, '.', '') AS INT) - CAST(replace(P.Refinanciacion, '.', '') AS INT) ) ValueTotal FROM FormPagadurias AS P
        INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
        INNER JOIN Users AS Us ON P.USRIdentificationNumberManager = Us.USRIdentificationNumber
        WHERE U.status = 9 AND MONTH(Updated) = $mes AND YEAR(Updated) = $anio  
        GROUP BY Us.USRFirstName, Us.USRFirstSurname");
        $query->execute();
        $data = $query->fetchAll();
        foreach ($data as $valores):
            $nomb_des_ases[] = $valores["USRFirstName"]." ".$valores["USRFirstSurname"];
            $total_des_ases[] = $valores["ValueTotal"];
        endforeach;
        if(sizeof($nomb_des_ases)>0){
            $resp[] = $nomb_des_ases; 
            $resp[] = $total_des_ases;
        }
        
        echo json_encode($resp);
        break;
    case 'ciudadesclientes':
        # code...
        $des_city = array();
        $query = $conexion ->prepare("SELECT city, lat, lng FROM FormPagadurias AS P
        INNER JOIN Users AS U ON P.USRIdentificationNumberApplicant = U.USRIdentificationNumber
        INNER JOIN Citys AS C ON U.ubicacionC = C.CITid
        WHERE MONTH(Updated) = $mes AND YEAR(Updated) = $anio GROUP BY city, lat, lng");
        $query->execute();
        $data = $query->fetchAll();
        foreach ($data as $valores):
            $latlon = array(floatval($valores["lat"]),floatval($valores["lng"]));
            $place = ['name' => $valores["city"], 'latLng' =>  $latlon];
            $obj = (object) $place;
            $des_city[] = $obj;
        endforeach;
        echo json_encode($des_city);
        break;
    default:
        # code...
        break;
}


?>