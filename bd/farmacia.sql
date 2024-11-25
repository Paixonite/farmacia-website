-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 25/11/2024 às 10:51
-- Versão do servidor: 8.0.40-0ubuntu0.22.04.1
-- Versão do PHP: 8.1.2-1ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `farmacia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alertas`
--

CREATE TABLE `alertas` (
  `id_alerta` int NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `mensagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `alertas`
--

INSERT INTO `alertas` (`id_alerta`, `titulo`, `mensagem`) VALUES
(1, 'Promoção de Analgésicos', 'Descontos especiais em paracetamol e ibuprofeno!'),
(2, 'Suplementos com desconto', 'Vitamina C e outros suplementos em promoção.'),
(3, 'Promoção Higiene', 'Álcool gel e pomadas com preços incríveis!'),
(6, 'Brandeburg ', '8==D');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int NOT NULL,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `endereco` varchar(45) NOT NULL,
  `cpf` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `senha`, `endereco`, `cpf`) VALUES
(1, 'joao', '$2y$10$xjA6DxH/aPUI5SRskHbDFuvzx31Ly/p2wNscU9SwOe0HvnLg.4Sfq', 'Rua A, 123', '444.444.444-44'),
(2, 'maria', '$2y$10$UTUsltF6X0lWc1XQ3cS92.PshuhyFgZ5G5.vTCdQoxUt16Ik0vSfq', 'Rua B, 456', '555.555.555-55'),
(3, 'carlos', '$2y$10$UTUsltF6X0lWc1XQ3cS92.PshuhyFgZ5G5.vTCdQoxUt16Ik0vSfq', 'Rua C, 789', '666.666.666-66'),
(7, 'cliente', '$2y$10$uFCwiC8mAUpdFpHD8xFGVex5HxWhU/6F1VnSzwGCkBGMwDCDgmSJ2', 'rua abc', '000.000.000-00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_funcionario` int NOT NULL,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `cpf` varchar(45) NOT NULL,
  `nivel_acesso` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `nome`, `senha`, `cpf`, `nivel_acesso`) VALUES
(8, 'atendente', '$2y$10$RSAHOiygaRApUwBEzD.bauAQdDhJsRsGAJLBez4iIIBI16v0DNNki', '111.111.111-11', 1),
(9, 'gerente', '$2y$10$mZu2cNgWnTj/CcFuN4dQrO0PhUWJHFfVBw2GQ41YJMgYn/zZauNt6', '222.222.222-22', 2),
(10, 'admin', '$2y$10$HO3ntB1LCfg598NAhYnAQ./tx67BDpB854ePS6QGBavoDaCEKnX9u', '333.333.333-33', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `id_pedido` int NOT NULL,
  `id_produto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `itens_pedido`
--

INSERT INTO `itens_pedido` (`id_pedido`, `id_produto`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int NOT NULL,
  `id_cliente` int NOT NULL,
  `data_pedido` datetime NOT NULL,
  `situacao` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_cliente`, `data_pedido`, `situacao`) VALUES
(1, 1, '2024-11-20 10:00:00', 1),
(2, 2, '2024-11-20 11:00:00', 1),
(3, 3, '2024-11-20 12:00:00', 1),
(4, 1, '2024-11-21 10:30:00', 0),
(5, 2, '2024-11-21 11:30:00', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int NOT NULL,
  `preco` decimal(9,2) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `quantidade` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `preco`, `nome`, `descricao`, `quantidade`) VALUES
(1, 19.90, 'paracetamol', 'Analgésico e antitérmico', 50),
(2, 12.50, 'ibuprofeno', 'Anti-inflamatório', 30),
(3, 25.00, 'dipirona', 'Analgésico', 40),
(4, 15.00, 'aspirina', 'Analgésico e anticoagulante', 60),
(5, 30.00, 'antialérgico', 'Medicamento para alergias', 20),
(6, 10.00, 'soro fisiológico', 'Hidratante nasal', 100),
(7, 50.00, 'vitamina C', 'Suplemento alimentar', 25),
(8, 35.00, 'antibiótico', 'Para infecções bacterianas', 15),
(9, 8.50, 'pomada cicatrizante', 'Cuidado para pele', 70),
(10, 5.00, 'álcool gel', 'Higienizador de mãos', 200);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id_alerta`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Índices de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD KEY `fk_pedidos_has_produtos_produtos1_idx` (`id_produto`),
  ADD KEY `fk_pedidos_has_produtos_pedidos_idx` (`id_pedido`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_pedidos_clientes1_idx` (`id_cliente`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id_alerta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_funcionario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD CONSTRAINT `fk_pedidos_has_produtos_pedidos` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `fk_pedidos_has_produtos_produtos1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_clientes1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
