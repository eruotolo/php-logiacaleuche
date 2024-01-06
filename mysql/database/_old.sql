-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-12-2023 a las 15:30:43
-- Versión del servidor: 5.7.39-42-log
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbeaag3s1tjjr4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta`
--

CREATE TABLE `acta` (
  `id_Acta` int(11) NOT NULL,
  `name_Acta` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `file_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `grado_Acta` int(11) DEFAULT NULL,
  `fecha_Acta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `acta`
--

INSERT INTO `acta` (`id_Acta`, `name_Acta`, `file_name`, `grado_Acta`, `fecha_Acta`) VALUES
(2, 'Acta Número 3', '7626-ACTA-30-03-2023.pdf', 1, '2023-03-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biblioteca`
--

CREATE TABLE `biblioteca` (
  `id_Libro` int(11) NOT NULL,
  `nombre_Libro` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `autor_Libro` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `file_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `grado_Libro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `biblioteca`
--

INSERT INTO `biblioteca` (`id_Libro`, `nombre_Libro`, `autor_Libro`, `file_name`, `grado_Libro`) VALUES
(1, 'Libro del Aprendiz', 'Oswald Wirth', '8069-ElLibroDelAprendiz.pdf', 1),
(2, 'El Libro del Compañero', 'Oswald Wirth', '7628-oswald-wirth-libro-del-compac3b1ero.pdf', 2),
(3, 'Los 21 Temas del Compañero Masón', 'Adolfo Terrones Benítez - Alfonso León García', '6246-los-21-temas-del-compaero-mason.pdf', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletin`
--

CREATE TABLE `boletin` (
  `id_Boletin` int(11) NOT NULL,
  `titulo_Boletin` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `file_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `grado_Boletin` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `boletin`
--

INSERT INTO `boletin` (`id_Boletin`, `titulo_Boletin`, `file_name`, `grado_Boletin`, `created_at`) VALUES
(1, 'Boletín Eternos Aprendices Nº1', '7433-Boletín Eternos Aprendices N°1.pdf', 1, '2023-03-28 01:56:28'),
(2, 'Boletín Eternos Aprendices Nº2', '8772-Boletín Eternos Aprendices N°2.pdf', 1, '2023-03-28 01:57:02'),
(3, 'Boletín Eternos Aprendices Nº3', '8448-Boletín Eternos Aprendices N°3.pdf', 1, '2023-03-28 01:57:13'),
(4, 'Boletín Eternos Aprendices Nº4', '7554-Boletín Eternos Aprendices N°4.pdf', 1, '2023-03-28 01:58:22'),
(5, 'Boletín Eternos Aprendices Nº5', '8785-Boletín Eternos Aprendices Nº5.pdf', 1, '2023-03-28 01:58:40'),
(6, 'Boletín Eternos Aprendices Nº6', '4383-Boletín Eternos Aprendices N°6.pdf', 1, '2023-03-28 01:59:01'),
(7, 'Boletín Eternos Aprendices Nº7', '1250-Boletín Eternos Aprendices N°7.pdf', 1, '2023-03-28 01:59:10'),
(8, 'Boletín Eternos Aprendices Nº8', '4001-Boletín Eternos Aprendices N°8.pdf', 1, '2023-03-28 01:59:19'),
(9, 'Boletín Eternos Aprendices Nº9', '6436-Boletín Eternos Aprendices N°9.pdf', 1, '2023-03-28 01:59:40'),
(10, 'Boletín Eternos Aprendices Nº10', '4550-Boletín Eternos Aprendices N°10.pdf', 1, '2023-03-28 01:59:48'),
(11, 'Boletín Eternos Aprendices Nº11', '6917-Boletín Eternos Aprendices N°11.pdf', 1, '2023-03-28 01:59:55'),
(12, 'Boletín Eternos Aprendices Nº12', '8411-Boletín Eternos Aprendices N°12.pdf', 1, '2023-03-28 02:00:08'),
(13, 'Boletín Eternos Aprendices Nº13', '2126-Boletín Eternos Aprendices Nº13.pdf', 1, '2023-03-28 02:00:25'),
(14, 'Boletín Eternos Aprendices Nº14', '8971-Boletín Eternos Aprendices Nº14.pdf', 1, '2023-03-28 02:00:35'),
(15, 'Boletín Eternos Aprendices Nº16', '5921-Boletín Eternos Aprendices Nº16.pdf', 1, '2023-03-28 02:01:20'),
(16, 'Boletín Eternos Aprendices Nº18', '3875-Boletín Eternos Aprendices Nº18.pdf', 1, '2023-03-28 02:01:30'),
(17, 'Boletín Construyendo las Gradas N°1', '9567-Boletín Construyendo las Gradas N°1.pdf', 2, '2023-03-28 11:01:05'),
(18, 'Boletín Construyendo las Gradas N°2', '6794-Boletín Construyendo las Gradas N°2.pdf', 2, '2023-03-28 11:02:25'),
(19, 'Boletín Construyendo las Gradas N°3', '7443-Boletín Construyendo las Gradas N°3.pdf', 2, '2023-03-28 11:02:39'),
(20, 'Boletín Construyendo las Gradas N°4', '1501-Boletín Construyendo las Gradas N°4.pdf', 2, '2023-03-28 11:02:53'),
(21, 'Boletín Construyendo las Gradas N°5', '3825-Boletín Construyendo las Gradas N°5.pdf', 2, '2023-03-28 11:03:09'),
(22, 'Boletín Construyendo las Gradas N°6', '5968-Boletín Construyendo las Gradas N°6.pdf', 2, '2023-03-28 11:03:25'),
(23, 'Boletín Construyendo las Gradas N°7', '3972-Boletín Construyendo las Gradas N°7.pdf', 2, '2023-03-28 11:03:37'),
(24, 'Boletín Construyendo las Gradas N°8', '9066-Boletín Construyendo las Gradas N°8.pdf', 2, '2023-03-28 11:03:57'),
(25, 'Boletín Construyendo las Gradas N°9', '2866-Boletín Construyendo las Gradas N°9.pdf', 2, '2023-03-28 11:04:10'),
(26, 'Boletín Construyendo las Gradas N°10', '9308-Boletín Construyendo las Gradas N°10.pdf', 2, '2023-03-28 11:04:21'),
(27, 'Boletín Construyendo las Gradas N°11', '6335-Boletín Construyendo las Gradas N°11.pdf', 2, '2023-03-28 11:04:36'),
(28, 'Boletín Construyendo las Gradas N°12', '9590-Boletín Construyendo las Gradas N°12.pdf', 2, '2023-03-28 11:05:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoryevent`
--

CREATE TABLE `categoryevent` (
  `id_Category` int(11) NOT NULL,
  `nombre_Category` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `categoryevent`
--

INSERT INTO `categoryevent` (`id_Category`, `nombre_Category`) VALUES
(1, 'Tenida de Primero'),
(2, 'Tenida de Segundo'),
(3, 'Tenida de Tercero'),
(4, 'Otro Evento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoryfeed`
--

CREATE TABLE `categoryfeed` (
  `id_Category` int(11) NOT NULL,
  `nombre_Category` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `categoryfeed`
--

INSERT INTO `categoryfeed` (`id_Category`, `nombre_Category`) VALUES
(1, 'Tenidas'),
(2, 'Camaras'),
(3, 'Eventos'),
(4, 'Noticias'),
(5, 'General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `commentsfeed`
--

CREATE TABLE `commentsfeed` (
  `id_Comment` int(11) NOT NULL,
  `user_Comment` int(11) DEFAULT NULL,
  `feed_Comment` int(11) DEFAULT NULL,
  `message_Comment` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `commentsfeed`
--

INSERT INTO `commentsfeed` (`id_Comment`, `user_Comment`, `feed_Comment`, `message_Comment`, `created_at`) VALUES
(1, 38, 5, 'Muy buena su actividad', '2023-12-07 18:03:35'),
(2, 38, 3, 'Felicito VH Edgardo muy bonita la hfoto cómo su pagina ', '2023-12-07 18:05:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documents`
--

CREATE TABLE `documents` (
  `id_Doc` int(11) NOT NULL,
  `name_Doc` varchar(150) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `date_Doc` date DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `documents`
--

INSERT INTO `documents` (`id_Doc`, `name_Doc`, `file_name`, `date_Doc`, `created_at`) VALUES
(1, 'Decreto Autorización Instalación Logia Caleuche N°250 ', '8733-AUTORIZA INSTALACIÓN LOGIA J Y P CALEUCHE 250.pdf', '2023-05-19', '2023-10-23 13:41:00'),
(2, 'Historia Logia En Instancia Caleuche', '6708-HISTORIA LOGIA EN INSTANCIA CALEUCHE.pdf', '2020-08-24', '2023-10-23 13:43:39'),
(3, 'Acta Instalación Logia En Instancia \"Caleuche\"', '3125-ACTA INSTALACION LOGIA EN INSTANCIA.pdf', '2021-10-21', '2023-10-23 13:44:46'),
(4, 'Primer Aniversario Logia En Instancia \"Caleuche\"', '9985-PRIMER  ANIVERSARIO LOGIA EN INSTANCIA.pdf', '2022-10-20', '2023-10-23 13:46:46'),
(5, 'Caleuche, ¿Qué debe significar para la masonería chiloense? ¿Qué nos falta por hacer?', '3057-Caleuche, qué significa para la masoneria chilota.pdf', '2023-03-23', '2023-10-23 13:48:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradadinero`
--

CREATE TABLE `entradadinero` (
  `id_Entrada` int(11) NOT NULL,
  `id_User` int(11) DEFAULT NULL,
  `entrada_Mes` varchar(16) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `entrada_Ano` varchar(16) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `entrada_Motivo` int(11) DEFAULT NULL,
  `entrada_Monto` decimal(10,2) DEFAULT NULL,
  `entrada_MovimientoFecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `entradadinero`
--

INSERT INTO `entradadinero` (`id_Entrada`, `id_User`, `entrada_Mes`, `entrada_Ano`, `entrada_Motivo`, `entrada_Monto`, `entrada_MovimientoFecha`) VALUES
(1, 30, 'Diciembre', '2023', 1, '43000.00', '2023-11-30'),
(2, 38, 'Diciembre', '2023', 5, '235050.00', '2023-12-07'),
(3, 36, 'Diciembre', '2023', 1, '43000.00', '2023-12-07'),
(4, 36, 'Enero', '2024', 1, '7000.00', '2023-12-08'),
(5, 28, 'Diciembre', '2023', 1, '43000.00', '2023-12-07'),
(6, 28, 'Enero', '2024', 1, '22000.00', '2023-12-08'),
(7, 38, 'Diciembre', '2023', 1, '43000.00', '2023-12-07'),
(8, 38, 'Enero', '2024', 1, '9000.00', '2023-12-08'),
(9, 43, 'Diciembre', '2023', 1, '39000.00', '2023-12-07'),
(10, 29, 'Diciembre', '2023', 1, '43000.00', '2023-12-07'),
(11, 29, 'Enero', '2024', 1, '9000.00', '2023-12-08'),
(12, 40, 'Diciembre', '2023', 1, '26000.00', '2023-12-07'),
(13, 46, 'Diciembre', '2023', 1, '43000.00', '2023-12-07'),
(14, 46, 'Enero', '2024', 1, '17000.00', '2023-12-08'),
(15, 7, 'Diciembre', '2023', 1, '43000.00', '2023-12-07'),
(16, 7, 'Enero', '2024', 1, '43000.00', '2023-12-08'),
(17, 30, 'Enero', '2024', 1, '43000.00', '2023-12-07'),
(18, 30, 'Febrero', '2024', 1, '22000.00', '2023-12-08'),
(19, 11, 'Noviembre', '2023', 4, '45700.00', '2023-11-23'),
(20, 11, 'Diciembre', '2023', 1, '19300.00', '2023-12-08'),
(21, 27, 'Noviembre', '2023', 1, '33000.00', '2023-11-30'),
(22, 27, 'Diciembre', '2023', 1, '43000.00', '2023-12-08'),
(23, 26, 'Diciembre', '2023', 1, '43000.00', '2023-12-07'),
(24, 26, 'Enero', '2024', 1, '9000.00', '2023-12-08'),
(25, 36, 'Diciembre', '2023', 5, '17340.00', '2023-12-12'),
(26, 7, 'Febrero', '2024', 1, '43000.00', '2023-12-14'),
(27, 7, 'Marzo', '2024', 1, '43000.00', '2023-12-14'),
(28, 7, 'Abril', '2024', 1, '43000.00', '2023-12-14'),
(29, 7, 'Mayo', '2024', 1, '43000.00', '2023-12-14'),
(30, 7, 'Junio', '2024', 1, '43000.00', '2023-12-14'),
(31, 7, 'Julio', '2024', 1, '43000.00', '2023-12-14'),
(32, 7, 'Agosto', '2024', 1, '43000.00', '2023-12-14'),
(33, 7, 'Septiembre', '2024', 1, '43000.00', '2023-12-14'),
(34, 7, 'Octubre', '2024', 1, '43000.00', '2023-12-14'),
(35, 7, 'Noviembre', '2024', 1, '43000.00', '2023-12-14'),
(36, 7, 'Diciembre', '2024', 1, '43000.00', '2023-12-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradamotivo`
--

CREATE TABLE `entradamotivo` (
  `id_Motivo` int(11) NOT NULL,
  `name_Motivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `entradamotivo`
--

INSERT INTO `entradamotivo` (`id_Motivo`, `name_Motivo`) VALUES
(1, 'Cuota'),
(2, 'Derechos ingreso'),
(3, 'Derechos aumento salario'),
(4, 'Derechos exaltación'),
(5, 'Otros aportes ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id_Evento` int(11) NOT NULL,
  `nombre_Evento` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `trabajo_Evento` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_Evento` date DEFAULT NULL,
  `inicio_Evento` time DEFAULT NULL,
  `fin_Evento` time DEFAULT NULL,
  `cat_Evento` int(11) DEFAULT NULL,
  `estado_Evento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id_Evento`, `nombre_Evento`, `trabajo_Evento`, `fecha_Evento`, `inicio_Evento`, `fin_Evento`, `cat_Evento`, `estado_Evento`) VALUES
(1, 'Tenida 1°', 'Mensaje del VM:. \"Desafíos de la FrancMasonería\"', '2023-03-09', '20:00:00', '23:59:00', 1, 1),
(2, 'Tenida 2°', 'La Lógica', '2023-03-16', '20:00:00', '23:59:00', 2, 1),
(3, 'Tenida 1°', 'El Ritual en función del Rito; Conceptos y aspectos masónicos', '2023-03-30', '20:00:00', '23:59:00', 1, 1),
(4, 'Tenida 1°', 'Integración Americana', '2023-04-13', '20:00:00', '23:59:00', 1, 1),
(5, 'Tenida 2°', 'La verdad como concepto masónico', '2023-04-20', '20:00:00', '23:59:00', 2, 1),
(6, 'Tenida 1°', 'La Exaltación del Trabajo Masónico; Actividad de Realización Moral, Social y Progresista.', '2023-05-04', '20:00:00', '23:59:00', 1, 1),
(7, 'Tenida 2ª', 'El Concepto de Pueblo', '2023-09-21', '20:00:00', '23:59:00', 2, 1),
(8, 'Tenida 1ª', 'Las Pruebas Iniciáticas; Purificaciones', '2023-09-14', '20:00:00', '23:59:00', 1, 1),
(9, 'Tenida 3º', 'Reunión Administrativa.', '2023-09-28', '20:00:00', '23:59:00', 3, 1),
(10, 'Tenida 2º', 'Asistencia Fraternal a los Hermanos', '2023-10-05', '20:00:00', '23:59:00', 2, 1),
(11, 'Tenida 1º', 'Encuentro de dos Mundos', '2023-10-12', '20:00:00', '23:59:00', 1, 1),
(12, 'Tenida 1º', 'Aniversario Logia Caleuche 250', '2023-10-19', '20:00:00', '23:59:00', 1, 1),
(13, 'Tenida 3º', 'Objetivos y Futuro de la Logia Caleuche 250', '2023-10-26', '20:00:00', '23:59:00', 3, 1),
(14, 'Tenida 2º', 'Fiesta del Compañero', '2023-11-02', '20:00:00', '23:59:00', 2, 1),
(15, 'Tenida 1º', 'Fiesta del Aprendiz', '2023-11-09', '20:00:00', '23:59:00', 1, 1),
(16, 'Tenida 3º', 'Fiesta del Maestro', '2023-11-16', '20:00:00', '23:59:00', 3, 1),
(17, 'Tenida 3º', 'Elecciones de Oficiales', '2023-11-23', '20:00:00', '23:59:00', 3, 1),
(18, 'Tenida 1º', 'Reunión Fraternal', '2023-11-30', '20:00:00', '23:59:00', 1, 1),
(19, 'Tenida 1º', 'Conmemoración Declaración Universal de los Derechos Humanos.', '2023-12-07', '20:00:00', '23:59:00', 1, 1),
(20, 'Tenida 1º', 'Solsticio de Verano', '2023-12-15', '20:00:00', '23:59:00', 1, 1),
(21, 'Tenida 1º', 'Instalación Nueva Oficialidad (2024-2025)', '2023-12-13', '20:00:00', '23:59:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feed`
--

CREATE TABLE `feed` (
  `id_Feed` int(11) NOT NULL,
  `titulo_Feed` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `category_Feed` int(11) DEFAULT NULL,
  `file_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cont_Feed` varchar(3000) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_Feed` int(11) DEFAULT NULL,
  `estado_Feed` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `feed`
--

INSERT INTO `feed` (`id_Feed`, `titulo_Feed`, `category_Feed`, `file_name`, `cont_Feed`, `user_Feed`, `estado_Feed`, `created_at`) VALUES
(1, 'Testing 1', 1, '1145-testing-02.png', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 11, 0, '2023-04-17 20:19:53'),
(2, 'Testing 2', 1, '1776-testing-02.png', 'Prueba Blog', 11, 0, '2023-04-18 02:42:08'),
(3, 'Primera Iniciación', 1, '4038-WhatsApp Image 2023-09-08 at 14.58.16.jpeg', 'Iniciación del QH:. José Álvaro Águila Seguel', 11, 1, '2023-09-08 22:11:32'),
(4, 'Primera Fiesta Blanca', 1, '2604-tenida-blanca.jpeg', 'El 21 de octubre de 2023, festejamos nuestra primera Fiesta Blanca.', 11, 1, '2023-10-22 22:59:40'),
(5, 'Ágape post Fiesta Blanca', 3, '1727-post-fiesta-blanca.jpeg', 'Ágape post Nuestra Primera Fiesta Blanca, anfitriones Flia. Torres.', 11, 1, '2023-10-22 23:07:34'),
(6, 'RL \"Estrella Insular\" Nº 78 de Ancud conmemora 82º aniversario', 3, '6548-estrella78.jpeg', 'En su octogésimo segundo aniversario de la RL \"Estrella Insular\" Nº 78 de Ancud, en solemne Tenida, dirigida por su VM Ernesto Solís Romero, contó con presencia del GDJ del GM, Marco Vargas Gallardo; el VM de la RL \"Caleuche\" Nº 250 del valle de Castro, Francisco Torres Osorio, quien fue acompañado por una delegación de QQHH Maestros y Aprendices. ', 11, 1, '2023-10-14 02:10:25'),
(7, 'Primera Fiesta del Aprendiz', 1, '5202-aprendizfiesta.jpg', 'Primera Fiesta del Aprendiz como Logia Justa y Perfecta.', 11, 1, '2023-12-09 05:02:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id`, `file_name`, `uploaded_on`) VALUES
(1, 'Prueba Edgardo.pdf', '2023-03-03 18:10:03'),
(2, 'Prueba Edgardo.pdf', '2023-03-03 21:02:16'),
(3, 'ejemplo-02.png', '2023-03-05 18:50:54'),
(4, 'ejemplo-01.jpeg', '2023-03-05 18:50:54'),
(5, 'ejemplo-03.jpg', '2023-03-05 18:50:59'),
(6, 'Boletín Eternos Aprendices N°1.pdf', '2023-03-27 23:42:25'),
(7, 'Boletín Eternos Aprendices N°1.pdf', '2023-03-27 23:52:08'),
(8, 'Boletín Eternos Aprendices N°1.pdf', '2023-03-27 23:54:53'),
(9, 'Boletín Eternos Aprendices N°1.pdf', '2023-03-27 23:57:51'),
(10, 'Boletín Eternos Aprendices N°1.pdf', '2023-03-28 00:01:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id` int(11) NOT NULL,
  `grado_nombre` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id`, `grado_nombre`) VALUES
(1, 'Aprendiz'),
(2, 'Compañero'),
(3, 'Maestro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

CREATE TABLE `message` (
  `id_Message` int(11) NOT NULL,
  `from_Message` int(11) DEFAULT NULL,
  `to_Message` int(11) DEFAULT NULL,
  `subject_Message` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `content_Message` varchar(400) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `date_Message` datetime DEFAULT CURRENT_TIMESTAMP,
  `status_Message` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `message`
--

INSERT INTO `message` (`id_Message`, `from_Message`, `to_Message`, `subject_Message`, `content_Message`, `date_Message`, `status_Message`) VALUES
(1, 28, 28, 'Mensaje de Cumpleaños', 'Que tengas un muy buen Feliz Cumpleaños!!!', '2023-04-18 18:27:10', 1),
(2, 11, 31, 'Mensaje de Cumpleaños', 'Que tengas un muy buen Feliz Cumpleaños!!!', '2023-09-08 21:44:28', 0),
(3, 11, 31, 'Mensaje de Cumpleaños', 'Que tengas un muy buen Feliz Cumpleaños!!!', '2023-09-08 21:44:34', 0),
(4, 28, 7, 'Mensaje de Cumpleaños', 'Que tengas un muy buen Feliz Cumpleaños!!!', '2023-10-06 17:10:11', 0),
(5, 28, 7, 'Mensaje de Cumpleaños', 'Que tengas un muy buen Feliz Cumpleaños!!!', '2023-10-11 13:07:18', 0),
(6, 38, 7, '', 'Felicito al gestor de esta página muy bonita como\r\nQuedarán recuerdos para los que vienen\r\nOscar Gómez B', '2023-12-07 18:06:21', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id_Noticia` int(11) NOT NULL,
  `titulo_Noticia` varchar(255) CHARACTER SET utf8 NOT NULL,
  `img_Noticia` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ext_Noticia` varchar(255) CHARACTER SET utf8 NOT NULL,
  `des_Noticia` text CHARACTER SET utf8 NOT NULL,
  `gallery` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_User` int(11) DEFAULT NULL,
  `id_Categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id_Noticia`, `titulo_Noticia`, `img_Noticia`, `ext_Noticia`, `des_Noticia`, `gallery`, `created_at`, `id_User`, `id_Categoria`) VALUES
(4, 'Testing 4', '../uploads/noticias/5887-02.jpeg', 'Prueba testing 4', 'Testing 4 prueba testing 4', '../uploads/noticias/01.jpeg,../uploads/noticias/03.png,../uploads/noticias/04.png,', '2023-03-13 00:38:43', 7, 2),
(5, 'Lunes 13 prueba', '../uploads/noticias/7524-01.jpeg', 'Prueba de lunes 13 y dia de clases', 'Prueba de lunes 13 y dia de clases Prueba de lunes 13 y dia de clases\r\nPrueba de lunes 13 y dia de clases', '../uploads/noticias/02.jpeg,../uploads/noticias/03.png,../uploads/noticias/04.png,', '2023-03-13 10:03:58', 7, 2),
(6, 'testing', '../uploads/noticias/6531-WhatsApp Image 2022-11-30 at 12.40.07.jpeg', 'saDSAFDSFSDAFSDFDSAF', 'DSAFASDFDSAFASDFSDAFSDAFSDA', '../uploads/noticias/WhatsApp Image 2022-11-30 at 12.40.07.jpeg,', '2023-03-27 20:33:48', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias_category`
--

CREATE TABLE `noticias_category` (
  `id_Categoria` int(11) NOT NULL,
  `name_Categoria` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `noticias_category`
--

INSERT INTO `noticias_category` (`id_Categoria`, `name_Categoria`) VALUES
(1, 'Publicas'),
(2, 'Internas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficiales`
--

CREATE TABLE `oficiales` (
  `id_Oficial` int(11) NOT NULL,
  `nombre_Oficial` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `oficiales`
--

INSERT INTO `oficiales` (`id_Oficial`, `nombre_Oficial`) VALUES
(1, 'Ninguno'),
(2, 'Venerable Maestro'),
(3, 'Primer Vigilante'),
(4, 'Segundo Vigilante'),
(5, 'Orador'),
(6, 'Secretario'),
(7, 'Tesorero'),
(8, 'Hospitalario'),
(9, 'Maestro de Ceremonia'),
(10, 'Maestro Experto'),
(11, 'Guarda Templo'),
(12, 'Maestro de Banquetes'),
(13, 'Maestro de Armonía'),
(14, 'Ex-Venerable Maestro'),
(15, 'Bibliotecario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidadinero`
--

CREATE TABLE `salidadinero` (
  `id_Salida` int(11) NOT NULL,
  `id_User` int(11) DEFAULT NULL,
  `salida_Mes` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `salida_Ano` varchar(16) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `salida_Motivo` int(11) DEFAULT NULL,
  `salida_Monto` decimal(10,2) DEFAULT NULL,
  `salida_MovimientoFecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `salidadinero`
--

INSERT INTO `salidadinero` (`id_Salida`, `id_User`, `salida_Mes`, `salida_Ano`, `salida_Motivo`, `salida_Monto`, `salida_MovimientoFecha`) VALUES
(1, 28, 'Diciembre', '2023', 1, '62000.00', '2023-12-07'),
(2, 11, 'Diciembre', '2023', 13, '14.00', '2023-12-07'),
(3, 28, 'Diciembre', '2023', 1, '194000.00', '2023-12-12'),
(4, 11, 'Diciembre', '2023', 13, '300.00', '2023-12-12'),
(5, 28, 'Diciembre', '2023', 1, '7080.00', '2023-12-13'),
(6, 11, 'Diciembre', '2023', 13, '300.00', '2023-12-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidamotivo`
--

CREATE TABLE `salidamotivo` (
  `id_SalidaMotivo` int(11) NOT NULL,
  `name_SalidaMotivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `salidamotivo`
--

INSERT INTO `salidamotivo` (`id_SalidaMotivo`, `name_SalidaMotivo`) VALUES
(1, 'Ágape Primer Grado'),
(2, 'Ágape Segundo Grado'),
(3, 'Ágape Tercer Grado'),
(4, 'Pago Cuota G:. L:. D:. Ch:.'),
(5, 'Implementos Aprendiz'),
(6, 'Implementos Compañeros'),
(7, 'Implementos Maestros'),
(8, 'Insumos Logia, Velas, fósforos,etc.'),
(9, 'Arriendo'),
(10, 'Leña'),
(11, 'Viajes Columnas'),
(12, 'Camaras En Conjunto'),
(13, 'Comisión Banco'),
(14, 'Otros Gastos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trazado`
--

CREATE TABLE `trazado` (
  `id_Trazado` int(11) NOT NULL,
  `name_Trazado` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `file_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `autor_Trazado` int(11) DEFAULT NULL,
  `grado_Trazado` int(11) DEFAULT NULL,
  `fecha_Trazado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `trazado`
--

INSERT INTO `trazado` (`id_Trazado`, `name_Trazado`, `file_name`, `autor_Trazado`, `grado_Trazado`, `fecha_Trazado`) VALUES
(1, 'El Ritual en función del Rito; Conceptos y aspectos masónicos', '2228-el_ritual_en funsion_del rito_conceptos _y _aspectos masonicos.pdf', 26, 1, '2023-03-30'),
(4, 'El Símbolo de la Razón', '4123-El Símbolo de la Razón - QH Edgardo Ruotolo.pdf', 11, 2, '2022-07-29'),
(5, 'El Número Cinco', '5994-El numero cinco.pdf', 11, 2, '2022-05-30'),
(6, 'El Paso de la Perpendicular al Nivel', '9825-ElPasodelaPerpendicularalNivel.pdf', 28, 2, '2023-03-28'),
(7, 'Las Pruebas Iniciáticas; Purificaciones', '4137-La Pruebas Iniciaticas_Purificaciones.pdf', 36, 1, '2023-09-14'),
(8, 'Dia del maestro patrocinador', '5047-Dia del maestro patrocinador.pdf', 38, 1, '2023-07-06'),
(9, 'Mandil, Mazo y Cincel', '9209-Mandil, Mazo y cincel..pdf', 27, 1, '2023-07-27'),
(10, '¿De donde vengo?', '9009-De donde vengo.pdf', 26, 1, '2023-08-17'),
(11, 'El hombre como ser social', '4836-El hombre como ser social.pdf', 11, 2, '2023-08-31'),
(13, 'Deberes y Derechos del Compañero Masón', '3335-Deberes y Derechos del Compañero Masón.pdf', 11, 2, '2023-07-26'),
(14, 'Teología', '7309-Teología.pdf', 11, 2, '2023-06-22'),
(15, 'El Trivium y el Quadrivium', '1769-El Trivium y el Quadrivium.pdf', 30, 2, '2023-06-28'),
(16, 'Meliorismo', '1012-MELIORISMO CALEUCHE ABRIL 2023.pdf', 28, 2, '2023-07-05'),
(17, 'Los viajes misteriosos', '2512-Los Viajes Misteriosos - Ernesto Soliz R.pdf', 41, 2, '2023-07-13'),
(18, 'Las herramientas del compañero', '4048-LAS HERRAMIENTAS DEL COMPAÑERO MASON CALEUCHE AGOSTO 2023.pdf', 28, 2, '2023-08-02'),
(19, 'Amos, Cap. 7. Versículo 7 y 8; Análisis Filosófico', '9651-Amos7-7y7-8.pdf', 30, 2, '2023-08-03'),
(20, 'El Símbolo de la Razón', '8473-El símbolo de la razón.pdf', 11, 2, '2023-08-09'),
(21, 'La posición de la escuadra y el compás', '1657-La posición de la escuadra y el compás revisado.pdf', 30, 2, '2023-08-16'),
(22, 'Sois compañero masón', '6858-sois compañero mason Caleuche 2023 (1).pdf', 28, 2, '2023-08-23'),
(23, 'El ritual de apertura y cierre en el Grado de Compañero', '8276-El ritual de apertura y cierre.pdf', 30, 2, '2023-09-13'),
(24, 'Concepto de Pueblo', '6904-CONCEPTO DE PUEBLO 2023.pdf', 28, 2, '2023-09-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `useremail` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `image` text,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `date_birthday` date DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `date_initiation` date DEFAULT NULL,
  `date_salary` date DEFAULT NULL,
  `date_exalted` date DEFAULT NULL,
  `grado` int(11) DEFAULT NULL,
  `oficialidad` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `useremail`, `username`, `password`, `token`, `image`, `name`, `lastname`, `date_birthday`, `phone`, `address`, `city`, `category`, `date_initiation`, `date_salary`, `date_exalted`, `grado`, `oficialidad`, `estado`, `created_at`) VALUES
(7, 'ftorres@gmail.com', '7266082K', '$2y$10$1EAumtigqF6S5oEM5JiiLemy4Cdsi4fKPDXha7V.JXBIFRsqeSTVy', '754bcf4b23f6b6f887e30182f22ac0b7bd577256d26e7e744546ac8403ee855a3aa236909dd98571731913e85f8dd1b1e7c9', '7753-2767-avatar-9.jpg', 'Francisco', 'Torres Osorio', '1957-10-11', NULL, NULL, 'Castro', 3, NULL, NULL, NULL, 3, 2, 1, '2020-09-24 17:53:37'),
(11, 'edgardoruotolo@gmail.com', '270396356', '$2y$10$LwtNT7yid7zNfnkxyHF5/.YoStWcvRo08HBOYtc.cYlF1hHb/.nuy', '253ef9c81e64fb44bd4830151234619ce94c58a66a7c2212991242006a944d462a112c76720ce98a173e86a93f2119ffb795', '4969-7869-avatar-4.jpg', 'Edgardo', 'Ruotolo Cardozo', '1983-04-25', '967553841', 'Antonio Guarategua Lebeck (Nercon)', 'Castro', 1, '2019-11-09', '2022-04-08', '2023-11-23', 3, 7, 1, '2023-03-02 12:40:19'),
(26, 'psi.pabloadrianss@gmail.com', '157128019', '$2y$10$5YjzvrezkmBg/R62AARPWe4tijAU76XMxLbu01yJNPfH43WI0bSL2', '24a7a164b5de597b8431f92eb3b042d84f93772bb3bc4984103ad4fed58e04a67cdef8195f45887ef4767387b44b7e8f1edd', '8431-psilva.png', 'Pablo', 'Silva Silva', '1984-03-06', '978340416', 'Rotonda de Chonchi', 'Chonchi', 3, '2022-04-04', NULL, NULL, 1, 1, 1, '2023-03-31 17:56:36'),
(27, 'isegovia526@gmail.com', '135943363', '$2y$10$nkV89kkMNzy3MGTMkXZcF.gAqgjQSJVgX8BgNi6dexCRhbNfmDRdG', 'b1bbff84a096f6506e6b78b8d55f7c1fdbdfa41316c36aa72b6de943ebed9c56d303007b424e113c6d7a04b461d16db61a3e', '1892-ivan-segovia.jpg', 'Ivan', 'Segovia Barria', '1979-04-19', '984085189', NULL, 'Chonchi', 3, '2022-04-04', NULL, NULL, 1, 1, 1, '2023-04-01 00:15:01'),
(28, 'fdo3012@gmail.com', '103459567', '$2y$10$vqWTixNz5tPGhIV34pS2uutjGoN9aPVCgwg/5z6Pgxwf.8RlWmlxa', 'dacd0d82d4fc80abf3f5eabdb0d6000a73b7179093ad72126d44d6b9130a75786518a63f4c152e83b4849e635e748f726fc0', '9762-fduran.jpg', 'Fernando', 'Durán Salas', '1966-12-30', '994536569', 'Camino a la playa parcela n° 3 Llau Llao', 'Castro', 3, '2008-10-17', '2012-04-20', '2023-09-28', 3, 12, 1, '2023-04-01 00:20:16'),
(29, 'pedromartinezbarria@gmail.com', '67572637', '$2y$10$T1nPPbtxypUXxzf4rt1ZXuCvbt3.0TEJ/wmE9nJeopmWTBEaa63ey', 'cd24514fcb44063df2fc8a50f2289f557057eab34cbc21145ca7a6a95f7927b7ca1653a817b31aecb918072af11d413d2caf', '5878-IMG_3362.jpg', 'Pedro', 'Martinez Barria', '1952-08-07', '998836378', NULL, 'Castro', 3, NULL, NULL, NULL, 3, 3, 1, '2023-04-03 20:58:08'),
(30, 'ps.rubencelis@gmail.com', '106289050', '$2y$10$KmAKtnxe6Wa/2QS5PTwx6OdQTiBkyPiu76ZwVx.6PCqZ0YMWYHZ3.', '195f47e56fd7e9272e4f2e8bb0ac6c3a4571b15a5f2af8afbcdb622e77244a73897be03ad707c99d6df57d115f33232a0b23', '3816-rube-celis.jpeg', 'Rubén', 'Celis Schneider', '1973-03-01', '993372895', 'Av. Francia 1720, Ed. 4, Dep. 505', 'Osorno', 2, '2018-04-02', '2022-05-09', '2023-11-23', 3, 10, 1, '2023-04-17 19:47:28'),
(31, 'ctorresmarquez@gmail.com', '129978120', '$2y$10$0uuxydQVpIgcSf6B.8RmGOyBqRwxnc18NJMB.Kvi7A6sUjmX8mohe', '6b44e42bffa2e81f1233016234cff7a24e1270f2418df83e8d2e1797bd0a8162c761a94301125ff8d2376a399107d20d475e', '9812-288228081_2854709684674296_7511592915573018582_n.jpg', 'Cristian', 'Torres Márquez', '1976-09-19', '988890267', NULL, 'Chonchi', 2, NULL, NULL, NULL, 3, 4, 1, '2023-04-18 16:05:25'),
(32, 'erasmopizarrod@gmail.com', '37558249', '$2y$10$ZvCgd8NxvZIUc.OTmoZ3jepVlKBS8C19d9x0daniKn0iyJDAV8eU.', 'e84ceeb6f2e3941e54ad5a9b34e57c468ec370eebad2ac406a6423ab91769bbf2a521cf5b5ab91a047ac7fe20f6e3548e543', '4817-default.jpg', 'Erasmo', 'Pizarro Díaz', '1938-01-15', NULL, NULL, 'Castro', 3, NULL, NULL, NULL, 3, 1, 1, '2023-09-09 18:00:10'),
(33, 'hcmb40@yahoo.es', '45127850', '$2y$10$Zcwn2.zwr8rN.IcXlYJdxOSe8ufqt4zVmrr/M37CMcn/EDtyTzDR2', 'c86d89a162b80bf1f89849966f92a0fe7a395eddb761089e809b54c9f4c6657a12a8a288cb4956f2a3feadef0e2120fb05b6', '9217-default.jpg', 'Hector', 'Muñoz Bustamante', '1940-06-06', NULL, NULL, 'Castro', 3, NULL, NULL, NULL, 3, 1, 1, '2023-09-09 18:07:22'),
(34, 'pnar854@gmail.com', '50020428', '$2y$10$EPfcjXTCdG5WhKB7Sd6yNOdoBVgx3B6bYmmc6w9rmaXEsaSU5iqyK', '95bf7e6a95c4a2bfc03f5a273e024604ba4ae9d433155bf5ed37cbb1972b92ebfbe057a4ba0ab3db447a9c2eb55f21e623b0', '5479-default.jpg', 'Pedro', 'Alvarez Rivera', NULL, NULL, NULL, 'Castro', 3, NULL, NULL, NULL, 3, 8, 1, '2023-09-09 18:08:44'),
(35, 'andrade1952@gmail.com', '55348030', '$2y$10$zKNVoWMZUwHVwPI90LW3b.qdjIb85kwmmNkz.0ByC3P0cIx7eJLqS', 'e5e34e7a0e372b141e6afa77bde36c4a60e662399829a26128ab44a7e81f334a424474f1890357ab9184d1f8afd3095e6978', '7875-default.jpg', 'Ramón', 'Andrade Pinochet', '1952-01-21', NULL, NULL, 'Castro', 3, NULL, NULL, NULL, 3, 1, 1, '2023-09-09 18:10:14'),
(36, 'pbravoc@yahoo.es', '62747706', '$2y$10$0VUE9ijjVe5IC722qe2Gx.KWzjt2lfXoeGsOiTByRD8J3eEqgHtL2', '29c452067bb50c013f42deaacf3c72bd0ab5f5f8e0a1d7aa7ebf095c84b8f803eb19f741021eeb4b5fbdbce07e866ce9b98e', '3957-default.jpg', 'Pedro', 'Bravo Crisostomo', '1950-08-06', NULL, NULL, 'Castro', 3, NULL, NULL, NULL, 3, 9, 1, '2023-09-09 18:11:57'),
(37, 'diezytriunfo@hotmail.com', '37509698', '$2y$10$PCZTwrKQ3p8PXVM.QGWhVOz86gXJ9D8uu54bavfCYNGrn.ZnRYipm', 'd09f84d9f8fd9207ed8a505ba02d3bb6303129fef5c302981cd44c816ef450bc0a3ad61f73a7b925f3c68784a841e818c462', '1532-default.jpg', 'Luis', 'Carcamo Cardenas', NULL, NULL, NULL, 'Castro', 3, NULL, NULL, NULL, 3, 1, 1, '2023-09-09 18:13:21'),
(38, 'ofgb1958@gmail.com', '71177521', '$2y$10$993ydYIziQp57Ikerj8PQOUtCkEYzfbJQPOCCFgoRJbFKx7ufbJOW', '23ccd3798c4520df151c3b149d508866dede4ed0c899e6c8c985cf3aa8c087d3dbdeb2f253d5a8afabbbd966205776ae08c6', '1407-default.jpg', 'Oscar', 'Gomez Borquez', '1958-04-15', NULL, NULL, 'Chonchi', 3, NULL, NULL, NULL, 3, 8, 1, '2023-09-09 18:14:30'),
(39, 'borisbarra202@gmail.com', '79153427', '$2y$10$TYgh.FBexsimsWYuneEeV.3tUeqKfWsv.7Cdg514O8GKN0.is4nc6', 'd19fb18f2d988dce66681ff1be0970029a1a4173d422070ddc6cd6dae6aa0deac9ec5c6d15d333e1280b5bee7f8ef80ae722', '8951-default.jpg', 'Boris', 'Barra Uribe', '1958-12-30', NULL, NULL, 'Ancud', 3, NULL, NULL, NULL, 3, 1, 1, '2023-09-09 18:15:48'),
(40, 'dantemontiel@hotmail.com', '78049650', '$2y$10$QbIMdjcbJSd0.Igg2i5jN.stjd854sFud6otEJKjCKiBTajn.sMBu', '0187697df74d000779fbfcfc6a87ab80b824e9762376de30321b7e8863014b8a8ac8bf9aa5b618e5a6e5b173bc4c2ba05ab2', '3571-default.jpg', 'Dante', 'Montiel Vera', '1959-03-31', '977586786', NULL, 'Castro', 3, NULL, NULL, NULL, 3, 5, 1, '2023-09-09 18:17:03'),
(41, 'solizernesto@gmail.com', '82731156', '$2y$10$OXXoHq539vdujyhlu419OumzSucZ8fu24qTLsBr331ifzZVHIvSgy', '45b9c659896bc3e0f225d0f6e0af2698925207d7e2934527f35a625e19f6adf5817bdef57c975fd09d48ff69ba68ded99f3f', '1443-default.jpg', 'Ernesto', 'Soliz Romero', '1959-07-20', NULL, NULL, 'Ancud', 3, NULL, NULL, NULL, 3, 1, 1, '2023-09-09 18:19:00'),
(42, 'juandiaz7.saldivia@gmail.com', '85088971', '$2y$10$nlSxZkgmq3Yc34Fvofbnb..PFWQkHVdx.pTBf7bl/rBDsOH1EMdqC', '3e104c1943764fa8e211b8c3b00061c65e2977ca42ac90775853ec709f7a993376606191162477d4629e89a58cd2d3a126c7', '1402-default.jpg', 'Juan', 'Díaz Saldivia', '1959-11-23', '982193495', 'Yerbas Buenas 12 P.banco Estado ', 'Ancud', 3, NULL, NULL, NULL, 3, 11, 1, '2023-09-09 18:22:28'),
(43, 'mloaizaperez@yahoo.es', '9267259k', '$2y$10$2cm9umWBk5TKeb.ahUGxBOsLTYWrh0n0j3ob.WxJuc4sPbTR5gSri', 'cd587a979fee493fdce378d37506b876a3430eb1d0867b8e4011252d9cd43163fa4ebaea80dc2e3dd9598d86296ad4e55e22', '4747-default.jpg', 'Manuel', 'Loaiza Perez', '1964-03-26', NULL, NULL, 'Castro', 3, NULL, NULL, NULL, 3, 6, 1, '2023-09-09 18:23:56'),
(45, 'lobosroa@gmail.com', '133582142', '$2y$10$QtvU6ij66Cn2iFqJaEBlbOyTj6.cqjJmc/xCFVFxbWystJzi/Q/Ia', 'd3c932c245d9ed610613117ba17ef6697042c55f306788f9076f4b041d907531061caba95d076c3bf4548e6eda62a7b7ffc2', '8890-default.jpg', 'Felipe', 'Lobos Roa', '1978-06-04', NULL, NULL, 'Ancud', 3, NULL, NULL, NULL, 3, 13, 1, '2023-09-09 18:26:37'),
(46, 'juanluisserra@gmail.com', '7096242k', '$2y$10$EzdANz7h116ZZwMNZ3B2ce4uzOO55ObJCx0ldomT30R8M06zJYV.W', '84b7a21865600e6c1726e4b75e847e2be86330f082004ec8efa7f4981db87dfb0ce718ff1f3cbb6659b57a41a0ef5271d118', '7124-default.jpg', 'Juan', 'Serra Orellana', '1956-12-24', NULL, NULL, 'Castro', 3, NULL, NULL, NULL, 3, 14, 1, '2023-09-09 18:28:19'),
(47, 'alvaroaguila67@yahoo.es', '131104213', '$2y$10$ZgxTISRFBQw8yLCaTe2S3OSSuYhXS2hm1O1hV2tOElAbYJaCkrDIy', 'f5fa22c15eca0466eca87f97d8f8c0951abc12c4dab98b180159066ecd3d043acf11dacb81e4afeb468dc55bf646b607ed1b', '5860-default.jpg', 'José Álvaro', 'Aguila Seguel', NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 1, 1, '2023-09-15 20:26:24'),
(48, 'ju.veas@gmail.com', '16923579', '$2y$10$40X0G0w5jmD4AmHNYSseY.xuWiux9.5z6i8wCywzfmW/BEHtnxat6', '9a246a409091c7274a0fa29dfdeb1414e1992ee16377cbaf52e899d1a2f57ade467e6f34cd5042e0a72f883bcaab716f55a5', '9413-368355428_10230938335100734_1876963847099256149_n.jpg', 'Julio', 'Veas Pinochet', NULL, '983555267', NULL, NULL, 3, NULL, NULL, NULL, 2, 1, 1, '2023-12-12 22:36:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_category`
--

CREATE TABLE `user_category` (
  `id_Cat` int(11) NOT NULL,
  `cat_Nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `user_category`
--

INSERT INTO `user_category` (`id_Cat`, `cat_Nombre`) VALUES
(1, 'Super Administrador'),
(2, 'Administrador'),
(3, 'Usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acta`
--
ALTER TABLE `acta`
  ADD PRIMARY KEY (`id_Acta`),
  ADD KEY `acta_grado_id_fk` (`grado_Acta`);

--
-- Indices de la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD PRIMARY KEY (`id_Libro`),
  ADD KEY `biblioteca_grado_id_fk` (`grado_Libro`);

--
-- Indices de la tabla `boletin`
--
ALTER TABLE `boletin`
  ADD PRIMARY KEY (`id_Boletin`),
  ADD KEY `boletin_grado_id_fk` (`grado_Boletin`);

--
-- Indices de la tabla `categoryevent`
--
ALTER TABLE `categoryevent`
  ADD PRIMARY KEY (`id_Category`);

--
-- Indices de la tabla `categoryfeed`
--
ALTER TABLE `categoryfeed`
  ADD PRIMARY KEY (`id_Category`);

--
-- Indices de la tabla `commentsfeed`
--
ALTER TABLE `commentsfeed`
  ADD PRIMARY KEY (`id_Comment`),
  ADD KEY `commentsfeed_users_id_fk` (`user_Comment`),
  ADD KEY `commentsfeed_feed_id_Feed_fk` (`feed_Comment`);

--
-- Indices de la tabla `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id_Doc`);

--
-- Indices de la tabla `entradadinero`
--
ALTER TABLE `entradadinero`
  ADD PRIMARY KEY (`id_Entrada`),
  ADD KEY `entradadinero_users_id_fk` (`id_User`),
  ADD KEY `entradadinero_entradamotivo_id_Motivo_fk` (`entrada_Motivo`);

--
-- Indices de la tabla `entradamotivo`
--
ALTER TABLE `entradamotivo`
  ADD PRIMARY KEY (`id_Motivo`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_Evento`),
  ADD KEY `evento_categoryevent_id_Category_fk` (`cat_Evento`);

--
-- Indices de la tabla `feed`
--
ALTER TABLE `feed`
  ADD PRIMARY KEY (`id_Feed`),
  ADD KEY `feed_categoryfeed_id_Category_fk` (`category_Feed`),
  ADD KEY `feed_users_id_fk` (`user_Feed`);

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_Message`),
  ADD KEY `message_users_id_fk` (`from_Message`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_Noticia`),
  ADD KEY `noticias_users_id_fk` (`id_User`),
  ADD KEY `noticias_Categoria_fk` (`id_Categoria`);

--
-- Indices de la tabla `noticias_category`
--
ALTER TABLE `noticias_category`
  ADD PRIMARY KEY (`id_Categoria`);

--
-- Indices de la tabla `oficiales`
--
ALTER TABLE `oficiales`
  ADD PRIMARY KEY (`id_Oficial`);

--
-- Indices de la tabla `salidadinero`
--
ALTER TABLE `salidadinero`
  ADD PRIMARY KEY (`id_Salida`),
  ADD KEY `salidadinero_salidamotivo_id_SalidaMotivo_fk` (`salida_Motivo`),
  ADD KEY `salidadinero_users_id_fk` (`id_User`);

--
-- Indices de la tabla `salidamotivo`
--
ALTER TABLE `salidamotivo`
  ADD PRIMARY KEY (`id_SalidaMotivo`);

--
-- Indices de la tabla `trazado`
--
ALTER TABLE `trazado`
  ADD PRIMARY KEY (`id_Trazado`),
  ADD KEY `trazado_grado_id_fk` (`grado_Trazado`),
  ADD KEY `trazado_users_id_fk` (`autor_Trazado`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `useremail` (`useremail`),
  ADD KEY `users_grado_id_fk` (`grado`),
  ADD KEY `users_oficiales_id_Oficial_fk` (`oficialidad`),
  ADD KEY `users_user_category_id_Cat_fk` (`category`);

--
-- Indices de la tabla `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`id_Cat`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acta`
--
ALTER TABLE `acta`
  MODIFY `id_Acta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  MODIFY `id_Libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `boletin`
--
ALTER TABLE `boletin`
  MODIFY `id_Boletin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `categoryevent`
--
ALTER TABLE `categoryevent`
  MODIFY `id_Category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `commentsfeed`
--
ALTER TABLE `commentsfeed`
  MODIFY `id_Comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `documents`
--
ALTER TABLE `documents`
  MODIFY `id_Doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `entradadinero`
--
ALTER TABLE `entradadinero`
  MODIFY `id_Entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `feed`
--
ALTER TABLE `feed`
  MODIFY `id_Feed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `message`
--
ALTER TABLE `message`
  MODIFY `id_Message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_Noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `noticias_category`
--
ALTER TABLE `noticias_category`
  MODIFY `id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `salidadinero`
--
ALTER TABLE `salidadinero`
  MODIFY `id_Salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `trazado`
--
ALTER TABLE `trazado`
  MODIFY `id_Trazado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `user_category`
--
ALTER TABLE `user_category`
  MODIFY `id_Cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acta`
--
ALTER TABLE `acta`
  ADD CONSTRAINT `acta_grado_id_fk` FOREIGN KEY (`grado_Acta`) REFERENCES `grado` (`id`);

--
-- Filtros para la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD CONSTRAINT `biblioteca_grado_id_fk` FOREIGN KEY (`grado_Libro`) REFERENCES `grado` (`id`);

--
-- Filtros para la tabla `boletin`
--
ALTER TABLE `boletin`
  ADD CONSTRAINT `boletin_grado_id_fk` FOREIGN KEY (`grado_Boletin`) REFERENCES `grado` (`id`);

--
-- Filtros para la tabla `commentsfeed`
--
ALTER TABLE `commentsfeed`
  ADD CONSTRAINT `commentsfeed_feed_id_Feed_fk` FOREIGN KEY (`feed_Comment`) REFERENCES `feed` (`id_Feed`),
  ADD CONSTRAINT `commentsfeed_users_id_fk` FOREIGN KEY (`user_Comment`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `entradadinero`
--
ALTER TABLE `entradadinero`
  ADD CONSTRAINT `entradadinero_entradamotivo_id_Motivo_fk` FOREIGN KEY (`entrada_Motivo`) REFERENCES `entradamotivo` (`id_Motivo`),
  ADD CONSTRAINT `entradadinero_users_id_fk` FOREIGN KEY (`id_User`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_categoryevent_id_Category_fk` FOREIGN KEY (`cat_Evento`) REFERENCES `categoryevent` (`id_Category`);

--
-- Filtros para la tabla `feed`
--
ALTER TABLE `feed`
  ADD CONSTRAINT `feed_categoryfeed_id_Category_fk` FOREIGN KEY (`category_Feed`) REFERENCES `categoryfeed` (`id_Category`),
  ADD CONSTRAINT `feed_users_id_fk` FOREIGN KEY (`user_Feed`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_users_id_fk` FOREIGN KEY (`from_Message`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_Categoria_fk` FOREIGN KEY (`id_Categoria`) REFERENCES `noticias_category` (`id_Categoria`),
  ADD CONSTRAINT `noticias_users_id_fk` FOREIGN KEY (`id_User`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `salidadinero`
--
ALTER TABLE `salidadinero`
  ADD CONSTRAINT `salidadinero_salidamotivo_id_SalidaMotivo_fk` FOREIGN KEY (`salida_Motivo`) REFERENCES `salidamotivo` (`id_SalidaMotivo`),
  ADD CONSTRAINT `salidadinero_users_id_fk` FOREIGN KEY (`id_User`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `trazado`
--
ALTER TABLE `trazado`
  ADD CONSTRAINT `trazado_grado_id_fk` FOREIGN KEY (`grado_Trazado`) REFERENCES `grado` (`id`),
  ADD CONSTRAINT `trazado_users_id_fk` FOREIGN KEY (`autor_Trazado`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_grado_id_fk` FOREIGN KEY (`grado`) REFERENCES `grado` (`id`),
  ADD CONSTRAINT `users_oficiales_id_Oficial_fk` FOREIGN KEY (`oficialidad`) REFERENCES `oficiales` (`id_Oficial`),
  ADD CONSTRAINT `users_user_category_id_Cat_fk` FOREIGN KEY (`category`) REFERENCES `user_category` (`id_Cat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
