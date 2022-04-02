<?php
include_once "controller/userController.php";
    class SoftwareController {

		private $view;
		
		public function __construct(){
			require_once "model/softwareModel.php";
			require_once "model/UserModel.php";
		}
		
		public function index(){
			$this->view = "index";
			$this->checkLogin($id);
		}

		public function logout(){
			$userController = new UserController();
			$userController->closeSession();
			$software = new software();
			$data["software"] = $software->getSoftware();
			require_once "view/softwareIndex.php";
		}
		
		public function showOneItem($id){
			$this->view = "showOneItem";
			$this->checkLogin($id);
		}

		public function showLogin(){
			require_once "view/login.php";	
		}

		public function softwareCRUD(){
			$this->view = "showSoftwareCRUD";
			$this->checkLogin($id);
		}

		public function userCRUD(){
			$this->view = "showUserCRUD";
			$this->checkLogin($id);
		}

		public function checkLogin($id){
			try {
				$software = new software();
				$userController = new UserController();
				$userModel = new User();

				if(isset($_SESSION['nombreUsuario'])){
					if ($this->view == "index") {
						$data["software"] = $software->getSoftware();
						$result["test"] = "";
						$result["test"] = $userModel->getType($_SESSION['nombreUsuario']);
						require_once "view/softwareIndex.php";
					}
					if ($this->view == "showOneItem") {
						$data["software"] = $software->getSoftwareId($id);
						$result["test"] = "";
						$result["test"] = $userModel->getType($_SESSION['nombreUsuario']);
						require_once "view/software.php";
					}
					if ($this->view == "showSoftwareCRUD") {
						$result["test"] = "";
						$result["test"] = $userModel->getType($_SESSION['nombreUsuario']);
						require_once "view/softwareCRUD.php";
					}
					if ($this->view == "showUserCRUD") {
						$result["test"] = "";
						$result["test"] = $userModel->getType($_SESSION['nombreUsuario']);
						require_once "view/userCRUD.php";
					}
				}else if(isset($_POST['username']) && isset($_POST['password'])){
					$userForm = $_POST['username'];
					$passForm = $_POST['password'];
					if($userModel->userExists($userForm, $passForm)){
						$userController->setCurrentUser($userForm);
						$data["software"] = $software->getSoftware();
						$result["test"] = "";
						$result["test"] = $userModel->getType($_SESSION['nombreUsuario']);
						require_once "view/softwareIndex.php";
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