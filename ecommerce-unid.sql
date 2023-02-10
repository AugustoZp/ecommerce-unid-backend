-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-02-2023 a las 21:40:58
-- Versión del servidor: 10.5.16-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id20281525_ecommerce_unid`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(3) NOT NULL,
  `seller_id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `seller_id`, `name`, `image`) VALUES
(1, 1, 'Funko', ''),
(2, 2, 'Nendoroid', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `user_email` varchar(55) NOT NULL,
  `order_address` varchar(200) NOT NULL,
  `total_amount` int(6) NOT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_email`, `order_address`, `total_amount`, `order_status`) VALUES
(1, 2, 'forzabycats888@gmail.com', 'Región 221, Manzana 63, Lote 25, Calle 78, CP 77517', 789, 1),
(2, 3, 'davidisraelvillalobos@gmail.com', 'Región 233, Manzana 67, Lote 5, Calle 88, CP 77510', 900, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(3) NOT NULL,
  `order_id` int(3) NOT NULL,
  `product_id` int(3) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `order_address` varchar(200) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `image` varchar(45) NOT NULL,
  `quantity` tinyint(2) NOT NULL DEFAULT 1,
  `total_amount` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `product_name`, `order_address`, `state`, `city`, `image`, `quantity`, `total_amount`) VALUES
(1, 1, 1, 'Figura Funko - Nier :Automata 2B', 'Región 221, Manzana 63, Lote 25, Calle 78, CP 77517, Cancún, Benito Juárez, México', 'Quintana Roo', 'Cancún', '', 1, 789),
(2, 2, 2, 'Nendoroid Chainsaw Man Denji', 'Región 233, Manzana 67, Lote 5, Calle 88, CP 77510, Cancún, Benito Juárez, México', 'Quintana Roo', 'Cancún', '', 1, 900);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(3) NOT NULL,
  `seller_id` int(3) NOT NULL,
  `category_id` int(3) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `price` int(6) NOT NULL,
  `quantity` int(5) NOT NULL,
  `short_desc` varchar(100) NOT NULL,
  `description` varchar(450) NOT NULL,
  `image` varchar(45) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `seller_id`, `category_id`, `product_name`, `price`, `quantity`, `short_desc`, `description`, `image`, `available`) VALUES
(1, 1, 1, 'Figura Funko - Nier :Automata 2B', 789, 23, 'Una importación de Square Enix', 'Una importación de Square Enix\nUn Funko del miembro automatizado de infantería YoRHa\nIncluye placas estándar y de combate\nViene con sus armas, contrato virtuoso y tratado virtuoso y piezas de efecto acoplables\nUnidad de soporte táctico Pod 042 y una caja negra', '', 1),
(2, 2, 2, 'Nendoroid Chainsaw Man Denji', 900, 19, '¡De la popular serie de manga \"Chainsaw Man\" viene un Nendoroid del personaje principal Denji! ', '¡De la popular serie de manga \"Chainsaw Man\" viene un Nendoroid del personaje principal Denji! Viene con una placa frontal estándar y una placa frontal para mostrarlo transformándose. Además, una cuerda de arranque que se adhiere a su pecho y una parte especial de la cabeza. se incluyen para mostrar a Denji en su estado transformado. ', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sellers`
--

CREATE TABLE `sellers` (
  `id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone_number` bigint(10) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 2,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sellers`
--

INSERT INTO `sellers` (`id`, `user_id`, `name`, `last_name`, `username`, `email`, `phone_number`, `role`, `status`) VALUES
(1, 1, 'Augusto Misael', 'Zamudio Ponce', 'ironBael', 'forzabycats888@gmail.com', 9983117006, 2, 1),
(2, 3, 'David Israel', 'Villalobos Sanchez', 'DIVS', 'davidisraelvillalobos@gmail.com', 9983565388, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(55) NOT NULL,
  `address` varchar(200) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 1,
  `phone_number` bigint(10) NOT NULL DEFAULT 1,
  `birth_date` date NOT NULL DEFAULT '0001-01-01',
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `username`, `email`, `address`, `state`, `city`, `password`, `role`, `phone_number`, `birth_date`, `status`) VALUES
(1, 'Augusto Misael', 'Zamudio Ponce', 'ironBael', 'forzabycats888@gmail.com', 'Región 221, Manzana 63, Lote 25, Calle 78, CP 77517', 'Quintana Roo', 'Cancún', '1234567890', 2, 9983117006, '2001-12-16', 1),
(2, 'Augusto Misael', 'Zamudio Ponce', 'ironBael2', 'forzabycats888@gmail.com', 'Región 221, Manzana 63, Lote 25, Calle 78, CP 77517', 'Quintana Roo', 'Cancún', '1234567890', 1, 9983117006, '2001-12-16', 1),
(3, 'David Israel', 'Villalobos Sanchez', 'DIVS', 'davidisraelvillalobos@gmail.com', '', 'Quintana Roo', 'Cancún', '1234554321', 2, 9983565388, '2002-01-01', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_seller` (`seller_id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`user_id`);

--
-- Indices de la tabla `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_seller` (`seller_id`,`category_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `username` (`username`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `fk_sellers_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellers_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
