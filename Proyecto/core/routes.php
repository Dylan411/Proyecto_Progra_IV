<?php
	
	function loadController($controller){
		
		$nameController = $controller;
		$fileController = 'controller/'.$controller.'.php';
		
		if(!is_file($fileController)){
			
			$fileController= 'controller/'.PRINCIPAL_CONTROLLER.'.php';
			
		}
		require_once $fileController;
		$control = new $nameController();
		return $control;
	}
	
	function loadAction($controller, $action, $id = null){
		echo $action;
		
		if(isset($action) && method_exists($controller, $action)){
			echo "funko";
			if($id == null){
				$controller->$action();
				echo "funko2";
				}else {
				$controller->$action($id);
				echo "funko3";
			}
		}else{
			echo "no funko " ;	
			$controller->PRINCIPAL_ACTION();
			echo $controller;
		}	
	}
?>