package br.edu.ufpel.atividadecomplementar.interfacesgrafica;

import br.edu.ufpel.atividadecomplementar.interfacesgrafica.perfil.SelecaoDePerfil;
import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
import javafx.application.Application;
import javafx.stage.Stage;

public class HomeUI extends Application {

    @Override
    public void start(Stage primaryStage) {
        InterfaceGrafica selecionaPerfil = new SelecaoDePerfil();
        
        selecionaPerfil.montarTela(primaryStage);
    }
    
    public static void main(String[] args) {
        launch(args);    
    }
    
}
