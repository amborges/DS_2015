package br.edu.ufpel.atividadecomplementar.utils;

import java.text.Normalizer;
import javafx.beans.value.ChangeListener;
import javafx.beans.value.ObservableValue;
import javafx.scene.control.TextField;

public class StringUtils {

    /**
     * Método para remover os acentos de uma string.
     * 
     * @param nomeArquivo String que representa o nome do arquivo.
     * @return nome do arquivo sem acentos.
     */
    public static String removerAcentos(String nomeArquivo) {
        return Normalizer.normalize(nomeArquivo, Normalizer.Form.NFD).replaceAll("[^\\p{ASCII}]", "");
    }
    
    /**
     * Método para adicionar um tamanho máximo a um TextField
     * 
     * @param textField o campo que terá seu tamanho limitado
     * @param maxLength o tamanho que o campo deve ser limitado
     */
    public static void adicionarTamanhoMaximoTextField(final TextField textField, final int maxLength) {
    
        textField.textProperty().addListener(new ChangeListener<String>() {
            
            @Override
            public void changed(ObservableValue<? extends String> observable, String oldValue, String newValue) {
                if (textField.getText().length() > maxLength) {
                    String s = textField.getText().substring(0, maxLength);
                    textField.setText(s);
                }
            }
            
        });
        
    }
    
}
