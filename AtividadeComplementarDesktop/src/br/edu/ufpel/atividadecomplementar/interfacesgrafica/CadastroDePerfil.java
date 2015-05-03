package br.edu.ufpel.atividadecomplementar.interfacesgrafica;

import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
import br.edu.ufpel.atividadecomplementar.dadosXML.ManipulaXML;
import br.edu.ufpel.atividadecomplementar.modelos.Aluno;
import br.edu.ufpel.atividadecomplementar.modelos.AlunosXML;
import br.edu.ufpel.atividadecomplementar.modelos.Curso;
import br.edu.ufpel.atividadecomplementar.modelos.CursosXML;
import javafx.event.ActionEvent;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.stage.Stage;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import java.util.List;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.scene.control.TextField;
import javafx.scene.layout.GridPane;
import javafx.scene.text.TextAlignment;
import javax.xml.bind.JAXBException;

public class CadastroDePerfil extends InterfaceGrafica {
    
    private Button btnAvancar;
    private Button btnVoltar;
    private ComboBox cbxCurso;
    private final Label lblCurso = new Label(PropertiesBundle.getProperty("CURSO_LABEL"));
    private final Label lblMatricula = new Label(PropertiesBundle.getProperty("MATRICULA_LABEL"));
    private final Label lblNome = new Label(PropertiesBundle.getProperty("NOME_LABEL"));
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
        
        grid.add(lblNome, 0, 0, 1, 1);
        grid.add(txtNome, 1, 0, 2, 1);
        grid.add(lblMatricula, 0, 1, 1, 1);
        grid.add(txtMatricula, 1, 1, 2, 1);
        grid.add(lblCurso, 0, 2, 1, 1);
        grid.add(cbxCurso, 1, 2, 2, 1);
        grid.add(btnAvancar, 1, 3);
        grid.add(btnVoltar, 2, 3);
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
        btnAvancar.setText(PropertiesBundle.getProperty("BOTAO_NOVO_PERFIL"));
        btnAvancar.setTextAlignment(TextAlignment.CENTER);
        btnAvancar.setMinWidth(larguraMinimaBotao);
        btnAvancar.setOnAction((ActionEvent event) -> {
            if (txtMatricula.getText() == null || txtMatricula.getText().isEmpty()) {
                AlertasUtils.exibeErro("MATRICULA_ERRO");
            } else if (cbxCurso.getValue() == null) {
                AlertasUtils.exibeErro("INFORME_CURSO_ERRO");
            } else {            
                try {
                    Aluno aluno = gerarPerfil();
                    
                    Stage stage= new Stage();
                    ResumoUI resumoUI= new ResumoUI(aluno);
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
        btnVoltar.setTextAlignment(TextAlignment.CENTER);
        btnVoltar.setMinWidth(larguraMinimaBotao);
        btnVoltar.setOnAction((ActionEvent event) -> {
            SelecionaPerfil selecionaPerfil = new SelecionaPerfil();
            selecionaPerfil.montarTela(stage);
        });
    }
    
    private Aluno gerarPerfil() {
        ManipulaXML<Aluno> manipulador = new ManipulaXML(txtMatricula.getText().concat(".xml"), "perfil/");
        Aluno aluno;
        
        try {
            aluno = manipulador.buscar(Aluno.class);
            
            AlertasUtils.exibeAlerta("PERFIL_JA_EXISTE");
        } catch (JAXBException ex) {
            Curso curso = (Curso) cbxCurso.getValue();
            aluno = new Aluno();
            
            aluno.setMatricula(txtMatricula.getText());
            aluno.setNome(txtNome.getText());
            aluno.setCurso(curso);
            
            try {
                manipulador.salvar(aluno, Aluno.class);
                
                ManipulaXML<AlunosXML> manipuladorAlunos = new ManipulaXML("alunos.xml", "perfil/");
                AlunosXML alunosXML = manipuladorAlunos.buscar(AlunosXML.class);
                List<Aluno> alunos = alunosXML.getAlunos();
                alunos.add(aluno);
                alunos.sort((Aluno e1, Aluno e2) -> e1.getNome().compareTo(e2.getNome()));
                alunosXML.setAlunos(alunos);
                manipuladorAlunos.salvar(alunosXML, AlunosXML.class);
                
            } catch (JAXBException ex1) {
                throw new RuntimeException("PROBLEMA_CRIAR_PERFIL");
            }
        }
        
        return aluno;
    }

}