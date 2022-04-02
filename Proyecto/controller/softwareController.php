<?php
include_once "controller/userController.php";
    class SoftwareController {
		
		public function __construct(){
			require_once "model/softwareModel.php";
			require_once "model/UserModel.php";
		}
		
		public function index(){
			$userModel = new User();
			$software = new software();
			$data["software"] = $software->getSoftware();
			$this->checkLogin();
			$result["test"] = "";
			$result["test"] = $userModel->getType($_SESSION['nombreUsuario']);
			require_once "view/softwareIndex.php";	
		}

		public function logout(){
			$userController = new UserController();
			$userController->closeSession();
			$software = new software();
			$data["software"] = $software->getSoftware();
			require_once "view/softwareIndex.php";
		}
		
		public function showOneItem($id){
			$userModel = new User();
			$software = new software();
			$data["software"] = $software->getSoftwareId($id);
			$this->checkLogin();
			$result["test"] = "";
			$result["test"] = $userModel->getType($_SESSION['nombreUsuario']);
			require_once "view/software.php";
		}

		public function showLogin(){
			require_once "view/login.php";	
		}

		public function checkLogin(){
			try {
				$software = new software();
				$userController = new UserController();
				$userModel = new User();

				if(isset($_SESSION['nombreUsuario'])){
					echo "<script>console.log( 'hay sesion' );</script>";
				}else if(isset($_POST['username']) && isset($_POST['password'])){
					$userForm = $_POST['username'];
					$passForm = $_POST['password'];
					if($userModel->userExists($userForm, $passForm)){
						$userController->setCurrentUser($userForm);
						
					}else{
						$errorLogin = 'Nombre de usuario y/o password incorrecto';
						require_once "view/login.php";
					}
				}else{
					require_once "view/login.php";
				}
			} catch (Exception $th) {
				echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
			}
		}
	}
?>