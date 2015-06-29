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
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import javafx.beans.value.ChangeListener;
import javafx.beans.value.ObservableValue;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.scene.layout.GridPane;
import javafx.scene.text.TextAlignment;
import javafx.stage.Stage;
import javax.xml.bind.JAXBException;

public class CadastroDeAtividades extends InterfaceGrafica {

    private Aluno aluno;
    private Atividade atividade;
    private Button btnCancelar;
    private Button btnSalvar;
    private ComboBox cbxCategoria;
    private ComboBox cbxGrandeArea;
    private final Label lblCategoria = new Label(PropertiesBundle.getProperty("LABEL_CATEGORIA"));
    private final Label lblDataFinal = new Label(PropertiesBundle.getProperty("LABEL_DATA_FIM"));
    private final Label lblDataInicial = new Label(PropertiesBundle.getProperty("LABEL_DATA_INICIO"));
    private final Label lblDescricao = new Label(PropertiesBundle.getProperty("LABEL_DESCRICAO"));
    private final Label lblGrandeArea = new Label(PropertiesBundle.getProperty("LABEL_GRANDE_AREA"));
    private final Label lblHoras = new Label(PropertiesBundle.getProperty("LABEL_HORAS"));
    private Label lblTitulo;
    private TextField txtDataInicial;
    private TextField txtDataFinal;
    private TextField txtDescricao;
    private TextField txtHoras;
    
    /**
     * Construtor para a criação de atividades
     * 
     * @param aluno que terá a atividade cadastrada
     */
    public CadastroDeAtividades(Aluno aluno) {
        this.aluno = aluno;
        this.atividade = null;
    }
    
    /**
     * Construtor para edição de atividades
     * 
     * @param aluno que possui a atividade que será editada
     * @param atividade que será editada
     */
    public CadastroDeAtividades(Aluno aluno, Atividade atividade) {
        this.aluno = aluno;
        this.atividade = atividade;
    }

    @Override
    protected void inicializarElementos(GridPane grid, Stage stage) {
        inicializarLabelTitulo();
        inicilizarTextFieldDescricao();
        inicializarComboBoxGrandeArea();
        inicializarComboBoxCategoria();
        inicializarTextFieldHoras();
        inicializarTextFieldDataInicial();
        inicializarTextFieldDataFinal();
        inicializarButtonSalvar(stage);
        inicializarButtonCancelar(stage);
        
        int linha = 0;
        
        grid.add(lblTitulo, 1, linha++);
        
        grid.add(lblDescricao, 0, ++linha);
        grid.add(txtDescricao, 1, linha, 2, 1);
        grid.add(obrigatorio(), 3, linha);
        grid.add(lblGrandeArea, 0, ++linha);
        grid.add(cbxGrandeArea, 1, linha, 2, 1);
        grid.add(obrigatorio(), 3, linha);
        grid.add(lblCategoria, 0, ++linha);
        grid.add(cbxCategoria, 1, linha, 2, 1);
        grid.add(obrigatorio(), 3, linha);
        grid.add(lblHoras, 0, ++linha);
        grid.add(txtHoras, 1, linha, 2, 1);
        grid.add(obrigatorio(), 3, linha);
        grid.add(lblDataInicial, 0, ++linha);
        grid.add(txtDataInicial, 1, linha, 2, 1);
        grid.add(obrigatorio(), 3, linha);
        grid.add(lblDataFinal, 0, ++linha);
        grid.add(txtDataFinal, 1, linha++, 2, 1);
        grid.add(btnSalvar, 1, ++linha);
        grid.add(btnCancelar, 2, linha);
        
        if (atividade != null) {
            popularInformacoesEdicao();
        }
    }
    
    private void inicializarLabelTitulo() {
        String titulo;
        
        if (atividade == null) {
            titulo = PropertiesBundle.getProperty("LABEL_CADASTRO_ATIVIDADE");
        } else {
            titulo = PropertiesBundle.getProperty("LABEL_EDICAO_ATIVIDADE");
        }
        
        lblTitulo = new Label(titulo);
        lblTitulo.setStyle("-fx-font-weight: bold; -fx-font-size: 14px;");
    }
    
    private void inicilizarTextFieldDescricao() {
        txtDescricao = new TextField();
    }
    
    private void inicializarComboBoxGrandeArea() {
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
        
        cbxCategoria.setItems(null);
        cbxCategoria.setItems(categorias);
        cbxCategoria.setDisable(false);
        cbxCategoria.valueProperty().addListener(new ChangeListener() {

            @Override
            public void changed(ObservableValue observable, Object categoriaAnterior, Object categoriaNova) {
                boolean disabled;
                
                if (categoriaNova != null) {
                    Categoria categoria = (Categoria) categoriaNova;
                    if (txtHoras.getText() == null || txtHoras.getText().isEmpty()) {
                        txtHoras.setText(categoria.getHorasMaxima().toString());
                    }
                    disabled = false;
                } else {
                    disabled = true;
                }
                
                txtHoras.setDisable(disabled);
                txtDataInicial.setDisable(disabled);
                txtDataFinal.setDisable(disabled);
            }
            
        });
    }
    
    private void inicializarTextFieldHoras() {
        txtHoras = new TextField();
        txtHoras.setDisable(true);
    }
    
    private void inicializarTextFieldDataInicial() {
        txtDataInicial = new TextField();
        txtDataInicial.setDisable(true);
        
        MaskFieldUtil.dateField(txtDataInicial);
    }
    
    private void inicializarTextFieldDataFinal() {
        txtDataFinal = new TextField();
        txtDataFinal.setDisable(true);
        
        MaskFieldUtil.dateField(txtDataFinal);
    }
    
    private void inicializarButtonSalvar(Stage primaryStage) {
        btnSalvar = new Button();
        
        btnSalvar.setText(PropertiesBundle.getProperty("BOTAO_SALVAR"));
        btnSalvar.setTextAlignment(TextAlignment.CENTER);
        btnSalvar.setMinWidth(larguraMinimaBotao);
        btnSalvar.setOnAction((ActionEvent event) -> {
                String erros = validarDadosInformados();
                
                if (erros == null) {
                    if (atividade == null) {
                        cadastrarAtividade();
                        atividade = null;
                        this.montarTela(primaryStage);
                    } else {
                        editarAtividade();
                    }
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
                InterfaceGrafica interfaceGrafica;
                        
                if (atividade == null) {
                    interfaceGrafica = new ResumoDoPerfil(aluno);
                } else {
                    interfaceGrafica = new VisualizacaoDeAtividades(aluno);
                }
                
                interfaceGrafica.montarTela(stage);
                primaryStage.close();
            } catch(NullPointerException ex) {
                AlertasUtils.exibeErro(ex.getMessage());
            } catch(JAXBException ex) {
                AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
            }
        });
    }

    private String validarDadosInformados() {
        if ( ! campoFoiPreenchido(txtDescricao)) {
            return "ERRO_DESCRICAO_OBRIGATORIA";
        }
        
        if ( ! comboFoiSelecionada(cbxGrandeArea)) {
            return "ERRO_GRANDEAREA_OBRIGATORIA";
        }
        
        if ( ! comboFoiSelecionada(cbxCategoria)) {
            return "ERRO_CATEGORIA_OBRIGATORIA";
        }
        
        if ( ! campoFoiPreenchido(txtHoras)) {
            return "ERRO_HORAS_OBRIGATORIA";
        }
        
        if ( ! campoFoiPreenchido(txtDataInicial)) {
            return "ERRO_DATAINICIAL_OBRIGATORIA";
        }
        
        if (campoFoiPreenchido(txtDataFinal)) {
            LocalDate dataInicial = LocalDate.parse(txtDataInicial.getText(), DateTimeFormatter.ofPattern("dd/MM/yyyy"));
            LocalDate dataFinal = LocalDate.parse(txtDataFinal.getText(), DateTimeFormatter.ofPattern("dd/MM/yyyy"));
            
            if (dataFinal.compareTo(dataInicial) < 0) {
                return "ERRO_DATAFINAL_MENOR";
            }
        }
        
        return null;
    }
    
    private boolean campoFoiPreenchido(TextField campo) {
        if (campo.getText() != null && !campo.getText().isEmpty()) {
            return true;
        } else {
            return false;
        }
    }
    
    private boolean comboFoiSelecionada(ComboBox combobox) {
        if (combobox.getValue() != null) {
            return true;
        } else {
            return false;
        }
    }

    private void cadastrarAtividade() {
        atividade = new Atividade();
        popularInformacoesAtividade();
        aluno.adicionarAtividade(atividade);
        AlertasUtils.exibeInformacao("ATIVIDADE_SALVA_SUCESSO");
    }

    private void editarAtividade() {
        Atividade atividadeAntiga = new Atividade(atividade);
        popularInformacoesAtividade();
        aluno.alterarAtividade(atividadeAntiga, atividade);
        AlertasUtils.exibeInformacao("ATIVIDADE_SALVA_SUCESSO");
    }
    
    private void popularInformacoesAtividade() {
        atividade.setDescricao(txtDescricao.getText());
        atividade.setNomeGrandeArea(((GrandeArea)cbxGrandeArea.getValue()).getNome());
        atividade.setNomeCategoria(((Categoria)cbxCategoria.getValue()).getNomeCategoria());
        atividade.setHorasInformadas(Double.parseDouble(txtHoras.getText()));
        atividade.setDataInicial(txtDataInicial.getText());
        atividade.setDataFinal(txtDataFinal.getText());
    }
    
    private void popularInformacoesEdicao() {
        txtDescricao.setText(atividade.getDescricao());
        
        for(GrandeArea grandeAreaAtual : aluno.getCurso().getGrandesAreas()) {
            if (grandeAreaAtual.getNome().equals(atividade.getNomeGrandeArea())) {
                cbxGrandeArea.setValue(grandeAreaAtual);
                for (Categoria categoriaAtual : grandeAreaAtual.getCategorias()) {
                    if (categoriaAtual.getNomeCategoria().equals(atividade.getNomeCategoria())) {
                        cbxCategoria.setValue(categoriaAtual);
                        cbxCategoria.setDisable(false);
                        txtHoras.setDisable(false);
                        txtDataInicial.setDisable(false);
                        txtDataFinal.setDisable(false);
                        break;
                    }
                }
                break;
            }
        }
        
        txtHoras.setText(atividade.getHorasInformadas().toString());
        txtDataInicial.setText(atividade.getDataInicial());
        txtDataFinal.setText(atividade.getDataFinal());
    }

}