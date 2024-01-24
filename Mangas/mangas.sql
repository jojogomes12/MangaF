-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Jan-2023 às 02:44
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mangas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `analises`
--

CREATE TABLE `analises` (
  `ID` int(11) NOT NULL,
  `Nota` float DEFAULT NULL,
  `texto` text DEFAULT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `ID_Postagens` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carro`
--

CREATE TABLE `carro` (
  `ID_Carro` int(11) NOT NULL,
  `Nome` varchar(255) DEFAULT NULL,
  `Marca` varchar(255) DEFAULT NULL,
  `ID_Pessoa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagens`
--

CREATE TABLE `postagens` (
  `ID` int(11) NOT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `Titulo` varchar(45) NOT NULL,
  `Descricao` text NOT NULL,
  `imagem` text DEFAULT NULL,
  `Link` text NOT NULL,
  `Categoria` text NOT NULL,
  `Capitulos` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `postagens`
--



-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Sobrenome` varchar(45) NOT NULL,
  `Email` text NOT NULL,
  `Senha` text NOT NULL,
  `Imagem` text NOT NULL,
  `Bio` text NOT NULL,
  `Token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `analises`
--
ALTER TABLE `analises`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Usuario` (`ID_Usuario`),
  ADD KEY `ID_Postagens` (`ID_Postagens`);

--
-- Índices para tabela `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`ID_Carro`),
  ADD KEY `fk_PesCarro` (`ID_Pessoa`);

--
-- Índices para tabela `postagens`
--
ALTER TABLE `postagens`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_UserPost` (`ID_Usuario`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `analises`
--
ALTER TABLE `analises`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `carro`
--
ALTER TABLE `carro`
  MODIFY `ID_Carro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `postagens`
--
ALTER TABLE `postagens`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `analises`
--
ALTER TABLE `analises`
  ADD CONSTRAINT `analises_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `analises_ibfk_3` FOREIGN KEY (`ID_Postagens`) REFERENCES `postagens` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `analises_ibfk_4` FOREIGN KEY (`ID_Postagens`) REFERENCES `postagens` (`ID`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `carro`
--
ALTER TABLE `carro`
  ADD CONSTRAINT `fk_PesCarro` FOREIGN KEY (`ID_Pessoa`) REFERENCES `usuarios` (`ID`);

--
-- Limitadores para a tabela `postagens`
--
ALTER TABLE `postagens`
  ADD CONSTRAINT `fk_UserPost` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
