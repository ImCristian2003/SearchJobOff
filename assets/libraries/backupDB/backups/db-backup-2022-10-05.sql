

CREATE TABLE `calificacion` (
  `codigo` int(3) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(11) NOT NULL,
  `calificacion` int(5) NOT NULL,
  `descripcion` varchar(600) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `usuario` (`usuario`),
  CONSTRAINT `FK_calificacion_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO calificacion VALUES("4","1001","3","Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ratione quae, odit ullam inventore enim aut. Illo vero maiores autem iusto veniam, ullam expedita odit, debitis, error architecto dignissimos quidem?","2022-09-29 19:57:16");
INSERT INTO calificacion VALUES("8","877","4","Una recontrachimba so, awo awo ohhh si","2022-10-04 15:29:00");





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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

INSERT INTO empleo VALUES("37","Baretologo Forense","5021","Carrera 76 #54-65","1010","4","Diurna","Sin Experiencia","112","Vender bareta a lo que mas marque","877","Se solicita alguien que sepa vender bareta de la buena","10000000","2","be01aafba01c6c095d23afaa50b63d8a.jpg");
INSERT INTO empleo VALUES("39","Diseñador 3D","5400","Carrera 76 #54-65","1015","5","Nocturna","Sin Experiencia","114","Diseñador que tenga experiencia con Adobe XD","877","Se solicita un diseñador con muy buena creatividad para diseño de interfaces, anuncios, etc.","3000000","2","sin_logo");





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
INSERT INTO municipio VALUES("5667","San Rafael","5");





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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;






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

INSERT INTO usuario VALUES("1001","Cristian","Cardona","3897653749","Calle 65 #45","cristian@gmail.com","$2y$04$5GusbVBlw85o0z0jvXrjye56DBaGRqlnxFbHyFopBEUQFjSYIATju","3","MARIANA MOLINA CARDONA.pdf","7a42dab27e1844c7eeb05b91c8cde25b.jpg");
INSERT INTO usuario VALUES("2001","Eduardo","Piesdeoro","3847382947","Carrera 32 #45-56","eduardin@gmail.com","$2y$04$EWE.ttPwL7nqCXq6hS2av.hZJNgnWxFvAIdTxULotpOJg3BrecYPa","1","Pasabordo Cristian Camilo.pdf","red satelital.jpg");
INSERT INTO usuario VALUES("877","Tienda Los Venecos","","34573848263","Carrera 32","vene@gmail.com","$2y$04$m3STnjlAg/4BktBe7zunJOxVoS9KLWcER1Pl1lEYkB075rfk2TgkS","2","","7a42dab27e1844c7eeb05b91c8cde25b.jpg");



