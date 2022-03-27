<?php
class Software
{   
    private $db;
	private $software;

    public function __construct(){
        $this->db = Connection::conx();
        $this->software = array();
    }

	public function getSoftware(){
		$sql = "SELECT * FROM software";
		$result = $this->db->query($sql);
		while($row = $result->fetch_assoc()){
			$this->software[] = $row;
		}
		return $this->software;
	}
		
	public function getSoftwareId($id){
			$sql = "SELECT * FROM software WHERE id='$id'";
			$result = $this->db->query($sql);
			$row = $result->fetch_assoc();
			return $row;
	}	
} 