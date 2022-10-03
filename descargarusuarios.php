<?php
    header("Content-Type: text/html;charset=utf-8");
    header('Content-type:application/vnd.ms-excel;');
    header('Content-Disposition: attachment; filename=usuarios.xls');

    require("conexion.php");

    $query = $conexion ->prepare("SELECT * FROM Users");
    $query->execute();
    $data = $query->fetchAll();

    $query1 = $conexion ->prepare("SELECT * FROM Pagadurias");
    $query1->execute();
    $data1 = $query1->fetchAll();

    $query2 = $conexion ->prepare("SELECT * FROM Captacion");
    $query2->execute();
    $data2 = $query2->fetchAll();

    echo '<meta charset="utf-8"/>';

    echo '<table border>
        <tr>
            <th>Cédula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>N° Celular</th>
            <th>Tipo pagaduría</th>
            <th>Medio Captación</th>
            <th>Descripción otra captación</th>
        </tr>';

	foreach ($data as $valores):

        echo '<tr>
            <td>'.$valores["USRIdentificationNumber"].'</td>
            <td>'.$valores["USRFirstName"].' '.$valores["USRMiddleName"].'</td>
            <td>'.$valores["USRFirstSurname"].' '.$valores["USRSecondSurname"].'</td>
            <td>'.$valores["USREmail"].'</td>
            <td>57'.$valores["USRCellphone"].'</td>
            <td>';
        foreach($data1 as $val):
            switch ($valores["Pagaduria"]){            
                case $val["idPagaduria"]:
                    echo $val["nombrePagaduria"]." </td>";
                    break;
            };
        endforeach;        
        echo '<td>';
        foreach($data2 as $v):
            switch ($valores["Captacion"]){
                case $v["idCaptacion"]:
                    echo $v["nameCaptacion"]." </td>";
                    break;
                };
        endforeach;  
        echo '<td>'.$valores["otraCaptacion"].'</td>
        </tr>';

    endforeach;

    echo '</table>';
?>