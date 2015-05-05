package br.edu.ufpel.atividadecomplementar.modelos;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipulaXML;
import java.util.Date;
import javax.xml.bind.JAXBException;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
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
    private Date dataInicial;
    private Date dataFinal;
    private Integer ano;
    private String semestre;
    
//    private String enderecoCertificado;
    private String matricula;
    private String nomeGrandeArea;
    private String nomeCategoria;
    
    @XmlTransient
    private Aluno aluno;
    
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

    public Integer getAno() {
        return ano;
    }

    public void setAno(Integer ano) {
        this.ano = ano;
    }

    public String getSemestre() {
        return semestre;
    }

    public void setSemestre(String semestre) {
        this.semestre = semestre;
    }
    
//    public String getEnderecoCertificado() {
//        return enderecoCertificado;
//    }
//
//    public void setEnderecoCertificado(String enderecoCertificado) {
//        this.enderecoCertificado = enderecoCertificado;
//    }
//
//    public Periodo getPeriodo() {
//        return periodo;
//    }
//
//    public void setPeriodo(Periodo periodo) {
//        this.periodo = periodo;
//    }

    public Aluno getAluno() {
        if (aluno == null) {
            carregaAluno();
        }
        return aluno;
    }

    public void setAluno(Aluno aluno) {
        this.aluno = aluno;
        this.matricula = aluno.getMatricula();
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

    private void carregaAluno() {
        ManipulaXML<Aluno> manipulador = new ManipulaXML(matricula.concat(".xml"), "perfil/");
        
        try {
            this.aluno = manipulador.buscar(Aluno.class);
        } catch (JAXBException ex) {
            throw new RuntimeException("PROBLEMA_CRIAR_PERFIL");
        }
    }
    
}
