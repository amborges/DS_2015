<!-- Mensagens de alerta / erro / sucesso -->
<?php
    if (isset($error) && !empty($error)) {
        echo '<div class="row">';
        echo '<div class="alert alert-'. $error['type'] . ' alert-dismissible col-xs-9 col-lg-9 col-md-9 col-sm-9" role="alert">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        echo '<strong>' . $error['message'] . '</strong>';
        echo '</div>';
        echo '</div>';
        unset($error);
    }
?>
<div class="row">
    <form class="form-horizontal" action="<?php echo BASE_URL; ?>login/logar" method="post">
        <!-- Matrícula / Siape -->
        <div class="form-group">
            <label for="matricula" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Matrícula / Siape:</label>
            <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
                <input id="matricula" name="matricula" type="text" required="true" class="form-control" maxlength="40"/>
            </div>                         
        </div>

        <!-- Senha -->
        <div class="form-group">
            <label for="senha" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Senha:</label>
            <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
                <input id="senha" name="senha" type="password" required="true" class="form-control" maxlength="256" />
            </div>
        </div>

        <!-- Botões - Logar e Cadastrar -->
        <div class="form-group">                    
            <button class="col-lg-offset-5 btn btn-default" type="submit">Logar</button>
            <a href="<?php echo BASE_URL; ?>cadastro/aluno" class="btn btn-default" id="cadastrar">Cadastrar</a>
        </div>

    </form>
</div>

<script>
    $("#matricula").numeric();
</script>
