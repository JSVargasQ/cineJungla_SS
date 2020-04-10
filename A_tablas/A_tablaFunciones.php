<?php 
header('Content-Type: text/html; charset=UTF-8');
?>
<?php 

	require_once "../clases/conexion.php";
    include_once '../controlador/user.php';
	include_once '../controlador/user_Sesion.php';
	
$obj=new conectar();
$conexion=$obj->conexion();

$userSession = new UserSession();
$user = new Usuario();
$user->setUser($userSession->getCurrentUser());
    $cod_mul = $user->getCodigoMul();

$sql= "	SELECT
			FUNCION.cod_funcion, SALA_CINE.nombre_sala, PELICULA.nombre_pelicula, PELICULA.duracion_pelicula,
			FUNCION.fecha_funcion, FUNCION.sillas_disponibles, FUNCION.estado_funcion,
			MULTIPLEX.cod_multiplex
		FROM
			MULTIPLEX, FUNCION, PELICULA, SALA_CINE
		WHERE
			FUNCION.cod_pelicula = PELICULA.cod_pelicula AND
			FUNCION.cod_sala_cine = SALA_CINE.cod_sala_cine AND
			SALA_CINE.cod_multiplex = MULTIPLEX.cod_multiplex AND
			MULTIPLEX.cod_multiplex = ".$cod_mul;
			
$result=mysqli_query($conexion,$sql);


?>

<div>
	<table class="table table-hover table-condensed" id="iddatatable">
		<thead style="background-color: #4f944a;color: white; font-weight: bold;">
			<tr>
				<td>CODIGO</td>
				<td>SALA</td>
				<td>PELICULA</td>
				<td>DURACIÓN</td>
				<td>FECHA</td>
				<td>HORA</td>
				<td>SILLAS LIBRES</td>
				<td>ESTADO</td>
				<td>EDITAR</td>
				<td>ELIMINAR</td>
			</tr>
		</thead>
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>CODIGO</td>
				<td>SALA</td>
				<td>PELICULA</td>
				<td>DURACIÓN</td>
				<td>FECHA</td>
				<td>HORA</td>
				<td>SILLAS LIBRES</td>
				<td>ESTADO</td>
				<td>EDITAR</td>
				<td>ELIMINAR</td>
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
					<td><center><?php echo $mostrar[3] ?></center></td>

					<td><?php echo substr($mostrar[4], 0,10) ?></td>
					<td><?php echo substr($mostrar[4], 11) ?></td>
					
					<td><?php echo $mostrar[5] ?></td>
					<td><?php echo $mostrar[6] ?></td>

					<td><center>
						<?php if( strcasecmp($mostrar[6], "DISPONIBLE") == 0  ){ ?>

						<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#updateFuncion" onclick="agregarFormActualizar(<?php echo $mostrar[0].','.$cod_mul ?> )">
							<span class="far fa-edit"></span>
						</span>

						<?php  } ?>

						
					</center></td>

					<td><center>
						<?php if( strcasecmp($mostrar[6], "DISPONIBLE") == 0  ){ ?>

						<span class="btn btn-danger btn-xs" onclick="eliminarFuncion(<?php echo $mostrar[0]; echo ','; echo $mostrar[7] ?>)">
							<span class="fas fa-minus-circle"></span>
						</span>
						</center></td>

					<?php  }  ?>
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