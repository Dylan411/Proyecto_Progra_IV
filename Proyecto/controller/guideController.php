<?php
class GuideController
{

    public function __construct()
    {
        require_once "model/GuideModel.php";
        require_once "model/UserModel.php";
        require_once "controller/userController.php";
    }

    public function index()
    {
        $guide = new GuideModel();
        $userController = new UserController();
        $userModel = new User();
        if(isset($_SESSION['nombreUsuario'])){
            $result["Role"] = $userModel->getType($userController->getCurrentUser());
        }
        $data["guide"] = $guide->getGuide();
        require_once "view/guideIndex.php";
    }

    public function showOneItem($id)
    {
        $userController = new UserController();
        $userModel = new User();
        $guide = new GuideModel();
        if(isset($_SESSION['nombreUsuario'])){
            $result["Role"] = $userModel->getType($userController->getCurrentUser());
        }
        $data["guide"] = $guide->getGuideId($id);
        require_once "view/guide.php";
    }

    public function searchGuide($name)
    {
        $guide = new GuideModel();
        $userController = new UserController();
        $userModel = new User();
        if(isset($_SESSION['nombreUsuario'])){
            $result["Role"] = $userModel->getType($userController->getCurrentUser());
        }
        $data["guide"] = $guide->searchGuide($name);
        require_once "view/guideIndex.php";
    }

    public function showOneItemPDF($id)
    {
		$guide = new GuideModel();
        $data["path"] = $guide->getGuidePath($id);
        $file = "D:/xamp/htdocs/Git/Proyecto/".$data["path"]["ruta"];
		echo "<script>console.log( 'Excepción capturada: ".  $file ."' );</script>";
        $fp = fopen($file, "r");
        header("Cache-Control: maxage=1");
        header("Pragma: public");
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=" . $data["path"]["nombre"] . ".pdf");
        header("Content-Description: PHP Generated Data");
        header("Content-Transfer-Encoding: binary");
        header('Content-Length:' . filesize($file));
        ob_clean();
        flush();
        while (!feof($fp)) {
            $buff = fread($fp, 1024);
            print $buff;
        }
        exit;

    }

    public function guideCRUD(){
        $userController = new UserController();
        $userModel = new User();
        $guide = new GuideModel();
        if(isset($_SESSION['nombreUsuario'])){
            $result["Role"] = $userModel->getType($userController->getCurrentUser());
        }
        $data["guide"] = $guide->getGuide();
        require_once "view/guideCRUD.php";
    }

    public function insertGuide(){
        $guide = new GuideModel();
        $userModel = new User();
        $userController = new UserController();
        $nameForm = $_POST['nombre'];
        $pathForm = $_POST['ruta'];
        $imageForm = $_POST['imagen'];
        $descriptionForm = $_POST['descripcion'];
        $guide->insertGuideCRUD($nameForm,$pathForm,$imageForm,$descriptionForm);
        if(isset($_SESSION['nombreUsuario'])){
            $result["Role"] = $userModel->getType($userController->getCurrentUser());
        }
        $data["guide"] = $guide->getGuide();
        require_once "view/guideCRUD.php";
    }

    public function deleteGuide($id){
        $guide = new GuideModel();
        $userController = new UserController();
        $userModel = new User();
        $guide->deleteGuide($id);
        if(isset($_SESSION['nombreUsuario'])){
            $result["Role"] = $userModel->getType($userController->getCurrentUser());
        }
        $data["guide"] = $guide->getGuide();
        require_once "view/guideCRUD.php";
    }

    public function updateGuide(){
        $guide = new GuideModel();
        $userController = new UserController();
        $userModel = new User();
        foreach ($_POST['id'] as $id ) {
            $idForm = $_POST['id'][$id];
            $nameForm = $_POST['nombre'][$id];
            $pathForm = $_POST['ruta'][$id];
            $imageForm = $_POST['imagen'][$id];
            $descriptionForm = $_POST['descripcion'][$id];
            $guide->updateGuide($idForm,$nameForm,$pathForm,$imageForm,$descriptionForm);
        }
        if(isset($_SESSION['nombreUsuario'])){
            $result["Role"] = $userModel->getType($userController->getCurrentUser());
        }
        $data["guide"] = $guide->getGuide();
        require_once "view/guideCRUD.php";
    }
}
