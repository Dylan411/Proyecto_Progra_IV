<?php
    class UserController{

		public function __construct(){
            require_once "model/userModel.php";
            require_once "model/softwareModel.php";
            if(!isset($_SESSION)) 
            { 
                session_start(); 
            } 
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

        public function signup(){
			$userModel = new User();
			$software = new software();
			$userForm = $_POST['userName'];
			$emailForm = $_POST['email'];
			$pass1Form = $_POST['pass1'];
			$pass2Form = $_POST['pass2'];
			if($userModel->userExistsSignup($userForm)){
				$errorSignup = 'Nombre de usuario ya existe';
				require_once "view/login.php";
				echo '<script type="text/javascript"> document.querySelector("form.login").style.marginLeft = "-50%"; </script>';
				echo '<script type="text/javascript"> document.querySelector(".title-text .login").style.marginLeft = "-50%"; </script>';
				echo '<script type="text/javascript"> document.querySelector("label.signup").click(); </script>';
			}else if ($userModel->emailExistsSignup($emailForm)) {
				$errorSignup = 'Email ya existe';
				require_once "view/login.php";
				echo '<script type="text/javascript"> document.querySelector("form.login").style.marginLeft = "-50%"; </script>';
				echo '<script type="text/javascript"> document.querySelector(".title-text .login").style.marginLeft = "-50%"; </script>';
				echo '<script type="text/javascript"> document.querySelector("label.signup").click(); </script>';
			}elseif ($pass1Form <> $pass2Form) {
				$errorSignup = 'Contraseñas no coinciden';
				require_once "view/login.php";
				echo '<script type="text/javascript"> document.querySelector("form.login").style.marginLeft = "-50%"; </script>';
				echo '<script type="text/javascript"> document.querySelector(".title-text .login").style.marginLeft = "-50%"; </script>';
				echo '<script type="text/javascript"> document.querySelector("label.signup").click(); </script>';
			}else{
				$userModel->insertUser($userForm,$emailForm,$pass1Form);
				$this->setCurrentUser($userForm);
				$data["software"] = $software->getSoftware();
				$result["test"] = "";
				$result["test"] = $userModel->getType($_SESSION['nombreUsuario']);
				require_once "view/softwareIndex.php";
			}
		}

        public function showLogin(){
			require_once "view/login.php";	
		}
        
        public function logout(){	
			$software = new software();
			$this->closeSession();
			$data["software"] = $software->getSoftware();
			require_once "view/softwareIndex.php";
		}

		public function checkLogin(){
			$userModel = new User();
			$software = new software();
			try {
				if(isset($_SESSION['nombreUsuario'])){
					$result["Role"] = $userModel->getType($this->getCurrentUser());
				}elseif(isset($_POST['username']) && isset($_POST['password'])){
					$userForm = $_POST['username'];
					$passForm = $_POST['password'];
					if($userModel->userExistsLogin($userForm, $passForm)){
						$this->setCurrentUser($userForm);
						$data["software"] = $software->getSoftware();
						$result["Role"] = $userModel->getType($_SESSION['nombreUsuario']);
						require_once "view/softwareIndex.php";
					}else{
						$errorLogin = 'Nombre de usuario y/o password incorrecto';
						require_once "view/login.php";
					}
				}else{
					
				}
			} catch (Exception $th) {
				echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
			}
		}

		public function userCRUD(){
			$software = new software();
			$userModel = new User();
			$data["user"] = $userModel->getUser();
			if(isset($_SESSION['nombreUsuario'])){
				$result["Role"] = $userModel->getType($this->getCurrentUser());
			}
			require_once "view/userCRUD.php";
		}

		public function insertUser(){
			$software = new software();
			$userModel = new User();
			$userController = new UserController();
			$nameForm = $_POST['nombre'];
			$passForm = $_POST['contrasenia'];
			$emailForm = $_POST['email'];
			$tipoForm = $_POST['tipoUsuario'];
			$userModel->insertUserCRUD($nameForm,$passForm,$emailForm,$tipoForm);
			if(isset($_SESSION['nombreUsuario'])){
				$result["Role"] = $userModel->getType($userController->getCurrentUser());
			}
			$data["user"] = $userModel->getUser();
			require_once "view/userCRUD.php";
		}

		public function deleteUser($id){
			$software = new software();
			$userController = new UserController();
			$userModel = new User();
			$userModel->deleteUser($id);
			$result["Role"] = $userModel->getType($userController->getCurrentUser());
			$data["user"] = $userModel->getUser();
			require_once "view/userCRUD.php";
		}

		public function updateUser(){
			$software = new software();
			$userController = new UserController();
			$userModel = new User();
			foreach ($_POST['nombre'] as $nom ) {
				$NombreUsuario = $_POST["nombre"][$nom];
				$Contrasenia = $_POST["contrasenia"][$nom];
				$Email = $_POST["email"][$nom];
				$TipoUsuario = $_POST["tipo"][$nom];
				$userModel->updateUser($NombreUsuario,$Contrasenia,$Email,$TipoUsuario);
			}
			$result["Role"] = $userModel->getType($userController->getCurrentUser());
			$data["user"] = $userModel->getUser();
			require_once "view/userCRUD.php";
		}
	}
?>