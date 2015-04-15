package br.edu.ufpel.atividadecomplementar.interfacesgrafica;

import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import javafx.event.ActionEvent;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.GridPane;
import javafx.stage.Stage;

public class SelecionaPerfil extends InterfaceGrafica {

    private Button btnPerfilNovo;
    private Button btnPerfilAbrir;
    private Label lblPerfil;
    
    public SelecionaPerfil() {
        this.espacamentoHorizontal = espacamentoHorizontal * 2.0;
        this.telaAltura = telaAltura / 2.0;
        this.telaLargura = telaLargura / 2.0;
    }
    
    @Override
    protected void inicializarElementos(GridPane grid, Stage stage) {
        inicializarLabelPerfil();
        inicializarButtonAbrir(stage);
        inicializarButtonNovo(stage);
                
        grid.add(lblPerfil, 0, 0, 2, 1);
        grid.add(btnPerfilNovo, 0, 1);
        grid.add(btnPerfilAbrir, 1, 1);
    }

    private void inicializarLabelPerfil() {
        lblPerfil = new Label();
        lblPerfil.setText(PropertiesBundle.getProperty("OPCAO_PERFIL"));
    }
    
    private void inicializarButtonAbrir(Stage stage) {
        btnPerfilAbrir = new Button();
        btnPerfilAbrir.setText(PropertiesBundle.getProperty("BOTAO_ABRIR_PERFIL"));
        btnPerfilAbrir.setOnAction((ActionEvent event) -> {
            InterfaceGrafica abrePerfil = new AberturaDePerfil();
            abrePerfil.montarTela(stage);
        });
    }

    private void inicializarButtonNovo(Stage stage) {
        btnPerfilNovo = new Button();
        btnPerfilNovo.setText(PropertiesBundle.getProperty("BOTAO_NOVO_PERFIL"));
        btnPerfilNovo.setOnAction((ActionEvent event) -> {
            InterfaceGrafica cadastraPerfil = new CadastroDePerfil();
            cadastraPerfil.montarTela(stage);
        });
    }

}