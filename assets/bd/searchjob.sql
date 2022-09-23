-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2022 a las 04:52:55
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `searchjob`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPcalificacionActualizar` (IN `Pcodigo` INT(3), IN `Pusuario` VARCHAR(11), IN `Pnumero` INT(5), IN `Pdescripcion` VARCHAR(600))  BEGIN
UPDATE calificacion
SET usuario = Pusuario, numero = Pnumero, descripcion = Pdescripcion
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPcalificacionEliminar` (IN `Pcodigo` INT(3))  BEGIN
DELETE FROM calificacion
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPcalificacionInsertar` (IN `Pusuario` VARCHAR(11), IN `Pnumero` INT(5), IN `Pdescripcion` VARCHAR(600))  BEGIN
INSERT INTO calificacion
VALUES (null,Pusuario,Pnumero,Pdescripcion);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPcalificacionLeerConCodigos` (IN `Pcodigo` INT(3))  BEGIN
SELECT * FROM calificacion
WHERE codigo = Pcodigo;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPcalificacionLeerSinCodigos` (IN `Pcodigo` INT(3))  BEGIN
SELECT ca.codigo, concat(us.id,' - ',us.nombre,' - ',us.apellido) as 'Usuario', ca.numero, ca.descripcion FROM calificaion as ca
INNER JOIN usuario as us
ON ca.usuario = us.id
WHERE ca.codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPcargoActualizar` (IN `Pcodigo` INT(2), IN `Pnombre` VARCHAR(600))  BEGIN
UPDATE cargo
SET nombre = Pnombre
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPcargoEliminar` (IN `Pcodigo` INT(2))  BEGIN
DELETE FROM cargo
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPcargoInsertar` (IN `Pnombre` VARCHAR(600))  BEGIN
INSERT INTO cargo
VALUES(null,Pnombre);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPcargoLeer` (IN `Pcodigo` INT(2))  BEGIN
SELECT * FROM cargo
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPdepartamentoActualizar` (IN `Pcodigo` INT(2), IN `Pnombre` VARCHAR(25))  BEGIN
UPDATE departamento
SET nombre = Pnombre
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPdepartamentoEliminar` (IN `Pcodigo` INT(2))  BEGIN
DELETE FROM departamento
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPdepartamentoInsertar` (IN `Pcodigo` INT(2), IN `Pnombre` VARCHAR(25))  BEGIN
INSERT INTO departamento
VALUES(Pcodigo,Pnombre);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPdepartamentoLeer` (IN `Pcodigo` INT(2))  BEGIN
SELECT * FROM departamento
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPempleoActualizar` (IN `Pcodigo` INT(5), IN `Pnombre` VARCHAR(30), IN `Pmunicipio` INT(5), IN `Pdireccion` VARCHAR(100), IN `Pcargo` INT(2), IN `Pvacantes` INT(3), IN `Pjornada` VARCHAR(15), IN `Pexperiencia` VARCHAR(30), IN `Psector` INT(2), IN `Pfuncion` VARCHAR(1000), IN `Pempresa` VARCHAR(11), IN `Pdescripcion` VARCHAR(600), IN `Psalario` INT(8), IN `Ptipo_contrato` INT(1))  BEGIN
UPDATE empleo
SET nombre = Pnombre, 
municipio = Pmunicipio,
direccion = Pdireccion,
cargo = Pcargo,
vacantes = Pvacantes,
jornada = Pjornada,
experiencia = Pexperiencia,
sector = Psector,
funcion = Pfuncion,
empresa = Pempresa,
descripcion = Pdescripcion,
salario = Psalario,
tipo_contrato = Ptipo_contrato
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPempleoEliminar` (IN `Pcodigo` INT(5))  BEGIN
DELETE FROM empleo
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPempleoInsertar` (IN `Pnombre` VARCHAR(30), IN `Pmunicipio` INT(5), IN `Pdireccion` VARCHAR(100), IN `Pcargo` INT(2), IN `Pvacantes` INT(3), IN `Pjornada` VARCHAR(15), IN `Pexperiencia` VARCHAR(30), IN `Psector` INT(2), IN `Pfuncion` VARCHAR(1000), IN `Pempresa` VARCHAR(11), IN `Pdescripcion` VARCHAR(600), IN `Psalario` INT(8), IN `Ptipo_contrato` INT(1))  BEGIN
INSERT INTO empleo
VALUES(null,Pnombre,Pmunicipio,Pdireccion,Pcargo,Pvacantes,Pjornada,Pexperiencia,Psector,Pfuncion,Pempresa,Pdescripcion,Psalario,
       Ptipo_contrato);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPempleoLeerConCodigos` (IN `Pcodigo` INT(5))  BEGIN
SELECT * FROM empleo
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPempleoLeerSinCodigos` (IN `Pcodigo` INT(5))  BEGIN
SELECT em.codigo, em.nombre, concat(mu.codigo,' - ',mu.nombre) as 'Informacion municipio', em.direccion,
concat(ca.codigo,' - ',ca.nombre) as 'Informacion cargo', em.vacantes, em.jornada, em.experiencia,
concat(se.codigo,' - ',se.nombre) as 'Informacion sector', em.funcion, em.empresa, em.descripcion, 
em.salario, concat(tc.codigo,' - ',tc.nombre)
FROM empleo as em
INNER JOIN municipio as mu
ON em.municipio = mu.codigo
INNER JOIN cargo as ca
ON em.cargo = ca.codigo
INNER JOIN sector as se
ON em.sector = se.codigo
INNER JOIN tipo_contrato as tc
ON em.tipo_contrato = tc.codigo
HAVING em.codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPmunicipioActualizar` (IN `Pcodigo` INT(5), IN `Pnombre` VARCHAR(40), IN `Pdepartamento` INT(2))  BEGIN
UPDATE municipio
SET nombre = Pnombre, departamento = Pdepartamento
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPmunicipioEliminar` (IN `Pcodigo` INT(5))  BEGIN
DELETE FROM municipio
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPmunicipioInsertar` (IN `Pcodigo` INT(5), IN `Pnombre` VARCHAR(40), IN `Pdepartamento` INT(2))  BEGIN
INSERT INTO municipio
VALUES(Pcodigo, Pnombre, Pdepartamento);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPmunicipioLeerConCodigos` (IN `Pcodigo` INT(5))  BEGIN
SELECT * FROM municipio
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPmunicipioLeerSinCodigos` (IN `Pcodigo` INT(5))  BEGIN
SELECT mu.codigo, mu.nombre as 'Nombre Municipio', de.nombre as 'Nombre Departamento' FROM municipio as mu
INNER JOIN departamento as de
ON mu.departamento = de.codigo
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPperfilActualizar` (IN `Pcodigo` INT(2), IN `Pnombre` VARCHAR(40))  BEGIN
UPDATE perfil
SET nombre = Pnombre
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPperfilEliminar` (IN `Pcodigo` INT(2))  BEGIN
DELETE FROM perfil
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPperfilInsertar` (IN `Pnombre` VARCHAR(40))  BEGIN
INSERT INTO perfil
VALUES(null,Pnombre);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPperfilLeer` (IN `Pcodigo` INT(2))  BEGIN
SELECT * FROM perfil
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPpostulacionActualizar` (IN `Pcodigo` INT(4), IN `Pusuario` VARCHAR(11), IN `Pempleo` INT(5), IN `Pestado` TINYINT(1), IN `Pfecha` DATETIME)  BEGIN
UPDATE postulacion
SET usuario = Pusuario, empleo = Pempleo, estado = Pestado, fecha = Pfecha
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPpostulacionEliminar` (IN `Pcodigo` INT(4))  BEGIN
DELETE FROM postulacion
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPpostulacionInsertar` (IN `Pusuario` VARCHAR(11), IN `Pempleo` INT(5), IN `Pestado` TINYINT(1), IN `Pfecha` DATETIME)  BEGIN
INSERT INTO postulacion
VALUES(null, Pusuario, Pempleo, Pestado, Pfecha);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPpostulacionLeerConCodigos` (IN `Pcodigo` INT(4))  BEGIN
SELECT * FROM postulacion
WHERE codigo = Pcodigo;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPpostulacionLeerSinCodigos` (IN `Pcodigo` INT(4))  BEGIN
SELECT po.codigo, concat(us.id,' - ',us.nombre,' - ',us.apellido) as 'Informacion usuario', concat(em.codigo,' - ',em.nombre) as 'Informacion Empleo', po.estado, po.fecha 
FROM postulacion as po 
INNER JOIN usuario as us 
ON po.usuario = us.id 
INNER JOIN empleo as em 
ON po.empleo = em.codigo 
HAVING po.codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPsectorActualizar` (IN `Pcodigo` INT(2), IN `Pnombre` VARCHAR(30))  BEGIN
UPDATE sector
SET nombre = Pnombre
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPsectorEliminar` (IN `Pcodigo` INT(2))  BEGIN
DELETE FROM sector
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPsectorInsertar` (IN `Pnombre` VARCHAR(30))  BEGIN
INSERT INTO sector
VALUES(null, Pnombre);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPsectorLeer` (IN `Pcodigo` INT(2))  BEGIN
SELECT * FROM sector
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtipo_contratoActualizar` (IN `Pcodigo` INT(1), IN `Pnombre` VARCHAR(70))  BEGIN
UPDATE tipo_contrato
SET nombre = Pnombre
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtipo_contratoEliminar` (IN `Pcodigo` INT(1))  BEGIN
DELETE FROM tipo_contrato
WHERE codigo = Pcodigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtipo_contratoInsertar` (IN `Pnombre` VARCHAR(70))  BEGIN
INSERT INTO tipo_contrato
VALUES(null, Pnombre);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPtipo_contratoLeer` (IN `Pcodigo` INT(1))  BEGIN
SELECT * FROM tipo_contrato
WHERE codigo = Pcodigo;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPusuarioActualizar` (IN `Pid` VARCHAR(11), IN `Pnombre` VARCHAR(40), IN `Papellido` VARCHAR(40), IN `Ptelefono` VARCHAR(11), IN `Pdireccion` VARCHAR(60), IN `Pcorreo` VARCHAR(50), IN `Pcontrasena` VARCHAR(40), IN `Pperfil` INT(2), IN `Phoja_vida` VARCHAR(260), IN `Pimagen` VARCHAR(255))  BEGIN
UPDATE usuario
SET nombre = Pnombre, apellido = Papellido, telefono = Ptelefono, direccion = Pdireccion, correo = Pcorreo,
contrasena = Pcontrasena, perfil = Pperfil, hoja_vida = Phoja_vida, imagen = Pimagen
WHERE id = Pid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPusuarioEliminar` (IN `Pid` VARCHAR(11))  BEGIN
DELETE FROM usuario
WHERE id = Pid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPusuarioInsertar` (IN `Pid` VARCHAR(11), IN `Pnombre` VARCHAR(40), IN `Papellido` VARCHAR(40), IN `Ptelefono` VARCHAR(11), IN `Pdireccion` VARCHAR(60), IN `Pcorreo` VARCHAR(50), IN `Pcontrasena` VARCHAR(40), IN `Pperfil` INT(2), IN `Phoja_vida` VARCHAR(260), IN `Pimagen` VARCHAR(255))  BEGIN
INSERT INTO usuario
VALUES(Pid, Pnombre, Papellido, Ptelefono, Pdireccion, Pcorreo, Pcontrasena, Pperfil, Phoja_vida, Pimagen);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPusuarioLeerConCodigos` (IN `Pid` VARCHAR(11))  BEGIN
SELECT * FROM usuario
WHERE id = Pid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPusuarioLeerSinCodigo` (IN `Pid` VARCHAR(11))  BEGIN
SELECT us.id, us.nombre, us.apellido, us.telefono, us.direccion, us.correo, us.contrasena, 
concat(pe.codigo,' - ',pe.nombre) as 'Informacion perfil', us.hoja_vida
FROM usuario as us
INNER JOIN perfil as pe
ON us.perfil = pe.codigo
HAVING us.id = Pid;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `codigo` int(3) NOT NULL,
  `usuario` varchar(11) NOT NULL,
  `numero` int(5) NOT NULL,
  `descripcion` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `codigo` int(2) NOT NULL,
  `nombre` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`codigo`, `nombre`) VALUES
(1008, 'Responsable Operativos'),
(1009, 'RESPONSABLE DE MARKETING'),
(1010, 'Responsable de las ventas'),
(1011, 'Responsable de las personas'),
(1012, 'Exito del cliente'),
(1013, 'Responsable financiero'),
(1015, 'Responsable de ventas'),
(1016, 'Responsable de las personas'),
(1017, 'Responsable de los supervisores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `codigo` int(2) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`codigo`, `nombre`) VALUES
(5, 'Antioquias'),
(13, 'Bolivar'),
(18, 'Caqueta'),
(19, 'amalfi'),
(20, 'cundinamarca'),
(24, 'wadulagu'),
(26, 'wadul'),
(28, 'wadulagu'),
(41, 'Huila'),
(43, 'Gritolandia'),
(48, 'Culicolo'),
(52, 'Nariño'),
(85, 'Negrolandia'),
(91, 'Amazonas'),
(94, 'Guainia'),
(989, 'dfgdfg'),
(1046, 'chupaloalmil'),
(23122, 'asdefsesfe'),
(34588, 'hj,j,'),
(78488, 'dfsdf'),
(82852, 'ghjfghj'),
(85485487, 'fgsfdg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleo`
--

CREATE TABLE `empleo` (
  `codigo` int(5) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `municipio` int(5) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cargo` int(2) NOT NULL,
  `vacantes` int(3) NOT NULL,
  `jornada` varchar(15) NOT NULL,
  `experiencia` varchar(30) NOT NULL,
  `sector` int(2) NOT NULL,
  `funcion` varchar(1000) NOT NULL,
  `empresa` varchar(11) NOT NULL,
  `descripcion` varchar(600) NOT NULL,
  `salario` int(8) NOT NULL,
  `tipo_contrato` int(1) NOT NULL,
  `logo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleo`
--

INSERT INTO `empleo` (`codigo`, `nombre`, `municipio`, `direccion`, `cargo`, `vacantes`, `jornada`, `experiencia`, `sector`, `funcion`, `empresa`, `descripcion`, `salario`, `tipo_contrato`, `logo`) VALUES
(2, 'Desarrollador Web', 5376, 'Avenida 32 con carrera 56', 1008, 10, 'Diurna', 'Sin experiencia', 111, 'Desarrollador de interfaces graficas atractivas', 'Empresa de ', 'Se requiere un desarrrolador web que haga tal y tal cosa', 1000000, 1, 'none'),
(3, 'Desarrollador Backend', 5001, 'Avenida 56 con carrera 32', 1012, 5, 'Diurna', 'Sin experiencia', 115, 'Desarrollador de algoritmos', 'Empresa de ', 'Se requiere un desarrrolador web que haga tal y tal cosa', 1800000, 6, 'none'),
(4, 'Contador', 5400, 'Avenida 12 con calle 56', 1016, 2, 'Diurna', 'Sin experiencia', 115, 'Contador Publicos', 'Empresa SA', 'Se requiere un contador que haga tal y tal cosa', 2000000, 6, 'none'),
(5, 'Arquitecto', 5376, 'Avenida 15 con carrera 43', 1010, 3, 'Nocturna', '6 meses minimos', 111, 'Desarrollador de proyectos de construccion', 'Empresa de ', 'Se requiere un arquitecto que haga tal y tal cosa', 3000000, 4, 'none'),
(6, 'Desarrollador full Stack', 5376, 'Avenida 14 con carrera 78', 1013, 6, 'Diurna', 'Sin experiencia', 115, 'Desarrollador de proyectos full', 'Empresa de ', 'Se requiere un desarrrolador Full Stack que haga tal y tal cosa', 4000000, 4, 'none'),
(7, 'Desarrollador Web', 5809, 'Avenida 12 con carrera 45', 1015, 3, 'Diurna', 'Sin experiencia', 111, 'Desarrollador de interfaces graficas atractivas', 'Empresa de ', 'Se requiere un desarrrolador web que haga tal y tal cosa', 1500000, 2, 'none'),
(8, 'Analista', 5004, 'Avenida 16 con carrera 4', 1009, 5, 'Diurna', 'Sin experiencia', 115, 'Analista de Bases de Datos', 'Empresa de ', 'Se requiere un analista que haga tal y tal cosa', 5000000, 5, 'none'),
(9, 'Desarrollador Web', 5376, 'Avenida 32 con carrera 56', 1008, 10, 'Diurna', 'Sin experiencia', 111, 'Desarrollador de interfaces graficas atractivas', 'Empresa de ', 'Se requiere un desarrrolador web que haga tal y tal cosa', 1000000, 1, 'none'),
(10, 'Jardinero', 5400, 'Avenida 15 con carrera 56', 1008, 2, 'Diurna', 'Sin experiencia', 115, 'Jardinero y podador', 'Empresa de ', 'Se requiere un jardinero que haga tal y tal cosa', 1900000, 3, 'none'),
(11, 'Desarrollador Web', 5376, 'Avenida 32 con carrera 56', 1008, 10, 'Diurna', 'Sin experiencia', 111, 'Desarrollador de interfaces graficas atractivas', 'Empresa de ', 'Se requiere un desarrrolador web que haga tal y tal cosa', 1000000, 1, 'none'),
(12, 'Desarrollador', 5376, 'Avenida las lomitas 36', 1008, 12, 'Nocturna', '1 año', 111, 'Desarrollador de proyectos', 'Empresa CE', 'Se requiere un desarrollador que haga tin y tin', 1300000, 1, 'none');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `codigo` int(5) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `departamento` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`codigo`, `nombre`, `departamento`) VALUES
(5001, 'Medellin', 5),
(5002, 'Abejorral', 5),
(5004, 'Abriaqui', 5),
(5021, 'Alejandrias', 5),
(5148, 'El Carmen de Viboral', 5),
(5318, 'Guarne', 5),
(5376, 'La Ceja', 5),
(5400, 'La Union', 5),
(5667, 'San Rafael', 5),
(5809, 'Titiribi', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `codigo` int(2) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`codigo`, `nombre`) VALUES
(1, 'empleado'),
(2, 'empresa'),
(3, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulacion`
--

CREATE TABLE `postulacion` (
  `codigo` int(4) NOT NULL,
  `usuario` varchar(11) NOT NULL,
  `empleo` int(5) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE `sector` (
  `codigo` int(2) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`codigo`, `nombre`) VALUES
(106, 'Sector transporte'),
(107, 'sector comunicaciones'),
(108, 'sector comercial'),
(109, 'sector turístico'),
(110, 'sector sanitario'),
(111, 'sector educativo'),
(112, 'sector de las artes'),
(113, 'sector financiero'),
(114, 'sector empresarial'),
(115, 'sector de monitoreo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_contrato`
--

CREATE TABLE `tipo_contrato` (
  `codigo` int(1) NOT NULL,
  `nombre` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_contrato`
--

INSERT INTO `tipo_contrato` (`codigo`, `nombre`) VALUES
(1, 'Contrato a término fijos'),
(2, 'Contrato a Término Indefinido'),
(3, 'Contrato de Obra o labor '),
(4, 'Contrato de aprendizaje'),
(5, 'Contrato temporal, ocasional o accidental '),
(6, 'Contrato civil por prestación de servicios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` varchar(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `telefono` varchar(11) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `perfil` int(2) NOT NULL,
  `hoja_vida` varchar(260) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `telefono`, `direccion`, `correo`, `contrasena`, `perfil`, `hoja_vida`, `imagen`) VALUES
('0345', 'Juan Jose', 'Baretas', '3816283634', 'Calle34 #vivalamoña', 'bareta@gmail.com', '$2y$04$pwxiY3ZqaF5YOQIw4OusVOUERtoxuxo/gmvh0cH5gtJTpvNEcgesG', 2, NULL, 'descarga.jpg'),
('1005', 'Juan Esteban', 'Motomami', '123412344', 'Calle34 #56-54', 'bareta@gmail.com', '$2y$04$tN.d6Ay3DbMYAliAPk4f.e.PEKyW2onVyQa7a0PBIilX.gp/Tb51a', 1, 'ExamennprnncticondenDisennonconnFigmanynAPPnInventornnn33618c0a1a200adnnn___74619648785a9d1___ (1).pdf', '4c615759ec1374cae02697727ae8a35b--cabin-fever-dream-homes.jpg'),
('1008', 'Juan Jose', 'Baretas', '3816283634', 'Calle34 #vivalamoña', 'bareta@gmail.com', '$2y$04$JEaVkvDEoF7ZcjGapvujhek78QjGt75aXCFIHSRo.SdN7cXaY/bWm', 1, 'Pasabordo Cristian Camilo.pdf', 'descarga.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `empleo`
--
ALTER TABLE `empleo`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `cargo` (`cargo`),
  ADD KEY `sector` (`sector`),
  ADD KEY `empresa` (`empresa`),
  ADD KEY `municipio` (`municipio`),
  ADD KEY `tipo_contrato` (`tipo_contrato`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `departamento` (`departamento`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `postulacion`
--
ALTER TABLE `postulacion`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `empleo` (`empleo`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfil` (`perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `codigo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `codigo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1018;

--
-- AUTO_INCREMENT de la tabla `empleo`
--
ALTER TABLE `empleo`
  MODIFY `codigo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `codigo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `postulacion`
--
ALTER TABLE `postulacion`
  MODIFY `codigo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `codigo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de la tabla `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  MODIFY `codigo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `FK_calificacion_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `empleo`
--
ALTER TABLE `empleo`
  ADD CONSTRAINT `FK_empleo_cargo` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`codigo`),
  ADD CONSTRAINT `FK_empleo_sector` FOREIGN KEY (`sector`) REFERENCES `sector` (`codigo`),
  ADD CONSTRAINT `FK_empleo_tipo_contrato` FOREIGN KEY (`tipo_contrato`) REFERENCES `tipo_contrato` (`codigo`),
  ADD CONSTRAINT `empleo_ibfk_5` FOREIGN KEY (`municipio`) REFERENCES `municipio` (`codigo`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `FK_municipio_departamento` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`codigo`);

--
-- Filtros para la tabla `postulacion`
--
ALTER TABLE `postulacion`
  ADD CONSTRAINT `FK_postulacion_empleo` FOREIGN KEY (`empleo`) REFERENCES `empleo` (`codigo`),
  ADD CONSTRAINT `postulacion_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_usuario_perfil` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
