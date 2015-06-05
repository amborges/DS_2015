<?php if ( ! defined('ABSPATH')) exit; ?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo APP_NAME ?></title>
        <div class="row">
            <h1><p class="text-center">ATIVIDADES COMPLEMENTARES - WEB</p></h1>
        </div>
        <!-- Bootstrap -->
        <link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet">
        <!-- Atividades complementares custom -->
        <link href="<?php echo BASE_URL; ?>css/atividades.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
                    <?php require $main_page; ?>
                </div> <!-- .main-page (header.php) -->
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo BASE_URL; ?>js/bootstrap.min.js"></script>
    </body>
    <!--
    <footer>
        <h1>FOOTER</h1>
    </footer>
    -->
</html>