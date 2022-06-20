-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Jun-2022 às 21:27
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ci4-aluno`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(9) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `endereco` varchar(250) NOT NULL,
  `foto` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `endereco`, `foto`) VALUES
(1, 'Johnny Depp', 'Rua dos Atores, n 145, bairro centro, Cabaceiras - PB, CEP: 58480-000', '1655748076_9b72d8b08e70b489997e.jpg'),
(2, 'Will Smith', 'Rua dos Tapas, n 2022, bairro apelou, Nova Iorque - MA, CEP: 65880-970', '1655748067_b39d78ae01c38f17a196.jpg'),
(3, 'Galvão Bueno', 'Rua Galvão Bueno, n 71, bairro Liberdade, São Paulo - SP, CEP: 01506-000 ', '1655748060_40a06df7c5aa1e0afe22.jpg'),
(4, 'Chaves', 'Rua das Gentalhas, n 8, Praça México, Belo Horizonte - MG, CEP: 31110-610 ', '1655748052_3968848609e436ea686a.jpg'),
(5, 'Goku', 'Rua dos Sayajins, 333, planeta Vegeta', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
