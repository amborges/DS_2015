package br.edu.ufpel.atividadecomplementar.dadosXML;

import java.io.File;
import javax.xml.bind.JAXBContext;
import javax.xml.bind.JAXBException;
import javax.xml.bind.Marshaller;
import javax.xml.bind.Unmarshaller;

/**
 * Classe para a manipulação de XML de tipo genérico
 * 
 * @param <T> - tipo de objeto que se deseja manipular
 */
public class ManipularXML <T> {

    private final File file;
    private static final String CONF_PATH = "conf/";
    
    public ManipularXML(String nomeXML) {
        file = new File(CONF_PATH.concat(nomeXML));
    }
    
    /**
     * Método responsável por gravar o objeto em um arquivo XML
     * 
     * @param objeto - o objeto que se deseja salvar no arquivo XML
     * @param clazz - identificação do tipo de classe que deve ser gravado. 
     *  é necessário este parâmetro para que o JAXB saiba qual classe deve ser gravada
     * @throws JAXBException - em caso de erro do JAXB
     */
    public void salvar(T objeto, Class< ? extends T> clazz) throws JAXBException {
        JAXBContext jaxbContext = JAXBContext.newInstance(clazz);
        Marshaller marshaller = jaxbContext.createMarshaller();

        marshaller.setProperty(Marshaller.JAXB_FORMATTED_OUTPUT, true);

        marshaller.marshal(objeto, file);
    }
    
    /**
     * Método responsável por ler um arquivo XML e converter em XML
     * 
     * @param clazz - identificação do tipo de classe que deve ser lido. 
     *  é necessário este parâmetro para que o JAXB saiba qual classe deve ser lida
     * @return - o objeto convertido após a leitura do XML 
     * @throws JAXBException 
     */
    public T buscar(Class< ? extends T> clazz) throws JAXBException {
        JAXBContext jaxbContext = JAXBContext.newInstance(clazz);
        Unmarshaller unmarshaller = jaxbContext.createUnmarshaller();

        return (T) unmarshaller.unmarshal(file);
    }
    
}