<?php
require_once './assets/dompdf/autoload.inc.php';
require_once './assets/dompdf/src/Dompdf.php';
require_once "./clases/conexion.php";
include_once './controlador/user.php';
include_once './controlador/user_Sesion.php';


$obj=new conectar();
$conexion=$obj->conexion();

$userSession = new UserSession();
$user = new Usuario();

$user->setUser($userSession->getCurrentUser());
$nom_mul = $user->getNomMul();

$sql= " SELECT
            CODIGO_PRODUCTO, PRODUCTO, CANTIDAD
        FROM
            cantidad_almacen where MULTIPLEX = '".$nom_mul."'";
$result=mysqli_query($conexion,$sql);

ob_start();
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
		
		<tbody>
			<?php 
			while ($mostrar=mysqli_fetch_row($result))
			{
			?>
				<tr>
					<td><?php echo $mostrar[0] ?></td>
					<td><?php echo $mostrar[1] ?></td>
					<td><?php echo $mostrar[2] ?></td>
					
				</tr>
			<?php 
			}
			?>
		</tbody>
		
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>CODIGO PRODUCTO</td>
				<td>PRODUCTO</td>
				<td>CANTIDAD</td>
			</tr>
		</tfoot>
	</table>
</div>


<?php
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml( ob_get_clean() );
$dompdf->render();
$dompdf->stream("ReportePeliculas.pdf");
?>