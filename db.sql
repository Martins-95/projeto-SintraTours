-- ============================================================
--  Sintra Tours – Base de Dados
-- ============================================================
CREATE DATABASE IF NOT EXISTS sintra_tours;
USE sintra_tours;

-- Tabela de utilizadores
CREATE TABLE utilizadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('cliente','admin') DEFAULT 'cliente',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de categorias de packs
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    descricao VARCHAR(255)
);

-- Tabela de packs (produtos = packs de viagem)
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    duracao VARCHAR(50),          -- ex: "1 dia", "Meio dia"
    stock INT NOT NULL DEFAULT 50,
    categoria_id INT,
    imagem VARCHAR(255),
    destaque TINYINT(1) DEFAULT 0, -- aparece na página principal
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Tabela de carrinho
CREATE TABLE carrinho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT DEFAULT 1,
    data_visita DATE,
    comprado TINYINT(1) DEFAULT 0,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES utilizadores(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

-- ============================================================
--  Dados iniciais
-- ============================================================

-- Categorias
INSERT INTO categorias (nome, descricao) VALUES
('Individual', 'Packs para uma pessoa'),
('Familiar', 'Packs para toda a família'),
('Privado', 'Tours privados e exclusivos');

-- Packs de viagem
INSERT INTO produtos (nome, descricao, preco, duracao, stock, categoria_id, destaque) VALUES
('Pack Clássico Sintra',
 'Visita guiada ao Palácio Nacional de Sintra e ao Castelo dos Mouros. Inclui transporte, guia local e entrada nos monumentos.',
 35.00, '1 dia', 50, 1, 1),

('Pack Romântico',
 'Tour pela Quinta da Regaleira e Palácio da Pena. Perfeito para casais. Inclui degustação de queijada de Sintra.',
 49.00, '1 dia', 30, 1, 1),

('Pack Sintra Completo',
 'A experiência total: Palácio da Pena, Castelo dos Mouros, Quinta da Regaleira e Palácio Nacional. Dia inteiro com guia especializado.',
 75.00, 'Dia inteiro', 20, 1, 1),

('Pack Família Sintra',
 'Tour familiar com atividades adaptadas para crianças. Visita aos principais monumentos com jogos temáticos e lanches incluídos.',
 120.00, 'Dia inteiro', 25, 2, 1),

('Pack Meio-Dia Histórico',
 'Tour rápido ao Castelo dos Mouros e miradouro com vistas panorâmicas. Ideal para quem tem pouco tempo.',
 22.00, 'Meio dia', 40, 1, 0),

('Pack Privado Premium',
 'Tour completamente personalizado com guia exclusivo e veículo privado. Visita todos os monumentos ao teu ritmo.',
 199.00, 'Dia inteiro', 10, 3, 0);
