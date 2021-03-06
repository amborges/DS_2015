<?php if ( ! defined('ABSPATH')) exit; ?>

<h1>Bem-vindo Coordenador</h1>

<div class="row">
    <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
        <h4>Cadastrar novo usuário</h4>
    </div>
</div>

<form class="form-horizontal" action="<?php echo BASE_URL; ?>cadastro/cadastrar_professor" method="post">

    <!-- SIAPE -->
    <div class="form-group">
        <label for="siape" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">SIAPE:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="siape" name="siape" type="number" required="true" class="form-control" title="Número SIAPE do Professor" />
        </div>                         
    </div>

    <!-- Nome -->
    <div class="form-group">
        <label for="nome" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Nome:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="nome" name="nome" type="text" required="true" class="form-control" title="Nome completo do professor" pattern="([A-Z].[a-z]+(\s?))+" />
        </div>                         
    </div>
    
    <!-- E-Mail ->
    <div class="form-group">
        <label for="email" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">E-Mail:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="email" name="email" type="email" required="true" class="form-control" title="E-Mail do professor: exemplo@server.com" />
        </div>                         
    </div-->
    
    <!-- Curso -->
    <div class="form-group">
        <label for="curso" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"><span class="red_bold">*</span>Curso:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <select id="curso" name="idCurso" required class="form-control">
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
        <label for="senha" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Senha:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="senha" name="senha" type="password" required="true" class="form-control" min="1" />
        </div>                         
    </div>
    
    <!-- Senha2 -->
    <div class="form-group">
        <label for="senha2" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Redigite a Senha:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="senha2" name="senha2" type="password" required="true" class="form-control" min="1" />
        </div>                         
    </div>
    
    <!-- Usuário do tipo -->
    <div class="form-group">
        <label for="tipo" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Tipo de Usuário:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="tipo" name="tipo" type="radio" class="form-control" value="coordenador" checked/> Coordenador
        </div>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="tipo" name="tipo" type="radio" class="form-control" value="professor" /> Professor
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
    </div>
    
</form>
