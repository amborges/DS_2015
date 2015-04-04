package br.edu.ufpel.atividadecomplementar.modelos;

import java.util.ArrayList;
import java.util.List;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement(name = "regras")
@XmlAccessorType(XmlAccessType.FIELD)
public class RegrasCalculoXML {
    
    @XmlElement(name = "regra")
    private List<RegraCalculo> regras;

    public RegrasCalculoXML() {
        regras = new ArrayList<>();
    }

    public List<RegraCalculo> getRegras() {
        return regras;
    }

    public void setRegras(List<RegraCalculo> regras) {
        this.regras = regras;
    }
    
}
