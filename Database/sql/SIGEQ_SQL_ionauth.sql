CREATE DATABASE WIT_db;

USE WIT_db;

/*----------------------------------------------------

The following code creates the tables for the user
and authentication management.

It was based on the SQL given by Ion Auth's author,
which is necessary to the correct working of the
Ion Auth system.

It consists in four tables:

- usuario (users, originally)
- autoridade (groups, originally)
- usuario_autoridade (user_groups, originally)
- login_attempts
-----------------------------------------------------*/

DROP TABLE IF EXISTS `autoridade`;

#
# Table structure for table 'autoridade'
#

CREATE TABLE `autoridade`(
	`id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(20) NOT NULL,
	`description` VARCHAR(100) NOT NULL,
	PRIMARY KEY(`id`)
);

#
# Dumping data for table 'autoridade'
#

INSERT INTO `autoridade` (`id`, `name`, `description`) VALUES
     (1,'g_usu','Gerente de Usuários'),
     (2,'g_equips','Gerente de Equipamentos'),
	 (3,'g_tut','Escritor de Tutoriais'),
	 (4,'u_lab','Usuário do Laboratório'),
	 (5,'g_amb','Gerente de Ambientes');


DROP TABLE IF EXISTS `usuario`;

#
# Table struture for table 'usuario'
#

CREATE TABLE `usuario`(
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`ip_address` VARCHAR(15) NOT NULL,
	`username` VARCHAR(100) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`salt` VARCHAR(255) DEFAULT NULL,
	`email` VARCHAR(100) NOT NULL,
	`activation_code` VARCHAR(40) DEFAULT NULL,
	`forgotten_password_code` VARCHAR(40) DEFAULT NULL,
	`forgotten_password_time` INT(11) UNSIGNED DEFAULT NULL,
	`remember_code` VARCHAR(40) DEFAULT NULL,
	`created_on` INT(11) UNSIGNED NOT NULL,
	`last_login` INT(11) UNSIGNED DEFAULT NULL,
	`active` TINYINT(1) UNSIGNED DEFAULT NULL,
	`nome` VARCHAR(100),
	`descricao` TEXT,
	`cadastrado_por` INT(11) UNSIGNED,
	`data_nascimento` DATE,
	`telefoneFixo` VARCHAR(15),
	`celular` VARCHAR(15),
	`rua` VARCHAR(200),
	`numeroCasa` INT,
	`bairro` VARCHAR(50),
	`cidade` VARCHAR(40),
	`estado` CHAR(2),
	`cep` VARCHAR(15),
	`is_publico` BOOLEAN DEFAULT TRUE,
	PRIMARY KEY(`id`),
    FOREIGN KEY (`cadastrado_por`) REFERENCES usuario(`id`)
);

#
# Dumping data for table 'usuario'
#

INSERT INTO `usuario` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `created_on`, `last_login`, `active`) VALUES
     ('1','127.0.0.1','admin','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,'1268889823','1268889823','1');


DROP TABLE IF EXISTS `usuario_autoridade`;

#
# Table structure for table 'usuario_autoridade'
#

CREATE TABLE `usuario_autoridade`(
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) UNSIGNED NOT NULL,
	`group_id` MEDIUMINT(8) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	KEY `fk_users_groups_users1_idx` (`user_id`),
	KEY `fk_users_groups_groups1_idx` (`group_id`),
	CONSTRAINT `uc_users_groups` UNIQUE (`user_id`, `group_id`),
	CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
	CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `autoridade` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
);

#
# Dumping data for table 'usuario_autoridade'
#

INSERT INTO `usuario_autoridade` (`id`, `user_id`, `group_id`) VALUES
	(1,1,1),
	(2,1,2),
	(3,1,3),
	(4,1,4);


DROP TABLE IF EXISTS `login_attempts`;

#
# Table structure for table 'login_attempts'
#

CREATE TABLE `login_attempts` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`ip_address` VARCHAR(15) NOT NULL,
	`login` VARCHAR(100) NOT NULL,
	`time` INT(11) UNSIGNED DEFAULT NULL,
	PRIMARY KEY (`id`)
);

/*----------------------------------------------------

The following code is about the other tables of the
system.

-----------------------------------------------------*/

DROP TABLE IF EXISTS `categoria_equipamento`;

#
# Table structure for table 'categoria_equipamento'
#

CREATE TABLE `categoria_equipamento`(
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(100) NOT NULL UNIQUE,
	`descricao` VARCHAR(255) NULL,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);

#
# Dumping data for table 'categoria_equipamento' and 'categoria_tutorial'
#

INSERT INTO categoria_equipamento(nome,descricao) VALUES ('Vidraria','Vidros.');


DROP TABLE IF EXISTS `equipamento`;

#
# Table structure for table 'equipamento'
#

CREATE TABLE `equipamento`(
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(100) NOT NULL,
	`fabricante` VARCHAR(50),
	`descricao` TEXT,
	`instrucoes` TEXT,
	`precaucoes` TEXT,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`quantidade` INT,
	/*`cadastrado_por` INT(11) UNSIGNED,*/
	`categoria_id` INT UNSIGNED,
	`tombamento` VARCHAR(100),
	/*FOREIGN KEY (`cadastrado_por`) REFERENCES usuario(`id`),*/
	FOREIGN KEY (`categoria_id`) REFERENCES categoria_equipamento(`id`)
);


DROP TABLE IF EXISTS `usuario_reserva_equipamento`;

#
# Table structure for table 'usuario_reserva_equipamento'
#

CREATE TABLE `usuario_reserva_equipamento`(
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`descricao` TEXT,
	`data_inicio` DATETIME,
	`data_final` DATETIME,
	`usuario_id` INT(11) UNSIGNED,
	`equipamento_id` INT UNSIGNED,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (`usuario_id`) REFERENCES usuario(`id`),
	FOREIGN KEY (`equipamento_id`) REFERENCES equipamento(`id`),
	UNIQUE KEY `date_index` (`data_inicio`,`data_final`,`equipamento_id`)
);


DROP TABLE IF EXISTS `usuario_edita_equipamento`;

#
# Table structure for table 'usuario_edita_equipamento'
#

CREATE TABLE `usuario_edita_equipamento`(
	`usuario_id` INT(11) UNSIGNED NOT NULL,
	`equipamento_id` INT UNSIGNED NOT NULL,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (`usuario_id`) REFERENCES usuario(`id`),
	FOREIGN KEY (`equipamento_id`) REFERENCES equipamento(`id`)
);


DROP TABLE IF EXISTS `categoria_tutorial`;

#
# Table structure for table 'categoria_tutorial'
#

CREATE TABLE `categoria_tutorial`(
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(100) NOT NULL,
	`descricao` TEXT,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

#
# Dumping data for table 'categoria_tutorial'
#

INSERT INTO categoria_tutorial(nome) VALUES ('Vidraria');


DROP TABLE IF EXISTS `tutorial`;

#
# Table structure for table 'tutorial'
#

CREATE TABLE `tutorial`(
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`titulo` VARCHAR(255),
	`texto` TEXT,
	`categoria_id` INT UNSIGNED,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (`categoria_id`) REFERENCES categoria_tutorial(`id`)
);


DROP TABLE IF EXISTS `usuario_edita_tutorial`;

#
# Table structure for table 'usuario_edita_tutorial'
#

CREATE TABLE `usuario_edita_tutorial`(
	`usuario_id` INT(11) UNSIGNED NOT NULL,
	`tutorial_id` INT UNSIGNED NOT NULL,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (`usuario_id`) REFERENCES usuario(`id`),
	FOREIGN KEY (`tutorial_id`) REFERENCES tutorial(`id`)
);

DROP TABLE IF EXISTS `categoria_ambiente`;

#
# Table structure for table 'categoria_ambiente'
#

CREATE TABLE `categoria_ambiente`(
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(100) NOT NULL,
	`descricao` TEXT
);


DROP TABLE IF EXISTS `ambiente`;

#
# Table structure for table 'ambiente'
#

CREATE TABLE `ambiente` (
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(150),
	`descricao` TEXT,
	`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`categoria_id` INT UNSIGNED NOT NULL,
	FOREIGN KEY (categoria_id) REFERENCES categoria_ambiente(id)
);

DROP TABLE IF EXISTS `localizacao`;

#
# Table structure for table 'localização'
# This entity represents locations inside an 'ambiente'

CREATE TABLE `localizacao`(
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` TEXT(100) NOT NULL,
	`descricao` TEXT,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`ambiente_id` INT UNSIGNED NOT NULL,
	`ratioX` DECIMAL(9,7) NULL,
	`ratioY` DECIMAL(9, 7) NULL,
	FOREIGN KEY (ambiente_id) REFERENCES ambiente(id)
);

DROP TABLE IF EXISTS `localizacao_equipamento`;

#
# Table structure for table 'localização_equipamento'
# It allows to determine where a equipment is

CREATE TABLE `localizacao_equipamento`(
	`equipamento_id` INT UNSIGNED NOT NULL,
	`localizacao_id` INT UNSIGNED NOT NULL,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT localizacao_equip_PK_1 PRIMARY KEY(localizacao_id, equipamento_id),
	CONSTRAINT localizacao_equip_FK_1 FOREIGN KEY (localizacao_id) REFERENCES localizacao(id),
	CONSTRAINT localizacao_equip_FK_2 FOREIGN KEY (equipamento_id) REFERENCES equipamento(id)
);

DROP TABLE IF EXISTS `categoria_risco`;

#
# Table structure for table 'categoria_risco'
#

CREATE TABLE `categoria_risco`(
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(20),
	`descricao` TEXT
);
 

DROP TABLE IF EXISTS `risco`;

#
# Table structure for table 'risco'
# 

CREATE TABLE `risco`(
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(150) NOT NULL, 
	`gravidade` VARCHAR(20),
	`descricao` TEXT,
	`ambiente_id` INT UNSIGNED NOT NULL,
	`categoria_id` INT UNSIGNED NOT NULL,
	FOREIGN KEY (ambiente_id) REFERENCES ambiente(id),
	FOREIGN KEY (categoria_id) REFERENCES categoria_risco(id)
);





