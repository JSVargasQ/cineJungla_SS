<?php 
header('Content-Type: text/html; charset=UTF-8');
?>
<?php 
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$sql="SELECT cod_empleado, nombre_empleado, cod_multiplex, cod_tipo_empleado, estado_empleado FROM empleado ";

$result=mysqli_query($conexion,$sql);


?>

<div>
	<table class="table table-hover table-condensed" id="iddatatable">
		<thead style="background-color: #4f944a;color: white; font-weight: bold;">
			<tr>
				<td>CODIGO EMPLEADO</td>
				<td>NOMBRE</td>
				<td>MULTIPLEX</td>
				<td>TIPO</td>
				<td>ESTADO</td>
			</tr>
		</thead>
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
			<td>CODIGO EMPLEADO</td>
				<td>NOMBRE</td>
				<td>MULTIPLEX</td>
				<td>TIPO</td>
				<td>ESTADO</td>
			</tr>
		</tfoot>
		<tbody>
			<?php 
			while ($mostrar=mysqli_fetch_row($result)){
				?>
				<tr>
					<td><?php echo $mostrar[0] ?></td>
					<td><?php echo $mostrar[1] ?></td>


					<?php
						$sql2="SELECT nom_multiplex FROM EMPLEADO, MULTIPLEX WHERE MULTIPLEX.cod_multiplex=2 GROUP BY(nom_multiplex)";
						$result2=mysqli_query($conexion,$sql2);
						$multiplex = mysqli_fetch_row($result2); 
					?>

					<td><?php echo $multiplex[0] ?></td>
					

					<?php
						$sql2="SELECT nombre_cargo_empleado FROM EMPLEADO, CARGO_EMPLEADO WHERE CARGO_EMPLEADO.cod_tipo_empleado=$mostrar[3] GROUP BY(nombre_cargo_empleado)";
						$result2=mysqli_query($conexion,$sql2);
						$tipo = mysqli_fetch_row($result2); 
					?>
					

					<td><?php echo $tipo[0] ?></td>



					<td><?php echo $mostrar[4] ?></td>
					
					<!-- 
					<td>
						<span class="btn btn-warning btn-xs">
							<span class="fas fa-drumstick-bite"></span>
						</span>
					</td>	
			-->

				</tr>
				<?php 
			}
			?>

		</tbody>







	</table>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#iddatatable').DataTable();
	} );


</script>