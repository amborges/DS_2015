package br.edu.ufpel.atividadecomplementar.modelos;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement(name = "versoes")
@XmlAccessorType(XmlAccessType.FIELD)
public class Versoes {
    @XmlElement(name = "categoria")
    private Double categoria;
    @XmlElement(name = "curso")
    private Double curso;
    @XmlElement(name = "grande_area")
    private Double grandeArea;

    public Versoes() {
        categoria = 0.0;
        curso = 0.0;
        grandeArea = 0.0;
    }
    
    public Double getCategoria() {
        return categoria;
    }

    public void setCategoria(Double categoria) {
        this.categoria = categoria;
    }

    public Double getCurso() {
        return curso;
    }

    public void setCurso(Double curso) {
        this.curso = curso;
    }

    public Double getGrandeArea() {
        return grandeArea;
    }

    public void setGrandeArea(Double grandeArea) {
        this.grandeArea = grandeArea;
    }

}
