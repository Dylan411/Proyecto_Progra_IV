<?php
class User{   
    private $db;
	private $username;
    

    public function __construct(){
        $this->db = Connection::conx();
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
            echo "<script>console.log( 'Excepción capturada: ".  $result ."' );</script>";
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
} 