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
 * @author Paulo
 */
@XmlRootElement(name = "aluno")
@XmlAccessorType(XmlAccessType.FIELD)
public class Aluno {
    
    private String matricula;
    private String nome;
    private Integer codigoCurso;
    private double horasEnsino;
    private double horasExtensao;
    private double horasPesquisa;
    private boolean estaPronto;
    @XmlTransient
    private Curso curso;

    public Aluno() {
        horasEnsino = 0.0;
        horasExtensao = 0.0;
        horasPesquisa = 0.0;
        estaPronto = false;
    }
    
    public String getMatricula() {
        return matricula;
    }

    public void setMatricula(String matricula) {
        this.matricula = matricula;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
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
    
    public double getHorasEnsino() {
        return horasEnsino;
    }

    public double getHorasExtensao() {
        return horasExtensao;
    }

    public double getHorasPesquisa() {
        return horasPesquisa;
    }

    public boolean isEstaPronto() {
        return estaPronto;
    }

    public void setEstaPronto(boolean estaPronto) {
        this.estaPronto = estaPronto;
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
        return nome + ": " + matricula;
    }
    
}
