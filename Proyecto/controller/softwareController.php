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
			$software = new software();
			if(isset($_SESSION['nombreUsuario'])){
				$result["Role"] = $userModel->getType($userController->getCurrentUser());
			}
			$data["software"] = $software->getSoftware();
			require_once "view/softwareCRUD.php";
		}

		public function insertSoftware(){
			$software = new software();
			$nameForm = $_POST['nombre'];
			$descriptionForm = $_POST['descripcion'];
			$idiomaForm = $_POST['idioma'];
			$desarolladorForm = $_POST['desarollador'];
			$imagenForm = $_POST['imagen'];
			$anioCreacionForm = $_POST['anioCreacion'];
			$tamanioForm = $_POST['tamanio'];
			$novedadesForm = $_POST['novedades'];
			$categoriaForm = $_POST['categoria'];
			$software->insertSoftware('21',$nameForm,$descriptionForm,$idiomaForm,$desarolladorForm,$imagenForm,$anioCreacionForm,$tamanioForm,$novedadesForm,$categoriaForm);
			if(isset($_SESSION['nombreUsuario'])){
				$result["Role"] = $userModel->getType($userController->getCurrentUser());
			}
			$data["software"] = $software->getSoftware();
			require_once "view/softwareCRUD.php";
		}
		
		public function deleteSoftware($id){
			$software = new software();
			$userController = new UserController();
			$userModel = new User();
			$software->deleteSoftware($id);
			$result["Role"] = $userModel->getType($userController->getCurrentUser());
			$data["software"] = $software->getSoftware();
			require_once "view/softwareCRUD.php";
		}

		public function updateSoftware(){
			$software = new software();
			$userController = new UserController();
			$userModel = new User();
			foreach ($_POST['id'] as $id ) {
				$id= $_POST["id"][$id];
				$Nombre = $_POST["nombre"][$id];
				$Descripcion = $_POST["descripcion"][$id];
				$Idioma = $_POST["idioma"][$id];
				$Desarollador = $_POST["desarollador"][$id];
				$Imagen = $_POST["imagen"][$id];
				$Año = $_POST["anioCreacion"][$id];
				$Tamaño = $_POST["tamanio"][$id];
				$Novedades = $_POST["novedades"][$id];
				$Categoria = $_POST["categoria"][$id];
				$software->updateSoftware($id,$Nombre,$Descripcion,$Idioma,$Desarollador,$Imagen,$Año,$Tamaño,$Novedades,$Categoria);
			}
			$result["Role"] = $userModel->getType($userController->getCurrentUser());
			$data["software"] = $software->getSoftware();
			require_once "view/softwareCRUD.php";
		}
	}
?>