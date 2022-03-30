<?php
	
	function loadController($controller){
		
		$nameController = $controller;
		$fileController = 'controller/'.$controller.'.php';
		
		if(!is_file($fileController)){
			
			$fileController= 'controller/'.$nameController.'.php';
			
		}
		require_once $fileController;
		$control = new $nameController();
		return $control;
	}
	
	function loadAction($controller, $action, $id = null){
		echo $action;
		
		if(isset($action) && method_exists($controller, $action)){
			if($id == null){
				$controller->$action();
				}else {
				$controller->$action($id);
			}
		}else{	
			$controller->PRINCIPAL_ACTION();
		}	
	}
?>