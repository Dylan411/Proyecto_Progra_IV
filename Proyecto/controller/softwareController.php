<?php
    class SoftwareController{
		
		public function __construct(){
			require_once "model/softwareModel.php";
		}
		
		public function index(){
			$software = new software();
			$data["software"] = $software->getSoftware();
			require_once "view/softwareIndex.php";	
		}
		
		public function showOneItem($id){
			$software = new Software();
			$data["software"] = $software->getSoftwareId($id);
			require_once "view/software.php";
		}
		
	}

?>