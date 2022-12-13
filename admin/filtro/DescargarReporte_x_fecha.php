<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <!--Importante--->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar Reporte</title>

    <style>
    .color{
        background-color: #9BB;  
    }
</style>
</head>
<body>
    
<?php
include('config.php');
$fecha = date("d_m_Y");


/**PARA FORZAR LA DESCARGA DEL EXCEL */
header("Content-Type: text/html;charset=utf-8");
header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
$filename = "ReporteExcel_" .$fecha. ".xls";
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=" . $filename . "");


/***RECIBIENDO LAS VARIABLE DE LA FECHA */
$fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
$fechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));
$var=$_POST['txt_cedula'];

/*
$sqlTrabajadores = ("select * from trabajadores where (fecha_ingreso>='$fechaInit' and fecha_ingreso<='$fechaFin') order by fecha_ingreso desc");
$sqlTrabajadores = ("SELECT * FROM trabajadores WHERE fecha_ingreso BETWEEN '$fechaInit' AND '$fechaFin' order by fecha_ingreso desc
$sqlTrabajadores = ("SELECT * FROM `trabajadores` WHERE fecha_ingreso BETWEEN '$fechaInit' AND '$fechaFin'
$sqlTrabajadores = ("select * from trabajadores where fecha_ingreso >= '$fechaInit' and fecha_ingreso < '$fechaFin';
$sqlTrabajadores = ("SELECT * FROM trabajadores WHERE fecha_ingreso BETWEEN '$fechaInit' AND '$fecha2' ORDER BY fecha_ingreso DESC
*/                       

$sqlTrabajadores = "SELECT * FROM marcados 
WHERE (fecha>='$fechaInit' and fecha<='$fechaFin' AND cedula='$var') ORDER BY fecha ASC";
$query = mysqli_query($con, $sqlTrabajadores);



$cadena="SELECT * FROM empleados where cedula='$var'";

$ejecuta=mysqli_query($con,$cadena);
$ejecuta=mysqli_fetch_array($ejecuta);




?>

<h3 class="text-center">REPORTE DE ENTRADA Y SALIDA POR RANGO DE FECHAS</h3>
<h3>IMPORTADORA TCMULTICOLOR S.R.L.</h3>
EMPLEADO: <?php echo $ejecuta['nombre']." ".$ejecuta['apellido'];?> 

<table style="text-align: center;" border='1' cellpadding=1 cellspacing=1>
<thead>
    <tr style="background: #D0CDCD;">
        <th scope="col">#</th>
                    
                    <th scope="col">CARNET</th>
                    <th scope="col">FECHA Y HORA</th>
                    <th scope="col">ENTRADA/SALIDA</th>
                  
    </tr>
</thead>
<?php
$i =1;
    while ($data = mysqli_fetch_array($query)) { ?>
    <tbody>
        <tr>
            <td><?php echo $i++; ?></td>
                  
                    <td><?php echo $data['cedula'] ; ?></td>
                    <td><?php echo $data['fecha_hora'] ; ?></td>
                     <td><?php echo $data['tipo'] ; ?></td>

                    
        </tr>
    </tbody>
    
<?php } ?>
</table>

</body>
</html>