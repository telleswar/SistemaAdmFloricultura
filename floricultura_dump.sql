-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2023 at 01:58 PM
-- Server version: 8.0.32-0ubuntu0.22.04.2
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `floricultura`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id` int NOT NULL,
  `nome` varchar(120) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `endereco` varchar(120) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL
);

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `telefone`, `email`, `endereco`, `cpf`, `cnpj`) VALUES
(1, 'Leandro', '(47)91234-1234', 'leandro@gmail.com', 'Rua teste, 123', '10344433377', '10344433377123'),
(2, 'Antony Rairon da Silva Moreira', '(47)91234-1234', 'antony@gmail.com', 'Rua teste, 123', '10347124976', '');

-- --------------------------------------------------------

--
-- Table structure for table `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int NOT NULL,
  `nome` varchar(120) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL
);

--
-- Dumping data for table `fornecedor`
--

INSERT INTO `fornecedor` (`id`, `nome`, `telefone`, `email`, `cnpj`) VALUES
(1, 'Pedro flores', '(47)91234-1234', 'pedro@flores.com', '10344433377123');

-- --------------------------------------------------------

--
-- Table structure for table `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `numero_pedido` int NOT NULL,
  `id_produto` int NOT NULL,
  `quantidade` int DEFAULT '1',
  `valor` float DEFAULT NULL
);

--
-- Dumping data for table `itens_pedido`
--

INSERT INTO `itens_pedido` (`numero_pedido`, `id_produto`, `quantidade`, `valor`) VALUES
(1, 1, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `mov_financeira`
--

CREATE TABLE `mov_financeira` (
  `codigo` int NOT NULL,
  `id_fornecedor` int NOT NULL,
  `id_cliente` int NOT NULL,
  `valor` float DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `data_limite` datetime DEFAULT NULL,
  `data_pagto` datetime DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `numero` int NOT NULL,
  `valor_total` float DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `data_entrega` datetime DEFAULT NULL,
  `id_cliente` int NOT NULL
);

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`numero`, `valor_total`, `data_criacao`, `data_entrega`, `id_cliente`) VALUES
(1, 5, '2023-03-06 00:40:33', '2023-03-06 00:40:33', 1),
(2, 10, '2023-03-06 13:30:42', '2023-03-06 13:30:42', 2),
(3, 11, '2023-03-06 13:30:42', '2023-03-06 13:30:42', 1),
(4, 10, '2023-03-06 13:30:42', '2023-03-06 13:30:42', 1),
(5, 11, '2023-03-06 13:30:42', '2023-03-06 13:30:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE `produto` (
  `id` int NOT NULL,
  `nome` varchar(120) NOT NULL,
  `custo` float DEFAULT NULL,
  `tipo` varchar(40) DEFAULT NULL,
  `descricao` blob,
  `preco_unitario` float NOT NULL,
  `estoque` int DEFAULT '0',
  `id_fornecedor` int NOT NULL
);

--
-- Dumping data for table `produto`
--

INSERT INTO `produto` (`id`, `nome`, `custo`, `tipo`, `descricao`, `preco_unitario`, `estoque`, `id_fornecedor`) VALUES
(1, 'Girassol', 1.5, 'Flor', NULL, 2.5, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isPj` tinyint(1) NOT NULL
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `isPj`) VALUES
(13, 'Administrador', 'adm@gmail.com', NULL, '$2y$10$TqEJU3Zr38aQvs5APA5djOqYWgvgGHCBmxiEtG8IhaRDZqZIAt4dK', NULL, '2023-03-06 02:25:31', '2023-03-06 02:25:31', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD KEY `numero_pedido` (`numero_pedido`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Indexes for table `mov_financeira`
--
ALTER TABLE `mov_financeira`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `id_fornecedor` (`id_fornecedor`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fornecedor` (`id_fornecedor`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mov_financeira`
--
ALTER TABLE `mov_financeira`
  MODIFY `codigo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `numero` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD CONSTRAINT `itens_pedido_ibfk_1` FOREIGN KEY (`numero_pedido`) REFERENCES `pedido` (`numero`),
  ADD CONSTRAINT `itens_pedido_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`);

--
-- Constraints for table `mov_financeira`
--
ALTER TABLE `mov_financeira`
  ADD CONSTRAINT `mov_financeira_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`),
  ADD CONSTRAINT `mov_financeira_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

--
-- Constraints for table `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
