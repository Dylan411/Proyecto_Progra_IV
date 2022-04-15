<?php
class GuideModel{
    private $db;
	private $guide;

    public function __construct(){
        $this->db = Connection::conx();
        $this->guide = array();
    }

	public function getGuide(){
		$sql = "SELECT * FROM manuales";
		$result = $this->db->query($sql);
		while($row = $result->fetch_assoc()){
			$this->guide[] = $row;
		}
		return $this->guide;
	}

	public function searchGuide($name){
		$sql = "SELECT * FROM manuales WHERE nombre like '$name'";
		$result = $this->db->query($sql);
		while($row = $result->fetch_assoc()){
			$this->guide[] = $row;
		}
		return $this->guide;
	}
		
	public function getGuideId($id){
			$sql = "SELECT * FROM manuales WHERE id='$id'";
			$result = $this->db->query($sql);
			$row = $result->fetch_assoc();
			return $row;
	}

	public function getGuidePath($id){
		$sql = "SELECT ruta,nombre FROM manuales WHERE id='$id'";
		$result = $this->db->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	public function insertGuideCRUD($name,$path,$image,$description){
		try {
            $query = $this->db->query("INSERT INTO manuales (nombre,ruta,imagen,descripcion)
            VALUES ('$name','$path','Images/$image','$description')");
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
	}

    public function deleteGuide($id){
        try{
            $query = $this->db->query("DELETE from manuales WHERE id= '$id'");
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }

    public function updateGuide($id,$name,$path,$image,$description){
        try{
            $query = $this->db->query("UPDATE manuales SET  nombre='$name', ruta='$path',
            imagen='$image',descripcion='$description' WHERE id= '$id'");
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }
}
?>