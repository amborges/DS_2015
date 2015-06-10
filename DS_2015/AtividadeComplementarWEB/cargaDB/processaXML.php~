<?php
	ini_set('display_errors', 1);
	header('Content-Type: text/plain; charset=utf-8');
	
	//print_r($_FILES);
	
	function adjustData($d){
		$d = explode("/", $d);
		$d = $d[2] ."-". $d[1] ."-". $d[0];
		return $d;
	}
	
	try{
		if(!isset($_FILES['fileToUpload']['error']) || is_array($_FILES['fileToUpload']['error'])){
			throw new RuntimeException('Invalid parameters.');
		}
	
		// Check $_FILES['fileToUpload']['error'] value.
		switch ($_FILES['fileToUpload']['error']) {
			case UPLOAD_ERR_OK: break;
			case UPLOAD_ERR_NO_FILE: throw new RuntimeException('No file sent.');
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE: throw new RuntimeException('Exceeded filesize limit.');
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
		$newName = sprintf('./uploads/%s.%s', 
			sha1_file($_FILES['fileToUpload']['tmp_name']), $ext );
			
		if (!move_uploaded_file(
			$_FILES['fileToUpload']['tmp_name'],
			$newName
		)) {
			throw new RuntimeException('Failed to move uploaded file.');
		}
    
		echo "File is uploaded successfully. \n\n";

		
		/**************************************************/
		/**************************************************/
		/*			Começa aqui o processamento do xml				*/
		/**************************************************/
		/**************************************************/
		
		$stringXML = file_get_contents($newName);
		$xml = simplexml_load_string($stringXML);
		
		include '../connectDB.php'; //informações de conexão com o banco de dados
		
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error)
			throw new RuntimeException("Connection failed: " . $conn->connect_error);
		
		$sql = "SELECT * FROM `ALUNO` WHERE `matricula` = '" . $xml->matricula . "'";
		
		$r = $conn->query($sql); //procurando o usuário aluno, se existir, continua
		
		if($r->num_rows > 0){
			$r = $r->fetch_assoc();
			if($r['utilizouXML'] == true){
				throw new RuntimeException("Aluno, você já realizou atualizações de atividades utilizando DESKTOP, com carga via XML. Esse procedimento só é permitido uma vez. Utilize o sistema WEB para incluir novas atividades.\n");
			}
			
			$seq = $conn->query("SELECT `seqAtividade` FROM `ATIVIDADE` 
					WHERE `matricula` = '" . $xml->matricula . "' ORDER BY `seqAtividade` DESC;");
			
			if($seq->num_rows > 0){
				$seq = $seq->fetch_assoc();
				$seq = $seq['seqAtividade'];
			}
			else
				$seq = 0;
			
			/*PROBLEMA*/
			$q = "SELECT `idCurso` FROM `CURSO` WHERE `nomeCurso` = '" . utf8_decode($xml->curso->nome) . "';";
			$idCurso = $conn->query($q);
			
			if($idCurso->num_rows > 0){
				$idCurso = $idCurso->fetch_assoc();
				$idCurso = $idCurso['idCurso'];
			}
			else
				throw new RuntimeException("\nCurso informado no arquivo XML não foi encontrado na Base de Dados");
			
			
			$sql = "INSERT INTO `" . $dbname . "`.`ATIVIDADE` (`matricula`, `seqAtividade`, `descricaoAtividade`, `horaInformada`, `horaPermitida`, `dataInicio`, `dataFim`, `arquivo`, `idCurso`, `seqGA`, `seqCategoria`) VALUES ";
			
			$atividadesNaoForam = "";
			
			$maxi = count($xml->atividades->atividade);
			
			for($i = 0; $i < $maxi; $i++){
				$at = $xml->atividades->atividade[$i];
				
				$seqGA = $conn->query("SELECT `seqGA` FROM `GRANDEAREA`
						WHERE `idCurso` = '" . $idCurso . "' 
						AND `nomeGA` = '" . utf8_decode($at->nomeGrandeArea) . "';");
				
				
				if($seqGA->num_rows > 0){
					$seqGA = $seqGA->fetch_assoc();
					$seqGA = $seqGA['seqGA'];
				}
				else{
					$atividadesNaoForam .= $at->descricao . " [GrandeArea não encontrada]\n";
					continue;
				}
				
				
				
				$seqCat = $conn->query("SELECT `seqCategoria` FROM `CATEGORIA`
					WHERE `idCurso` = '" . $idCurso . "'
					AND `seqGA` = '" . $seqGA . "'
					AND `nomeCategoria` = '" . utf8_decode($at->nomeCategoria) . "';");
			
				if($seqCat->num_rows > 0){
					$seqCat = $seqCat->fetch_assoc();
					$seqCat = $seqCat['seqCategoria'];
				}
				else{
					$atividadesNaoForam .= $at->descricao . " [Categoria não encontrada]\n";
					continue;
				}
				
				
				$horasInf 	= ($at->horasInformadas > 0)? $at->horasInformadas : 0;
				$horasCont 	= ($at->horasContabilizadas > 0)? $at->horasContabilizadas : 0;
				$dataInicio	=	adjustData($at->dataInicial);
				$dataFim 		= (strlen($at->dataFinal) > 1)? adjustData($at->dataFinal) : 'NULL';
				
				$seq = $seq + 1;
								
				$sql .= "(".
					$xml->matricula 					.",".
					$seq 											.",'".
					$at->descricao 						."',".
					$horasInf 								.",".
					$horasCont 								.",'".
					$dataInicio								."','".
					$dataFim									."',"
										 								."'null',". //arquivo, cadê?
					$idCurso									.",".
					$seqGA										.",".
					$seqCat										."),";
			}
			
				//remove a ultima virgula por um ponto-e-virgula
			$sql = substr_replace($sql, ";", -1);
			
			if(strlen($sql) < 201)
				echo "Houve algum problema com a requisição, nenhum dos valores inseridos no XML foram reconhecidos: \n $atividadesNaoForam \n";
				
			if($conn->query($sql)){
				echo "\n\nAtividades do aluno sob a matricula " . $xml->matricula . 
				" foram incluidas com sucesso, exceto as descritas abaixo, para essas, favor, ".
				" inserir manualmente no sistema WEB.\n\n" . $atividadesNaoForam . "\n\n";
				
				$conn->query("UPDATE `DS_20151`.`ALUNO` SET `utilizouXML` = '1' WHERE `ALUNO`.`matricula` = '" . $xml->matricula . "';"); //proibe nova utilização de XML
			}
			else{
				throw new RuntimeException("Ocorreu um erro na insersão das atividades do aluno. Veja o SQL tentado:\n".$sql);
			}
			
		}
		else
			throw new RuntimeException("Não existe um usuário Aluno com a matrícula informada no arquivo XML carregado!");
		
		
		
		$conn->close();		
	} catch (RuntimeException $e) {
		echo $e->getMessage();
	}
	
	echo "\n\nfim com sucesso!!";
	
	//$xml = $_POST['fileToUpload'];
	//print_r($_FILES);
?>
