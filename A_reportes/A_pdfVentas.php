<?php
require_once '../assets/dompdf/autoload.inc.php';
require_once '../assets/dompdf/src/Dompdf.php';
require_once "../clases/conexion.php";
include_once '../controlador/user.php';
include_once '../controlador/user_Sesion.php';


$obj=new conectar();
$conexion=$obj->conexion();

$userSession = new UserSession();
$user = new Usuario();

$user->setUser($userSession->getCurrentUser());
$nom_mul = $user->getNomMul();

ob_start();
?>

<div>
	<table class="table table-hover table-condensed" id="iddatatable">
	
		<thead style="background-color: #4f944a;color: white; font-weight: bold;">

			<tr>
				<td colspan="2">REPORTE VENTAS MULTIPLEX <?php echo $nom_mul." (".$_POST['año'].")" ?> </td>

			</tr>

			<tr>
				<td><center>VENTA SNACKS</center></td>
				<td><center>VENTA SILLAS</center></td>
			</tr>
		</thead>
		
		<tbody>
			<?php 
			for($i = 12; $i >0; $i--){

				$sql = "SELECT 
							cod_multiplex as MULTIPLEX, SUM(TOTAL_PRODUCTOS), SUM(TOTAL_SILLA)
					  FROM 
							mostrar_facturas_ventas
					  WHERE 
							YEAR(FECHA_COMPRA)=".$_POST['año']." AND
							MONTH(FECHA_COMPRA)=".$i." 
			  
					  GROUP BY MULTIPLEX;";
			  
					  $result=mysqli_query($conexion,$sql);
					  $mostrar=mysqli_fetch_row($result);

			
			?>
				<tr>
					<td><center><?php echo $mostrar[1] ?></center></td>
					<td><center><?php echo $mostrar[2] ?></center></td>
					
				</tr>
			<?php 

			}
		
			?>
		</tbody>
		
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td><center>VENTA SNACKS</center></td>
				<td><center>VENTA SILLAS</center></td>
			</tr>
		</tfoot>
	</table>
</div>


<?php
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml( ob_get_clean() );
$dompdf->render();
$dompdf->stream("ReporteVentas.pdf");
?>