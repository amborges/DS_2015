package br.edu.ufpel.atividadecomplementar.interfacesgrafica;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipularXML;
import br.edu.ufpel.atividadecomplementar.modelos.Curso;
import br.edu.ufpel.atividadecomplementar.modelos.CursosXML;
import javafx.event.ActionEvent;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.stage.Stage;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import br.edu.ufpel.atividadecomplementar.utils.ConstanteUtils;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.application.Application;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.layout.GridPane;
import javax.xml.bind.JAXBException;

public class HomeUI extends Application {
    
    private Button btnAvancar;
    private ComboBox cbxCurso;
    private Label lblCurso;

    @Override
    public void start(Stage primaryStage) {
        GridPane grid = new GridPane();
        grid.setAlignment(Pos.CENTER);
        grid.setVgap(ConstanteUtils.ESPACAMENTO_VERTICAL);
        // Insets(top, right, bottom, left)
        grid.setPadding(new Insets(ConstanteUtils.PADDING_TOP, ConstanteUtils.PADDING_RIGHT, 
                ConstanteUtils.PADDING_BOTTOM, ConstanteUtils.PADDING_LEFT));
        
        inicializaLabelCurso();
        inicializaComboboxCurso();
        inicializarBotaoAvancar(primaryStage);
        
        grid.add(lblCurso, 0, 0);
        grid.add(cbxCurso, 0, 1);
        grid.add(btnAvancar, 0, 2);
        
        Scene scene  = new Scene(grid, ConstanteUtils.TELA_LARGURA / 2, ConstanteUtils.TELA_ALTURA / 2);
        
        primaryStage.setTitle(PropertiesBundle.getProperty("TITULO_APLICACAO"));
        primaryStage.setScene(scene);
        primaryStage.show();
    }
    
    private void inicializaLabelCurso() {
        lblCurso = new Label();
        
        lblCurso.setText(PropertiesBundle.getProperty("INFORME_CURSO"));
    }
    
    private void inicializaComboboxCurso() {
        ObservableList<Curso> cursos = FXCollections.observableArrayList();
        ManipularXML<CursosXML> maniulador = new ManipularXML("cursos.xml");
      
        cbxCurso = new ComboBox();
        try {
            cursos.addAll(maniulador.buscar(CursosXML.class).getCursos());
            cbxCurso.setItems(cursos);
        } catch (JAXBException ex) {
            Logger.getLogger(HomeUI.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    private void inicializarBotaoAvancar(Stage primaryStage) {
        btnAvancar = new Button();
        
        btnAvancar.setText(PropertiesBundle.getProperty("BOTAO_AVANCAR"));
        btnAvancar.setOnAction((ActionEvent event) -> {
            if (cbxCurso.getValue() == null) {
                AlertasUtils.exibeErro("INFORME_CURSO_ERRO");
            } else {            
                Stage stage= new Stage();
                ResumoUI resumoUI= new ResumoUI((Curso)cbxCurso.getValue());
                resumoUI.start(stage);
                primaryStage.close();
            }
        });
    }
       
    public static void main(String[] args) {
        launch(args);    
    }
    
}