<?php

/**
 * AtividadesMVC - Gerencia Models, Controllers e Views
 *
 * @author Paulo
 */
class AtividadesMVC {
    
    /*
     * Receberá o valor do controlador (Vindo da URL: exemplo.com/controlador/)
     */
    private $controller;
    
    /*
     * Receberá o valor da ação (Vindo da URL: exemplo.com/controlador/acao)
     */
    private $action;
    
    /*
     * Receberá um array com os parâmetros (Vindo da URL: exemplo.com/controlador/acao/param1/param2)
     */
    private $parameters;
    
    /**
     * Construtor da classe
     * 
     * Obtém os valores do controlador, ação e parâmetros
     * Configura o controlador e a ação
     */
    public function __construct() {
        // Obtém os valores do controlador, ação e parâmetros da URL
        // e configura as propriedades da classe
        $this->get_url_data();
        
        // Verifica se o controlador existe.
        // Caso não exista, chama o método index() do controlador padrão (controllers/login_controller.php)
        if ( ! $this->controller || $this->controller === "_controller") {
        																		//corrige um erro de load default
            $this->load_default_controller();
            return;
        }
        
        $controller_file = ABSPATH . '/controllers/' . $this->controller . '.php';
        
        // Se o arquivo do controller não existir, exibir 404
        if ( ! file_exists($controller_file)) {
            $this->load_not_found_page();
            return;
        }
        
        // Inclui o arquivo do controller
        require_once $controller_file;
        
        // Remove os caracteres inválidos do nome do controller para o nome da classe
        $this->controller = preg_replace('/[^a-zA-Z]/i', '', $this->controller);
        
        // Se a classe do controller não existir, exibir 404 
        if ( ! class_exists($this->controller)) {
            $this->load_not_found_page();
            return;
        }
        
        // Cria o objeto da classe controller enviando os parâmetros
        $this->controller = new $this->controller($this->parameters);
        
        // Se o método indicado existir, execute-o, caso contrário executar o método index()
        if (method_exists($this->controller, $this->action)) {
            $this->controller->{$this->action}($this->parameters);
            return;
        } else if ( ! $this->action && method_exists($this->controller, 'index')) {
            $this->controller->index($this->parameters);
            return;
        }
        
        // Página não encontrada
        $this->load_not_found_page();
        return;
    }
    
    /**
     * Obtém parâmetros do $_GET['path']
     */
    
    private function get_url_data() {
        // Verifica se o parâmetro path foi enviado
        
        //if (filter_input(INPUT_GET, 'path') !== NULL) {
        if($_GET['path'] !== NULL){
            // Captura o valor de $_GET['path']
            //$informed_path = filter_input(INPUT_GET, 'path');
            $informed_path = $_GET['path'];
            // Limpa os dados
            $clean_path = filter_var(rtrim($informed_path), FILTER_SANITIZE_URL);
            // Cria um array de parâmetros
            $path = explode('/', $clean_path); //0 => null; 1=>AtividadeComplementarWEB
            																	 //2 => controller; 3=> acao;
            																	 //4 em diante => parametros
            // Configura as propriedades
            //$this->controller = chk_array($path, 0) . '_controller';
            $this->controller = chk_array($path, 2) . '_controller';
            //$this->action = chk_array($path, 1);
            $this->action = chk_array($path, 3);
            //if (chk_array($path, 2)) {
            if (chk_array($path, 4)) {
            		$params = array(); //passa como array todos os parametros da URL
            		for($i = 4; $i < sizeof($path); $i++)
            			$params[] = $path[$i];
                //$this->parameters = array_values($path[2]);
                $this->parameters = array_values($params);
            }
        }
    }
    
    // Carrega o controller padrão - login_controller.php
    private function load_default_controller() {
        // Adiciona o controller padrão
        require_once ABSPATH . '/controllers/login_controller.php';

        // Cria o objeto LoginController
        $this->controller = new LoginController();
        $this->controller->index();
    }
    
    private function load_not_found_page() {
        require_once ABSPATH . '/controllers/error_controller.php';
        
        $this->controller = new ErrorController();
        $this->controller->not_found();
    }
    
}
