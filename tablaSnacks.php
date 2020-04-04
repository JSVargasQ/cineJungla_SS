<?php
header('Content-Type: text/html; charset=UTF-8');
?>

<?php 
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$sql= " SELECT
            CODIGO_PRODUCTO, MULTIPLEX, PRODUCTO, CANTIDAD 
        FROM 
            cantidad_almacen";

$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-condensed" id="iddatatable">
	
		<thead style="background-color: #4f944a;color: white; font-weight: bold;">
			<tr>
				<td>CODIGO</td>
				<td>PRODUCTO</td>
				<td>CANTIDAD</td>
			</tr>
		</thead>
		
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>CODIGO PRODUCTO</td>
				<td>PRODUCTO</td>
				<td>CANTIDAD</td>
			</tr>
		</tfoot>
		
		<tbody>
			<?php 
			while ($mostrar=mysqli_fetch_row($result))
			{
			?>
				<tr>
					<td><?php echo $mostrar[0] ?></td>
					<td><?php echo $mostrar[2] ?></td>
					<td><?php echo $mostrar[3] ?></td>
					
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