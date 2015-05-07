package br.edu.ufpel.atividadecomplementar.modelos;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipulaXML;
import java.util.List;
import javax.xml.bind.JAXBException;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement(name = "curso")
@XmlAccessorType(XmlAccessType.FIELD)
public class Curso {
    
    private Integer codigo;
    private String nome;
    @XmlElement(name = "grandesareas")
    private GrandeAreaXML grandesAreas;

    public Integer getCodigo() {
        return codigo;
    }

    public void setCodigo(Integer id) {
        this.codigo = id;
    }

    public String getNome() {
        return nome;
    }
    
    public void setNome(String nome) {
        this.nome = nome;
    }

    public List<GrandeArea> getGrandesAreas() {
        return grandesAreas.getGrandesAreas();
    }

    public void setGrandesAreas(GrandeAreaXML grandesAreas) {
        this.grandesAreas = grandesAreas;
    }
    
    public Curso carregarInformacoes() throws JAXBException {
        ManipulaXML<Curso> manipulador = new ManipulaXML<>(codigo.toString().concat("_curso.xml"));
        
        return manipulador.buscar(Curso.class);
    }
    
    @Override
    public String toString() {
        return nome;
    }
    
}
