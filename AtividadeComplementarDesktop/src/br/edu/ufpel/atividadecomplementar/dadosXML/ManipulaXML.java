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
public class ManipulaXML <T> {

    private final File file;
    
    /**
     * Construtor para manipular XMLs que estão no diretório 'conf/', normalmente
     *  os arquivos de configurações, como 'cursos.xml', 'regras.xml'
     * 
     * @param nomeXML nome do XML que será aberto
     */
    public ManipulaXML(String nomeXML) {
        file = new File("conf/".concat(nomeXML));
        file.getParentFile().mkdirs();
    }
    
    /**
     * Construtor para manipular XMLs que estão no diretório representado pelo
     *  parâmetro pathXML. No parâmetro pathUtilizar
     * 
     * @param nomeXML nome do XML que será aberto
     * @param pathXML diretório que contém o XML - utilizar sempre com a barra, ex.: <font color="red">src/</font>
     */
    public ManipulaXML(String nomeXML, String pathXML) {
        file = new File(pathXML.concat(nomeXML));
        file.getParentFile().mkdirs();
    }
    
    /**
     * Método responsável por gravar o objeto em um arquivo XML
     * 
     * @param objeto o objeto que se deseja salvar no arquivo XML
     * @param clazz identificação do tipo de classe que deve ser gravado. 
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
     * @param clazz identificação do tipo de classe que deve ser lido. 
     *  é necessário este parâmetro para que o JAXB saiba qual classe deve ser lida
     * @return o objeto convertido após a leitura do XML 
     * @throws JAXBException 
     */
    public T buscar(Class< ? extends T> clazz) throws JAXBException {
        JAXBContext jaxbContext = JAXBContext.newInstance(clazz);
        Unmarshaller unmarshaller = jaxbContext.createUnmarshaller();

        return (T) unmarshaller.unmarshal(file);
    } 
    
}