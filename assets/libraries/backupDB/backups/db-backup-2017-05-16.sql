

CREATE TABLE `tbclientes` (
  `codigo` int(30) NOT NULL AUTO_INCREMENT,
  `Cliente` varchar(50) NOT NULL,
  `RNC` varchar(50) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `Contacto` varchar(30) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Email` varchar(40) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO tbclientes VALUES("12","jose","09432042093","casa","934059034","040534095","casa@gmail.com");
INSERT INTO tbclientes VALUES("13","maria laura","09432042093","casa","934059034","040534095","casa@gmail.com");
INSERT INTO tbclientes VALUES("14","mirian","09432042093","casa","00000000","040534095","casa@gmail.com");
INSERT INTO tbclientes VALUES("15","amaury","09432042093","casa","934059034","040534095","casa@gmail.com");
INSERT INTO tbclientes VALUES("16","amaury","09432042093","casa","934059034","040534095","casa@gmail.com");





CREATE TABLE `tbcombopro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO tbcombopro VALUES("4","muebles");
INSERT INTO tbcombopro VALUES("5","camas");
INSERT INTO tbcombopro VALUES("6","sillas");
INSERT INTO tbcombopro VALUES("7","comedores");
INSERT INTO tbcombopro VALUES("8","oficinas");
INSERT INTO tbcombopro VALUES("9","prueba");





CREATE TABLE `tbface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userd` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `tbfactura` (
  `id_factura` int(100) NOT NULL AUTO_INCREMENT,
  `Cliente` varchar(100) NOT NULL,
  `RNC` varchar(100) NOT NULL,
  `Fecha` varchar(100) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `precio` varchar(100) NOT NULL,
  `cantidad` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tipo_pago` varchar(50) NOT NULL,
  PRIMARY KEY (`id_factura`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

INSERT INTO tbfactura VALUES("2","Freddy","324234234234","lunes, 27 de febrero de 2017 03:36:09 ","Comedor + 6 Sillas en Madera ","200","1","1298","");
INSERT INTO tbfactura VALUES("39","Freddy","324234234234","sabado, 04 de marzo de 2017 08:35:54 ","Comedor + 6 Sillas en Madera prueba","200","1","236","");
INSERT INTO tbfactura VALUES("40","Freddy","324234234234","domingo, 02 de abril de 2017 06:18:23 ","Comedor + 6 Sillas en Madera ","200","1","236","Contado");
INSERT INTO tbfactura VALUES("41","Freddy","324234234234","2017-03-02","Comedor + 6 Sillas en Madera ","200","1","236","Contado");
INSERT INTO tbfactura VALUES("42","Freddy","324234234234","2017-04-01","Comedor + 6 Sillas en Madera ","200","1","236","Contado");
INSERT INTO tbfactura VALUES("43","Freddy","324234234234","2017-04-02","Comedor + 6 Sillas en Madera ","200","1","236","");





CREATE TABLE `tbminifactura` (
  `id_minifactura` int(11) NOT NULL AUTO_INCREMENT,
  `Cliente` varchar(200) NOT NULL,
  `Articulos` varchar(200) NOT NULL,
  `Cantidad` varchar(200) NOT NULL,
  `Total` varchar(200) NOT NULL,
  PRIMARY KEY (`id_minifactura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `tbproductos` (
  `id_productos` int(11) NOT NULL AUTO_INCREMENT,
  `Articulo` varchar(50) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Precio` varchar(50) NOT NULL,
  `Cantidad` varchar(100) NOT NULL,
  `Imagen` varchar(200) NOT NULL,
  `Tipo_producto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_productos`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

INSERT INTO tbproductos VALUES("2","Cama Sencilla en Madera","dfg","200","10","Cama en Caoba.jpg","camas");
INSERT INTO tbproductos VALUES("5","mueble en caoba","nose k va aki","300","198","Mueble4.png","muebles");
INSERT INTO tbproductos VALUES("15","mueble en caoba","nose k va aki","200","300","Mueble4.png","muebles");
INSERT INTO tbproductos VALUES("16","mueble en caoba","nose k va aki","300","10","Mueble4.png","muebles");
INSERT INTO tbproductos VALUES("18","Cama Sencilla en Madera","dfg","200","10","Cama en Caoba.jpg","camas");
INSERT INTO tbproductos VALUES("19","Cama Sencilla en Madera","dfg","200","10","Cama en Caoba.jpg","camas");
INSERT INTO tbproductos VALUES("20","Sillas Sencillas Para Tu Hogar  ","nose k va aki","300","200","descarga.gif","sillas");
INSERT INTO tbproductos VALUES("21","Sillas Sencillas Para Tu Hogar  ","nose k va aki","300","200","descarga.gif","sillas");
INSERT INTO tbproductos VALUES("22","Sillas Sencillas Para Tu Hogar  ","nose k va aki","300","200","descarga.gif","sillas");
INSERT INTO tbproductos VALUES("23","Comedor + 6 Sillas en Madera   ","nose k va aki","300","200","639746502000_F1.jpg","comedores");
INSERT INTO tbproductos VALUES("24","Comedor + 6 Sillas en Madera   ","nose k va aki","300","200","639746502000_F1.jpg","comedores");
INSERT INTO tbproductos VALUES("25","Comedor + 6 Sillas en Madera   ","nose k va aki","300","200","639746502000_F1.jpg","comedores");
INSERT INTO tbproductos VALUES("26","Comedor + 6 Sillas en Madera ","dfg","200","7","comedor_imgfondo6.jpg","oficinas");
INSERT INTO tbproductos VALUES("27","Comedor + 6 Sillas en Madera ","dfg","200","8","comedor_imgfondo6.jpg","oficinas");
INSERT INTO tbproductos VALUES("28","Comedor + 6 Sillas en Madera prueba","dfg","200","10","comedor_imgfondo6.jpg","oficinas");





CREATE TABLE `tbsuplidores` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Empresa` varchar(80) NOT NULL,
  `Direccion` varchar(80) NOT NULL,
  `Telefono` varchar(80) NOT NULL,
  `Contacto` varchar(80) NOT NULL,
  `RNC` varchar(80) NOT NULL,
  `Email` varchar(80) NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbsuplidores VALUES("1","Los Arrozes ","los alcarrizos ","809-588-5845","Jose Martin","4026545215-1","josemartin@hotmail.com");





CREATE TABLE `tbusuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(40) NOT NULL,
  `contrasena` varchar(30) NOT NULL,
  `status` varchar(25) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO tbusuario VALUES("1","freddy","12345","Usuario 1","");
INSERT INTO tbusuario VALUES("3","jose","123","Usuario 2","");
INSERT INTO tbusuario VALUES("4","miguel","333","Usuario 3","");
INSERT INTO tbusuario VALUES("5","fresa","123","Administrador","fran.jpg");



