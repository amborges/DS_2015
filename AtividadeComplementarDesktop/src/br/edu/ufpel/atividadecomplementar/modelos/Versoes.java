package br.edu.ufpel.atividadecomplementar.modelos;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement(name = "versoes")
@XmlAccessorType(XmlAccessType.FIELD)
public class Versoes {
    @XmlElement(name = "categoria")
    private Double versaoCategoria;
    @XmlElement(name = "curso")
    private Double versaoCurso;
    @XmlElement(name = "grande_area")
    private Double versaoGrandeArea;

    public Double getVersaoCategoria() {
        return versaoCategoria;
    }

    public void setVersaoCategoria(Double versaoCategoria) {
        this.versaoCategoria = versaoCategoria;
    }

    public Double getVersaoCurso() {
        return versaoCurso;
    }

    public void setVersaoCurso(Double versaoCurso) {
        this.versaoCurso = versaoCurso;
    }

    public Double getVersaoGrandeArea() {
        return versaoGrandeArea;
    }

    public void setVersaoGrandeArea(Double versaoGrandeArea) {
        this.versaoGrandeArea = versaoGrandeArea;
    }

}
