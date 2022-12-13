<?php

session_start();
    if(!isset($_SESSION['usuario']) or ($_SESSION['rol']!='1' AND $_SESSION['rol']!='3'))
    {
        session_destroy();
        header('location: ../../index.php');
    }
    else
    {


        sleep(1);
        include('config.php');

        /**
         * Nota: Es recomendable guardar la fecha en formato año - mes y dia (2022-08-25)
         * No es tan importante que el tipo de fecha sea date, puede ser varchar
         * La funcion strtotime:sirve para cambiar el forma a una fecha,
         * esta espera que se proporcione una cadena que contenga un formato de fecha en Inglés US,
         * es decir año-mes-dia e intentará convertir ese formato a una fecha Unix dia - mes - año.
        */

        $fechaInit = date("Y-m-d", strtotime($_POST['f_ingreso']));
        $fechaFin  = date("Y-m-d", strtotime($_POST['f_fin']));

        $sqlTrabajadores = ("SELECT * FROM enfermera WHERE  fecha BETWEEN '$fechaInit' AND '$fechaFin'  ORDER BY fecha ASC");
        $query = mysqli_query($con, $sqlTrabajadores);
        //print_r($sqlTrabajadores);
        $total   = mysqli_num_rows($query);
        echo '<strong>Total: </strong> ('. $total .')';
}
?>
 <a href="enfermera.php" class="btn btn-warning mb-2">VOLVER</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO</th>
                    <th scope="col">CARNET</th>
                    <th scope="col">PESO</th>
                    <th scope="col">TALLA</th>
                    <th scope="col">EDAD</th>
                    <th scope="col">DIAGNÓSTICO</th>
                    <th scope="col">PROFESIONAL A CARGO</th>
                    <th scope="col">FECHA DE VISITA</th>
        </tr>
    </thead>
    <?php
    $i = 1;
    while ($data = mysqli_fetch_array($query)) { ?>
        <tbody>
            <tr>
                <td><?php echo $i++; ?></td>
                    <td><?php echo $data['nombre']; ?></td>
                    <td><?php echo $data['apellido'] ; ?></td>
                    <td><?php echo $data['carnet'] ; ?></td>
                    <td><?php echo $data['peso'] ; ?></td>
                    <td><?php echo $data['talla'] ; ?></td>
                    <td><?php echo $data['edad'] ; ?></td>
                   <td><?php echo $data['diagnostico'] ; ?></td>
                    <td><?php echo $data['enfermera'] ; ?></td>
                   <td><?php echo $data['fecha'] ; ?></td>
            </tr>
        </tbody>
    <?php } ?>
</table>