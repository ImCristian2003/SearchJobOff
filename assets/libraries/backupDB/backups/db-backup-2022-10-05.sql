

CREATE TABLE `calificacion` (
  `codigo` int(3) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(11) NOT NULL,
  `calificacion` int(5) NOT NULL,
  `descripcion` varchar(600) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `usuario` (`usuario`),
  CONSTRAINT `FK_calificacion_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO calificacion VALUES("11","1003","5","La aplicación está muy bien hecha, además de tener procesos muy completos y rapidos. Uribe Paraco","2022-10-05 07:57:45");
INSERT INTO calificacion VALUES("12","877","3","Viva Petro","2022-10-05 08:48:06");





CREATE TABLE `cargo` (
  `codigo` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(600) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=1022 DEFAULT CHARSET=utf8mb4;

INSERT INTO cargo VALUES("1010","Responsable de las ventas");
INSERT INTO cargo VALUES("1011","Responsable de las personas");
INSERT INTO cargo VALUES("1013","Responsable financiero");
INSERT INTO cargo VALUES("1015","Responsable de ventas");
INSERT INTO cargo VALUES("1016","Responsable de las personas");
INSERT INTO cargo VALUES("1017","Responsable de los supervisores");





CREATE TABLE `departamento` (
  `codigo` int(2) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO departamento VALUES("5","Antioquia");





CREATE TABLE `empleo` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
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
  `logo` varchar(300) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `cargo` (`cargo`),
  KEY `sector` (`sector`),
  KEY `municipio` (`municipio`),
  KEY `tipo_contrato` (`tipo_contrato`),
  KEY `FK_empleo_usuario` (`empresa`),
  CONSTRAINT `FK_empleo_cargo` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`codigo`),
  CONSTRAINT `FK_empleo_sector` FOREIGN KEY (`sector`) REFERENCES `sector` (`codigo`),
  CONSTRAINT `FK_empleo_tipo_contrato` FOREIGN KEY (`tipo_contrato`) REFERENCES `tipo_contrato` (`codigo`),
  CONSTRAINT `FK_empleo_usuario` FOREIGN KEY (`empresa`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `empleo_ibfk_5` FOREIGN KEY (`municipio`) REFERENCES `municipio` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

INSERT INTO empleo VALUES("37","Baretologo Forense","5021","Carrera 76 #54-65","1010","4","Diurna","Sin Experiencia","112","Vender bareta a lo que mas marque","877","Se solicita alguien que sepa vender bareta de la buena","10000000","2","be01aafba01c6c095d23afaa50b63d8a.jpg");
INSERT INTO empleo VALUES("41","Desarrollador full Stack","5400","Calle 24 #18-41","1016","0","Nocturna","Experiencia minima de 6 meses","112","Desarrollador Back End","877","Se solicita un desarrollador back end que programe con php","5000000","4","7a42dab27e1844c7eeb05b91c8cde25b.jpg");





CREATE TABLE `municipio` (
  `codigo` int(5) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `departamento` int(2) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `departamento` (`departamento`),
  CONSTRAINT `FK_municipio_departamento` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO municipio VALUES("5001","Medellin","5");
INSERT INTO municipio VALUES("5021","Alejandrias","5");
INSERT INTO municipio VALUES("5120","Caceres","5");
INSERT INTO municipio VALUES("5125","Caicedo","5");
INSERT INTO municipio VALUES("5148","El Carmen de Viboral","5");
INSERT INTO municipio VALUES("5400","La Union","5");
INSERT INTO municipio VALUES("5678","Andes","5");





CREATE TABLE `perfil` (
  `codigo` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO perfil VALUES("1","empleado");
INSERT INTO perfil VALUES("2","empresa");
INSERT INTO perfil VALUES("3","administrador");





CREATE TABLE `postulacion` (
  `codigo` int(4) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(11) NOT NULL,
  `empleo` int(5) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `empleo` (`empleo`),
  KEY `usuario` (`usuario`),
  CONSTRAINT `FK_postulacion_empleo` FOREIGN KEY (`empleo`) REFERENCES `empleo` (`codigo`),
  CONSTRAINT `postulacion_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;

INSERT INTO postulacion VALUES("51","1003","41","aprobado","2022-10-05 08:50:49");
INSERT INTO postulacion VALUES("52","1003","37","Pendiente","2022-10-05 08:52:00");





CREATE TABLE `sector` (
  `codigo` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4;

INSERT INTO sector VALUES("106","Sector transporte");
INSERT INTO sector VALUES("107","sector comunicaciones");
INSERT INTO sector VALUES("108","sector comercial");
INSERT INTO sector VALUES("112","sector de las artes");
INSERT INTO sector VALUES("114","sector empresarial");
INSERT INTO sector VALUES("116","Sector de las artes marciales");





CREATE TABLE `tipo_contrato` (
  `codigo` int(1) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO tipo_contrato VALUES("1","Contrato a término fijos");
INSERT INTO tipo_contrato VALUES("2","Contrato a Término Indefinido");
INSERT INTO tipo_contrato VALUES("3","Contrato de Obra o labor ");
INSERT INTO tipo_contrato VALUES("4","Contrato de aprendizaje");





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
  PRIMARY KEY (`id`),
  KEY `perfil` (`perfil`),
  CONSTRAINT `FK_usuario_perfil` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO usuario VALUES("1001","Cristian","Cardona","3897653749","Calle 65 #45","cristian@gmail.com","$2y$04$qf0JjWfVREsZr5tfb272hetH8KLi4rKg.O5pGPXPDb3odl3ruW4dm","3","MARIANA MOLINA CARDONA.pdf","7a42dab27e1844c7eeb05b91c8cde25b.jpg");
INSERT INTO usuario VALUES("1002","Kick","Buttowski","3426472637","Carrera Peligro","adrenalina@gmail.com","$2y$04$uYUp3ZlCCCmdHLWEA4jgcejZIvBpGtOZacySl1p7HU22K9iNyEUrC","1","SIMON CARDONA JURADO.pdf","");
INSERT INTO usuario VALUES("1003","Capitan","Perico","3546725373","Barrio Antioquia","barrio@gmail.com","$2y$04$wXOaVv4JBFc9TIw/O/4dcOgiIxp.8ARNQiMInr/DqFxM2iorboNCG","1","MARIANA MOLINA CARDONA.pdf","be01aafba01c6c095d23afaa50b63d8a.jpg");
INSERT INTO usuario VALUES("1004","Yesica","Yuyeimy","3457283923","Avenida 2 puñaladas","navajazo@gmail.com","$2y$04$uJvDZrb84O6BRdQ4pWB8nueyacoqOp2.50h5IQ7ZY.c7z7DrQh89a","1","sin_hoja_vida","");
INSERT INTO usuario VALUES("2001","Eduardo","Piesdeoro","3847382947","Carrera 32 #45-56","eduardin@gmail.com","$2y$04$EWE.ttPwL7nqCXq6hS2av.hZJNgnWxFvAIdTxULotpOJg3BrecYPa","1","Pasabordo Cristian Camilo.pdf","red satelital.jpg");
INSERT INTO usuario VALUES("5646","Los Picapiedra","","345638182","Calle 54","pica@piedra.com","$2y$04$DH.KsruGc0U3fwA2OJC73OhX9ukCoqy.8MTpONox8MMNXkePc.Zc6","2","","");
INSERT INTO usuario VALUES("5675","Tienda la 54","","5345834573","Carrera 32","la54@gmail.com","$2y$04$7QetPzQHsrGVd/fmgmzjpuoaTsrR7HRg0dO3oouWQBB8IkWBlu4z6","2","","");
INSERT INTO usuario VALUES("877","Tienda Los Venecos","","111111","Carrera 32","vene@gmail.com","$2y$04$WDa26RHlkDbeqcRqkGzP7.XYDP488mvumDhhe9R8Hfrdzf6mkheNi","2","","7a42dab27e1844c7eeb05b91c8cde25b.jpg");
INSERT INTO usuario VALUES("988","Los Chimichanga","","354722936","Calle 45","chimi@changa.com","$2y$04$pGE/Cgf9xKnZg0ZNxcdCUeVm0sa.LSich/wg3QHA4iicQ6yUI/k.C","2","","");



