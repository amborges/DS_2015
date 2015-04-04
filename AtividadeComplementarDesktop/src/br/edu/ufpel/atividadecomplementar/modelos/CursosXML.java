package br.edu.ufpel.atividadecomplementar.modelos;

import java.util.ArrayList;
import java.util.List;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement(name = "cursos")
@XmlAccessorType(XmlAccessType.FIELD)
public class CursosXML {
    
    @XmlElement(name = "curso")
    private List<Curso> cursos;

    public CursosXML() {
        cursos = new ArrayList<>();
    }
    
    public List<Curso> getCursos() {
        return cursos;
    }

    public void setCursos(List<Curso> cursos) {
        this.cursos = cursos;
    }
    
}
