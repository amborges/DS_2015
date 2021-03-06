package br.edu.ufpel.atividadecomplementar.interfacesgrafica.atividade;

import br.edu.ufpel.atividadecomplementar.interfacesgrafica.perfil.ResumoDoPerfil;
import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
import br.edu.ufpel.atividadecomplementar.modelos.Aluno;
import br.edu.ufpel.atividadecomplementar.modelos.Atividade;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.scene.control.Button;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.GridPane;
import javafx.scene.text.TextAlignment;
import javafx.stage.Stage;
import javax.xml.bind.JAXBException;

/**
 *
 * @author Paulo
 */
public class VisualizacaoDeAtividades extends InterfaceGrafica {

    private Aluno aluno;
    private Button btnCancelar;
    private Button btnEditar;
    private Button btnExcluir;
    private TableView<Atividade> tblAtividades;

    public VisualizacaoDeAtividades(Aluno aluno) {
        this.aluno = aluno;
    }
    
    @Override
    protected void inicializarElementos(GridPane grid, Stage stage) {
        inicializarTableViewAtividades();
        inicializarBotaoEditar(stage);
        inicializarBotaoExcluir(stage);
        inicializarBotaoCancelar(stage);
        
        grid.add(tblAtividades, 0, 0, 10, 2);
        grid.add(btnEditar, 0, 4);
        grid.add(btnExcluir, 1, 4);
        grid.add(btnCancelar, 2, 4);
    }
    
    private void inicializarTableViewAtividades() {
        ObservableList<Atividade> atividades = FXCollections.observableArrayList();
        
        atividades.addAll(aluno.getListaDeAtividades());
        
        TableColumn descricaoCol = new TableColumn(PropertiesBundle.getProperty("DESCRICAO"));
        descricaoCol.setCellValueFactory(new PropertyValueFactory<>("descricao"));
 
        TableColumn grandeAreaCol = new TableColumn(PropertiesBundle.getProperty("GRANDE_AREA"));
        grandeAreaCol.setCellValueFactory(new PropertyValueFactory<>("nomeGrandeArea"));
 
        TableColumn categoriaCol = new TableColumn(PropertiesBundle.getProperty("CATEGORIA"));
        categoriaCol.setCellValueFactory(new PropertyValueFactory<>("nomeCategoria"));
        
        TableColumn dataInicialCol = new TableColumn(PropertiesBundle.getProperty("DATA_INICIAL"));
        dataInicialCol.setCellValueFactory(new PropertyValueFactory<>("dataInicial"));
        
        TableColumn dataFinalCol = new TableColumn(PropertiesBundle.getProperty("DATA_FINAL"));
        dataFinalCol.setCellValueFactory(new PropertyValueFactory<>("dataFinal"));
    
        TableColumn horasInformadasCol = new TableColumn(PropertiesBundle.getProperty("HORAS_INFORMADA"));
        horasInformadasCol.setCellValueFactory(new PropertyValueFactory<>("horasInformadas"));
    
        TableColumn horasContabilizadasCol = new TableColumn(PropertiesBundle.getProperty("HORAS_VALIDADA"));
        horasContabilizadasCol.setCellValueFactory(new PropertyValueFactory<>("horasContabilizadas"));
 
        tblAtividades = new TableView<>();
        tblAtividades.setItems(atividades);
        tblAtividades.getColumns().addAll(descricaoCol, grandeAreaCol, categoriaCol, dataInicialCol, dataFinalCol, horasInformadasCol, horasContabilizadasCol);
    }

    private void inicializarBotaoEditar(Stage primaryStage) {
        btnEditar = new Button();
        
        btnEditar.setText(PropertiesBundle.getProperty("BOTAO_EDITAR"));
        btnEditar.setTextAlignment(TextAlignment.CENTER);
        btnEditar.setMinWidth(larguraMinimaBotao);
        btnEditar.setOnAction((ActionEvent event) -> {
            Atividade atividadeSelecionada = tblAtividades.getSelectionModel().getSelectedItem();
            
            if (atividadeSelecionada != null) {
                Stage stage= new Stage();
                InterfaceGrafica edicaoDeAtividades = new CadastroDeAtividades(aluno, atividadeSelecionada);
                edicaoDeAtividades.montarTela(stage);
                primaryStage.close();
            } else {
                AlertasUtils.exibeErro("SELECIONE_ATIVIDADE");
            }
        });
    }
    
    private void inicializarBotaoExcluir(Stage primaryStage) {
        btnExcluir = new Button();
        
        btnExcluir.setText(PropertiesBundle.getProperty("BOTAO_EXCLUIR"));
        btnExcluir.setTextAlignment(TextAlignment.CENTER);
        btnExcluir.setMinWidth(larguraMinimaBotao);
        btnExcluir.setOnAction((ActionEvent event) -> {
            Atividade atividadeSelecionada = tblAtividades.getSelectionModel().getSelectedItem();
            
            if (atividadeSelecionada != null) {
                aluno.removerAtividade(atividadeSelecionada);

                this.montarTela(primaryStage);
            } else {
                AlertasUtils.exibeErro("SELECIONE_ATIVIDADE");
            }
        });
    }
    
    private void inicializarBotaoCancelar(Stage primaryStage) {
        btnCancelar = new Button();
        
        btnCancelar.setText(PropertiesBundle.getProperty("BOTAO_CANCELAR"));
        btnCancelar.setTextAlignment(TextAlignment.CENTER);
        btnCancelar.setMinWidth(larguraMinimaBotao);
        btnCancelar.setOnAction((ActionEvent event) -> {
            try {
                Stage stage= new Stage();
                ResumoDoPerfil resumoUI= new ResumoDoPerfil(aluno);
                resumoUI.montarTela(stage);
                primaryStage.close();
            } catch(NullPointerException ex) {
                AlertasUtils.exibeErro(ex.getMessage());
            } catch(JAXBException ex) {
                AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
            }
        });
    }

}