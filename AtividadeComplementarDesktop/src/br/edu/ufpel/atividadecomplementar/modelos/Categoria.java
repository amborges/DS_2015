/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package br.edu.ufpel.atividadecomplementar.modelos;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipulaXML;
import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import javax.xml.bind.JAXBException;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;

import javax.xml.bind.annotation.XmlTransient;

/**
 *
 * @author lucas
 */
@XmlRootElement(name = "categoria")
@XmlAccessorType(XmlAccessType.FIELD)
public class Categoria {
    
    private String nomeCategoria;
    private double horasMaxima;
    
    @XmlTransient
    private GrandeArea grandeArea;

    public String getNomeCategoria() {
        return nomeCategoria;
    }

    public void setNomeCategoria(String nomeCategoria) {
        this.nomeCategoria = nomeCategoria;
    }

    public double getHorasMaxima() {
        return horasMaxima;
    }

    public void setHorasMaxima(double horasMaxima) {
        this.horasMaxima = horasMaxima;
    }

    public GrandeArea getGrandeArea() {
        return grandeArea;
    }

    public void setGrandeArea(GrandeArea grandeArea) {
        this.grandeArea = grandeArea;
    }
    
    
    
    
}
