-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Set-2021 às 18:59
-- Versão do servidor: 8.0.26
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `direitos_humanos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int NOT NULL,
  `curso` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id_curso`, `curso`) VALUES
(2, 'Programa de Pós-Graduação em Direito (PPGD)'),
(3, 'Programa de Pós-Graduação em Direitos Humanos (PPGDH)'),
(9, 'Programa de Pós-Graduação em Comunicação Social (PPGCOM)'),
(16, 'Programa de Pós-Graduação em Ciência Política'),
(17, 'Programa de Pós-Graduação em Antropologia (PPGA)'),
(18, 'Programa de Pós-Graduação em Serviço Social (PPGSS)'),
(19, 'Programa de Pós graduação em História (PPGH)'),
(20, 'Programa de Pós-Graduação em Sociologia (PPGS)'),
(21, 'Programa de Pós-Graduação em Psicologia (PPGPsi)'),
(22, 'Programa de Pós-Graduação em Geografia (PPGeo)'),
(23, 'Programa de Pós-Graduação Filosofia - PPGFIL'),
(26, 'Programa de Pós-Graduação Educação - PPGEdu');

-- --------------------------------------------------------

--
-- Estrutura da tabela `loginusuario`
--

CREATE TABLE `loginusuario` (
  `id` int NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `loginusuario`
--

INSERT INTO `loginusuario` (`id`, `usuario`, `senha`) VALUES
(1, 'joaohector', '123'),
(2, 'vanessa', 'vanessa1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tese_dissertacao`
--

CREATE TABLE `tese_dissertacao` (
  `id` int NOT NULL,
  `autor` varchar(255) NOT NULL,
  `orientador` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `titulo` varchar(300) NOT NULL,
  `instituicao` varchar(255) NOT NULL,
  `classificacao_geral` varchar(255) NOT NULL,
  `resumo` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `ano_defesa` int NOT NULL,
  `pdf` varchar(8000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Índices para tabela `tese_dissertacao`
--
ALTER TABLE `tese_dissertacao`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tese_dissertacao`
--
ALTER TABLE `tese_dissertacao`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
