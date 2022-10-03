<?php
session_start();
$_SESSION["blockmenu"] = 0;
require("conexion.php");
$ciudadCliente = $_POST["cityclient"];
$reman = $_POST["remanente"];
$comisionasesor = $_POST["optioncomis"];
$saldocrecog = $_POST["saldocartera"];
$refi = $_POST["refi"];
$hoy = date("Y-m-d H:i:s.v");
$idPagaduria = $_POST["pagaduria"];
$idCaptacion = $_POST["estrategia"];
$idEstado = $_POST["status"];
$otrocaptacion = $_POST["otroinput"];
$idciudad = $_POST["city"];
$statusDes = $_POST["statusdes"];
$cedulaaplicant = $_POST["ncedula"];
$cedulamanager = $_SESSION["cedula"];
$totaldevengado = $_POST["totald"];
$salud = $_POST["salud"];
$pension = $_POST["pension"];
$caprovimpo = $_POST["caprovimpo"];
$priordpub = $_POST["priordpub"];
$partiali = $_POST["partiali"];
$bonordepub = $_POST["bonordpub"];
$prespe = $_POST["prespe"]; 
$pricom = $_POST["pricom"];
$salmin = $_POST["salmin"];
// $deduc = $_POST["deducciones"];
$devopartialiment = $_POST["devopartialiment"];
$servicimedi = $_POST["servicimedi"];
$casurautom = $_POST["casurautom"];
$total1 = $_POST["devengadorestas"];
$total1_2 = $_POST["devengadorestasmitad"];
$descuentos1 = $_POST["descuentos"];
$descuentos_2 = $_POST["descuentosalud"];
$totaldescuentos = $_POST["descuentoscuota"];
$capacidadCuota = $_POST["capacidadcuota"];
$factor = $_POST["factcuo"];
$valorAval = $_POST["aval"]; 
$totalBeneficios = $_POST["beneficios"];
$cartera1 = $_POST["nombrecartera1"];
$valorCartera1 = $_POST["valorcartera1"];
$cartera2 = $_POST["nombrecartera2"];
$valorCartera2 = $_POST["valorcartera2"];
$cartera3 = $_POST["nombrecartera3"];
$valorCartera3 = $_POST["valorcartera3"];
$cartera4 = $_POST["nombrecartera4"];
$valorCartera4 = $_POST["valorcartera4"];
$cartera5 = $_POST["nombrecartera5"];
$valorCartera5 = $_POST["valorcartera5"];
$cartera6 = $_POST["nombrecartera6"];
$valorCartera6 = $_POST["valorcartera6"];
$totalValoresCartera = $_POST["totalcompracartera"];
$created = $hoy; //crear fecha
$idCreated = $_SESSION["id"];
$idEntidad = $_POST["entidad"];
$idEdad = $_POST["edad"];
$idTasa = $_POST["tasa"];
$monto = $_POST["monto"];
$idAval = $_POST["optionaval"];
$idBeneficio = $_POST["optionbeneficios"];
$devo = $_POST["devo"];
$neg = $_POST["neg"];
$rechaz = $_POST["rechaz"];
$vaval= $_POST["vaval"];

if($idPagaduria != null && $idCaptacion != null && $idEstado != null && $cedulaaplicant != null &&
$totaldevengado != null  &&  $total1 != null &&  $total1_2 != null && $capacidadCuota != null && $factor != null &&
$valorAval != null && $totalBeneficios != null && $idEntidad != null && $idEdad != null && $idTasa != null &&
$monto != null && $idAval != null && $idBeneficio != null){
    if($_SESSION["rolId"] == 1){
        $query7 = $conexion ->prepare("SELECT TOP 1 * FROM FormPagadurias WHERE USRIdentificationNumberApplicant = :u ORDER BY Created DESC");
        $query7->bindParam(":u", $cedulaaplicant);
        $query7->execute();
        $usuario1 = $query7->fetch(PDO::FETCH_ASSOC);
        if($usuario1){
        $idForm1 = $usuario1['idFormPagadurias'];
        if($idEstado != 3){
            $query8 = $conexion ->prepare("UPDATE FormPagadurias
                SET TotalDevengado = :a
                    ,Salud = :b
                    ,Pension = :c
                    ,Caprovimpo = :d
                    ,PriOrdPublico = :e
                    ,Partiali = :f
                    ,Total1 = :g
                    ,Total1_2 = :h
                    ,Descuentos1 = :i
                    ,Descuentos_2 = :j
                    ,TotalDescuentos = :k
                    ,CapacidadCuota = :l
                    ,Factor = :m
                    ,ValorAval = :n
                    ,TotalBeneficios = :o
                    ,Cartera1 = :p
                    ,ValorCartera1 = :q
                    ,Cartera2 = :r
                    ,ValorCartera2 = :s
                    ,Cartera3 = :t
                    ,ValorCartera3 = :u
                    ,Cartera4 = :v
                    ,ValorCartera4 = :w
                    ,Cartera5 = :x
                    ,ValorCartera5 = :y
                    ,Cartera6 = :z
                    ,ValorCartera6 = :aa
                    ,TotalValoresCartera = :ab
                    ,Updated = :ac 
                    ,idEntidad = :ad
                    ,idEdad = :ae
                    ,idTasa = :af
                    ,Monto = :ag
                    ,Bonordepub = :ah
                    ,Prespe = :ai
                    ,Pricom = :aj
                    ,Salmin = :ak
                    ,Devopartialiment = :am
                    ,Servicimedi = :an
                    ,Casurautom = :ao
                    ,idAval = :ap
                    ,idBeneficio = :aq
                    ,idComision = :ar
                    ,saldoCarteraR = :au
                    ,totalRemanente = :av
                    ,Refinanciacion = :aw
                    ,Vaval = :ax
                WHERE idFormPagadurias = $idForm1");
                $query8->bindParam(":a", $totaldevengado);
                $query8->bindParam(":b", $salud);
                $query8->bindParam(":c", $pension);
                $query8->bindParam(":d", $caprovimpo);
                $query8->bindParam(":e", $priordpub);
                $query8->bindParam(":f", $partiali);
                $query8->bindParam(":g", $total1);
                $query8->bindParam(":h", $total1_2);
                $query8->bindParam(":i", $descuentos1);
                $query8->bindParam(":j", $descuentos_2);
                $query8->bindParam(":k", $totaldescuentos);
                $query8->bindParam(":l", $capacidadCuota);
                $query8->bindParam(":m", $factor);
                $query8->bindParam(":n", $valorAval);
                $query8->bindParam(":o", $totalBeneficios);
                $query8->bindParam(":p", $cartera1);
                $query8->bindParam(":q", $valorCartera1);
                $query8->bindParam(":r", $cartera2);
                $query8->bindParam(":s", $valorCartera2);
                $query8->bindParam(":t", $cartera3);
                $query8->bindParam(":u", $valorCartera3);
                $query8->bindParam(":v", $cartera4);
                $query8->bindParam(":w", $valorCartera4);
                $query8->bindParam(":x", $cartera5);
                $query8->bindParam(":y", $valorCartera5);
                $query8->bindParam(":z", $cartera6);
                $query8->bindParam(":aa", $valorCartera6);
                $query8->bindParam(":ab", $totalValoresCartera);
                $query8->bindParam(":ac", $hoy);
                $query8->bindParam(":ad", $idEntidad);
                $query8->bindParam(":ae", $idEdad);
                $query8->bindParam(":af", $idTasa);
                $query8->bindParam(":ag", $monto);
                $query8->bindParam(":ah", $bonordepub);
                $query8->bindParam(":ai", $prespe);
                $query8->bindParam(":aj", $pricom);
                $query8->bindParam(":ak", $salmin);
                $query8->bindParam(":am", $devopartialiment);
                $query8->bindParam(":an", $servicimedi);
                $query8->bindParam(":ao", $casurautom);
                $query8->bindParam(":ap", $idAval);
                $query8->bindParam(":aq", $idBeneficio);
                $query8->bindParam(":ar", $comisionasesor);
                $query8->bindParam(":au", $saldocrecog);
                $query8->bindParam(":av", $reman);
                $query8->bindParam(":aw", $refi);
                $query8->bindParam(":ax", $vaval);
                $query8->execute(); 
                //Actualizar user fechaupdate, pagaduria, estado y demas relacionado
                $query9 = $conexion ->prepare("UPDATE Users
                SET USRUpdated = :a
                    ,Pagaduria = :b
                    ,[status] = :c
                    ,Captacion = :d
                    ,otraCaptacion = :e
                    ,ciudadTransito = :f
                    ,[idDevolucion] = :g
                    ,[idNegado] = :h
                    ,[idRechazado] = :i
                    ,comentStatus = :j
                    ,ubicacionC =:k
                WHERE USRIdentificationNumber = $cedulaaplicant");
                $query9->bindParam(":a", $hoy);
                $query9->bindParam(":b", $idPagaduria);
                $query9->bindParam(":c", $idEstado);
                $query9->bindParam(":d", $idCaptacion);
                $query9->bindParam(":e", $otrocaptacion);
                $query9->bindParam(":f", $idciudad);
                $query9->bindParam(":g", $devo);
                $query9->bindParam(":h", $neg);
                $query9->bindParam(":i", $rechaz);
                $query9->bindParam(":j", $statusDes);
                $query9->bindParam(":k", $ciudadCliente);
                $query9->execute();
                $_SESSION["status_register"] = "OKSTATUS";
                header("location:clientes.php");
            }else{
                $query13 = $conexion ->prepare("UPDATE FormPagadurias
                SET USRIdentificationNumberManager = :aab
                    ,TotalDevengado = :a
                    ,Salud = :b
                    ,Pension = :c
                    ,Caprovimpo = :d
                    ,PriOrdPublico = :e
                    ,Partiali = :f
                    ,Total1 = :g
                    ,Total1_2 = :h
                    ,Descuentos1 = :i
                    ,Descuentos_2 = :j
                    ,TotalDescuentos = :k
                    ,CapacidadCuota = :l
                    ,Factor = :m
                    ,ValorAval = :n
                    ,TotalBeneficios = :o
                    ,Cartera1 = :p
                    ,ValorCartera1 = :q
                    ,Cartera2 = :r
                    ,ValorCartera2 = :s
                    ,Cartera3 = :t
                    ,ValorCartera3 = :u
                    ,Cartera4 = :v
                    ,ValorCartera4 = :w
                    ,Cartera5 = :x
                    ,ValorCartera5 = :y
                    ,Cartera6 = :z
                    ,ValorCartera6 = :aa
                    ,TotalValoresCartera = :ab
                    ,Updated = :ac 
                    ,idEntidad = :ad
                    ,idEdad = :ae
                    ,idTasa = :af
                    ,Monto = :ag
                    ,Bonordepub = :ah
                    ,Prespe = :ai
                    ,Pricom = :aj
                    ,Salmin = :ak
                    ,Devopartialiment = :am
                    ,Servicimedi = :an
                    ,Casurautom = :ao
                    ,idAval = :ap
                    ,idBeneficio = :aq
                    ,idComision = :ar
                    ,saldoCarteraR = :au
                    ,totalRemanente = :av
                    ,Refinanciacion = :aw
                    ,Vaval = :ax
                WHERE idFormPagadurias = $idForm1");
                $query13->bindParam(":a", $totaldevengado);
                $query13->bindParam(":b", $salud);
                $query13->bindParam(":c", $pension);
                $query13->bindParam(":d", $caprovimpo);
                $query13->bindParam(":e", $priordpub);
                $query13->bindParam(":f", $partiali);
                $query13->bindParam(":g", $total1);
                $query13->bindParam(":h", $total1_2);
                $query13->bindParam(":i", $descuentos1);
                $query13->bindParam(":j", $descuentos_2);
                $query13->bindParam(":k", $totaldescuentos);
                $query13->bindParam(":l", $capacidadCuota);
                $query13->bindParam(":m", $factor);
                $query13->bindParam(":n", $valorAval);
                $query13->bindParam(":o", $totalBeneficios);
                $query13->bindParam(":p", $cartera1);
                $query13->bindParam(":q", $valorCartera1);
                $query13->bindParam(":r", $cartera2);
                $query13->bindParam(":s", $valorCartera2);
                $query13->bindParam(":t", $cartera3);
                $query13->bindParam(":u", $valorCartera3);
                $query13->bindParam(":v", $cartera4);
                $query13->bindParam(":w", $valorCartera4);
                $query13->bindParam(":x", $cartera5);
                $query13->bindParam(":y", $valorCartera5);
                $query13->bindParam(":z", $cartera6);
                $query13->bindParam(":aa", $valorCartera6);
                $query13->bindParam(":ab", $totalValoresCartera);
                $query13->bindParam(":ac", $hoy);
                $query13->bindParam(":ad", $idEntidad);
                $query13->bindParam(":ae", $idEdad);
                $query13->bindParam(":af", $idTasa);
                $query13->bindParam(":ag", $monto);
                $query13->bindParam(":ah", $bonordepub);
                $query13->bindParam(":ai", $prespe);
                $query13->bindParam(":aj", $pricom);
                $query13->bindParam(":ak", $salmin);
                $query13->bindParam(":am", $devopartialiment);
                $query13->bindParam(":an", $servicimedi);
                $query13->bindParam(":ao", $casurautom);
                $query13->bindParam(":ap", $idAval);
                $query13->bindParam(":aq", $idBeneficio);
                $query13->bindParam(":ar", $comisionasesor);
                $query13->bindParam(":au", $saldocrecog);
                $query13->bindParam(":av", $reman);
                $query13->bindParam(":aw", $refi);
                $query13->bindParam(":ax", $vaval);
                $query13->bindParam(":aab", $cedulamanager);
                $query13->execute(); 
                //Actualizar user fechaupdate, pagaduria, estado y demas relacionado
                $query14 = $conexion ->prepare("UPDATE Users
                SET USRUpdated = :a
                    ,Pagaduria = :b
                    ,[status] = :c
                    ,Captacion = :d
                    ,otraCaptacion = :e
                    ,ciudadTransito = :f
                    ,[idDevolucion] = :g
                    ,[idNegado] = :h
                    ,[idRechazado] = :i
                    ,comentStatus = :j
                    ,ubicacionC =:k
                WHERE USRIdentificationNumber = $cedulaaplicant");
                $query14->bindParam(":a", $hoy);
                $query14->bindParam(":b", $idPagaduria);
                $query14->bindParam(":c", $idEstado);
                $query14->bindParam(":d", $idCaptacion);
                $query14->bindParam(":e", $otrocaptacion);
                $query14->bindParam(":f", $idciudad);
                $query14->bindParam(":g", $devo);
                $query14->bindParam(":h", $neg);
                $query14->bindParam(":i", $rechaz);
                $query14->bindParam(":j", $statusDes);
                $query14->bindParam(":k", $ciudadCliente);
                $query14->execute();
                $_SESSION["status_register"] = "OKSTATUS";
                header("location:clientes.php");
            }
        }else{
            $query10 = $conexion ->prepare("INSERT INTO FormPagadurias (USRIdentificationNumberManager
            ,USRIdentificationNumberApplicant
            ,TotalDevengado
            ,Salud
            ,Pension
            ,Caprovimpo
            ,PriOrdPublico
            ,Partiali
            ,Total1
            ,Total1_2
            ,Descuentos1
            ,Descuentos_2
            ,TotalDescuentos
            ,CapacidadCuota
            ,Factor
            ,ValorAval
            ,TotalBeneficios
            ,Cartera1
            ,ValorCartera1
            ,Cartera2
            ,ValorCartera2
            ,Cartera3
            ,ValorCartera3
            ,Cartera4
            ,ValorCartera4
            ,Cartera5
            ,ValorCartera5
            ,Cartera6
            ,ValorCartera6
            ,TotalValoresCartera
            ,Created
            ,Updated
            ,CreatedById
            ,UpdatedById
            ,idEntidad
            ,idEdad
            ,idTasa
            ,Monto
            ,Bonordepub
            ,Prespe
            ,Pricom
            ,Salmin
            ,Devopartialiment
            ,Servicimedi
            ,Casurautom
            ,idAval
            ,idBeneficio
            ,idComision
            ,saldoCarteraR
            ,totalRemanente
            ,Refinanciacion
            ,Vaval) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o,:p,:q,:r,:s,:t,:u,:v,:w,:x,:y,:z,:aa,:ab,:ac,:ad,:ae,:af,:ag,:ah,:ai,:aj,:ak,:al,:am,:an,:ao,:ap,:ar,:au,:av,:aw,:ax,:aaa,:aab,:aac,:aad, :aae)");
            $query10->bindParam(":a", $cedulamanager);
            $query10->bindParam(":b", $cedulaaplicant);
            $query10->bindParam(":c", $totaldevengado);
            $query10->bindParam(":d", $salud);
            $query10->bindParam(":e", $pension);
            $query10->bindParam(":f", $caprovimpo);
            $query10->bindParam(":g", $priordpub);
            $query10->bindParam(":h", $partiali);
            $query10->bindParam(":i", $total1);
            $query10->bindParam(":j", $total1_2);
            $query10->bindParam(":k", $descuentos1);
            $query10->bindParam(":l", $descuentos_2);
            $query10->bindParam(":m", $totaldescuentos);
            $query10->bindParam(":n", $capacidadCuota);
            $query10->bindParam(":o", $factor);
            $query10->bindParam(":p", $valorAval);
            $query10->bindParam(":q", $totalBeneficios);
            $query10->bindParam(":r", $cartera1);
            $query10->bindParam(":s", $valorCartera1);
            $query10->bindParam(":t", $cartera2);
            $query10->bindParam(":u", $valorCartera2);
            $query10->bindParam(":v", $cartera3);
            $query10->bindParam(":w", $valorCartera3);
            $query10->bindParam(":x", $cartera4);
            $query10->bindParam(":y", $valorCartera4);
            $query10->bindParam(":z", $cartera5);
            $query10->bindParam(":aa", $valorCartera5);
            $query10->bindParam(":ab", $cartera6);
            $query10->bindParam(":ac", $valorCartera6);
            $query10->bindParam(":ad", $totalValoresCartera);
            $query10->bindParam(":ae", $hoy);
            $query10->bindParam(":af", $hoy);
            $query10->bindParam(":ag", $idCreated);
            $query10->bindParam(":ah", $idCreated);
            $query10->bindParam(":ai", $idEntidad);
            $query10->bindParam(":aj", $idEdad);
            $query10->bindParam(":ak", $idTasa);
            $query10->bindParam(":al", $monto);
            $query10->bindParam(":am", $bonordepub);
            $query10->bindParam(":an", $prespe);
            $query10->bindParam(":ao", $pricom);
            $query10->bindParam(":ap", $salmin);
            $query10->bindParam(":ar", $devopartialiment);
            $query10->bindParam(":au", $servicimedi);
            $query10->bindParam(":av", $casurautom);
            $query10->bindParam(":aw", $idAval);
            $query10->bindParam(":ax", $idBeneficio);
            $query10->bindParam(":aaa", $comisionasesor);
            $query10->bindParam(":aab", $saldocrecog);
            $query10->bindParam(":aac", $reman);
            $query10->bindParam(":aad", $refi);
            $query10->bindParam(":aae", $vaval);
            $query10->execute(); 
            //Actualizar user fechaupdate, pagaduria, estado y demas relacionado 
            $query11 = $conexion ->prepare("UPDATE Users
            SET USRUpdated = :a
                ,Pagaduria = :b
                ,[status] = :c
                ,Captacion = :d
                ,otraCaptacion = :e
                ,ciudadTransito = :f
                ,[idDevolucion] = :g
                ,[idNegado] = :h
                ,[idRechazado] = :i
                ,comentStatus = :j
,ubicacionC =:k
            WHERE USRIdentificationNumber = $cedulaaplicant");
            $query11->bindParam(":a", $hoy);
            $query11->bindParam(":b", $idPagaduria);
            $query11->bindParam(":c", $idEstado);
            $query11->bindParam(":d", $idCaptacion);
            $query11->bindParam(":e", $otrocaptacion);
            $query11->bindParam(":f", $idciudad);
            $query11->bindParam(":g", $devo);
            $query11->bindParam(":h", $neg);
            $query11->bindParam(":i", $rechaz);
            $query11->bindParam(":j", $statusDes);
            $query11->bindParam(":k", $ciudadCliente);
            $query11->execute();
            $_SESSION["status_register"] = "OKSTATUS";
            header("location:clientes.php"); 
        }
    }
    else{
    //Primero averiguar si existe en la tabla FormPagadurias
    $query = $conexion ->prepare("SELECT TOP 1 * FROM FormPagadurias WHERE USRIdentificationNumberApplicant = :u ORDER BY Created DESC");
    $query->bindParam(":u", $cedulaaplicant);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);
    //Segundo ver si es el mismo manager quien envia la solicitud y 
    if($usuario){
        $idForm = $usuario['idFormPagadurias'];
        if($usuario["USRIdentificationNumberManager"] == $cedulamanager){
            //Hacer un update
            $query1 = $conexion ->prepare("UPDATE FormPagadurias
            SET TotalDevengado = :a
                ,Salud = :b
                ,Pension = :c
                ,Caprovimpo = :d
                ,PriOrdPublico = :e
                ,Partiali = :f
                ,Total1 = :g
                ,Total1_2 = :h
                ,Descuentos1 = :i
                ,Descuentos_2 = :j
                ,TotalDescuentos = :k
                ,CapacidadCuota = :l
                ,Factor = :m
                ,ValorAval = :n
                ,TotalBeneficios = :o
                ,Cartera1 = :p
                ,ValorCartera1 = :q
                ,Cartera2 = :r
                ,ValorCartera2 = :s
                ,Cartera3 = :t
                ,ValorCartera3 = :u
                ,Cartera4 = :v
                ,ValorCartera4 = :w
                ,Cartera5 = :x
                ,ValorCartera5 = :y
                ,Cartera6 = :z
                ,ValorCartera6 = :aa
                ,TotalValoresCartera = :ab
                ,Updated = :ac 
                ,idEntidad = :ad
                ,idEdad = :ae
                ,idTasa = :af
                ,Monto = :ag
                ,Bonordepub = :ah
                ,Prespe = :ai
                ,Pricom = :aj
                ,Salmin = :ak
                ,Devopartialiment = :am
                ,Servicimedi = :an
                ,Casurautom = :ao
                ,idAval = :ap
                ,idBeneficio = :aq
                ,idComision = :ar
                ,saldoCarteraR = :au
                ,totalRemanente = :av
                ,Refinanciacion = :aw
                ,Vaval = :ax
            WHERE idFormPagadurias = $idForm");
            $query1->bindParam(":a", $totaldevengado);
            $query1->bindParam(":b", $salud);
            $query1->bindParam(":c", $pension);
            $query1->bindParam(":d", $caprovimpo);
            $query1->bindParam(":e", $priordpub);
            $query1->bindParam(":f", $partiali);
            $query1->bindParam(":g", $total1);
            $query1->bindParam(":h", $total1_2);
            $query1->bindParam(":i", $descuentos1);
            $query1->bindParam(":j", $descuentos_2);
            $query1->bindParam(":k", $totaldescuentos);
            $query1->bindParam(":l", $capacidadCuota);
            $query1->bindParam(":m", $factor);
            $query1->bindParam(":n", $valorAval);
            $query1->bindParam(":o", $totalBeneficios);
            $query1->bindParam(":p", $cartera1);
            $query1->bindParam(":q", $valorCartera1);
            $query1->bindParam(":r", $cartera2);
            $query1->bindParam(":s", $valorCartera2);
            $query1->bindParam(":t", $cartera3);
            $query1->bindParam(":u", $valorCartera3);
            $query1->bindParam(":v", $cartera4);
            $query1->bindParam(":w", $valorCartera4);
            $query1->bindParam(":x", $cartera5);
            $query1->bindParam(":y", $valorCartera5);
            $query1->bindParam(":z", $cartera6);
            $query1->bindParam(":aa", $valorCartera6);
            $query1->bindParam(":ab", $totalValoresCartera);
            $query1->bindParam(":ac", $hoy);
            $query1->bindParam(":ad", $idEntidad);
            $query1->bindParam(":ae", $idEdad);
            $query1->bindParam(":af", $idTasa);
            $query1->bindParam(":ag", $monto);
            $query1->bindParam(":ah", $bonordepub);
            $query1->bindParam(":ai", $prespe);
            $query1->bindParam(":aj", $pricom);
            $query1->bindParam(":ak", $salmin);
            $query1->bindParam(":am", $devopartialiment);
            $query1->bindParam(":an", $servicimedi);
            $query1->bindParam(":ao", $casurautom);
            $query1->bindParam(":ap", $idAval);
            $query1->bindParam(":aq", $idBeneficio);
            $query1->bindParam(":ar", $comisionasesor);
            $query1->bindParam(":au", $saldocrecog);
            $query1->bindParam(":av", $reman);
            $query1->bindParam(":aw", $refi);
            $query1->bindParam(":ax", $vaval);
            $query1->execute(); 
            //Actualizar user fechaupdate, pagaduria, estado y demas relacionado
            $query2 = $conexion ->prepare("UPDATE Users
            SET USRUpdated = :a
                ,Pagaduria = :b
                ,[status] = :c
                ,Captacion = :d
                ,otraCaptacion = :e
                ,ciudadTransito = :f
                ,[idDevolucion] = :g
                ,[idNegado] = :h
                ,[idRechazado] = :i
                ,comentStatus = :j
,ubicacionC =:k
            WHERE USRIdentificationNumber = $cedulaaplicant");
            $query2->bindParam(":a", $hoy);
            $query2->bindParam(":b", $idPagaduria);
            $query2->bindParam(":c", $idEstado);
            $query2->bindParam(":d", $idCaptacion);
            $query2->bindParam(":e", $otrocaptacion);
            $query2->bindParam(":f", $idciudad);
            $query2->bindParam(":g", $devo);
            $query2->bindParam(":h", $neg);
            $query2->bindParam(":i", $rechaz);
            $query2->bindParam(":j", $statusDes);
            $query2->bindParam(":k", $ciudadCliente);
            $query2->execute();
            $_SESSION["status_register"] = "OKSTATUS";
            header("location:clientes.php");
        }else{
            //Hacer un insert
            $query3 = $conexion ->prepare("INSERT INTO FormPagadurias (USRIdentificationNumberManager
            ,USRIdentificationNumberApplicant
            ,TotalDevengado
            ,Salud
            ,Pension
            ,Caprovimpo
            ,PriOrdPublico
            ,Partiali
            ,Total1
            ,Total1_2
            ,Descuentos1
            ,Descuentos_2
            ,TotalDescuentos
            ,CapacidadCuota
            ,Factor
            ,ValorAval
            ,TotalBeneficios
            ,Cartera1
            ,ValorCartera1
            ,Cartera2
            ,ValorCartera2
            ,Cartera3
            ,ValorCartera3
            ,Cartera4
            ,ValorCartera4
            ,Cartera5
            ,ValorCartera5
            ,Cartera6
            ,ValorCartera6
            ,TotalValoresCartera
            ,Created
            ,Updated
            ,CreatedById
            ,UpdatedById
            ,idEntidad
            ,idEdad
            ,idTasa
            ,Monto
            ,Bonordepub
            ,Prespe
            ,Pricom
            ,Salmin
            ,Devopartialiment
            ,Servicimedi
            ,Casurautom
            ,idAval
            ,idBeneficio
            ,idComision
            ,saldoCarteraR
            ,totalRemanente
            ,Refinanciacion
            ,Vaval) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o,:p,:q,:r,:s,:t,:u,:v,:w,:x,:y,:z,:aa,:ab,:ac,:ad,:ae,:af,:ag,:ah,:ai,:aj,:ak,:al,:am,:an,:ao,:ap,:ar,:au,:av,:aw,:ax,:aaa,:aab,:aac,:aad, :aae)");
            $query3->bindParam(":a", $cedulamanager);
            $query3->bindParam(":b", $cedulaaplicant);
            $query3->bindParam(":c", $totaldevengado);
            $query3->bindParam(":d", $salud);
            $query3->bindParam(":e", $pension);
            $query3->bindParam(":f", $caprovimpo);
            $query3->bindParam(":g", $priordpub);
            $query3->bindParam(":h", $partiali);
            $query3->bindParam(":i", $total1);
            $query3->bindParam(":j", $total1_2);
            $query3->bindParam(":k", $descuentos1);
            $query3->bindParam(":l", $descuentos_2);
            $query3->bindParam(":m", $totaldescuentos);
            $query3->bindParam(":n", $capacidadCuota);
            $query3->bindParam(":o", $factor);
            $query3->bindParam(":p", $valorAval);
            $query3->bindParam(":q", $totalBeneficios);
            $query3->bindParam(":r", $cartera1);
            $query3->bindParam(":s", $valorCartera1);
            $query3->bindParam(":t", $cartera2);
            $query3->bindParam(":u", $valorCartera2);
            $query3->bindParam(":v", $cartera3);
            $query3->bindParam(":w", $valorCartera3);
            $query3->bindParam(":x", $cartera4);
            $query3->bindParam(":y", $valorCartera4);
            $query3->bindParam(":z", $cartera5);
            $query3->bindParam(":aa", $valorCartera5);
            $query3->bindParam(":ab", $cartera6);
            $query3->bindParam(":ac", $valorCartera6);
            $query3->bindParam(":ad", $totalValoresCartera);
            $query3->bindParam(":ae", $hoy);
            $query3->bindParam(":af", $hoy);
            $query3->bindParam(":ag", $idCreated);
            $query3->bindParam(":ah", $idCreated);
            $query3->bindParam(":ai", $idEntidad);
            $query3->bindParam(":aj", $idEdad);
            $query3->bindParam(":ak", $idTasa);
            $query3->bindParam(":al", $monto);
            $query3->bindParam(":am", $bonordepub);
            $query3->bindParam(":an", $prespe);
            $query3->bindParam(":ao", $pricom);
            $query3->bindParam(":ap", $salmin);
            $query3->bindParam(":ar", $devopartialiment);
            $query3->bindParam(":au", $servicimedi);
            $query3->bindParam(":av", $casurautom);
            $query3->bindParam(":aw", $idAval);
            $query3->bindParam(":ax", $idBeneficio);
            $query3->bindParam(":aaa", $comisionasesor);
            $query3->bindParam(":aab", $saldocrecog);
            $query3->bindParam(":aac", $reman);
            $query3->bindParam(":aad", $refi);
            $query3->bindParam(":aae", $vaval);
            $query3->execute(); 
            //Actualizar user fechaupdate, pagaduria, estado y demas relacionado 
            $query4 = $conexion ->prepare("UPDATE Users
            SET USRUpdated = :a
                ,Pagaduria = :b
                ,[status] = :c
                ,Captacion = :d
                ,otraCaptacion = :e
                ,ciudadTransito = :f
                ,[idDevolucion] = :g
                ,[idNegado] = :h
                ,[idRechazado] = :i
                ,comentStatus = :j
,ubicacionC =:k
            WHERE USRIdentificationNumber = $cedulaaplicant");
            $query4->bindParam(":a", $hoy);
            $query4->bindParam(":b", $idPagaduria);
            $query4->bindParam(":c", $idEstado);
            $query4->bindParam(":d", $idCaptacion);
            $query4->bindParam(":e", $otrocaptacion);
            $query4->bindParam(":f", $idciudad);
            $query4->bindParam(":g", $devo);
            $query4->bindParam(":h", $neg);
            $query4->bindParam(":i", $rechaz);
            $query4->bindParam(":j", $statusDes);
            $query4->bindParam(":k", $ciudadCliente);
            $query4->execute();
            $_SESSION["status_register"] = "OKSTATUS";
            header("location:clientes.php");           
        }
    }else
    {
        $query5 = $conexion ->prepare("INSERT INTO FormPagadurias (USRIdentificationNumberManager
        ,USRIdentificationNumberApplicant
        ,TotalDevengado
        ,Salud
        ,Pension
        ,Caprovimpo
        ,PriOrdPublico
        ,Partiali
        ,Total1
        ,Total1_2
        ,Descuentos1
        ,Descuentos_2
        ,TotalDescuentos
        ,CapacidadCuota
        ,Factor
        ,ValorAval
        ,TotalBeneficios
        ,Cartera1
        ,ValorCartera1
        ,Cartera2
        ,ValorCartera2
        ,Cartera3
        ,ValorCartera3
        ,Cartera4
        ,ValorCartera4
        ,Cartera5
        ,ValorCartera5
        ,Cartera6
        ,ValorCartera6
        ,TotalValoresCartera
        ,Created
        ,Updated
        ,CreatedById
        ,UpdatedById
        ,idEntidad
        ,idEdad
        ,idTasa
        ,Monto
        ,Bonordepub
        ,Prespe
        ,Pricom
        ,Salmin
        ,Devopartialiment
        ,Servicimedi
        ,Casurautom
        ,idAval
        ,idBeneficio
        ,idComision
            ,saldoCarteraR
            ,totalRemanente
            ,Refinanciacion
            ,Vaval) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o,:p,:q,:r,:s,:t,:u,:v,:w,:x,:y,:z,:aa,:ab,:ac,:ad,:ae,:af,:ag,:ah,:ai,:aj,:ak,:al,:am,:an,:ao,:ap,:ar,:au,:av,:aw,:ax,:aaa,:aab,:aac,:aad, :aae)");
        $query5->bindParam(":a", $cedulamanager);
        $query5->bindParam(":b", $cedulaaplicant);
        $query5->bindParam(":c", $totaldevengado);
        $query5->bindParam(":d", $salud);
        $query5->bindParam(":e", $pension);
        $query5->bindParam(":f", $caprovimpo);
        $query5->bindParam(":g", $priordpub);
        $query5->bindParam(":h", $partiali);
        $query5->bindParam(":i", $total1);
        $query5->bindParam(":j", $total1_2);
        $query5->bindParam(":k", $descuentos1);
        $query5->bindParam(":l", $descuentos_2);
        $query5->bindParam(":m", $totaldescuentos);
        $query5->bindParam(":n", $capacidadCuota);
        $query5->bindParam(":o", $factor);
        $query5->bindParam(":p", $valorAval);
        $query5->bindParam(":q", $totalBeneficios);
        $query5->bindParam(":r", $cartera1);
        $query5->bindParam(":s", $valorCartera1);
        $query5->bindParam(":t", $cartera2);
        $query5->bindParam(":u", $valorCartera2);
        $query5->bindParam(":v", $cartera3);
        $query5->bindParam(":w", $valorCartera3);
        $query5->bindParam(":x", $cartera4);
        $query5->bindParam(":y", $valorCartera4);
        $query5->bindParam(":z", $cartera5);
        $query5->bindParam(":aa", $valorCartera5);
        $query5->bindParam(":ab", $cartera6);
        $query5->bindParam(":ac", $valorCartera6);
        $query5->bindParam(":ad", $totalValoresCartera);
        $query5->bindParam(":ae", $hoy);
        $query5->bindParam(":af", $hoy);
        $query5->bindParam(":ag", $idCreated);
        $query5->bindParam(":ah", $idCreated);
        $query5->bindParam(":ai", $idEntidad);
        $query5->bindParam(":aj", $idEdad);
        $query5->bindParam(":ak", $idTasa);
        $query5->bindParam(":al", $monto);
        $query5->bindParam(":am", $bonordepub);
        $query5->bindParam(":an", $prespe);
        $query5->bindParam(":ao", $pricom);
        $query5->bindParam(":ap", $salmin);
        $query5->bindParam(":ar", $devopartialiment);
        $query5->bindParam(":au", $servicimedi);
        $query5->bindParam(":av", $casurautom);
        $query5->bindParam(":aw", $idAval);
        $query5->bindParam(":ax", $idBeneficio);
        $query5->bindParam(":aaa", $comisionasesor);
        $query5->bindParam(":aab", $saldocrecog);
        $query5->bindParam(":aac", $reman);
        $query5->bindParam(":aad", $refi);
        $query5->bindParam(":aae", $vaval);
        $query5->execute(); 
        //Actualizar user fechaupdate, pagaduria, estado y demas relacionado
        $query6 = $conexion ->prepare("UPDATE Users
            SET USRUpdated = :a
                ,Pagaduria = :b
                ,[status] = :c
                ,Captacion = :d
                ,otraCaptacion = :e
                ,ciudadTransito = :f
                ,[idDevolucion] = :g
                ,[idNegado] = :h
                ,[idRechazado] = :i
                ,comentStatus = :j
,ubicacionC =:k
            WHERE USRIdentificationNumber = $cedulaaplicant");
        $query6->bindParam(":a", $hoy);
        $query6->bindParam(":b", $idPagaduria);
        $query6->bindParam(":c", $idEstado);
        $query6->bindParam(":d", $idCaptacion);
        $query6->bindParam(":e", $otrocaptacion);
        $query6->bindParam(":f", $idciudad);
        $query6->bindParam(":g", $devo);
        $query6->bindParam(":h", $neg);
        $query6->bindParam(":i", $rechaz);
        $query6->bindParam(":j", $statusDes); 
        $query6->bindParam(":k", $ciudadCliente);           
        $query6->execute();
        $_SESSION["status_register"] = "OKSTATUS";
        header("location:clientes.php");
    }
}
}else{
    $_SESSION["status_register"] = "EMPTY";
    header("location:clientes.php");
}

?>