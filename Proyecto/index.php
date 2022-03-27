<?php
    require_once "config/config.php";
	require_once "core/routes.php";
	require_once "config/connection.php";
	require_once "controller/softwareController.php";
	
	if(isset($_GET['c'])){

		$controller = loadController($_GET['c']);
		
		if(isset($_GET['a'])){
			if(isset($_GET['id'])){
				echo"tiene id";
				loadAction($controller, $_GET['a'], $_GET['id']);
			} else {
				loadAction($controller, $_GET['a']);
			}
			} else {
				loadAction($controller, PRINCIPAL_ACTION);
			}
	
	} else {	
		
		$controller = loadController(PRINCIPAL_CONTROLLER);
		$accionTmp = PRINCIPAL_ACTION;
		$controller->$accionTmp();
	}
?>