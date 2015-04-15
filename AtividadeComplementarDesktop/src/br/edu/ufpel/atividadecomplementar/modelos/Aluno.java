package br.edu.ufpel.atividadecomplementar.modelos;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipulaXML;
import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import java.util.logging.Level;
import java.util.logging.Logger;
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
    private String email;
    private Integer codigoCurso; 
    @XmlTransient
    private Curso curso;

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

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
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

}
