<?php
class User{   
    private $db;

    

    public function __construct(){
        $this->db = Connection::conx();
        $this->user = array();
    }
	
    public function userExistsLogin($user,$pass){
        try{
            $query = $this->db->query("SELECT * FROM usuarios WHERE nombreUsuario= '$user'  and contrasenia= '$pass'");
            if($query->fetch_assoc()){
                return true;
            }else{
                return false;
            }
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }
    
    public function userExistsSignup($user){
        try{
            $query = $this->db->query("SELECT * FROM usuarios WHERE nombreUsuario= '$user'");
            if($query->fetch_assoc()){
                return true;
            }else{
                return false;
            }
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }

    public function emailExistsSignup($email){
        try{
            $query = $this->db->query("SELECT * FROM usuarios WHERE email= '$email'");
            if($query->fetch_assoc()){
                return true;
            }else{
                return false;
            }
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }

    public function getType($user){
        try {
            $query = $this->db->query("SELECT tipoUsuario FROM usuarios WHERE nombreUsuario= '$user'");
            $result = $query->fetch_assoc();
            return $result;
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }

    public function insertUser($user,$email,$password){
        try {
            $query = $this->db->query("INSERT INTO usuarios (nombreUsuario,email,contrasenia,tipoUsuario)
            VALUES ('$user','$email','$password','User')");
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }

    public function getUser(){
		$sql = "SELECT * FROM usuarios";
		$result = $this->db->query($sql);
		while($row = $result->fetch_assoc()){
			$this->user[] = $row;
		}
		return $this->user;
	}

    public function insertUserCRUD($NombreUsuario,$Contrasenia,$Email,$TipoUsuario){
		try {
            $query = $this->db->query("INSERT INTO usuarios (nombreUsuario,contrasenia,email,tipoUsuario)
            VALUES ('$NombreUsuario','$Contrasenia','$Email','$TipoUsuario')");
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
	}

    public function deleteUser($user){
        try{
            $query = $this->db->query("DELETE from usuarios WHERE nombreUsuario= '$user'");
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }

    public function updateUser($NombreUsuario,$Contrasenia,$Email,$TipoUsuario){
        try{
            $query = $this->db->query("UPDATE usuarios SET  contrasenia='$Contrasenia', email='$Email',
            tipoUsuario='$TipoUsuario' WHERE nombreUsuario= '$NombreUsuario'");
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }
} 