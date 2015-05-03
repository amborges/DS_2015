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

@XmlRootElement(name = "periodos")
@XmlAccessorType(XmlAccessType.FIELD)

/**
 *
 * @author lucas
 */
public class PeriodoXML {
    
    @XmlElement(name = "periodo")
    private List<Periodo> periodo;

    public List<Periodo> getPeriodo() {
        return periodo;
    }

    public void setPeriodo(List<Periodo> periodo) {
        this.periodo = periodo;
    }

    public PeriodoXML(List<Periodo> periodo) {
        this.periodo = periodo;
    }
    
}
