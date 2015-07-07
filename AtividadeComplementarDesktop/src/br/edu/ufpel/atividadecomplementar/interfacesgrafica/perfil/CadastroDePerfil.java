package br.edu.ufpel.atividadecomplementar.interfacesgrafica.perfil;

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
import br.edu.ufpel.atividadecomplementar.utils.MaskFieldUtil;
import br.edu.ufpel.atividadecomplementar.utils.StringUtils;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.scene.control.TextField;
import javafx.scene.layout.GridPane;
import javafx.scene.text.TextAlignment;
import javax.xml.bind.JAXBException;

public class CadastroDePerfil extends InterfaceGrafica {
    
    private static final int TAMANHO_MAXIMO_MATRICULA = 10;
    private Button btnAvancar;
    private Button btnCancelar;
    private ComboBox cbxCurso;
    private final Label lblCurso = new Label(PropertiesBundle.getProperty("LABEL_CURSO"));
    private final Label lblMatricula = new Label(PropertiesBundle.getProperty("LABEL_MATRICULA"));
    private final Label lblNome = new Label(PropertiesBundle.getProperty("LABEL_NOME"));
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
        inicializarButtonCancelar(stage);
        
        MaskFieldUtil.numericField(txtMatricula);
        StringUtils.adicionarTamanhoMaximoTextField(txtMatricula, TAMANHO_MAXIMO_MATRICULA);
        
        grid.add(lblNome, 0, 0, 1, 1);
        grid.add(txtNome, 1, 0, 2, 1);
        grid.add(obrigatorio(), 3, 0);
        grid.add(lblMatricula, 0, 1, 1, 1);
        grid.add(txtMatricula, 1, 1, 2, 1);
        grid.add(obrigatorio(), 3, 1);
        grid.add(lblCurso, 0, 2, 1, 1);
        grid.add(cbxCurso, 1, 2, 2, 1);
        grid.add(obrigatorio(), 3, 2);
        grid.add(btnAvancar, 1, 3);
        grid.add(btnCancelar, 2, 3);
    }
    
    private void inicializarComboboxCurso() throws JAXBException {
        ObservableList<Curso> cursos = FXCollections.observableArrayList();
        ManipulaXML<CursosXML> manipulador = new ManipulaXML<>("cursos.xml");
      
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
            String erros = validarDadosInformados();
            
            if (erros == null) {            
                try {
                    Aluno aluno = gerarPerfil();
                    
                    Stage stage = new Stage();
                    InterfaceGrafica resumoDoPerfil = new ResumoDoPerfil(aluno);
                    resumoDoPerfil.montarTela(stage);
                    primaryStage.close();
                } catch(NullPointerException npex) {
                    AlertasUtils.exibeErro(npex);
                } catch(JAXBException jbex) {
                    AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
                } catch(RuntimeException rtex) {
                    AlertasUtils.exibeErro(rtex);
                }
            } else {
                AlertasUtils.exibeErro(erros);
            }
            
        });
    }
    
    private void inicializarButtonCancelar(Stage stage) {
        btnCancelar = new Button();
        btnCancelar.setText(PropertiesBundle.getProperty("BOTAO_CANCELAR"));
        btnCancelar.setTextAlignment(TextAlignment.CENTER);
        btnCancelar.setMinWidth(larguraMinimaBotao);
        btnCancelar.setOnAction((ActionEvent event) -> {
            InterfaceGrafica interfaceGrafica = new AberturaDePerfil();
            interfaceGrafica.montarTela(stage);
        });
    }
    
    private Aluno gerarPerfil() {
        ManipulaXML<Aluno> manipulador = new ManipulaXML(txtMatricula.getText().concat(".xml"), "perfil");
        Aluno aluno;
        
        try {
            aluno = manipulador.buscar(Aluno.class);
            
            AlertasUtils.exibeAlerta("PERFIL_JA_EXISTE");
        } catch (JAXBException ex) {
            try {
                Curso curso = ((Curso) cbxCurso.getValue()).carregarInformacoes();
                aluno = new Aluno();

                aluno.setMatricula(txtMatricula.getText());
                aluno.setNome(txtNome.getText());
                aluno.setCurso(curso);
            
                manipulador.salvar(aluno, Aluno.class);
                
                ManipulaXML<AlunosXML> manipuladorAlunos = new ManipulaXML("alunos.xml", "perfil");
                AlunosXML alunosXML;
                
                try {
                    alunosXML = manipuladorAlunos.buscar(AlunosXML.class);
                } catch (JAXBException ex1) {
                    alunosXML = new AlunosXML();
                }
                
                alunosXML.adicionarAluno(aluno);
                
                manipuladorAlunos.salvar(alunosXML, AlunosXML.class);

            } catch (JAXBException ex2) {
                throw new RuntimeException("PROBLEMA_CRIAR_PERFIL");
            }
        }
        
        return aluno;
    }

    private String validarDadosInformados() {
        if (txtNome.getText() == null || txtNome.getText().isEmpty()) {
            return "ERRO_NOME_OBRIGATORIO";
        }
        
        if (txtMatricula.getText() == null || txtMatricula.getText().isEmpty()) {
            return "ERRO_MATRICULA_OBRIGATORIA";
        }
        
        if (cbxCurso.getValue() == null) {
            return "ERRO_CURSO_OBRIGATORIO";
        }
        
        return null;
    }

}