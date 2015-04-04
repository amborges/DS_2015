package br.edu.ufpel.atividadecomplementar.utils;

import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import javafx.scene.control.Alert;

public class AlertasUtils {

    public static void exibeErro(String mensagem) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        
        alert.setTitle(PropertiesBundle.getProperty("TITULO_ERRO"));
        alert.setHeaderText(null);
        alert.setContentText(PropertiesBundle.getProperty(mensagem));
        
        alert.showAndWait();
    }
    
    public static void exibeAlerta(String mensagem) {
        Alert alert = new Alert(Alert.AlertType.WARNING);
        
        alert.setTitle(PropertiesBundle.getProperty("TITULO_ERRO"));
        alert.setHeaderText(null);
        alert.setContentText(PropertiesBundle.getProperty(mensagem));
        
        alert.showAndWait();
    }
    
    public static void exibeInformacao(String mensagem) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        
        alert.setTitle(PropertiesBundle.getProperty("TITULO_ERRO"));
        alert.setHeaderText(null);
        alert.setContentText(PropertiesBundle.getProperty(mensagem));
        
        alert.showAndWait();
    }
    
}
