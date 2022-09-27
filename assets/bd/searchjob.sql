-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2022 a las 04:56:43
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
  `calificacion` int(5) NOT NULL,
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
(26, 'Desarrollado Back End', 5400, 'Carrera 32 #45-67', 1010, 10, 'Diurna - Noctur', 'Experiencia minima de 6 meses', 108, 'Desarrollador Back End', '897465', 'Se solicita un desarrollador back end que programe con java, spring y js', 3000000, 6, 'be01aafba01c6c095d23afaa50b63d8a.jpg'),
(27, 'Jardinero', 5148, 'Carrera 32 #45-87', 1011, 1, 'Por Establecer', 'Sin Experiencia', 108, 'Cortar hierba, que mas va ser', '897465', 'Se solicita un jardinero que moche hierbaaaa', 1000000, 2, '7a42dab27e1844c7eeb05b91c8cde25b.jpg'),
(28, 'Diseñador', 5002, 'Avenida 2 Edificio Dos Santos', 1009, 5, 'Diurna', 'Minima de 6 meses', 108, 'Diseñador que tenga experiencia con Adobe XD', '9736547', 'Se solicita un diseñador u animador 3D', 3000000, 4, 'logo.png');

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
  `estado` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `postulacion`
--

INSERT INTO `postulacion` (`codigo`, `usuario`, `empleo`, `estado`, `fecha`) VALUES
(23, '1001', 26, 'Pendiente', '2022-09-25 00:00:00'),
(25, '1001', 27, 'Pendiente', '2022-09-26 00:00:00'),
(26, '1008', 28, 'Pendiente', '2022-09-26 00:00:00');

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
('0345', 'Tienda Pelusa', NULL, '3457283627', 'Calle 67 #45-98', 'tienda@pelusa.com', '$2y$04$SwBT44KRtMwjnM0D80hSqujMYzt.ry.4/yDytpg.9SzKRUc77Q742', 2, NULL, NULL),
('1001', 'Cristian', 'Cardona', '3897653749', 'Carrera 12 #12-34', 'cristian@gmail.com', '$2y$04$NSE0x5nVVQ.rC2XzVOAiKe.dMO9AstOPeJTw3EdQlZAKje7mr7a8y', 1, 'MARIANA MOLINA CARDONA.pdf', '3606d11ba67e1241c998764869e43fde.jpg'),
('1008', 'Andres', 'Suarez', '3986754637', 'Avenida 3 con carrera 32', 'suarez10@gmail.com', '$2y$04$DK2SgUpbciRYW3jdoKj75OJNYGjCdop.WHLew4/ebMIEVyg8aAkmW', 1, 'SIMON CARDONA JURADO.pdf', '2c8676e6035c00a6bdcbafd6e7351ac4.jpg'),
('897465', 'Tienda La Garbinga', NULL, '3456780983', 'Avenida de mis huevos morenos', 'garbin@ga.com', '$2y$04$V2LU.zghi4rm9r5EgqqmUO3qVmuBVzq/INmrrAsM4NQ4ZP9fp2W86', 2, NULL, NULL),
('9736547', 'Tienda Los Venecos', NULL, '3546828467', 'Avenida 2 con carrera 33', 'losvene@gmail.com', '$2y$04$e63uB/MgAXLveL.Y1NF4Be4LfnN.TOHtijQ.Ii1K7tAYxkgHoTLEC', 2, NULL, NULL);

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
  ADD KEY `municipio` (`municipio`),
  ADD KEY `tipo_contrato` (`tipo_contrato`),
  ADD KEY `FK_empleo_usuario` (`empresa`);

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
  MODIFY `codigo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `codigo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `postulacion`
--
ALTER TABLE `postulacion`
  MODIFY `codigo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  ADD CONSTRAINT `FK_empleo_usuario` FOREIGN KEY (`empresa`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE,
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
