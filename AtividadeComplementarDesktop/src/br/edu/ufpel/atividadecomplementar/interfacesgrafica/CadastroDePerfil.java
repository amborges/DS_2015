package br.edu.ufpel.atividadecomplementar.interfacesgrafica;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipulaXML;
import br.edu.ufpel.atividadecomplementar.modelos.Aluno;
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
import javafx.application.Application;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.TextField;
import javafx.scene.layout.GridPane;
import javax.xml.bind.JAXBException;

public class CadastroDePerfil extends Application {
    
    private Button btnAvancar;
    private ComboBox cbxCurso;
    private Label lblCurso;
    private Label lblMatricula;
    private TextField txtMatricula;

    @Override
    public void start(Stage primaryStage) {
        int indiceColuna = 0;
        int indiceLinha = 0;
        
        GridPane grid = new GridPane();
        grid.setAlignment(Pos.CENTER);
        grid.setVgap(ConstanteUtils.ESPACAMENTO_VERTICAL);
        // Insets(top, right, bottom, left)
        grid.setPadding(new Insets(ConstanteUtils.PADDING_TOP, ConstanteUtils.PADDING_RIGHT, 
                ConstanteUtils.PADDING_BOTTOM, ConstanteUtils.PADDING_LEFT));
        
        inicializarLabelMatricula();
        inicializarTextFieldMatricula();
        
        inicializaLabelCurso();
        try {
            inicializaComboboxCurso();
        } catch (JAXBException ex) {
            AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
            primaryStage.close();
        }
        inicializarButtonAvancar(primaryStage);
        
        grid.add(lblMatricula, indiceColuna, indiceLinha);
        grid.add(txtMatricula, indiceColuna, ++indiceLinha);
        grid.add(lblCurso, indiceColuna, ++indiceLinha);
        grid.add(cbxCurso, indiceColuna, ++indiceLinha);
        grid.add(btnAvancar, indiceColuna, ++indiceLinha);
        
        Scene scene  = new Scene(grid, ConstanteUtils.TELA_LARGURA / 2, ConstanteUtils.TELA_ALTURA / 2);
        
        primaryStage.setTitle(PropertiesBundle.getProperty("TITULO_APLICACAO"));
        primaryStage.setScene(scene);
        primaryStage.show();
    }
    
    private void inicializarLabelMatricula() {
        lblMatricula = new Label(PropertiesBundle.getProperty("MATRICULA_LABEL"));
    }

    private void inicializarTextFieldMatricula() {
        txtMatricula = new TextField();
    }
    
    private void inicializaLabelCurso() {
        lblCurso = new Label(PropertiesBundle.getProperty("INFORME_CURSO"));
    }
    
    private void inicializaComboboxCurso() throws JAXBException {
        ObservableList<Curso> cursos = FXCollections.observableArrayList();
        ManipulaXML<CursosXML> manipulador = new ManipulaXML("cursos.xml");
      
        cbxCurso = new ComboBox();
        cursos.addAll(manipulador.buscar(CursosXML.class).getCursos());
        cbxCurso.setItems(cursos);
    }
    
    private void inicializarButtonAvancar(Stage primaryStage) {
        btnAvancar = new Button();
        
        btnAvancar.setText(PropertiesBundle.getProperty("BOTAO_AVANCAR"));
        btnAvancar.setOnAction((ActionEvent event) -> {
            System.out.println(txtMatricula.getText());
            if (txtMatricula.getText() == null || txtMatricula.getText().isEmpty()) {
                AlertasUtils.exibeErro("MATRICULA_ERRO");
            } else if (cbxCurso.getValue() == null) {
                AlertasUtils.exibeErro("INFORME_CURSO_ERRO");
            } else {            
                try {
                    Aluno aluno = gerarPerfil();
                    
                    Stage stage= new Stage();
                    ResumoUI resumoUI= new ResumoUI((Curso)cbxCurso.getValue());
                    resumoUI.start(stage);
                    primaryStage.close();
                } catch(NullPointerException npex) {
                    AlertasUtils.exibeErro(npex.getMessage());
                } catch(JAXBException jbex) {
                    AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
                } catch(RuntimeException rtex) {
                    AlertasUtils.exibeErro(rtex.getMessage());
                }
            }
        });
    }
    
    private Aluno gerarPerfil() {
        ManipulaXML<Aluno> manipulador = new ManipulaXML<>(txtMatricula.getText().concat(".xml"), "perfil/");
        Aluno aluno = null;
        
        try {
            aluno = manipulador.buscar(Aluno.class);
        } catch (JAXBException ex) {
            aluno = new Aluno();
            
            aluno.setMatricula(txtMatricula.getText());
            aluno.setCurso((Curso) cbxCurso.getValue());
            
            try {
                manipulador.salvar(aluno, Aluno.class);
            } catch (JAXBException ex1) {
                throw new RuntimeException("PROBLEMA_CRIAR_PERFIL");
            }
        }
        
        return aluno;
    }
   
    public static void main(String[] args) {
        launch(args);    
    }
}