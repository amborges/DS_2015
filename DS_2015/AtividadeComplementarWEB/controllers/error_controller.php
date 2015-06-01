<?php

/**
 * Description of error_controller
 *
 * @author Paulo
 */
class ErrorController {
    
    public function index() {
        
    }
    
    public function forbidden() {
        $main_page = ABSPATH . '/views/errors/403.php';
        
        require ABSPATH . '/views/includes/template.php';
    }
    
    public function not_found() {
        $main_page = ABSPATH . '/views/errors/404.php';
        
        require ABSPATH . '/views/includes/template.php';
    }
    
}