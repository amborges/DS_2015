package br.edu.ufpel.atividadecomplementar.interfacesgrafica.perfil;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipulaXML;
import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
import br.edu.ufpel.atividadecomplementar.modelos.Aluno;
import br.edu.ufpel.atividadecomplementar.modelos.AlunoInfoBasicas;
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
    private Button btnCancelar;
    private ListView<AlunoInfoBasicas> listaDePerfis;
    
    public AberturaDePerfil() {
        this.telaAltura = telaAltura / 1.5;
        this.telaLargura = telaLargura / 1.5;
    }
    
    @Override
    protected void inicializarElementos(GridPane grid, Stage stage) {
        inicializarListViewPerfis();
        inicializarButtonCarregar(stage);
        inicializarButtonCancelar(stage);
        
        grid.add(listaDePerfis, 0, 0, 4, 4);
        grid.add(btnCarregar, 0, 4);
        grid.add(btnCancelar, 1, 4);
    }
    
    private void inicializarListViewPerfis() {
        ObservableList<AlunoInfoBasicas> alunosInformacoesBasicas = FXCollections.observableArrayList();
        ManipulaXML<AlunosXML> manipulador = new ManipulaXML("alunos.xml", "perfil/");
        
        listaDePerfis = new ListView();
        
        try {
            alunosInformacoesBasicas.addAll(manipulador.buscar(AlunosXML.class).getAlunos());
        } catch (JAXBException ex) {}
        
        listaDePerfis.setItems(alunosInformacoesBasicas);
    }
    
    private void inicializarButtonCarregar(Stage primaryStage) {
        btnCarregar = new Button();
        btnCarregar.setText(PropertiesBundle.getProperty("BOTAO_CARREGAR"));
        btnCarregar.setTextAlignment(TextAlignment.CENTER);
        btnCarregar.setMinWidth(larguraMinimaBotao);
        btnCarregar.setOnAction((ActionEvent event) -> {
            AlunoInfoBasicas alunoInformacoesBasicas = listaDePerfis.getSelectionModel().getSelectedItem();
            
            if (alunoInformacoesBasicas != null) {
                try {
                    Stage stage= new Stage();
                    InterfaceGrafica resumoDoPerfil = new ResumoDoPerfil(carregarPerfil(alunoInformacoesBasicas));
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
                AlertasUtils.exibeErro("SELECIONE_PERFIL");
            }
        });
    }
    
    private void inicializarButtonCancelar(Stage stage) {
        btnCancelar = new Button();
        btnCancelar.setText(PropertiesBundle.getProperty("BOTAO_CANCELAR"));
        btnCancelar.setTextAlignment(TextAlignment.CENTER);
        btnCancelar.setMinWidth(larguraMinimaBotao);
        btnCancelar.setOnAction((ActionEvent event) -> {
            InterfaceGrafica selecionaPerfil = new SelecaoDePerfil();
            selecionaPerfil.montarTela(stage);
        });
    }

    private Aluno carregarPerfil(AlunoInfoBasicas alunoSelecionado) {
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
