package br.edu.ufpel.atividadecomplementar.interfacesgrafica.perfil;

import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
import br.edu.ufpel.atividadecomplementar.interfacesgrafica.atividade.CadastroDeAtividades;
import br.edu.ufpel.atividadecomplementar.interfacesgrafica.atividade.VisualizacaoDeAtividades;
import br.edu.ufpel.atividadecomplementar.modelos.Aluno;
import br.edu.ufpel.atividadecomplementar.modelos.GrandeArea;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import java.io.File;
import java.io.IOException;
import java.util.HashMap;
import java.util.Map;
import javafx.beans.value.ChangeListener;
import javafx.beans.value.ObservableValue;
import javafx.event.ActionEvent;
import javafx.scene.Node;
import javafx.scene.chart.BarChart;
import javafx.scene.chart.CategoryAxis;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.GridPane;
import javafx.scene.text.TextAlignment;
import javafx.stage.DirectoryChooser;
import javafx.stage.Stage;
import javax.xml.bind.JAXBException;

public class ResumoDoPerfil extends InterfaceGrafica {

    private Aluno aluno;
    private BarChart<String, Number> grafico;
    private Button btnAdicionar;
    private Button btnExportar;
    private Button btnSair;
    private Button btnVisualizar;
    private final Label lblNomeAluno;
    private Map<String, GrandeArea> grandesAreas;

    private static final String ENSINO = PropertiesBundle.getProperty("ENSINO");
    private static final String EXTENSAO = PropertiesBundle.getProperty("EXTENSAO");
    private static final String PESQUISA = PropertiesBundle.getProperty("PESQUISA");
    
    public ResumoDoPerfil(Aluno aluno) throws JAXBException {
        this.aluno = aluno;
        lblNomeAluno = new Label(PropertiesBundle.getProperty("LABEL_ALUNO").concat(" ").concat(aluno.getMatricula()).concat(" - ").concat(aluno.getNome()));
        lblNomeAluno.setStyle("-fx-font-weight: bold; -fx-font-size: 12px;");
        carregarGrandesAreas();
    }
    
    @Override
    protected void inicializarElementos(GridPane grid, Stage stage) {
        inicializarGrafico();
        inicializarButtonAdicionar(stage);
        inicializarButtonVisualizar(stage);
        inicializarButtonExportar(stage);
        inicializarButtonSair(stage);
        
        GridPane gridBotoes = new GridPane();
        gridBotoes.setVgap(this.espacamentoVertical * 2.0);
        
        gridBotoes.add(btnAdicionar, 0, 1);
        gridBotoes.add(btnVisualizar, 0, 2);
        gridBotoes.add(btnExportar, 0, 3);
        
        grid.add(lblNomeAluno, 0, 0);
               
        // node, columnIndex, rowIndex, colspan, rowspan
        grid.add(grafico, 0, 1, 4, 1);
        // node, columnIndex, rowIndex
        grid.add(gridBotoes, 4, 1);
        grid.add(btnSair, 1, 0);
    }
    
    private void inicializarGrafico() {
        grafico = new BarChart<>(new CategoryAxis(), new NumberAxis());
        grafico.setTitle(PropertiesBundle.getProperty("HORAS"));
        
        XYChart.Data ensinoBar = new XYChart.Data(ENSINO, aluno.getHorasEnsino());
        XYChart.Data extensaoBar = new XYChart.Data(EXTENSAO, aluno.getHorasExtensao());
        XYChart.Data pesquisaBar = new XYChart.Data(PESQUISA, aluno.getHorasPesquisa());
        
        adicionarListener(ensinoBar);
        adicionarListener(extensaoBar);
        adicionarListener(pesquisaBar);
        
        XYChart.Series serie1 = new XYChart.Series();
        serie1.setName(PropertiesBundle.getProperty("HORAS_CALCULADAS"));
        serie1.getData().add(ensinoBar);
        serie1.getData().add(extensaoBar);
        serie1.getData().add(pesquisaBar);
                
        XYChart.Series serie2 = new XYChart.Series();
        serie2.setName(PropertiesBundle.getProperty("HORAS_NECESSARIAS"));
        serie2.getData().add(new XYChart.Data(ENSINO, grandesAreas.get(ENSINO).getHoraMinima()));
        serie2.getData().add(new XYChart.Data(EXTENSAO, grandesAreas.get(EXTENSAO).getHoraMinima()));
        serie2.getData().add(new XYChart.Data(PESQUISA, grandesAreas.get(PESQUISA).getHoraMinima()));
        
        grafico.getData().addAll(serie1, serie2);
        grafico.setLegendVisible(false);
    }

    private void adicionarListener(final XYChart.Data data) {
        data.nodeProperty().addListener(new ChangeListener<Node>() {

            @Override
            public void changed(ObservableValue<? extends Node> observable, Node oldNode, Node newNode) {
                if (newNode != null) {
                    GrandeArea grandeArea = grandesAreas.get(data.getXValue().toString());
                    if (grandeArea.getHoraMinima().compareTo((Double) data.getYValue()) > 0) {
                        newNode.setStyle("-fx-bar-fill: red;");
                    } else {
                        newNode.setStyle("-fx-bar-fill: green;");
                    }
                }
            }
            
        });
    }
    
    private void inicializarButtonAdicionar(Stage primaryStage) {
        btnAdicionar = new Button();
        btnAdicionar.setText(PropertiesBundle.getProperty("BOTAO_ADICIONAR"));
        btnAdicionar.setTextAlignment(TextAlignment.CENTER);
        btnAdicionar.setMinWidth(larguraMinimaBotao);
        btnAdicionar.setOnAction((ActionEvent event) -> {
            Stage stage= new Stage();
            InterfaceGrafica cadastroDeAtividades = new CadastroDeAtividades(aluno);
            cadastroDeAtividades.montarTela(stage);
            primaryStage.close();
        });
    }

    private void inicializarButtonVisualizar(Stage primaryStage) {
        btnVisualizar = new Button();
        btnVisualizar.setText(PropertiesBundle.getProperty("BOTAO_VISUALIZAR"));
        btnVisualizar.setTextAlignment(TextAlignment.CENTER);
        btnVisualizar.setMinWidth(larguraMinimaBotao);
        btnVisualizar.setOnAction((ActionEvent event) -> {
            Stage stage = new Stage();
            InterfaceGrafica visualizacaoDeAtividades = new VisualizacaoDeAtividades(aluno);
            visualizacaoDeAtividades.montarTela(stage);
            primaryStage.close();
        });
    }

    private void inicializarButtonExportar(Stage primaryStage) {
        btnExportar = new Button();
        
        btnExportar.setText(PropertiesBundle.getProperty("BOTAO_EXPORTAR"));
        btnExportar.setOnAction((ActionEvent event) -> {
            DirectoryChooser directoryChooser = new DirectoryChooser();
            File destinoExportacao = null;
            
            if (aluno.getDestinoExportacaoPadrao() != null) {
                directoryChooser.setInitialDirectory(aluno.getDestinoExportacaoPadrao());
            }   
            
            destinoExportacao = directoryChooser.showDialog(primaryStage);
            
            if (destinoExportacao != null) {
                try {
                    String nomeArquivo = aluno.exportarXML(destinoExportacao);
                    
                    nomeArquivo = PropertiesBundle.getProperty("ARQUIVO_EXPORTADO_SUCESSO").replace("{0}", nomeArquivo);
                    
                    AlertasUtils.exibeInformacao(nomeArquivo);
                } catch (IOException ex) {
                    AlertasUtils.exibeErro(PropertiesBundle.getProperty("ERRO_ABRIR_ARQUIVO"));
                }
            }
        });
    }
    
    private void inicializarButtonSair(Stage stage) {
        btnSair = new Button();
        btnSair.setText(PropertiesBundle.getProperty("BOTAO_SAIR"));
        btnSair.setTextAlignment(TextAlignment.CENTER);
        btnSair.setMinWidth(larguraMinimaBotao);
        btnSair.setOnAction((ActionEvent event) -> {
            InterfaceGrafica interfaceGrafica = new AberturaDePerfil();
            interfaceGrafica.montarTela(stage);
        });
    }

    private void carregarGrandesAreas() {
        grandesAreas = new HashMap<>();
        for (GrandeArea grandeAreaAtual : aluno.getCurso().getGrandesAreas()) {
            grandesAreas.put(grandeAreaAtual.getNome(), grandeAreaAtual);
        }
    }

}