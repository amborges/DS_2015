<?php
    // Evita que usuários acesse este arquivo diretamente
    if ( ! defined('ABSPATH')) exit;
    
    // Inicia a sessão
    session_start();
    
    // Verifica se está no modo para debugar
    if (defined('DEBUG') && DEBUG === true) {
        // Mostra todos os erros
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    } else {
        // Esconde todos os erros
        error_reporting(0);
        ini_set("display_errors", 0);
    }
    
    // Funções globais
    require_once ABSPATH . '/functions/global_functions.php';

    // Carrega a aplicação
    $atividades_mvc = new AtividadesMVC();