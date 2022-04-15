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

	public function searchSoftware($name){
		$sql = "SELECT * FROM software WHERE nombre like '$name'";
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

	public function insertSoftware($id,$Nombre,$Descripcion,$Idioma,$Desarollador,$Imagen,$Año,$Tamaño,$Novedades,$Categoria){
		try {
            $query = $this->db->query("INSERT INTO software (id,nombre,descripcion,idioma,desarollador,cantidadDescargas,imagen,anioCreacion,tamanio,novedades,categoria)
            VALUES ('$id','$Nombre','$Descripcion','$Idioma','$Desarollador','0','$Imagen','$Año','$Tamaño','$Novedades','$Categoria')");
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
	}

	public function deleteSoftware($id){
        try{
            $query = $this->db->query("DELETE from software WHERE id= '$id'");
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }

	public function updateSoftware($id,$Nombre,$Descripcion,$Idioma,$Desarollador,$Imagen,$Año,$Tamaño,$Novedades,$Categoria){
        try{
            $query = $this->db->query("UPDATE software SET  nombre='$Nombre', descripcion='$Descripcion', idioma='$Idioma', desarollador='$Desarollador',
			imagen='$Imagen',anioCreacion='$Año',tamanio='$Tamaño',novedades='$Novedades',
            categoria='$Categoria' WHERE id= '$id'");
        }catch (Exception $th) {
            echo "<script>console.log( 'Excepción capturada: ".  $th->getMessage() ."' );</script>";
        }
    }

} 