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

/**
 *
 * @author lucas
 */
@XmlRootElement(name = "grandesareas")
@XmlAccessorType(XmlAccessType.FIELD)
public class GrandeAreaXML {
    
    @XmlElement(name = "grandearea")
    private List<GrandeArea> grandesAreas;

    public GrandeAreaXML() {
        this.grandesAreas = new ArrayList<>();
    }

    public List<GrandeArea> getGrandesAreas() {
        return grandesAreas;
    }

    public void setGrandesAreas(List<GrandeArea> grandesAreas) {
        this.grandesAreas = grandesAreas;
    }

}
