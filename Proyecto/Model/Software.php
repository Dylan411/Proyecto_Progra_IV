<?php
include "Connection.php";
class Software
{
    private $id;
    private $nombre;
    private $descripcion;
    private $idioma;
    private $desarollador;
    private $imagen;
    private $cantidadDescargas;
    private $anioCreacion;
    private $tamanio;
    private $novedades;
    private $categoria;

    public function showItemsIndex(string $filter = "")
    {
        $conx = new Connection();
        if ($filter == "") {
            return $conx->execute("select nombre,imagen,desarollador from software order by nombre");
        } else {
            return $conx->execute("select nombre,imagen,desarollador from software where " . $filtro . " order by nombre asc");
        }
    }

}
