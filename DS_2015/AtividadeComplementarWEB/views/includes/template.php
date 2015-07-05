<?php if ( ! defined('ABSPATH')) exit; ?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo APP_NAME ?></title>
        <!--<link rel="shortcut icon" href="<?php //echo BASE_URL ?>fonts/logo.ico" >-->
        <div class="row header">
            <div class="col-lg-offset-1 col-sm-offset-1 col-md-offset-1 col-xs-offset-1">
                <img src="<?php echo 'http://localhost/AtividadeComplementarWEB/fonts/logo2.gif'; ?>" width="90%" />
            </div>
        </div>
        <!-- Bootstrap -->
        <link href="<?php echo BASE_URL; ?>css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <!-- Atividades complementares custom -->
        <link href="<?php echo BASE_URL; ?>css/atividades.css" rel="stylesheet">
        <!-- jQuery UI -->
        <link href="<?php echo BASE_URL; ?>js/jquery-ui-1.11.4.datapicker/jquery-ui.min.css" rel="stylesheet">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo BASE_URL; ?>js/bootstrap/bootstrap.min.js"></script>
        <!-- jQuery UI DataPicker -->
        <script src="<?php echo BASE_URL; ?>js/jquery-ui-1.11.4.datapicker/external/jquery/jquery.js"></script>
        <script src="<?php echo BASE_URL; ?>js/jquery-ui-1.11.4.datapicker/jquery-ui.min.js"></script>
        <script src="<?php echo BASE_URL; ?>js/jquery-ui-1.11.4.datapicker/i18n/datepicker-pt-BR.js"></script>
        <!-- Masked Input -->
        <script src="<?php echo BASE_URL; ?>js/masked_input/jquery.maskedinput.min.js"></script>
        <!-- Numeric -->
        <script src="<?php echo BASE_URL; ?>js/numeric/jquery.numeric.min.js"></script>
    </head>
    <body>
        <div class="row">
            <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2">
            <?php 
                if (isset($menus)) {
                    echo '<div class="sidebar-page">';
                    echo '<div class="list-group">';
                    foreach ($menus as $menu) {
                        echo '<a href="' . $menu['action'] . '" class="list-group-item ' . $menu['active'] . '">' . $menu['value'] . '</a>';
                    }
                    echo '</div>';
                    echo '</div>';
                    
                    unset($menus);
                }    
            ?>
            </div>
            
            <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                <div class="main-page">
                		<?php
												if (isset($alert) && !empty($alert)) { ?>
														<div class="row">
															<div class=" <?php echo 'alert alert-' . $alert['type']; ?> alert-dismissible col-xs-9 col-lg-9 col-md-9 col-sm-9" role="alert">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong> <?php echo $alert['message']; ?> </strong>
															</div>
														</div>
										<?php } ?>
                    <?php require $main_page; ?>
                </div> <!-- .main-page (header.php) -->
            </div>
        </div>
    </body>
    
    <footer>
        <div id="footer" class="row footer">
            <div class="col-lg-offset-1 col-lg-9 col-sm-offset-1 col-sm-9 col-md-offset-1 col-md-9 col-xs-offset-1 col-xs-9">
                <p align="center" class="muted credit"> ©2015 - <?php echo date("Y"); ?>. Universidade Federal de Pelotas. </p>
                <p align="center" class="muted credit"> Desenvolvido por  <a href="https://www.facebook.com/AlexBorges85">Alex Borges</a>, <a href="https://www.facebook.com/bruno.giacobopinto">Bruno Pinto</a>, <a href="https://www.facebook.com/lucas.barrosbonine">Lucas Bonine</a>, <a href="https://www.facebook.com/mateus.noremberg">Mateus Noremberg</a>, <a href="https://www.facebook.com/natalia.darley">Natália Darley</a> and <a href="https://www.facebook.com/pauloeffernandes">Paulo Fernandes</a>.</p>
            </div>
        </div>
    </footer>
    
</html>
