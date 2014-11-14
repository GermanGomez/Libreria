/*
SQLyog Ultimate v9.63 
MySQL - 5.6.16 : Database - libreria
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`libreria` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `libreria`;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(45) NOT NULL DEFAULT '0000',
  `Nombre` text,
  `Telefono` varchar(45) DEFAULT NULL,
  `Direccion` text,
  `Correo` varchar(45) DEFAULT NULL,
  `Activo` int(11) DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Codigo_UNIQUE` (`Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `clientes` */

insert  into `clientes`(`ID`,`Codigo`,`Nombre`,`Telefono`,`Direccion`,`Correo`,`Activo`) values (1,'001','Sandy','2281089360','Veracruz','sandy@hotmail.com',0),(2,'002','Cindy Mulato','2281089340','Xalapa','cindy@hotmail.com',1),(3,'1234567890','sdf','2281089360','Xalapa','m@hotmail.com',0),(4,'003','Cristina','7858300934','Xalaa','cris@hotmail.com',1),(5,'004','Hassam','2281084357','Xalapa','hassam@hotmail.com',1);

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(45) NOT NULL DEFAULT '0000',
  `Nombre` text,
  `Telefono` varchar(45) DEFAULT NULL,
  `Direccion` text,
  `Correo` varchar(45) DEFAULT NULL,
  `Usuario` varchar(30) DEFAULT NULL,
  `Contrasenia` varchar(16) DEFAULT NULL,
  `Activo` int(11) DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Codigo_UNIQUE` (`Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `empleados` */

insert  into `empleados`(`ID`,`Codigo`,`Nombre`,`Telefono`,`Direccion`,`Correo`,`Usuario`,`Contrasenia`,`Activo`) values (1,'001','Hassam','2281782258','Xalapa','m@hotmail.com','Hasammmmmm','12434324324324',1),(2,'21321','dfssfsfs','2288479839','Xalapa','wwqdwqd@hotmail.com','ffsfsfsdfsdffsfs','12345678',0),(3,'002','Sandy','2281089360','Zapata','sandy@hotmail.com','SandyMulato','1234567',1),(4,'003','Diana Yanez','2289384722','Xalapa','diana@hotmail.com','diana','123456677',0),(6,'009','Brenda','2281094839','Xalapa','afs@hotmail.com','Brendaaaaaaaa','12345678',1);

/*Table structure for table `libros` */

DROP TABLE IF EXISTS `libros`;

CREATE TABLE `libros` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(45) NOT NULL DEFAULT '0000',
  `Nombre` text,
  `Editorial` text,
  `Autor` text,
  `Edicion` varchar(45) DEFAULT NULL,
  `Anio` int(11) DEFAULT NULL,
  `Pais` varchar(45) DEFAULT NULL,
  `Costo` decimal(10,2) DEFAULT '0.00',
  `Precio_Venta` decimal(10,2) DEFAULT '0.00',
  `Existencias` int(11) DEFAULT '0',
  `Activo` int(11) DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Codigo_UNIQUE` (`Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `libros` */

insert  into `libros`(`ID`,`Codigo`,`Nombre`,`Editorial`,`Autor`,`Edicion`,`Anio`,`Pais`,`Costo`,`Precio_Venta`,`Existencias`,`Activo`) values (1,'001','Matematicas','Mexico','Sanches','5a',1991,'Mexico','430.00','500.00',30,1),(2,'002','Español','Porrua','Martha','2a',2004,'Brasil','300.00','350.00',120,1),(3,'003','Informatica','Mc Graw Hill','Jhonson & Jhonson','2a edicion',2005,'Chie','500.00','800.00',50,1),(4,'004','Gografia','Pegasso\r\n','Gonzales ','3a edicion',2008,'España','550.00','600.00',60,1),(5,'005','Ingeniera Software','Oceano','Alberto','1a edicion',2010,'Mexico','200.00','300.00',80,0),(6,'006','Fisica','Antillas','Herman','Premiun',2014,'Canada','800.00','10000.00',15,1),(8,'007','alicia','fomento','alicia','3',2012,'argentina','250.00','350.00',0,1);

/*Table structure for table `proveedores` */

DROP TABLE IF EXISTS `proveedores`;

CREATE TABLE `proveedores` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(45) NOT NULL,
  `Nombre_Empresa` text,
  `Telefono` varchar(45) DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `Agente_Ventas` text,
  `Activo` int(11) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `proveedores` */

insert  into `proveedores`(`ID`,`Codigo`,`Nombre_Empresa`,`Telefono`,`Correo`,`Agente_Ventas`,`Activo`) values (1,'001','Porrua','2281089340','j@hotmail.com','Francisco',1),(2,'002','Mc-Gran Hill','2288821322','saa@hotmail.com','Andres Gonzales',1),(3,'sfsfs','sfsf','2281089340','sdfdsds@hotmail.com','safasfsaf',0),(4,'003','Pegasso','2289352840','pegasso@hotmail.com','Fernanda Gutierrez',0),(5,'004','Antillas','2281094990','antillas@hotmail.com','Gabriel Garcia',0);

/*Table structure for table `ventas_detalle` */

DROP TABLE IF EXISTS `ventas_detalle`;

CREATE TABLE `ventas_detalle` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Folio` int(11) NOT NULL,
  `Codigo_Libro` varchar(45) NOT NULL,
  `Nombre_Libro` text,
  `Cantidad` int(11) DEFAULT '0',
  `Precio_Unitario` decimal(10,2) DEFAULT '0.00',
  `Monto` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Folio_UNIQUE` (`Folio`),
  UNIQUE KEY `Codigo_Libro_UNIQUE` (`Codigo_Libro`),
  KEY `fk_Ventas_Detalle_Ventas_Encabezado1_idx` (`Folio`,`ID`),
  CONSTRAINT `fk_Ventas_Detalle_Libros1` FOREIGN KEY (`Codigo_Libro`) REFERENCES `libros` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ventas_Detalle_Ventas_Encabezado1` FOREIGN KEY (`Folio`, `ID`) REFERENCES `ventas_encabezado` (`Folio`, `ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ventas_detalle` */

/*Table structure for table `ventas_encabezado` */

DROP TABLE IF EXISTS `ventas_encabezado`;

CREATE TABLE `ventas_encabezado` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Folio` int(11) NOT NULL,
  `Fecha` varchar(45) DEFAULT NULL,
  `Hora` varchar(45) DEFAULT NULL,
  `Codigo_Empleado` varchar(45) DEFAULT NULL,
  `Codigo_Cliente` varchar(45) DEFAULT NULL,
  `Monto_Total` decimal(10,2) DEFAULT NULL,
  `Activo` int(11) DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Folio_UNIQUE` (`Folio`),
  KEY `fk_Ventas_Encabezado_Empleados_idx` (`Codigo_Empleado`),
  KEY `fk_Ventas_Encabezado_Clientes_idx` (`Codigo_Cliente`),
  CONSTRAINT `fk_Ventas_Encabezado_Clientes` FOREIGN KEY (`Codigo_Cliente`) REFERENCES `clientes` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ventas_Encabezado_Empleados` FOREIGN KEY (`Codigo_Empleado`) REFERENCES `empleados` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ventas_encabezado` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
