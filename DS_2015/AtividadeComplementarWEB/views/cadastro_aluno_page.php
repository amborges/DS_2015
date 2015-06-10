<div class="row">
    <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
        <h4>Cadastro de alunos</h4>
    </div>
</div>

<form class="form-horizontal" action="<?php echo BASE_URL; ?>cadastro/cadastrar_aluno" method="post">
    <!-- Matrícula -->
    <div class="form-group">
        <label for="matricula" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Matrícula:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="matricula" name="matricula" type="text" required="true" class="form-control" maxlength="128"/>
        </div>                         
    </div>

    <!-- Nome -->
    <div class="form-group">
        <label for="nome" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Nome:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="nome" name="nome" type="text" required="true" class="form-control" maxlength="128"/>
        </div>                         
    </div>

    <!-- E-mail -->
    <div class="form-group">
        <label for="email" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">E-mail:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="email" name="email" type="email" required="false" class="form-control" maxlength="128"/>
        </div>                         
    </div>
    
    <!-- Curso -->
    <div class="form-group">
        <label for="curso" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Curso:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <select id="curso" name="curso" class="form-control">
                <?php
                    foreach($cursos as $curso)
                    {
                        echo '<option value="'. $curso['idCurso'] . '">' . $curso['nomeCurso'] . '</option>';
                    }
                    unset($cursos);
                ?>
            </select>
        </div>                         
    </div>
    
    <!-- Senha -->
    <div class="form-group">
        <label for="senha" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Senha:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="senha" name="senha" type="password" required="true" class="form-control" maxlength="256" />
        </div>
    </div>
    
    <!-- Repetir senha -->
    <div class="form-group">
        <label for="repetir_senha" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Repetir senha:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="repetir_senha" name="repetir_senha" type="password" required="true" class="form-control" maxlength="256" />
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
                