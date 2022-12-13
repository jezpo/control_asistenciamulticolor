<?php 

    	include "config.php";
//include "../head.php";

	if (isset($_POST['boton']))
  {
    session_destroy();
    header('location:../../index.php');
  }

  $consulta="SELECT * from enfermera where otro='1'";
  $ejecuta=mysqli_query($con,$consulta);



  if(isset($_POST['boton2'])){
  	$enfermera=$_SESSION['usuario'];
  	$nombre=$_POST['caja1'];
  	$apellido=$_POST['caja2'];
  	$carnet=$_POST['caja3'];
  	$peso=$_POST['caja4'];
  	$talla=$_POST['caja5'];
  	$edad=$_POST['caja6'];
  	$diagnostico=$_POST['caja_area'];

	$cadena="INSERT INTO enfermera(nombre,apellido,carnet,peso,talla, edad,diagnostico,enfermera) values
  	('$nombre','$apellido','$carnet','$peso','$talla','$edad','$diagnostico','$enfermera')";

  	$ejectuar=mysqli_query($con,$cadena);


  		
  	

  }
    

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../../css/bootstrap.min.css">

	<?php //require "../head.php"; 
	?>



</head>


<body>
     <div class="text-center container justify-content-between mt-2">
        <ul class="nav nav-tabs justify-content-between">
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="../calendario/index.php">VER CITAS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="../pacientes/index_pacientes.php">PACIENTES</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="enfermera.php">ENFERMERÍA</a>
          </li>
          <li class="nav-item">
            <form action="" method="post">
              <label for="" class="text-warning"><?php echo "BIENVENIDO DR. ".strtoupper($_SESSION['usuario']); ?></label>
            <input type="submit" class="btn btn-danger" value="CERRAR SESIÓN" name="boton">
            </form>
          </li>
        </ul>
        <p class="bg-danger text-light font-italic font-weight-ligth mt-1">RECUERDE QUE DEBE REMITIR EL REPORTE DIARIO AL MÉDICO DE TURNO PARA QUE EL PROFESIONAL PUEDA TOMAR EL CASO CORRESPONDIENTE </p>
        <a href="detalle.php" class="btn btn-primary">GENERAR REPORTE DIARIO</a>
        <div class="row">
      <div class="col-4">

      	<h4>INGRESAR DATOS DEL PACIENTE</h4>
			      	<form method="POST" action="enfermera.php">
						  <!-- 2 column grid layout with text inputs for the first and last names -->
						  <div class="row mb-4">
						    <div class="col">
						      <div class="form-outline">
						      	<label class="form-label" for="form3Example1"></label>
						        <input name="caja1" type="text" id="form3Example1" class="form-control" placeholder="NOMBRES" />
						        
						      </div>
						    </div>
						    <div class="col">
						      <div class="form-outline">
						      	<label class="form-label" for="form3Example2"></label>
						        <input name="caja2" type="text" id="form3Example2" class="form-control" placeholder="APELLIDOS" />
						        
						      </div>
						    </div>
						  </div>

						  <!-- Email input -->
						  <div class="form-outline mb-4">
						    
						        <input name="caja3" type="text" id="form3Example2" class="form-control" placeholder="CARNET" required="" />
						  </div>

						 <div class="row mb-4">
						 <div class="col">
						      <div class="form-outline">
						      	<label class="form-label" for="form3Example2"></label>
						        <input name="caja4" type="text" id="form3Example2" class="form-control" placeholder="PESO" />
						        
						      </div>
						 </div>

						 <div class="col">
						      <div class="form-outline">
						      	<label class="form-label" for="form3Example2"></label>
						        <input name="caja5" type="text" id="form3Example2" class="form-control" placeholder="TALLA" />
						        
						      </div>
						 </div>

						 <div class="col">
						      <div class="form-outline">
						      	<label class="form-label" for="form3Example2"></label>
						        <input name="caja6" type="text" id="form3Example2" class="form-control" placeholder="EDAD" />
						        
						      </div>
						 </div>
						 </div>
						  

						  <div class="mb-2">
						  	<textarea name="caja_area" id="" cols="30" rows="10" class="form-control"></textarea>
						  </div>
						  

						  <input type="submit" name="boton2" id="boton2" class="btn btn-secondary btn-block mb-4" value="TOMAR NOTA DEL PACIENTE">

						  <!-- Register buttons -->
						
						</form>
					
						
					
      </div>

	      <div class="col-8 mt-4">
	      	<h4 class="bg-warning text-center">LISTA DE PACIENTES ATENDIDOS POR ENFERMERÍA</h4>
	      	<table class="table  table-striped">
	      		<thead>
	      			<tr class="text-center"	>
	      				<th>CARNET</th>
	      				<th>PESO</th>
	      				<th>TALLA</th>
	      				<th colspan="2">DIAGNÓSTICO</th>
	      				
	      			</tr>
	      		</thead>
	      		<tbody>
	      			<?php 
	      				while($data=mysqli_fetch_array($ejecuta)){
	      			?>
	      			<tr>
	      				<td><?php echo $data['carnet']; ?></td>
	      				<td><?php echo $data['peso']; ?></td>
	      				<td><?php echo $data['talla']; ?></td>
	      				<td><?php echo $data['diagnostico']; ?></td>
	      				
	      			</tr>

	      			<?php		
	      				}
	      			 ?>
	      		</tbody>
	      	</table>
	      </div>
      </div>
</div>
</body>
</html>