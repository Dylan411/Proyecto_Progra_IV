<?php
    class SoftwareController {

		private $view;
		
		public function __construct(){
			require_once "model/softwareModel.php";
			require_once "model/UserModel.php";
			require_once "controller/userController.php";
		}
		
		public function index(){
			$this->view = "index";
			$id= '-1';
			$this->checkLogin($id);
		}

		public function logout(){	
			$userController = new UserController();
			$userController->closeSession();
			$this->view = "logout";
			$this->checkLogin($id);
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

		public function showView($id){
			$software = new software();
			$userModel = new User();
			$userController = new UserController();
			
			$result["test"] = "";
			$result["test"] = $userModel->getType($_SESSION['nombreUsuario']);

			switch ($this->view) {
				case 'index':
					$data["software"] = $software->getSoftware();
					require_once "view/softwareIndex.php";
					break;
				case 'showOneItem':
					$data["software"] = $software->getSoftwareId($id);
					require_once "view/software.php";
					break;
				
				case 'showSoftwareCRUD':
					require_once "view/softwareCRUD.php";
					break;

				case 'showUserCRUD':
					require_once "view/userCRUD.php";
					break;
					
				case 'logout':
					$data["software"] = $software->getSoftware();
					require_once "view/softwareIndex.php";
					break;

				default:
					# code...
					break;
			}
		}
		public function checkLogin($id){
			$userModel = new User();
			$userController = new UserController();
			$software = new software();
			try {
				if(isset($_SESSION['nombreUsuario'])){
					$this->showView($id);
				}elseif(isset($_POST['username']) && isset($_POST['password'])){
					$userForm = $_POST['username'];
					$passForm = $_POST['password'];
					if($userModel->userExistsLogin($userForm, $passForm)){
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
					$this->showView($id);
				}
			} catch (Exception $th) {
				echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
			}
		}

		public function signup(){
			$userModel = new User();
			$software = new software();
			$userController = new UserController();
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
				$userController->setCurrentUser($userForm);
				$data["software"] = $software->getSoftware();
				$result["test"] = "";
				$result["test"] = $userModel->getType($_SESSION['nombreUsuario']);
				require_once "view/softwareIndex.php";
			}
		}
	}
?>