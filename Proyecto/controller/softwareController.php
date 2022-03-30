<?php
include_once "controller/userController.php";
    class SoftwareController {
		
		public function __construct(){
			require_once "model/softwareModel.php";
		}
		
		public function index(){
			$software = new software();
			$data["software"] = $software->getSoftware();
			$this->checkLogin();
			require_once "view/softwareIndex.php";	
		}

		public function logout(){
			$userController = new UserController();
			$userController->closeSession();
			$software = new software();
			$data["software"] = $software->getSoftware();
			$this->checkLogin();
			require_once "view/softwareIndex.php";
		}
		
		public function showOneItem($id){
			$software = new Software();
			$data["software"] = $software->getSoftwareId($id);
			$this->checkLogin();
			require_once "view/software.php";
		}

		public function showLogin(){
			require_once "view/login.php";	
		}

		public function login($software){
			$data["software"] = $software->getSoftware();
			$this->checkLogin();
			include_once 'view/softwareLogout.php';	
		}

		public function checkLogin(){
			try {
				$software = new software();
				$userController = new UserController();
				$userModel = new User();

				if(isset($_SESSION['nombreUsuario'])){
					echo "<script>console.log( 'hay sesion' );</script>";
					$userModel->setUser($userController->getCurrentUser());
				}else if(isset($_POST['username']) && isset($_POST['password'])){
					
					$userForm = $_POST['username'];
					$passForm = $_POST['password'];
					if($userModel->userExists($userForm, $passForm)){
						$userController->setCurrentUser($userForm);
						$userModel->setUser($userForm);
						$this->login($software);
					}else{
						$errorLogin = 'Nombre de usuario y/o password incorrecto';
						include_once 'view/login.php';
					}
				}else{
					//echo "login";
					include_once 'view/login.php';
				}
				
			} catch (Exception $th) {
				echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
			}
			
		}
		

	}

?>