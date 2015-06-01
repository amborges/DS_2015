<?php 
    // Configrações gerais da aplicação
    require_once '../config.php';
    
    // Carrega o erro 403
    require_once ABSPATH . '/controllers/error_controller.php';
    
    $controller = new ErrorController();
    $controller->forbidden();