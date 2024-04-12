<?php
include "../controller/user_controller.php";

$create = new userController();
echo $create->allData();
?>