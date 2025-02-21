<?php

// controlers
require_once "controllers/template.controller.php";
require_once "controllers/login.controller.php";
require_once "controllers/users.controller.php";
require_once "controllers/files.controller.php";

// models
require_once "models/user.models.php";
require_once "models/files.models.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();