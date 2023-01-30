-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: ecommerceunid
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carrito_compra`
--

DROP TABLE IF EXISTS `carrito_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrito_compra` (
  `id_carrito` int NOT NULL,
  `total_pago` int NOT NULL,
  `precio_envio` int NOT NULL,
  `id_pago_total` int NOT NULL,
  `total_productos` int NOT NULL,
  `id_usuarios` int NOT NULL,
  `id_productos` int NOT NULL,
  PRIMARY KEY (`id_carrito`,`id_pago_total`),
  KEY `id_usuarios_idx` (`id_usuarios`),
  KEY `id_productos_idx` (`id_productos`),
  CONSTRAINT `id_productos` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id_productos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_usuarios` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id_categorias` int NOT NULL,
  `nombre_categoria` varchar(45) NOT NULL,
  PRIMARY KEY (`id_categorias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ciudad` (
  `id_ciudad` int NOT NULL,
  `id_estado` int NOT NULL,
  PRIMARY KEY (`id_ciudad`),
  KEY `id_estado_idx` (`id_estado`),
  CONSTRAINT `id_estado` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `direccion_envio`
--

DROP TABLE IF EXISTS `direccion_envio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direccion_envio` (
  `id_direccion_envio` int NOT NULL,
  `id_seguimiento` int NOT NULL,
  `id_estado` int NOT NULL,
  `id_direccion` int NOT NULL,
  PRIMARY KEY (`id_direccion_envio`),
  KEY `id_seguimiento_idx` (`id_seguimiento`),
  KEY `id_estado_idx` (`id_estado`),
  KEY `id_direccion_idx` (`id_direccion`),
  CONSTRAINT `id_direccion` FOREIGN KEY (`id_direccion`) REFERENCES `direccion_usuario` (`id_direccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_estado2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_seguimiento` FOREIGN KEY (`id_seguimiento`) REFERENCES `informacion_venta` (`id_seguimiento`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `direccion_usuario`
--

DROP TABLE IF EXISTS `direccion_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direccion_usuario` (
  `id_direccion` int NOT NULL,
  `calle` varchar(50) NOT NULL,
  `avenida` varchar(50) NOT NULL,
  `cruzamiento` varchar(50) NOT NULL,
  `CP` varchar(10) NOT NULL,
  `referencias` varchar(50) NOT NULL,
  `id_usuarios` int NOT NULL,
  PRIMARY KEY (`id_direccion`),
  KEY `id_usuario_idx` (`id_usuarios`),
  CONSTRAINT `id_usuarios2` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `id_estado` int NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `historial_pedido`
--

DROP TABLE IF EXISTS `historial_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_pedido` (
  `id_historial` int NOT NULL,
  `estatus` varchar(45) NOT NULL,
  `total_producto` varchar(45) NOT NULL,
  `guia` varchar(45) NOT NULL,
  PRIMARY KEY (`id_historial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `informacion_venta`
--

DROP TABLE IF EXISTS `informacion_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `informacion_venta` (
  `id_seguimiento` int NOT NULL,
  `estatus` varchar(45) NOT NULL,
  `total_producto` varchar(45) NOT NULL,
  `guia` varchar(45) NOT NULL,
  `id_usuarios` int NOT NULL,
  `id_productos` int NOT NULL,
  `pago_total` double NOT NULL,
  PRIMARY KEY (`id_seguimiento`),
  KEY `id_usuarios_idx` (`id_usuarios`),
  KEY `id_producto_idx` (`id_productos`),
  KEY `pago_total_idx` (`pago_total`),
  CONSTRAINT `id_productos2` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id_productos`),
  CONSTRAINT `id_usuarios3` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_productos` int NOT NULL,
  `vendedor` varchar(45) NOT NULL,
  `nombre_producto` varchar(45) NOT NULL,
  `precio` double NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `imagen` tinyblob NOT NULL,
  `lugardefabrica` varchar(45) NOT NULL,
  `calificacion` int NOT NULL,
  `existencia` int NOT NULL,
  `id_vendedores` int NOT NULL,
  `id_categorias` int NOT NULL,
  PRIMARY KEY (`id_productos`),
  KEY `id_vendedor_idx` (`id_vendedores`),
  KEY `id_categoria_idx` (`id_categorias`),
  CONSTRAINT `id_categoria` FOREIGN KEY (`id_categorias`) REFERENCES `categorias` (`id_categorias`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_vendedores` FOREIGN KEY (`id_vendedores`) REFERENCES `vendedores` (`id_vendedores`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuarios` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(10) NOT NULL,
  `rol` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `codigo_verificacion` int NOT NULL,
  `cuenta_activada` varchar(45) NOT NULL,
  PRIMARY KEY (`id_usuarios`),
  UNIQUE KEY `idusuarios_UNIQUE` (`id_usuarios`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `password_UNIQUE` (`password`),
  UNIQUE KEY `codigoverificacion_UNIQUE` (`codigo_verificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id_vendedores` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `compañia` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `id_usuarios` int NOT NULL,
  `id_estado` int NOT NULL,
  PRIMARY KEY (`id_vendedores`),
  KEY `id_usuario3_idx` (`id_usuarios`),
  KEY `id_estado4_idx` (`id_estado`),
  CONSTRAINT `id_estado4` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
  CONSTRAINT `id_usuario3` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-30 17:41:11
