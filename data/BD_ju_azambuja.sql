-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for data_barbearia_projeto
CREATE DATABASE IF NOT EXISTS `data_barbearia_projeto` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `data_barbearia_projeto`;

-- Dumping structure for table data_barbearia_projeto.agenda
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_atendente` int(11) NOT NULL,
  `id_status` int(2) DEFAULT NULL,
  `data_atendimento` date DEFAULT NULL,
  `hora_inicial` time DEFAULT NULL,
  `hora_final` time DEFAULT NULL,
  `id_servico` int(11) NOT NULL,
  `valor_servico` decimal(5,2) DEFAULT NULL,
  `justificativa` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_agenda_status` (`id_atendente`),
  KEY `fk_agenda_servico` (`id_servico`),
  KEY `FK_agenda_cliente` (`id_cliente`),
  KEY `fF_agenda_status` (`id_status`),
  CONSTRAINT `FK_agenda_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  CONSTRAINT `FK_agenda_usuario` FOREIGN KEY (`id_atendente`) REFERENCES `usuario` (`id`),
  CONSTRAINT `fF_agenda_status` FOREIGN KEY (`id_status`) REFERENCES `status_agenda` (`id`),
  CONSTRAINT `fk_agenda_servico` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table data_barbearia_projeto.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(150) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(13) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `profissao` varchar(50) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `total_agendados` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table data_barbearia_projeto.servicos
CREATE TABLE IF NOT EXISTS `servicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `valor` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table data_barbearia_projeto.status_agenda
CREATE TABLE IF NOT EXISTS `status_agenda` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `chave` varchar(50) DEFAULT NULL,
  `cor_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table data_barbearia_projeto.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(150) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(13) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL,
  `perfil` varchar(30) DEFAULT NULL,
  `user_status` varchar(15) DEFAULT NULL,
  `nome` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
