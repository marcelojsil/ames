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

INSERT INTO cidades (cidade, id_estado) VALUES


CREATE TABLE comunidades (
    id INT(5) AUTO_INCREMENT PRIMARY KEY,
    comunidade VARCHAR(100) NOT NULL, 
    id_cidade INT(3) NOT NULL,
    populacao INT(10), 
    FOREIGN KEY (id_cidade) REFERENCES cidades(id) 
);

INSERT INTO comunidades (comunidade,id_cidade) VALUES
('Lagoa do Boi',1),
('Angico',1),
('Rocinha',1),
('Maruá',1),