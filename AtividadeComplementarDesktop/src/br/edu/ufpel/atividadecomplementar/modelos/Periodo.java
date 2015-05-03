/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package br.edu.ufpel.atividadecomplementar.modelos;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;

/**
 *
 * @author lucas
 */
@XmlRootElement(name = "atividade")
@XmlAccessorType(XmlAccessType.FIELD)
public class Periodo {
    
    private Date dataInicial;
    private Date dataFinal;
    private boolean apenasUmDia;
    private boolean atividadeSemestral;
    private double horas;

    public Date getDataInicial() {
        return dataInicial;
    }

    public void setDataInicial(Date dataInicial) {
        this.dataInicial = dataInicial;
    }

    public Date getDataFinal() {
        return dataFinal;
    }

    public void setDataFinal(Date dataFinal) {
        this.dataFinal = dataFinal;
    }

    public boolean isApenasUmDia() {
        return apenasUmDia;
    }

    public void setApenasUmDia(boolean apenasUmDia) {
        this.apenasUmDia = apenasUmDia;
    }

    public boolean isAtividadeSemestral() {
        return atividadeSemestral;
    }

    public void setAtividadeSemestral(boolean atividadeSemestral) {
        this.atividadeSemestral = atividadeSemestral;
    }

    public double getHoras() {
        return horas;
    }

    public void setHoras(double horas) {
        this.horas = horas;
    }
    
}
