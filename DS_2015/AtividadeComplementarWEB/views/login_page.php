<form class="form-horizontal" action="<?php echo BASE_URL; ?>login/logar" method="post">
    <!-- Matrícula / Siape -->
    <div class="form-group">
        <label for="matricula" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Matrícula / Siape:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="matricula" name="matricula" type="text" class="form-control" maxlength="128"/>
        </div>                         
    </div>

    <!-- Senha -->
    <div class="form-group">
        <label for="senha" class="col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2 control-label">Senha:</label>
        <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">
            <input id="senha" name="senha" type="password" class="form-control" maxlength="256" />
        </div>
    </div>
    
    <!-- Botões - Salvar e Cadastrar -->
    <div class="form-group">                    
        <button class="col-lg-offset-5 btn btn-default" type="submit">Logar</button>
        <button class="btn btn-default" type="button">Cadastrar</button>
    </div>
    
</form>
                
