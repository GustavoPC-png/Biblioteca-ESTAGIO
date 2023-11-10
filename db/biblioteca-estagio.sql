-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/11/2023 às 15:21
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro`
--

CREATE TABLE `livro` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `publicacao` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro_retirada`
--

CREATE TABLE `livro_retirada` (
  `id` int(11) NOT NULL,
  `id_livro` int(11) NOT NULL,
  `serie` varchar(255) NOT NULL,
  `nome_aluno` varchar(255) NOT NULL,
  `turma` varchar(255) NOT NULL,
  `data_retirada` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro_seriado`
--

CREATE TABLE `livro_seriado` (
  `id` int(11) NOT NULL,
  `id_livro` int(11) NOT NULL,
  `seriado` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'disponivel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `livro_retirada`
--
ALTER TABLE `livro_retirada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_livro` (`id_livro`);

--
-- Índices de tabela `livro_seriado`
--
ALTER TABLE `livro_seriado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_EmployeeID` (`id_livro`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `livro_retirada`
--
ALTER TABLE `livro_retirada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `livro_seriado`
--
ALTER TABLE `livro_seriado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `livro_retirada`
--
ALTER TABLE `livro_retirada`
  ADD CONSTRAINT `FK_livro` FOREIGN KEY (`id_livro`) REFERENCES `livro` (`id`);

--
-- Restrições para tabelas `livro_seriado`
--
ALTER TABLE `livro_seriado`
  ADD CONSTRAINT `FK_EmployeeID` FOREIGN KEY (`id_livro`) REFERENCES `livro` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
