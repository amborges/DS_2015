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
    <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
        <h4>Cadastro de alunos</h4>
    </div>
</div>

<form class="form-horizontal" action="<?php echo BASE_URL; ?>cadastro/cadastrar_aluno" method="post">
    <!-- Matrícula -->
    <div class="form-group">
        <label for="matricula" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span>Matrícula:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="matricula" name="matricula" type="text" required class="form-control" maxlength="8" <?php if (isset($matricula)) {echo 'value="' . $matricula . '"'; unset($matricula);} ?> />
        </div>                         
    </div>

    <!-- Nome -->
    <div class="form-group">
        <label for="nome" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span>Nome:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="nome" name="nome" type="text" required class="form-control" maxlength="255" <?php if (isset($nome)) {echo 'value="' . $nome . '"'; unset($nome);} ?> />
        </div>                         
    </div>

    <!-- E-mail -->
    <div class="form-group">
        <label for="email" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">E-mail:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="email" name="email" type="email" class="form-control" maxlength="255" <?php if (isset($email)) {echo 'value="' . $email . '"'; unset($email);} ?> />
        </div>                         
    </div>
    
    <!-- Curso -->
    <div class="form-group">
        <label for="curso" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span>Curso:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <select id="curso" name="curso" required class="form-control">
                <?php
                    echo '<option value=""></option>';
                    foreach($cursos as $curso)
                    {
                        $selected = '';
                        if (isset($idCurso) && $idCurso == $curso['idCurso']) {
                            $selected = 'selected';
                        }
                        echo '<option value="'. $curso['idCurso'] . '" '. $selected . ' >' . $curso['nomeCurso'] . '</option>';
                    }
                    unset($cursos);
                ?>
            </select>
        </div>                         
    </div>
    
    <!-- Senha -->
    <div class="form-group">
        <label for="senha" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span>Senha:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="senha" name="senha" type="password" required class="form-control" maxlength="32" <?php if (isset($senha)) {echo 'value="' . $senha . '"'; unset($senha);} ?> />
        </div>
    </div>
    
    <!-- Repetir senha -->
    <div class="form-group">
        <label for="repetir_senha" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span>Repetir senha:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="repetir_senha" name="repetir_senha" type="password" required class="form-control" maxlength="32" <?php if (isset($repetir_senha)) {echo 'value="' . $repetir_senha . '"'; unset($repetir_senha);} ?> />
        </div>
    </div>
    
    <!-- ReCaptcha -->
    <div class="form-group">
        <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
            <h3>RECAPTCHA</h3>
        </div>
    </div>
    
    <!-- Botões - Cadastrar e Voltar -->
    <div class="form-group">                    
        <button class="col-lg-offset-5 btn btn-default" type="submit">Cadastrar</button>
        <a href="<?php echo BASE_URL; ?>login" class="btn btn-default" id="cadastrar">Voltar</a>
    </div>
    
</form>                

<script>
    $("#matricula").numeric();
</script>