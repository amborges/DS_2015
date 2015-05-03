package br.edu.ufpel.atividadecomplementar.modelos;

import java.util.ArrayList;
import java.util.List;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;

/**
 *
 * @author Paulo
 */
@XmlRootElement(name = "atividade")
@XmlAccessorType(XmlAccessType.FIELD)
public class Atividade {
    
    private String descricao;
    private double horaInformada;
    private double horaValidada;
    private String enderecoCertificado;
    
    @XmlTransient
    private Periodo periodo;
    private Aluno aluno;
    private Categoria categoria;

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public double getHoraInformada() {
        return horaInformada;
    }

    public void setHoraInformada(double horaInformada) {
        this.horaInformada = horaInformada;
    }

    public double getHoraValidada() {
        return horaValidada;
    }

    public void setHoraValidada(double horaValidada) {
        this.horaValidada = horaValidada;
    }

    public String getEnderecoCertificado() {
        return enderecoCertificado;
    }

    public void setEnderecoCertificado(String enderecoCertificado) {
        this.enderecoCertificado = enderecoCertificado;
    }

    public Periodo getPeriodo() {
        return periodo;
    }

    public void setPeriodo(Periodo periodo) {
        this.periodo = periodo;
    }

    public Aluno getAluno() {
        return aluno;
    }

    public void setAluno(Aluno aluno) {
        this.aluno = aluno;
    }

    public Categoria getCategoria() {
        return categoria;
    }

    public void setCategoria(Categoria categoria) {
        this.categoria = categoria;
    }
    
}
