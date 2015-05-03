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

@XmlRootElement(name = "categorias")
@XmlAccessorType(XmlAccessType.FIELD)

/**
 *
 * @author lucas
 */
public class CategoriaXML {
    @XmlElement(name = "categoria")
    private List<Categoria> categoria;

    public CategoriaXML(List<Categoria> categoria) {
        this.categoria = categoria;
    }

    public List<Categoria> getCategoria() {
        return categoria;
    }

    public void setCategoria(List<Categoria> categoria) {
        this.categoria = categoria;
    }
    
}
