package br.edu.ufpel.atividadecomplementar.interfacesgrafica;

import br.edu.ufpel.atividadecomplementar.modelos.Curso;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import br.edu.ufpel.atividadecomplementar.utils.ConstanteUtils;
import javafx.application.Application;
import javafx.event.ActionEvent;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.layout.GridPane;
import javafx.stage.Stage;

/**
 *
 * @author Paulo
 */
class VisualizarHorasUI extends Application {

    private Curso cursoSelecionado;
    Button btnAdicionar;
    Button btnCancelar;

    public VisualizarHorasUI(Curso cursoSelecionado) {
        this.cursoSelecionado = cursoSelecionado;
    }
    
    @Override
    public void start(Stage primaryStage) {
        GridPane grid = new GridPane();
        grid.setAlignment(Pos.CENTER);
        grid.setHgap(ConstanteUtils.ESPACAMENTO_HORIZONTAL);
        grid.setVgap(ConstanteUtils.ESPACAMENTO_VERTICAL);
        // Insets(top, right, bottom, left)
        grid.setPadding(new Insets(ConstanteUtils.PADDING_TOP, ConstanteUtils.PADDING_RIGHT, 
                ConstanteUtils.PADDING_BOTTOM, ConstanteUtils.PADDING_LEFT));
        
        inicializarBotaoAdicionar(primaryStage);
        inicializarBotaoCancelar(primaryStage);
        
        grid.add(btnAdicionar, 0, 1);
        grid.add(btnCancelar, 1, 1);
        
        Scene scene  = new Scene(grid, ConstanteUtils.TELA_LARGURA, ConstanteUtils.TELA_ALTURA);
        
        primaryStage.setTitle(PropertiesBundle.getProperty("TITULO_APLICACAO"));
        primaryStage.setScene(scene);
        primaryStage.show();
    }

    private void inicializarBotaoAdicionar(Stage primaryStage) {
        btnAdicionar = new Button();
        
        btnAdicionar.setText(PropertiesBundle.getProperty("BOTAO_ADICIONAR"));
        btnAdicionar.setOnAction((ActionEvent event) -> {
//                Stage stage= new Stage();
//                ResumoUI resumoUI= new ResumoUI((Curso)cbxCurso.getValue());
//                resumoUI.start(stage);
//                primaryStage.close();
        });
    }

    private void inicializarBotaoCancelar(Stage primaryStage) {
        btnCancelar = new Button();
        
        btnCancelar.setText(PropertiesBundle.getProperty("BOTAO_CANCELAR"));
        btnCancelar.setOnAction((ActionEvent event) -> {
            Stage stage= new Stage();
            ResumoUI resumoUI= new ResumoUI(cursoSelecionado);
            resumoUI.start(stage);
            primaryStage.close();
        });
    }
    
}