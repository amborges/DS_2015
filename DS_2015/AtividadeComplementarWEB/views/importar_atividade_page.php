<form class="form-horizontal" action="<?php echo BASE_URL; ?>atividades/editar" method="post" enctype="multipart/form-data">
    <div class="row">
        <!-- Selecionar arquivo -->
        <div class="form-group">
            <label for="fileToUpload" class="control-label col-xs-offset-1 col-xs-2 col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2">Selecionar arquivo:</label>
            <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6">
                <div class="input-group">
                    <input id="fileToUpload" name="fileToUpload" type="file" class="form-control"/>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Enviar</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>