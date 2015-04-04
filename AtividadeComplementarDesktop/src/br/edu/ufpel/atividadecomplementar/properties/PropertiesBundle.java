package br.edu.ufpel.atividadecomplementar.properties;

import java.util.ResourceBundle;

public class PropertiesBundle {
    
    private static final String baseName = "br.edu.ufpel.atividadecomplementar.properties.resource";
    
    public static String getProperty(String key) {
        return ResourceBundle.getBundle(baseName).getString(key);
    } 
    
}
