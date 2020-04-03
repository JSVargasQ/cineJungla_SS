<?php 
	class conectar{
		public function conexion(){
			$conexion=mysqli_connect('localhost:3308',
									'root',
									'1234',
									'cinejunglabd');
   		mysqli_set_charset($conexion, "utf8");  /*Agregar esta linea */
			return $conexion;
		}
	}


 ?>