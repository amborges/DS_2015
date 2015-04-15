package br.edu.ufpel.atividadecomplementar.interfacesgrafica;

import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
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
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.scene.control.TextField;
import javafx.scene.layout.GridPane;
import javax.xml.bind.JAXBException;

public class CadastroDePerfil extends InterfaceGrafica {
    
    private Button btnAvancar;
    private Button btnVoltar;
    private ComboBox cbxCurso;
    private final Label lblCurso = new Label(PropertiesBundle.getProperty("INFORME_CURSO"));
    private final Label lblEmail = new Label(PropertiesBundle.getProperty("EMAIL_LABEL"));
    private final Label lblMatricula = new Label(PropertiesBundle.getProperty("MATRICULA_LABEL"));
    private final Label lblNome = new Label(PropertiesBundle.getProperty("NOME_LABEL"));
    private final TextField txtEmail = new TextField();
    private final TextField txtMatricula = new TextField();
    private final TextField txtNome = new TextField();
    
    public CadastroDePerfil() {
        this.telaAltura = telaAltura / 1.5;
        this.telaLargura = telaLargura / 1.5;
    }
    
    @Override
    protected void inicializarElementos(GridPane grid, Stage stage) {
        try {
            inicializarComboboxCurso();
        } catch (JAXBException ex) {
            AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
        }
        inicializarButtonAvancar(stage);
        inicializarButtonVoltar(stage);
        
        grid.add(lblMatricula, 0, 0, 2, 1);
        grid.add(txtMatricula, 0, 1, 2, 1);
        grid.add(lblCurso, 0, 2, 2, 1);
        grid.add(cbxCurso, 0, 3, 2, 1);
        grid.add(lblNome, 0, 4, 2, 1);
        grid.add(txtNome, 0, 5, 2, 1);
        grid.add(lblEmail, 0, 6, 2, 1);
        grid.add(txtEmail, 0, 7, 2, 1);
        grid.add(btnAvancar, 0, 8);
        grid.add(btnVoltar, 1, 8);
    }
    
    private void inicializarComboboxCurso() throws JAXBException {
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
                    resumoUI.montarTela(stage);
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
    
    private void inicializarButtonVoltar(Stage stage) {
        btnVoltar = new Button();
        btnVoltar.setText(PropertiesBundle.getProperty("BOTAO_VOLTAR"));
        btnVoltar.setOnAction((ActionEvent event) -> {
            SelecionaPerfil selecionaPerfil = new SelecionaPerfil();
            selecionaPerfil.montarTela(stage);
        });
    }
    
    private Aluno gerarPerfil() {
        ManipulaXML<Aluno> manipulador = new ManipulaXML<>(txtMatricula.getText().concat(".xml"), "perfil/");
        Aluno aluno;
        
        try {
            aluno = manipulador.buscar(Aluno.class);
        } catch (JAXBException ex) {
            Curso curso = (Curso) cbxCurso.getValue();
            aluno = new Aluno();
            
            aluno.setMatricula(txtMatricula.getText());
            aluno.setNome(txtNome.getText());
            aluno.setEmail(txtEmail.getText());
            aluno.setCurso(curso);
            
            try {
                manipulador.salvar(aluno, Aluno.class);
            } catch (JAXBException ex1) {
                throw new RuntimeException("PROBLEMA_CRIAR_PERFIL");
            }
        }
        
        return aluno;
    }

}