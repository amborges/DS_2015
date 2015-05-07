package br.edu.ufpel.atividadecomplementar.modelos;

import java.util.ArrayList;
import java.util.List;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement(name = "alunos")
@XmlAccessorType(XmlAccessType.FIELD)
public class AlunosXML {
    
    @XmlElement(name = "aluno")
    private List<AlunoInfoBasicas> alunos;

    public AlunosXML() {
        alunos = new ArrayList<>();
    }

    public List<AlunoInfoBasicas> getAlunos() {
        return alunos;
    }

    public void setAlunos(List<AlunoInfoBasicas> alunos) {
        this.alunos = alunos;
    }
    
    public void adicionarAluno(Aluno aluno) {
        AlunoInfoBasicas alunoInfoBasicas = new AlunoInfoBasicas(aluno);
        
        alunos.remove(alunoInfoBasicas);
        alunos.add(alunoInfoBasicas);
        alunos.sort((AlunoInfoBasicas e1, AlunoInfoBasicas e2) -> e1.getNome().compareTo(e2.getNome()));
    }
    
}
