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
    		if(!isset($_FILES['fileToUpload']))
    			redirect('atividades/importar');
    
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
        
        require_once ABSPATH . '/models/categoria_model.php';
        require_once ABSPATH . '/models/grande_area_model.php';
        
        foreach($xml->atividades->atividade as $at){
        	$horasInf 	= ($at->horasInformadas > 0)? $at->horasInformadas : 0;
					$horasCont 	= ($at->horasContabilizadas > 0)? $at->horasContabilizadas : 0;
					$dataInicio	= adjustData($at->dataInicial);
					$dataFim = (strlen($at->dataFinal) > 1)? adjustData($at->dataFinal) : 'NULL';
          $id_curso = $_SESSION['userdata']['idCurso'];
          
            
        	$atividades[] = array('id' => $seq,
								'descricao' => $at->descricao, 
								'grande_area' => $at->nomeGrandeArea,
								'categoria' => $at->nomeCategoria,
                'categorias' => $this->find_categorias($at->nomeGrandeArea, $id_curso),
								'horas' => $horasInf,
								'horascontabilizadas' => $horasCont,
								'data_inicial' => $at->dataInicial,
								'data_final' => $at->dataFinal);
            $seq = $seq + 1;
		}
        
        $grandes_area_model = new GrandeAreaModel();
        $grandes_areas = $grandes_area_model->find_by_curso($id_curso);
        
        $main_page = ABSPATH . '/views/importar_atividade_edicao_page.php';
        
        require ABSPATH . '/views/includes/template.php';
    }
    
    public function salvar() {
    		if(!isset($_FILES['fileToUpload']))
    			redirect('atividades/importar');
    
    
        require_once ABSPATH . '/functions/atividades_functions.php';
        require_once ABSPATH . '/models/atividade_model.php';
        
        $listatividades = NULL;
        
        $_FILES = $_FILES['fileToUpload']; //removendo um nível da matriz, facilita o uso
        
        for($ii = 0; $ii < sizeof($_POST['descricao']); $ii++){
        	
        	$novocertificado = NULL;
        	
        	if($_FILES['size'][$ii] !== 0){
        		$fileToUpload = array(
        			'name' => $_FILES['name'][$ii],
        			'type' => $_FILES['type'][$ii],
        			'tmp_name' => $_FILES['tmp_name'][$ii],
        			'error' => $_FILES['error'][$ii],
        			'size' => $_FILES['size'][$ii]
        		); //removendo um nível da matriz, facilita o uso
        			//e tb pq já tava o código pronto...
        		
		      	//Carregando as informações, e incluindo em $atividades
				    try{
				    
				    	//verificando se o upload foi tudo certo
				    	if(!isset($fileToUpload['error']) 
				    		|| is_array($fileToUpload['error'])){
								throw new RuntimeException('Invalid parameters.');
							}
							// Check $_FILES['fileToUpload']['error'] value.
							switch ($fileToUpload['error']) {
								case UPLOAD_ERR_OK: break;
								case UPLOAD_ERR_NO_FILE: 
									throw new RuntimeException('No file sent.');
								case UPLOAD_ERR_INI_SIZE:
								case UPLOAD_ERR_FORM_SIZE: 
									throw new RuntimeException('Exceeded filesize limit.');
								default: throw new RuntimeException('Unknown errors.');
							}
					
							// You should also check filesize here.
							if ($fileToUpload['size'] > 1000000) {
								throw new RuntimeException('Exceeded filesize limit.');
							}
					
							// DO NOT TRUST $_FILES['fileToUpload']['mime'] VALUE !!
							// Check MIME Type by yourself.
							/*$finfo = new finfo(FILEINFO_MIME_TYPE);
							if (false === $ext = array_search(

								$finfo->file($fileToUpload['tmp_name']),


								array(
									'xml' => 'text/xml',
								),

								true

							)){

								print_r($finfo);

								throw new RuntimeException('Invalid file format.');

							}*/
							
							$ext = "pdf";
				
							// You should name it uniquely.
							// DO NOT USE $_FILES['fileToUpload']['name'] WITHOUT ANY VALIDATION !!
							// On this example, obtain safe unique name from its binary data.
							$newName = sprintf( ABSPATH . '/uploads/%s.%s', 
								sha1_file($fileToUpload['tmp_name']), $ext );
			
							if (!move_uploaded_file(
								$fileToUpload['tmp_name'],
								$newName
							)) {
								throw new RuntimeException('Failed to move uploaded file.');
							}
					
							$novocertificado = $newName;
							
				    } catch (RuntimeException $e) {
							echo $e->getMessage();
						}
		      }
		      
		      $datainicio = adjustData($_POST['data_inicial'][$ii]);
    			$datafim = 'NULL';
    			if($_POST['data_final'][$ii] !== '' && $_POST['data_final'][$ii] !== '00/00/0000')
    				$datafim = adjustData($_POST['data_final'][$ii]);
					
					$horacal = $this->calculaHora(
						$_POST['horas'][$ii],
						$_SESSION['userdata']['idCurso'],
						$_POST['grande_area'][$ii],
						$_POST['categoria'][$ii]
					);
					
					$listatividades[] = array(
						'descricao' => $_POST['descricao'][$ii],
						'grandearea' => $_POST['grande_area'][$ii],
						'categoria' => $_POST['categoria'][$ii],
						'horas' => $_POST['horas'][$ii],
						'horasCalculadas' => $horacal,
						'dataInicio' => $datainicio,
						'dataFim' => $datafim,
						'certificado' => $novocertificado
					);
					
		    }
		    
		    $alert;
		    $atividademodel = new AtividadeModel();
		    
		    if($listatividades !== NULL){	
		    	$atividademodel->insertFromXML($listatividades);
		    	if($atividademodel->erro_BD())
		    		$alert = array('type' => 'danger',
                       'message' => "Falha ao atualizar as atividades: ". $atividademodel->msg_erro());
          else
          	$alert = array('type' => 'success',
                       'message' => "Atualização de atividades realizada com sucesso!");	
		    }
		    else
        	$alert = array('type' => 'danger',
                       'message' => "Não há atividades a serem atualizadas");
        
        
        $_POST = $atividademodel->getHorasAtividades();

        $nome_aluno = $_SESSION['userdata']['nomeAluno'];
        $menus = AtividadesFunctions::init_menus(null, 0);
        	
        $main_page = ABSPATH . '/views/homealuno_view.php';
        
        require ABSPATH . '/views/includes/template.php';
    }
    
    private function find_categorias($nome_GA, $id_curso) {
    		require_once ABSPATH . '/models/categoria_model.php';
    		require_once ABSPATH . '/models/grande_area_model.php';
    		
        $grandes_area_model = new GrandeAreaModel();
        $result = $grandes_area_model->find_by_curso_and_nomeGA($id_curso, $nome_GA);
        
        $categoria_model = new CategoriaModel();
        return $categoria_model->find_by_curso_and_grande_area($id_curso, $result['seqGA']);
    }
    
    public function alterar_atividade() {
        require_once ABSPATH . '/functions/atividades_functions.php';
        require_once ABSPATH . '/models/atividade_model.php';
        
        $listatividades = NULL;
        
        $_FILES = $_FILES['certificado']; //removendo um nível da matriz, facilita o uso
        
        for($ii = 0; $ii < sizeof($_POST['descricao']); $ii++){
        	
        	$novocertificado = NULL;
        	
        	if($_FILES['size'][$ii] !== 0){
        		$fileToUpload = array(
        			'name' => $_FILES['name'][$ii],
        			'type' => $_FILES['type'][$ii],
        			'tmp_name' => $_FILES['tmp_name'][$ii],
        			'error' => $_FILES['error'][$ii],
        			'size' => $_FILES['size'][$ii]
        		); //removendo um nível da matriz, facilita o uso
        			//e tb pq já tava o código pronto...
        		
		      	//Carregando as informações, e incluindo em $atividades
				    try{
				    
				    	//verificando se o upload foi tudo certo
				    	if(!isset($fileToUpload['error']) 
				    		|| is_array($fileToUpload['error'])){
								throw new RuntimeException('Invalid parameters.');
							}
							// Check $_FILES['fileToUpload']['error'] value.
							switch ($fileToUpload['error']) {
								case UPLOAD_ERR_OK: break;
								case UPLOAD_ERR_NO_FILE: 
									throw new RuntimeException('No file sent.');
								case UPLOAD_ERR_INI_SIZE:
								case UPLOAD_ERR_FORM_SIZE: 
									throw new RuntimeException('Exceeded filesize limit.');
								default: throw new RuntimeException('Unknown errors.');
							}
					
							// You should also check filesize here.
							if ($fileToUpload['size'] > 1000000) {
								throw new RuntimeException('Exceeded filesize limit.');
							}
					
							// DO NOT TRUST $_FILES['fileToUpload']['mime'] VALUE !!
							// Check MIME Type by yourself.
							/*$finfo = new finfo(FILEINFO_MIME_TYPE);
							if (false === $ext = array_search(

								$finfo->file($fileToUpload['tmp_name']),

								array(
									'xml' => 'text/xml',
								),
								true

							)){
								print_r($finfo);
								throw new RuntimeException('Invalid file format.');
							}*/
							
							$ext = "pdf";
				
							// You should name it uniquely.
							// DO NOT USE $_FILES['fileToUpload']['name'] WITHOUT ANY VALIDATION !!
							// On this example, obtain safe unique name from its binary data.
							$newName = sprintf( ABSPATH . '/uploads/%s.%s', 
								sha1_file($fileToUpload['tmp_name']), $ext );
			
							if (!move_uploaded_file(
								$fileToUpload['tmp_name'],
								$newName
							)) {
								throw new RuntimeException('Failed to move uploaded file.');
							}
					
							$novocertificado = $newName;
							
				    } catch (RuntimeException $e) {
							echo $e->getMessage();
						}
		      }
		      
		      $datainicio = adjustData($_POST['data_inicial'][$ii]);
    			$datafim = 'NULL';
    			if($_POST['data_final'][$ii] !== '' && $_POST['data_final'][$ii] !== '00/00/0000')
    				$datafim = adjustData($_POST['data_final'][$ii]);
					
					$horacal = $this->calculaHora(
						$_POST['horas'][$ii],
						$_SESSION['userdata']['idCurso'],
						$_POST['grandearea'][$ii],
						$_POST['categoria'][$ii]
					);
					
					$listatividades[] = array(
						'seqAtividade' => $_POST['seqAtividade'][$ii],
						'descricao' => $_POST['descricao'][$ii],
						'grandearea' => $_POST['grande_area'][$ii],
						'categoria' => $_POST['categoria'][$ii],
						'horas' => $_POST['horas'][$ii],
						'horasCalculadas' => $horacal,
						'dataInicio' => $datainicio,
						'dataFim' => $datafim,
						'certificado' => $novocertificado
					);
					
					
		    }
		    
		    $alert;
		    $atividademodel = new AtividadeModel();
		    
		    if($listatividades !== NULL){	
		    	$atividademodel->update($listatividades);
		    	if($atividademodel->erro_BD())
		    		$alert = array('type' => 'danger',
                       'message' => "Falha ao atualizar as atividades: ". $atividademodel->msg_erro());
          else
          	$alert = array('type' => 'success',
                       'message' => "Atualização de atividades realizada com sucesso!");	
		    }
		    else
        	$alert = array('type' => 'danger',
                       'message' => "Não há atividades a serem atualizadas");
        
        
        $_POST = $atividademodel->getHorasAtividades();

        $nome_aluno = $_SESSION['userdata']['nomeAluno'];
        $menus = AtividadesFunctions::init_menus(null, 0);
        	
        $main_page = ABSPATH . '/views/homealuno_view.php';
        
        require ABSPATH . '/views/includes/template.php';
    }
    
    public function cadastrar_atividade() {
    		if(!$_POST) redirect('homealuno/cadastrar');
    		
	  		if(!is_numeric($_POST['grandearea']) && $_POST['grandearea'] === 0)
	  			$this->dados_invalidos_ativ("Selecione uma opção válida em 'Grande Area'!");
	  		if(!is_numeric($_POST['categoria']) && $_POST['categoria'] === 0)
	  			$this->dados_invalidos_ativ("Selecione uma opção válida em 'Categoria'!");
	  		if(!is_numeric($_POST['horas']) && $_POST['horas'] <= 0)
		  		$this->dados_invalidos_ativ("Informe um valor válido em 'Horas'!");
	  		else{
	  			try{
		      	//verificando se o upload foi tudo certo
		      	if(!isset($_FILES['certificado']['error']) 
		      		|| is_array($_FILES['certificado']['error'])){
							throw new RuntimeException('Parametros de Arquivo Inválidos!');
						}
						// Check $_FILES['fileToUpload']['error'] value.
						switch ($_FILES['certificado']['error']) {
							case UPLOAD_ERR_OK: break;
							case UPLOAD_ERR_NO_FILE: 
								throw new RuntimeException('Nenhum Arquivo foi enviado!');
							case UPLOAD_ERR_INI_SIZE:
							case UPLOAD_ERR_FORM_SIZE: 
								throw new RuntimeException('Tamanho de Arquivo Excedido!');
							default: throw new RuntimeException('Erro Desconhecido');
						}
					
						// You should also check filesize here.
						if ($_FILES['certificado']['size'] > 1000000) {
							throw new RuntimeException('Tamanho de Arquivo Excedido!');
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
					
						$ext = "pdf";
		  
						// You should name it uniquely.
						// DO NOT USE $_FILES['fileToUpload']['name'] WITHOUT ANY VALIDATION !!
						// On this example, obtain safe unique name from its binary data.
						$newName = sprintf( ABSPATH . '/uploads/%s.%s', 
							sha1_file($_FILES['certificado']['tmp_name']), $ext );
			
						if (!move_uploaded_file(
							$_FILES['certificado']['tmp_name'],
							$newName
						)) {
							throw new RuntimeException('Falha ao armazenar arquivo no Servidor!');
						}
					
					
		      } catch (RuntimeException $e) {
						$this->dados_invalidos_ativ($e->getMessage());
					} //end of try
					
					
					//calculando a hora válida
					$_POST['horascaluladas'] = $this->calculaHora(
						$_POST['horas'],
						$_SESSION['userdata']['idCurso'],
						$_POST['grandearea'],
						$_POST['categoria']
					);
					
					//Agora sim podemos enviar para o BD
					
					require_once ABSPATH . '/models/atividade_model.php';
	  			$atividademodel = new AtividadeModel();
	  			$atividademodel->cadastrar_nova_atividade($_POST, $newName);
	  			if($atividademodel->erro_BD())
	  				$this->dados_invalidos_ativ($atividademodel->msg_erro());
	  			else{
	  				$sucess = array('type' => 'success',
                       'message' => "Nova atividade cadastrada com sucesso");
        		require_once ABSPATH . '/controllers/homealuno_controller.php';
        		(new HomeAlunoController)->cadastrar($sucess);
        	}
	  		
	  		}//end of else
    }
    
    private function dados_invalidos_ativ($msg) {
        $alert = array('type' => 'danger',
                       'message' => $msg);
        require_once ABSPATH . '/controllers/homealuno_controller.php';
        (new HomeAlunoController)->cadastrar($alert);
    }
    
    public function calculaHora($hora, $idcurso, $idga, $idcat){
    	//dado a categoria, retornar o menor, a hora informada ou a hora máxima da categoria
    	require_once ABSPATH . '/models/categoria_model.php';
    	$categoriamodel = new CategoriaModel();
    	$horamax = $categoriamodel->getHoraMaxima($idcurso, $idga, $idcat);
    	if($hora <= $horamax)
    		return $hora;
    	return $horamax;
    }
}
