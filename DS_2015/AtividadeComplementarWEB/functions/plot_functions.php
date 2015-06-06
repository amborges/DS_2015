<?php 

/**
 * PlotFunction - Gera o gráfico de horas do aluno
 *						PS: a pasta auxiliar 'imgPlot' deve sofrer um chmod 777 (ou similar de
 *																														 menor nível de acesso)
 *
 * @author Alex
 */

if ( ! defined('ABSPATH')) exit;

	//classe que gera o gráfico
require ABSPATH . "/classes/phplot-6.1.0/phplot.php";

class PlotFunctions {

	private $imgAdd; //armazena o endereço da imagem
    
  public function __construct($user, $data) {
  
  	//setando o endereço da imagem
  	$this->imgAdd = "functions/imgPlot/" . sha1($user) . ".png";
  
  	$plot = new PHPlot();
  	
  	//Titulo da imagem
		$plot->SetTitle(utf8_decode("Relação das Horas Acumuladas do aluno " . $user));
	
		#Indicamos o título do gráfico e o título dos dados no eixo X e Y do mesmo
		$plot->SetXTitle(utf8_decode("Grandes Áreas"));
		$plot->SetYTitle(utf8_decode("Horas"));
	
		#Definimos os dados do gráfico
		$plot->SetDataValues($data);
		$plot->SetPlotType("bars");
		
		#Definindo as legendas do grafico
		$legendas = array(utf8_decode("Acumuladas"), utf8_decode("Mínimo"));
		$plot->SetLegend($legendas);
	
		#Exibimos o gráfico
		$plot->SetIsInline(TRUE);
		$plot->SetOutputFile($this->imgAdd);
		$plot->DrawGraph();
  }
  
  public function __destruct(){
  	//Ver uma forma de apagar a imagem, já que o comando abaixo apaga na mesma hora
  	//que a imagem é criada.
  	//unlink($this->imgAdd);
  }
  
  public function getImage(){
  	//retorna o endereço da imagem
  	return $this->imgAdd;
  }
  
}
