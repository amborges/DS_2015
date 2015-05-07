/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package br.edu.ufpel.atividadecomplementar.modelos;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author lucas
 */
@XmlRootElement(name = "categoria")
@XmlAccessorType(XmlAccessType.FIELD)
public class Categoria {
    
    @XmlElement(name = "nomecategoria")
    private String nomeCategoria;
    @XmlElement(name = "horasmaxima")
    private double horasMaxima;
    
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

    @Override
    public String toString() {
        return nomeCategoria;
    }

}
