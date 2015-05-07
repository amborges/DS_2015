package br.edu.ufpel.atividadecomplementar.modelos;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipulaXML;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import java.util.ArrayList;
import java.util.List;
import javafx.collections.FXCollections;
import javax.xml.bind.JAXBException;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author Paulo
 */
@XmlRootElement(name = "aluno")
@XmlAccessorType(XmlAccessType.FIELD)
public class Aluno {
    
    private String matricula;
    private String nome;
    private Curso curso;
    @XmlElement(name = "atividades")
    private AtividadeXML listaDeAtividades;
    private double horasEnsino;
    private double horasExtensao;
    private double horasPesquisa;
    private boolean estaPronto;
    
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
        return curso;
    }

    public void setCurso(Curso curso) {
        this.curso = curso;
    }

    public List<Atividade> getListaDeAtividades() {
        if (listaDeAtividades != null) {
            return listaDeAtividades.getAtividades();
        } else {
            return new ArrayList<>();
        }
    }

    public void setListaDeAtividades(AtividadeXML listaDeAtividades) {
        this.listaDeAtividades = listaDeAtividades;
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

    public void adicionaAtividade(Atividade atividade) {
        if (listaDeAtividades == null) {
            listaDeAtividades = new AtividadeXML();
        }
        
        atividade.setHoraValidada(verificarHoras(atividade));
        incrementarHoras(atividade);
        listaDeAtividades.getAtividades().add(atividade);
        listaDeAtividades.getAtividades().sort((Atividade a1, Atividade a2) -> a1.getDescricao().compareTo(a2.getDescricao()));
        salvarAluno();
    }
    
    public void removeAtividade(Atividade atividade) {
        if (listaDeAtividades != null) {
            decrementarHoras(atividade);
            listaDeAtividades.getAtividades().remove(atividade);
            salvarAluno();
        }
    }
    
    private double verificarHoras(Atividade atividade) {
        GrandeArea grandeArea = null;
        Categoria categoria = null;
        
        try {
            for (GrandeArea grandeAreaAtual : curso.getGrandesAreas()) {
                if (grandeAreaAtual.getNome().equals(atividade.getNomeGrandeArea())) {
                    grandeArea = grandeAreaAtual;
                    break;
                }
            }

            for (Categoria categoriaAtual : grandeArea.getCategorias()) {
                if (categoriaAtual.getNomeCategoria().equals(atividade.getNomeCategoria())) {
                    categoria = categoriaAtual;
                    break;
                }
            }

            if (atividade.getHoraInformada() > categoria.getHorasMaxima()) {
                return categoria.getHorasMaxima();
            } else {
                return atividade.getHoraInformada();
            }
        } catch (NullPointerException ex) {
            AlertasUtils.exibeErro("PROBLEMA_CATEGORIA_AREA");
        }
        
        return 0;
    }
    
    private void incrementarHoras(Atividade atividade) {
        if (PropertiesBundle.getProperty("ENSINO").equals(atividade.getNomeGrandeArea())) {
            horasEnsino = horasEnsino + atividade.getHoraValidada();
        } else if (PropertiesBundle.getProperty("EXTENSAO").equals(atividade.getNomeGrandeArea())) {
            horasExtensao = horasExtensao + atividade.getHoraValidada();
        } else if (PropertiesBundle.getProperty("PESQUISA").equals(atividade.getNomeGrandeArea())) {
            horasPesquisa = horasPesquisa + atividade.getHoraValidada();
        } 
    }
    
    private void decrementarHoras(Atividade atividade) {
        if (PropertiesBundle.getProperty("ENSINO").equals(atividade.getNomeGrandeArea())) {
            horasEnsino = horasEnsino - atividade.getHoraValidada();
        } else if (PropertiesBundle.getProperty("EXTENSAO").equals(atividade.getNomeGrandeArea())) {
            horasExtensao = horasExtensao - atividade.getHoraValidada();
        } else if (PropertiesBundle.getProperty("PESQUISA").equals(atividade.getNomeGrandeArea())) {
            horasPesquisa = horasPesquisa - atividade.getHoraValidada();
        } 
    }
    
    private void salvarAluno() {
        try {
            ManipulaXML<AlunosXML> manipuladorAlunosXML = new ManipulaXML("alunos.xml", "perfil/");
            ManipulaXML<Aluno> manipuladorAluno = new ManipulaXML(matricula.concat(".xml"), "perfil/");
            
            manipuladorAluno.salvar(this, Aluno.class);
            
            AlunosXML alunosXML = manipuladorAlunosXML.buscar(AlunosXML.class);
            alunosXML.adicionarAluno(this);
            manipuladorAlunosXML.salvar(alunosXML, AlunosXML.class);            
        } catch (JAXBException ex) {
            AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
        }
    }

    @Override
    public String toString() {
        return nome + ": " + matricula;
    }

}
