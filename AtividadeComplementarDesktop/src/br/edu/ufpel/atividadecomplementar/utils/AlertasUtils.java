package br.edu.ufpel.atividadecomplementar.utils;

import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import java.io.PrintWriter;
import java.io.StringWriter;
import java.util.MissingResourceException;
import javafx.scene.control.Alert;

public class AlertasUtils {

    public static void exibeErro(String mensagem) {
        montaMensagem(new Alert(Alert.AlertType.ERROR), mensagem);
    }
    
    public static void exibeErro(Exception ex) {
        final StringWriter sw = new StringWriter();
        final PrintWriter pw = new PrintWriter(sw, true);
        ex.printStackTrace(pw);
        montaMensagem(new Alert(Alert.AlertType.ERROR) ,sw.getBuffer().toString());
    }
    
    public static void exibeAlerta(String mensagem) {
        montaMensagem(new Alert(Alert.AlertType.WARNING), mensagem);
    }
    
    public static void exibeInformacao(String mensagem) {
        montaMensagem(new Alert(Alert.AlertType.INFORMATION), mensagem);
    }
    
    private static void montaMensagem(Alert alert, String mensagem) {
        alert.setTitle(PropertiesBundle.getProperty("TITULO_ERRO"));
        alert.setHeaderText(null);
        
        try {
            alert.setContentText(PropertiesBundle.getProperty(mensagem));
        } catch (MissingResourceException ex) {
            int tamanhoMaximoMensagem = 900;
            if (mensagem.length() > tamanhoMaximoMensagem) {
                mensagem = mensagem.substring(0, tamanhoMaximoMensagem);
            }
            alert.setContentText(mensagem);
        }
        
        alert.showAndWait();
    }
    
}
