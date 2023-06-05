-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/06/2023 às 21:38
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
);

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `telefone`, `email`, `endereco`, `cpf`, `cnpj`) VALUES
(1, 'Leandro', '(47)91234-1234', 'leandro@gmail.com', 'Rua teste, 123', '10347124976', '10344433377123'),
(2, 'Antony Rairon da Silva Moreira', '(47)91234-1234', 'antony@gmail.com', 'Rua teste, 123', '10347124976', ''),
(17, 'Teste22', '(47)99762-2050', 'adm@gmail.com', 'Rua teste', '10347124976', NULL),
(18, 'Teste22', '(47)99762-2050', 'silva12341@gmail.com', 'Rua teste', '103.471.249-76', NULL);

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
);

--
-- Despejando dados para a tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id`, `nome`, `telefone`, `email`, `endereco`, `cnpj`) VALUES
(11, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(12, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(13, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(14, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(15, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(16, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(17, 'Lucas Flores', '(47)99762-2050', 'lucas@flores.com', 'Rua teste', '99.581.213/0001-11'),
(18, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(19, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(20, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(21, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(22, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(23, 'Pedro Flores', '(47)91234-1234', 'pedro@flores.com', 'Rua teste', '66.490.523/0001-71'),
(24, 'Lucas Flores', '(47)99762-2050', 'lucas@flores.com', 'Rua teste', '99.581.213/0001-11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `numero_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT 1,
  `valor` float DEFAULT NULL
);

--
-- Despejando dados para a tabela `itens_pedido`
--

INSERT INTO `itens_pedido` (`numero_pedido`, `id_produto`, `quantidade`, `valor`) VALUES
(1, 1, 2, 5);

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
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mov_financeira`
--

CREATE TABLE `mov_financeira` (
  `codigo` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `valor` float DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `data_limite` datetime DEFAULT NULL,
  `data_pagto` datetime DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `numero` int(11) NOT NULL,
  `valor_total` float DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `data_entrega` datetime DEFAULT NULL,
  `id_cliente` int(11) NOT NULL
);

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`numero`, `valor_total`, `data_criacao`, `data_entrega`, `id_cliente`) VALUES
(1, 5, '2023-03-06 00:40:33', '2023-03-06 00:40:33', 1),
(2, 10, '2023-03-06 13:30:42', '2023-03-06 13:30:42', 2),
(3, 11, '2023-03-06 13:30:42', '2023-03-06 13:30:42', 1),
(4, 10, '2023-03-06 13:30:42', '2023-03-06 13:30:42', 1),
(5, 11, '2023-03-06 13:30:42', '2023-03-06 13:30:42', 1),
(6, 55, '2023-05-07 16:40:01', '2023-05-08 16:40:01', 2),
(7, 77, '2023-05-07 16:40:01', '2023-05-08 16:40:01', 1);

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
);

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `custo`, `tipo`, `descricao`, `preco_unitario`, `estoque`, `id_fornecedor`, `imagem`) VALUES
(1, 'Girassol', 1.5, 'Flor', 0x68747470733a2f2f6769746875622e636f6d2f74656c6c65737761722f494653432d446973706f73697469766f732d4d6f766569732f747265652f72656379636c657276696577, 2.5, 23, NULL, ''),
(2, 'Flor2', 555.77, 'ADDASDASDasdasd', 0x746573746531, 11111, 56, NULL, 'c8b2cbe19404633e0156e10b1e4a4780.webp'),
(5, 'adsads', 1, 'adsads', NULL, 2, 0, NULL, '352052366be90817e10afd16a55bfdf5.jpg'),
(6, 'adsads', 1, 'adsads', NULL, 2, 0, NULL, '28f1b6c0af3754420868c8d13035362c.jpg'),
(7, 'adsads', 1, 'adsads', NULL, 2, 0, NULL, '76b4d6d26e99bd7f8028069f2b328189.webp'),
(8, 'adsads', 1, 'adsads', NULL, 2, 0, NULL, NULL),
(9, 'adsads', 1, 'adsads', NULL, 2, 0, NULL, NULL),
(10, 'adsads', 1, 'adsads', NULL, 2, 0, NULL, NULL),
(11, 'adsads', 1, 'adsads', NULL, 2, 0, NULL, NULL),
(12, 'adsads', 1, 'adsads', NULL, 2, 0, NULL, NULL),
(13, 'Teste', 15.88, 'Flor2', NULL, 0.99, 0, NULL, NULL),
(14, 'Teste22', 0, 'Flor2', 0x7465737465, 0, 0, NULL, NULL),
(15, 'Teste22', 0, 'Flor2', 0x61, 0, 0, NULL, NULL),
(16, 'Teste1', 11.66, '0.00', NULL, 0, 0, NULL, NULL),
(18, 'Teste1', 1555.77, 'Flor2', NULL, 0, 0, NULL, NULL),
(19, 'Teste22', 0, 'Flor2222', 0x446573637269c3a7c3a36f, 0, 0, NULL, ''),
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
) ;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(13, 'Administrador', 'adm@gmail.com', NULL, '$2y$10$jEXUXfi06kGK1sYdisZQnOBRNFq8M91VVajkMC1gLE/jgi6BLJFdm', '6lm1GP7IshNNyldeAgxLwvodKtA2AK7jLxeGL7sXGXtb7G9dJ6dQ2PxjIUzp', '2023-03-06 02:25:31', '2023-05-08 18:44:28'),
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
  ADD KEY `numero_pedido` (`numero_pedido`),
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
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `id_fornecedor` (`id_fornecedor`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`numero`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `mov_estoque`
--
ALTER TABLE `mov_estoque`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `mov_financeira`
--
ALTER TABLE `mov_financeira`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `itens_pedido_ibfk_1` FOREIGN KEY (`numero_pedido`) REFERENCES `pedido` (`numero`),
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
