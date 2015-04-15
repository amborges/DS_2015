package br.edu.ufpel.atividadecomplementar.interfacesgrafica;

import br.edu.ufpel.atividadecomplementar.interfacesgrafica.template.InterfaceGrafica;
import br.edu.ufpel.atividadecomplementar.modelos.Curso;
import br.edu.ufpel.atividadecomplementar.properties.PropertiesBundle;
import br.edu.ufpel.atividadecomplementar.utils.AlertasUtils;
import javafx.event.ActionEvent;
import javafx.scene.control.Button;
import javafx.scene.layout.GridPane;
import javafx.stage.Stage;
import javax.xml.bind.JAXBException;

/**
 *
 * @author Paulo
 */
class VisualizacaoDeAtividades extends InterfaceGrafica {

    private Curso cursoSelecionado;
    Button btnAdicionar;
    Button btnCancelar;

    public VisualizacaoDeAtividades(Curso cursoSelecionado) {
        this.cursoSelecionado = cursoSelecionado;
    }
    
    @Override
    protected void inicializarElementos(GridPane grid, Stage stage) {
        inicializarBotaoAdicionar(stage);
        inicializarBotaoCancelar(stage);
        
        grid.add(btnAdicionar, 0, 1);
        grid.add(btnCancelar, 1, 1);
    }

    private void inicializarBotaoAdicionar(Stage primaryStage) {
        btnAdicionar = new Button();
        
        btnAdicionar.setText(PropertiesBundle.getProperty("BOTAO_ADICIONAR"));
        btnAdicionar.setOnAction((ActionEvent event) -> {
//                Stage stage= new Stage();
//                ResumoUI resumoUI= new ResumoUI((Curso)cbxCurso.getValue());
//                resumoUI.start(stage);
//                primaryStage.close();
        });
    }

    private void inicializarBotaoCancelar(Stage primaryStage) {
        btnCancelar = new Button();
        
        btnCancelar.setText(PropertiesBundle.getProperty("BOTAO_CANCELAR"));
        btnCancelar.setOnAction((ActionEvent event) -> {
            try {
                Stage stage= new Stage();
                ResumoUI resumoUI= new ResumoUI(cursoSelecionado);
                resumoUI.montarTela(stage);
                primaryStage.close();
            } catch(NullPointerException ex) {
                AlertasUtils.exibeErro(ex.getMessage());
            } catch(JAXBException ex) {
                AlertasUtils.exibeErro("PROBLEMA_ARQUIVO_XML");
            }
        });
    }

}