<?php
    class Connection {
        private $conx;

        public function __construct() {
            $this->conx   = new mysqli("localhost", "root", "root", "proyecto");/*ip or name of the instance, username, passsword ,name of the database */
        }
    
        public function execute(string $statement) {
            $query = $this->conx->query($statement);
            $result = [];
            $i = 0;
            while ($row = $query->fetch_array(MYSQLI_BOTH)) {
                $result[$i++] = $row;
            }
            $query->free();
            return $result;
        }
    }

?>