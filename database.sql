CREATE DATABASE IF NOT EXISTS quiz_db;
USE quiz_db;

CREATE TABLE IF NOT EXISTS perguntas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pergunta TEXT NOT NULL,
    opcao_a VARCHAR(255) NOT NULL,
    opcao_b VARCHAR(255) NOT NULL,
    opcao_c VARCHAR(255) NOT NULL,
    opcao_d VARCHAR(255) NOT NULL,
    resposta_correta CHAR(1) NOT NULL
);

CREATE TABLE IF NOT EXISTS premios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

-- Inserir algumas perguntas de exemplo
INSERT INTO perguntas (pergunta, opcao_a, opcao_b, opcao_c, opcao_d, resposta_correta) VALUES
('Qual é a capital do Brasil?', 'Rio de Janeiro', 'São Paulo', 'Brasília', 'Salvador', 'C'),
('Quem pintou a Mona Lisa?', 'Van Gogh', 'Picasso', 'Leonardo da Vinci', 'Michelangelo', 'C'),
('Qual é o maior planeta do sistema solar?', 'Terra', 'Marte', 'Júpiter', 'Saturno', 'C');

-- Inserir alguns prêmios de exemplo
INSERT INTO premios (nome) VALUES
('R$ 100 em compras'),
('Smartphone'),
('Notebook'),
('TV 50"'),
('Viagem para o Caribe'),
('Carro 0km'),
('Casa própria'),
('R$ 1.000.000'); 