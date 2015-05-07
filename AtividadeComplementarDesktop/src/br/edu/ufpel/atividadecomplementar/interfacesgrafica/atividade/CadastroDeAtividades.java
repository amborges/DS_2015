package br.edu.ufpel.atividadecomplementar.interfacesgrafica.atividade;

import br.edu.ufpel.atividadecomplementar.interfacesgrafica.perfil.ResumoDoPerfil;
import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
import br.edu.ufpel.atividadecomplementar.modelos.Aluno;
import br.edu.ufpel.atividadecomplementar.modelos.Atividade;
import br.edu.ufpel.atividadecomplementar.modelos.Categoria;
import br.edu.ufpel.atividadecomplementar.modelos.GrandeArea;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import br.edu.ufpel.atividadecomplementar.utils.MaskFieldUtil;
import javafx.beans.value.ChangeListener;
import javafx.beans.value.ObservableValue;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.RadioButton;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.layout.GridPane;
import javafx.scene.text.TextAlignment;
import javafx.stage.Stage;
import javax.xml.bind.JAXBException;

public class CadastroDeAtividades extends InterfaceGrafica {

    private Aluno aluno;
    private Button btnAdicionar;
    private Button btnCancelar;
//    private Button btnPdfAtividade; 
    private ComboBox cbxAno;
    private ComboBox cbxCategoria;
    private ComboBox cbxGrandeArea;
    private Label lblAno;
    private final Label lblCategoria = new Label(PropertiesBundle.getProperty("LABEL_CATEGORIA"));
    private Label lblDataFinal;
    private Label lblDataInicial;
    private final Label lblDescricao = new Label(PropertiesBundle.getProperty("LABEL_DESCRICAO"));
    private final Label lblGrandeArea = new Label(PropertiesBundle.getProperty("LABEL_GRANDE_AREA"));
    private Label lblHoras;
//    private final Label lblPdfAtividade = new Label(PropertiesBundle.getProperty("LABEL_PDF_ATIVIDADE"));
    private Label lblSemestre;
    private RadioButton rdbSemestre1;
    private RadioButton rdbSemestre2;
    private String tipoInformacao = "D";
    private TextArea txtDescricao;
    private TextField txtHoras;
    private TextField txtDataInicial;
    private TextField txtDataFinal;
    
    public CadastroDeAtividades(Aluno aluno) {
        this.aluno = aluno;
    }

    @Override
    protected void inicializarElementos(GridPane grid, Stage stage) {
        inicializarTextAreaDescricao();
        try {
            inicializarComboBoxGrandeArea();
            inicializarComboBoxCategoria();
        } catch (JAXBException ex) {
            AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
        }
//        inicializarButtonPdfAtividade(stage);
        inicializarButtonAdicionar(stage);
        inicializarButtonCancelar(stage);
        
        Integer numLinha = 0;
        
        grid.add(lblDescricao, 0, numLinha);
        grid.add(txtDescricao, 1, numLinha, 2, 1);
        grid.add(obrigatorio(), 3, numLinha);
        grid.add(lblGrandeArea, 0, ++numLinha);
        grid.add(cbxGrandeArea, 1, numLinha, 2, 1);
        grid.add(obrigatorio(), 3, numLinha);
        grid.add(lblCategoria, 0, ++numLinha);
        grid.add(cbxCategoria, 1, numLinha, 2, 1);
        grid.add(obrigatorio(), 3, numLinha);
        
        numLinha = inicializarTipoInformacao(grid, numLinha);
        
//        switch (tipoInformacao) {
//            case "A":
//                numLinha = inicializarTipoInformacao1(grid, numLinha);
//                break;
                
//            case "B":
//                numLinha = inicializarTipoInformacao2(grid, numLinha);
//                break;
                
//            case "C":
//                numLinha = inicializarTipoInformacao3(grid, numLinha);
//                break;
//        }
        
//        grid.add(lblPdfAtividade, 0, ++numLinha);
//        grid.add(btnPdfAtividade, 1, numLinha++);
        grid.add(btnAdicionar, 1, numLinha+=2);
        grid.add(btnCancelar, 2, numLinha);
    }
    
    private void inicializarTextAreaDescricao() {
        txtDescricao = new TextArea();
        txtDescricao.setPrefRowCount(2);
        txtDescricao.setPrefColumnCount(20);
        txtDescricao.setWrapText(true);
    }

    private void inicializarComboBoxGrandeArea() throws JAXBException {
        ObservableList<GrandeArea> grandeArea = FXCollections.observableArrayList();
        
        grandeArea.addAll(aluno.getCurso().getGrandesAreas());
        
        cbxGrandeArea = new ComboBox();
        cbxGrandeArea.setItems(grandeArea);
        cbxGrandeArea.valueProperty().addListener(new ChangeListener() {

            @Override
            public void changed(ObservableValue observable, Object grandeAreaAnterior, Object grandeAreaNova) {
                if (grandeAreaNova != null) {
                    atualizarComboBoxCategoria((GrandeArea) grandeAreaNova);
                }
            }
            
        });
    }

    private void inicializarComboBoxCategoria() {
        cbxCategoria = new ComboBox();
        cbxCategoria.setDisable(true);
    }
    
    private void atualizarComboBoxCategoria(GrandeArea grandeArea) {
        ObservableList<Categoria> categorias = FXCollections.observableArrayList();
        
        categorias.addAll(grandeArea.getCategorias());
        
        cbxCategoria.setItems(categorias);
        cbxCategoria.setDisable(false);
    }
    
//    private void inicializarButtonPdfAtividade(Stage primaryStage) {
//        btnPdfAtividade = new Button();
//        
//        btnPdfAtividade.setText(PropertiesBundle.getProperty("BOTAO_CARREGAR_ARQUIVO"));
//        btnPdfAtividade.setTextAlignment(TextAlignment.CENTER);
//        btnPdfAtividade.setMinWidth(larguraMinimaBotao);
//        btnPdfAtividade.setOnAction((ActionEvent event) -> {
//                Stage stage= new Stage();
//                ResumoDoPerfil resumoUI= new ResumoDoPerfil((Curso)cbxCurso.getValue());
//                resumoUI.start(stage);
//                primaryStage.close();
//        });
//    }

    private void inicializarButtonAdicionar(Stage primaryStage) {
        btnAdicionar = new Button();
        
        btnAdicionar.setText(PropertiesBundle.getProperty("BOTAO_ADICIONAR"));
        btnAdicionar.setTextAlignment(TextAlignment.CENTER);
        btnAdicionar.setMinWidth(larguraMinimaBotao);
        btnAdicionar.setOnAction((ActionEvent event) -> {
                String erros = validarDadosInformados();
                
                if (erros == null) {
                    Atividade atividade = new Atividade();
                    atividade.setDescricao(txtDescricao.getText());
                    atividade.setNomeGrandeArea(((GrandeArea)cbxGrandeArea.getValue()).getNome());
                    atividade.setNomeCategoria(((Categoria)cbxCategoria.getValue()).getNomeCategoria());
                    atividade.setHoraInformada(Double.parseDouble(txtHoras.getText()));
                    atividade.setDataInicial(txtDataInicial.getText());
                    atividade.setDataFinal(txtDataFinal.getText());
                    //atividade.setAno();
                    //atividade.setSemestre(semestre);

    //                Stage stage= new Stage();
    //                ResumoDoPerfil resumoUI= new ResumoDoPerfil((Curso)cbxCurso.getValue());
    //                resumoUI.start(stage);
    //                primaryStage.close();
                    aluno.adicionaAtividade(atividade);

                    AlertasUtils.exibeInformacao("ATIVIDADE_SALVA_SUCESSO");

                    this.montarTela(primaryStage);
                } else {
                    AlertasUtils.exibeErro(erros);
                }
                
        });
    }

    private void inicializarButtonCancelar(Stage primaryStage) {
        btnCancelar = new Button();
        
        btnCancelar.setText(PropertiesBundle.getProperty("BOTAO_CANCELAR"));
        btnCancelar.setTextAlignment(TextAlignment.CENTER);
        btnCancelar.setMinWidth(larguraMinimaBotao);
        btnCancelar.setOnAction((ActionEvent event) -> {
            try {
                Stage stage= new Stage();
                InterfaceGrafica resumoDoPerfil= new ResumoDoPerfil(aluno);
                resumoDoPerfil.montarTela(stage);
                primaryStage.close();
            } catch(NullPointerException ex) {
                AlertasUtils.exibeErro(ex.getMessage());
            } catch(JAXBException ex) {
                AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
            }
        });
    }
    
    private int inicializarTipoInformacao(GridPane grid, int numLinha) {
        lblHoras = new Label(PropertiesBundle.getProperty("LABEL_HORAS"));
        lblDataInicial = new Label(PropertiesBundle.getProperty("LABEL_DATA_INICIO"));
        lblDataFinal = new Label(PropertiesBundle.getProperty("LABEL_DATA_FIM"));
        lblAno = new Label(PropertiesBundle.getProperty("LABEL_ANO"));
//        lblSemestre = new Label(PropertiesBundle.getProperty("LABEL_SEMESTRE"));
        txtHoras = new TextField();
        txtDataInicial = new TextField();
        txtDataFinal = new TextField();
        
        MaskFieldUtil.dateField(txtDataInicial);
        MaskFieldUtil.dateField(txtDataFinal);
        
        grid.add(lblHoras, 0, ++numLinha);
        grid.add(txtHoras, 1, numLinha, 2, 1);
        grid.add(obrigatorio(), 3, numLinha);
        grid.add(lblDataInicial, 0, ++numLinha);
        grid.add(txtDataInicial, 1, numLinha, 2, 1);
        grid.add(obrigatorio(), 3, numLinha);
        grid.add(lblDataFinal, 0, ++numLinha);
        grid.add(txtDataFinal, 1, numLinha, 2, 1);
        
        return numLinha;
    }

/*
    private int inicializarTipoInformacao1(GridPane grid, int numLinha) {
        lblHoras = new Label(PropertiesBundle.getProperty("LABEL_HORAS"));
        lblDataInicial = new Label(PropertiesBundle.getProperty("LABEL_DATA"));
        txtHoras = new TextField();
        txtDataInicial = new TextField();
        
        MaskFieldUtil.dateField(txtDataInicial);
                
        grid.add(lblHoras, 0, ++numLinha);
        grid.add(txtHoras, 1, numLinha);
        grid.add(lblDataInicial, 0, ++numLinha);
        grid.add(txtDataInicial, 1, numLinha);
        
        return numLinha;
    }
    
    private int inicializarTipoInformacao2(GridPane grid, int numLinha) {
        lblHoras = new Label(PropertiesBundle.getProperty("LABEL_HORAS"));
        lblDataInicial = new Label(PropertiesBundle.getProperty("LABEL_DATA_INICIO"));
        lblDataFinal = new Label(PropertiesBundle.getProperty("LABEL_DATA_FIM"));
        txtHoras = new TextField();
        txtDataInicial = new TextField();
        txtDataFinal = new TextField();
        
        MaskFieldUtil.dateField(txtDataInicial);
        MaskFieldUtil.dateField(txtDataFinal);
        
        grid.add(lblHoras, 0, ++numLinha);
        grid.add(txtHoras, 1, numLinha);
        grid.add(lblDataInicial, 0, ++numLinha);
        grid.add(txtDataInicial, 1, numLinha);
        grid.add(lblDataFinal, 0, ++numLinha);
        grid.add(txtDataFinal, 1, numLinha);
        
        return numLinha;
    }
    
    private int inicializarTipoInformacao3(GridPane grid, int numLinha) {
        cbxAno = new ComboBox();
        lblAno = new Label(PropertiesBundle.getProperty("LABEL_ANO"));
        lblSemestre = new Label(PropertiesBundle.getProperty("LABEL_SEMESTRE"));
        final ToggleGroup group = new ToggleGroup();
        
        ObservableList<Integer> anos = FXCollections.observableArrayList();
        
        for (int ano = Calendar.getInstance().get(Calendar.YEAR); ano > 2000; ano--) {
            anos.add(ano);
        }
        
        cbxAno.setItems(anos);
        
        rdbSemestre1 = new RadioButton(PropertiesBundle.getProperty("SEMESTRE_UM"));
        rdbSemestre1.setToggleGroup(group);
        
        rdbSemestre2 = new RadioButton(PropertiesBundle.getProperty("SEMESTRE_DOIS"));
        rdbSemestre2.setToggleGroup(group);
        
        grid.add(lblAno, 0, ++numLinha);
        grid.add(cbxAno, 1, numLinha);
        grid.add(lblSemestre, 0, ++numLinha);
        grid.add(rdbSemestre1, 1, numLinha);
        grid.add(rdbSemestre2, 2, numLinha);
        
        return numLinha;
    }
*/

    private String validarDadosInformados() {
        if (txtDescricao.getText() == null || txtDescricao.getText().isEmpty()) {
            return "ERRO_DESCRICAO_OBRIGATORIA";
        }
        
        if (cbxGrandeArea.getValue() == null) {
            return "ERRO_GRANDEAREA_OBRIGATORIA";
        }
        
        if (cbxCategoria.getValue() == null) {
            return "ERRO_CATEGORIA_OBRIGATORIA";
        }
        
        if (txtHoras.getText() == null || txtHoras.getText().isEmpty()) {
            return "ERRO_HORAS_OBRIGATORIA";
        }
        
        if (txtDataInicial.getText() == null || txtDataInicial.getText().isEmpty()) {
            return "ERRO_DATAINICIAL_OBRIGATORIA";
        }
        
        return null;
    }
}