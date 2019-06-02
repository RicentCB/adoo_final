<?php
    //Controller
    require_once "controller/category.controller.php";
    require_once "controller/clients.controller.php";
    require_once "controller/product.controller.php";
    require_once "controller/sales.controller.php";
    require_once "controller/users.controller.php";
    //Model
    require_once "model/category.model.php";
    require_once "model/clients.model.php";
    require_once "model/product.model.php";
    require_once "model/sales.model.php";
    require_once "model/users.model.php";

    require_once "controller/template.contoller.php";
    $plantilla = new ControllerTemplate();
    $plantilla -> ctrTemplate();
