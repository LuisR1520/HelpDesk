-- --------------------------------------------------------
-- Host:                         192.168.2.36
-- Versión del servidor:         8.0.32-0ubuntu0.20.04.2 - (Ubuntu)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para prueba
CREATE DATABASE IF NOT EXISTS `prueba` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `prueba`;

-- Volcando estructura para procedimiento prueba.sp_d_usuario_01
DELIMITER //
CREATE PROCEDURE `sp_d_usuario_01`(IN `xusu_id` INT)
BEGIN

	UPDATE tm_usuario 

	SET 

		est='0',

		fech_elim = now() 

	where usu_id=xusu_id;

END//
DELIMITER ;

-- Volcando estructura para procedimiento prueba.sp_i_ticketdetalle_01
DELIMITER //
CREATE PROCEDURE `sp_i_ticketdetalle_01`(IN `xtick_id` INT, IN `xusu_id` INT)
BEGIN

	INSERT INTO td_ticketdetalle 

    (tickd_id,tick_id,usu_id,tickd_descrip,fech_crea,est) 

    VALUES 

    (NULL,xtick_id,xusu_id,'Ticket Cerrado...',now(),'1');

END//
DELIMITER ;

-- Volcando estructura para procedimiento prueba.sp_l_usuario_01
DELIMITER //
CREATE PROCEDURE `sp_l_usuario_01`()
BEGIN

	SELECT * FROM tm_usuario where est='1';

END//
DELIMITER ;

-- Volcando estructura para procedimiento prueba.sp_l_usuario_02
DELIMITER //
CREATE PROCEDURE `sp_l_usuario_02`(IN `xusu_id` INT)
BEGIN

	SELECT * FROM tm_usuario where usu_id=xusu_id;

END//
DELIMITER ;

-- Volcando estructura para tabla prueba.td_documento
CREATE TABLE IF NOT EXISTS `td_documento` (
  `doc_id` int NOT NULL AUTO_INCREMENT,
  `tick_id` int NOT NULL,
  `doc_nom` varchar(400) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fech_crea` datetime NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.td_documento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `td_documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_documento` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.td_documento_detalle
CREATE TABLE IF NOT EXISTS `td_documento_detalle` (
  `det_id` int NOT NULL AUTO_INCREMENT,
  `tickd_id` int NOT NULL,
  `det_nom` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`det_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.td_documento_detalle: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `td_documento_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_documento_detalle` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.td_ticketdetalle
CREATE TABLE IF NOT EXISTS `td_ticketdetalle` (
  `tickd_id` int NOT NULL AUTO_INCREMENT,
  `tick_id` int NOT NULL,
  `usu_id` int NOT NULL,
  `tickd_descrip` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fech_crea` datetime NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`tickd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.td_ticketdetalle: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `td_ticketdetalle` DISABLE KEYS */;
INSERT INTO `td_ticketdetalle` (`tickd_id`, `tick_id`, `usu_id`, `tickd_descrip`, `fech_crea`, `est`) VALUES
	(1, 1, 2, '<p>asd</p>', '2023-01-10 11:17:35', 1),
	(2, 1, 1, '<p>asd</p>', '2023-01-10 11:17:43', 1),
	(3, 1, 1, '<p>asd</p>', '2023-01-10 11:17:56', 1),
	(4, 4, 2, '<p>asdf</p>', '2023-01-10 19:48:08', 1),
	(5, 4, 1, '<p>asd</p>', '2023-01-10 19:49:04', 1),
	(6, 4, 1, '<p>asdasd</p>', '2023-01-10 20:02:14', 1),
	(7, 4, 1, '<p>sad</p>', '2023-01-10 20:02:19', 1),
	(8, 4, 1, '<p>asd</p>', '2023-01-10 20:02:21', 1),
	(9, 4, 2, '<p><span style="font-size: 9px;">﻿Prueba</span><br></p>', '2023-01-11 12:50:06', 1),
	(10, 4, 1, '<p>ASD</p>', '2023-01-11 12:50:24', 1),
	(11, 4, 2, 'Ticket Cerrado...', '2023-01-18 13:04:18', 1),
	(12, 5, 2, 'Ticket Cerrado...', '2023-01-18 13:19:24', 1),
	(13, 6, 2, 'Ticket Cerrado...', '2023-01-18 13:20:17', 1),
	(14, 7, 2, 'Ticket Cerrado...', '2023-01-18 13:21:06', 1),
	(15, 8, 2, 'Ticket Cerrado...', '2023-01-18 13:23:53', 1);
/*!40000 ALTER TABLE `td_ticketdetalle` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.tm_categoria
CREATE TABLE IF NOT EXISTS `tm_categoria` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_nom` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.tm_categoria: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `tm_categoria` DISABLE KEYS */;
INSERT INTO `tm_categoria` (`cat_id`, `cat_nom`, `est`) VALUES
	(1, 'Hardware', 1),
	(2, 'Software', 1),
	(3, 'Incidencia', 1),
	(4, 'Petición de Servicio', 1),
	(5, 'test2', 0);
/*!40000 ALTER TABLE `tm_categoria` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.tm_notificacion
CREATE TABLE IF NOT EXISTS `tm_notificacion` (
  `not_id` int NOT NULL AUTO_INCREMENT,
  `usu_id` int NOT NULL,
  `not_mensaje` varchar(400) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `tick_id` int NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`not_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.tm_notificacion: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `tm_notificacion` DISABLE KEYS */;
INSERT INTO `tm_notificacion` (`not_id`, `usu_id`, `not_mensaje`, `tick_id`, `est`) VALUES
	(1, 2, 'Se le ha asignado el ticket Nro : ', 1, 1),
	(2, 1, 'Tiene una nueva respuesta de soporte del ticket Nro : ', 1, 1),
	(3, 2, 'Tiene una nueva respuesta del usuario con nro de ticket : ', 1, 1),
	(4, 2, 'Tiene una nueva respuesta del usuario con nro de ticket : ', 1, 1),
	(5, 1, 'Tiene una nueva respuesta de soporte del ticket Nro : ', 4, 1),
	(6, 2, 'Tiene una nueva respuesta del usuario con nro de ticket : ', 4, 1),
	(7, 2, 'Tiene una nueva respuesta del usuario con nro de ticket : ', 4, 1),
	(8, 2, 'Tiene una nueva respuesta del usuario con nro de ticket : ', 4, 1),
	(9, 2, 'Tiene una nueva respuesta del usuario con nro de ticket : ', 4, 1),
	(10, 1, 'Tiene una nueva respuesta de soporte del ticket Nro : ', 4, 1),
	(11, 2, 'Tiene una nueva respuesta del usuario con nro de ticket : ', 4, 1);
/*!40000 ALTER TABLE `tm_notificacion` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.tm_prioridad
CREATE TABLE IF NOT EXISTS `tm_prioridad` (
  `prio_id` int NOT NULL AUTO_INCREMENT,
  `prio_nom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`prio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.tm_prioridad: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tm_prioridad` DISABLE KEYS */;
INSERT INTO `tm_prioridad` (`prio_id`, `prio_nom`, `est`) VALUES
	(1, 'Bajo', 1),
	(2, 'Medio', 1),
	(3, 'Alto', 1),
	(4, 'test2', 0);
/*!40000 ALTER TABLE `tm_prioridad` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.tm_subcategoria
CREATE TABLE IF NOT EXISTS `tm_subcategoria` (
  `cats_id` int NOT NULL AUTO_INCREMENT,
  `cat_id` int NOT NULL,
  `cats_nom` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`cats_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.tm_subcategoria: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `tm_subcategoria` DISABLE KEYS */;
INSERT INTO `tm_subcategoria` (`cats_id`, `cat_id`, `cats_nom`, `est`) VALUES
	(1, 1, 'Teclado', 1),
	(2, 1, 'Monitor', 1),
	(3, 2, 'Winrar', 1),
	(4, 2, 'VSCODE', 1),
	(5, 3, 'Corte de Red', 1),
	(6, 3, 'Corte de Energia', 1),
	(7, 4, 'JSON de Software', 1),
	(8, 4, 'Instalación de IIS', 1),
	(9, 1, 'test2', 1);
/*!40000 ALTER TABLE `tm_subcategoria` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.tm_ticket
CREATE TABLE IF NOT EXISTS `tm_ticket` (
  `tick_id` int NOT NULL AUTO_INCREMENT,
  `usu_id` int NOT NULL,
  `cat_id` int NOT NULL,
  `tick_titulo` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `tick_descrip` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `tick_estado` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `usu_asig` int DEFAULT NULL,
  `fech_asig` datetime DEFAULT NULL,
  `fech_cierre` datetime DEFAULT NULL,
  `usu_cierre` int DEFAULT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`tick_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.tm_ticket: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `tm_ticket` DISABLE KEYS */;
INSERT INTO `tm_ticket` (`tick_id`, `usu_id`, `cat_id`, `tick_titulo`, `tick_descrip`, `tick_estado`, `fech_crea`, `usu_asig`, `fech_asig`, `fech_cierre`, `usu_cierre`, `est`) VALUES
	(4, 1, 3, 'PRUEBA DE ASIGNACION FINAL', '<p>ASDFQWE</p>', 'Cerrado', '2023-01-10 19:47:33', 2, '2023-01-10 19:47:56', '2023-01-18 13:04:17', 2, 1),
	(5, 1, 1, 'Cambio de pantalla', '<p>ASDASDASDASDASDAS</p>', 'Cerrado', '2023-01-18 13:16:09', NULL, NULL, '2023-01-18 13:19:24', 2, 1),
	(6, 1, 1, 'Cambio de pantalla', '<p>asdasd</p>', 'Cerrado', '2023-01-18 13:17:30', NULL, NULL, '2023-01-18 13:20:17', 2, 1),
	(7, 1, 1, 'Cambio de pantalla', '<p>assa</p>', 'Cerrado', '2023-01-18 13:18:07', NULL, NULL, '2023-01-18 13:21:06', 2, 1),
	(8, 1, 3, 'Cambio de pantalla', '<p>asdasdasd</p>', 'Cerrado', '2023-01-18 13:21:41', NULL, NULL, '2023-01-18 13:23:53', 2, 1),
	(9, 1, 1, 'Prueba falsa', '<p>ASDADS</p>', 'Abierto', '2023-01-18 13:31:08', NULL, NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `tm_ticket` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.tm_usuario
CREATE TABLE IF NOT EXISTS `tm_usuario` (
  `usu_id` int NOT NULL AUTO_INCREMENT,
  `usu_nom` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `usu_ape` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `usu_correo` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `usu_pass` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `rol_id` int DEFAULT NULL,
  `usu_telf` varchar(12) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `est` int NOT NULL,
  PRIMARY KEY (`usu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci COMMENT='Tabla Mantenedor de Usuarios';

-- Volcando datos para la tabla prueba.tm_usuario: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `tm_usuario` DISABLE KEYS */;
INSERT INTO `tm_usuario` (`usu_id`, `usu_nom`, `usu_ape`, `usu_correo`, `usu_pass`, `rol_id`, `usu_telf`, `fech_crea`, `fech_modi`, `fech_elim`, `est`) VALUES
	(1, 'Luis ', 'Rodriguez', 'lrodriguez@ampyme.gob.pa', '$2y$10$xu4Scy0DYcPjbyhQtxt5ZOM/AnQzF6Fewws6nOHlz6Yzbtv94uPu6', 2, '51959747999', '2020-12-14 19:46:22', NULL, NULL, 1),
	(2, 'Luis', 'Rodriguez', 'DAVIS_ANDERSON_87@HOTMAIL.COM', '$2y$10$0XORVl2AM1jAPP.DeB/IJOH6uwPkyGsG8AJjbrK4Jy7AInymMwN/O', 1, '51959747999', '2020-12-14 19:46:22', NULL, NULL, 1),
	(3, 'Demo', 'Demo', 'demo12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '51959747999', '2020-12-14 19:46:22', NULL, '2021-01-21 22:04:50', 1),
	(4, 'qwqweqwe', 'qweqweqwe', 'qweqwe@a.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '51959747999', '2021-01-21 22:52:17', NULL, NULL, 1),
	(5, 'eqweqwe', 'ASaws', 'ADAD@ASDASD.COM', 'e10adc3949ba59abbe56e057f20f883e', 1, '51959747999', '2021-01-21 22:52:53', NULL, '2021-01-21 22:53:27', 0),
	(6, 'ASDASDA', 'ASDASD', 'ASASD@ASDOMC.COM', 'e10adc3949ba59abbe56e057f20f883e', 2, '51959747999', '2021-01-21 22:54:12', NULL, NULL, 1),
	(7, 'asdasdasd', 'asdasdasd', 'asdasdasdasdasd@asdasdasd.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '51959747999', '2021-01-21 22:55:12', NULL, '2021-02-05 22:23:09', 0),
	(8, 'Test11111', 'Test2111111', 'test@test2.com.pe', 'e10adc3949ba59abbe56e057f20f883e', 1, '51959747999', '2021-02-05 22:22:31', NULL, '2021-02-08 21:09:58', 0),
	(9, 'Usuario', 'Apellido', 'Correo@correo.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '51959747999', '2021-06-13 19:09:17', NULL, NULL, 1),
	(10, 'Test', 'Test', 'test@tes.com.pe', '123456', 1, '51959747999', '2021-06-13 19:10:34', NULL, NULL, 1),
	(11, 'Soporte', '1', 'datos@datos.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '51959747999', '2021-06-13 19:16:43', NULL, NULL, 1),
	(12, 'aaaaaa', 'asdasd', 'davis_anderson_87@hotmailx.com', '$2y$10$Bii1u7FfgSwWepj.99hMruP4ExCFilV2ygMtRr0gz0uA40OJMy3Ee', 1, '51959747999', '2022-02-08 22:13:46', NULL, NULL, 1);
/*!40000 ALTER TABLE `tm_usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
