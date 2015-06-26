<?php if ( ! defined('ABSPATH')) exit;

    /**
     * Verifica se a chave existe em um array e se ela possui algum valor. 
     * 
     * @param array $array O array
     * @param string $key A chave do array
     * @return string|null O valor da chave do array ou nulo
     */
    function chk_array($array, $key) {
        // Verifica se a chave existe no array
        if (isset($array[$key]) && ! empty($array[$key])) {
            // Retorna o valor da chave
            return $array[$key];
        }
        
        // Retorna nulo por padrão 
        return null;
    }
    
    /**
     * Função para carregar as classes padrões automaticamente
     * 
     * @see http://php.net/manual/pt_BR/function.autoload.php  
     */
    function __autoload($class_name) {
        $file = ABSPATH . '/classes/' . $class_name . '.php';
        
        if ( !file_exists($file)) {
            // Carrega o erro 404
            require_once ABSPATH . '/controllers/error_controller.php';
            $controller = new ErrorController();
            $controller->not_found();
            
            return;
        }
        
        require_once $file;
    }
    
    /**
     * Redireciona para a url informada no parâmetro
     * 
     * @param type $page_uri
     * @return type
     */
    function redirect ($page_uri = null) {
        // Verifica se a URL da HOME está configurada
		if ( defined('BASE_URL') ) {
			// Configura a URL de login
			$login_uri  = BASE_URL . $page_uri;
			
			// A página em que o usuário estava
			$_SESSION['goto_url'] = urlencode(filter_input(INPUT_SERVER, 'REQUEST_URI'));
			
			// Redireciona
			echo '<meta http-equiv="Refresh" content="0; url=' . $login_uri . '">';
			echo '<script type="text/javascript">window.location.href = "' . $login_uri . '";</script>';
		}
		
		return;
    }
    
    /**
     * Recebe uma data no formato string de mm/dd/yy
     * e retorna no formato yy-mm-dd
     * formato de entrada de data no banco de dados mysql
     * 
     * @param string 
     * @return string
     */
    function adjustData($d){
			$d = explode("/", $d);
			$d = $d[2] ."-". $d[1] ."-". $d[0];
			return $d;
		}
		
		function invertAdjustData($d){
			$d = explode("-", $d);
			$d = $d[2] ."/". $d[1] ."/". $d[0];
			return $d;
		}
