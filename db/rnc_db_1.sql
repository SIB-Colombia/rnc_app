-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2014 at 07:06 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rnc_db`
--
CREATE DATABASE IF NOT EXISTS `rnc_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `rnc_db`;

-- --------------------------------------------------------

--
-- Table structure for table `archivos`
--

CREATE TABLE IF NOT EXISTS `archivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `ruta` varchar(500) NOT NULL,
  `size` varchar(45) DEFAULT NULL,
  `clase` int(11) NOT NULL,
  `Registros_update_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_archivos_Registros_update1_idx` (`Registros_update_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `archivos`
--

INSERT INTO `archivos` (`id`, `nombre`, `tipo`, `ruta`, `size`, `clase`, `Registros_update_id`) VALUES
(4, '78_20131220_133_MLS_ACTUALIZACION.pdf', '.pdf', 'rnc_files\\Registro_Colecciones_Biologicas\\9_MLS\\archivosAnexos', '9688987', 1, 9),
(5, '451_20131218_187_BOG_ACTUALIZACION.pdf', '.pdf', 'rnc_files\\Registro_Colecciones_Biologicas\\10_BOG\\archivosAnexos', '7647741', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `archivos_pqrs`
--

CREATE TABLE IF NOT EXISTS `archivos_pqrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `ruta` varchar(500) DEFAULT NULL,
  `visitas_id` int(11) DEFAULT NULL,
  `pqrs_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `composicion_general`
--

CREATE TABLE IF NOT EXISTS `composicion_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subgrupo_otro` varchar(150) DEFAULT NULL,
  `numero_ejemplares` int(11) DEFAULT '0',
  `numero_catalogados` float DEFAULT '0',
  `numero_sistematizados` float DEFAULT '0',
  `numero_nivel_orden` float DEFAULT NULL,
  `numero_nivel_familia` float DEFAULT NULL,
  `numero_nivel_genero` float DEFAULT NULL,
  `numero_nivel_especie` float DEFAULT '0',
  `Registros_update_id` int(11) NOT NULL,
  `grupo_taxonomico_id` int(11) DEFAULT NULL,
  `subgrupo_taxonomico_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_composicion_general_Registros_update1_idx` (`Registros_update_id`),
  KEY `fk_composicion_general_grupo_taxonomico1_idx` (`grupo_taxonomico_id`),
  KEY `fk_composicion_general_subgrupo_taxonomico1_idx` (`subgrupo_taxonomico_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `composicion_general`
--

INSERT INTO `composicion_general` (`id`, `subgrupo_otro`, `numero_ejemplares`, `numero_catalogados`, `numero_sistematizados`, `numero_nivel_orden`, `numero_nivel_familia`, `numero_nivel_genero`, `numero_nivel_especie`, `Registros_update_id`, `grupo_taxonomico_id`, `subgrupo_taxonomico_id`) VALUES
(13, '', 14758, 100, 0, 0, 2, 10, 7, 9, 3, 16),
(14, '97', 502, 97, 0, 0, 37, 37, 21, 9, 3, 18),
(15, '89', 13312, 89, 0, 0, 49, 35, 31, 9, 3, 11),
(16, '100', 6704, 100, 0, 0, 90, 75, 60, 9, 4, 19),
(17, '100', 8741, 100, 0, 0, 97, 81, 70, 9, 4, 20),
(18, '100', 4900, 100, 0, 0, 100, 100, 100, 9, 4, 24),
(19, '93', 1482, 93, 0, 0, 99, 80, 70, 9, 4, 21),
(20, '96', 1713, 96, 0, 0, 96, 46, 35, 9, 4, 22),
(21, NULL, 15021, 87, 0, 0, 93, 57, 57, 10, 5, 25),
(22, NULL, 578, 57, 0, 0, 42, 24, 12, 10, 5, 26);

-- --------------------------------------------------------

--
-- Table structure for table `contactos`
--

CREATE TABLE IF NOT EXISTS `contactos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `cargo` varchar(150) DEFAULT NULL,
  `dependencia` varchar(150) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `contactos`
--

INSERT INTO `contactos` (`id`, `nombre`, `cargo`, `dependencia`, `direccion`, `ciudad_id`, `telefono`, `email`) VALUES
(9, 'Hno. José Edilson Espitia Barrera ', 'Director Museo', 'Museo ', 'Carrera 2 No. 10 -70 Universidad de la Salle', 11001, '3346189', 'jespitia@lasalle.edu.co'),
(10, 'Hno. José Edilson Espitia Barrera ', 'Director Museo', 'Museo ', 'Carrera 2 No. 10 -70 Universidad de la Salle', 11001, '3346189', 'jespitia@lasalle.edu.co');

-- --------------------------------------------------------

--
-- Table structure for table `contenido`
--

CREATE TABLE IF NOT EXISTS `contenido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) NOT NULL,
  `contenido` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `county`
--

CREATE TABLE IF NOT EXISTS `county` (
  `id` int(10) NOT NULL,
  `iso_county_code` char(8) NOT NULL,
  `department_id` int(10) DEFAULT NULL,
  `county_name` varchar(255) DEFAULT NULL,
  `species_count` int(10) DEFAULT NULL,
  `occurrence_count` int(10) DEFAULT NULL,
  `occurrence_coordinate_count` int(10) DEFAULT NULL,
  PRIMARY KEY (`iso_county_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `county`
--

INSERT INTO `county` (`id`, `iso_county_code`, `department_id`, `county_name`, `species_count`, `occurrence_count`, `occurrence_coordinate_count`) VALUES
(1, '05001', 2, 'Medellín', NULL, NULL, NULL),
(2, '05002', 2, 'Abejorral', NULL, NULL, NULL),
(3, '05004', 2, 'Abriaquí', NULL, NULL, NULL),
(4, '05021', 2, 'AlejandrÍa', NULL, NULL, NULL),
(5, '05030', 2, 'Amagá', NULL, NULL, NULL),
(6, '05031', 2, 'Amalfi', NULL, NULL, NULL),
(7, '05034', 2, 'Andes', NULL, NULL, NULL),
(8, '05036', 2, 'Angelópolis', NULL, NULL, NULL),
(9, '05038', 2, 'Angostura', NULL, NULL, NULL),
(10, '05040', 2, 'AnorÍ', NULL, NULL, NULL),
(11, '05042', 2, 'Santafé de antioquia', NULL, NULL, NULL),
(12, '05044', 2, 'Anza', NULL, NULL, NULL),
(13, '05045', 2, 'Apartadó', NULL, NULL, NULL),
(14, '05051', 2, 'Arboletes', NULL, NULL, NULL),
(15, '05055', 2, 'Argelia', NULL, NULL, NULL),
(16, '05059', 2, 'Armenia', NULL, NULL, NULL),
(17, '05079', 2, 'Barbosa', NULL, NULL, NULL),
(18, '05086', 2, 'Belmira', NULL, NULL, NULL),
(19, '05088', 2, 'Bello', NULL, NULL, NULL),
(20, '05091', 2, 'Betania', NULL, NULL, NULL),
(21, '05093', 2, 'Betulia', NULL, NULL, NULL),
(22, '05101', 2, 'Ciudad bolívar', NULL, NULL, NULL),
(23, '05107', 2, 'Briceño', NULL, NULL, NULL),
(24, '05113', 2, 'Buriticá', NULL, NULL, NULL),
(25, '05120', 2, 'Cáceres', NULL, NULL, NULL),
(26, '05125', 2, 'Caicedo', NULL, NULL, NULL),
(27, '05129', 2, 'Caldas', NULL, NULL, NULL),
(28, '05134', 2, 'Campamento', NULL, NULL, NULL),
(29, '05138', 2, 'Cañasgordas', NULL, NULL, NULL),
(30, '05142', 2, 'Caracolí', NULL, NULL, NULL),
(31, '05145', 2, 'Caramanta', NULL, NULL, NULL),
(32, '05147', 2, 'Carepa', NULL, NULL, NULL),
(33, '05148', 2, 'El carmen de viboral', NULL, NULL, NULL),
(34, '05150', 2, 'Carolina', NULL, NULL, NULL),
(35, '05154', 2, 'Caucasia', NULL, NULL, NULL),
(36, '05172', 2, 'Chigorodó', NULL, NULL, NULL),
(37, '05190', 2, 'Cisneros', NULL, NULL, NULL),
(38, '05197', 2, 'Cocorná', NULL, NULL, NULL),
(39, '05206', 2, 'Concepción', NULL, NULL, NULL),
(40, '05209', 2, 'Concordia', NULL, NULL, NULL),
(41, '05212', 2, 'Copacabana', NULL, NULL, NULL),
(42, '05234', 2, 'Dabeiba', NULL, NULL, NULL),
(43, '05237', 2, 'Donmatías', NULL, NULL, NULL),
(44, '05240', 2, 'Ebéjico', NULL, NULL, NULL),
(45, '05250', 2, 'El bagre', NULL, NULL, NULL),
(46, '05264', 2, 'Entrerrios', NULL, NULL, NULL),
(47, '05266', 2, 'Envigado', NULL, NULL, NULL),
(48, '05282', 2, 'Fredonia', NULL, NULL, NULL),
(49, '05284', 2, 'Frontino', NULL, NULL, NULL),
(50, '05306', 2, 'Giraldo', NULL, NULL, NULL),
(51, '05308', 2, 'Girardota', NULL, NULL, NULL),
(52, '05310', 2, 'Gómez plata', NULL, NULL, NULL),
(53, '05313', 2, 'Granada', NULL, NULL, NULL),
(54, '05315', 2, 'Guadalupe', NULL, NULL, NULL),
(55, '05318', 2, 'Guarne', NULL, NULL, NULL),
(56, '05321', 2, 'Guatape', NULL, NULL, NULL),
(57, '05347', 2, 'Heliconia', NULL, NULL, NULL),
(58, '05353', 2, 'Hispania', NULL, NULL, NULL),
(59, '05360', 2, 'Itagui', NULL, NULL, NULL),
(60, '05361', 2, 'Ituango', NULL, NULL, NULL),
(61, '05364', 2, 'Jardín', NULL, NULL, NULL),
(62, '05368', 2, 'Jericó', NULL, NULL, NULL),
(63, '05376', 2, 'La ceja', NULL, NULL, NULL),
(64, '05380', 2, 'La estrella', NULL, NULL, NULL),
(65, '05390', 2, 'La pintada', NULL, NULL, NULL),
(66, '05400', 2, 'La unión', NULL, NULL, NULL),
(67, '05411', 2, 'Liborina', NULL, NULL, NULL),
(68, '05425', 2, 'Maceo', NULL, NULL, NULL),
(69, '05440', 2, 'Marinilla', NULL, NULL, NULL),
(70, '05467', 2, 'Montebello', NULL, NULL, NULL),
(71, '05475', 2, 'Murindó', NULL, NULL, NULL),
(72, '05480', 2, 'Mutatá', NULL, NULL, NULL),
(73, '05483', 2, 'Nariño', NULL, NULL, NULL),
(74, '05490', 2, 'NecoclÍ', NULL, NULL, NULL),
(75, '05495', 2, 'Nechí', NULL, NULL, NULL),
(76, '05501', 2, 'Olaya', NULL, NULL, NULL),
(77, '05541', 2, 'Peñol', NULL, NULL, NULL),
(78, '05543', 2, 'Peque', NULL, NULL, NULL),
(79, '05576', 2, 'Pueblorrico', NULL, NULL, NULL),
(80, '05579', 2, 'Puerto berrío', NULL, NULL, NULL),
(81, '05585', 2, 'Puerto nare', NULL, NULL, NULL),
(82, '05591', 2, 'Puerto triunfo', NULL, NULL, NULL),
(83, '05604', 2, 'Remedios', NULL, NULL, NULL),
(84, '05607', 2, 'Retiro', NULL, NULL, NULL),
(85, '05615', 2, 'Rionegro', NULL, NULL, NULL),
(86, '05628', 2, 'Sabanalarga', NULL, NULL, NULL),
(87, '05631', 2, 'Sabaneta', NULL, NULL, NULL),
(88, '05642', 2, 'Salgar', NULL, NULL, NULL),
(89, '05647', 2, 'San andrés de cuerquia', NULL, NULL, NULL),
(90, '05649', 2, 'San carlos', NULL, NULL, NULL),
(91, '05652', 2, 'San francisco', NULL, NULL, NULL),
(92, '05656', 2, 'San jerónimo', NULL, NULL, NULL),
(93, '05658', 2, 'San josé de la montaña', NULL, NULL, NULL),
(94, '05659', 2, 'San juan de urabá', NULL, NULL, NULL),
(95, '05660', 2, 'San luis', NULL, NULL, NULL),
(96, '05664', 2, 'San pedro de los milagros', NULL, NULL, NULL),
(97, '05665', 2, 'San pedro de uraba', NULL, NULL, NULL),
(98, '05667', 2, 'San rafael', NULL, NULL, NULL),
(99, '05670', 2, 'San roque', NULL, NULL, NULL),
(100, '05674', 2, 'San vicente', NULL, NULL, NULL),
(101, '05679', 2, 'Santa bárbara', NULL, NULL, NULL),
(102, '05686', 2, 'Santa rosa de osos', NULL, NULL, NULL),
(103, '05690', 2, 'Santo domingo', NULL, NULL, NULL),
(104, '05697', 2, 'El santuario', NULL, NULL, NULL),
(105, '05736', 2, 'Segovia', NULL, NULL, NULL),
(106, '05756', 2, 'Sonson', NULL, NULL, NULL),
(107, '05761', 2, 'Sopetrán', NULL, NULL, NULL),
(108, '05789', 2, 'Támesis', NULL, NULL, NULL),
(109, '05790', 2, 'Tarazá', NULL, NULL, NULL),
(110, '05792', 2, 'Tarso', NULL, NULL, NULL),
(111, '05809', 2, 'Titiribí', NULL, NULL, NULL),
(112, '05819', 2, 'Toledo', NULL, NULL, NULL),
(113, '05837', 2, 'Turbo', NULL, NULL, NULL),
(114, '05842', 2, 'Uramita', NULL, NULL, NULL),
(115, '05847', 2, 'Urrao', NULL, NULL, NULL),
(116, '05854', 2, 'Valdivia', NULL, NULL, NULL),
(117, '05856', 2, 'Valparaíso', NULL, NULL, NULL),
(118, '05858', 2, 'Vegachi', NULL, NULL, NULL),
(119, '05861', 2, 'Venecia', NULL, NULL, NULL),
(120, '05873', 2, 'Vigía del fuerte', NULL, NULL, NULL),
(121, '05885', 2, 'YalÍ', NULL, NULL, NULL),
(122, '05887', 2, 'Yarumal', NULL, NULL, NULL),
(123, '05890', 2, 'Yolombó', NULL, NULL, NULL),
(124, '05893', 2, 'Yondó', NULL, NULL, NULL),
(125, '05895', 2, 'Zaragoza', NULL, NULL, NULL),
(126, '08001', 4, 'Barranquilla', NULL, NULL, NULL),
(127, '08078', 4, 'Baranoa', NULL, NULL, NULL),
(128, '08137', 4, 'Campo de la cruz', NULL, NULL, NULL),
(129, '08141', 4, 'Candelaria', NULL, NULL, NULL),
(130, '08296', 4, 'Galapa', NULL, NULL, NULL),
(131, '08372', 4, 'Juan de acosta', NULL, NULL, NULL),
(132, '08421', 4, 'Luruaco', NULL, NULL, NULL),
(133, '08433', 4, 'Malambo', NULL, NULL, NULL),
(134, '08436', 4, 'Manatí', NULL, NULL, NULL),
(135, '08520', 4, 'Palmar de varela', NULL, NULL, NULL),
(136, '08549', 4, 'Piojó', NULL, NULL, NULL),
(137, '08558', 4, 'Polonuevo', NULL, NULL, NULL),
(138, '08560', 4, 'Ponedera', NULL, NULL, NULL),
(139, '08573', 4, 'Puerto colombia', NULL, NULL, NULL),
(140, '08606', 4, 'Repelón', NULL, NULL, NULL),
(141, '08634', 4, 'Sabanagrande', NULL, NULL, NULL),
(142, '08638', 4, 'Sabanalarga', NULL, NULL, NULL),
(143, '08675', 4, 'Santa lucía', NULL, NULL, NULL),
(144, '08685', 4, 'Santo tomás', NULL, NULL, NULL),
(145, '08758', 4, 'Soledad', NULL, NULL, NULL),
(146, '08770', 4, 'Suan', NULL, NULL, NULL),
(147, '08832', 4, 'Tubará', NULL, NULL, NULL),
(148, '08849', 4, 'Usiacurí', NULL, NULL, NULL),
(149, '11001', 15, 'Bogotá D.C.', NULL, NULL, NULL),
(150, '13001', 5, 'Cartagena', NULL, NULL, NULL),
(151, '13006', 5, 'Achí', NULL, NULL, NULL),
(152, '13030', 5, 'Altos del rosario', NULL, NULL, NULL),
(153, '13042', 5, 'Arenal', NULL, NULL, NULL),
(154, '13052', 5, 'Arjona', NULL, NULL, NULL),
(155, '13062', 5, 'Arroyohondo', NULL, NULL, NULL),
(156, '13074', 5, 'Barranco de loba', NULL, NULL, NULL),
(157, '13140', 5, 'Calamar', NULL, NULL, NULL),
(158, '13160', 5, 'Cantagallo', NULL, NULL, NULL),
(159, '13188', 5, 'Cicuco', NULL, NULL, NULL),
(160, '13212', 5, 'Córdoba', NULL, NULL, NULL),
(161, '13222', 5, 'Clemencia', NULL, NULL, NULL),
(162, '13244', 5, 'El carmen de bolívar', NULL, NULL, NULL),
(163, '13248', 5, 'El guamo', NULL, NULL, NULL),
(164, '13268', 5, 'El peñón', NULL, NULL, NULL),
(165, '13300', 5, 'Hatillo de loba', NULL, NULL, NULL),
(166, '13430', 5, 'Magangué', NULL, NULL, NULL),
(167, '13433', 5, 'Mahates', NULL, NULL, NULL),
(168, '13440', 5, 'Margarita', NULL, NULL, NULL),
(169, '13442', 5, 'María la baja', NULL, NULL, NULL),
(170, '13458', 5, 'Montecristo', NULL, NULL, NULL),
(171, '13468', 5, 'Mompós', NULL, NULL, NULL),
(172, '13473', 5, 'Morales', NULL, NULL, NULL),
(173, '13490', 5, 'Norosí', NULL, NULL, NULL),
(174, '13549', 5, 'Pinillos', NULL, NULL, NULL),
(175, '13580', 5, 'Regidor', NULL, NULL, NULL),
(176, '13600', 5, 'Río viejo', NULL, NULL, NULL),
(177, '13620', 5, 'San cristóbal', NULL, NULL, NULL),
(178, '13647', 5, 'San estanislao', NULL, NULL, NULL),
(179, '13650', 5, 'San fernando', NULL, NULL, NULL),
(180, '13654', 5, 'San jacinto', NULL, NULL, NULL),
(181, '13655', 5, 'San jacinto del cauca', NULL, NULL, NULL),
(182, '13657', 5, 'San juan nepomuceno', NULL, NULL, NULL),
(183, '13667', 5, 'San martín de loba', NULL, NULL, NULL),
(184, '13670', 5, 'San pablo', NULL, NULL, NULL),
(185, '13673', 5, 'Santa catalina', NULL, NULL, NULL),
(186, '13683', 5, 'Santa rosa', NULL, NULL, NULL),
(187, '13688', 5, 'Santa rosa del sur', NULL, NULL, NULL),
(188, '13744', 5, 'Simití', NULL, NULL, NULL),
(189, '13760', 5, 'Soplaviento', NULL, NULL, NULL),
(190, '13780', 5, 'Talaigua nuevo', NULL, NULL, NULL),
(191, '13810', 5, 'Tiquisio', NULL, NULL, NULL),
(192, '13836', 5, 'Turbaco', NULL, NULL, NULL),
(193, '13838', 5, 'Turbaná', NULL, NULL, NULL),
(194, '13873', 5, 'Villanueva', NULL, NULL, NULL),
(195, '13894', 5, 'Zambrano', NULL, NULL, NULL),
(196, '15001', 6, 'Tunja', NULL, NULL, NULL),
(197, '15022', 6, 'Almeida', NULL, NULL, NULL),
(198, '15047', 6, 'Aquitania', NULL, NULL, NULL),
(199, '15051', 6, 'Arcabuco', NULL, NULL, NULL),
(200, '15087', 6, 'Belén', NULL, NULL, NULL),
(201, '15090', 6, 'Berbeo', NULL, NULL, NULL),
(202, '15092', 6, 'Betéitiva', NULL, NULL, NULL),
(203, '15097', 6, 'Boavita', NULL, NULL, NULL),
(204, '15104', 6, 'Boyacá', NULL, NULL, NULL),
(205, '15106', 6, 'Briceño', NULL, NULL, NULL),
(206, '15109', 6, 'Buenavista', NULL, NULL, NULL),
(207, '15114', 6, 'Busbanzá', NULL, NULL, NULL),
(208, '15131', 6, 'Caldas', NULL, NULL, NULL),
(209, '15135', 6, 'Campohermoso', NULL, NULL, NULL),
(210, '15162', 6, 'Cerinza', NULL, NULL, NULL),
(211, '15172', 6, 'Chinavita', NULL, NULL, NULL),
(212, '15176', 6, 'Chiquinquirá', NULL, NULL, NULL),
(213, '15180', 6, 'Chiscas', NULL, NULL, NULL),
(214, '15183', 6, 'Chita', NULL, NULL, NULL),
(215, '15185', 6, 'Chitaraque', NULL, NULL, NULL),
(216, '15187', 6, 'Chivatá', NULL, NULL, NULL),
(217, '15189', 6, 'Ciénega', NULL, NULL, NULL),
(218, '15204', 6, 'Cómbita', NULL, NULL, NULL),
(219, '15212', 6, 'Coper', NULL, NULL, NULL),
(220, '15215', 6, 'Corrales', NULL, NULL, NULL),
(221, '15218', 6, 'CovarachÍa', NULL, NULL, NULL),
(222, '15223', 6, 'Cubará', NULL, NULL, NULL),
(223, '15224', 6, 'Cucaita', NULL, NULL, NULL),
(224, '15226', 6, 'Cuítiva', NULL, NULL, NULL),
(225, '15232', 6, 'Chíquiza', NULL, NULL, NULL),
(226, '15236', 6, 'Chivor', NULL, NULL, NULL),
(227, '15238', 6, 'Duitama', NULL, NULL, NULL),
(228, '15244', 6, 'El cocuy', NULL, NULL, NULL),
(229, '15248', 6, 'El espino', NULL, NULL, NULL),
(230, '15272', 6, 'Firavitoba', NULL, NULL, NULL),
(231, '15276', 6, 'Floresta', NULL, NULL, NULL),
(232, '15293', 6, 'Gachantivá', NULL, NULL, NULL),
(233, '15296', 6, 'Gameza', NULL, NULL, NULL),
(234, '15299', 6, 'Garagoa', NULL, NULL, NULL),
(235, '15317', 6, 'Guacamayas', NULL, NULL, NULL),
(236, '15322', 6, 'Guateque', NULL, NULL, NULL),
(237, '15325', 6, 'Guayatá', NULL, NULL, NULL),
(238, '15332', 6, 'Güicán', NULL, NULL, NULL),
(239, '15362', 6, 'Iza', NULL, NULL, NULL),
(240, '15367', 6, 'jenesano', NULL, NULL, NULL),
(241, '15368', 6, 'Jericó', NULL, NULL, NULL),
(242, '15377', 6, 'Labranzagrande', NULL, NULL, NULL),
(243, '15380', 6, 'La capilla', NULL, NULL, NULL),
(244, '15401', 6, 'La victoria', NULL, NULL, NULL),
(245, '15403', 6, 'La uvita', NULL, NULL, NULL),
(246, '15407', 6, 'Villa de leyva', NULL, NULL, NULL),
(247, '15425', 6, 'Macanal', NULL, NULL, NULL),
(248, '15442', 6, 'Maripí', NULL, NULL, NULL),
(249, '15455', 6, 'Miraflores', NULL, NULL, NULL),
(250, '15464', 6, 'Mongua', NULL, NULL, NULL),
(251, '15466', 6, 'Monguí', NULL, NULL, NULL),
(252, '15469', 6, 'Moniquirá', NULL, NULL, NULL),
(253, '15476', 6, 'Motavita', NULL, NULL, NULL),
(254, '15480', 6, 'Muzo', NULL, NULL, NULL),
(255, '15491', 6, 'Nobsa', NULL, NULL, NULL),
(256, '15494', 6, 'Nuevo colón', NULL, NULL, NULL),
(257, '15500', 6, 'Oicatá', NULL, NULL, NULL),
(258, '15507', 6, 'Otanche', NULL, NULL, NULL),
(259, '15511', 6, 'Pachavita', NULL, NULL, NULL),
(260, '15514', 6, 'Páez', NULL, NULL, NULL),
(261, '15516', 6, 'Paipa', NULL, NULL, NULL),
(262, '15518', 6, 'Pajarito', NULL, NULL, NULL),
(263, '15522', 6, 'Panqueba', NULL, NULL, NULL),
(264, '15531', 6, 'Pauna', NULL, NULL, NULL),
(265, '15533', 6, 'Paya', NULL, NULL, NULL),
(266, '15537', 6, 'Paz de río', NULL, NULL, NULL),
(267, '15542', 6, 'Pesca', NULL, NULL, NULL),
(268, '15550', 6, 'Pisba', NULL, NULL, NULL),
(269, '15572', 6, 'Puerto boyacá', NULL, NULL, NULL),
(270, '15580', 6, 'Quípama', NULL, NULL, NULL),
(271, '15599', 6, 'Ramiriquí', NULL, NULL, NULL),
(272, '15600', 6, 'Ráquira', NULL, NULL, NULL),
(273, '15621', 6, 'Rondón', NULL, NULL, NULL),
(274, '15632', 6, 'Saboyá', NULL, NULL, NULL),
(275, '15638', 6, 'Sáchica', NULL, NULL, NULL),
(276, '15646', 6, 'Samacá', NULL, NULL, NULL),
(277, '15660', 6, 'San eduardo', NULL, NULL, NULL),
(278, '15664', 6, 'San josé de pare', NULL, NULL, NULL),
(279, '15667', 6, 'San luis de gaceno', NULL, NULL, NULL),
(280, '15673', 6, 'San mateo', NULL, NULL, NULL),
(281, '15676', 6, 'San miguel de sema', NULL, NULL, NULL),
(282, '15681', 6, 'San pablo de borbur', NULL, NULL, NULL),
(283, '15686', 6, 'Santana', NULL, NULL, NULL),
(284, '15690', 6, 'Santa maría', NULL, NULL, NULL),
(285, '15693', 6, 'Santa rosa de viterbo', NULL, NULL, NULL),
(286, '15696', 6, 'Santa sofía', NULL, NULL, NULL),
(287, '15720', 6, 'Sativanorte', NULL, NULL, NULL),
(288, '15723', 6, 'Sativasur', NULL, NULL, NULL),
(289, '15740', 6, 'Siachoque', NULL, NULL, NULL),
(290, '15753', 6, 'Soatá', NULL, NULL, NULL),
(291, '15755', 6, 'Socota', NULL, NULL, NULL),
(292, '15757', 6, 'Socha', NULL, NULL, NULL),
(293, '15759', 6, 'Sogamoso', NULL, NULL, NULL),
(294, '15761', 6, 'Somondoco', NULL, NULL, NULL),
(295, '15762', 6, 'Sora', NULL, NULL, NULL),
(296, '15763', 6, 'Sotaquirá', NULL, NULL, NULL),
(297, '15764', 6, 'Soracá', NULL, NULL, NULL),
(298, '15774', 6, 'Susacón', NULL, NULL, NULL),
(299, '15776', 6, 'Sutamarchán', NULL, NULL, NULL),
(300, '15778', 6, 'Sutatenza', NULL, NULL, NULL),
(301, '15790', 6, 'Tasco', NULL, NULL, NULL),
(302, '15798', 6, 'Tenza', NULL, NULL, NULL),
(303, '15804', 6, 'Tibaná', NULL, NULL, NULL),
(304, '15806', 6, 'Tibasosa', NULL, NULL, NULL),
(305, '15808', 6, 'Tinjacá', NULL, NULL, NULL),
(306, '15810', 6, 'Tipacoque', NULL, NULL, NULL),
(307, '15814', 6, 'Toca', NULL, NULL, NULL),
(308, '15816', 6, 'Togüí', NULL, NULL, NULL),
(309, '15820', 6, 'Tópaga', NULL, NULL, NULL),
(310, '15822', 6, 'Tota', NULL, NULL, NULL),
(311, '15832', 6, 'Tununguá', NULL, NULL, NULL),
(312, '15835', 6, 'Turmequé', NULL, NULL, NULL),
(313, '15837', 6, 'Tuta', NULL, NULL, NULL),
(314, '15839', 6, 'Tutazá', NULL, NULL, NULL),
(315, '15842', 6, 'Umbita', NULL, NULL, NULL),
(316, '15861', 6, 'Ventaquemada', NULL, NULL, NULL),
(317, '15879', 6, 'Viracachá', NULL, NULL, NULL),
(318, '15897', 6, 'Zetaquira', NULL, NULL, NULL),
(319, '17001', 7, 'Manizales', NULL, NULL, NULL),
(320, '17013', 7, 'Aguadas', NULL, NULL, NULL),
(321, '17042', 7, 'Anserma', NULL, NULL, NULL),
(322, '17050', 7, 'Aranzazu', NULL, NULL, NULL),
(323, '17088', 7, 'Belalcázar', NULL, NULL, NULL),
(324, '17174', 7, 'Chinchiná', NULL, NULL, NULL),
(325, '17272', 7, 'Filadelfia', NULL, NULL, NULL),
(326, '17380', 7, 'La dorada', NULL, NULL, NULL),
(327, '17388', 7, 'La merced', NULL, NULL, NULL),
(328, '17433', 7, 'Manzanares', NULL, NULL, NULL),
(329, '17442', 7, 'Marmato', NULL, NULL, NULL),
(330, '17444', 7, 'Marquetalia', NULL, NULL, NULL),
(331, '17446', 7, 'Marulanda', NULL, NULL, NULL),
(332, '17486', 7, 'Neira', NULL, NULL, NULL),
(333, '17495', 7, 'Norcasia', NULL, NULL, NULL),
(334, '17513', 7, 'Pácora', NULL, NULL, NULL),
(335, '17524', 7, 'Palestina', NULL, NULL, NULL),
(336, '17541', 7, 'Pensilvania', NULL, NULL, NULL),
(337, '17614', 7, 'Riosucio', NULL, NULL, NULL),
(338, '17616', 7, 'Risaralda', NULL, NULL, NULL),
(339, '17653', 7, 'Salamina', NULL, NULL, NULL),
(340, '17662', 7, 'Samaná', NULL, NULL, NULL),
(341, '17665', 7, 'San josé', NULL, NULL, NULL),
(342, '17777', 7, 'Supía', NULL, NULL, NULL),
(343, '17867', 7, 'Victoria', NULL, NULL, NULL),
(344, '17873', 7, 'Villamaría', NULL, NULL, NULL),
(345, '17877', 7, 'Viterbo', NULL, NULL, NULL),
(346, '18001', 8, 'Florencia', NULL, NULL, NULL),
(347, '18029', 8, 'Albania', NULL, NULL, NULL),
(348, '18094', 8, 'Belén de los andaquies', NULL, NULL, NULL),
(349, '18150', 8, 'Cartagena del chairá', NULL, NULL, NULL),
(350, '18205', 8, 'Curillo', NULL, NULL, NULL),
(351, '18247', 8, 'El doncello', NULL, NULL, NULL),
(352, '18256', 8, 'El paujil', NULL, NULL, NULL),
(353, '18410', 8, 'La montañita', NULL, NULL, NULL),
(354, '18460', 8, 'Milán', NULL, NULL, NULL),
(355, '18479', 8, 'Morelia', NULL, NULL, NULL),
(356, '18592', 8, 'Puerto rico', NULL, NULL, NULL),
(357, '18610', 8, 'San josé del fragua', NULL, NULL, NULL),
(358, '18753', 8, 'San vicente del caguan', NULL, NULL, NULL),
(359, '18756', 8, 'Solano', NULL, NULL, NULL),
(360, '18785', 8, 'Solita', NULL, NULL, NULL),
(361, '18860', 8, 'Valparaíso', NULL, NULL, NULL),
(362, '19001', 10, 'Popayán', NULL, NULL, NULL),
(363, '19022', 10, 'Almaguer', NULL, NULL, NULL),
(364, '19050', 10, 'Argelia', NULL, NULL, NULL),
(365, '19075', 10, 'Balboa', NULL, NULL, NULL),
(366, '19100', 10, 'BolÍvar', NULL, NULL, NULL),
(367, '19110', 10, 'Buenos aires', NULL, NULL, NULL),
(368, '19130', 10, 'Cajibío', NULL, NULL, NULL),
(369, '19137', 10, 'Caldono', NULL, NULL, NULL),
(370, '19142', 10, 'Caloto', NULL, NULL, NULL),
(371, '19212', 10, 'Corinto', NULL, NULL, NULL),
(372, '19256', 10, 'El tambo', NULL, NULL, NULL),
(373, '19290', 10, 'Florencia', NULL, NULL, NULL),
(374, '19300', 10, 'Guachené', NULL, NULL, NULL),
(375, '19318', 10, 'Guapi', NULL, NULL, NULL),
(376, '19355', 10, 'Inzá', NULL, NULL, NULL),
(377, '19364', 10, 'Jambaló', NULL, NULL, NULL),
(378, '19392', 10, 'La sierra', NULL, NULL, NULL),
(379, '19397', 10, 'La vega', NULL, NULL, NULL),
(380, '19418', 10, 'López', NULL, NULL, NULL),
(381, '19450', 10, 'Mercaderes', NULL, NULL, NULL),
(382, '19455', 10, 'Miranda', NULL, NULL, NULL),
(383, '19473', 10, 'Morales', NULL, NULL, NULL),
(384, '19513', 10, 'Padilla', NULL, NULL, NULL),
(385, '19517', 10, 'Paez', NULL, NULL, NULL),
(386, '19532', 10, 'Patía', NULL, NULL, NULL),
(387, '19533', 10, 'Piamonte', NULL, NULL, NULL),
(388, '19548', 10, 'Piendamó', NULL, NULL, NULL),
(389, '19573', 10, 'Puerto tejada', NULL, NULL, NULL),
(390, '19585', 10, 'Puracé', NULL, NULL, NULL),
(391, '19622', 10, 'Rosas', NULL, NULL, NULL),
(392, '19693', 10, 'San sebastián', NULL, NULL, NULL),
(393, '19698', 10, 'Santander de quilichao', NULL, NULL, NULL),
(394, '19701', 10, 'Santa rosa', NULL, NULL, NULL),
(395, '19743', 10, 'Silvia', NULL, NULL, NULL),
(396, '19760', 10, 'Sotara', NULL, NULL, NULL),
(397, '19780', 10, 'Suárez', NULL, NULL, NULL),
(398, '19785', 10, 'Sucre', NULL, NULL, NULL),
(399, '19807', 10, 'Timbío', NULL, NULL, NULL),
(400, '19809', 10, 'Timbiquí', NULL, NULL, NULL),
(401, '19821', 10, 'Toribio', NULL, NULL, NULL),
(402, '19824', 10, 'Totoró', NULL, NULL, NULL),
(403, '19845', 10, 'Villa rica', NULL, NULL, NULL),
(404, '20001', 11, 'Valledupar', NULL, NULL, NULL),
(405, '20011', 11, 'Aguachica', NULL, NULL, NULL),
(406, '20013', 11, 'Agustín codazzi', NULL, NULL, NULL),
(407, '20032', 11, 'Astrea', NULL, NULL, NULL),
(408, '20045', 11, 'Becerril', NULL, NULL, NULL),
(409, '20060', 11, 'Bosconia', NULL, NULL, NULL),
(410, '20175', 11, 'Chimichagua', NULL, NULL, NULL),
(411, '20178', 11, 'Chiriguaná', NULL, NULL, NULL),
(412, '20228', 11, 'Curumaní', NULL, NULL, NULL),
(413, '20238', 11, 'El copey', NULL, NULL, NULL),
(414, '20250', 11, 'El paso', NULL, NULL, NULL),
(415, '20295', 11, 'Gamarra', NULL, NULL, NULL),
(416, '20310', 11, 'González', NULL, NULL, NULL),
(417, '20383', 11, 'La gloria', NULL, NULL, NULL),
(418, '20400', 11, 'La jagua de ibirico', NULL, NULL, NULL),
(419, '20443', 11, 'Manaure', NULL, NULL, NULL),
(420, '20517', 11, 'Pailitas', NULL, NULL, NULL),
(421, '20550', 11, 'Pelaya', NULL, NULL, NULL),
(422, '20570', 11, 'Pueblo bello', NULL, NULL, NULL),
(423, '20614', 11, 'Río de oro', NULL, NULL, NULL),
(424, '20621', 11, 'La paz', NULL, NULL, NULL),
(425, '20710', 11, 'San alberto', NULL, NULL, NULL),
(426, '20750', 11, 'San diego', NULL, NULL, NULL),
(427, '20770', 11, 'San martín', NULL, NULL, NULL),
(428, '20787', 11, 'Tamalameque', NULL, NULL, NULL),
(429, '23001', 13, 'Montería', NULL, NULL, NULL),
(430, '23068', 13, 'Ayapel', NULL, NULL, NULL),
(431, '23079', 13, 'Buenavista', NULL, NULL, NULL),
(432, '23090', 13, 'Canalete', NULL, NULL, NULL),
(433, '23162', 13, 'Cereté', NULL, NULL, NULL),
(434, '23168', 13, 'Chimá', NULL, NULL, NULL),
(435, '23182', 13, 'Chinú', NULL, NULL, NULL),
(436, '23189', 13, 'Ciénaga de oro', NULL, NULL, NULL),
(437, '23300', 13, 'Cotorra', NULL, NULL, NULL),
(438, '23350', 13, 'La apartada', NULL, NULL, NULL),
(439, '23417', 13, 'Lorica', NULL, NULL, NULL),
(440, '23419', 13, 'Los córdobas', NULL, NULL, NULL),
(441, '23464', 13, 'Momil', NULL, NULL, NULL),
(442, '23466', 13, 'Montelíbano', NULL, NULL, NULL),
(443, '23500', 13, 'Moñitos', NULL, NULL, NULL),
(444, '23555', 13, 'Planeta rica', NULL, NULL, NULL),
(445, '23570', 13, 'Pueblo nuevo', NULL, NULL, NULL),
(446, '23574', 13, 'Puerto escondido', NULL, NULL, NULL),
(447, '23580', 13, 'Puerto libertador', NULL, NULL, NULL),
(448, '23586', 13, 'Purísima', NULL, NULL, NULL),
(449, '23660', 13, 'Sahagún', NULL, NULL, NULL),
(450, '23670', 13, 'San andrés sotavento', NULL, NULL, NULL),
(451, '23672', 13, 'San antero', NULL, NULL, NULL),
(452, '23675', 13, 'San bernardo del viento', NULL, NULL, NULL),
(453, '23678', 13, 'San carlos', NULL, NULL, NULL),
(454, '23682', 13, 'San josé de uré', NULL, NULL, NULL),
(455, '23686', 13, 'San pelayo', NULL, NULL, NULL),
(456, '23807', 13, 'Tierralta', NULL, NULL, NULL),
(457, '23815', 13, 'Tuchín', NULL, NULL, NULL),
(458, '23855', 13, 'Valencia', NULL, NULL, NULL),
(459, '25001', 14, 'Agua de dios', NULL, NULL, NULL),
(460, '25019', 14, 'Albán', NULL, NULL, NULL),
(461, '25035', 14, 'Anapoima', NULL, NULL, NULL),
(462, '25040', 14, 'Anolaima', NULL, NULL, NULL),
(463, '25053', 14, 'Arbeláez', NULL, NULL, NULL),
(464, '25086', 14, 'Beltrán', NULL, NULL, NULL),
(465, '25095', 14, 'Bituima', NULL, NULL, NULL),
(466, '25099', 14, 'Bojacá', NULL, NULL, NULL),
(467, '25120', 14, 'Cabrera', NULL, NULL, NULL),
(468, '25123', 14, 'Cachipay', NULL, NULL, NULL),
(469, '25126', 14, 'Cajicá', NULL, NULL, NULL),
(470, '25148', 14, 'Caparrapí', NULL, NULL, NULL),
(471, '25151', 14, 'Caqueza', NULL, NULL, NULL),
(472, '25154', 14, 'Carmen de carupa', NULL, NULL, NULL),
(473, '25168', 14, 'Chaguaní', NULL, NULL, NULL),
(474, '25175', 14, 'ChÍa', NULL, NULL, NULL),
(475, '25178', 14, 'chipaque', NULL, NULL, NULL),
(476, '25181', 14, 'Choachí', NULL, NULL, NULL),
(477, '25183', 14, 'Chocontá', NULL, NULL, NULL),
(478, '25200', 14, 'Cogua', NULL, NULL, NULL),
(479, '25214', 14, 'Cota', NULL, NULL, NULL),
(480, '25224', 14, 'Cucunubá', NULL, NULL, NULL),
(481, '25245', 14, 'El colegio', NULL, NULL, NULL),
(482, '25258', 14, 'El peñón', NULL, NULL, NULL),
(483, '25260', 14, 'El rosal', NULL, NULL, NULL),
(484, '25269', 14, 'Facatativá', NULL, NULL, NULL),
(485, '25279', 14, 'Fomeque', NULL, NULL, NULL),
(486, '25281', 14, 'Fosca', NULL, NULL, NULL),
(487, '25286', 14, 'Funza', NULL, NULL, NULL),
(488, '25288', 14, 'Fúquene', NULL, NULL, NULL),
(489, '25290', 14, 'Fusagasugá', NULL, NULL, NULL),
(490, '25293', 14, 'Gachala', NULL, NULL, NULL),
(491, '25295', 14, 'Gachancipá', NULL, NULL, NULL),
(492, '25297', 14, 'Gachetá', NULL, NULL, NULL),
(493, '25299', 14, 'Gama', NULL, NULL, NULL),
(494, '25307', 14, 'Girardot', NULL, NULL, NULL),
(495, '25312', 14, 'Granada', NULL, NULL, NULL),
(496, '25317', 14, 'Guachetá', NULL, NULL, NULL),
(497, '25320', 14, 'Guaduas', NULL, NULL, NULL),
(498, '25322', 14, 'Guasca', NULL, NULL, NULL),
(499, '25324', 14, 'Guataquí', NULL, NULL, NULL),
(500, '25326', 14, 'Guatavita', NULL, NULL, NULL),
(501, '25328', 14, 'Guayabal de siquima', NULL, NULL, NULL),
(502, '25335', 14, 'Guayabetal', NULL, NULL, NULL),
(503, '25339', 14, 'Gutiérrez', NULL, NULL, NULL),
(504, '25368', 14, 'Jerusalén', NULL, NULL, NULL),
(505, '25372', 14, 'Junín', NULL, NULL, NULL),
(506, '25377', 14, 'La calera', NULL, NULL, NULL),
(507, '25386', 14, 'La mesa', NULL, NULL, NULL),
(508, '25394', 14, 'La palma', NULL, NULL, NULL),
(509, '25398', 14, 'La peña', NULL, NULL, NULL),
(510, '25402', 14, 'La vega', NULL, NULL, NULL),
(511, '25407', 14, 'Lenguazaque', NULL, NULL, NULL),
(512, '25426', 14, 'Macheta', NULL, NULL, NULL),
(513, '25430', 14, 'Madrid', NULL, NULL, NULL),
(514, '25436', 14, 'Manta', NULL, NULL, NULL),
(515, '25438', 14, 'Medina', NULL, NULL, NULL),
(516, '25473', 14, 'Mosquera', NULL, NULL, NULL),
(517, '25483', 14, 'Nariño', NULL, NULL, NULL),
(518, '25486', 14, 'Nemocón', NULL, NULL, NULL),
(519, '25488', 14, 'Nilo', NULL, NULL, NULL),
(520, '25489', 14, 'Nimaima', NULL, NULL, NULL),
(521, '25491', 14, 'Nocaima', NULL, NULL, NULL),
(522, '25506', 14, 'Venecia', NULL, NULL, NULL),
(523, '25513', 14, 'Pacho', NULL, NULL, NULL),
(524, '25518', 14, 'Paime', NULL, NULL, NULL),
(525, '25524', 14, 'Pandi', NULL, NULL, NULL),
(526, '25530', 14, 'Paratebueno', NULL, NULL, NULL),
(527, '25535', 14, 'Pasca', NULL, NULL, NULL),
(528, '25572', 14, 'Puerto salgar', NULL, NULL, NULL),
(529, '25580', 14, 'Pulí', NULL, NULL, NULL),
(530, '25592', 14, 'Quebradanegra', NULL, NULL, NULL),
(531, '25594', 14, 'Quetame', NULL, NULL, NULL),
(532, '25596', 14, 'Quipile', NULL, NULL, NULL),
(533, '25599', 14, 'Apulo', NULL, NULL, NULL),
(534, '25612', 14, 'Ricaurte', NULL, NULL, NULL),
(535, '25645', 14, 'San antonio del tequendama', NULL, NULL, NULL),
(536, '25649', 14, 'San bernardo', NULL, NULL, NULL),
(537, '25653', 14, 'San cayetano', NULL, NULL, NULL),
(538, '25658', 14, 'San francisco', NULL, NULL, NULL),
(539, '25662', 14, 'San juan de río seco', NULL, NULL, NULL),
(540, '25718', 14, 'Sasaima', NULL, NULL, NULL),
(541, '25736', 14, 'Sesquilé', NULL, NULL, NULL),
(542, '25740', 14, 'Sibaté', NULL, NULL, NULL),
(543, '25743', 14, 'Silvania', NULL, NULL, NULL),
(544, '25745', 14, 'Simijaca', NULL, NULL, NULL),
(545, '25754', 14, 'Soacha', NULL, NULL, NULL),
(546, '25758', 14, 'Sopó', NULL, NULL, NULL),
(547, '25769', 14, 'Subachoque', NULL, NULL, NULL),
(548, '25772', 14, 'Suesca', NULL, NULL, NULL),
(549, '25777', 14, 'Supatá', NULL, NULL, NULL),
(550, '25779', 14, 'Susa', NULL, NULL, NULL),
(551, '25781', 14, 'Sutatausa', NULL, NULL, NULL),
(552, '25785', 14, 'Tabio', NULL, NULL, NULL),
(553, '25793', 14, 'Tausa', NULL, NULL, NULL),
(554, '25797', 14, 'Tena', NULL, NULL, NULL),
(555, '25799', 14, 'Tenjo', NULL, NULL, NULL),
(556, '25805', 14, 'Tibacuy', NULL, NULL, NULL),
(557, '25807', 14, 'Tibirita', NULL, NULL, NULL),
(558, '25815', 14, 'Tocaima', NULL, NULL, NULL),
(559, '25817', 14, 'Tocancipá', NULL, NULL, NULL),
(560, '25823', 14, 'Topaipí', NULL, NULL, NULL),
(561, '25839', 14, 'Ubalá', NULL, NULL, NULL),
(562, '25841', 14, 'Ubaque', NULL, NULL, NULL),
(563, '25843', 14, 'Villa de san diego de ubate', NULL, NULL, NULL),
(564, '25845', 14, 'Une', NULL, NULL, NULL),
(565, '25851', 14, 'Útica', NULL, NULL, NULL),
(566, '25862', 14, 'Vergara', NULL, NULL, NULL),
(567, '25867', 14, 'Vianí', NULL, NULL, NULL),
(568, '25871', 14, 'Villagómez', NULL, NULL, NULL),
(569, '25873', 14, 'Villapinzón', NULL, NULL, NULL),
(570, '25875', 14, 'Villeta', NULL, NULL, NULL),
(571, '25878', 14, 'Viotá', NULL, NULL, NULL),
(572, '25885', 14, 'Yacopí', NULL, NULL, NULL),
(573, '25898', 14, 'Zipacón', NULL, NULL, NULL),
(574, '25899', 14, 'Zipaquirá', NULL, NULL, NULL),
(575, '27001', 12, 'Quibdó', NULL, NULL, NULL),
(576, '27006', 12, 'Acandí', NULL, NULL, NULL),
(577, '27025', 12, 'Alto baudó', NULL, NULL, NULL),
(578, '27050', 12, 'Atrato', NULL, NULL, NULL),
(579, '27073', 12, 'Bagadó', NULL, NULL, NULL),
(580, '27075', 12, 'Bahía solano', NULL, NULL, NULL),
(581, '27077', 12, 'Bajo baudó', NULL, NULL, NULL),
(582, '27099', 12, 'Bojaya', NULL, NULL, NULL),
(583, '27135', 12, 'El cantón del san pablo', NULL, NULL, NULL),
(584, '27150', 12, 'Carmen del darien', NULL, NULL, NULL),
(585, '27160', 12, 'Cértegui', NULL, NULL, NULL),
(586, '27205', 12, 'Condoto', NULL, NULL, NULL),
(587, '27245', 12, 'El carmen de atrato', NULL, NULL, NULL),
(588, '27250', 12, 'El litoral del san juan', NULL, NULL, NULL),
(589, '27361', 12, 'Istmina', NULL, NULL, NULL),
(590, '27372', 12, 'Juradó', NULL, NULL, NULL),
(591, '27413', 12, 'Lloró', NULL, NULL, NULL),
(592, '27425', 12, 'Medio atrato', NULL, NULL, NULL),
(593, '27430', 12, 'Medio baudó', NULL, NULL, NULL),
(594, '27450', 12, 'Medio san juan', NULL, NULL, NULL),
(595, '27491', 12, 'Nóvita', NULL, NULL, NULL),
(596, '27495', 12, 'Nuquí', NULL, NULL, NULL),
(597, '27580', 12, 'Río iró', NULL, NULL, NULL),
(598, '27600', 12, 'Río quito', NULL, NULL, NULL),
(599, '27615', 12, 'Riosucio', NULL, NULL, NULL),
(600, '27660', 12, 'San josé del palmar', NULL, NULL, NULL),
(601, '27745', 12, 'Sipí', NULL, NULL, NULL),
(602, '27787', 12, 'Tadó', NULL, NULL, NULL),
(603, '27800', 12, 'Unguía', NULL, NULL, NULL),
(604, '27810', 12, 'Unión panamericana', NULL, NULL, NULL),
(605, '41001', 18, 'Neiva', NULL, NULL, NULL),
(606, '41006', 18, 'Acevedo', NULL, NULL, NULL),
(607, '41013', 18, 'Agrado', NULL, NULL, NULL),
(608, '41016', 18, 'Aipe', NULL, NULL, NULL),
(609, '41020', 18, 'Algeciras', NULL, NULL, NULL),
(610, '41026', 18, 'Altamira', NULL, NULL, NULL),
(611, '41078', 18, 'Baraya', NULL, NULL, NULL),
(612, '41132', 18, 'Campoalegre', NULL, NULL, NULL),
(613, '41206', 18, 'Colombia', NULL, NULL, NULL),
(614, '41244', 18, 'Elías', NULL, NULL, NULL),
(615, '41298', 18, 'Garzón', NULL, NULL, NULL),
(616, '41306', 18, 'Gigante', NULL, NULL, NULL),
(617, '41319', 18, 'Guadalupe', NULL, NULL, NULL),
(618, '41349', 18, 'Hobo', NULL, NULL, NULL),
(619, '41357', 18, 'Iquira', NULL, NULL, NULL),
(620, '41359', 18, 'Isnos', NULL, NULL, NULL),
(621, '41378', 18, 'La argentina', NULL, NULL, NULL),
(622, '41396', 18, 'La plata', NULL, NULL, NULL),
(623, '41483', 18, 'Nátaga', NULL, NULL, NULL),
(624, '41503', 18, 'Oporapa', NULL, NULL, NULL),
(625, '41518', 18, 'Paicol', NULL, NULL, NULL),
(626, '41524', 18, 'Palermo', NULL, NULL, NULL),
(627, '41530', 18, 'Palestina', NULL, NULL, NULL),
(628, '41548', 18, 'Pital', NULL, NULL, NULL),
(629, '41551', 18, 'Pitalito', NULL, NULL, NULL),
(630, '41615', 18, 'Rivera', NULL, NULL, NULL),
(631, '41660', 18, 'Saladoblanco', NULL, NULL, NULL),
(632, '41668', 18, 'San agustín', NULL, NULL, NULL),
(633, '41676', 18, 'Santa maría', NULL, NULL, NULL),
(634, '41770', 18, 'Suaza', NULL, NULL, NULL),
(635, '41791', 18, 'Tarqui', NULL, NULL, NULL),
(636, '41797', 18, 'Tesalia', NULL, NULL, NULL),
(637, '41799', 18, 'Tello', NULL, NULL, NULL),
(638, '41801', 18, 'Teruel', NULL, NULL, NULL),
(639, '41807', 18, 'Timaná', NULL, NULL, NULL),
(640, '41872', 18, 'Villavieja', NULL, NULL, NULL),
(641, '41885', 18, 'Yaguará', NULL, NULL, NULL),
(642, '44001', 19, 'Riohacha', NULL, NULL, NULL),
(643, '44035', 19, 'Albania', NULL, NULL, NULL),
(644, '44078', 19, 'Barrancas', NULL, NULL, NULL),
(645, '44090', 19, 'Dibulla', NULL, NULL, NULL),
(646, '44098', 19, 'Distracción', NULL, NULL, NULL),
(647, '44110', 19, 'El molino', NULL, NULL, NULL),
(648, '44279', 19, 'Fonseca', NULL, NULL, NULL),
(649, '44378', 19, 'Hatonuevo', NULL, NULL, NULL),
(650, '44420', 19, 'La jagua del pilar', NULL, NULL, NULL),
(651, '44430', 19, 'Maicao', NULL, NULL, NULL),
(652, '44560', 19, 'Manaure', NULL, NULL, NULL),
(653, '44650', 19, 'San juan del cesar', NULL, NULL, NULL),
(654, '44847', 19, 'Uribia', NULL, NULL, NULL),
(655, '44855', 19, 'Urumita', NULL, NULL, NULL),
(656, '44874', 19, 'Villanueva', NULL, NULL, NULL),
(657, '47001', 20, 'Santa marta', NULL, NULL, NULL),
(658, '47030', 20, 'Algarrobo', NULL, NULL, NULL),
(659, '47053', 20, 'Aracataca', NULL, NULL, NULL),
(660, '47058', 20, 'Ariguaní', NULL, NULL, NULL),
(661, '47161', 20, 'Cerro san antonio', NULL, NULL, NULL),
(662, '47170', 20, 'Chibolo', NULL, NULL, NULL),
(663, '47189', 20, 'Ciénaga', NULL, NULL, NULL),
(664, '47205', 20, 'Concordia', NULL, NULL, NULL),
(665, '47245', 20, 'El banco', NULL, NULL, NULL),
(666, '47258', 20, 'El piñon', NULL, NULL, NULL),
(667, '47268', 20, 'El retén', NULL, NULL, NULL),
(668, '47288', 20, 'Fundación', NULL, NULL, NULL),
(669, '47318', 20, 'Guamal', NULL, NULL, NULL),
(670, '47460', 20, 'Nueva granada', NULL, NULL, NULL),
(671, '47541', 20, 'Pedraza', NULL, NULL, NULL),
(672, '47545', 20, 'Pijiño del carmen', NULL, NULL, NULL),
(673, '47551', 20, 'Pivijay', NULL, NULL, NULL),
(674, '47555', 20, 'Plato', NULL, NULL, NULL),
(675, '47570', 20, 'Puebloviejo', NULL, NULL, NULL),
(676, '47605', 20, 'Remolino', NULL, NULL, NULL),
(677, '47660', 20, 'Sabanas de san angel', NULL, NULL, NULL),
(678, '47675', 20, 'Salamina', NULL, NULL, NULL),
(679, '47692', 20, 'San sebastián de buenavista', NULL, NULL, NULL),
(680, '47703', 20, 'San zenón', NULL, NULL, NULL),
(681, '47707', 20, 'Santa ana', NULL, NULL, NULL),
(682, '47720', 20, 'Santa bárbara de pinto', NULL, NULL, NULL),
(683, '47745', 20, 'Sitionuevo', NULL, NULL, NULL),
(684, '47798', 20, 'Tenerife', NULL, NULL, NULL),
(685, '47960', 20, 'Zapayán', NULL, NULL, NULL),
(686, '47980', 20, 'Zona bananera', NULL, NULL, NULL),
(687, '50001', 21, 'Villavicencio', NULL, NULL, NULL),
(688, '50006', 21, 'Acacías', NULL, NULL, NULL),
(689, '50110', 21, 'Barranca de upía', NULL, NULL, NULL),
(690, '50124', 21, 'Cabuyaro', NULL, NULL, NULL),
(691, '50150', 21, 'Castilla la nueva', NULL, NULL, NULL),
(692, '50223', 21, 'Cubarral', NULL, NULL, NULL),
(693, '50226', 21, 'Cumaral', NULL, NULL, NULL),
(694, '50245', 21, 'El calvario', NULL, NULL, NULL),
(695, '50251', 21, 'El castillo', NULL, NULL, NULL),
(696, '50270', 21, 'El dorado', NULL, NULL, NULL),
(697, '50287', 21, 'Fuente de oro', NULL, NULL, NULL),
(698, '50313', 21, 'Granada', NULL, NULL, NULL),
(699, '50318', 21, 'Guamal', NULL, NULL, NULL),
(700, '50325', 21, 'Mapiripán', NULL, NULL, NULL),
(701, '50330', 21, 'Mesetas', NULL, NULL, NULL),
(702, '50350', 21, 'La macarena', NULL, NULL, NULL),
(703, '50370', 21, 'Uribe', NULL, NULL, NULL),
(704, '50400', 21, 'Lejanías', NULL, NULL, NULL),
(705, '50450', 21, 'Puerto concordia', NULL, NULL, NULL),
(706, '50568', 21, 'Puerto gaitán', NULL, NULL, NULL),
(707, '50573', 21, 'Puerto lópez', NULL, NULL, NULL),
(708, '50577', 21, 'Puerto lleras', NULL, NULL, NULL),
(709, '50590', 21, 'Puerto rico', NULL, NULL, NULL),
(710, '50606', 21, 'Restrepo', NULL, NULL, NULL),
(711, '50680', 21, 'San carlos de guaroa', NULL, NULL, NULL),
(712, '50683', 21, 'San juan de arama', NULL, NULL, NULL),
(713, '50686', 21, 'San juanito', NULL, NULL, NULL),
(714, '50689', 21, 'San martín', NULL, NULL, NULL),
(715, '50711', 21, 'Vistahermosa', NULL, NULL, NULL),
(716, '52001', 22, 'Pasto', NULL, NULL, NULL),
(717, '52019', 22, 'Albán', NULL, NULL, NULL),
(718, '52022', 22, 'Aldana', NULL, NULL, NULL),
(719, '52036', 22, 'Ancuyá', NULL, NULL, NULL),
(720, '52051', 22, 'Arboleda', NULL, NULL, NULL),
(721, '52079', 22, 'Barbacoas', NULL, NULL, NULL),
(722, '52083', 22, 'Belén', NULL, NULL, NULL),
(723, '52110', 22, 'Buesaco', NULL, NULL, NULL),
(724, '52203', 22, 'Colón', NULL, NULL, NULL),
(725, '52207', 22, 'Consaca', NULL, NULL, NULL),
(726, '52210', 22, 'Contadero', NULL, NULL, NULL),
(727, '52215', 22, 'Córdoba', NULL, NULL, NULL),
(728, '52224', 22, 'Cuaspud', NULL, NULL, NULL),
(729, '52227', 22, 'Cumbal', NULL, NULL, NULL),
(730, '52233', 22, 'Cumbitara', NULL, NULL, NULL),
(731, '52240', 22, 'Chachagüí', NULL, NULL, NULL),
(732, '52250', 22, 'El charco', NULL, NULL, NULL),
(733, '52254', 22, 'El peñol', NULL, NULL, NULL),
(734, '52256', 22, 'El rosario', NULL, NULL, NULL),
(735, '52258', 22, 'El tablón de gómez', NULL, NULL, NULL),
(736, '52260', 22, 'El tambo', NULL, NULL, NULL),
(737, '52287', 22, 'Funes', NULL, NULL, NULL),
(738, '52317', 22, 'Guachucal', NULL, NULL, NULL),
(739, '52320', 22, 'Guaitarilla', NULL, NULL, NULL),
(740, '52323', 22, 'Gualmatán', NULL, NULL, NULL),
(741, '52352', 22, 'Iles', NULL, NULL, NULL),
(742, '52354', 22, 'Imués', NULL, NULL, NULL),
(743, '52356', 22, 'Ipiales', NULL, NULL, NULL),
(744, '52378', 22, 'La cruz', NULL, NULL, NULL),
(745, '52381', 22, 'La florida', NULL, NULL, NULL),
(746, '52385', 22, 'La llanada', NULL, NULL, NULL),
(747, '52390', 22, 'La tola', NULL, NULL, NULL),
(748, '52399', 22, 'La unión', NULL, NULL, NULL),
(749, '52405', 22, 'Leiva', NULL, NULL, NULL),
(750, '52411', 22, 'Linares', NULL, NULL, NULL),
(751, '52418', 22, 'Los andes', NULL, NULL, NULL),
(752, '52427', 22, 'Magüí', NULL, NULL, NULL),
(753, '52435', 22, 'Mallama', NULL, NULL, NULL),
(754, '52473', 22, 'Mosquera', NULL, NULL, NULL),
(755, '52480', 22, 'Nariño', NULL, NULL, NULL),
(756, '52490', 22, 'Olaya herrera', NULL, NULL, NULL),
(757, '52506', 22, 'Ospina', NULL, NULL, NULL),
(758, '52520', 22, 'Francisco pizarro', NULL, NULL, NULL),
(759, '52540', 22, 'Policarpa', NULL, NULL, NULL),
(760, '52560', 22, 'Potosí', NULL, NULL, NULL),
(761, '52565', 22, 'Providencia', NULL, NULL, NULL),
(762, '52573', 22, 'Puerres', NULL, NULL, NULL),
(763, '52585', 22, 'Pupiales', NULL, NULL, NULL),
(764, '52612', 22, 'Ricaurte', NULL, NULL, NULL),
(765, '52621', 22, 'Roberto payán', NULL, NULL, NULL),
(766, '52678', 22, 'Samaniego', NULL, NULL, NULL),
(767, '52683', 22, 'Sandoná', NULL, NULL, NULL),
(768, '52685', 22, 'San bernardo', NULL, NULL, NULL),
(769, '52687', 22, 'San lorenzo', NULL, NULL, NULL),
(770, '52693', 22, 'San pablo', NULL, NULL, NULL),
(771, '52694', 22, 'San pedro de cartago', NULL, NULL, NULL),
(772, '52696', 22, 'Santa bárbara', NULL, NULL, NULL),
(773, '52699', 22, 'Santacruz', NULL, NULL, NULL),
(774, '52720', 22, 'Sapuyes', NULL, NULL, NULL),
(775, '52786', 22, 'Taminango', NULL, NULL, NULL),
(776, '52788', 22, 'Tangua', NULL, NULL, NULL),
(777, '52835', 22, 'San andres de tumaco', NULL, NULL, NULL),
(778, '52838', 22, 'Túquerres', NULL, NULL, NULL),
(779, '52885', 22, 'Yacuanquer', NULL, NULL, NULL),
(780, '54001', 23, 'Cúcuta', NULL, NULL, NULL),
(781, '54003', 23, 'Abrego', NULL, NULL, NULL),
(782, '54051', 23, 'Arboledas', NULL, NULL, NULL),
(783, '54099', 23, 'Bochalema', NULL, NULL, NULL),
(784, '54109', 23, 'Bucarasica', NULL, NULL, NULL),
(785, '54125', 23, 'Cácota', NULL, NULL, NULL),
(786, '54128', 23, 'Cachirá', NULL, NULL, NULL),
(787, '54172', 23, 'Chinácota', NULL, NULL, NULL),
(788, '54174', 23, 'Chitagá', NULL, NULL, NULL),
(789, '54206', 23, 'Convención', NULL, NULL, NULL),
(790, '54223', 23, 'Cucutilla', NULL, NULL, NULL),
(791, '54239', 23, 'Durania', NULL, NULL, NULL),
(792, '54245', 23, 'El carmen', NULL, NULL, NULL),
(793, '54250', 23, 'El tarra', NULL, NULL, NULL),
(794, '54261', 23, 'El zulia', NULL, NULL, NULL),
(795, '54313', 23, 'Gramalote', NULL, NULL, NULL),
(796, '54344', 23, 'Hacarí', NULL, NULL, NULL),
(797, '54347', 23, 'Herrán', NULL, NULL, NULL),
(798, '54377', 23, 'Labateca', NULL, NULL, NULL),
(799, '54385', 23, 'La esperanza', NULL, NULL, NULL),
(800, '54398', 23, 'La playa', NULL, NULL, NULL),
(801, '54405', 23, 'Los patios', NULL, NULL, NULL),
(802, '54418', 23, 'Lourdes', NULL, NULL, NULL),
(803, '54480', 23, 'Mutiscua', NULL, NULL, NULL),
(804, '54498', 23, 'Ocaña', NULL, NULL, NULL),
(805, '54518', 23, 'Pamplona', NULL, NULL, NULL),
(806, '54520', 23, 'Pamplonita', NULL, NULL, NULL),
(807, '54553', 23, 'Puerto santander', NULL, NULL, NULL),
(808, '54599', 23, 'Ragonvalia', NULL, NULL, NULL),
(809, '54660', 23, 'Salazar', NULL, NULL, NULL),
(810, '54670', 23, 'San calixto', NULL, NULL, NULL),
(811, '54673', 23, 'San cayetano', NULL, NULL, NULL),
(812, '54680', 23, 'Santiago', NULL, NULL, NULL),
(813, '54720', 23, 'Sardinata', NULL, NULL, NULL),
(814, '54743', 23, 'Silos', NULL, NULL, NULL),
(815, '54800', 23, 'Teorama', NULL, NULL, NULL),
(816, '54810', 23, 'Tibú', NULL, NULL, NULL),
(817, '54820', 23, 'Toledo', NULL, NULL, NULL),
(818, '54871', 23, 'Villa caro', NULL, NULL, NULL),
(819, '54874', 23, 'Villa del rosario', NULL, NULL, NULL),
(820, '63001', 25, 'Armenia', NULL, NULL, NULL),
(821, '63111', 25, 'Buenavista', NULL, NULL, NULL),
(822, '63130', 25, 'Calarca', NULL, NULL, NULL),
(823, '63190', 25, 'Circasia', NULL, NULL, NULL),
(824, '63212', 25, 'Córdoba', NULL, NULL, NULL),
(825, '63272', 25, 'Filandia', NULL, NULL, NULL),
(826, '63302', 25, 'Génova', NULL, NULL, NULL),
(827, '63401', 25, 'La tebaida', NULL, NULL, NULL),
(828, '63470', 25, 'Montenegro', NULL, NULL, NULL),
(829, '63548', 25, 'Pijao', NULL, NULL, NULL),
(830, '63594', 25, 'Quimbaya', NULL, NULL, NULL),
(831, '63690', 25, 'Salento', NULL, NULL, NULL),
(832, '66001', 26, 'Pereira', NULL, NULL, NULL),
(833, '66045', 26, 'Apía', NULL, NULL, NULL),
(834, '66075', 26, 'Balboa', NULL, NULL, NULL),
(835, '66088', 26, 'Belén de umbría', NULL, NULL, NULL),
(836, '66170', 26, 'Dosquebradas', NULL, NULL, NULL),
(837, '66318', 26, 'Guática', NULL, NULL, NULL),
(838, '66383', 26, 'La celia', NULL, NULL, NULL),
(839, '66400', 26, 'La virginia', NULL, NULL, NULL),
(840, '66440', 26, 'Marsella', NULL, NULL, NULL),
(841, '66456', 26, 'Mistrató', NULL, NULL, NULL),
(842, '66572', 26, 'Pueblo rico', NULL, NULL, NULL),
(843, '66594', 26, 'Quinchía', NULL, NULL, NULL),
(844, '66682', 26, 'Santa rosa de cabal', NULL, NULL, NULL),
(845, '66687', 26, 'Santuario', NULL, NULL, NULL),
(846, '68001', 28, 'Bucaramanga', NULL, NULL, NULL),
(847, '68013', 28, 'Aguada', NULL, NULL, NULL),
(848, '68020', 28, 'Albania', NULL, NULL, NULL),
(849, '68051', 28, 'Aratoca', NULL, NULL, NULL),
(850, '68077', 28, 'Barbosa', NULL, NULL, NULL),
(851, '68079', 28, 'Barichara', NULL, NULL, NULL),
(852, '68081', 28, 'Barrancabermeja', NULL, NULL, NULL),
(853, '68092', 28, 'Betulia', NULL, NULL, NULL),
(854, '68101', 28, 'Bolívar', NULL, NULL, NULL),
(855, '68121', 28, 'Cabrera', NULL, NULL, NULL),
(856, '68132', 28, 'California', NULL, NULL, NULL),
(857, '68147', 28, 'Capitanejo', NULL, NULL, NULL),
(858, '68152', 28, 'Carcasí', NULL, NULL, NULL),
(859, '68160', 28, 'Cepitá', NULL, NULL, NULL),
(860, '68162', 28, 'Cerrito', NULL, NULL, NULL),
(861, '68167', 28, 'Charalá', NULL, NULL, NULL),
(862, '68169', 28, 'Charta', NULL, NULL, NULL),
(863, '68176', 28, 'Chima', NULL, NULL, NULL),
(864, '68179', 28, 'Chipatá', NULL, NULL, NULL),
(865, '68190', 28, 'Cimitarra', NULL, NULL, NULL),
(866, '68207', 28, 'Concepción', NULL, NULL, NULL),
(867, '68209', 28, 'Confines', NULL, NULL, NULL),
(868, '68211', 28, 'Contratación', NULL, NULL, NULL),
(869, '68217', 28, 'Coromoro', NULL, NULL, NULL),
(870, '68229', 28, 'Curití', NULL, NULL, NULL),
(871, '68235', 28, 'El carmen de chucurí', NULL, NULL, NULL),
(872, '68245', 28, 'El guacamayo', NULL, NULL, NULL),
(873, '68250', 28, 'El peñón', NULL, NULL, NULL),
(874, '68255', 28, 'El playón', NULL, NULL, NULL),
(875, '68264', 28, 'Encino', NULL, NULL, NULL),
(876, '68266', 28, 'Enciso', NULL, NULL, NULL),
(877, '68271', 28, 'Florián', NULL, NULL, NULL),
(878, '68276', 28, 'Floridablanca', NULL, NULL, NULL),
(879, '68296', 28, 'Galán', NULL, NULL, NULL),
(880, '68298', 28, 'Gambita', NULL, NULL, NULL),
(881, '68307', 28, 'Girón', NULL, NULL, NULL),
(882, '68318', 28, 'Guaca', NULL, NULL, NULL),
(883, '68320', 28, 'Guadalupe', NULL, NULL, NULL),
(884, '68322', 28, 'Guapotá', NULL, NULL, NULL),
(885, '68324', 28, 'Guavatá', NULL, NULL, NULL),
(886, '68327', 28, 'Güepsa', NULL, NULL, NULL),
(887, '68344', 28, 'Hato', NULL, NULL, NULL),
(888, '68368', 28, 'Jesús maría', NULL, NULL, NULL),
(889, '68370', 28, 'Jordán', NULL, NULL, NULL),
(890, '68377', 28, 'La belleza', NULL, NULL, NULL),
(891, '68385', 28, 'Landázuri', NULL, NULL, NULL),
(892, '68397', 28, 'La paz', NULL, NULL, NULL),
(893, '68406', 28, 'Lebrija', NULL, NULL, NULL),
(894, '68418', 28, 'Los santos', NULL, NULL, NULL),
(895, '68425', 28, 'Macaravita', NULL, NULL, NULL),
(896, '68432', 28, 'Málaga', NULL, NULL, NULL),
(897, '68444', 28, 'Matanza', NULL, NULL, NULL),
(898, '68464', 28, 'Mogotes', NULL, NULL, NULL),
(899, '68468', 28, 'Molagavita', NULL, NULL, NULL),
(900, '68498', 28, 'Ocamonte', NULL, NULL, NULL),
(901, '68500', 28, 'Oiba', NULL, NULL, NULL),
(902, '68502', 28, 'Onzaga', NULL, NULL, NULL),
(903, '68522', 28, 'Palmar', NULL, NULL, NULL),
(904, '68524', 28, 'Palmas del socorro', NULL, NULL, NULL),
(905, '68533', 28, 'Páramo', NULL, NULL, NULL),
(906, '68547', 28, 'Piedecuesta', NULL, NULL, NULL),
(907, '68549', 28, 'Pinchote', NULL, NULL, NULL),
(908, '68572', 28, 'Puente nacional', NULL, NULL, NULL),
(909, '68573', 28, 'Puerto parra', NULL, NULL, NULL),
(910, '68575', 28, 'Puerto wilches', NULL, NULL, NULL),
(911, '68615', 28, 'Rionegro', NULL, NULL, NULL),
(912, '68655', 28, 'Sabana de torres', NULL, NULL, NULL),
(913, '68669', 28, 'San andrés', NULL, NULL, NULL),
(914, '68673', 28, 'San benito', NULL, NULL, NULL),
(915, '68679', 28, 'San gil', NULL, NULL, NULL),
(916, '68682', 28, 'San joaquín', NULL, NULL, NULL),
(917, '68684', 28, 'San josé de miranda', NULL, NULL, NULL),
(918, '68686', 28, 'San miguel', NULL, NULL, NULL),
(919, '68689', 28, 'San vicente de chucuri', NULL, NULL, NULL),
(920, '68705', 28, 'Santa bárbara', NULL, NULL, NULL),
(921, '68720', 28, 'Santa helena del opon', NULL, NULL, NULL),
(922, '68745', 28, 'Simacota', NULL, NULL, NULL),
(923, '68755', 28, 'Socorro', NULL, NULL, NULL),
(924, '68770', 28, 'Suaita', NULL, NULL, NULL),
(925, '68773', 28, 'Sucre', NULL, NULL, NULL),
(926, '68780', 28, 'Suratá', NULL, NULL, NULL),
(927, '68820', 28, 'Tona', NULL, NULL, NULL),
(928, '68855', 28, 'Valle de san josé', NULL, NULL, NULL),
(929, '68861', 28, 'Vélez', NULL, NULL, NULL),
(930, '68867', 28, 'Vetas', NULL, NULL, NULL),
(931, '68872', 28, 'Villanueva', NULL, NULL, NULL),
(932, '68895', 28, 'Zapatoca', NULL, NULL, NULL),
(933, '70001', 29, 'Sincelejo', NULL, NULL, NULL),
(934, '70110', 29, 'Buenavista', NULL, NULL, NULL),
(935, '70124', 29, 'Caimito', NULL, NULL, NULL),
(936, '70204', 29, 'Coloso', NULL, NULL, NULL),
(937, '70215', 29, 'Corozal', NULL, NULL, NULL),
(938, '70221', 29, 'Coveñas', NULL, NULL, NULL),
(939, '70230', 29, 'Chalán', NULL, NULL, NULL),
(940, '70233', 29, 'El roble', NULL, NULL, NULL),
(941, '70235', 29, 'Galeras', NULL, NULL, NULL),
(942, '70265', 29, 'Guaranda', NULL, NULL, NULL),
(943, '70400', 29, 'La unión', NULL, NULL, NULL),
(944, '70418', 29, 'Los palmitos', NULL, NULL, NULL),
(945, '70429', 29, 'Majagual', NULL, NULL, NULL),
(946, '70473', 29, 'Morroa', NULL, NULL, NULL),
(947, '70508', 29, 'Ovejas', NULL, NULL, NULL),
(948, '70523', 29, 'Palmito', NULL, NULL, NULL),
(949, '70670', 29, 'Sampúes', NULL, NULL, NULL),
(950, '70678', 29, 'San benito abad', NULL, NULL, NULL),
(951, '70702', 29, 'San juan de betulia', NULL, NULL, NULL),
(952, '70708', 29, 'San marcos', NULL, NULL, NULL),
(953, '70713', 29, 'San onofre', NULL, NULL, NULL),
(954, '70717', 29, 'San pedro', NULL, NULL, NULL),
(955, '70742', 29, 'San luis de sincé', NULL, NULL, NULL),
(956, '70771', 29, 'Sucre', NULL, NULL, NULL),
(957, '70820', 29, 'Santiago de tolú', NULL, NULL, NULL),
(958, '70823', 29, 'Tolú viejo', NULL, NULL, NULL),
(959, '73001', 30, 'Ibagué', NULL, NULL, NULL),
(960, '73024', 30, 'Alpujarra', NULL, NULL, NULL),
(961, '73026', 30, 'Alvarado', NULL, NULL, NULL),
(962, '73030', 30, 'Ambalema', NULL, NULL, NULL),
(963, '73043', 30, 'Anzoátegui', NULL, NULL, NULL),
(964, '73055', 30, 'Armero', NULL, NULL, NULL),
(965, '73067', 30, 'Ataco', NULL, NULL, NULL),
(966, '73124', 30, 'Cajamarca', NULL, NULL, NULL),
(967, '73148', 30, 'Carmen de apicalá', NULL, NULL, NULL),
(968, '73152', 30, 'Casabianca', NULL, NULL, NULL),
(969, '73168', 30, 'Chaparral', NULL, NULL, NULL),
(970, '73200', 30, 'Coello', NULL, NULL, NULL),
(971, '73217', 30, 'Coyaima', NULL, NULL, NULL),
(972, '73226', 30, 'Cunday', NULL, NULL, NULL),
(973, '73236', 30, 'Dolores', NULL, NULL, NULL),
(974, '73268', 30, 'Espinal', NULL, NULL, NULL),
(975, '73270', 30, 'Falan', NULL, NULL, NULL),
(976, '73275', 30, 'Flandes', NULL, NULL, NULL),
(977, '73283', 30, 'Fresno', NULL, NULL, NULL),
(978, '73319', 30, 'Guamo', NULL, NULL, NULL),
(979, '73347', 30, 'Herveo', NULL, NULL, NULL),
(980, '73349', 30, 'Honda', NULL, NULL, NULL),
(981, '73352', 30, 'Icononzo', NULL, NULL, NULL),
(982, '73408', 30, 'Lérida', NULL, NULL, NULL),
(983, '73411', 30, 'Líbano', NULL, NULL, NULL),
(984, '73443', 30, 'San sebastián de mariquita', NULL, NULL, NULL),
(985, '73449', 30, 'Melgar', NULL, NULL, NULL),
(986, '73461', 30, 'Murillo', NULL, NULL, NULL),
(987, '73483', 30, 'Natagaima', NULL, NULL, NULL),
(988, '73504', 30, 'Ortega', NULL, NULL, NULL),
(989, '73520', 30, 'Palocabildo', NULL, NULL, NULL),
(990, '73547', 30, 'Piedras', NULL, NULL, NULL),
(991, '73555', 30, 'Planadas', NULL, NULL, NULL),
(992, '73563', 30, 'Prado', NULL, NULL, NULL),
(993, '73585', 30, 'Purificación', NULL, NULL, NULL),
(994, '73616', 30, 'Rioblanco', NULL, NULL, NULL),
(995, '73622', 30, 'Roncesvalles', NULL, NULL, NULL),
(996, '73624', 30, 'Rovira', NULL, NULL, NULL),
(997, '73671', 30, 'Saldaña', NULL, NULL, NULL),
(998, '73675', 30, 'San antonio', NULL, NULL, NULL),
(999, '73678', 30, 'San luis', NULL, NULL, NULL),
(1000, '73686', 30, 'Santa isabel', NULL, NULL, NULL),
(1001, '73770', 30, 'Suárez', NULL, NULL, NULL),
(1002, '73854', 30, 'Valle de san juan', NULL, NULL, NULL),
(1003, '73861', 30, 'Venadillo', NULL, NULL, NULL),
(1004, '73870', 30, 'Villahermosa', NULL, NULL, NULL),
(1005, '73873', 30, 'Villarrica', NULL, NULL, NULL),
(1006, '76001', 31, 'Cali', NULL, NULL, NULL),
(1007, '76020', 31, 'Alcalá', NULL, NULL, NULL),
(1008, '76036', 31, 'Andalucía', NULL, NULL, NULL),
(1009, '76041', 31, 'Ansermanuevo', NULL, NULL, NULL),
(1010, '76054', 31, 'Argelia', NULL, NULL, NULL),
(1011, '76100', 31, 'Bolívar', NULL, NULL, NULL),
(1012, '76109', 31, 'Buenaventura', NULL, NULL, NULL),
(1013, '76111', 31, 'Guadalajara de buga', NULL, NULL, NULL),
(1014, '76113', 31, 'Bugalagrande', NULL, NULL, NULL),
(1015, '76122', 31, 'Caicedonia', NULL, NULL, NULL),
(1016, '76126', 31, 'Calima', NULL, NULL, NULL),
(1017, '76130', 31, 'Candelaria', NULL, NULL, NULL),
(1018, '76147', 31, 'Cartago', NULL, NULL, NULL),
(1019, '76233', 31, 'Dagua', NULL, NULL, NULL),
(1020, '76243', 31, 'El águila', NULL, NULL, NULL),
(1021, '76246', 31, 'El cairo', NULL, NULL, NULL),
(1022, '76248', 31, 'El cerrito', NULL, NULL, NULL),
(1023, '76250', 31, 'El dovio', NULL, NULL, NULL);
INSERT INTO `county` (`id`, `iso_county_code`, `department_id`, `county_name`, `species_count`, `occurrence_count`, `occurrence_coordinate_count`) VALUES
(1024, '76275', 31, 'Florida', NULL, NULL, NULL),
(1025, '76306', 31, 'Ginebra', NULL, NULL, NULL),
(1026, '76318', 31, 'Guacarí', NULL, NULL, NULL),
(1027, '76364', 31, 'Jamundí', NULL, NULL, NULL),
(1028, '76377', 31, 'La cumbre', NULL, NULL, NULL),
(1029, '76400', 31, 'La unión', NULL, NULL, NULL),
(1030, '76403', 31, 'La victoria', NULL, NULL, NULL),
(1031, '76497', 31, 'Obando', NULL, NULL, NULL),
(1032, '76520', 31, 'Palmira', NULL, NULL, NULL),
(1033, '76563', 31, 'Pradera', NULL, NULL, NULL),
(1034, '76606', 31, 'Restrepo', NULL, NULL, NULL),
(1035, '76616', 31, 'Riofrío', NULL, NULL, NULL),
(1036, '76622', 31, 'Roldanillo', NULL, NULL, NULL),
(1037, '76670', 31, 'San pedro', NULL, NULL, NULL),
(1038, '76736', 31, 'Sevilla', NULL, NULL, NULL),
(1039, '76823', 31, 'Toro', NULL, NULL, NULL),
(1040, '76828', 31, 'Trujillo', NULL, NULL, NULL),
(1041, '76834', 31, 'Tuluá', NULL, NULL, NULL),
(1042, '76845', 31, 'Ulloa', NULL, NULL, NULL),
(1043, '76863', 31, 'Versalles', NULL, NULL, NULL),
(1044, '76869', 31, 'Vijes', NULL, NULL, NULL),
(1045, '76890', 31, 'Yotoco', NULL, NULL, NULL),
(1046, '76892', 31, 'Yumbo', NULL, NULL, NULL),
(1047, '76895', 31, 'Zarzal', NULL, NULL, NULL),
(1048, '81001', 3, 'Arauca', NULL, NULL, NULL),
(1049, '81065', 3, 'Arauquita', NULL, NULL, NULL),
(1050, '81220', 3, 'Cravo norte', NULL, NULL, NULL),
(1051, '81300', 3, 'Fortul', NULL, NULL, NULL),
(1052, '81591', 3, 'Puerto rondón', NULL, NULL, NULL),
(1053, '81736', 3, 'Saravena', NULL, NULL, NULL),
(1054, '81794', 3, 'Tame', NULL, NULL, NULL),
(1055, '85001', 9, 'Yopal', NULL, NULL, NULL),
(1056, '85010', 9, 'Aguazul', NULL, NULL, NULL),
(1057, '85015', 9, 'Chameza', NULL, NULL, NULL),
(1058, '85125', 9, 'Hato corozal', NULL, NULL, NULL),
(1059, '85136', 9, 'La salina', NULL, NULL, NULL),
(1060, '85139', 9, 'Maní', NULL, NULL, NULL),
(1061, '85162', 9, 'Monterrey', NULL, NULL, NULL),
(1062, '85225', 9, 'Nunchía', NULL, NULL, NULL),
(1063, '85230', 9, 'Orocué', NULL, NULL, NULL),
(1064, '85250', 9, 'Paz de ariporo', NULL, NULL, NULL),
(1065, '85263', 9, 'Pore', NULL, NULL, NULL),
(1066, '85279', 9, 'Recetor', NULL, NULL, NULL),
(1067, '85300', 9, 'Sabanalarga', NULL, NULL, NULL),
(1068, '85315', 9, 'Sácama', NULL, NULL, NULL),
(1069, '85325', 9, 'San luis de palenque', NULL, NULL, NULL),
(1070, '85400', 9, 'Támara', NULL, NULL, NULL),
(1071, '85410', 9, 'Tauramena', NULL, NULL, NULL),
(1072, '85430', 9, 'Trinidad', NULL, NULL, NULL),
(1073, '85440', 9, 'Villanueva', NULL, NULL, NULL),
(1074, '86001', 24, 'Mocoa', NULL, NULL, NULL),
(1075, '86219', 24, 'Colón', NULL, NULL, NULL),
(1076, '86320', 24, 'Orito', NULL, NULL, NULL),
(1077, '86568', 24, 'Puerto asís', NULL, NULL, NULL),
(1078, '86569', 24, 'Puerto caicedo', NULL, NULL, NULL),
(1079, '86571', 24, 'Puerto guzmán', NULL, NULL, NULL),
(1080, '86573', 24, 'Puerto leguízamo', NULL, NULL, NULL),
(1081, '86749', 24, 'Sibundoy', NULL, NULL, NULL),
(1082, '86755', 24, 'San francisco', NULL, NULL, NULL),
(1083, '86757', 24, 'San miguel', NULL, NULL, NULL),
(1084, '86760', 24, 'Santiago', NULL, NULL, NULL),
(1085, '86865', 24, 'Valle del guamuez', NULL, NULL, NULL),
(1086, '86885', 24, 'Villagarzón', NULL, NULL, NULL),
(1087, '88001', 27, 'San andrés', NULL, NULL, NULL),
(1088, '88564', 27, 'Providencia', NULL, NULL, NULL),
(1089, '91001', 1, 'Leticia', NULL, NULL, NULL),
(1090, '91263', 1, 'El encanto', NULL, NULL, NULL),
(1091, '91405', 1, 'La chorrera', NULL, NULL, NULL),
(1092, '91407', 1, 'La pedrera', NULL, NULL, NULL),
(1093, '91430', 1, 'La victoria', NULL, NULL, NULL),
(1094, '91460', 1, 'Miriti - paraná', NULL, NULL, NULL),
(1095, '91530', 1, 'Puerto alegría', NULL, NULL, NULL),
(1096, '91536', 1, 'Puerto arica', NULL, NULL, NULL),
(1097, '91540', 1, 'Puerto nariño', NULL, NULL, NULL),
(1098, '91669', 1, 'Puerto santander', NULL, NULL, NULL),
(1099, '91798', 1, 'Tarapacá', NULL, NULL, NULL),
(1100, '94001', 16, 'Inírida', NULL, NULL, NULL),
(1101, '94343', 16, 'Barranco minas', NULL, NULL, NULL),
(1102, '94663', 16, 'Mapiripana', NULL, NULL, NULL),
(1103, '94883', 16, 'San felipe', NULL, NULL, NULL),
(1104, '94884', 16, 'Puerto colombia', NULL, NULL, NULL),
(1105, '94885', 16, 'La guadalupe', NULL, NULL, NULL),
(1106, '94886', 16, 'Cacahual', NULL, NULL, NULL),
(1107, '94887', 16, 'Pana pana', NULL, NULL, NULL),
(1108, '94888', 16, 'Morichal', NULL, NULL, NULL),
(1109, '95001', 17, 'San josé del guaviare', NULL, NULL, NULL),
(1110, '95015', 17, 'Calamar', NULL, NULL, NULL),
(1111, '95025', 17, 'El retorno', NULL, NULL, NULL),
(1112, '95200', 17, 'Miraflores', NULL, NULL, NULL),
(1113, '97001', 32, 'Mitú', NULL, NULL, NULL),
(1114, '97161', 32, 'Caruru', NULL, NULL, NULL),
(1115, '97511', 32, 'Pacoa', NULL, NULL, NULL),
(1116, '97666', 32, 'Taraira', NULL, NULL, NULL),
(1117, '97777', 32, 'Papunaua', NULL, NULL, NULL),
(1118, '97889', 32, 'Yavaraté', NULL, NULL, NULL),
(1119, '99001', 33, 'Puerto carreño', NULL, NULL, NULL),
(1120, '99524', 33, 'La primavera', NULL, NULL, NULL),
(1121, '99624', 33, 'Santa rosalía', NULL, NULL, NULL),
(1122, '99773', 33, 'Cumaribo', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `iso_department_code` char(8) DEFAULT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `concept_count` int(10) DEFAULT NULL,
  `species_count` int(10) DEFAULT NULL,
  `occurrence_count` int(10) DEFAULT NULL,
  `occurrence_coordinate_count` int(10) DEFAULT NULL,
  `lat` varchar(40) DEFAULT NULL,
  `lng` varchar(40) DEFAULT NULL,
  `min_latitude` float DEFAULT NULL,
  `max_latitude` float DEFAULT NULL,
  `min_longitude` float DEFAULT NULL,
  `max_longitude` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `iso_department_code`, `department_name`, `concept_count`, `species_count`, `occurrence_count`, `occurrence_coordinate_count`, `lat`, `lng`, `min_latitude`, `max_latitude`, `min_longitude`, `max_longitude`) VALUES
(1, 'CO-AMA', 'Amazonas', NULL, 5845, 58248, 22461, '-1.4429123', '-71.5723953', -5, 1, -75, -69),
(2, 'CO-ANT', 'Antioquia', NULL, 7419, 100407, 85391, '7.1986064', '-75.3412179', 5, 10, -78, -73),
(3, 'CO-ARA', 'Arauca', NULL, 1024, 4594, 1418, '7.079371', '-70.758377', 6, 8, -73, -69),
(4, 'CO-ATL', 'Atlántico', NULL, 584, 2369, 861, '10.6966159', '-74.8741045', 10, 15, -76, -74),
(5, 'CO-BOL', 'Bolívar', NULL, 1150, 9502, 5458, '8.6704382', '-74.0300122', 7, 15, -76, -73),
(6, 'CO-BOY', 'Boyacá', NULL, 4592, 40512, 19187, '5.6396331', '-72.8988069', 4, 8, -75, -71),
(7, 'CO-CAL', 'Caldas', NULL, 2336, 16262, 7706, '5.25001', '-75.50003', 4, 6, -76, -74),
(8, 'CO-CAQ', 'Caquetá', NULL, 4882, 41288, 9472, '0.869892', '-73.8419063', -1, 3, -77, -71),
(9, 'CO-CAS', 'Casanare', NULL, 2307, 16608, 9221, '5.7589269', '-71.5723953', 4, 7, -74, -69),
(10, 'CO-CAU', 'Cauca', NULL, 4218, 35724, 22237, '2.2435893', '-77.010385', 0, 4, -85, -75),
(11, 'CO-CES', 'Cesar', NULL, 844, 3417, 1919, '9.3372948', '-73.6536209', 7, 11, -75, -72),
(12, 'CO-CHO', 'Chocó', NULL, 4641, 48274, 27204, '5.2528033', '-76.8259652', 3, 9, -85, -76),
(13, 'CO-COR', 'Córdoba', NULL, 581, 3102, 2092, '8.4029253', '-75.8998674', 7, 12, -77, -74),
(14, 'CO-CUN', 'Cundinamarca', NULL, 6994, 76527, 36339, '5.026003', '-74.0300122', 3, 6, -75, -73),
(15, 'CO-DC', 'Bogotá Distrito Capital', NULL, 1082, 5486, 1534, '4.5980556', '-74.0758333', 3, 5, -75, -73),
(16, 'CO-GUA', 'Guainía', NULL, 1858, 38060, 32352, '2.585393', '-68.5247149', 1, 5, -71, -66),
(17, 'CO-GUV', 'Guaviare', NULL, 1997, 8077, 1645, '2.043924', '-72.331113', 0, 3, -74, -70),
(18, 'CO-HUI', 'Huila', NULL, 2805, 21772, 10640, '2.5359349', '-75.5276699', 1, 4, -77, -74),
(19, 'CO-LAG', 'La Guajira', NULL, 1142, 5521, 2983, '11.3547743', '-72.5204827', 10, 16, -74, -72),
(20, 'CO-MAG', 'Magdalena', NULL, 3581, 46374, 28253, '10.4113014', '-74.4056612', 8, 15, -75, -73),
(21, 'CO-MET', 'Meta', NULL, 5379, 36217, 12018, '3.2719904', '-73.087749', 1, 5, -75, -71),
(22, 'CO-NAR', 'Nariño', NULL, 4040, 35215, 23159, '1.6378981', '-77.7452081', 0, 3, -85, -76),
(23, 'CO-NSA', 'Norte de Santander', NULL, 2067, 10816, 4487, '7.9462831', '-72.8988069', 6, 10, -74, -72),
(24, 'CO-PUT', 'Putumayo', NULL, 3060, 30064, 22073, '0.4359506', '-75.5276699', -1, 2, -78, -73),
(25, 'CO-QUI', 'Quindío', NULL, 1914, 18275, 13716, '4.4610191', '-75.667356', 3, 5, -76, -75),
(26, 'CO-RIS', 'Risaralda', NULL, 2750, 18182, 10666, '4.99243', '-76.01866', 4, 6, -77, -75),
(27, 'CO-SAP', 'San Andrés, Providencia y Santa Catalina', NULL, 250, 1697, 736, '12.5567324', '-81.7185253', 10, 15, -82, -77),
(28, 'CO-SAN', 'Santander', NULL, 4498, 28279, 18264, '6.6437076', '-73.6536209', 5, 9, -75, -72),
(29, 'CO-SUC', 'Sucre', NULL, 695, 4259, 1960, '9.1420384', '-75.0611147', 8, 11, -77, -74),
(30, 'CO-TOL', 'Tolima', NULL, 2824, 12647, 6425, '4.0925168', '-75.1545381', 2, 6, -77, -74),
(31, 'CO-VAC', 'Valle del Cauca', NULL, 4907, 89493, 53734, '3.8008893', '-76.6412712', 3, 6, -85, -75),
(32, 'CO-VAU', 'Vaupés', NULL, 2847, 13787, 3404, '0.8553561', '-70.8119953', -2, 3, -73, -69),
(33, 'CO-VID', 'Vichada', NULL, 2132, 15073, 5531, '4.4234452', '-69.2877535', 2, 7, -72, -67);

-- --------------------------------------------------------

--
-- Table structure for table `dilegenciadores`
--

CREATE TABLE IF NOT EXISTS `dilegenciadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `dependencia` varchar(150) DEFAULT NULL,
  `cargo` varchar(150) DEFAULT NULL,
  `telefono` varchar(150) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `dilegenciadores`
--

INSERT INTO `dilegenciadores` (`id`, `nombre`, `dependencia`, `cargo`, `telefono`, `email`) VALUES
(50, 'Administrador Sistema', 'RNC', 'Sistema RNC', '3202767', 'rnc@humboldt.org.co'),
(72, 'Jeimmy Diaz', 'GIC', 'Administrador', '3202767', 'jpdiaz.111@gmail.com'),
(75, 'Administrador RNC', 'Registro Nacional de Colecciones', 'Administrador', '3202761', 'rnc@humboldt.org.co'),
(76, 'Administrador RNC', 'Registro Nacional de Colecciones', 'Administrador', '3202761', 'rnc@humboldt.org.co');

-- --------------------------------------------------------

--
-- Table structure for table `entidad`
--

CREATE TABLE IF NOT EXISTS `entidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_titular` tinyint(4) DEFAULT NULL,
  `titular` varchar(150) NOT NULL,
  `tipo_nit` smallint(6) DEFAULT NULL,
  `nit` varchar(64) DEFAULT NULL,
  `representante_legal` varchar(150) DEFAULT NULL,
  `tipo_id_rep` smallint(6) DEFAULT NULL,
  `representante_id` varchar(64) DEFAULT NULL,
  `ciudad_id` varchar(11) DEFAULT NULL,
  `telefono` varchar(150) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `estado` smallint(6) DEFAULT '0',
  `comentario` text,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `dilegenciadores_id` int(11) NOT NULL,
  `tipo_institucion_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_entidad_dilegenciadores1_idx` (`dilegenciadores_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=192 ;

--
-- Dumping data for table `entidad`
--

INSERT INTO `entidad` (`id`, `tipo_titular`, `titular`, `tipo_nit`, `nit`, `representante_legal`, `tipo_id_rep`, `representante_id`, `ciudad_id`, `telefono`, `direccion`, `email`, `estado`, `comentario`, `usuario_id`, `fecha_creacion`, `dilegenciadores_id`, `tipo_institucion_id`) VALUES
(69, 1, 'Alejandro Lopera', 2, '80422824', 'Alejandro Lopera', 0, '80422824', '11001', '474 7428', 'Carrera 13A No. 106 A-67, apto 302', 'alejandro.lopera@gmail.con', 2, NULL, 39, '2014-02-07 15:22:34', 50, 1),
(70, 1, 'Angela Rocío Amarillo Suárez', 1, '51889936', '-', 0, '0', '11001', '2214131', 'Calle 46 No. 55-19', 'aamarill@hotmail.com', 2, NULL, 40, '2014-02-07 15:46:13', 50, 1),
(71, 1, 'Carlos Eduardo Sarmiento Monroy', 2, '79373618', '-', 0, '0', '11001', '7200024', 'Carrera 40 # 36 - 21 Sur', 'cesarmiento@yahoo.com', 2, NULL, 75, '2014-02-10 15:45:02', 50, 1),
(72, 1, 'César Caicedo López', 2, '17096761', '-', 0, '0', '11001', '2175076', 'Calle 75 A No. 19 - 28', 'cesar_caicedo@yahoo.com', 2, NULL, 41, '2014-02-07 15:54:54', 50, 1),
(74, 1, 'Dora Nancy Padilla Gil', 2, '51820419', '-', 0, '0', '52001', '5622177', 'Carrera 34 B # 1 A - 77', 'dnpadilla@udenar.edu.co', 2, NULL, 42, '2014-02-07 16:13:27', 50, 1),
(75, 1, 'Efrain Reinel Henao Bañol', 2, '75073651', '-', 0, '0', '15131', '8778733', 'Cra 16 A No. 6-48', 'efrain.henao@ucaldas.edu.co', 2, NULL, 43, '2014-02-07 16:26:37', 50, 1),
(76, 1, 'Enrique Alberto Yide', 2, '8705926', '-', 0, '0', '8001', '3600208', 'Carrera 52 No. 99 - 168 Casa 41 Reserva de San Bernardo', 'biologo@colombianshells.com', 2, NULL, 44, '2014-02-07 16:32:36', 50, 1),
(77, 1, 'Hans W. Dahners', 2, '195524', '-', 0, '0', '76001', '893 2592', 'Calle 8 oeste No. 4-32', 'hdahners@gmx.de', 2, NULL, 45, '2014-02-07 16:36:16', 50, 1),
(79, 1, 'Jean Francois Le Crom', 2, '79631159', '-', 0, '0', '11001', '3681646', 'Calle 61 No.37-31', 'jflecrom@cable.net.co', 2, NULL, 46, '2014-02-07 16:39:16', 50, 1),
(80, 1, 'José Ignacio Vargas Chica', 2, '9971933', '-', 0, '0', '15131', '8773429', 'Barrio Turín, casa No. 11', 'joseignacio_05@yahoo.es', 2, NULL, 47, '2014-02-07 16:44:04', 50, 1),
(81, 1, 'Juan J. A. Laverde Castillo', 2, '19426410', '-', 0, '0', '47001', '4321403', 'Apto 318 Boca Salinas/Pozos Colorados', 'jjalaverde@hotmail.com', 2, NULL, 48, '2014-02-07 16:55:14', 50, 1),
(82, 1, 'Juan José Silva Haad', 2, '164516', '-', 0, '0', '91001', '59226533', 'Carrera 11 No.14-21', 'juanjhaad@yahoo.com', 2, NULL, 136, '2014-02-11 14:47:17', 50, 1),
(83, 1, 'Julián Adolfo Salazar', 2, '10258548', '-', 0, '0', '17001', '8853568', 'Carrera 17A No. 49-13', 'julianadolfoster@gmail.com', 2, NULL, 49, '2014-02-07 16:59:36', 50, 1),
(84, 1, 'Luis Carlos Pardo Locarno', 2, '16278561', '-', 0, '0', '76520', '2721198', 'Cra 21 No. 24A-63', 'lcpardolocarno@yahoo.es', 2, NULL, 50, '2014-02-07 17:02:46', 50, 1),
(85, 1, 'Luis Miguel Constantino', 2, '16682887', '-', 0, '0', '76001', '3166922871', 'Kra 3 oeste No. 7-66, barrio Arboledas', 'luismiguel.constantino@hotmail.com', 2, NULL, 51, '2014-02-07 17:13:48', 50, 1),
(87, 1, 'Rafael Enrique Vieira Op den Bosch', 2, '7471978', '-', 0, '0', '13001', '6734045', 'Isla San Martín de Pajarales, Islas del Rosario', 'oceanario@enred.com', 2, NULL, 52, '2014-02-10 08:59:45', 50, 1),
(88, 1, 'Rodrigo Torres Núñez', 2, '14879086', '-', 0, '0', '11001', '2872957', 'Temporalmente en la Universidad Pedagógica Nacional', 'rtorresn@colomsat.net.co', 2, NULL, 53, '2014-02-10 09:03:16', 50, 1),
(89, 2, 'Acuario y Museo del Mar del Rodadero', 1, '819005753', 'Francisco Ospina Navia', 1, '1679564', '47001', '4227222', 'Carrera 1 Calle 8 esquina, edificio fuente mar lcoal 3', 'acuariorodadero@gmail.com', 2, NULL, 54, '2014-02-10 09:13:20', 50, 1),
(90, 2, 'Aves Barbacoa S.A', 1, '900102156', 'Alba Lucía Gómez Vargas', 1, '36166682', '13001', '6734045', 'Barú lote 2 El Pajal Corregimiento Santana Isla grande palmar', 'aviarionacionalcolombia@yahoo.com', 2, NULL, 55, '2014-02-10 09:19:31', 50, 1),
(91, 2, 'Caja Colombiana de Subsidio Familiar - Colsubsidio', 1, '860007336 ', 'Luis Carlos Arango Vélez', 1, '8268605', '25488', '3153263527', 'Km 104 vía Bogotá - Girardot', 'zoologico.pscilago@colsubsidio.com', 2, NULL, 56, '2014-02-10 09:29:00', 50, 1),
(92, 2, 'Caja de Compensación Familiar - Comfenalco Antioquia (Comodatario)', 1, '890900842 -6', 'Mario Fernando Calle Uribe', 1, '70042948', '5001', '4601100', 'Parque Ecológico Piedras Blancas, Vereda Piedras Blancas kilómetro 14, núcleo de las E.E.P.P.M.M,', 'museoentomologico@comfenalcoantioquia.com', 2, NULL, 57, '2014-02-10 09:35:10', 50, 1),
(93, 2, 'Centro de Investigaciones Oceanográficas e Hidrográficas del Pacífico', 1, '840000101 -3', 'Rafael Ricardo Torres Parra', 1, '79592381', '5483', '7272637', 'Vía "El Morro", Capitanía de ´Puerto, Tumaco Nariño.', 'jefcccp@dimar.mil.co', 2, NULL, 58, '2014-02-10 09:47:22', 50, 1),
(95, 2, 'Centro Internacional de Agricultura Tropical - Ciat', 1, '800034586 -2', 'Ruben Echeverría ', 1, '0', '76001', '4450100 Ext: 3661', 'Km 17 carretera Cali- Palmira', 'a.m.torres@cgiar.org', 2, NULL, 59, '2014-02-10 09:54:42', 50, 1),
(97, NULL, 'Comunidad de hermanos Maristas', NULL, '860006744 -9', 'Hernán Gómez Osorio', NULL, '17081757', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 50, 1),
(98, 2, 'Congregación de hermanos de las escuelas cristianas', 1, '860009985 -0', 'Leonardo Enrique Tejeiro Duque', 1, '13331021', '11001', '3535360 Ext. 2209 -2214', 'Carrera 2 No. 10-70 Universidad de la Salle', 'museo@lasalle.edu.co', 2, NULL, 60, '2014-02-10 10:55:56', 50, 1),
(99, 2, 'Corporación Autónoma Regional del Centro de Antioquia - Corantioquia', 1, '811000231 -7', 'Francisco Zapata Ospina', 1, '15523683', '5001', '5669343', 'Estación Biodiversidad Piedras Blancas, Vereda Mazo, Corregimiento Santa Elena', 'jtoro@corantioquia.gov.co', 2, NULL, 61, '2014-02-10 11:00:24', 50, 1),
(100, 2, 'Corporación Autónoma Regional del Quindío - CRQ', 1, '890000447 -9', 'Sandra Milena Rojas Giraldo ', 1, '0', '5059', '7460600', 'Km 22 vía Armenia-Córdoba', 'crq@crq.gov.co', 2, NULL, 62, '2014-02-10 11:06:42', 50, 1),
(101, 2, 'Corporación Autónoma Regional para la Defensa de la Meseta de Bucaramanga - CDMB', 1, '890201573 -0', 'Elvia Hercilia Páez Gómez', 1, '63271021', '68001', '6480729', 'Jardín Botánico Eloy Valenzuela', 'jardin@cdmb.gov.co', 2, NULL, 63, '2014-02-10 11:10:48', 50, 1),
(102, 2, 'Corporación Botánico Jardín Botánico San Jorge', 1, '890007626 -7', 'Edgar Delgado Torres', 1, '92285287', '73001', '2638334', 'Antigua Granja San Jorge Vía Calambeo', 'jardinsanjorge@gmail.com', 2, NULL, 64, '2014-02-10 11:16:57', 50, 1),
(103, 2, 'Corporación Centro de Investigación en Palma de Aceite', 1, '800145882 -4', 'José Ignacio Sanz Scovino', 1, '10230559', '11001', '208 6300', 'Calle 20A No. 43 A-50', 'jsanz@cenipalma.org', 2, NULL, 65, '2014-02-10 11:19:38', 50, 1),
(104, 2, 'Corporación Colombiana de Investigación Agropecuaria - Corpoica', 1, '800194600 -3', 'Juan Lucas Restrepo Ibiza', 1, '79485810', '11001', '4227300 ext.1311', 'C.I. Tibaitatá Km 14 vía Mosquera- C.I. Ceisa Av. Dorado No.42-42', 'cgonzaleza@corpoica.org.co', 2, NULL, 66, '2014-02-10 11:23:44', 50, 1),
(105, 2, 'Corporación Corpogen', 1, '830009610 -5', 'Patricia del Portillo', 1, '20525312', '11001', '8050092', 'Carrera 5 No. 66 A - 44', 'corpogen@corpogen.org', 2, NULL, 67, '2014-02-10 11:26:51', 50, 1),
(106, 2, 'Corporación Ecoparque los Yarumos', 1, '810005598 -3', 'Carlos Saúl Corzo Uribe', 1, '91472354', '17001', '8755621', 'Ecoparque los Yarumos', 'ecoparqueyarumos@epm.net.co', 2, NULL, 68, '2014-02-10 11:29:12', 50, 1),
(107, 2, 'Corporación Nacional de Investigación y Fomento Forestal - Conif', 1, '860042183 -1', 'Luis Enrique Vega González', 1, '14219960', '11001', '341 7000', 'Avenida Circunvalar No.16-20', 'javerrodriguez@conif.org.co', 2, NULL, 69, '2014-02-10 11:32:23', 50, 1),
(108, 2, 'Corporación para el Desarrollo de la Biotecnología - Biotec', 1, '805001728 -8', 'Myriam Sánchez M.', 1, '31212595', '76001', '4450114', 'Km 17 recta Cali-Palmira CIAT', 'usi3-biotec@cgiar.org', 2, NULL, 70, '2014-02-10 11:35:11', 50, 1),
(109, 2, 'Corporación para el Desarrollo Sostenible del Sur de la Amazonía - Corpoamazonia', 1, '800252844 -2', 'José Ignacio Muñoz Córdoba', 1, '18108482', '86001', '4296396', 'Vereda San Carlos Km 8, Centro experimental amazónico CEA', 'lrivera@corpoamazonia.gov.co', 2, NULL, 71, '2014-02-10 11:38:09', 50, 1),
(110, 2, 'Corporación para Investigaciones Biológicas - Cib', 1, '809908790 -8', 'Jorge Hernan  Gomez ', 1, '0', '05001', '4415514', 'Cra 72 A No. 78 B- 141', 'jzuluaga@cib.org.co', 2, NULL, 72, '2014-02-10 11:41:24', 50, 1),
(111, 2, 'Corporación Parque Explora', 1, '900145472 -0', 'Azucena Restrepo', 1, '43046330', '05001', '5168381', 'Carrera 52 # 73 - 75', 'isabel.acero@parqueexplora.org', 2, NULL, 73, '2014-02-10 11:44:58', 50, 1),
(112, 2, 'Universidad de Ciencias Aplicadas y Ambientales - Udca', 1, '860403721 -2', 'Germán Anzola Montero', 1, '17139367', '11001', '6684700', 'Calle 222 No. 54 - 25', 'ganzola@udca.edu.co', 2, NULL, 74, '2014-02-11 10:35:07', 50, 1),
(113, 2, 'Secretaria de Agricultura y Desarrollo Rural de Antioquia', 1, '890900286 -0', 'Sergio Trujillo Turizo', 1, '71634483', '05001', '4611700 ext. 146', 'Carrera 45 # 31 - 02 Barrio la Gabriela. Bello', 'gloriae@cis.net.co', 2, NULL, 76, '2014-02-10 15:50:17', 50, 1),
(114, 2, 'Empresa de Acueducto y Alcantarillado de Bogotá E.S.P.', 1, '899999094 -1', 'José William Garzón Solis', 1, '10109557', '11001', '3447000', 'Av Calle 24 # 37 - 15', 'lasilva@acueducto.com.co', 2, NULL, 77, '2014-02-10 15:54:06', 50, 1),
(115, 2, 'Centro Nacional de Investigaciones de Café "Pedro Uribe Mejía" CENICAFE', 1, '860007538 -2', 'Fernando Gast Harders', 1, '79144104', '17174', '850 6550', 'Planalto, km 4 antigua vía a Manizales', 'cenicafe@cafedecolombia.com', 2, NULL, 78, '2014-02-10 15:59:57', 50, 1),
(116, 2, 'Fundación Botánica y Zoológica de Barranquilla', 1, '800199708 -2', 'Rosamira Guillén', 1, '32698413', '08001', '3530313 - 3685765', 'Calle 77 # 68 - 40', 'zoobaq@metrotel.net.co', 2, NULL, 79, '2014-02-10 16:03:06', 50, 1),
(117, 2, 'Fundación Centro de Primates - Fucep', 1, '800125073 -7', 'Myriam Arévalo Ramírez', 1, '41717562', '76001', '550 4289', 'Km 6 vía Cali, puerto Tejada, corregimiento El Hormiguero, vereda Caucaseco, finca Bonanza', 'bioinfo@inmuno.org', 2, NULL, 80, '2014-02-10 16:05:36', 50, 1),
(118, 2, 'Fundación Centro para la Investigación en Sistemas Sostenibles de Producción Agropecuaria - Cipav', 1, '800165375 -7', 'Enrique Murgueitio Restrepo', 1, '16628142', '76001', '524 3061', 'Carrera 25 No.6-62', 'cipav@cipav.org.co', 2, NULL, 81, '2014-02-10 16:09:23', 50, 1),
(119, 2, 'Fundación ciencia, ecología, arte e historia - Ceah (Museo Vittoriano)', 1, '832002142 -5', 'Ana Catalina Linares Bejarano', 1, '41446815', '25297', '8535718', 'Calle 3 No. 4-10', 'museogacheta@yahoo.com', 2, NULL, 82, '2014-02-10 16:15:37', 50, 1),
(120, 2, 'Fundación Jaime Duque', 1, '890802259 -1', 'María Amparo Torres', 1, '39786553', '25817', '8574427', 'km 34 Autop central del Norte, Parque Jaime Duque', 'zoo@parquejaimeduque.com', 2, NULL, 83, '2014-02-10 16:25:40', 50, 1),
(121, 2, 'Fundación Jardín Batánico Joaquín Antonio Uribe', 1, '890989756-2', 'Pilar Velilla Moreno', 1, '32480045', '05001', '4445500', 'Cra 52 No. 73-29', 'alvaro.cogollo@botanicomedellin.org', 2, NULL, 84, '2014-02-10 16:29:39', 50, 1),
(122, 2, 'Fundación Jardín Botánico de Cali', 1, '805020553 -7', 'Jorge Mario López Chede', 1, '14437651', '76001', '6831456', 'Carrera 2 oeste Calle 14 esquina', 'jardinbocali@uniweb.net.co', 2, NULL, 85, '2014-02-10 16:31:51', 50, 1),
(123, 2, 'Fundación Jardín Botánico del Quindío', 1, '890006578 -8', 'Carolina Cruz Hernández', 1, '1018408406', '63130', '7427254', 'Av. Centenario 15-190 Km 3 vía al Valle', 'jardinbotanicoquindio@gmail.com', 2, NULL, 86, '2014-02-10 16:35:41', 50, 1),
(124, 2, 'Fundación Jardín Botánico Guillermo Piñeres', 1, '890480597 -2', 'Efrain A. Consuegra Solorzano', 1, '6817807', '13001', '6637172', 'Jardín Botánico, sector Matute', 'jarbotgpineres@ctgred.net.co', 2, NULL, 87, '2014-02-10 16:39:20', 50, 1),
(126, 2, 'Fundación Jardín Botánico Villa Ludovica', 1, '819004340', 'Guillermo E. Rodríguez Navarro', 1, '19169804', '47001', '4216644', 'Av. El Libertador, Carrera 15. Arriba del cerro', 'vludovica@hotmail.com', 2, NULL, 88, '2014-02-10 16:42:44', 50, 1),
(127, 2, 'Fundación Museo Bolivariano de Arte Comtemporaneo - Quinta de San Pedro Alejandrino', 1, '800954955 -2', 'Zarita Abello de Bonilla', 1, '36251058', '47001', '4332995', 'Av El Libertador, Quinta de San Pedro Alejandrino', 'jbqspa@yahoo.es', 2, NULL, 89, '2014-02-10 16:45:24', 50, 1),
(128, 2, 'Fundación Museo del Mar', 1, '891702613 -0', 'Hernando Valencia Abdalá', 1, '12529961', '47001', '4229334', 'Carrera 2 No. 11 - 68 Edificio Mundo Marino - Rodadero Santa Marta', 'mundomarino@utadeo.edu.co', 2, NULL, 90, '2014-02-10 16:48:48', 50, 1),
(129, 2, 'Fundación Universidad de Bogotá Jorge Tadeo Lozano', 1, '860006848 -6', 'José Fernando Isaza Delgado', 1, '17143307', '11001', '242 7030', 'Carrera 4 No.22-61', 'luz.fuentes@utadeo.edu.co', 2, NULL, 91, '2014-02-10 16:53:33', 50, 1),
(130, 2, 'Fundación Universitaria de Popayán', 1, '891501835 -6', 'Lida Socorro Solarte Astaiza', 1, '34537713', '19001', '8238378', 'Km 8 vía al sur sede campestre los Robles', 'jardinbotanico@fup.edu.co', 2, NULL, 92, '2014-02-10 16:56:51', 50, 1),
(131, 2, 'Fundación Yubarta', 2, '800155085 -3', 'Lilián Flórez González', 1, '41722990', '76001', '5585585', 'Carrera 24 F oeste # 3 -110', 'yubarta@emcali.net.co', 2, NULL, 93, '2014-02-10 17:03:36', 50, 1),
(132, 2, 'Fundación Zoológica de Cali', 1, '890318247 -8', 'María Clara Dominguez Vernaza', 1, '31860463', '76001', '2892747 ext. 116', 'Carrera 2 oeste calle 14 esquina', 'zoologico@zoologicodecali.com.co', 2, NULL, 94, '2014-02-10 17:08:06', 50, 1),
(133, 2, 'Fundación Zoológico Santa Cruz', 1, '830093363 -8', 'Haidy Monsalve Redwan', 1, '51557439', '11001', '8473831', 'Kilómetro 16 Troncal Tequendama Vía Mesitas del Colegio', 'hmonsalve@zoosantacruz.org.co', 2, NULL, 95, '2014-02-10 17:22:18', 50, 1),
(134, 2, 'Instituto Amazónico de Investigaciones Científicas - Sinchi', 1, '860061110 -3', 'Luz Marina Mantilla Cárdenas', 1, '51580110', '11001', '4442060', 'Calle 20 No. 5 - 44', 'herbario@sinchi.org.co', 2, NULL, 96, '2014-02-10 17:24:40', 50, 1),
(135, 2, 'Instituto Colombiano de Medicina Tropical, Universidad CES', 1, '800082822 -0', 'Andrés Trujillo Zea', 1, '71724566', '05631', '305 3500', 'Carrera 43A No. 52S-99', 'gparra@ces.edu.co', 2, NULL, 97, '2014-02-10 17:28:46', 50, 1),
(136, 2, 'Universidad Nacional de Colombia', 1, '899999063 -3', 'Ignacio Mantilla Prada', 1, '19328350', '11001', '3165000 ', 'carrera 30 No.45-03 ', 'mgandradec@unal.edu.co', 2, NULL, 98, '2014-02-11 14:30:19', 50, 1),
(137, 2, 'Instituto de Investigación de Recursos Biológicos Alexander von Humboldt', 1, '820000142 -2', 'Brigitte L.G. Baptiste', 1, '79157459', '15407', '7320791', 'Claustro San Agustín', 'coleccionesbiologicas@humboldt.org.co', 2, NULL, 99, '2014-02-12 15:44:08', 50, 1),
(138, 2, 'Instituto de Investigaciones Marinas y Costeras José Benito Vives de Andreis - Invemar', 1, '800250062 -0', 'Francisco Arias Isaza', 1, '79146703', '47001', '4328600 ext. 247 y 253', 'Cerro Punta Betín', 'giomar.borrero@invemar.org.co', 2, NULL, 100, '2014-02-10 17:38:42', 50, 1),
(139, 2, 'Instituto Nacional de Salud', 1, '899999403 -4', 'Juan Gonzalo López', 1, '18501764', '11001', '2207700 ext: 1297 / 1317', 'Calle 26 # 51 - 20', 'fruiz@ins.gov.co', 2, NULL, 101, '2014-02-10 17:41:21', 50, 1),
(140, 2, 'Instituto para la Investigación y Preservación del Patrimonio Cultural y Natural del Valle del Cauca - Inciva', 1, '800086201 -7', 'Armando Gómez Rayo', 1, '6385803', '76001', '5146686', 'Av. Rooselvelt No. 24-80', 'mcn@inciva.gov.co', 2, NULL, 102, '2014-02-10 17:44:26', 50, 1),
(141, 2, 'Instituto Tecnológico Metropolitano', 1, '800214750 -7', 'Luz Mariela Sorza Zapata', 1, '32481395', '05001', '4600227', 'Calle 54 A No. 30 - 01 ', 'museodecienciasnaturales@itm.edu.co', 2, NULL, 103, '2014-02-11 08:48:38', 50, 1),
(142, NULL, 'Jardín Botánico Eloy Valenzuela - CDMB', NULL, '890801063 -0', 'Freddy Antonio Anaya Martínez', NULL, '91227424', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 50, 1),
(143, 2, 'Jardín Botánico José Celestino Mutis', 1, '860030197 -0', 'Edgar Mauricio Garzón González', 1, '79133743', '11001', '4377060', 'Avenida calle 63 No.68-95', 'bogotanico@jbb.gov.co', 2, NULL, 104, '2014-02-11 09:01:45', 50, 1),
(144, NULL, 'Jardín Botánico Universidad de Caldas', NULL, '890801063 -1', 'Ricardo Gómez Giraldo', NULL, '75067009', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 50, 1),
(145, NULL, 'Laboratorio Colecciones Entomológicas - Universidad de Antioquia', NULL, '890980040 -8', 'Jaime Restrepo Cuartas', NULL, '8252738', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 50, 1),
(146, NULL, 'Ministerio del Medio Ambiente - Unidad Administrativa Especial del Sistema de Parques Nacionales Naturales', NULL, '860016624 -7', 'Juan Carlos Riascos de la Peña', NULL, '16655901', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 50, 1),
(147, 2, 'Pontificia Universidad Javeriana', 1, '860013720 -1', 'P. Joaquín Emilio Sánchez García', 1, '4242274', '11001', '3208320 ext 4127-4056', 'Cra 7 No. 43-82 ', 'maldonadoj@javeriana.edu.co', 2, NULL, 105, '2014-02-11 09:48:00', 50, 1),
(148, NULL, 'Secretaría de Agricultura y Desarrollo Rural, Departamento de Antioquia', NULL, '890900286 -0', 'Sergio Trujillo Turizo', NULL, '71634483', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 50, 1),
(149, 2, 'Sociedad de Mejoras de Pereira', 1, '891480071 -4', 'Gustavo Valencia Franco', 1, '8315241', '66001', '3360044', 'Zoológico Matecaña de Pereira', 'zoomate@pereira.multi.net.co', 2, NULL, 106, '2014-02-11 09:50:22', 50, 1),
(150, 2, 'Sociedad de Mejoras Públicas de Medellín', 1, '890904141 -1', 'Héctor Guillermo Echeverri Galvis', 1, '8276813', '05001', '2351326', 'Carrera 52 No. 20 - 63', 'zoostafe@une.net.co', 2, NULL, 107, '2014-02-11 09:52:49', 50, 1),
(151, 2, 'Tecnológico de Antioquia ', 1, '890905419-6', 'Lorenzo Portocarrero Sierra', 1, '6454684', '05001', '4547000', 'Calle 78 b No. 72 A- 220', 'manalejo1781@gmail.com', 2, NULL, 108, '2014-02-11 09:58:13', 50, 1),
(152, 2, 'Universidad Católica de Oriente', 1, '890984746 -7', 'Mons. Iván Cadavid Ospina', 1, '3615061', '05615', '5699090 Ext 285', 'Cra 46 No. 40B- 50 sector 3', 'gestambiental.jefe@uco.edu.co', 2, NULL, 109, '2014-02-11 10:01:20', 50, 1),
(153, 2, 'Universidad de Antioquia', 1, '890980040 -8', 'Alberto Uribe Correa', 1, '8346555', '05001', '2192315', 'Carrera 50A No.63-65', 'museo@quimbaya.udea.edu.co', 2, NULL, 110, '2014-02-11 10:10:43', 50, 1),
(154, 2, 'Universidad de Caldas', 1, '890801063 -0', 'Ricardo Gómez Giraldo', 1, '75067009', '17001', '8781500', 'Calle 65 No. 26 - 10', 'luis.alvarez@ucaldas.edu.co', 2, NULL, 111, '2014-02-11 10:27:29', 50, 1),
(156, NULL, 'Universidad de Ciencias Aplicadas y Ambientales U.D.C.A', NULL, '860403721-2', 'Germán Anzola Montero', NULL, '17139367', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 50, 1),
(157, 2, 'Universidad de Córdoba', 1, '891080031-3', 'Giovanni Carlos Argel Fuentes', 1, '78696630', '23001', '7860381', 'Carrera 6 No. 76 - 103 ', 'herbario@unicordoba.edu.co', 2, NULL, 112, '2014-02-11 10:37:55', 50, 1),
(159, 2, 'Universidad de la Amazonía', 1, '891190346 -1', 'Leonidas Rico Martinez', 1, '17624610', '18001', '4358786', 'Carrera 11 No. 5 - 59 sede centro intalaciones antiguo IDEMA', 'j.botanicouniamazonia@gmail.com', 2, NULL, 113, '2014-02-11 10:40:41', 50, 1),
(160, 2, 'Universidad de la Sabana', 1, '86007558 -1', 'Obdulio Velásquez Posada', 1, '71617244', '11001', '8615555', 'Universidad de la Sabana, Km 7 Autonorte, Puente El Común, Chía', 'gloria.gonzalez@unisabana.edu.co', 2, NULL, 114, '2014-02-11 10:46:02', 50, 1),
(161, 2, 'Universidad de Los Andes', 1, '860007386 -1', 'José Rafael Toro Gómez', 1, '19269542', '11001', '339 4949', 'Carrera 1 no. 18 A-10, ', 'museo@uniandes.edu.co', 2, NULL, 115, '2014-02-11 10:50:03', 50, 1),
(163, 2, 'Universidad de los Llanos', 1, '892000757 -3', 'Jairo Iván Frias Carreño', 1, '17350164', '50001', '6698239', 'Villavicencio', 'luzmila@unillanos.edu.co', 2, NULL, 116, '2014-02-11 10:53:31', 50, 1),
(164, 2, 'Universidad de Nariño', 1, '800118954 -1', 'José Edmundo Calvache López', 1, '12955860', '52001', '7311449 ext 236', 'Universidad de  Nariño sede Torobajo, bloque 1', 'mgonzalez@udenar.edu.co', 2, NULL, 117, '2014-02-11 10:56:08', 50, 1),
(165, 2, 'Universidad de Pamplona', 1, '890501510 -4', 'Esperanza Paredes Hernández', 1, '41698559', '54518', '5685303 etx. 225', 'Edificio Camilo Daza CD 208, Campus Universitario Pamplona', 'hecasa@unipamplona.edu.co', 2, NULL, 118, '2014-02-11 10:58:36', 50, 1),
(166, 2, 'Universidad del Atlántico', 1, '890102257 -9', 'Ana Sofía Mesa de  Cuervo', 1, '324299542', '08001', '3599481', 'Facultad de Ciencias Básicas, Departamento de Biología', 'hcuadros@uniatlantico.edu.co', 2, NULL, 119, '2014-02-11 11:03:07', 50, 1),
(168, 2, 'Universidad del Cauca', 1, '891500319 -2', 'Danilo Reinaldo Vivas', 1, '10527315', '19001', '820 9861', 'Carrera 2 No. 1A-25', 'unicauca.caup@gmail.com', 2, NULL, 120, '2014-02-11 11:06:43', 50, 1),
(169, 2, 'Universidad del Magdalena', 1, '891780111 -8', 'Ruthber Escorcia Caballero', 1, '85448878', '47001', '4219133', 'Carrera 2 No. 18 - 27 Taganga, Magdalena', 'molmarcol@gmail.com', 2, NULL, 121, '2014-02-11 11:09:58', 50, 1),
(170, 2, 'Universidad del Quindío', 1, '890000432 -8', 'Alfonso Londoño Orozco', 1, '19189065', '05059', '7359346', 'Carrera 15, Calle 12 Norte', 'analucia@uniquindio.edu.co', 2, NULL, 122, '2014-02-11 11:15:33', 50, 1),
(172, 2, 'Universidad del Tolima', 1, '890700640 -7', 'Jose Hernán Muñoz Ñungo', 1, '6023478', '73001', '2771212', 'Universidad del Tolima - Barrio Santa Elena - Ibagué', 'greinoso@ut.edu.co', 2, NULL, 123, '2014-02-11 11:19:05', 50, 1),
(173, 2, 'Universidad del Valle', 2, '890399010- 6', 'Iván Enrique Ramos Calderón', 1, '14989446', '76001', '3212100 ext.2570', 'Universidad del Valle, departamento de biología', 'entomologia@univalle.edu.co', 2, NULL, 124, '2014-02-11 11:22:29', 50, 1),
(174, 2, 'Universidad Distrital Francisco José de Caldas', 1, '899999230 -7', 'Inocencio Bahamón Calderón', 1, '19253011', '11001', '3376918', 'Avenida Circunvalar, Venado de Oro, Facultad del Medio Ambiente y Recursos Naturales', 'herbarioforestal@udistrital.edu.co', 2, NULL, 125, '2014-02-11 11:25:40', 50, 1),
(175, 2, 'Universidad EAFIT', 1, '890901389 -5', 'Juan Luis Mejía Arango', 1, '8351889', '05001', '2619599 ext.9317', 'Carrera 49 No.7sur- 50', 'vvilleg2@eafit.edu.co', 2, NULL, 126, '2014-02-11 11:27:25', 50, 1),
(176, 2, 'Universidad El Bosque', 1, '860066789 -6', 'Carlos Felipe Escobar Toa', 1, '79521534', '11001', '6489000', 'Carrera 7 Bis No. 132 - 11 ', 'biologia@unbosque.edu.co', 2, NULL, 127, '2014-02-11 11:30:46', 50, 1),
(177, 2, 'Universidad ICESI', 1, '890316745 -5', 'Francisco Piedrahíta Plata', 1, '14934246', '76001', '5552334', 'Calle 18 No.122-135', 'wgvargas@icesi.edu.co', 2, NULL, 128, '2014-02-11 11:32:47', 50, 1),
(178, 2, 'Universidad Industrial de Santander', 1, '890201213 -4', 'Jaime Alberto Camacho Pico', 1, '91230254', '68001', '6344000', 'Calle 27 carrera 9 ciudad universitaria', 'mpramir@uis.edu.co', 2, NULL, 129, '2014-02-11 11:35:13', 50, 1),
(179, 2, 'Universidad Militar Nueva Granada', 1, '800225340 -8', 'Eduardo Antonio Herrera Berbel', 1, '14977351', '11001', '275 7300', 'Carrera 11 No.101-80 ', 'cmedinab@umng.edu.co', 2, NULL, 130, '2014-02-11 11:38:04', 50, 1),
(180, NULL, 'Universidad Nacional de Colombia - Sede Bogotá', NULL, '899999063 -6', 'Giomar Nates Parra', NULL, '41416754', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 50, 1),
(181, NULL, 'Universidad Nacional de Colombia - Sede Bogotá, Centro Estación de Biología Tropical "Roberto Franco"', NULL, '899999063 -3', 'Moises Wasserman Lerner', NULL, '17157126', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 50, 1),
(182, NULL, 'Universidad Nacional de Colombia - Sede Caribe', NULL, '899999063 -3', 'José Ernesto Mancera', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 50, 1),
(184, 2, 'Universidad Pagagógica y Tecnológica de Colombia', 1, '891800330-1', 'Gustavo Orlando Alvarez Alvarez', 1, '6770318', '15001', '742175 ext.2313', 'Avenida Central del Norte, campus universitario, UPTC, edificio central C-119', 'herbario@uptc.edu.co', 2, NULL, 131, '2014-02-11 14:33:14', 50, 1),
(185, 2, 'Universidad Pedagógica Nacional', 1, '899999214 -4', 'Oscar Armando Ibarra Russi', 1, '4170666', '11001', '5941894', 'Calle 72 No. 11-86', 'valbuena@pedagogica.edu.co', 2, NULL, 132, '2014-02-11 14:36:00', 50, 1),
(187, 2, 'Universidad Surcolombiana', 1, '891180084 -2', 'Héctor Hernán Zamora Caicedo', 1, '19145208', '41001', '8758775', 'Avenida Pastrana con carrera primera', 'fllanos@usco.edu.co', 2, NULL, 133, '2014-02-11 14:38:57', 50, 1),
(188, 2, 'Universidad Tecnológica de Pereira', 1, '891480035 -9', 'Luis Enrique Arango Jiménez', 1, '10059486', '66001', '3212523', 'Universidad Tecnológica de Pereira, Vereda la Julita,', 'jardinbotanico@utp.edu.co', 2, NULL, 134, '2014-02-11 14:40:36', 50, 1),
(189, 2, 'Universidad Tecnológica del Chocó  Diego Luis Córdoba', 1, '891680089 -4', 'Eduardo Antonio García Vega', 1, '70110380', '27001', '6726565 ext 3001', 'Ciudadela Universitaria UTCH', 'herbario@utch.edu.co', 2, NULL, 135, '2014-02-11 14:43:05', 50, 1),
(191, 1, 'Jeimmy Diaz', 2, '1024524343', '-', 0, '0', '11001', '3202767', 'Cra 28 a No. 15 -09', 'jpdiaz.111@gmail.com', 2, '', 137, '2014-02-13 11:17:52', 72, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grupo_taxonomico`
--

CREATE TABLE IF NOT EXISTS `grupo_taxonomico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `grupo_taxonomico`
--

INSERT INTO `grupo_taxonomico` (`id`, `nombre`) VALUES
(2, 'Microorganismos'),
(3, 'Invertebrados'),
(4, 'Vertebrados'),
(5, 'Plantas'),
(6, 'Hongos'),
(7, 'Líquenes');

-- --------------------------------------------------------

--
-- Table structure for table `pqrs`
--

CREATE TABLE IF NOT EXISTS `pqrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `tipo_solicitud` int(11) DEFAULT NULL,
  `descripcion` text,
  `ruta_anexo` varchar(45) DEFAULT NULL,
  `respuesta` text,
  `estado` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `entidad_id` int(11) DEFAULT NULL,
  `registros_id` int(11) DEFAULT NULL,
  `fecha_respuesta` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pqrs`
--


-- --------------------------------------------------------

--
-- Table structure for table `registros`
--

CREATE TABLE IF NOT EXISTS `registros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Entidad_id` int(11) NOT NULL,
  `numero_registro` int(11) NOT NULL,
  `fecha_dil` datetime DEFAULT NULL,
  `fecha_prox` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '0',
  `tipo_coleccion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Registros_Entidad1_idx` (`Entidad_id`),
  KEY `fk_registros_tipo_coleccion1_idx` (`tipo_coleccion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `registros`
--

INSERT INTO `registros` (`id`, `Entidad_id`, `numero_registro`, `fecha_dil`, `fecha_prox`, `estado`, `tipo_coleccion_id`) VALUES
(8, 98, 133, '2014-02-14 15:15:31', '2016-02-14 10:15:31', 1, 1),
(9, 98, 187, '2014-02-14 15:17:38', '2016-02-14 10:17:38', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `registros_update`
--

CREATE TABLE IF NOT EXISTS `registros_update` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_act` datetime NOT NULL,
  `fecha_rev` datetime DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `acronimo` varchar(45) DEFAULT NULL,
  `fecha_fund` int(11) DEFAULT NULL,
  `descripcion` text,
  `direccion` varchar(150) DEFAULT NULL,
  `ciudad_id` varchar(11) DEFAULT NULL,
  `telefono` varchar(150) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `cobertura_tax` varchar(200) DEFAULT NULL,
  `cobertura_geog` varchar(200) DEFAULT NULL,
  `cobertura_temp` varchar(200) DEFAULT NULL,
  `listado_anexos` text,
  `info_adicional` text,
  `pagina_web` varchar(150) DEFAULT NULL,
  `redes_social` text,
  `comentario_obv` text,
  `estado` smallint(6) DEFAULT '1',
  `comentario` text,
  `registro_id` int(11) DEFAULT '0',
  `tamano_coleccion_total` int(11) DEFAULT '0',
  `tipo_coleccion_total` int(11) DEFAULT '0',
  `terminos` smallint(6) DEFAULT NULL,
  `deorreferenciados` float DEFAULT NULL,
  `sistematizacion` text,
  `contactos_id` int(11) NOT NULL,
  `dilegenciadores_id` int(11) NOT NULL,
  `registros_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Registros_update_contactos1_idx` (`contactos_id`),
  KEY `fk_Registros_update_dilegenciadores1_idx` (`dilegenciadores_id`),
  KEY `fk_Registros_update_registros1_idx` (`registros_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `registros_update`
--

INSERT INTO `registros_update` (`id`, `fecha_act`, `fecha_rev`, `nombre`, `acronimo`, `fecha_fund`, `descripcion`, `direccion`, `ciudad_id`, `telefono`, `email`, `cobertura_tax`, `cobertura_geog`, `cobertura_temp`, `listado_anexos`, `info_adicional`, `pagina_web`, `redes_social`, `comentario_obv`, `estado`, `comentario`, `registro_id`, `tamano_coleccion_total`, `tipo_coleccion_total`, `terminos`, `deorreferenciados`, `sistematizacion`, `contactos_id`, `dilegenciadores_id`, `registros_id`) VALUES
(9, '2014-02-14 14:45:10', '2014-02-14 15:15:31', 'Colecciones Zoológicas - Museo de la Salle- Bogotá ', 'MLS', 1904, 'SD', 'Universidad de la Salle - Sede Candelaria, Carrera 2 No. 10-70', '11001', '3535360 Ext. 2209 -2214', 'museo@lasalle.edu.co', 'SD', 'SD', 'SD', 'Formulario de actualización \r\nCertificado de existencia y representación legal \r\nFotocopia Cedula Ciudania \r\nListado Ejemplares\r\nCertificado deposito, prestamo, intercambio', 'SD', 'SD', NULL, NULL, 2, 'La actualización de la colección No. 133 Museo la Salle - Bogotá M.L.S fue realizada con exitó; \r\nLa fecha de su proxíma actualización es 20/12/2015\r\nSaludos Cordiales, \r\nAdministrador RNC ', 0, 0, 0, 1, 0, 'El proceso de sistematización e integración de datos se llevó a cabo como primera media en Excel, posteriormente las consultas se realizan sobre la base de datos MySQL del servidor Specify, usando herramientas como Acces y lebguaje SQL, Publicaciones ITP (SIB)', 9, 75, 8),
(10, '2014-02-14 15:03:47', '2014-02-14 15:17:38', 'Herbario Museo de la Salle - Bogotá ', 'BOG', 1913, 'SD', 'Universidad de la Salle - Sede Candelaria, Carrera 2 No. 10-70', '11001', '3535360 Ext. 2209 -2214', 'museo@lasalle.edu.co', 'SD', 'SD', 'SD', 'Formulario de actualización \r\nCertificado de existencia y representación legal \r\nFotocopia Cedula de Ciudadnia\r\nConstancia de deposito, permiso, intercambio \r\nListado ejemplares', 'SD', 'SD', NULL, NULL, 2, 'La actualización de la colección No. 187 Herbario Museo de la Salle - Bogotá BOG fue realizada con exitó \r\n\r\nSaludos Cordiales, \r\nAdministrador RNC \r\n', 0, 0, 0, 1, 0, 'El proceso de sistematización e integración de datos se llevó a cabo como primera media en Excel, posteriormente las consultas se realizan sobre la base de datos MySQL del servidor Specify, Usando herramientas como Access y lenguaje SQL, donde actualmente residen todos los registros de la colección', 10, 76, 9);

-- --------------------------------------------------------

--
-- Table structure for table `subgrupo_taxonomico`
--

CREATE TABLE IF NOT EXISTS `subgrupo_taxonomico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `grupo_taxonomico_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subgrupo_taxonomico_grupo_taxonomico1_idx` (`grupo_taxonomico_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `subgrupo_taxonomico`
--

INSERT INTO `subgrupo_taxonomico` (`id`, `nombre`, `grupo_taxonomico_id`) VALUES
(2, 'Otro', NULL),
(3, 'Bacterias', 2),
(4, 'Hongos microscópicos', 2),
(5, 'Levaduras', 2),
(6, 'Virus', 2),
(7, 'Perifiton', 2),
(8, 'Fitoplancton', 2),
(9, 'Zooplancton', 2),
(10, 'Otros microorganismos', 2),
(11, 'Insectos', 3),
(12, 'Crustáceos', 3),
(13, 'Anélidos', 3),
(14, 'Cnidarios', 3),
(15, 'Equinodermos', 3),
(16, 'Moluscos', 3),
(17, 'Otros invertebrados', 3),
(18, 'Otros artrópodos', 3),
(19, 'Anfibios', 4),
(20, 'Aves', 4),
(21, 'Mamíferos', 4),
(22, 'Peces', 4),
(24, 'Reptiles', 4),
(25, 'Plantas no vasculares', 5),
(26, 'Plantas vasculares', 5),
(27, 'Hongos', 6),
(28, 'Líquenes', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tamano_coleccion`
--

CREATE TABLE IF NOT EXISTS `tamano_coleccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `otro` varchar(250) DEFAULT NULL,
  `unidad_medida` varchar(500) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `Registros_update_id` int(11) NOT NULL,
  `tipo_preservacion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tamaño_coleccion_Registros_update1_idx` (`Registros_update_id`),
  KEY `fk_tamano_coleccion_tipo_preservacion1_idx` (`tipo_preservacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tamano_coleccion`
--

INSERT INTO `tamano_coleccion` (`id`, `otro`, `unidad_medida`, `Registros_update_id`, `tipo_preservacion_id`) VALUES
(7, 'SD', 'SD', 9, 22),
(8, 'SD', 'SD', 10, 22);

-- --------------------------------------------------------

--
-- Table structure for table `tipos_en_coleccion`
--

CREATE TABLE IF NOT EXISTS `tipos_en_coleccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo` varchar(150) DEFAULT NULL,
  `informacion_ejemplar` varchar(150) DEFAULT NULL,
  `nombre_cientifico` varchar(150) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `Registros_update_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tipos_en_coleccion_Registros_update1_idx` (`Registros_update_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tipos_en_coleccion`
--

INSERT INTO `tipos_en_coleccion` (`id`, `grupo`, `informacion_ejemplar`, `nombre_cientifico`, `cantidad`, `Registros_update_id`) VALUES
(6, 'SD', 'SD', 'SD', NULL, 9),
(7, 'SD', 'SD', 'SD', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_coleccion`
--

CREATE TABLE IF NOT EXISTS `tipo_coleccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tipo_coleccion`
--

INSERT INTO `tipo_coleccion` (`id`, `nombre`) VALUES
(1, 'Ninguna'),
(2, 'Archivo'),
(3, 'Arte'),
(4, 'Audio'),
(5, 'Cultivos Celulares'),
(6, 'Electrónico'),
(7, 'Especimenes'),
(8, 'Facsímiles'),
(9, 'Fósiles'),
(10, 'Genético'),
(11, 'Geolóo'),
(12, 'Herbario'),
(13, 'Manuscritos'),
(14, 'Mineralógico'),
(15, 'Observaciones'),
(16, 'Preservado'),
(17, 'Productos'),
(18, 'tejido'),
(19, 'Textos'),
(20, 'visual'),
(21, 'Vivos');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_institucion`
--

CREATE TABLE IF NOT EXISTS `tipo_institucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tipo_institucion`
--

INSERT INTO `tipo_institucion` (`id`, `nombre`) VALUES
(1, 'Ninguna'),
(2, 'Aquarium'),
(3, 'Archivo'),
(4, 'Biblioteca'),
(5, 'Centro de ciencias'),
(6, 'Centro de Educación Natural'),
(7, 'Conservación'),
(8, 'Escuela'),
(9, 'Escuela o institución universitaria'),
(10, 'Estación de campo'),
(11, 'Gestión'),
(12, 'Gobierno'),
(13, 'Industria'),
(14, 'Institución de Horticultura'),
(15, 'Instituto de investigación'),
(16, 'Jardín botánico'),
(17, 'Laboratorio'),
(18, 'Museo'),
(19, 'Parque'),
(20, 'Repositorio'),
(21, 'Sociedad'),
(22, 'Sociedad histórica'),
(23, 'Universidad'),
(24, 'Zoológico');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_preservacion`
--

CREATE TABLE IF NOT EXISTS `tipo_preservacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tipo_preservacion`
--

INSERT INTO `tipo_preservacion` (`id`, `nombre`) VALUES
(1, 'Atmósfera controlada'),
(2, 'Congelado'),
(3, 'Congelado seco'),
(4, 'Criopreservados'),
(5, 'Curtido'),
(6, 'Embedded'),
(7, 'Esqueletizado'),
(8, 'Glicerina'),
(9, 'Grabado (anólogo)'),
(10, 'Grabado (digital)'),
(11, 'Montaje en laminillas'),
(12, 'No aplica'),
(13, 'Pinned/Montaje en alfileres'),
(14, 'Portaobjetos - SEM2'),
(15, 'Preservado en fluídos'),
(16, 'Recubrimiento de la superficie'),
(17, 'Refrigerado'),
(18, 'Secado'),
(19, 'Secado y prensado'),
(20, 'Sin tratamiento'),
(21, 'Stasis3'),
(22, 'Otro');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=138 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'aescobar', '$2a$13$uP6q5/qOHqd0MYgpU/6Zku.vGdgjxZD8/AjGarlwfTMTItl9YeDc2', 'hescobar@humboldt.org.co', 'admin'),
(3, 'ksoacha', '$2a$13$XBXMDwDeQMf08o4ccfvmAOyM1/9GHHs2mB7wquUOz2o7rXvU66yVO', 'ksoacha@humboldt.org.co', 'admin'),
(37, 'jdiaz', '$2a$13$udykVqyw3K7LA0.QFCWlXuwQjxv5u3AOOn2/IZIEy3QG3b64PiqfS', 'jdiaz@humboldt.org.co', 'admin'),
(39, '80422824', '$2a$13$5PAq7ApISMiwKxR/K.4Y.e1YE6qRi./XJSapMeU8jqdJCny6A4KEu', 'alejandro.lopera@gmail.con', 'entidad'),
(40, '51899936', '$2a$13$LtoptMuAs/ld1rQqY2v0wOkm.jgQ/oiVgHUDaw8yGaNx3fUG3Qm4.', 'aamarill@hotmail.com', 'entidad'),
(41, '17096761', '$2a$13$F7rWh7rb5hthGMe3ssjYcuw4jBIFkS6mWWEvyHt5fgZDVHGGiVVZG', 'cesar_caicedo@yahoo.com', 'entidad'),
(42, '51820419', '$2a$13$/8NLBaoQPWjlj96TlAOReuvLukEfOkMgh59k8JLcguhpUlvr7NWgu', 'dnpadilla@udenar.edu.co', 'entidad'),
(43, '75073651', '$2a$13$7Iv/qzv0MubFusTjsH/yKu1y.2tB27r9htRhyZMYOw6WyfIeD4tBO', 'efrain.henao@ucaldas.edu.co', 'entidad'),
(44, '8705926', '$2a$13$xiINsmIvnOHD71rLd6QTD.rzlL4AXxrpFsKJ2iI3KvzwU6fAMC1ua', 'biologo@colombianshells.com', 'entidad'),
(45, '195524', '$2a$13$wkvAwk1WirhvoYaTywqAcuviAvA4Y8cloB6O5zq52HqF9VT27n6bG', 'hdahners@gmx.de', 'entidad'),
(46, '79631159', '$2a$13$OirUkSeM4NqIMntRi8uOwOLR3a482QiT6d3BoimLlDmATHGSMxd/.', 'jflecrom@cable.net.co', 'entidad'),
(47, '9971933', '$2a$13$3n/f/NkhSssh6r3iMvvId.Ak8YL4xEBt4wMvyIHw7AAcf2NTph3wm', 'joseignacio_05@yahoo.es', 'entidad'),
(48, '19426410', '$2a$13$qpx3hIvY9yya/O8PS0qNzuA2oViBl2UCKB1Qwa54grPSaxk7lSotO', 'jjalaverde@hotmail.com', 'entidad'),
(49, '10258548', '$2a$13$iHQOlCz89uXiv9h.7yl2iOqy6rqUzjR8x.wlAPq/ZqcCIVU1HztQm', 'julianadolfoster@gmail.com', 'entidad'),
(50, '16278561', '$2a$13$Bb4s4wCgVnMRZgqqKT42de0ieUybN05LYherRcpYCVlfDvXly0mgm', 'lcpardolocarno@yahoo.es', 'entidad'),
(51, '16682887', '$2a$13$l8Y24GQnEytkrGeAJBpVyeLx359NPA0MrbR8Loc0skIy8Qf7op5CK', 'luismiguel.constantino@hotmail.com', 'entidad'),
(52, '7471978', '$2a$13$PtGUxTWDzzDAw7LY2EV9W.IrHvcbLGUtiXz2muXEq3LMlP5krHS5W', 'oceanario@enred.com', 'entidad'),
(53, '14879086', '$2a$13$Ta0RZdYBxQ4WxE0/hkTFJOKX3YxbVgtAfWl3v6TyiYo.vHhvcQolG', 'rtorresn@colomsat.net.co', 'entidad'),
(54, '819005753', '$2a$13$EmAq1uVBWlcPSRpIvqZvWuAjZ.gKHBRv14H18ZdezxVv71xZZyi/.', 'acuariorodadero@gmail.com', 'entidad'),
(55, '900102156', '$2a$13$yj.1be87DqZrx/k5Kts1e.JgWXbShXJqg0N3nkCsoUy8hWDAdx4iO', 'aviarionacionalcolombia@yahoo.com', 'entidad'),
(56, '860007336', '$2a$13$mKz8iOHtLxj0n24TYYCQCe.YDUda/ncKnHSL4KFQ8nLVMtT7Gizgu', 'zoologico.piscilago@colsubsidio.com', 'entidad'),
(57, '890900842', '$2a$13$/v9bW0SPC7AHqP3/ktE55Oz/x5Ma2Y81Nb.Mv9g/zaj1q.Q2uLWZu', 'museoentomologico@comfenalcoantioquia.com', 'entidad'),
(58, '840000101 ', '$2a$13$R40ijZxVJygYosBD2vtAjuJtx2uQQ3YG0t1H33Ryz1sbqrfwYK0JO', 'jefcccp@dimar.mil.co', 'entidad'),
(59, '800034586', '$2a$13$sKVnFzuKSk8xCLtPbWmSFuYbGZh0wgUt/eERfO/9BIc4XwlGeHjFS', 'a.m.torres@cgiar.org', 'entidad'),
(60, '860009985', '$2a$13$OV7h2/q.rhNMoYgW3kRZLOMBpYJ07lflZXYeKISxYHr2LFRSdw0SG', 'museo@lasalle.edu.co', 'entidad'),
(61, '811000231', '$2a$13$TgQBj2gqm61ctTDPLsw1Vu3SMLS4trnYEY/NHwVEMa8RT4o3WHtSS', 'jtoro@corantioquia.gov.co', 'entidad'),
(62, '890000447 ', '$2a$13$d6zpMMhdV1wpHtiPZ8HhoubT4wDNTvnsa6bbo/fU5eITzrLudEh3i', 'crq@crq.gov.co', 'entidad'),
(63, '890201573 ', '$2a$13$MGZ7lfstESKGc/b1kLocE..vbe16Mc9myJ2Lm8eJpNNqPH0JC4jDm', 'jardin@cdmb.gov.co', 'entidad'),
(64, '890007626', '$2a$13$wrmfcH0ieaYvwrjM5ttkFuyq1i33Lrhwl93sSb3.f8QfN2WyAEKNO', 'jardinsanjorge@gmail.com', 'entidad'),
(65, '800145882 ', '$2a$13$w5GtBLHM/laKO4HTibkUmOiHDm7S.CFn5X0Lg4Nn1T2aummVp/xwW', 'jsanz@cenipalma.org', 'entidad'),
(66, '800194600 ', '$2a$13$LZObiCf85gDqf.3XSNTMEO3NvQzNbPQNnCKjUJoBPQBFnGQym6wlO', 'cgonzaleza@corpoica.org.co', 'entidad'),
(67, '830009610', '$2a$13$TCSB87sWpQljr22fL6gNW.cr.XC.5irYXz.FoeZo5SrCz0cXZBvKm', 'corpogen@corpogen.org', 'entidad'),
(68, '810005598 ', '$2a$13$ApAPaHcnmXLGY/DUf7ste.IGT.YaYNin2NK6fna3tQtMHuqfXxQwy', 'ecoparqueyarumos@epm.net.co', 'entidad'),
(69, '860042183 ', '$2a$13$d41Vo6m5HEUmkhd6dyBszOQYmlu1.Dz.9x6eJ9NbumuUXs6zliBLa', 'javerrodriguez@conif.org.co', 'entidad'),
(70, '805001728 ', '$2a$13$9sxBXagKSUv2kfc4yksJVehS2rtvliZMB8vyihQz/pJFvlBW7a4m.', 'usi3-biotec@cgiar.org', 'entidad'),
(71, '800252844 ', '$2a$13$4lodN61V8P/H7wAj2Hs/ue3hgaBuZ7wqtGLsGGcAVgmysi.w8rvwO', 'lrivera@corpoamazonia.gov.co', 'entidad'),
(72, '890908790', '$2a$13$IeXEBEFFu2F0gvXGFlN1KO9TnhPgIWFTUpsRoSZW6P/.Vvi93UjGi', 'j.zuluaga@cib.org.co', 'entidad'),
(73, '900145472 ', '$2a$13$0UF1vxGSCxoQuG3TzIqRxuX2iTOp1pQvna9iplif7KUbXSErBejfO', 'isabel.acero@parqueexplora.org', 'entidad'),
(74, '860403721', '$2a$13$RTrMIvqKMcn2iIx/bmjZq.l3PqBqgaK4BI5eE0hV6zVJUmK1iOxIu', 'ganzola@udca.edu.co', 'entidad'),
(75, '79373618', '$2a$13$FX3J.9rfu0odykHXJH8jV.tZgVr8TCQMXhHYQsOObT8PCyc/ZvbV2', 'cesarmiento@yahoo.com', 'entidad'),
(76, '890900286 ', '$2a$13$8To4BNyI7aJ9I6YcZCfydernv.sCEByCcCSUIDgJlij2sett/0ALq', 'gloriae@cis.net.co', 'entidad'),
(77, '899999094 ', '$2a$13$RGji2uColQyNdOOnlIB4.uBCpqehljCKbj7En/BUSFf4xZO090RtW', 'lasilva@acueducto.com.co', 'entidad'),
(78, '860007538 ', '$2a$13$/1qYG3rlFsY1Fd3PcuYhWOPx.lAVUBMDELUP6k.5E00Pn1K/RlOMe', 'cenicafe@cafedecolombia.com', 'entidad'),
(79, '800199708 ', '$2a$13$VBVSmxerZmitijJ7zMLMqOVqNpPU3YAT3DBU/5zjjfT8ModGBRf6W', 'zoobaq@metrotel.net.co', 'entidad'),
(80, '800125073 ', '$2a$13$JxC33twyIkOXgcbeFSKu7O1k5fS57NfSPydlAZA0BTEQ6kZjkD3eS', 'bioinfo@inmuno.org', 'entidad'),
(81, '800165375 ', '$2a$13$yDhVls4YSokpeNGnBNclbOpAeq1.3tCQUiemAAR/nKc44YgH1FwTO', 'cipav@cipav.org.co', 'entidad'),
(82, '832002142 ', '$2a$13$EOq141dSIJmtjjsnox7/6uDg1sVRUrMUZ.bYuCRVJrnNZHbEXHKdu', 'museogacheta@yahoo.com', 'entidad'),
(83, '890802259 ', '$2a$13$hW6P1eKFeVNKHBshwhNu1O4zkX95HgifEEB76Q5DCa2tKuHlu.XQ2', 'zoo@parquejaimeduque.com', 'entidad'),
(84, '890980756 ', '$2a$13$NTtpeh6sqCBgOS7hCgvLOu62fAE.h3WohmocwOZGuzP45OBey3i9O', 'alvaro.cogollo@botanicomedellin.org', 'entidad'),
(85, '805020553 ', '$2a$13$rhwapbxqqMfVJjhd1/p7remzCBr8sM9JOtL/S8m/AKOjvEhbkTSyu', 'jardinbocali@uniweb.net.co', 'entidad'),
(86, '890003578 ', '$2a$13$BurAvf1iY84ZGYqvKjXs9emYnL81Wv3owkjc0RVHB0UEKQQuMUFum', 'jardinbotanicoquindio@gmail.com', 'entidad'),
(87, '890480597 ', '$2a$13$8c7ozb9I5CM0yeOcmiY.tOVGyNLE9VYjnxkzMvtjtfoBDqud8c/fy', 'jarbotgpineres@ctgred.net.co', 'entidad'),
(88, '819004340', '$2a$13$/EJNEYDBINgKO2TAO1rph./ibIPiTxK6svzHs2PMHPSL/G1TRG74.', 'vludovica@hotmail.com', 'entidad'),
(89, '800954955 ', '$2a$13$ajqjaZGlGWweEuXkSSyNZuMWHVWfPa7p8/kG4K2HhR2M3UBAFrUOW', 'jbqspa@yahoo.es', 'entidad'),
(90, '891702613', '$2a$13$EHhqC08aPjoZh2dUJeZB6uJQUcNp257vMF4U3xS8FlkW73wUx2wly', 'mundomarino@utadeo.edu.co', 'entidad'),
(91, '860006848 ', '$2a$13$J5UPTpobJi32jS.QQmaj3e8jJtq.4jZeEAqAZf/K18B5Spju9pLN.', 'luz.fuentes@utadeo.edu.co', 'entidad'),
(92, '891501835 ', '$2a$13$ZAejOupHhzX3Qaco2QvhEOrwFGw1TbMPA4wTxgGaj3prgrTI4dmWm', 'jardinbotanico@fup.edu.co', 'entidad'),
(93, '800155085 ', '$2a$13$7RKMoKCRMwRJWabtdRaz5O/fD9yvFNUNapVr2oSk6JR9v.D05Y//y', 'yubarta@emcali.net.co', 'entidad'),
(94, '890318247 ', '$2a$13$y6niI8n1to22WzrRNfxxMu.ss33r1ldylPmzvPawSiHnfYEFb5Pgq', 'zoologico@zoologicodecali.com.co', 'entidad'),
(95, '830093363', '$2a$13$lS66sHvvcJA.bQhRi00.7ussDUfIwcXOWnMqbxIXraAtsaQuXsV/S', 'hmonsalve@zoosantacruz.org.co', 'entidad'),
(96, '860061110', '$2a$13$8uKoXYPUvPEBPk5R0p0EGOxI41pNNCdWyVqBnY4Q1megRf7DjoCta', 'herbario@sinchi.org.co', 'entidad'),
(97, '800082822 ', '$2a$13$aROsQtV2VS5RxGDGWLNW/Ohw2NsPf4.sWmnLopG9YhEOHuJyh.2Ge', 'gparra@ces.edu.co', 'entidad'),
(98, '899999063 ', '$2a$13$/GoLAwOZTEnovg.IIdvrHOOaQyiB5MbbJCFpQL/UfWjuVLHJ27cUq', 'mgandradec@unal.edu.co', 'entidad'),
(99, '820000142', '$2a$13$KUBvW2KhO.ukCur4OjNK1emVZ1VyNk.FBn3M5yXJ.eHPTLT2nz7Pi', 'coleccionesbiologicas@humboldt.org.co', 'entidad'),
(100, '800250062 ', '$2a$13$V7JQKwaQyd.TWEl86ImtrOxKhfbxHCAv4DWcPxkpWyDJP9KPzrgSK', 'giomar.borrero@invemar.org.co', 'entidad'),
(101, '899999403 ', '$2a$13$DyUJWVMXzLwhHpziCNuI3OQ..6ek4bsvhrDpzI/.K906UVcVW/PlW', 'fruiz@ins.gov.co', 'entidad'),
(102, '800086201 ', '$2a$13$TMmP.rbpgOP8a8NhtkeED.XpcUjDtFK7dHJaot9JVAidUScVYmGRm', 'mcn@inciva.gov.co', 'entidad'),
(103, '800214750', '$2a$13$1ercd9mlr7sGshaT13GMj./oUcLrvu5/vPiZ.pxVixI9Q8XjJiMk6', 'museodecienciasnaturales@itm.edu.co', 'entidad'),
(104, '860030197 ', '$2a$13$D5788sKMXhZR0fU2jvFjfOh6Q8n4IGRt2LCscHuhsCRO4Xc/vo5pO', 'bogotanico@jbb.gov.co', 'entidad'),
(105, '860013720 ', '$2a$13$HlX.cb.LNEnnyr9NFOn2xOxmkfM8jkA6RuWgZVZeIQOttjbt48Ue6', 'maldonadoj@javeriana.edu.co', 'entidad'),
(106, '891480071 ', '$2a$13$PWjWV1LTQagdJRAExpJPUOOkBT1kFCD7c.bdK30FSjemcKdiHB3fO', 'zoomate@pereira.multi.net.co', 'entidad'),
(107, '890904141 ', '$2a$13$l42qwyRH3fjgYZKhBJDp1OOnRXnmoLiX4ly0OtQLfxboWtjvB7/zG', 'zoostafe@une.net.co', 'entidad'),
(108, '890905419', '$2a$13$AZ8fCHIeAtluz3lRAdFAMOGkLlgdX01/xSF0PsRdmYW9ZR.HNZRxC', 'manalejo1781@gmail.com', 'entidad'),
(109, '890984746 ', '$2a$13$37Tj9Q7bz8GtG7ejxMzRIufxvMaKNgQ638n9rHkhkPLsNFxm4yDjK', 'gestambiental.jefe@uco.edu.co', 'entidad'),
(110, '890980040 ', '$2a$13$Kg6IerIuZGEF.pPwS1Bq8OyriNUVAUq1Hoxci6IYme3CPh4LNFU6G', 'museo@quimbaya.udea.edu.co', 'entidad'),
(111, '890801063', '$2a$13$jvZjVI0U9b8fKgDRIMmS1umzRbhdd7N8zytBvFw3IIayXIilPweFq', 'luis.alvalez@ucaldas.edu.co', 'entidad'),
(112, '891080031', '$2a$13$l7LQYkSGAJtVlxo.EH3Zeu4quYxckIw4F9JB60mnFBVM0YYxkUSey', 'herbario@unicordoba.edu.co', 'entidad'),
(113, '891190346', '$2a$13$npApyiryN6uP/4JTbUn9UeEK.AjxFYNlp/4XhDCwMnQjCZo2wjVwG', 'j.botanicouniamazonia@gmail.com', 'entidad'),
(114, '860075558', '$2a$13$kPGf8qCQXZad.wakY4EeyOnLQ2D1NI043Vl7vQDQZR8BiPpov.C9W', 'gloria.gonzalez@unisabana.edu.co', 'entidad'),
(115, '860007386 ', '$2a$13$njrhN6AadyIfUv88QxGAzOomZ7y8SOpjJiExeVcOMrv2cdlgqYAme', 'museo@uniandes.edu.co', 'entidad'),
(116, '892000757 ', '$2a$13$JwvJ8quJ6btEWOfQSIcJfug/2tJQ77yjl551aE.bBmM3URS4HZwtC', 'luzmila@unillanos.edu.co', 'entidad'),
(117, '800118954 ', '$2a$13$rSQCbSI3AWCEm21xSNA7eOdFDo.jBPT6Qq0Hvid/9jV04CNeF28Se', 'mgonzalez@udenar.edu.co', 'entidad'),
(118, '890501510', '$2a$13$MXJsNwsIOWXe8eY8oRbld.yA/eRwNdtxFZeU9FUBZ6U3PCKVU.nAu', 'hecasa@unipamplona.edu.co', 'entidad'),
(119, '890102257 ', '$2a$13$0EvlukaRDQ9agjn/UvEhROU.nCvlKWefgWg/meG8gPJCzkWxFAEuq', 'hcuadros@uniatlantico.edu.co', 'entidad'),
(120, '891500319 ', '$2a$13$OAKuH60lErScfO1.hCjayuJXbXGNBr96pXnDXhLspC.l1sl2K0dhW', 'unicauca.caup@gmail.com', 'entidad'),
(121, '891780111', '$2a$13$iIqmqeSgnguE.JIkjOeRLu22MQOB6a/Lt.80RvGYJmLJ/S9XFpdf6', 'molmarcol@gmail.com', 'entidad'),
(122, '890000432 ', '$2a$13$iQMjF.qJUJOz0E8QBkVWW.8IBUKaeZieQzkXx1kxYtAXidK31TapO', 'analucia@uniquindio.edu.co', 'entidad'),
(123, '890700640', '$2a$13$PtTHz93ZmmHdEBz98gCZFe5WBVpDro9KmOMS2LNqh5FpkE5FCY3pa', 'greinoso@ut.edu.co', 'entidad'),
(124, '890399010 ', '$2a$13$pMsA4IT6jYwQtslts4oUMuTT5N5wvkajoR6alVqMniwDZa4eeMYWS', 'entomologia@univalle.edu.co', 'entidad'),
(125, '899999230 ', '$2a$13$GuBzpRleGyGNO8nQrf4Ro.ruNbLrQuHXVhuXNZweouxEsovYM2ZHq', 'herbarioforestal@udistrital.edu.co', 'entidad'),
(126, '890901389 ', '$2a$13$c/QNv86K.lpxgqDeMWnhmu9151n7UlOubocz3BZiU4oqSO9PDY3lK', 'vvilleg2@eafit.edu.co', 'entidad'),
(127, '860066789', '$2a$13$lqxvKnd2FjcDuEdplmxfSeORC2l/fzrNekorAvILhKPU1OeAJ7OLm', 'biologia@unbosque.edu.co', 'entidad'),
(128, '890316745 ', '$2a$13$/UceBR4IdZnAJjmGvadAJuuO20H0iSOIg07GERT8665Ftd2mDXg5e', 'wgvargas@icesi.edu.co', 'entidad'),
(129, '890201213 ', '$2a$13$4B7/RnKhXKpy8nYur4EheOxA4fRrXibCbVJucpMY27rJL4.qAHqMW', 'mpramir@uis.edu.co', 'entidad'),
(130, '800225340 ', '$2a$13$0X8E/4JyCeytdZbHwyDPIOownJm7HlXUB0K8eDVpYjUBh6jc2Sq1O', 'cmedinab@umng.edu.co', 'entidad'),
(131, '891800330', '$2a$13$B7czzVt5wU9WvOJ3eB1eG.bxMV1mM/3VaGYsu2lr3NSiBvJ7BGzZO', 'herbario@uptc.edu.co', 'entidad'),
(132, '899999214 ', '$2a$13$5oRNrNkk756mPnkTUjDLs.i2sIMPJiKwu6iN.nsULopX39JtROWii', 'valbuena@pedagogica.edu.co', 'entidad'),
(133, '891180084 ', '$2a$13$MiIr3UanDbbTBTz/Ff0rH.s.iaSHJjf2gyb1mzswXCEGjlWlNEQGa', 'fllanos@usco.edu.co', 'entidad'),
(134, '891480035 ', '$2a$13$DZe.4pG.jtcZT65DLqHhmOu3kgf9R.J9UX4LnU657XDHSNoI8rFsy', 'jardinbotanico@utp.edu.co', 'entidad'),
(135, '891680089 ', '$2a$13$O.mbctvx8MO4k9Rm498xEunJjOFpBhSQpMPbYtJ.yWgDfLIt1tuC2', 'herbario@utch.edu.co', 'entidad'),
(136, '164516', '$2a$13$jOdiFEObNvqiwrbWmyWYdeo0jwR5WOgxmfoflA23e2KSqe4niBGP6', 'juanjhaad@yahoo.com', 'entidad'),
(137, '1024524343', '$2a$13$w6fqTU4YeVC6P4Gb5BC4kuMGuYYwAwtRP6J/5HdRj7Rn5BcRMvG76', 'jpdiaz.111@gmail.com', 'entidad');

-- --------------------------------------------------------

--
-- Table structure for table `visitas`
--

CREATE TABLE IF NOT EXISTS `visitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entidad` varchar(150) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `fecha_visita` datetime DEFAULT NULL,
  `concepto` text,
  `registros_id` int(11) DEFAULT NULL,
  `dilegenciadores_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_visitas_dilegenciadores1_idx` (`dilegenciadores_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `fk_archivos_Registros_update1` FOREIGN KEY (`Registros_update_id`) REFERENCES `registros_update` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `composicion_general`
--
ALTER TABLE `composicion_general`
  ADD CONSTRAINT `fk_composicion_general_grupo_taxonomico1` FOREIGN KEY (`grupo_taxonomico_id`) REFERENCES `grupo_taxonomico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_composicion_general_Registros_update1` FOREIGN KEY (`Registros_update_id`) REFERENCES `registros_update` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_composicion_general_subgrupo_taxonomico1` FOREIGN KEY (`subgrupo_taxonomico_id`) REFERENCES `subgrupo_taxonomico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `entidad`
--
ALTER TABLE `entidad`
  ADD CONSTRAINT `fk_entidad_dilegenciadores1` FOREIGN KEY (`dilegenciadores_id`) REFERENCES `dilegenciadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `registros`
--
ALTER TABLE `registros`
  ADD CONSTRAINT `fk_Registros_Entidad1` FOREIGN KEY (`Entidad_id`) REFERENCES `entidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_registros_tipo_coleccion1` FOREIGN KEY (`tipo_coleccion_id`) REFERENCES `tipo_coleccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `registros_update`
--
ALTER TABLE `registros_update`
  ADD CONSTRAINT `fk_Registros_update_contactos1` FOREIGN KEY (`contactos_id`) REFERENCES `contactos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Registros_update_dilegenciadores1` FOREIGN KEY (`dilegenciadores_id`) REFERENCES `dilegenciadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Registros_update_registros1` FOREIGN KEY (`registros_id`) REFERENCES `registros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subgrupo_taxonomico`
--
ALTER TABLE `subgrupo_taxonomico`
  ADD CONSTRAINT `fk_subgrupo_taxonomico_grupo_taxonomico1` FOREIGN KEY (`grupo_taxonomico_id`) REFERENCES `grupo_taxonomico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tamano_coleccion`
--
ALTER TABLE `tamano_coleccion`
  ADD CONSTRAINT `fk_tama??o_coleccion_Registros_update1` FOREIGN KEY (`Registros_update_id`) REFERENCES `registros_update` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tamano_coleccion_tipo_preservacion1` FOREIGN KEY (`tipo_preservacion_id`) REFERENCES `tipo_preservacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tipos_en_coleccion`
--
ALTER TABLE `tipos_en_coleccion`
  ADD CONSTRAINT `fk_tipos_en_coleccion_Registros_update1` FOREIGN KEY (`Registros_update_id`) REFERENCES `registros_update` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `fk_visitas_dilegenciadores1` FOREIGN KEY (`dilegenciadores_id`) REFERENCES `dilegenciadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
