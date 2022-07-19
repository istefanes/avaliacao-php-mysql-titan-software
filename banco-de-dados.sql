-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 19/07/2022 às 04:50
-- Versão do servidor: 10.1.34-MariaDB
-- Versão do PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `avaliacao-php-mysql-titan-software`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `preco`
--

CREATE TABLE `preco` (
  `idpreco` int(5) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `preco`
--

INSERT INTO `preco` (`idpreco`, `preco`) VALUES
(1, '31.99'),
(2, '45.87'),
(3, '30.00'),
(4, '75.00'),
(5, '21.69');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `idprod` int(5) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `produtos`
--

INSERT INTO `produtos` (`idprod`, `nome`, `cor`) VALUES
(1, 'CAIXA PLASTICA 5L', 'AZUL'),
(2, 'CAIXA PLASTICA 15l', 'VERMELHO'),
(3, 'GARRAFA TÃ‰RMICA 750ML', 'AMARELO'),
(4, 'MESA DE PLASTICO', 'VERMELHO'),
(5, 'BALDE DE METAL DECORATIVO', 'VERDE');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `preco`
--
ALTER TABLE `preco`
  ADD PRIMARY KEY (`idpreco`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idprod`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `preco`
--
ALTER TABLE `preco`
  MODIFY `idpreco` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idprod` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
