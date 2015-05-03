/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package br.edu.ufpel.atividadecomplementar.modelos;

import java.util.ArrayList;
import java.util.List;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement(name = "atividades")
@XmlAccessorType(XmlAccessType.FIELD)

/**
 *
 * @author lucas
 */
public class AtividadeXML {
    
    @XmlElement(name = "atividade")
    private List<Atividade> atividades;

    public AtividadeXML() {
        atividades = new ArrayList<>();
    }
    
    public List<Atividade> getAtividades() {
        return atividades;
    }

    public void setAtividades(List<Atividade> atividades) {
        this.atividades = atividades;
    }
    
}
