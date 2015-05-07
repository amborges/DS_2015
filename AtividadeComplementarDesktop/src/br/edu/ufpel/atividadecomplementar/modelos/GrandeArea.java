/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package br.edu.ufpel.atividadecomplementar.modelos;

import java.util.List;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author lucas
 */
@XmlRootElement(name = "grandearea")
@XmlAccessorType(XmlAccessType.FIELD)
public class GrandeArea {
    
    private String nome;
    @XmlElement(name = "horaminima")
    private double horaMinima;
    @XmlElement(name = "categorias")
    private CategoriaXML categorias;
    
    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public double getHoraMinima() {
        return horaMinima;
    }

    public void setHoraMinima(double horaMinima) {
        this.horaMinima = horaMinima;
    }

    public List<Categoria> getCategorias() {
        return categorias.getCategoria();
    }

    public void setCategorias(CategoriaXML categorias) {
        this.categorias = categorias;
    }

    @Override
    public String toString() {
        return nome;
    }
    
}
