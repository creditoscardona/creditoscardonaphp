<?php 	

    $resultado = array();
    require("conexion.php");
    $mes = date("n");
    $anio = date("Y");
    $query = $conexion ->prepare("SELECT fp.USRIdentificationNumberManager 'CedulaAsesor', usr.USRFirstName 'NombreAsesor', usr.USRFirstSurname 'ApellidoAsesor',
        fp.USRIdentificationNumberApplicant 'CedulaCliente', us.USRFirstName 'NombreCliente',
        us.USRFirstSurname 'ApellidoCliente', us.Pagaduria, fp.Monto, fp.Refinanciacion, fp.saldoCarteraR,
        fp.idBeneficio, us.comentStatus, us.status, us.USRUpdated
        FROM FormPagadurias fp
        INNER JOIN Users us
        ON fp.USRIdentificationNumberApplicant = us.USRIdentificationNumber
        INNER JOIN Users usr
        ON fp.USRIdentificationNumberManager = usr.USRIdentificationNumber
        WHERE MONTH(Updated) = $mes AND YEAR(Updated) = $anio ORDER BY Updated DESC");
    $query->execute();
    $data = $query->fetchAll();
    foreach ($data as $valores):
        $pagaduria = "";
        $estad = "";
        $refi = "";
        $bene = "";
        switch ($valores["Pagaduria"]) {
            case 1:
                $pagaduria = "Soldado profesional";
                break;
            case 2:
                $pagaduria = "Respetando SMLMV Soldado Profesional";
                break;
            case 3:
                $pagaduria = "Oficiales y suboficiales del Ejército";
                break;
            case 4:
                $pagaduria = "Infante de Marina";
                break;
            case 5:
                $pagaduria = "Oficiales y suboficiales de la Armada";
                break;
            case 6:
                $pagaduria = "Respetando SMLMV Infante de Marina";
                break;
            case 7:
                $pagaduria = "CREMIL";
                break;
            case 8:
                $pagaduria = "MINDEFENSA";
                break;
            case 9:
                $pagaduria = "Respetando SMLMV MINDEFENSA";
                break;
            case 10:
                $pagaduria = "Fuerza Aérea";
                break;
            case 11:
                $pagaduria = "Policía Nacional";
                break;
            case 12:
                $pagaduria = "CASUR";
                break;
            case 13:
                $pagaduria = "TEGEN";
                break;
            case 14:
                $pagaduria = "CAGEN";
                break;
            case 15:
                $pagaduria = "COLPENSIONES";
                break;
            case 16:
                $pagaduria = "FOPEP";
                break;
            case 17:
                $pagaduria = "Fiduprevisora";
                break;
            case 18:
                $pagaduria = "Ecopetrol";
                break;
            case 19:
                $pagaduria = "Porvenir";
                break;
            case 20:
                $pagaduria = "Protección";
                break;
            case 21:
                $pagaduria = "Sura";
                break;
            case 22:
                $pagaduria = "Seguros Alfa";
                break;
            case 23:
                $pagaduria = "Seguros Bolivar";
                break;
            
        }
        switch ($valores["status"]) {
            case 3:
                $estad = "Estudio de crédito (capacidad)";
                break;
            case 4:
                $estad = "Perfilado";
                break;
            case 5:
                $estad = "Transito";
                break;
            case 6:
                $estad = "Radicado";
                break;
            case 7:
                $estad = "Pago de cartera";
                break;
            case 8:
                $estad = "Solicitud de paz y salvo";
                break;
            case 9:
                $estad = "Desembolsado";
                break;
            case 10:
                $estad = "Devolución";
                break;
            case 11:
                $estad = "Rechazado (entidad)";
                break;
            case 12:
                $estad = "Negado (cliente)";
                break;
            case 22:
                $estad = "Sin Capacidad";
                break;
            case 23:
                $estad = "Aprobado";
                break;
            case 24:
                $estad = "En Analisis";
                break;
            case 25:
                $estad = "Recibido Cargue Documentos";
                break;                                                    
        }
        if($valores["Refinanciacion"]!=""){$refi = "REFINANCIACION DEBE ".$valores["Refinanciacion"];}else{$refi = "NUEVO";}
        if($valores["idBeneficio"]!=1){$bene = "APLICA POLIZA";}
        $resultado[] =
            `<tr
                onclick="window.location='clientes.php?cedula=`.$valores["CedulaCliente"].`>
                <td>`.$valores["CedulaAsesor"].`</td>
                <td>`.$valores["NombreAsesor"].` `.$valores["ApellidoAsesor"].`</td>
                <td>`.$valores["CedulaCliente"].`</td>
                <td>`.$valores["NombreCliente"]." ".$valores["ApellidoCliente"].`</td>
                <td>`.$pagaduria.`</td>
                <td>$`.$valores["Monto"].`</td>
                <td>`.$refi.` - `.$bene.`</td>
                <td>`.$valores["comentStatus"].`</td>
                <td>`.$estad.`</td>
                <td>`.$valores["USRUpdated"].`</td>
            </tr>`;

    endforeach;

    
    echo json_encode($resultado);
?>