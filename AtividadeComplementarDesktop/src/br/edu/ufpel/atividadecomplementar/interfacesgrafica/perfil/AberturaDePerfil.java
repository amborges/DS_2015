package br.edu.ufpel.atividadecomplementar.interfacesgrafica.perfil;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipulaXML;
import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
import br.edu.ufpel.atividadecomplementar.modelos.Aluno;
import br.edu.ufpel.atividadecomplementar.modelos.AlunosXML;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.scene.control.Button;
import javafx.scene.control.ListView;
import javafx.scene.layout.GridPane;
import javafx.scene.text.TextAlignment;
import javafx.stage.Stage;
import javax.xml.bind.JAXBException;

/**
 *
 * @author Paulo
 */
class AberturaDePerfil extends InterfaceGrafica {
    
    private Button btnCarregar;
    private Button btnVoltar;
    private ListView<Aluno> listaDePerfis;
    
    public AberturaDePerfil() {
        this.telaAltura = telaAltura / 1.5;
        this.telaLargura = telaLargura / 1.5;
    }
    
    @Override
    protected void inicializarElementos(GridPane grid, Stage stage) {
        try {
            inicializarListViewPerfis();
        } catch (JAXBException ex) {
            AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
        }
        inicializarButtonCarregar(stage);
        inicializarButtonVoltar(stage);
        
        grid.add(listaDePerfis, 0, 0, 5, 4);
        grid.add(btnCarregar, 1, 4);
        grid.add(btnVoltar, 2, 4);
    }
    
    private void inicializarListViewPerfis() throws JAXBException {
        ObservableList<Aluno> alunos = FXCollections.observableArrayList();
        ManipulaXML<AlunosXML> manipulador = new ManipulaXML("alunos.xml", "perfil/");
        
        listaDePerfis = new ListView();
        alunos.addAll(manipulador.buscar(AlunosXML.class).getAlunos());
        listaDePerfis.setItems(alunos);
    }
    
    private void inicializarButtonCarregar(Stage primaryStage) {
        btnCarregar = new Button();
        btnCarregar.setText(PropertiesBundle.getProperty("BOTAO_CARREGAR"));
        btnCarregar.setTextAlignment(TextAlignment.CENTER);
        btnCarregar.setMinWidth(larguraMinimaBotao);
        btnCarregar.setOnAction((ActionEvent event) -> {
            Aluno aluno = listaDePerfis.getSelectionModel().getSelectedItem();
            
            if (aluno != null) {
                try {
                    Stage stage= new Stage();
                    InterfaceGrafica resumoDoPerfil = new ResumoDoPerfil(aluno);
                    resumoDoPerfil.montarTela(stage);
                    primaryStage.close();
                } catch(NullPointerException npex) {
                    AlertasUtils.exibeErro(npex.getMessage());
                } catch(JAXBException jbex) {
                    AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
                } catch(RuntimeException rtex) {
                    AlertasUtils.exibeErro(rtex.getMessage());
                }
            } else {
                AlertasUtils.exibeErro("SELECIONE_PERFIL");
            }
        });
    }
    
    private void inicializarButtonVoltar(Stage stage) {
        btnVoltar = new Button();
        btnVoltar.setText(PropertiesBundle.getProperty("BOTAO_VOLTAR"));
        btnVoltar.setTextAlignment(TextAlignment.CENTER);
        btnVoltar.setMinWidth(larguraMinimaBotao);
        btnVoltar.setOnAction((ActionEvent event) -> {
            InterfaceGrafica selecionaPerfil = new SelecaoDePerfil();
            selecionaPerfil.montarTela(stage);
        });
    }

    private Aluno carregarPerfil(Aluno alunoSelecionado) {
        ManipulaXML<Aluno> manipulador = new ManipulaXML(alunoSelecionado.getMatricula().concat(".xml"), "perfil/");
        Aluno aluno;
        
        try {
            aluno = manipulador.buscar(Aluno.class);
        } catch (JAXBException ex) {
                throw new RuntimeException("PROBLEMA_CRIAR_PERFIL");
        }
        
        return aluno;
    }
    
}
