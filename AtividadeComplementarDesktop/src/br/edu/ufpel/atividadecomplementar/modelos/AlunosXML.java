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
    private List<Aluno> alunos;

    public AlunosXML() {
        alunos = new ArrayList<>();
    }
    
    public List<Aluno> getAlunos() {
        return alunos;
    }

    public void setAlunos(List<Aluno> alunos) {
        this.alunos = alunos;
    }
    
}
