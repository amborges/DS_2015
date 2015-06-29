package br.edu.ufpel.atividadecomplementar.interfacesgrafica.perfil;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipulaXML;
import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
import br.edu.ufpel.atividadecomplementar.modelos.Versoes;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.event.ActionEvent;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.GridPane;
import javafx.scene.text.TextAlignment;
import javafx.stage.Stage;
import javax.xml.bind.JAXBException;

public class SelecaoDePerfil extends InterfaceGrafica {

    private Button btnPerfilNovo;
    private Button btnPerfilAbrir;
    private Label lblVersaoCategoria;
    private Label lblVersaoCurso;
    private Label lblVersaoGrandeArea;
    private Label lblVersao;
    private Label lblCategoria;
    private Label lblCurso;
    private Label lblGrandeArea;
    
    public SelecaoDePerfil() {
        this.espacamentoHorizontal = espacamentoHorizontal * 2.0;
        this.telaAltura = telaAltura / 2.0;
        this.telaLargura = telaLargura / 2.0;
    }
    
    @Override
    protected void inicializarElementos(GridPane grid, Stage stage) {
        inicializarVersoesDosDados();
        inicializarButtonAbrir(stage);
        inicializarButtonNovo(stage);
        
        int i = 1;
        
        grid.add(btnPerfilNovo, 0, i++);
        grid.add(btnPerfilAbrir, 0, i);
                
        grid.add(lblVersao, 0, i+=3);
        grid.add(lblCategoria, 0, i);
        grid.add(lblVersaoCategoria, 1, i++);
        grid.add(lblCurso, 0, i);
        grid.add(lblVersaoCurso, 1, i++);
        grid.add(lblGrandeArea, 0, i);
        grid.add(lblVersaoGrandeArea, 1, i++);
        
        
    }
    
    private void inicializarVersoesDosDados() {
        String estilo = "-fx-font-weight: bold; -fx-font-size: 8px;";
        lblVersao = new Label("Versão dos dados");
        lblVersao.setStyle(estilo);
        lblCategoria = new Label("Categoria:");
        lblCategoria.setStyle(estilo);
        lblCurso = new Label("Curso:");
        lblCurso.setStyle(estilo);
        lblGrandeArea = new Label("Grande área:");
        lblGrandeArea.setStyle(estilo);
        lblVersaoCategoria = new Label("0.0");
        lblVersaoCategoria.setStyle(estilo);
        lblVersaoCurso = new Label("0.0");
        lblVersaoCurso.setStyle(estilo);
        lblVersaoGrandeArea = new Label("0.0");
        lblVersaoGrandeArea.setStyle(estilo);
        
        try {
            ManipulaXML<Versoes> manipulador = new ManipulaXML("versoes.xml");
            Versoes versoes = manipulador.buscar(Versoes.class);
            
            lblVersaoCategoria.setText(versoes.getVersaoCategoria().toString());
            lblVersaoCurso.setText(versoes.getVersaoCurso().toString());
            lblVersaoGrandeArea.setText(versoes.getVersaoGrandeArea().toString());
        } catch (JAXBException ex) {
            // Não faz nada
        }
    }

    private void inicializarButtonAbrir(Stage stage) {
        btnPerfilAbrir = new Button();
        btnPerfilAbrir.setText(PropertiesBundle.getProperty("BOTAO_ABRIR_PERFIL"));
        btnPerfilAbrir.setTextAlignment(TextAlignment.CENTER);
        btnPerfilAbrir.setMinWidth(larguraMinimaBotao);
        btnPerfilAbrir.setOnAction((ActionEvent event) -> {
            InterfaceGrafica abrePerfil = new AberturaDePerfil();
            abrePerfil.montarTela(stage);
        });
    }

    private void inicializarButtonNovo(Stage stage) {
        btnPerfilNovo = new Button();
        btnPerfilNovo.setText(PropertiesBundle.getProperty("BOTAO_NOVO_PERFIL"));
        btnPerfilNovo.setTextAlignment(TextAlignment.CENTER);
        btnPerfilNovo.setMinWidth(larguraMinimaBotao);
        btnPerfilNovo.setOnAction((ActionEvent event) -> {
            InterfaceGrafica cadastraPerfil = new CadastroDePerfil();
            cadastraPerfil.montarTela(stage);
        });
    }

}