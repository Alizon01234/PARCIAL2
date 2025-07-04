<?php
require_once 'model/conexion.php';

  $controller = 'usuario';
// Todo esta lógica Controller
if(!isset($_REQUEST['c']))
{
    //Llamado de la página principal
    require_once "controller/$controller.controller.php";
    $controller = ucwords($controller) . 'controller';
    $controller = new $controller;
    $controller->Index();
}
else
{
    // Obtiene el controlador a cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'IndexPage';    
    // Instancia el controlador
    require_once "controller/$controller.controller.php";
    $controller = ucwords($controller) . 'controller';
    $controller = new $controller;    
    // Llama la accion
    call_user_func(array( $controller, $accion ) );
}
