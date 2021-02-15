-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-02-2020 a las 20:35:39
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_escolar_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `fechaDeNacimiento` date DEFAULT NULL,
  `padre` varchar(255) NOT NULL,
  `madre` varchar(255) NOT NULL,
  `grupo` int(11) DEFAULT NULL,
  `estado` varchar(255) NOT NULL,
  `matricula` int(11) NOT NULL,
  `tipoUsuario` varchar(10) DEFAULT NULL,
  `al_fechaDeRegistro` datetime DEFAULT NULL,
  `al_fechaDeActualizacion` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `direccion`, `telefono`, `fechaDeNacimiento`, `padre`, `madre`, `grupo`, `estado`, `matricula`, `tipoUsuario`, `al_fechaDeRegistro`, `al_fechaDeActualizacion`) VALUES
(9, 'ROBERTO CRUZ ROBLES', 'CUAHUTEMOC 35', '56432189', '2019-09-21', 'pedro', 'laura', 32, 'Activo', 534564, 'alum', NULL, '2020-02-12 06:08:40'),
(10, 'SARAI ESPINOZA RODRIGUEZ', 'CARACOLES II', '32897654', '1988-02-10', 'ALFONSO', 'TEREZA', 37, 'Activo', 2013, 'alum', NULL, '2020-02-12 08:31:21'),
(50, 'carlos ortiz mendez', 'sur 2', '1245789632', '1988-05-02', 'alberto ortiz', 'martha mendez', 1, 'Activo', 14525, 'alum', '2020-02-12 06:09:31', NULL),
(33, 'alfonsol maldonado', 'sur 1', '02154678', '1987-01-02', 'carlos maldonado', 'betariz torres', 8, 'Activo', 25513, 'alum', '2020-01-31 02:12:48', '2020-02-07 18:52:13'),
(34, 'alberto barajas ruiz', 'sur2', '21351', '1989-01-02', 'armando barajas', 'rosa ruiz', 1, 'Activo', 1351533, 'alum', '2020-01-31 02:14:36', '2020-02-07 06:12:33'),
(36, 'sebastian rodrigues castillo', 'sur 20', '3255656652', '1987-01-02', 'roman rodrigues', 'isabel castillo', 1, 'Activo', 55445, 'alum', '2020-02-03 21:22:58', NULL),
(37, 'carmen ojeda mendoza', 'sur 6', '13151651', '1988-04-05', 'armando ojeda', 'mariana mendoza', 1, 'Activo', 54655, 'alum', '2020-02-03 23:23:12', '2020-02-07 06:12:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `cal_id` int(11) NOT NULL,
  `cal_profesor` int(11) DEFAULT NULL,
  `cal_grado` int(11) DEFAULT NULL,
  `cal_grupo` int(11) DEFAULT NULL,
  `cal_alumno` int(11) NOT NULL,
  `cal_materia` int(11) DEFAULT NULL,
  `cal_calificacion` float DEFAULT NULL,
  `cal_fechaDeRegistro` datetime NOT NULL,
  `cal_fechaDeActualizacion` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`cal_id`, `cal_profesor`, `cal_grado`, `cal_grupo`, `cal_alumno`, `cal_materia`, `cal_calificacion`, `cal_fechaDeRegistro`, `cal_fechaDeActualizacion`) VALUES
(29, 7, 13, 1, 9, 51, 10, '2020-02-08 21:06:00', '2020-02-12 01:22:47'),
(30, 7, 13, 1, 9, 42, 10, '2020-02-08 21:06:00', '2020-02-12 01:22:47'),
(31, 7, 13, 1, 34, 51, 7, '2020-02-08 21:08:52', '2020-02-08 22:38:24'),
(32, 7, 13, 1, 34, 42, 8, '2020-02-08 21:08:52', '2020-02-08 22:38:24'),
(33, 7, 13, 1, 36, 51, 10, '2020-02-08 21:08:52', '2020-02-12 06:14:21'),
(34, 7, 13, 1, 36, 42, 9, '2020-02-08 21:08:52', '2020-02-12 06:14:21'),
(35, 7, 13, 1, 37, 51, 8, '2020-02-08 21:09:58', '2020-02-08 22:38:27'),
(36, 7, 13, 1, 37, 42, 8, '2020-02-08 21:09:58', '2020-02-08 22:38:27'),
(37, 7, 15, 37, 10, 61, 10, '2020-02-08 22:38:47', '2020-02-08 22:40:43'),
(40, 7, 13, 1, 50, 51, 10, '2020-02-12 06:14:11', '0000-00-00 00:00:00'),
(41, 7, 13, 1, 50, 42, 8, '2020-02-12 06:14:11', '0000-00-00 00:00:00'),
(42, 7, 13, 32, 9, 51, 10, '2020-02-12 06:14:44', '2020-02-12 08:46:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `gr_id` int(11) NOT NULL,
  `gr_nombre` varchar(255) NOT NULL,
  `gr_estado` varchar(255) NOT NULL,
  `gr_fechaDeRegistro` datetime NOT NULL,
  `gr_fechaDeActualizacion` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`gr_id`, `gr_nombre`, `gr_estado`, `gr_fechaDeRegistro`, `gr_fechaDeActualizacion`) VALUES
(13, 'Primer semestre', 'Activo', '2020-02-01 02:11:07', '0000-00-00 00:00:00'),
(14, 'Segundo semestre', 'Activo', '2020-02-01 02:11:21', '0000-00-00 00:00:00'),
(15, 'Tercer semestre', 'Activo', '2020-02-01 02:12:53', '2020-02-01 02:13:49'),
(16, 'Cuarto semestre', 'Activo', '2020-02-01 02:13:03', '0000-00-00 00:00:00'),
(17, 'Quinto semestre', 'Activo', '2020-02-01 02:13:11', '2020-02-05 04:01:24'),
(18, 'Sexto semestre', 'Activo', '2020-02-01 02:13:18', '2020-02-01 02:13:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `gru_id` int(11) NOT NULL,
  `gru_nombre` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `gru_grado` int(11) DEFAULT NULL,
  `gru_status` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Inactivo',
  `gru_fechaDeRegistro` datetime DEFAULT NULL,
  `gru_fechaDeActualizacion` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`gru_id`, `gru_nombre`, `gru_grado`, `gru_status`, `gru_fechaDeRegistro`, `gru_fechaDeActualizacion`) VALUES
(1, '117', 13, 'Activo', '2020-02-01 00:10:06', '2020-02-04 03:22:46'),
(2, '119', 13, 'Activo', '2020-02-01 00:37:10', '2020-02-08 20:23:35'),
(5, '612', 18, 'Activo', '2020-02-01 00:39:40', '2020-02-04 03:23:07'),
(6, '118', 13, 'Activo', '2020-02-01 00:40:04', '2020-02-08 20:23:43'),
(7, '512', 17, 'Activo', '2020-02-01 00:40:17', '2020-02-04 03:23:21'),
(8, '115', 13, 'Activo', '2020-02-04 03:19:47', '2020-02-08 20:25:53'),
(32, '116', 13, 'Activo', '2020-02-08 07:09:15', NULL),
(33, '210', 14, 'Activo', '2020-02-08 20:23:56', NULL),
(34, '211', 14, 'Activo', '2020-02-08 20:24:04', NULL),
(35, '212', 14, 'Activo', '2020-02-08 20:24:12', NULL),
(36, '310', 15, 'Activo', '2020-02-08 20:24:38', NULL),
(37, '311', 15, 'Activo', '2020-02-08 20:24:46', NULL),
(38, '312', 15, 'Activo', '2020-02-08 20:24:52', NULL),
(39, '410', 16, 'Activo', '2020-02-08 20:25:06', NULL),
(40, '411', 16, 'Activo', '2020-02-08 20:25:16', NULL),
(41, '412', 16, 'Activo', '2020-02-08 20:25:23', NULL),
(42, '510', 17, 'Activo', '2020-02-08 20:26:03', NULL),
(43, '511', 17, 'Activo', '2020-02-08 20:26:12', NULL),
(44, '610', 18, 'Activo', '2020-02-08 20:26:28', NULL),
(45, '611', 18, 'Activo', '2020-02-08 20:26:35', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_colegio`
--

CREATE TABLE `info_colegio` (
  `id` int(255) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `web` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ic_fechaDeRegistro` datetime NOT NULL,
  `ic_fechaDeActualizacion` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `info_colegio`
--

INSERT INTO `info_colegio` (`id`, `nombre`, `direccion`, `pais`, `ciudad`, `tel`, `web`, `correo`, `ic_fechaDeRegistro`, `ic_fechaDeActualizacion`) VALUES
(1, 'COLEGIO ', 'Col Centro Delegacion cuahutemoc Edificio Comodoro Oficina 404', 'MEXICO', 'Ciudad de MEXICO', '78654313', 'www.colegio.com.mx', 'colegio@gmail.com', '2016-06-07 19:12:42', '2020-02-12 08:44:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `mat_id` int(11) NOT NULL,
  `mat_nombre` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mat_grado` int(11) NOT NULL,
  `mat_estado` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mat_fechaDeRegistro` date NOT NULL,
  `mat_fechaDeActualizacion` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`mat_id`, `mat_nombre`, `mat_grado`, `mat_estado`, `mat_fechaDeRegistro`, `mat_fechaDeActualizacion`) VALUES
(42, 'Algebra', 13, 'Activo', '2020-02-01', '2020-02-08'),
(43, 'Geometria y Trigonometria', 14, 'Activo', '2020-02-01', '2020-02-08'),
(44, 'Estadistica', 18, 'Activo', '2020-02-01', '2020-02-12'),
(45, 'Matematicas IV', 16, 'Activo', '2020-02-01', '2020-02-05'),
(46, 'Matematicas V', 17, 'Activo', '2020-02-01', '0000-00-00'),
(47, 'Matematicas VI', 18, 'Activo', '2020-02-01', '0000-00-00'),
(51, 'Redes de computadoras  1', 13, 'Activo', '2020-02-07', '0000-00-00'),
(50, 'Logica de programacion', 13, 'Activo', '2020-02-07', '2020-02-08'),
(52, 'Fisica I', 13, 'Activo', '2020-02-07', '0000-00-00'),
(53, 'Algebra 1', 13, 'Activo', '2020-02-07', '0000-00-00'),
(54, 'Quimica', 13, 'Activo', '2020-02-07', '0000-00-00'),
(55, 'Redes II', 14, 'Activo', '2020-02-07', '0000-00-00'),
(56, 'Desarrollo web I', 14, 'Activo', '2020-02-07', '0000-00-00'),
(57, 'Programacion I', 14, 'Activo', '2020-02-07', '0000-00-00'),
(58, 'Fisica II', 14, 'Activo', '2020-02-07', '0000-00-00'),
(59, 'Quimica II', 14, 'Activo', '2020-02-07', '0000-00-00'),
(60, 'informatica 14', 16, 'Activo', '2020-02-08', '0000-00-00'),
(61, 'Geometria analitica', 15, 'Activo', '2020-02-08', '0000-00-00'),
(62, 'Calculo diferencial', 16, 'Activo', '2020-02-08', '0000-00-00'),
(63, 'Calculo integral', 17, 'Activo', '2020-02-08', '0000-00-00'),
(64, 'fisica III', 15, 'Activo', '2020-02-12', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_alumno`
--

CREATE TABLE `materias_alumno` (
  `ma_id` int(11) NOT NULL,
  `ma_alumno` int(11) NOT NULL,
  `ma_materia` int(11) NOT NULL,
  `ma_grado` int(11) NOT NULL,
  `ma_grupo` int(11) NOT NULL,
  `ma_profesor` int(11) NOT NULL,
  `ma_fechaDeRegistro` date NOT NULL,
  `ma_fechaDeActualizacion` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_profesor`
--

CREATE TABLE `materias_profesor` (
  `mprof_id` int(11) NOT NULL,
  `mprof_profesor` int(11) DEFAULT NULL,
  `mprof_materia` int(11) DEFAULT NULL,
  `mprof_grado` int(11) DEFAULT NULL,
  `mprof_grupo` int(11) DEFAULT NULL,
  `mprof_fechaDeRegistro` date DEFAULT NULL,
  `mprof_fechaDeActualizacion` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `materias_profesor`
--

INSERT INTO `materias_profesor` (`mprof_id`, `mprof_profesor`, `mprof_materia`, `mprof_grado`, `mprof_grupo`, `mprof_fechaDeRegistro`, `mprof_fechaDeActualizacion`) VALUES
(10, 7, 51, 13, 1, '2020-02-08', NULL),
(11, 7, 51, 13, 32, '2020-02-08', NULL),
(12, 7, 61, 15, 37, '2020-02-08', NULL),
(13, 7, 61, 15, 36, '2020-02-08', NULL),
(14, 7, 63, 17, 42, '2020-02-08', NULL),
(15, 7, 42, 13, 1, '2020-02-08', NULL),
(16, 5, 61, 15, 38, '2020-02-09', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `tipoUsuario` varchar(255) NOT NULL,
  `prof_fechaDeRegistro` date DEFAULT NULL,
  `prof_fechaDeActualizacion` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `usuario`, `nombre`, `password`, `fechaNacimiento`, `direccion`, `telefono`, `email`, `estado`, `tipoUsuario`, `prof_fechaDeRegistro`, `prof_fechaDeActualizacion`) VALUES
(3, 'diego', 'DIEGO', '078c007bd92ddec308ae2f5115c1775d', '2013-12-08', 'Norte 15', '755858', 'DIEGOM@GMAIL.COM', 'Activo', 'p', NULL, NULL),
(5, 'rosaura', 'rosaura', 'a7244d568d1a4cf947e422eb43c6f8dc', '1988-08-12', 'GRANJAS 91', '45321789', 'ROSASF@HOTMAIL.COM', 'Activo', 'prof', NULL, '2020-02-12'),
(6, 'rosario', 'ROSARIO', '865cc410a1b7c60ae8a38c8761b2b342', '1986-09-12', 'sur 19', '45321678', 'ROSARIOPD@HOTMAIL.COM', 'Activo', 'prof', NULL, '2019-12-31'),
(7, 'alberto', 'ALBERTO', '177dacb14b34103960ec27ba29bd686b', '1970-09-09', 'sur 20', '56432787', 'ALBERTOCR@HOTMAIL.COM', 'Activo', 'prof\r\n', NULL, '2020-02-12'),
(9, 'francisco', 'FRANCISCO', '117735823fadae51db091c7d63e60eb0', '1984-06-09', 'ROSAS 2', '78096534', 'GRANCOEL@HOTMAIL.COM', 'Activo', 'p', NULL, '2019-11-29'),
(10, 'fernando15', 'FERNANDO', 'cebdd715d4ecaafee8f147c2e85e0754', '1984-06-09', 'ROSALES 11', '78096534', 'GRANCOEL@HOTMAIL.COM', 'Activo', 'p', NULL, NULL),
(11, 'roman', 'ROMAN', '872137', '1985-11-09', 'OLIVOS 90', '45637891', 'ROMAN@HOTMAIL.COM', 'Activo', 'p', NULL, NULL),
(12, 'angelica', 'ANGELICA', '89754', '1987-11-09', 'SUR 11', '54321678', 'ANGELICA@HOTMAIL.COM', 'Activo', 'p', NULL, NULL),
(13, 'eva', 'EVA', '8728933', '1985-07-09', 'SUR14', '56432187', 'EVA@HOTMAIL.COM', 'Activo', 'p', NULL, NULL),
(14, 'patricia', 'PATRICIA', '767213', '1986-09-08', 'OLIVOS 89', '98563421', 'PATRICIA@HOTMAIL.COM', 'Activo', 'p', NULL, NULL),
(15, 'juan', 'JUAN ', '821318', '1986-04-08', 'GRANJAS 89', '9856431298', 'JUAN@', 'Activo', 'p', NULL, NULL),
(16, 'rodolfo', 'RODOLFO', '723231', '1984-05-08', 'ALAMEDA 667', '56232176', 'RODOLFO@HOTMAIL.COM', 'Activo', 'p', NULL, NULL),
(17, 'gabriel', 'GABRIEL ', '6231283', '1985-05-09', 'PTE 7', '6754321809', 'GABRIEL@HOTMAIL.COM', 'Activo', 'p', NULL, NULL),
(21, 'gustavo8', 'GUSTAVO', '$2y$09$PzAkjx0fF1l/N3FY79jcauzVHE6JFtzdmjVnKn3yGQMn8OPFkzBf6', '1989-04-06', 'poniente 40', '56431232', 'gustavo@hotmail.com', 'Activo', 'p', NULL, '2019-12-03'),
(22, '', 'omar', '908908', '1987-03-01', 'poniente 50', '78653412', 'omar@hotmail.com', 'Activo', 'p', NULL, NULL),
(23, '', 'omar', '76658', '1987-05-08', 'poniente 30', '67542312', 'omar@gmail.com', 'Activo', 'p', NULL, NULL),
(25, 'raul12', 'raul', 'bc7a844476607e1a59d8eb1b1f311830', '1986-02-02', 'poniente 7', '87342132', 'raul@hotmail.com', 'Activo', 'p', NULL, NULL),
(26, 'omar14', 'omar', 'd4466cce49457cfea18222f5a7cd3573', '1986-06-08', 'poniente 60', '76453213', 'omar@hotmail.com', 'Activo', 'p', NULL, NULL),
(28, '', '', '', '0000-00-00', '', '', '', '', '', '2019-11-05', NULL),
(31, 'arturo2', 'arturo', 'arturo2', '0188-02-02', 'lllkk', '531546', 'arturo2@gmail.com', 'prof', 'Activo', '2019-11-05', NULL),
(32, 'alberto', 'alberto', '177dacb14b34103960ec27ba29bd686b', '1988-01-02', 'jhjbb', '5454456', 'alberto@gmail.com', 'Activo', 'prof', '2019-11-05', '2019-11-19'),
(33, 'angelica', 'angelica', '$2y$09$GKR3leGYBLZHg4Dt/UUNFeBqIJeBYy5Zw0zjCtKVMqqHSnzgjXQ.y', '1988-10-30', 'hjb', '54566', 'angie@gmail.com', 'Activo', 'prof', '2019-11-06', NULL),
(34, 'angelica', 'angelica', '$2y$09$SQaDlWiSgRvOH1ceLG7.xOEWQafVp7e2gp6JxZQoP/oGOor5DQP/6', '1988-10-30', 'hjb', '54566', 'angie@gmail.com', 'Activo', 'prof', '2019-11-06', NULL),
(35, 'rodrigo', 'rodrigo', '$2y$09$Gt7FtlALIuvFFIbmIyYlHeMLyVQDf9JAg/eY4V9mwy6t8.OG9w.XS', '1988-02-10', 'sur11', '1478963211', 'rodrigo@gmail.com', '6', 'prof', '2019-11-29', NULL),
(36, 'rodrigo', 'rodrigo', '$2y$09$YTZqxF17dSMP/WQ.06enEekg5w3iTC4PctmctWYjiDlY/BXyXsP/W', '1988-02-10', 'sur11', '1478963211', 'rodrigo@gmail.com', '6', 'prof', '2019-11-29', NULL),
(37, 'rodrigo', 'rodrigo', '$2y$09$1TDeGnI8m2RuMHEmAPr/H.Vz/5x5XA7KdhqdPrKAKHVj667vRvp72', '1988-02-10', 'sur11', '1478963211', 'rodrigo@gmail.com', '6', 'prof', '2019-11-29', NULL),
(38, 'rodrigo', 'rodrigo', '$2y$09$TMZGEfN4eFCC3f0ckgBW7eXLRqMrC6ZEjzRED60jSz4F6ZmJlJhQu', '1988-02-10', 'sur11', '1478963211', 'rodrigo@gmail.com', '6', 'prof', '2019-11-29', NULL),
(39, 'rodrigo', 'rodrigo', '$2y$09$Tj4adwqoFh/7qhqBtDMQ5udq3teWJILKaMVIWQOtfU06t.wPLkJSO', '1988-02-10', 'sur11', '1478963211', 'rodrigo@gmail.com', '6', 'prof', '2019-11-29', NULL),
(40, 'rodrigo', 'rodrigo', '$2y$09$dIm0vT.c9IeisJ2bSbn.MOV.vC.KN1c5IZnBVaZXe0ZFvMdtY.evm', '1988-02-10', 'sur11', '1478963211', 'rodrigo@gmail.com', '6', 'prof', '2019-11-29', NULL),
(41, 'rodrigo', 'rodrigo', '$2y$09$24oiMtr74lQOpk8KN9owjuxaFpVP4xH3yLbBLkR29ghdmiDyRt5iq', '1988-02-10', 'sur11', '1478963211', 'rodrigo@gmail.com', '6', 'prof', '2019-11-29', NULL),
(42, 'rodrigo', 'rodrigo', '$2y$09$fStnbEB0TAafmUJXzr.ss.zQt5WEC2mIDWAh2RFpXt6uAEjEy8QAy', '1988-02-10', 'sur11', '1478963211', 'rodrigo@gmail.com', '6', 'prof', '2019-11-29', NULL),
(43, 'carlos', 'carlos', '$2y$09$S.QlP/khZz8SbP3S2gtmm.VKFtKq182U/cnqSm0mXogpgqCptoNUK', '1988-10-28', 'sur12', '36987412', 'carlos@gmail.com', 'Activo', 'prof', '2019-11-29', '2019-11-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `tipoUsuario` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `us_fechaDeRegistro` date DEFAULT NULL,
  `us_fechaDeActualizacion` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `password`, `fechaNacimiento`, `direccion`, `telefono`, `email`, `tipoUsuario`, `estado`, `us_fechaDeRegistro`, `us_fechaDeActualizacion`) VALUES
(5, 'pedro14', 'pedro gonzales ortiz', 'de858890d72d1c0a616352f592708324', '1987-02-09', 'calle 60', '87563421', 'pedro14@hotmail.com', 'admin', 'Activo', NULL, '2020-02-12'),
(30, 'admin2', 'admin2', '$2y$09$fLvltesr2e1gv1TatJi0yOEol2wsy/4I2x.xAoGXU2ntcGhn4/oEC', '1987-01-02', 'admin2', '1245789632', 'admin2@gmail.com', 'admin', 'Activo', '2020-02-12', '2020-02-12'),
(28, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1990-12-02', 'direccion de admin', '12456987', 'admin@gmail.com', 'admin', 'Activo', '2020-02-12', '2020-02-12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`cal_id`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`gr_id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`gru_id`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`mat_id`);

--
-- Indices de la tabla `materias_alumno`
--
ALTER TABLE `materias_alumno`
  ADD PRIMARY KEY (`ma_id`);

--
-- Indices de la tabla `materias_profesor`
--
ALTER TABLE `materias_profesor`
  ADD PRIMARY KEY (`mprof_id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `cal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `gr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `gru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `mat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `materias_alumno`
--
ALTER TABLE `materias_alumno`
  MODIFY `ma_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias_profesor`
--
ALTER TABLE `materias_profesor`
  MODIFY `mprof_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
