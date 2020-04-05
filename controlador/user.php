<?php 

include_once 'db.php';


class Usuario extends DB{


	private $nombre;
	private $user;
	private $cod_multiplex;
	private $tipo_usuario;



	public function existe($user,$pass){
		$md5pass =md5($pass);
		$query = $this->connect()->prepare('SELECT * FROM USUARIO WHERE USER_USUARIO = :user AND CLAVE_USUARIO=:pass');
		$query->execute(['user'=>$user,'pass'=>$md5pass]);

		if ($query->rowCount()){
			return true;

		}else{
			return false;
		}

	}

	public function setUser($user){
		$query=$this->connect()->prepare('SELECT * FROM EMPLEADO WHERE cod_usuario=:user');
		$query->execute(['user'=>$user]);

		foreach ($query as $currentuser) {
			$this->nombre=$currentuser['nombre_empleado'];
			$this->cod_multiplex=$currentuser['cod_multiplex'];
			$this->tipo_usuario=$currentuser["COD_TIPO_EMPLEADO"];
		}
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function getCodigoMul(){
		return $this->cod_multiplex;
	}
		public function getTipoUsuario(){
		return $this->tipo_usuario;
	}

}





 ?>