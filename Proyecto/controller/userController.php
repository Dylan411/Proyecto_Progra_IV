<?php
    class UserController{

		public function __construct(){
            require_once "model/userModel.php";
            session_start();
        }

        public function showLogin(){
            require_once "view/Login.php";	
        }
    
        public function closeSession(){
            session_unset();
            session_destroy();
        }
        public function setCurrentUser($user){
            $_SESSION['nombreUsuario'] = $user;
        }
    
        public function getCurrentUser(){
            return $_SESSION['nombreUsuario'];
        }

        
	}
?>