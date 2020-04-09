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

$sql = "SELECT 
                      PELICULA,sala_cine.cod_multiplex as cod_multiplex,YEAR(FECHA) AS ANIO, MONTH(FECHA) AS MES,SUM(60-DISPONIBILIDAD) as cantidad
                FROM 
                      mostrarfunciones,sala_cine,funcion 
                WHERE 
                      mostrarfunciones.CODIGO=funcion.cod_funcion and
                      funcion.cod_sala_cine=sala_cine.cod_sala_cine AND 
                      MONTH(FECHA)=".$_POST['mes']."  AND 
                      mostrarFunciones.multiplex='".$nom_mul."' AND
                      YEAR(FECHA)=".$_POST['año']."


                      GROUP BY PELICULA
					  Order by cantidad DESC";
					  
$result=mysqli_query($conexion,$sql);

ob_start();
?>

<div>
	

	<table class="table table-hover table-condensed" id="iddatatable">
	
		<thead style="background-color: #4f944a;color: white; font-weight: bold;">
		
			<tr>
				<?php $mes = intval($_POST['mes'])+1; ?>
				<td colspan="2">REPORTE PELICULAS MULTIPLEX <?php echo $nom_mul." (".$_POST['año']."/".$mes.")" ?> </td>

			</tr>

			<tr>
				<td>PELICULA</td>
				<td><center>CANTIDAD</center></td>
			</tr>
		</thead>
		
		<tbody>
			<?php 
			while ($mostrar=mysqli_fetch_row($result))
			{
			?>
				<tr>
					<td><?php echo $mostrar[0] ?></td>
					<td><center><?php echo $mostrar[4] ?></center></td>
					
				</tr>
			<?php 
			}
			?>
		</tbody>
		
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>PELICULA</td>
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
$dompdf->stream("ReportePeliculas.pdf");
?>