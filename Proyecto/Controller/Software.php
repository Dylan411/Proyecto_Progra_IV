<?php
    require("Model/Software.php");
    $software = new Software();
    $showItemsIndex = $software->showItemsIndex();
    require("View/index.php");
    echo "sos puta";
?>