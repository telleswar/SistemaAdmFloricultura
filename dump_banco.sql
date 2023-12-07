-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/12/2023 às 18:16
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `mov_estoque`
--

CREATE TABLE `mov_estoque` (
  `id` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT 0,
  `data` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `data_pagto` datetime DEFAULT NULL,
  `id_mov_estoque` int(11) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL
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
  `id_cliente` int(11) NOT NULL,
  `status` smallint(6) DEFAULT 0,
  `data_finalizacao` datetime DEFAULT NULL,
  `data_upgrade` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Acionadores `pedido`
--
DELIMITER $$
CREATE TRIGGER `att_status_pedido` BEFORE UPDATE ON `pedido` FOR EACH ROW IF NEW.status = 1 THEN
   SET NEW.data_upgrade = NOW();
ELSEIF NEW.status = 2 THEN
   SET NEW.data_finalizacao = NOW();
END IF
$$
DELIMITER ;

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
(13, 'Administrador', 'adm@gmail.com', NULL, '$2y$10$jEXUXfi06kGK1sYdisZQnOBRNFq8M91VVajkMC1gLE/jgi6BLJFdm', '6jGFYL8SF0r9rLsjLSLRTWsNKCd08QbGeIKN42DB9hoOuMO7lzeKeyPsj5dY', '2023-03-06 02:25:31', '2023-05-08 18:44:28'),
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
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_mov_estoque` (`id_mov_estoque`),
  ADD KEY `id_pedido` (`id_pedido`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mov_estoque`
--
ALTER TABLE `mov_estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mov_financeira`
--
ALTER TABLE `mov_financeira`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `itens_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `mov_financeira_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `mov_financeira_ibfk_3` FOREIGN KEY (`id_mov_estoque`) REFERENCES `mov_estoque` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mov_financeira_ibfk_4` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
