-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2022 a las 23:09:33
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
  `descripcion` varchar(600) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`codigo`, `usuario`, `calificacion`, `descripcion`, `fecha`) VALUES
(12, '877', 3, 'Viva Petro', '2022-10-05 08:48:06'),
(14, '1003', 5, 'Uribe paraco', '2022-10-07 17:06:44');

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
(1010, 'Responsable de las ventas'),
(1011, 'Responsable de las personas'),
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
(5, 'Antioquia');

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
(37, 'Baretologo Forense', 5021, 'Carrera 76 #54-65', 1010, 3, 'Diurna', 'Sin Experiencia', 112, 'Vender bareta a lo que mas marque', '877', 'Se solicita alguien que sepa vender bareta de la buena', 10000000, 2, 'be01aafba01c6c095d23afaa50b63d8a.jpg'),
(41, 'Desarrollador full Stack', 5400, 'Calle 24 #18-41', 1016, 0, 'Nocturna', 'Experiencia minima de 6 meses', 112, 'Desarrollador Back End', '877', 'Se solicita un desarrollador back end que programe con php', 5000000, 4, '7a42dab27e1844c7eeb05b91c8cde25b.jpg'),
(42, 'Diseñador 3D', 5148, 'Calle 24 #18-41', 1010, 5, 'Nocturna', 'Sin Experiencia', 116, 'Diseñador que tenga experiencia con Adobe XD', '988', 'Se solicita un diseñador con muy buena creatividad para diseño de interfaces, anuncios, etc.', 2500000, 4, 'red satelital.jpg'),
(43, 'Tecnico en Aviación', 5400, 'Carrera 76 #54-65', 1017, 2, 'Diurna', 'Minima de 6 meses', 112, 'Auxiliar de Vuelo', '5646', 'Se solicita un auxiliar de vuelo con muy buena actitud', 2000000, 3, '21545464-un-botón-de-pin-con-la-bandera-de-la-república-francesa-aislado-sobre-fondo-blanco-con-trazado-de-re.jpg');

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
(5021, 'Alejandrias', 5),
(5120, 'Caceres', 5),
(5125, 'Caicedo', 5),
(5148, 'El Carmen de Viboral', 5),
(5400, 'La Union', 5),
(5678, 'Andes', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `codigo` int(11) NOT NULL,
  `usuario` varchar(11) NOT NULL,
  `asunto` varchar(50) NOT NULL,
  `cuerpo` varchar(600) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`codigo`, `usuario`, `asunto`, `cuerpo`, `fecha`, `estado`) VALUES
(1, '1001', 'Prueba', 'Esto es una prueba para verificar la vista de las notificaciones y su correcto funcionamiento', '2022-10-05 19:31:17', 'leida');

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
(51, '1003', 41, 'aprobado', '2022-10-05 08:50:49'),
(52, '1003', 37, 'aprobado', '2022-10-05 08:52:00'),
(53, '1003', 43, 'aprobado', '2022-10-07 17:06:14'),
(54, '1002', 37, 'Pendiente', '2022-10-07 17:19:39'),
(55, '1002', 42, 'Pendiente', '2022-10-07 19:07:51'),
(58, '1002', 43, 'Pendiente', '2022-10-07 19:29:30');

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
(112, 'sector de las artes'),
(114, 'sector empresarial'),
(116, 'Sector de las artes marciales');

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
(4, 'Contrato de aprendizaje');

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
  `imagen` varchar(255) DEFAULT NULL,
  `estado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `telefono`, `direccion`, `correo`, `contrasena`, `perfil`, `hoja_vida`, `imagen`, `estado`) VALUES
('1001', 'Cristian', 'Cardona', '3897653749', 'Calle 65 #45', 'cristian@gmail.com', '$2y$04$PfI5fLxYiuOFWW/Xf4dRFe77kERiHGoCEGVncUyPPlyrUgz3hJ4H2', 3, 'MARIANA MOLINA CARDONA.pdf', '7a42dab27e1844c7eeb05b91c8cde25b.jpg', '1'),
('1002', 'Kick', 'Buttowski', '3426472637', 'Carrera Peligro', 'cc1001447@gmail.com', '$2y$04$uYUp3ZlCCCmdHLWEA4jgcejZIvBpGtOZacySl1p7HU22K9iNyEUrC', 1, 'SIMON CARDONA JURADO.pdf', '', '1'),
('1003', 'Capitan', 'Perico', '3546725373', 'Barrio Antioquia', 'barrio@gmail.com', '$2y$04$wXOaVv4JBFc9TIw/O/4dcOgiIxp.8ARNQiMInr/DqFxM2iorboNCG', 1, 'MARIANA MOLINA CARDONA.pdf', 'be01aafba01c6c095d23afaa50b63d8a.jpg', '0'),
('1004', 'Yesica', 'Yuyeimy', '3457283923', 'Avenida 2 puñaladas', 'navajazo@gmail.com', '$2y$04$uJvDZrb84O6BRdQ4pWB8nueyacoqOp2.50h5IQ7ZY.c7z7DrQh89a', 1, 'sin_hoja_vida', NULL, '1'),
('2001', 'Eduardo', 'Piesdeoro', '3847382947', 'Carrera 32 #45-56', 'eduardin@gmail.com', '$2y$04$EWE.ttPwL7nqCXq6hS2av.hZJNgnWxFvAIdTxULotpOJg3BrecYPa', 1, 'Pasabordo Cristian Camilo.pdf', 'red satelital.jpg', '0'),
('5646', 'Los Picapiedra', NULL, '345638182', 'Calle 54', 'pica@piedra.com', '$2y$04$DH.KsruGc0U3fwA2OJC73OhX9ukCoqy.8MTpONox8MMNXkePc.Zc6', 2, NULL, 'francia.jpg', '1'),
('5675', 'Tienda la 54', NULL, '5345834573', 'Carrera 32', 'la54@gmail.com', '$2y$04$7QetPzQHsrGVd/fmgmzjpuoaTsrR7HRg0dO3oouWQBB8IkWBlu4z6', 2, NULL, NULL, '1'),
('877', 'Tienda Los Venecos', NULL, '111111', 'Carrera 32', 'vene@gmail.com', '$2y$04$WDa26RHlkDbeqcRqkGzP7.XYDP488mvumDhhe9R8Hfrdzf6mkheNi', 2, NULL, '7a42dab27e1844c7eeb05b91c8cde25b.jpg', '1'),
('988', 'Los Chimichanga', NULL, '354722936', 'Calle 45', 'chimi@changa.com', '$2y$04$pGE/Cgf9xKnZg0ZNxcdCUeVm0sa.LSich/wg3QHA4iicQ6yUI/k.C', 2, NULL, NULL, '1');

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
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_notificacion_usuario` (`usuario`);

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
  MODIFY `codigo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `codigo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1022;

--
-- AUTO_INCREMENT de la tabla `empleo`
--
ALTER TABLE `empleo`
  MODIFY `codigo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `codigo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `postulacion`
--
ALTER TABLE `postulacion`
  MODIFY `codigo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `codigo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  MODIFY `codigo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `FK_calificacion_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empleo`
--
ALTER TABLE `empleo`
  ADD CONSTRAINT `FK_empleo_cargo` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`codigo`),
  ADD CONSTRAINT `FK_empleo_sector` FOREIGN KEY (`sector`) REFERENCES `sector` (`codigo`),
  ADD CONSTRAINT `FK_empleo_tipo_contrato` FOREIGN KEY (`tipo_contrato`) REFERENCES `tipo_contrato` (`codigo`),
  ADD CONSTRAINT `FK_empleo_usuario` FOREIGN KEY (`empresa`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empleo_ibfk_5` FOREIGN KEY (`municipio`) REFERENCES `municipio` (`codigo`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `FK_municipio_departamento` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`codigo`);

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `fk_notificacion_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`);

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
