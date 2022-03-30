<?php
class User{   
    private $db;
	private $username;
    

    public function __construct(){
        $this->db = Connection::conx();
    }

    public function getError(){
        return $this->error;
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

    public function setUser($user){
        try {
            $query = $this->db->query("SELECT * FROM usuarios WHERE nombreUsuario= '$user'");
            
            foreach ($query as $currentUser) {
                $this->username = $currentUser['nombreUsuario'];
            }
        } catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }
} 