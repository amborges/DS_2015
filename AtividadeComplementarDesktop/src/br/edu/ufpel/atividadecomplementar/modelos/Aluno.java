package br.edu.ufpel.atividadecomplementar.modelos;

import br.edu.ufpel.atividadecomplementar.dadosXML.ManipulaXML;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import br.edu.ufpel.atividadecomplementar.utils.StringUtils;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.util.ArrayList;
import java.util.List;
import javax.xml.bind.JAXBException;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
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
    private Curso curso;
    @XmlElement(name = "atividades")
    private AtividadeXML listaDeAtividades;
    private double horasEnsino;
    private double horasExtensao;
    private double horasPesquisa;
    @XmlTransient
    private File destinoExportacaoPadrao;
    
    public Aluno() {
        listaDeAtividades = null;
        horasEnsino = 0.0;
        horasExtensao = 0.0;
        horasPesquisa = 0.0;
        destinoExportacaoPadrao = null;
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

    public File getDestinoExportacaoPadrao() {
        return destinoExportacaoPadrao;
    }

    public void setDestinoExportacaoPadrao(File destinoExportacaoPadrao) {
        this.destinoExportacaoPadrao = destinoExportacaoPadrao;
    }
    
    /**
     * Método para adicionar uma atividade na lista de atividades do aluno
     * 
     * @param atividade que será adicionada
     */
    public void adicionarAtividade(Atividade atividade) {
        if (listaDeAtividades == null) {
            listaDeAtividades = new AtividadeXML();
        }
        
        atividade.calculaHorasValidada(curso);
        incrementarHoras(atividade);
        listaDeAtividades.getAtividades().add(atividade);
        listaDeAtividades.getAtividades().sort((Atividade a1, Atividade a2) -> a1.getDescricao().compareTo(a2.getDescricao()));
        salvarAluno();
    }
    
    /**
     * Método para alterar uma atividade da lista de atividades do aluno
     * 
     * @param atividadeAntiga a atividade que deve ser trocada pela nova, sendo que suas horas devem ser desconsideradas 
     * @param atividadeNova a atividade que substituirá a atividadeAntiga
     */
    public void alterarAtividade(Atividade atividadeAntiga, Atividade atividadeNova) {
        decrementarHoras(atividadeAntiga);
        listaDeAtividades.getAtividades().remove(atividadeNova);
        adicionarAtividade(atividadeNova);
    }
    
    /**
     * Método para remover uma atividade da lista de atividades do aluno
     * 
     * @param atividade que será removida
     */
    public void removerAtividade(Atividade atividade) {
        if (listaDeAtividades != null) {
            decrementarHoras(atividade);
            listaDeAtividades.getAtividades().remove(atividade);
            salvarAluno();
        }
    }
    
    private void incrementarHoras(Atividade atividade) {
        if (atividade.getHorasContabilizadas() != null) {
            if (PropertiesBundle.getProperty("ENSINO").equals(atividade.getNomeGrandeArea())) {
                horasEnsino = horasEnsino + atividade.getHorasContabilizadas();
            } else if (PropertiesBundle.getProperty("EXTENSAO").equals(atividade.getNomeGrandeArea())) {
                horasExtensao = horasExtensao + atividade.getHorasContabilizadas();
            } else if (PropertiesBundle.getProperty("PESQUISA").equals(atividade.getNomeGrandeArea())) {
                horasPesquisa = horasPesquisa + atividade.getHorasContabilizadas();
            }
        }
    }
    
    private void decrementarHoras(Atividade atividade) {
        if (atividade.getHorasContabilizadas() != null) {
            if (PropertiesBundle.getProperty("ENSINO").equals(atividade.getNomeGrandeArea())) {
                horasEnsino = horasEnsino - atividade.getHorasContabilizadas();
            } else if (PropertiesBundle.getProperty("EXTENSAO").equals(atividade.getNomeGrandeArea())) {
                horasExtensao = horasExtensao - atividade.getHorasContabilizadas();
            } else if (PropertiesBundle.getProperty("PESQUISA").equals(atividade.getNomeGrandeArea())) {
                horasPesquisa = horasPesquisa - atividade.getHorasContabilizadas();
            }
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
    
    public String exportarXML(File destino) throws IOException {
        String nomeArquivo = matricula.concat("_").concat(StringUtils.removerAcentos(nome)).concat(".xml").replace(' ', '-').toLowerCase();
        // Arquivo que será copiado
        InputStream in = new FileInputStream("perfil/".concat(matricula).concat(".xml"));
        // Transferindo bytes de entrada para saída
        OutputStream out = new FileOutputStream(destino.getAbsolutePath().concat("/").concat(nomeArquivo));
        
        byte[] buf = new byte[1024];
        int len;
        while ((len = in.read(buf)) > 0) {
            out.write(buf, 0, len);
        }
        
        out.close();
        in.close();
        
        destinoExportacaoPadrao = destino;
        
        return nomeArquivo;
    }

    @Override
    public String toString() {
        return nome + ": " + matricula;
    }

    public void recalcularHorasValidadas() {
        if (listaDeAtividades != null) {
            horasEnsino = 0.0;
            horasExtensao = 0.0;
            horasPesquisa = 0.0;

            for (Atividade atividade : listaDeAtividades.getAtividades()) {
                atividade.calculaHorasValidada(curso);
                incrementarHoras(atividade);
            }
        }
    }

}
