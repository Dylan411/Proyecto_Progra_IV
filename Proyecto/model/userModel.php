<?php
class User{   
    private $db;
	private $username;
    

    public function __construct(){
        $this->db = Connection::conx();
    }
	
    public function userExists($user,$pass){
        try {
            $query = $this->db->query("SELECT * FROM usuarios WHERE nombreUsuario= '$user'  and contrasenia= '$pass'");
            if($query->fetch_assoc()){
                return true;
            }else{
                return false;
            }
        } catch (Exception $th) {
            
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
        
    }

    public function getType($user){
        try {
            $query = $this->db->query("SELECT tipoUsuario FROM usuarios WHERE nombreUsuario= '$user'");
            $result = $query->fetch_assoc();
            return $result;
        } catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }
} 