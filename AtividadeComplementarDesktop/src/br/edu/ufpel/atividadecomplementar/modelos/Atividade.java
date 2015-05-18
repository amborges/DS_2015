package br.edu.ufpel.atividadecomplementar.modelos;

import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author Paulo
 */
@XmlRootElement(name = "atividade")
@XmlAccessorType(XmlAccessType.FIELD)
public class Atividade {
    
    private String descricao;
    private Double horasInformadas;
    private Double horasContabilizadas;
    private String dataInicial;
    private String dataFinal;
    private String nomeGrandeArea;
    private String nomeCategoria;
    
    /* Construtores */
    public Atividade() {}

    public Atividade(Atividade atividade) {
        this.descricao = atividade.getDescricao();
        this.horasInformadas = atividade.getHorasInformadas();
        this.horasContabilizadas = atividade.getHorasContabilizadas();
        this.dataInicial = atividade.getDataInicial();
        this.dataFinal = atividade.getDataFinal();
        this.nomeGrandeArea = atividade.getNomeGrandeArea();
        this.nomeCategoria = atividade.getNomeCategoria();
    }
    
    /* Getters e Setters */
    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public Double getHorasInformadas() {
        return horasInformadas;
    }

    public void setHorasInformadas(Double horaInformada) {
        this.horasInformadas = horaInformada;
    }

    public Double getHorasContabilizadas() {
        return horasContabilizadas;
    }

    public String getDataInicial() {
        return dataInicial;
    }

    public void setDataInicial(String dataInicial) {
        this.dataInicial = dataInicial;
    }

    public String getDataFinal() {
        return dataFinal;
    }

    public void setDataFinal(String dataFinal) {
        this.dataFinal = dataFinal;
    }

    public String getNomeGrandeArea() {
        return nomeGrandeArea;
    }

    public void setNomeGrandeArea(String nomeGrandeArea) {
        this.nomeGrandeArea = nomeGrandeArea;
    }

    public String getNomeCategoria() {
        return nomeCategoria;
    }

    public void setNomeCategoria(String nomeCategoria) {
        this.nomeCategoria = nomeCategoria;
    }

    /* Regras de negócio */
    public void calculaHorasValidada(Curso curso) {
        try {
            for (GrandeArea grandeAreaAtual : curso.getGrandesAreas()) {
                if (grandeAreaAtual.getNome().equals(nomeGrandeArea)) {
                    for (Categoria categoriaAtual : grandeAreaAtual.getCategorias()) {
                        if (categoriaAtual.getNomeCategoria().equals(nomeCategoria)) {
                            if (horasInformadas > categoriaAtual.getHorasMaxima()) {
                                horasContabilizadas = categoriaAtual.getHorasMaxima();
                            } else {
                                horasContabilizadas = horasInformadas;
                            }
                            break;
                        }
                    }
                    break;
                }
            }            
        } catch (NullPointerException ex) {
            AlertasUtils.exibeErro("PROBLEMA_CATEGORIA_AREA");
            horasContabilizadas = Double.valueOf(0);
        }
    }
    
}
