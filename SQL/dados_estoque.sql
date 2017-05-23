
--
-- Estrutura para tabela `sis_clientes`
--

CREATE TABLE IF NOT EXISTS `sis_clientes` (
  `cliente_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_nm` varchar(50) NOT NULL DEFAULT '',
  `cliente_email` varchar(50) NOT NULL DEFAULT '',
  `cliente_tel` varchar(30) NOT NULL DEFAULT '',
  `cliente_registered_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cliente_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Fazendo dump de dados para tabela `sis_clientes`
--
INSERT INTO `sis_clientes` (`cliente_id`, `cliente_nm`, `cliente_email`, `cliente_tel`) VALUES
(1, 'Adriano K. Nakamura', 'adriano.k.nakamura@gmail.com', '(11)99769-3734');


--
-- Estrutura para tabela `sis_produtos`
--

CREATE TABLE IF NOT EXISTS `sis_produtos` (
  `produto_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `produto_nm` varchar(50) NOT NULL,
  `produto_ds` varchar(50) NOT NULL,
  `produto_vl` decimal(10,2) NOT NULL,
  `produto_estoque_qt` int(50) NOT NULL,
  `produto_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`produto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


INSERT INTO `sis_produtos` (`produto_nm`, `produto_ds`, `produto_vl`, `produto_estoque_qt`) VALUES
('Produto1', 'Produto1 Teste1', '280.00', 5);


--
-- Estrutura para tabela `sis_pedidos`
--

CREATE TABLE IF NOT EXISTS `sis_pedidos` (
  `pedido_id`     bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id`    bigint(20) unsigned NOT NULL,
  `produto_id`    bigint(20) unsigned NOT NULL,
  `produto_qt`    int(50) NOT NULL,
  `pedido_registered_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pedido_status` varchar(100) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pedido_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

