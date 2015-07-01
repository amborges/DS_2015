-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 30/06/2015 às 23:02
-- Versão do servidor: 5.5.43-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `DS_20151`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ALUNO`
--

CREATE TABLE IF NOT EXISTS `ALUNO` (
  `matricula` bigint(20) NOT NULL,
  `nomeAluno` varchar(255) COLLATE utf8_bin NOT NULL,
  `senhaAluno` varchar(255) COLLATE utf8_bin NOT NULL,
  `alunoAtivo` tinyint(1) NOT NULL DEFAULT '1',
  `utilizouXML` tinyint(1) NOT NULL DEFAULT '0',
  `idCurso` bigint(20) NOT NULL,
  PRIMARY KEY (`matricula`),
  KEY `idCurso` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Definição de usuário Aluno';

--
-- Fazendo dump de dados para tabela `ALUNO`
--

INSERT INTO `ALUNO` (`matricula`, `nomeAluno`, `senhaAluno`, `alunoAtivo`, `utilizouXML`, `idCurso`) VALUES
(12345, 'Joao Barcos', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 0, 1),
(11200288, 'Alex Machado Borges', '05a85f6a657140dc0a42934f719db4f329fd1bc7', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ATIVIDADE`
--

CREATE TABLE IF NOT EXISTS `ATIVIDADE` (
  `matricula` bigint(20) NOT NULL,
  `seqAtividade` bigint(20) NOT NULL,
  `descricaoAtividade` varchar(255) COLLATE utf8_bin NOT NULL,
  `horaInformada` int(11) NOT NULL,
  `horaPermitida` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date DEFAULT NULL,
  `arquivo` varchar(500) COLLATE utf8_bin NOT NULL,
  `validado` tinyint(1) NOT NULL DEFAULT '0',
  `idCurso` bigint(20) NOT NULL,
  `seqGA` bigint(20) NOT NULL,
  `seqCategoria` bigint(20) NOT NULL,
  PRIMARY KEY (`matricula`,`seqAtividade`),
  KEY `Estrangeira_Categoria1` (`idCurso`),
  KEY `idCurso` (`idCurso`),
  KEY `estrangeira_categoria3` (`seqCategoria`),
  KEY `Estrangeira_Categororia2` (`seqGA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Definicao de Atividades';

--
-- Fazendo dump de dados para tabela `ATIVIDADE`
--

INSERT INTO `ATIVIDADE` (`matricula`, `seqAtividade`, `descricaoAtividade`, `horaInformada`, `horaPermitida`, `dataInicio`, `dataFim`, `arquivo`, `validado`, `idCurso`, `seqGA`, `seqCategoria`) VALUES
(12345, 0, 'Bolsa GACI', 120, 56, '2014-08-01', '2015-08-01', '751760782285a404168932114d3cc9ce223d75a1.pdf', 0, 1, 2, 7),
(12345, 1, 'Bolsa GACI', 153, 51, '2014-08-01', '2015-02-02', '751760782285a404168932114d3cc9ce223d75a1.pdf', 0, 1, 1, 1),
(11200288, 1, 'kakaka', 12, 12, '2015-06-03', '0000-00-00', 'etc.pdf', 0, 1, 1, 1),
(11200288, 2, 'Cinema', 12, 12, '2015-02-02', '2015-06-17', 'b6653d9c81fdbd41f82e39abf572e779065eee24.pdf', 0, 1, 2, 3),
(11200288, 3, 'tre', 12, 12, '2015-04-06', '2015-06-17', 'ojas2e2d9kjasclmqwd9jzlscnqw9fdj0qw9fhjls.pdf', 0, 1, 2, 3),
(11200288, 4, 'tre', 12, 12, '2015-06-01', '2015-06-01', 'ojas2e2d9kjasclmqwd9jzlscnqw9fdj0qw9fhjls.pdf', 0, 1, 2, 3),
(11200288, 5, 'lalala', 12, 12, '2015-06-02', '2015-06-05', 'ojas2e2d9kjasclmqwd9jzlscnqw9fdj0qw9fhjls.pdf', 0, 1, 2, 3),
(11200288, 6, 'kakaka', 12, 12, '2015-06-02', '0000-00-00', 'ojas2e2d9kjasclmqwd9jzlscnqw9fdj0qw9fhjls.pdf', 1, 1, 2, 3),
(11200288, 7, 'jaja', 20, 12, '2015-06-01', '0000-00-00', 'ojas2e2d9kjasclmqwd9jzlscnqw9fdj0qw9fhjls.pdf', 0, 1, 3, 3),
(11200288, 8, 'Era uma vez um boleto de banco', 15, 15, '2015-06-01', '2015-06-10', 'b45343ec5ba67a42ffbfd71af05b3619c5968661.pdf', 0, 1, 3, 3),
(11200288, 9, 'Teste horas', 200, 0, '2014-06-02', '2015-06-16', '05211be1fee878c931efe560833bf7d4deded98b.pdf', 0, 1, 1, 1),
(11200288, 10, 'teste horas', 200, 51, '2014-06-02', '2015-06-17', '05211be1fee878c931efe560833bf7d4deded98b.pdf', 0, 1, 1, 1),
(11200288, 11, 'Outro teste hora', 80, 68, '2015-06-08', '0000-00-00', '2950c7a6b7086f342b2af6dad320bc6cabc7f609.pdf', 0, 1, 1, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `CATEGORIA`
--

CREATE TABLE IF NOT EXISTS `CATEGORIA` (
  `idCurso` bigint(20) NOT NULL,
  `seqGA` bigint(20) NOT NULL,
  `seqCategoria` bigint(20) NOT NULL,
  `nomeCategoria` varchar(255) COLLATE utf8_bin NOT NULL,
  `descricaoCategoria` varchar(255) COLLATE utf8_bin NOT NULL,
  `horaMaxima` int(11) NOT NULL,
  `horaMaximaPorAtividade` int(11) NOT NULL,
  `tipoHora` int(11) NOT NULL,
  PRIMARY KEY (`idCurso`,`seqGA`,`seqCategoria`),
  KEY `seqGA` (`seqGA`),
  KEY `cat.seqcat` (`seqCategoria`),
  KEY `tipoHora` (`tipoHora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `CATEGORIA`
--

INSERT INTO `CATEGORIA` (`idCurso`, `seqGA`, `seqCategoria`, `nomeCategoria`, `descricaoCategoria`, `horaMaxima`, `horaMaximaPorAtividade`, `tipoHora`) VALUES
(1, 1, 1, 'Iniciação Científica', 'Bolsas de IC', 153, 51, 1),
(1, 1, 2, 'Participação em Eventos Científicos Regionais', 'Participação em Eventos Científicos realizados localmente (ex.: CIC)', 51, 17, 2),
(1, 1, 3, 'Participação em Eventos Científicos Nacionais', 'Participação em Eventos Científicos de nível nacional (ex.: JNIC)', 68, 34, 2),
(1, 1, 4, 'Participação em Eventos Científicos Internacionais', 'Participação em Eventos Científicos de nível internacional (ex.: ICIP)', 68, 34, 2),
(1, 1, 5, 'Publicação de Artigo Científico Regional', 'Publicação de artigos em eventos regionais (ex.: CIC)', 68, 34, 2),
(1, 1, 6, 'Publicação de Artigo Científico Nacional', 'Publicação de artigo em evento nacional (ex.: RECEN)', 102, 51, 2),
(1, 1, 7, 'Publicação de Artigo Científico Internacional', 'Publicação de artigo científico em evento internacional (ex.: ICIP)', 136, 68, 2),
(1, 1, 8, 'Obtenção de Prêmios e Distinções', 'Obtenção de Prêmios e Distinções', 136, 68, 2),
(1, 2, 1, 'Monitorias', 'Monitor de alguma disciplina', 102, 51, 1),
(1, 2, 2, 'Participação em Projetos de Ensino', 'Participação em Projetos de Ensino', 102, 34, 1),
(1, 2, 3, 'Participação em Semanas Acadêmicas da Computação', 'Participar da SACOMP', 68, 34, 1),
(1, 2, 4, 'Cursos e Escolas', 'Participação em Cursos e Escolas', 102, 51, 1),
(1, 2, 5, 'Representação Estudantil', 'Participação em Representações Estudantis (ex.: DCE)', 102, 51, 3),
(1, 2, 6, 'Certificados Profissionais', 'Certificados Profissionais', 102, 51, 1),
(1, 2, 7, 'Disciplina Optativa', 'Disciplina Optativa', 85, 56, 1),
(1, 3, 1, 'Bolsa de Graduação da UFPel', 'Bolsa de Graduação da UFPel', 102, 51, 1),
(1, 3, 2, 'Participação em Atividades de Extensão', 'Participar em evento como organizador, colaborador ou ministrante', 153, 34, 1),
(1, 3, 3, 'Projetos Voluntários', 'Projetos Voluntários', 102, 51, 1),
(2, 1, 1, 'Iniciação Científica', 'Bolsas de IC', 153, 51, 1),
(2, 1, 2, 'Participação em Eventos Científicos Regionais', 'Participação em Eventos Científicos realizados localmente (ex.: CIC)', 51, 17, 2),
(2, 1, 3, 'Participação em Eventos Científicos Nacionais', 'Participação em Eventos Científicos de nível nacional (ex.: JNIC)', 68, 34, 2),
(2, 1, 4, 'Participação em Eventos Científicos Internacionais', 'Participação em Eventos Científicos de nível internacional (ex.: ICIP)', 68, 34, 2),
(2, 1, 5, 'Publicação de Artigo Científico Regional', 'Publicação de artigos em eventos regionais (ex.: CIC)', 68, 34, 2),
(2, 1, 6, 'Publicação de Artigo Científico Nacional', 'Publicação de artigo em evento nacional (ex.: RECEN)', 102, 51, 2),
(2, 1, 7, 'Publicação de Artigo Científico Internacional', 'Publicação de artigo científico em evento internacional (ex.: ICIP)', 136, 68, 2),
(2, 1, 8, 'Obtenção de Prêmios e Distinções', 'Obtenção de Prêmios e Distinções', 136, 68, 2),
(2, 2, 1, 'Monitorias', 'Monitor de alguma disciplina', 102, 51, 1),
(2, 2, 2, 'Participação em Projetos de Ensino', 'Participação em Projetos de Ensino', 102, 34, 1),
(2, 2, 3, 'Participação em Semanas Acadêmicas da Computação', 'Participar da SACOMP', 68, 34, 1),
(2, 2, 4, 'Cursos e Escolas', 'Participação em Cursos e Escolas', 102, 51, 1),
(2, 2, 5, 'Representação Estudantil', 'Participação em Representações Estudantis (ex.: DCE)', 102, 51, 3),
(2, 2, 6, 'Certificados Profissionais', 'Certificados Profissionais', 102, 51, 1),
(2, 2, 7, 'Disciplina Optativa', 'Disciplina Optativa', 85, 56, 1),
(2, 3, 1, 'Bolsa de Graduação da UFPel', 'Bolsa de Graduação da UFPel', 102, 51, 1),
(2, 3, 2, 'Participação em Atividades de Extensão', 'Participar em evento como organizador, colaborador ou ministrante', 153, 34, 1),
(2, 3, 3, 'Projetos Voluntários', 'Projetos Voluntários', 102, 51, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `COORDENADOR`
--

CREATE TABLE IF NOT EXISTS `COORDENADOR` (
  `siape` bigint(20) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `senha` varchar(255) COLLATE utf8_bin NOT NULL,
  `usuarioAtivo` tinyint(1) NOT NULL DEFAULT '1',
  `ehCoordenador` tinyint(1) NOT NULL DEFAULT '1',
  `idCurso` bigint(20) NOT NULL,
  PRIMARY KEY (`siape`),
  KEY `idCurso` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Define o usuário Coordenador ';

--
-- Fazendo dump de dados para tabela `COORDENADOR`
--

INSERT INTO `COORDENADOR` (`siape`, `nome`, `senha`, `usuarioAtivo`, `ehCoordenador`, `idCurso`) VALUES
(1, 'Aldroaldo Barreto', '3efd4c0fe185135dd2c584b9698f506803cfaf81', 1, 0, 1),
(11, 'Professor Modelo', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 0, 1),
(12, 'Gracieli Hernandes', '17ba0791499db908433b80f37c5fbc89b870084b', 1, 0, 1),
(13, 'Carlos Damasco', 'd312cc75dc28ced757eef6ec22a7e3706905e352', 1, 0, 1),
(111, 'Edivaldina Fransciscana', '3efd4c0fe185135dd2c584b9698f506803cfaf81', 1, 0, 1),
(123, 'Coordenador Exemplo', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 1, 1),
(432, 'Maria Chiquinha', '3efd4c0fe185135dd2c584b9698f506803cfaf81', 1, 0, 1),
(765, 'Tina Tuner', '3efd4c0fe185135dd2c584b9698f506803cfaf81', 1, 0, 1),
(1234, 'Joao Costinha', '3efd4c0fe185135dd2c584b9698f506803cfaf81', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `CURSO`
--

CREATE TABLE IF NOT EXISTS `CURSO` (
  `idCurso` bigint(20) NOT NULL AUTO_INCREMENT,
  `nomeCurso` varchar(255) COLLATE utf8_bin NOT NULL,
  `cursoAtivo` tinyint(1) NOT NULL,
  `siapeCoordenador` bigint(20) NOT NULL,
  PRIMARY KEY (`idCurso`),
  UNIQUE KEY `nomeCurso` (`nomeCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Definicao dos Cursos' AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `CURSO`
--

INSERT INTO `CURSO` (`idCurso`, `nomeCurso`, `cursoAtivo`, `siapeCoordenador`) VALUES
(1, 'Ciência da Computação', 1, 123),
(2, 'Engenharia da Computação', 1, 123);

-- --------------------------------------------------------

--
-- Estrutura para tabela `EHAVALIADOR`
--

CREATE TABLE IF NOT EXISTS `EHAVALIADOR` (
  `siape` bigint(20) NOT NULL,
  `idCurso` bigint(20) NOT NULL,
  `avaliacaoPermitida` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`siape`,`idCurso`),
  KEY `idCurso` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `GRANDEAREA`
--

CREATE TABLE IF NOT EXISTS `GRANDEAREA` (
  `seqGA` bigint(20) NOT NULL,
  `idCurso` bigint(20) NOT NULL,
  `nomeGA` varchar(255) COLLATE utf8_bin NOT NULL,
  `descricaoGA` varchar(255) COLLATE utf8_bin NOT NULL,
  `horaMinima` int(11) NOT NULL,
  `GAAtiva` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`seqGA`,`idCurso`),
  KEY `idCurso` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Definicao da Grande Area';

--
-- Fazendo dump de dados para tabela `GRANDEAREA`
--

INSERT INTO `GRANDEAREA` (`seqGA`, `idCurso`, `nomeGA`, `descricaoGA`, `horaMinima`, `GAAtiva`) VALUES
(1, 1, 'Pesquisa', 'Pesquisas', 100, 1),
(1, 2, 'Pesquisa', 'Area de pesquisa', 100, 1),
(2, 1, 'Ensino', 'area de ensino', 100, 1),
(2, 2, 'Ensino', 'Area de Ensino', 100, 1),
(3, 1, 'Extensão', 'area de extensão', 100, 1),
(3, 2, 'Extensão', 'Area de Extensao', 100, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `TIPO_HORAS`
--

CREATE TABLE IF NOT EXISTS `TIPO_HORAS` (
  `idTipoHoras` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTipo` varchar(255) COLLATE utf8_bin NOT NULL,
  `Descricao` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idTipoHoras`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Armazena as informações sobre tipo de horas das categorias' AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `TIPO_HORAS`
--

INSERT INTO `TIPO_HORAS` (`idTipoHoras`, `nomeTipo`, `Descricao`) VALUES
(1, 'Horas', 'vale as próprias horas informadas'),
(2, 'Unidade', 'As horas são fixas para cada atividade'),
(3, 'Semestre', 'Horas fixas por atividades que durem um semestre');

-- --------------------------------------------------------

--
-- Estrutura para tabela `VERSAO`
--

CREATE TABLE IF NOT EXISTS `VERSAO` (
  `idVersao` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTabela` varchar(255) COLLATE utf8_bin NOT NULL,
  `versao` int(11) NOT NULL,
  PRIMARY KEY (`idVersao`),
  UNIQUE KEY `nomeTabela` (`nomeTabela`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Armazena de forma genérica as versões das tabelas CURSO, GRANDEAREA e CATEGORIA' AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `VERSAO`
--

INSERT INTO `VERSAO` (`idVersao`, `nomeTabela`, `versao`) VALUES
(1, 'CURSO', 1),
(2, 'GRANDEAREA', 1),
(3, 'CATEGORIA', 1);

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `ALUNO`
--
ALTER TABLE `ALUNO`
  ADD CONSTRAINT `ALUNO_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `CURSO` (`idCurso`);

--
-- Restrições para tabelas `ATIVIDADE`
--
ALTER TABLE `ATIVIDADE`
  ADD CONSTRAINT `ATIVIDADE_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `CATEGORIA` (`idCurso`),
  ADD CONSTRAINT `ATIVIDADE_ibfk_2` FOREIGN KEY (`seqGA`) REFERENCES `CATEGORIA` (`seqGA`),
  ADD CONSTRAINT `ATIVIDADE_ibfk_3` FOREIGN KEY (`seqCategoria`) REFERENCES `CATEGORIA` (`seqCategoria`),
  ADD CONSTRAINT `ATIVIDADE_ibfk_4` FOREIGN KEY (`matricula`) REFERENCES `ALUNO` (`matricula`);

--
-- Restrições para tabelas `CATEGORIA`
--
ALTER TABLE `CATEGORIA`
  ADD CONSTRAINT `CATEGORIA_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `GRANDEAREA` (`idCurso`),
  ADD CONSTRAINT `CATEGORIA_ibfk_2` FOREIGN KEY (`seqGA`) REFERENCES `GRANDEAREA` (`seqGA`),
  ADD CONSTRAINT `CATEGORIA_ibfk_3` FOREIGN KEY (`tipoHora`) REFERENCES `TIPO_HORAS` (`idTipoHoras`);

--
-- Restrições para tabelas `COORDENADOR`
--
ALTER TABLE `COORDENADOR`
  ADD CONSTRAINT `COORDENADOR_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `CURSO` (`idCurso`);

--
-- Restrições para tabelas `EHAVALIADOR`
--
ALTER TABLE `EHAVALIADOR`
  ADD CONSTRAINT `EHAVALIADOR_ibfk_1` FOREIGN KEY (`siape`) REFERENCES `COORDENADOR` (`siape`),
  ADD CONSTRAINT `EHAVALIADOR_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `CURSO` (`idCurso`);

--
-- Restrições para tabelas `GRANDEAREA`
--
ALTER TABLE `GRANDEAREA`
  ADD CONSTRAINT `GRANDEAREA_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `CURSO` (`idCurso`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
