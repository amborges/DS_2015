package br.edu.ufpel.atividadecomplementar.interfacesgrafica;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipularXML;
import br.edu.ufpel.atividadecomplementar.modelos.Curso;
import br.edu.ufpel.atividadecomplementar.modelos.RegraCalculo;
import br.edu.ufpel.atividadecomplementar.modelos.RegrasCalculoXML;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import br.edu.ufpel.atividadecomplementar.utils.ConstanteUtils;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.application.Application;
import javafx.event.ActionEvent;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.chart.BarChart;
import javafx.scene.chart.CategoryAxis;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;
import javafx.scene.control.Button;
import javafx.scene.layout.GridPane;
import javafx.stage.Stage;
import javax.xml.bind.JAXBException;

public class ResumoUI extends Application {

    private Curso cursoSelecionado;
    private RegraCalculo regraCalculo;
    private BarChart<String, Number> grafico;
    private Button btnAdicionar;
    private Button btnVisualizar;
    private Button btnImportar;
    private Button btnExportar;
    
    private static final String ENSINO = PropertiesBundle.getProperty("ENSINO");
    private static final String EXTENSAO = PropertiesBundle.getProperty("EXTENSAO");
    private static final String PESQUISA = PropertiesBundle.getProperty("PESQUISA");
    private static final String OUTROS = PropertiesBundle.getProperty("OUTROS");

    public ResumoUI(Curso cursoSelecionado) {
        this.cursoSelecionado = cursoSelecionado;
        
        carregarRegrasDeCalculo();
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
        
        inicializarGrafico();
        inicializarBotaoAdicionar(primaryStage);
        inicializarBotaoVisualizar(primaryStage);
        inicializarBotaoImportar(primaryStage);
        inicializarBotaoExportar(primaryStage);
        
        GridPane gridBotoes = new GridPane();
        gridBotoes.setVgap(ConstanteUtils.ESPACAMENTO_HORIZONTAL * 2.0);
        
        gridBotoes.add(btnAdicionar, 0, 1);
        gridBotoes.add(btnVisualizar, 0, 2);
        gridBotoes.add(btnImportar, 0, 3);
        gridBotoes.add(btnExportar, 0, 4);
                 
        // node, columnIndex, rowIndex, colspan, rowspan
        grid.add(grafico, 0, 0, 4, 1);
        // node, columnIndex, rowIndex
        grid.add(gridBotoes, 4, 0);
        
        Scene scene  = new Scene(grid, ConstanteUtils.TELA_LARGURA, ConstanteUtils.TELA_ALTURA);
        
        primaryStage.setTitle(PropertiesBundle.getProperty("TITULO_APLICACAO"));
        primaryStage.setScene(scene);
        primaryStage.show();
    }
    
    private void inicializarGrafico() {
        grafico = new BarChart<>(new CategoryAxis(), new NumberAxis());
        
        grafico.setTitle(PropertiesBundle.getProperty("HORAS"));
        
        XYChart.Series serie1 = new XYChart.Series();
        
        serie1.setName(PropertiesBundle.getProperty("HORAS_CALCULADAS"));
        serie1.getData().add(new XYChart.Data(ENSINO, 10.0));
        serie1.getData().add(new XYChart.Data(EXTENSAO, 20.0));
        serie1.getData().add(new XYChart.Data(PESQUISA, 15.0));
        serie1.getData().add(new XYChart.Data(OUTROS, 1.0));
                
        XYChart.Series serie2 = new XYChart.Series();
        serie2.setName(PropertiesBundle.getProperty("HORAS_NECESSARIAS"));
        serie2.getData().add(new XYChart.Data(ENSINO, regraCalculo.getHorasTotalEnsino()));
        serie2.getData().add(new XYChart.Data(EXTENSAO, regraCalculo.getHorasTotalExtensao()));
        serie2.getData().add(new XYChart.Data(PESQUISA, regraCalculo.getHorasTotalPesquisa()));
//        serie2.getData().add(new XYChart.Data(OUTROS, 120.0));
        
        grafico.getData().addAll(serie1, serie2);
    }

    private void inicializarBotaoAdicionar(Stage primaryStage) {
        btnAdicionar = new Button();
        
        btnAdicionar.setText(PropertiesBundle.getProperty("BOTAO_ADICIONAR"));
        btnAdicionar.setOnAction((ActionEvent event) -> {
            Stage stage= new Stage();
            CadastroHorasUI cadastroHorasUI = new CadastroHorasUI(cursoSelecionado);
            cadastroHorasUI.start(stage);
            primaryStage.close();
        });
    }

    private void inicializarBotaoVisualizar(Stage primaryStage) {
        btnVisualizar = new Button();
        
        btnVisualizar.setText(PropertiesBundle.getProperty("BOTAO_VISUALIZAR"));
        btnVisualizar.setOnAction((ActionEvent event) -> {
            Stage stage= new Stage();
            VisualizarHorasUI visualizarHorasUI = new VisualizarHorasUI(cursoSelecionado);
            visualizarHorasUI.start(stage);
            primaryStage.close();
        });
    }

    private void inicializarBotaoImportar(Stage primaryStage) {
        btnImportar = new Button();
        
        btnImportar.setText(PropertiesBundle.getProperty("BOTAO_IMPORTAR"));
        btnImportar.setOnAction((ActionEvent event) -> {
            Stage stage= new Stage();
            ImportarHorasUI importarHorasUI= new ImportarHorasUI(cursoSelecionado);
            importarHorasUI.start(stage);
            primaryStage.close();
        });
    }

    private void inicializarBotaoExportar(Stage primaryStage) {
        btnExportar = new Button();
        
        btnExportar.setText(PropertiesBundle.getProperty("BOTAO_EXPORTAR"));
        btnExportar.setOnAction((ActionEvent event) -> {
            Stage stage= new Stage();
            ExportarHorasUI exportarHorasUI= new ExportarHorasUI(cursoSelecionado);
            exportarHorasUI.start(stage);
            primaryStage.close();
        });
    }

    private void carregarRegrasDeCalculo() {
        ManipularXML<RegrasCalculoXML> manipulador = new ManipularXML<>("regras.xml");
        RegrasCalculoXML regrasCalculoXML = new RegrasCalculoXML();
        
        try {
            regrasCalculoXML = manipulador.buscar(RegrasCalculoXML.class);
        } catch (JAXBException ex) {
            Logger.getLogger(ResumoUI.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        for (RegraCalculo regra : regrasCalculoXML.getRegras()) {
            if (regra.getCodigo().equals(this.cursoSelecionado.getCodigo())) {
                this.regraCalculo = regra;
            }
        }
    }
    
}