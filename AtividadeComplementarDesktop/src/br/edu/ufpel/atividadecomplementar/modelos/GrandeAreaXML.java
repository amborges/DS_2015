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

@XmlRootElement(name = "grandesareas")
@XmlAccessorType(XmlAccessType.FIELD)

/**
 *
 * @author lucas
 */
public class GrandeAreaXML {
    
    @XmlElement(name = "grandearea")
    private GrandeArea grandeArea;

    public GrandeAreaXML(GrandeArea grandeArea) {
        this.grandeArea = grandeArea;
    }

    public GrandeArea getGrandeArea() {
        return grandeArea;
    }

    public void setGrandeArea(GrandeArea grandeArea) {
        this.grandeArea = grandeArea;
    }
    
}
