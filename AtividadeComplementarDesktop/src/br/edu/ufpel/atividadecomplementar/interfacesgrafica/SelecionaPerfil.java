package br.edu.ufpel.atividadecomplementar.interfacesgrafica;

import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import javafx.event.ActionEvent;
import javafx.scene.control.Button;
import javafx.scene.layout.GridPane;
import javafx.scene.text.TextAlignment;
import javafx.stage.Stage;

public class SelecionaPerfil extends InterfaceGrafica {

    private Button btnPerfilNovo;
    private Button btnPerfilAbrir;
    
    public SelecionaPerfil() {
        this.espacamentoHorizontal = espacamentoHorizontal * 2.0;
        this.telaAltura = telaAltura / 2.0;
        this.telaLargura = telaLargura / 2.0;
    }
    
    @Override
    protected void inicializarElementos(GridPane grid, Stage stage) {
        inicializarButtonAbrir(stage);
        inicializarButtonNovo(stage);
                
        grid.add(btnPerfilNovo, 0, 1);
        grid.add(btnPerfilAbrir, 0, 2);
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