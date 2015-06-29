package br.edu.ufpel.atividadecomplementar.interfacesgrafica;

import br.edu.ufpel.atividadecomplementar.interfacesgrafica.perfil.AberturaDePerfil;
import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
import javafx.application.Application;
import javafx.stage.Stage;

public class HomeUI extends Application {

    @Override
    public void start(Stage primaryStage) {
        InterfaceGrafica ui = new AberturaDePerfil();
        
        ui.montarTela(primaryStage);
    }
    
    public static void main(String[] args) {
        launch(args);    
    }
    
}
