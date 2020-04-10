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


<div align="center">
<br>
<h2>REPORTE VENTAS MULTIPLEX <?php echo $nom_mul." (".$_POST['año'].")" ?></h2>
<br>
	<table style="margin: auto; border-color: #4f944a; border-collapse:collapse" border=1 class="table table-hover table-condensed" id="iddatatable">
	
		<thead style="margin: auto; border-color: #4f944a; border-collapse:collapse">

			<tr>
				<td><center>MES</center></td>
				<td><center>VENTA SNACKS</center></td>
				<td><center>VENTA BOLETOS</center></td>
				<td><center>VENTA TOTAL</center></td>
			</tr>
		</thead>
		
		<tbody >
			<?php 
			$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
			
			$total1 = 0;
			$total2 = 0;
			
			for($i = 0; $i < 12; $i++)
			{

				$nMes = $i+1;

				$sql = "SELECT 
							cod_multiplex as MULTIPLEX, SUM(TOTAL_PRODUCTOS), SUM(TOTAL_SILLA)
					  FROM 
							mostrar_facturas_ventas
					  WHERE 
							YEAR(FECHA_COMPRA)=".$_POST['año']." AND
							MONTH(FECHA_COMPRA)=".$nMes." 
			  
					  GROUP BY MULTIPLEX;";
			  
					  $result=mysqli_query($conexion,$sql);
					  $mostrar=mysqli_fetch_row($result);
					      
					      $total1 = $total1 + intval($mostrar[1]);
					      $total2 = $total2 + intval($mostrar[2]);
			?>
				<tr style="border-color: #4f944a; border-collapse:collapse">
					<td><center><?php echo $meses_ES[$i] ?></center></td>
					<td><center><?php echo intval($mostrar[1]) ?></center></td>
					<td><center><?php echo intval($mostrar[2]) ?></center></td>
					<td><center><?php echo intval($mostrar[1])+intval($mostrar[2]) ?></center></td>
				</tr>
			<?php 
			}
			?>
		</tbody>
		
		<tfoot style="margin: auto; border-color: #4f944a; border-collapse:collapse">
			<tr>
				<td><center>MES</center></td>
				<td><center>VENTA SNACKS</center></td>
				<td><center>VENTA BOLETOS</center></td>
				<td><center>VENTA TOTAL</center></td>
			</tr>
			<tr>
				<td width=100px><center>TOTAL</center></td>
				<td width=100px><center><?php echo $total1 ?></center></td>
				<td width=100px><center><?php echo $total2 ?></center></td>
				<td width=100px><center><?php echo $total1 + $total2 ?></center></td>
			</tr>
		</tfoot>
	</table>
	<br><br><p align="right"><?php $fecha = new DateTime("now", new DateTimeZone('America/Bogota')); $fecha->setTimezone(new DateTimeZone('America/Bogota')); echo $fecha->format('d-m-Y H:i:s');?></p>
</div>
</html>

<?php
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml( ob_get_clean() );
$dompdf->render();
$dompdf->stream("ReporteVentas.pdf");
?>