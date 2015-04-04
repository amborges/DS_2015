package br.edu.ufpel.atividadecomplementar.modelos;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlRootElement;

/**
 * Classe com as informações de horas que deve ser recuperadas do arquivo XML.
 */
@XmlRootElement(name = "regra")
@XmlAccessorType(XmlAccessType.FIELD)
public class RegraCalculo {
    
    private Integer codigo;
    private double horasTotalEnsino;
    private double horasTotalExtensao;
    private double horasTotalPesquisa;

    public Integer getCodigo() {
        return codigo;
    }

    public void setCodigo(Integer codigo) {
        this.codigo = codigo;
    }

    public double getHorasTotalEnsino() {
        return horasTotalEnsino;
    }

    public void setHorasTotalEnsino(double horasTotalEnsino) {
        this.horasTotalEnsino = horasTotalEnsino;
    }

    public double getHorasTotalExtensao() {
        return horasTotalExtensao;
    }

    public void setHorasTotalExtensao(double horasTotalExtensao) {
        this.horasTotalExtensao = horasTotalExtensao;
    }

    public double getHorasTotalPesquisa() {
        return horasTotalPesquisa;
    }

    public void setHorasTotalPesquisa(double horasTotalPesquisa) {
        this.horasTotalPesquisa = horasTotalPesquisa;
    }
    
}
