<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<?php 
require_once "./clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$sql="	SELECT cod_auditoria, cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion FROM AUDITORIA";

$result=mysqli_query($conexion,$sql);


?>

<div>
	<table class="table table-hover table-condensed" id="iddatatable">
		<thead style="background-color: #4f944a;color: white; font-weight: bold;">
			<tr>
				<td>CODIGO AUDIT</td>
				<td>CODIGO USUARIO</td>
				<td>NOMBRE CARGO</td>
				<td>ACCIÓN</td>
				<td>NOMBRE TABLA</td>
				<td>FECHA MODIFICACIÓN</td>
				<td>DIRECCIÓN IP</td>
			</tr>
		</thead>
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>CODIGO AUDIT</td>
				<td>CODIGO USUARIO</td>
				<td>NOMBRE CARGO</td>
				<td>ACCIÓN</td>
				<td>NOMBRE TABLA</td>
				<td>FECHA MODIFICACIÓN</td>
				<td>DIRECCIÓN IP</td>
			</tr>
		</tfoot>
		<tbody>
			<?php 
			while ($mostrar=mysqli_fetch_row($result)){
				?>
				<tr>
					<td><?php echo $mostrar[0] ?></td>
					<td><?php echo $mostrar[1] ?></td>
					<td><?php echo $mostrar[2] ?></td>
					<td><?php echo $mostrar[3] ?></td>
					<td><?php echo $mostrar[4] ?></td>
					<td><?php echo $mostrar[5] ?></td>
					<td><?php echo $mostrar[6] ?></td>
				</tr>
				<?php 
			}
			?>

		</tbody>

	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() 
	{
		$('#iddatatable').DataTable();
	} );
</script>