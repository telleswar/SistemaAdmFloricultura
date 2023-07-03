-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/07/2023 às 00:59
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
-- Banco de dados: `floricultura`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(120) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `endereco` varchar(120) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `telefone`, `email`, `endereco`, `cpf`, `cnpj`) VALUES
(1, 'Leandro', '(47)91234-1234', 'leandro@gmail.com', 'Rua teste, 123', '10347124976', '10344433377123'),
(2, 'Antony Rairon', '(47)91234-1234', 'antony@gmail.com', 'Rua teste, 123', '103.471.249-76', ''),
(17, 'Teste22', '(47)99762-2050', 'adm@gmail.com', 'Rua teste', '10347124976', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(120) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `endereco` varchar(120) NOT NULL,
  `cnpj` varchar(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id`, `nome`, `telefone`, `email`, `endereco`, `cnpj`) VALUES
(11, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(24, 'Lucas Flores', '(47)99762-2050', 'lucas@flores.com', 'Rua teste', '99.581.213/0001-11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT 1,
  `valor` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens_pedido`
--

INSERT INTO `itens_pedido` (`id`, `id_pedido`, `id_produto`, `quantidade`, `valor`) VALUES
(1, 1, 1, 2, 5),
(6, 13, 5, 1, 2),
(7, 14, 2, 3, 33333),
(8, 11, 2, 3, 33333);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mov_estoque`
--

CREATE TABLE `mov_estoque` (
  `id` bigint(20) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT 0,
  `data` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mov_estoque`
--

INSERT INTO `mov_estoque` (`id`, `id_fornecedor`, `id_produto`, `quantidade`, `data`) VALUES
(31, 11, 1, 1, '2001-10-05'),
(32, 11, 1, 1, '2023-10-01'),
(33, 11, 1, 1, '2023-06-06'),
(34, 11, 1, 1, '2023-06-06'),
(35, 11, 1, 1, '2023-01-01'),
(36, 11, 1, 1, '2023-01-01'),
(37, 11, 1, 1, '2023-01-01'),
(38, 11, 1, 1, '2023-01-01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mov_financeira`
--

CREATE TABLE `mov_financeira` (
  `id` int(11) NOT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `data_limite` datetime DEFAULT NULL,
  `data_pagto` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `valor_total` float DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `data_entrega` datetime DEFAULT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`id`, `valor_total`, `data_criacao`, `data_entrega`, `id_cliente`) VALUES
(1, 5, '2023-03-06 00:40:33', '2023-03-06 00:40:33', 1),
(11, 33333, '2023-07-03 21:36:51', '2023-06-02 00:00:00', 2),
(13, 2, '2023-07-03 22:11:22', '2023-06-06 00:00:00', 1),
(14, 33333, '2023-07-03 22:19:38', '2023-06-02 00:00:00', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `custo` float DEFAULT NULL,
  `tipo` varchar(40) DEFAULT NULL,
  `descricao` blob DEFAULT NULL,
  `preco_unitario` float NOT NULL,
  `estoque` int(11) DEFAULT 0,
  `id_fornecedor` int(11) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `custo`, `tipo`, `descricao`, `preco_unitario`, `estoque`, `id_fornecedor`, `imagem`) VALUES
(1, 'Girassol', 1.5, 'flor', 0x556d6120666c6f72206c696e6461, 2.5, 31, NULL, ''),
(2, 'Flor2', 555.77, 'flor', 0x746573746531, 11111, 80, NULL, ''),
(5, 'Flor3', 1, 'flor', NULL, 2, -1, NULL, ''),
(6, 'Flor4', 1, 'flor', NULL, 2, 0, NULL, ''),
(7, 'Flor 5', 1, 'flor', NULL, 2, 0, NULL, ''),
(15, 'Flor 6', 0, 'flor', 0x61, 0, 0, NULL, ''),
(16, 'Flor 7', 11.66, 'flor', NULL, 0, 0, NULL, ''),
(19, 'Teste22', 0, 'Flor 8', 0x446573637269c3a7c3a36f, 0, 0, NULL, ''),
(20, 'Teste22', 0, 'Flor2', 0x5465737465, 0, 0, NULL, '7e9303915d3db9fc71534dc9197708bc.jpg'),
(21, 'Teste22', 0, 'Flor2', NULL, 0, 0, NULL, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(13, 'Administrador', 'adm@gmail.com', NULL, '$2y$10$jEXUXfi06kGK1sYdisZQnOBRNFq8M91VVajkMC1gLE/jgi6BLJFdm', 'MjauMQ0KB7U3MaO7sgKxHfOfvapB6tbBuA0JCTL1Z6PhK6WwezfjX0EbxrYo', '2023-03-06 02:25:31', '2023-05-08 18:44:28'),
(14, 'teste', 'teste@teste', NULL, '$2y$10$gTd6tKXw6S3YNbr6AMHMKu3mz9/hYEYxhkJB4DluxVq2YU42qIt8O', NULL, '2023-05-08 01:20:25', '2023-05-08 01:20:25');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `numero_pedido` (`id_pedido`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `mov_estoque`
--
ALTER TABLE `mov_estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mov_estoque_ibfk_1` (`id_fornecedor`),
  ADD KEY `mov_estoque_ibfk_2` (`id_produto`);

--
-- Índices de tabela `mov_financeira`
--
ALTER TABLE `mov_financeira`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fornecedor` (`id_fornecedor`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fornecedor` (`id_fornecedor`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `mov_estoque`
--
ALTER TABLE `mov_estoque`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `mov_financeira`
--
ALTER TABLE `mov_financeira`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD CONSTRAINT `itens_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`),
  ADD CONSTRAINT `itens_pedido_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`);

--
-- Restrições para tabelas `mov_estoque`
--
ALTER TABLE `mov_estoque`
  ADD CONSTRAINT `mov_estoque_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`),
  ADD CONSTRAINT `mov_estoque_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`);

--
-- Restrições para tabelas `mov_financeira`
--
ALTER TABLE `mov_financeira`
  ADD CONSTRAINT `mov_financeira_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`),
  ADD CONSTRAINT `mov_financeira_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
