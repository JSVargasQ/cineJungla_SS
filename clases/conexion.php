<?php 
	class conectar{
		public function conexion(){
			$conexion=mysqli_connect('localhost:3306',
									'root',
									'1234',
									'cine_jungla');
   		mysqli_set_charset($conexion, "utf8");  /*Agregar esta linea */
			return $conexion;
		}
	}


 ?>