-- BANCO DE DADOS DO SGC AMES

CREATE TABLE estados (
    id INT(2) AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(50) NOT NULL,
    sigla VARCHAR(2) NOT NULL,
    populacao INT(10)
);

INSERT INTO estados (estado, sigla) VALUES
('Acre', 'AC'),
('Alagoas', 'AL'),
('Amazonas', 'AM'),
('Bahia', 'BA'),
('Ceará', 'CE'),
('Espírito Santo', 'ES'),
('Goiás', 'GO'),
('Maranhão', 'MA'),
('Mato Grosso', 'MT'),
('Mato Grosso do Sul', 'MS'),
('Minas Gerais', 'MG'),
('Pará', 'PA'),
('Paraíba', 'PB'),
('Paraná', 'PR'),
('Pernambuco', 'PE'),
('Piauí', 'PI'),
('Rio de Janeiro', 'RJ'),
('Rio Grande do Norte', 'RN'),
('Rio Grande do Sul', 'RS'),
('Rondônia', 'RO'),
('Roraima', 'RR'),
('Santa Catarina', 'SC'),
('São Paulo', 'SP'),
('Sergipe', 'SE'),
('Tocantins', 'TO');

CREATE TABLE cidades (
    id INT(3) AUTO_INCREMENT PRIMARY KEY,
    cidade VARCHAR(100) NOT NULL,
    id_estado INT(2) NOT NULL,
    populacao INT(10),
    FOREIGN KEY (id_estado) REFERENCES estados(id)
);

-- Inserindo as cidades com seus respectivos estados
INSERT INTO cidades (cidade, estado) VALUES
('Afogados da Ingazeira', 15),
('Petrolina', 15),
('Salgueiro', 15),
('São José do Egito', 15),
('Parnamirim', 15),
('Picos', 16),
('Paulo Afonso', 4),
('Oeiras', 16),
('Itaueira', 16),
('Juazeiro', 4),
('Feira de Santana', 4),
('Itabaianinha', 24),
('Juazeiro do Norte', 5),
('Sobral', 5),
('Aquiraz',5),
('Crato', 5),
('Ilhéus', 4),
('Cícero Dantas', 4),
('Ibiapina', 5);

CREATE TABLE comunidades (
    id INT(5) AUTO_INCREMENT PRIMARY KEY,
    comunidade VARCHAR(100) NOT NULL, 
    id_cidade INT(3) NOT NULL,
    populacao INT(10), 
    FOREIGN KEY (id_cidade) REFERENCES cidades(id) 
);

-- Inserindo as comunidades com suas respectivas cidades
INSERT INTO comunidades (comunidade, id_cidade) VALUES
('Alto do Cruzeiro', 13),
('Mandacaru', 2),
('Boqueirão', 15),
('Barra do Tarrachil', 16),
('São João', 17),
('Jatobá', 18),
('Santa Cruz', 19),
('Lagoa do Barro', 20),
('Caatinga do Moura', 21),
('Beira Rio', 1),
('Canafístula', 23),
('São Sebastião', 24),
('Pindoba', 25),
('Ladeira do Sol', 26),
('Trapiá', 27),
('Sítio do Meio', 28),
('Barra do Gavião', 29),
('Queimadas', 30),
('Pedrinhas', 31);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(10) NOT NULL,
    group VARCHAR(10) NOT NULL,
    pwd VARCHAR(10) NOT NULL
);


CREATE TABLE estado_civil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100) NOT NULL
)

INSERT INTO estado_civil (descricao) VALUES
('casado(a)'),
('solteiro(a)'),
('amasiado(a)'),
('viúvo(a)'),
('divorciado(a)');

CREATE TABLE escolaridade (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100) NOT NULL
)

INSERT INTO escolaridade (descricao) VALUES
('Analfabeto'),
('Leitura / escrita'),
('Fundamental 1'),
('Fundamental 2'),
('Ensino Médio'),
('Superior Cursando'),
('Superior Interrompido'),
('Superior Completo'),
('Pós Graduado');

CREATE TABLE pessoas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    endereco VARCHAR(255),
    id_comunidade INT(5),
    id_est_civil INT(2),
    profissao VARCHAR(100),
    escolaridade INT(2),
    dt_nascimento DATE() NOT NULL,
    cpf INT(11),
    qtd_filhos INT(2)
);

INSERT INTO pessoas (nome,id_comunidade,id_est_civil,dt_nascimento,qtd_filhos) VALUES
('Pessoa 01 Teste',3,1,'1994-10-19',2),
('Pessoa 02 Teste',3,2,'1988-03-14',0),
('Pessoa 03 Teste',3,3,'1995-04-12',0),
('Pessoa 04 Teste',3,4,'1968-06-30',3),
('Pessoa 05 Teste',3,5,'1992-04-02',4),
('Pessoa 06 Teste',3,1,'1982-05-17',2),
('Pessoa 07 Teste',3,4,'1975-08-17',5),
('Pessoa 08 Teste',3,1,'1993-11-22',1),
('Pessoa 09 Teste',3,5,'1999-07-25',2),
('Pessoa 10 Teste',3,1,'1995-09-09',1);

-- CRIAR CHAVE ESTRANGEIRA
ALTER TABLE cidades
ADD CONSTRAINT fk_estado
FOREIGN KEY (id_estado) REFERENCES estados(id_estado);
--------------------------

CREATE TABLE equipe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    endereco VARCHAR(255),
    id_cidade INT(3),
    id_comunidade INT(5),
    id_est_civil INT(2),
    profissao VARCHAR(100),
    escolaridade INT(2),
    dt_nascimento DATE() NOT NULL,
    cpf INT(11),
    qtd_filhos INT(2)
);