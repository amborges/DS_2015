package br.edu.ufpel.atividadecomplementar.interfacesgrafica.template;

import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Label;
import javafx.scene.layout.GridPane;
import javafx.scene.paint.Color;
import javafx.stage.Stage;

/**
 * Classe que gera a base de cada tela do sistema.
 * 
 * @author Paulo
 */
public abstract class InterfaceGrafica {
    
    protected double espacamentoHorizontal = 10.0;
    protected double espacamentoVertical = 10.0;
    protected double paddingBottom = 30.0;
    protected double paddingLeft = 30.0;
    protected double paddingRight = 30.0;
    protected double paddingTop = 10.0;
    protected double telaAltura = 480.0;
    protected double telaLargura = 640.0;
    protected final double larguraMinimaBotao = 90.0;
    
    public void montarTela(Stage primaryStage) {
        GridPane grid = new GridPane();
        
        grid.setAlignment(Pos.CENTER);
        grid.setHgap(espacamentoHorizontal);
        grid.setVgap(espacamentoVertical);
        // Insets(top, right, bottom, left)
        grid.setPadding(new Insets(paddingTop, paddingRight, paddingBottom, paddingLeft));
        
        inicializarElementos(grid, primaryStage);
        
        Scene scene = new Scene(grid, telaLargura, telaAltura);
        
        primaryStage.setTitle(PropertiesBundle.getProperty("TITULO_APLICACAO"));
        primaryStage.setScene(scene);
        primaryStage.show();
    } 

    protected Label obrigatorio() {
        Label lblRequerido = new Label("*");
        
        lblRequerido.setTextFill(Color.RED);
        
        return lblRequerido;
    }
    
    /**
     * Método que deve ser implementado pelo objeto quem herda esta classe. 
     * Neste método deve ser inicializado os elementos e estes atribuídos a <b>grid</b>.
     * 
     * @param grid onde deve ser inserido os elementos da tela, como button, checkbox, etc.
     * @param stage
     */
    protected abstract void inicializarElementos(GridPane grid, Stage stage);
    
}
