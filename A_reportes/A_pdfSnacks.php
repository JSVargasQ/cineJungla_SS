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

$sql = "SELECT  producto.cod_producto as COD_PRODUCTO,
                        factura_multiplex.COD_MULTIPLEX AS MULTIPLEX,
                        PRODUCTO.NOMBRE_PRODUCTO AS PRODUCTO,
                        SUM(CANTIDAD_PRODUCTO) AS CANTIDAD
                
                FROM
                        comida_factura,
                        factura_multiplex,
                        producto 
                WHERE
                      comida_factura.cod_factura=factura_multiplex.cod_factura AND
                      YEAR(factura_multiplex.FECHA_COMPRA)=".$_POST['año']." AND
                      MONTH(factura_multiplex.FECHA_COMPRA)=".$_POST['mes']." AND
                      comida_factura.cod_producto=producto.cod_producto
                group by COD_PRODUCTO
                order by CANTIDAD";
$result=mysqli_query($conexion,$sql);

ob_start();
?>

<div>
	

	<table class="table table-hover table-condensed" id="iddatatable">
	
		<thead style="background-color: #4f944a;color: white; font-weight: bold;">
		
			<tr>
				<?php $mes = intval($_POST['mes'])+1; ?>
				<td colspan="2">REPORTE MULTIPLEX <?php echo $nom_mul." (".$_POST['año']."/".$mes.")" ?> </td>

			</tr>

			<tr>
				<td>PRODUCTO</td>
				<td><center>CANTIDAD</center></td>
			</tr>
		</thead>
		
		<tbody>
			<?php 
			while ($mostrar=mysqli_fetch_row($result))
			{
			?>
				<tr>
					<td><?php echo $mostrar[2] ?></td>
					<td><center><?php echo $mostrar[3] ?></center></td>
					
				</tr>
			<?php 
			}
			?>
		</tbody>
		
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>PRODUCTO</td>
				<td><center>CANTIDAD</center></td>
			</tr>
		</tfoot>
	</table>
</div>


<?php
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml( ob_get_clean() );
$dompdf->render();
$dompdf->stream("ReporteSnacks.pdf");
?>