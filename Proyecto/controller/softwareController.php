<?php
    class SoftwareController {
		
		public function __construct(){
			require_once "model/softwareModel.php";
			require_once "model/UserModel.php";
			require_once "controller/userController.php";
		}
		
		public function index(){
			$software = new software();
			$userController = new UserController();
			$userModel = new User();
			if(isset($_SESSION['nombreUsuario'])){
				$result["Role"] = $userModel->getType($userController->getCurrentUser());
			}
			$data["software"] = $software->getSoftware();
			require_once "view/softwareIndex.php";
		}

		public function showOneItem($id){
			$userController = new UserController();
			$userModel = new User();
			$software = new software();
			if(isset($_SESSION['nombreUsuario'])){
				$result["Role"] = $userModel->getType($userController->getCurrentUser());
			}
			$data["software"] = $software->getSoftwareId($id);
			require_once "view/software.php";
		}

		public function searchSoftware($name){
			$software = new software();
			$userController = new UserController();
			$userModel = new User();
			if(isset($_SESSION['nombreUsuario'])){
				$result["Role"] = $userModel->getType($userController->getCurrentUser());
			}
			$data["software"] = $software->searchSoftware($name);
			require_once "view/softwareIndex.php";
		}

		public function softwareCRUD(){
			$userController = new UserController();
			$userModel = new User();
			if(isset($_SESSION['nombreUsuario'])){
				$result["Role"] = $userModel->getType($userController->getCurrentUser());
			}
			require_once "view/softwareCRUD.php";
		}

		
	}
?>