<?php

/**
 * Description of atividades_controller
 *
 * @author Paulo
 */
class AtividadesController {
    
    public function index() {
        redirect('atividades/importar');
    }
    
    public function importar() {
        require_once ABSPATH . '/functions/atividades_functions.php';
        $menus = AtividadesFunctions::init_menus(null, 1);
        
        $main_page = ABSPATH . '/views/importar_atividade_page.php';
        
        require ABSPATH . '/views/includes/template.php';
    }
    
    public function editar() {
        require_once ABSPATH . '/functions/atividades_functions.php';
        $menus = AtividadesFunctions::init_menus(null, 1);
        
        // TODO: buscar as atividades do xml convertido
        $atividades = array(
                        array('id' => 1,
                                'descricao' => 'Atividade 001', 
                                'grande_area' => 'Grande Área 001',
                                'categoria' => 'Categoria 001',
                                'horas' => '57.2',
                                'data_inicial' => '03/02/2015',
                                'data_final' => ''),
                        array('id' => 2,
                                'descricao' => 'Atividade 002', 
                                'grande_area' => 'Grande Área 002',
                                'categoria' => 'Categoria 002',
                                'horas' => '157.2',
                                'data_inicial' => '01/05/2015',
                                'data_final' => '02/05/2015'),
                        array('id' => 3,
                                'descricao' => 'Atividade 003', 
                                'grande_area' => 'Grande Área 003',
                                'categoria' => 'Categoria 003',
                                'horas' => '17.2',
                                'data_inicial' => '01/01/2015',
                                'data_final' => ''),
                        array('id' => 4,
                                'descricao' => 'Atividade 004', 
                                'grande_area' => 'Grande Área 001',
                                'categoria' => 'Categoria 006',
                                'horas' => '81.9',
                                'data_inicial' => '09/11/2014',
                                'data_final' => '12/11/2014')
                    );
        
        // TODO: buscar as grandes áreas do banco de dados
        $grandes_areas = array(
                        array('seqGA' => '1',
                                'nomeGA' => 'Grande Área 001'),
                        array('seqGA' => '2',
                                'nomeGA' => 'Grande Área 002')
                    );
        
        // TODO: buscar as categorias do banco de dados
        $categorias = array(
                        array('seqCategoria' => '1',
                                'nomeCategoria' => 'Categoria 001'),
                        array('seqCategoria' => '2',
                                'nomeCategoria' => 'Categoria 002'),
                        array('seqCategoria' => '2',
                                'nomeCategoria' => 'Categoria 003')
                    );
        
        $main_page = ABSPATH . '/views/importar_atividade_edicao_page.php';
        
        require ABSPATH . '/views/includes/template.php';
    }
    
    public function salvar() {
        redirect('home');
    }
    
}
