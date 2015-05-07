package br.edu.ufpel.atividadecomplementar.modelos;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author Paulo
 */
@XmlRootElement(name = "aluno")
@XmlAccessorType(XmlAccessType.FIELD)
public class AlunoInfoBasicas {
    
    private String matricula;
    private String nome;

    public AlunoInfoBasicas() {}
    
    public AlunoInfoBasicas(Aluno aluno) {
        matricula = aluno.getMatricula();
        nome = aluno.getNome();
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
    
    @Override
    public String toString() {
        return nome + ": " + matricula;
    }

    @Override
    public boolean equals(Object obj) {
        if (obj instanceof AlunoInfoBasicas) {
            return matricula.equals(((AlunoInfoBasicas)obj).getMatricula());
        }
        return false;
    }

    @Override
    public int hashCode() {
        return super.hashCode(); //To change body of generated methods, choose Tools | Templates.
    }
    
    

}
