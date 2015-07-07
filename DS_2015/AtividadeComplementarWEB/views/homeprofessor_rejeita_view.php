<?php if ( ! defined('ABSPATH')) exit; ?>

<h1>Bem-vindo Professor</h1>

<div class="row">
    <div class="col-xs-offset-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
        <h4>Rejeitando Atividade</h4>
    </div>
</div>
    
<div class="row">
    <form class="form-horizontal" action="#" method="post">
    
        <!-- Descrição -->
        <div class="form-group">
            <label for="descricao" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"> Resumo:</label>
            <div class="col-xs-5 col-lg-5 col-md-5 col-sm-5">
                <textarea id="descricao" name="descricao" rows="3" cols="50" class="form-control" disabled/><?php echo $resumo; ?></textarea>
            </div>                         
        </div>
        
        <!-- Descrição -->
        <div class="form-group">
            <label for="justificativa" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label"> Justificativa:</label>
            <div class="col-xs-5 col-lg-5 col-md-5 col-sm-5">
                <textarea id="justificativa" name="justificativa" rows="3" cols="50" required="true" class="form-control" maxlength="255" placeholder="Justifique a rejeição" /></textarea>
            </div>                         
        </div>

        
        <!-- Botões - Cadastrar e Voltar -->
        <div class="form-group">                    
            <button class="col-lg-offset-5 btn btn-default" onClick="emdesenvolvimento()">Enviar</button>
        </div>

    </form>
</div>

<script>
function emdesenvolvimento() {
    alert("Esta funcionalidade está aguardando finalização e implementação com servidor de e-mail.");
}
</script>
