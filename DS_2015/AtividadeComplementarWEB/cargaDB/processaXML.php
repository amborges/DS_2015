<?php
	ini_set('display_errors', 1);
	header('Content-Type: text/plain; charset=utf-8');
	
	//print_r($_FILES);
	
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
			
			//print_r($xml->atividades->atividade[2]);
			
			$seq = $conn->query("SELECT `seqAtividade` FROM `ATIVIDADE` 
					WHERE `matricula` = '" . $xml->matricula . "' ORDER BY `seqAtividade` DESC;");
			
			if($seq->num_rows > 0){
				$seq = $seq->fetch_assoc();
				$seq = $seq['seqAtividade'];
			}
			else
				$seq = 0;
			
			/*PROBLEMA*/
			$q = "SELECT `idCurso` FROM `CURSO` WHERE `nomeCurso` = '" . $xml->curso->nome . "';";
			echo $q."\n";
			
			$idCurso = $conn->query($q);
			
			//print_r($idCurso);
			
			if($idCurso->num_rows == 0){
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
			//foreach($xml->atividades as $at){
				
				
				
				$seqGA = $conn->query("SELECT `seqGA` FROM `GRANDEAREA`
						WHERE `idCurso` = '" . $idCurso . "' 
						AND `nomeGA` = '" . $at->nomeGrandeArea . "';");
			
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
					AND `nomeCategoria` = '" . $at->nomeCategoria . "';");
			
				if($seqCat->num_rows > 0){
					$seqCat = $seqCat->fetch_assoc();
					$seqCat = $seqCat['seqGA'];
				}
				else{
					$atividadesNaoForam .= $at->descricao . " [Categoria não encontrada]\n";
					continue;
				}
				
				
				
				$seq = $seq + 1;
				
				$sql .= "(".
					$xml->matricula 					.",".
					$seq 											.",".
					$at->descricao 						.",".
					$at->horasInformadas 			.",".
					$at->horasContabilizadas  .",".
					$at->dataInicio						.",".
					$at->dataFinal						.",".
					$at-> NULL 								.",". //arquivo, cadê?
					$idCurso									.",".
					$seqGA										.",".
					$seqCat										."),";
			}
			
				//remove a ultima virgula por um ponto-e-virgula
			$sql = substr_replace($sql, ";", -1);
			
			echo $sql;
			
			
			echo "\n\nAtividades do aluno sob a matricula " . $xml->matricula ."
				foram incluidas com sucesso, exceto as descritas abaixo, para essas, favor,
				inserir manualmente no sistema WEB.\n\n" . $atividadesNaoForam . "\n\n";
			
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
