<?php if ( ! defined('ABSPATH')) exit;

class AtividadesFunctions {
    
    public static function init_menus($user, $clicked_menu) {
        // TODO: adicionar validação para definir o menu conforme o tipo de usuário logado(parametro $user)
//        switch ($clicked_menu) {
//            case "aluno":
//                $menus = AtividadesFunctions::student_menus($clicked_menu);
//                break;
//            case "avaliador":
//                $menus = AtividadesFunctions::evaluator_menus($clicked_menu);
//                break;
//            case "coordenador":
//                $menus = AtividadesFunctions::coordinator_menus($clicked_menu);
//                break;
//            default:
//                break;
//        }
        
        if($user === "coordenador")
        	$menus = AtividadesFunctions::coordinator_menus($clicked_menu);
        else if($user === "professor")
        	$menus = AtividadesFunctions::evaluator_menus($clicked_menu);
        else
        	$menus = AtividadesFunctions::student_menus($clicked_menu);
        	
        return $menus;
    }
    
    private static function student_menus($clicked_menu) {
    	    	
        return array(
                    array('action' => BASE_URL . 'homealuno', 
                            'value' => 'Home', 
                            'active' => ($clicked_menu == 0) ? 'active' : ''),
                    array('action' =>  BASE_URL . 'atividades/importar', 
                            'value' => 'Importar atividades', 
                            'active' => ($clicked_menu == 1) ? 'active' : ''),
                    array('action' => BASE_URL . 'homealuno/cadastrar', 
                            'value' => 'Cadastrar atividade', 
                            'active' => ($clicked_menu == 2) ? 'active' : ''),
                    array('action' => BASE_URL . 'homealuno/visualizar', 
                            'value' => 'Visualizar atividades', 
                            'active' => ($clicked_menu == 3) ? 'active' : ''),
                    array('action' => BASE_URL . 'homealuno/enviar', 
                            'value' => 'Enviar para avaliação', 
                            'active' => ($clicked_menu == 4) ? 'active' : ''),
                    array('action' => BASE_URL . 'login/sair', 
                            'value' => 'Logout', 
                            'active' => '')
                );
    }
    
    private static function evaluator_menus($clicked_menu) {
        return array(
                    array('action' => BASE_URL . 'homeprofessor', 
                            'value' => 'Home', 
                            'active' => ($clicked_menu == 0) ? 'active' : ''),
                    array('action' => BASE_URL . 'homeprofessor/validar', 
                            'value' => 'Validar atividades', 
                            'active' => ($clicked_menu == 1) ? 'active' : ''),
                    array('action' => BASE_URL . 'login/sair', 
                            'value' => 'Logout', 
                            'active' => '')
                );
    }
    
    private static function coordinator_menus($clicked_menu) {
        return array(
                    array('action' => BASE_URL . 'homecoordenador', 
                            'value' => 'Home', 
                            'active' => ($clicked_menu == 0) ? 'active' : ''),
                    array('action' => BASE_URL . 'homecoordenador/novoprofessor', 
                            'value' => 'Adicionar professor', 
                            'active' => ($clicked_menu == 1) ? 'active' : ''),
                    array('action' => BASE_URL . 'homecoordenador/editarprofessor', 
                            'value' => 'Editar professor', 
                            'active' => ($clicked_menu == 2) ? 'active' : ''),
                    array('action' => BASE_URL . 'homecoordenador/memorando', 
                            'value' => 'Gerar memorando', 
                            'active' => ($clicked_menu == 3) ? 'active' : ''),
                    array('action' => BASE_URL . 'login/sair', 
                            'value' => 'Logout', 
                            'active' => '')
                );
    }
    
}
