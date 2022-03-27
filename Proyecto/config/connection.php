<?php

class Connection
{
    public static function conx()
    {
        $connection = new mysqli("localhost", "root", "root", "proyecto");
        return $connection;
    }
}
?>