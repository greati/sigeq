CREATE DATABASE SIGEQ_db;

USE SIGEQ_db;

CREATE TABLE usuario(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100),
	email VARCHAR(100),
	username VARCHAR(45) UNIQUE,
	senha VARCHAR(45),
	descricao TEXT,
	cadastrado_por INT,
	/*data_cadastro DATETIME NOT NULL,*/
	created DATETIME,
	data_nascimento DATE NOT NULL,
	telefoneFixo VARCHAR(15),
	celular VARCHAR(15),
	rua VARCHAR(200),
	numeroCasa INT,
	bairro VARCHAR(50),
	cidade VARCHAR(40),
	estado CHAR(2),
	cep VARCHAR(15),
    FOREIGN KEY (cadastrado_por) REFERENCES usuario(id)
);

CREATE TABLE autoridade(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(45) UNIQUE
);

CREATE TABLE usuario_autoridade(
	usuario_id INT NOT NULL,
	autoridade_id INT NOT NULL,
	PRIMARY KEY(usuario_id, autoridade_id),
	FOREIGN KEY (usuario_id) REFERENCES usuario(id),
	FOREIGN KEY (autoridade_id) REFERENCES autoridade(id)
);

CREATE TABLE categoria_equipamento(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL UNIQUE,
	descricao VARCHAR(255) NULL,
	created DATETIME
);

CREATE TABLE equipamento(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL,
	fabricante VARCHAR(50),
	descricao TEXT,
	instrucoes TEXT,
	precaucoes TEXT,
	/*data_cadastro DATETIME,*/
	created DATETIME,
	quantidade INT,
	cadastrado_por INT,
	categoria_id INT,
	tombamento VARCHAR(100),
	FOREIGN KEY (cadastrado_por) REFERENCES usuario(id),
	FOREIGN KEY (categoria_id) REFERENCES categoria_equipamento(id)
);

CREATE TABLE usuario_reserva_equipamento(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	descricao TEXT,
	data_inicio DATETIME,
	data_final DATETIME,
	usuario_id INT,
	equipamento_id INT,
	created DATETIME,
	FOREIGN KEY (usuario_id) REFERENCES usuario(id),
	FOREIGN KEY (equipamento_id) REFERENCES equipamento(id),
	UNIQUE KEY date_index (data_inicio,data_final,equipamento_id)
);

CREATE TABLE usuario_edita_equipamento(
	usuario_id INT NOT NULL,
	equipamento_id INT NOT NULL,
	created DATETIME,
	FOREIGN KEY (usuario_id) REFERENCES usuario(id),
	FOREIGN KEY (equipamento_id) REFERENCES equipamento(id)
);

CREATE TABLE categoria_tutorial(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL,
	created DATETIME
);

CREATE TABLE tutorial(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	titulo VARCHAR(255),
	texto TEXT,
	categoria_id INT,
	created DATETIME,
	FOREIGN KEY (categoria_id) REFERENCES categoria_tutorial(id)
);

CREATE TABLE usuario_edita_tutorial(
	usuario_id INT NOT NULL,
	tutorial_id INT NOT NULL,
	created DATETIME,
	FOREIGN KEY (usuario_id) REFERENCES usuario(id),
	FOREIGN KEY (tutorial_id) REFERENCES tutorial(id)
);

-- criação autoridade
INSERT INTO autoridade(nome) VALUES('Gerente de Usuários');
INSERT INTO autoridade(nome) VALUES('Gerente de Equipamentos');
INSERT INTO autoridade(nome) VALUES('Escritor de Tutoriais');
INSERT INTO autoridade(nome) VALUES('Usuário do Laboratório');
-- criação de administrador
INSERT INTO usuario(username,senha,created,data_nascimento,nome) VALUES ('admin','admin12345','12/12/1996','12/12/1996','Administrador primário');
INSERT INTO usuario_autoridade VALUES (1,1);
INSERT INTO usuario_autoridade VALUES (1,2);
INSERT INTO usuario_autoridade VALUES (1,3);
-- criação de categorias
INSERT INTO categoria_equipamento(nome,descricao) VALUES ('Vidraria','Vidros.');
INSERT INTO categoria_tutorial(nome) VALUES ('Vidraria');