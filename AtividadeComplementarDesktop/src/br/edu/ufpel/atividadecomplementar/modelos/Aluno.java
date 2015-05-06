package br.edu.ufpel.atividadecomplementar.modelos;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipulaXML;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import br.edu.ufpel.atividadecomplementar.utils.StringUtils;
import java.util.ArrayList;
import java.util.List;
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
    private Integer codigoCurso;
    private double horasEnsino;
    private double horasExtensao;
    private double horasPesquisa;
    private boolean estaPronto;
    @XmlTransient
    private Curso curso;
    @XmlTransient
    private List<Atividade> listaDeAtividades;

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

    public List<Atividade> getListaDeAtividades() {
        if (listaDeAtividades == null) {
            carregarAtividades();
        }
        return listaDeAtividades;
    }
    
    public void adicionaAtividade(Atividade atividade) {
        if (listaDeAtividades == null) {
            carregarAtividades();
        }
        
        atividade.setHoraValidada(verificarHoras(atividade));
        incrementarHoras(atividade);
        
        listaDeAtividades.add(atividade);
        salvarAtividades();
        salvarAluno();
    }
    
    public void removeAtividade(Atividade atividade) {
        if (listaDeAtividades == null) {
            carregarAtividades();
        }
        
        decrementarHoras(atividade);
        
        listaDeAtividades.remove(atividade);
        salvarAtividades();
        salvarAluno();
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
    
    private void salvarAtividades() {
        try {
            ManipulaXML<AtividadeXML> manipulador = new ManipulaXML(matricula.concat("_atividades.xml"), "atividades/");
            AtividadeXML atividadeXML = new AtividadeXML();
        
            atividadeXML.setAtividades(listaDeAtividades);
        
            manipulador.salvar(atividadeXML, AtividadeXML.class);
        } catch (JAXBException ex) {
            AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
        }
    }
    
    private void carregarAtividades() {
        try {
            ManipulaXML<AtividadeXML> manipulador = new ManipulaXML(matricula.concat("_atividades.xml"), "atividades/");

            listaDeAtividades = manipulador.buscar(AtividadeXML.class).getAtividades();
        } catch (JAXBException ex) {
            listaDeAtividades = new ArrayList();
        }    
    }
    
    private double verificarHoras(Atividade atividade) {
        List<Categoria> categorias = new ArrayList();
        ManipulaXML<CategoriaXML> manipulador;
        String nomeArquivo = curso.getCodigo().toString().concat("_")
                .concat(atividade.getNomeGrandeArea().toLowerCase().concat("_categorias.xml"));
        
        manipulador = new ManipulaXML(StringUtils.removerAcentos(nomeArquivo));
      
        try {
            Categoria categoria = null;
            
            categorias.addAll(manipulador.buscar(CategoriaXML.class).getCategoria());
            
            for (Categoria categoriaAtual : categorias) {
                if (categoriaAtual.getNomeCategoria().equals(atividade.getNomeCategoria())) {
                    categoria = categoriaAtual;
                }
            }
            
            if (categoria != null) {
                if (atividade.getHoraInformada() > categoria.getHorasMaxima()) {
                    return categoria.getHorasMaxima();
                } else {
                    return atividade.getHoraInformada();
                }
            }
        } catch (JAXBException ex) {
            AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
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
            AlunosXML alunosXML = manipuladorAlunosXML.buscar(AlunosXML.class);
            ManipulaXML<Aluno> manipuladorAluno = new ManipulaXML(matricula.concat(".xml"), "perfil/");
            
            manipuladorAluno.salvar(this, Aluno.class);
            
            for (Aluno alunoAtual : alunosXML.getAlunos()) {
                if (alunoAtual.getMatricula().equals(this.matricula)) {
                    alunosXML.getAlunos().remove(alunoAtual);
                    alunosXML.getAlunos().add(this);
                    manipuladorAlunosXML.salvar(alunosXML, AlunosXML.class);
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
