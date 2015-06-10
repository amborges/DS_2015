<?php

/**
 * Description of atividades_controller
 *
 * @author Paulo
 */
class AtividadesController {
    
    public function index() {
        redirect('atividades/importar');
    }
    
    public function importar() {
        require_once ABSPATH . '/functions/atividades_functions.php';
        $menus = AtividadesFunctions::init_menus(null, 1);
        $main_page = ABSPATH . '/views/importar_atividade_page.php';
        require ABSPATH . '/views/includes/template.php';
    }
    
    public function editar() {
        require_once ABSPATH . '/functions/atividades_functions.php';
        $menus = AtividadesFunctions::init_menus(null, 1);
        
        //Carregando as informações, e incluindo em $atividades
        $stringXML;
        try{
        
        	//verificando se o upload foi tudo certo
        	if(!isset($_FILES['fileToUpload']['error']) 
        		|| is_array($_FILES['fileToUpload']['error'])){
						throw new RuntimeException('Invalid parameters.');
					}
					// Check $_FILES['fileToUpload']['error'] value.
					switch ($_FILES['fileToUpload']['error']) {
						case UPLOAD_ERR_OK: break;
						case UPLOAD_ERR_NO_FILE: 
							throw new RuntimeException('No file sent.');
						case UPLOAD_ERR_INI_SIZE:
						case UPLOAD_ERR_FORM_SIZE: 
							throw new RuntimeException('Exceeded filesize limit.');
						default: throw new RuntimeException('Unknown errors.');
					}
					
					// You should also check filesize here.
					if ($_FILES['fileToUpload']['size'] > 1000000) {
						throw new RuntimeException('Exceeded filesize limit.');
					}
					
					// DO NOT TRUST $_FILES['fileToUpload']['mime'] VALUE !!
					// Check MIME Type by yourself.
					/*$finfo = new finfo(FILEINFO_MIME_TYPE);
					if (false === $ext = array_search(
						$finfo->file($_FILES['fileToUpload']['tmp_name']),
						array(
							'xml' => 'text/xml',
						),
						true
					)){
						print_r($finfo);
						throw new RuntimeException('Invalid file format.');
					}*/
					
					$ext = "xml";
    
					// You should name it uniquely.
					// DO NOT USE $_FILES['fileToUpload']['name'] WITHOUT ANY VALIDATION !!
					// On this example, obtain safe unique name from its binary data.
					$newName = sprintf( ABSPATH . '/uploads/%s.%s', 
						sha1_file($_FILES['fileToUpload']['tmp_name']), $ext );
			
					if (!move_uploaded_file(
						$_FILES['fileToUpload']['tmp_name'],
						$newName
					)) {
						throw new RuntimeException('Failed to move uploaded file.');
					}
					
					
        } catch (RuntimeException $e) {
					echo $e->getMessage();
				}
        
        //EFIM, xml carregado
        $stringXML = file_get_contents($newName);
				$xml = simplexml_load_string($stringXML);
        
        //TODO: é preciso buscar no banco de dados o ultimo seq
        /*
        	$seq = $conn->query("SELECT `seqAtividade` FROM `ATIVIDADE` 
					WHERE `matricula` = '" . $xml->matricula . "' ORDER BY `seqAtividade` DESC;");
					if($seq->num_rows > 0){
						$seq = $seq->fetch_assoc();
						$seq = $seq['seqAtividade'];
					}
					else
						$seq = 0;
        */
        $seq = 1;
        
        // TODO: buscar as atividades do xml convertido
        $atividades;
        
        foreach($xml->atividades->atividade as $at){
        	$horasInf 	= ($at->horasInformadas > 0)? $at->horasInformadas : 0;
					$horasCont 	= ($at->horasContabilizadas > 0)? $at->horasContabilizadas : 0;
					$dataInicio	=	adjustData($at->dataInicial);
					$dataFim 		= (strlen($at->dataFinal) > 1)? adjustData($at->dataFinal) : 'NULL';
				
        	$atividades[] = array('id' => $seq,
																'descricao' => $at->descricao, 
																'grande_area' => $at->nomeGrandeArea,
																'categoria' => $at->nomeCategoria,
																'horas' => $horasInf,
																'horascontabilizadas' => $horasCont,
																'data_inicial' => $at->dataInicial,
																'data_final' => $at->dataFinal);
          $seq = $seq + 1;
				}
        
        
        // TODO: buscar as grandes áreas do banco de dados
        //Aqui está pegando do xml
        $grandes_areas;
        $categorias;
        
        $seqga = 1;
        foreach($xml->curso->grandesareas->grandearea as $ga){
        	$grandes_areas[] = array(	'seqGA' => $seqga,
                                		'nomeGA' => $ga->nome);
          	
          $seqcat = 1;
          
          // TODO: buscar as categorias do banco de dados
		      //aqui está pegando do xml
		      //NOTA: a categoria deve estar vinculada a uma grande área, 
		      //se a GA muda, as categorias tb devem mudar.
          foreach($ga->categorias->categoria as $cat){
          	$categorias[] = array('seqCategoria' => $seqcat,
                                	'nomeCategoria' => $cat->nomecategoria);
            $seqcat = $seqcat + 1;
          }
          $seqga = $seqga + 1;
				}
        
        
        $main_page = ABSPATH . '/views/importar_atividade_edicao_page.php';
        
        require ABSPATH . '/views/includes/template.php';
    }
    
    public function salvar() {
        redirect('home');
    }
    
}