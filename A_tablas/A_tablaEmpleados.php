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

$sql="	SELECT 
			cod_empleado, nombre_empleado, nombre_cargo_empleado , fecha_ingreso_empleado , estado_empleado, EMPLEADO.cod_tipo_empleado
		FROM 
			empleado, multiplex, cargo_empleado
		WHERE
			MULTIPLEX.cod_multiplex = EMPLEADO.cod_multiplex AND
			CARGO_EMPLEADO.cod_tipo_empleado = EMPLEADO.cod_tipo_empleado AND
			EMPLEADO.cod_multiplex =".$cod_mul;

$result=mysqli_query($conexion,$sql);

?>

<div>
	<table class="table table-hover table-condensed" id="iddatatable">
		<thead style="background-color: #4f944a;color: white; font-weight: bold;">
			<tr>
				<td>CODIGO</td>
				<td>NOMBRE</td>
				<td>TIPO</td>
				<td>INGRESO</td>
				<td>ESTADO</td>
				<td>MODIFICAR</td>
				<td>ACCIÓN</td>
			</tr>
		</thead>
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>CODIGO</td>
				<td>NOMBRE</td>
				<td>TIPO</td>
				<td>INGRESO</td>
				<td>ESTADO</td>
				<td>MODIFICAR</td>
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
						$date = new DateTime( $mostrar[3]);
					?>

					<td><?php echo date_format($date, 'd/m/Y'); ?></td>
										
					<td><?php echo $mostrar[4] ?></td>


					<td>
						<?php if( strcasecmp($mostrar[4], "ACTIVO") == 0 and intval($mostrar[5]) > 1 and intval($mostrar[5]) < 5 ){ ?>
							<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#actualizarEmpleados" onclick="agregarFormActualizar(<?php echo $mostrar[0] ?> )">
							<span class="far fa-edit" ></span>
						</span>

						<?php  } else{} ?>

						
					</td>	

					<td>
						<?php if( strcasecmp($mostrar[4], "ACTIVO") == 0  and intval($mostrar[5]) > 1 and intval($mostrar[5]) < 5   ){ ?>
							<span class="btn btn-danger btn-xs" onclick="deshabilitarEmpleado(<?php echo $mostrar[0] ?> )">
								<span class="fas fa-user-alt-slash"></span>
							</span>
						<?php  } else if ( intval($mostrar[5]) > 1 and intval($mostrar[5]) < 5 ) { ?>
							<span class="btn btn-success btn-xs" onclick="habilitarEmpleado(<?php echo $mostrar[0] ?> )">
								<span class="fas fa-user-check"></span>
							</span>
						<?php } ?>
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