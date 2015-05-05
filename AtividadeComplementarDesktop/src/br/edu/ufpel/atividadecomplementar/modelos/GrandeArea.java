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

/**
 *
 * @author lucas
 */
@XmlRootElement(name = "grandearea")
@XmlAccessorType(XmlAccessType.FIELD)
public class GrandeArea {
    
    private String nome;
    private double horaMinima;
    private Integer codigoCurso;
    
    @XmlTransient
    private Curso curso;

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

    public Curso getCurso() {
        if (curso == null) {
            carregaCurso();
        }
        return curso;
    }

    public void setCurso(Curso curso) {
        this.curso = curso;
        this.codigoCurso = curso.getCodigo();
    }
    
    private void carregaCurso() {
        ManipulaXML<CursosXML> manipulador = new ManipulaXML("cursos.xml");
        CursosXML cursosXML;
        
        try {
            cursosXML = manipulador.buscar(CursosXML.class);
            
            for (Curso cursoAtual : cursosXML.getCursos()) {
                if (codigoCurso.equals(cursoAtual.getCodigo())) {
                    this.curso = cursoAtual;
                    return;
                }
            }
        } catch (JAXBException ex) {
            AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
        }
    }

    @Override
    public String toString() {
        return nome;
    }
    
}
