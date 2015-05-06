package br.edu.ufpel.atividadecomplementar.utils;

import java.text.Normalizer;

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
    
}
