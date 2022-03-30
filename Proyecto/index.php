<?php
    
	require_once "core/routes.php";
	require_once "config/connection.php";
	require_once "controller/softwareController.php";
	require_once "controller/UserController.php";
	$typeController = "softwareController";
	
	if(isset($_GET['c'])){
		if($_GET['c'] == "SoftwareController"){
			$typeController = "SoftwareController";
		}elseif($_GET['c'] == "UserController"){
			$typeController = "UserController";
		}else{
			$typeController = "";
		}

		$controller = loadController($_GET['c']);
		
		if(isset($_GET['a'])){
			if(isset($_GET['id'])){
				loadAction($controller, $_GET['a'], $_GET['id']);
			} else {
				loadAction($controller, $_GET['a']);
			}
			} else {
				loadAction($controller, $typeController);
			}
	
	} else {	
		
		$controller = loadController($typeController);
		$accionTmp = "index";
		$controller->$accionTmp();
	}
?>

