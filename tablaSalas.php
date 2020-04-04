<?php 
header('Content-Type: text/html; charset=UTF-8');
?>
<?php 
require_once "./clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$cod_mul = 2;

$sql="	SELECT 
			MULTIPLEX.nom_multiplex, SALA_CINE.cod_sala_cine, SALA_CINE.nombre_sala 
		FROM 
			MULTIPLEX, SALA_CINE 
		WHERE 
			SALA_CINE.cod_multiplex = MULTIPLEX.cod_multiplex AND 
			MULTIPLEX.cod_multiplex = $cod_mul";

$result=mysqli_query($conexion,$sql);


?>

<div>
	<table class="table table-hover table-condensed" id="iddatatable">
		<thead style="background-color: #4f944a;color: white; font-weight: bold;">
			<tr>
				<td>MULTIPLEX</td>
				<td>CODIGO</td>
				<td>NOMBRE</td>
				<td>ACCIÓN</td>
			</tr>
		</thead>
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>MULTIPLEX</td>
				<td>CODIGO</td>
				<td>NOMBRE</td>
				<td>ACCIÓN</td>
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
					

					<?php 
						$icon = "";

						if( !strcasecmp($mostrar[2], "ACTIVO") == 0 )
						{
							$icon = "far fa-window-close";
						}
						else
						{
							$icon = "fas fa-check";
						}

					?>

					<td>
						<span class="btn btn-warning btn-xs">
							<?php echo "<span class='$icon'></span>";  ?>
							
						</span>
					</td>	

					
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