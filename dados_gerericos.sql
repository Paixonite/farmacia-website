INSERT INTO funcionarios (id_funcionario, nome, senha, cpf, nivel_acesso) VALUES
(1, 'atendente', 'atendente', '111.111.111-11', 1),
(2, 'gerente', 'gerente', '222.222.222-22', 2),
(3, 'admin', 'admin', '333.333.333-33', 3);

INSERT INTO clientes (id_cliente, nome, senha, endereco, cpf) VALUES
(1, 'joao', '1234', 'Rua A, 123', '444.444.444-44'),
(2, 'maria', 'abcd', 'Rua B, 456', '555.555.555-55'),
(3, 'carlos', 'xyz', 'Rua C, 789', '666.666.666-66');

INSERT INTO produtos (id_produto, preco, nome, descricao, quantidade) VALUES
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

INSERT INTO pedidos (id_pedido, id_cliente, data_pedido, situacao) VALUES
(1, 1, '2024-11-20 10:00:00', 1),
(2, 2, '2024-11-20 11:00:00', 1),
(3, 3, '2024-11-20 12:00:00', 1),
(4, 1, '2024-11-21 10:30:00', 0),
(5, 2, '2024-11-21 11:30:00', 0);

INSERT INTO itens_pedido (id_pedido, id_produto) VALUES
(1, 1), (1, 2),
(2, 3), (2, 4),
(3, 5), (3, 6),
(4, 7), (4, 8),
(5, 9), (5, 10);

INSERT INTO alertas (idalerta, titulo, mensagem) VALUES
(1, 'Promoção de Analgésicos', 'Descontos especiais em paracetamol e ibuprofeno!'),
(2, 'Suplementos com desconto', 'Vitamina C e outros suplementos em promoção.'),
(3, 'Promoção Higiene', 'Álcool gel e pomadas com preços incríveis!');
