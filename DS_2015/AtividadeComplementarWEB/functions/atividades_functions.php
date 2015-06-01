<?php if ( ! defined('ABSPATH')) exit;

class AtividadesFunctions {
    
    public static function init_menus($user, $clicked_menu) {
        // TODO: adicionar validação para definir o menu conforme o tipo de usuário logado(parametro $user)
//        switch ($clicked_menu) {
//            case "aluno":
                $menus = AtividadesFunctions::student_menus($clicked_menu);
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
        
        return $menus;
    }
    
    private static function student_menus($clicked_menu) {
        return array(
                    array('action' => '#', 
                            'value' => 'Home', 
                            'active' => ($clicked_menu == 0) ? 'active' : ''),
                    array('action' => '#', 
                            'value' => 'Importar atividades', 
                            'active' => ($clicked_menu == 1) ? 'active' : ''),
                    array('action' => '#', 
                            'value' => 'Cadastrar atividades', 
                            'active' => ($clicked_menu == 2) ? 'active' : ''),
                    array('action' => '#', 
                            'value' => 'Visualizar atividades', 
                            'active' => ($clicked_menu == 3) ? 'active' : ''),
                    array('action' => '#', 
                            'value' => 'Enviar para avaliação', 
                            'active' => ($clicked_menu == 4) ? 'active' : ''),
                    array('action' => '#', 
                            'value' => 'Logout', 
                            'active' => '')
                );
    }
    
    private static function evaluator_menus($clicked_menu) {
        return array(
                    array('action' => '#', 
                            'value' => 'Home', 
                            'active' => ($clicked_menu == 0) ? 'active' : ''),
                    array('action' => '#', 
                            'value' => 'Validar atividades', 
                            'active' => ($clicked_menu == 1) ? 'active' : ''),
                    array('action' => '#', 
                            'value' => 'Logout', 
                            'active' => '')
                );
    }
    
    private static function coordinator_menus($clicked_menu) {
        return array(
                    array('action' => '#', 
                            'value' => 'Home', 
                            'active' => ($clicked_menu == 0) ? 'active' : ''),
                    array('action' => '#', 
                            'value' => 'Adicionar professor', 
                            'active' => ($clicked_menu == 1) ? 'active' : ''),
                    array('action' => '#', 
                            'value' => 'Editar professor', 
                            'active' => ($clicked_menu == 2) ? 'active' : ''),
                    array('action' => '#', 
                            'value' => 'Enviar memorando', 
                            'active' => ($clicked_menu == 3) ? 'active' : ''),
                    array('action' => '#', 
                            'value' => 'Logout', 
                            'active' => '')
                );
    }
    
}