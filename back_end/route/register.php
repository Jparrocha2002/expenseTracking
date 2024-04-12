<?php
include "../controller/user_controller.php";

$controller = new userController();
echo $controller->registerHandler();
?>