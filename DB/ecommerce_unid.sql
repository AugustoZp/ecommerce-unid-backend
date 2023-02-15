-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
<<<<<<< Updated upstream
-- Tiempo de generación: 15-02-2023 a las 01:47:24
=======
-- Tiempo de generación: 15-02-2023 a las 19:51:34
>>>>>>> Stashed changes
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecommerce_unid`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`) VALUES
(1, 'Funko', ''),
(2, 'Nendoroid', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `total_amount` int(6) NOT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `order_status`) VALUES
(1, 2, 789, 1),
(2, 3, 900, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(3) NOT NULL,
  `order_id` int(3) NOT NULL,
  `product_id` int(3) NOT NULL,
  `image` varchar(45) NOT NULL,
  `quantity` tinyint(2) NOT NULL DEFAULT 1,
  `price` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `image`, `quantity`, `price`) VALUES
(1, 1, 1, '', 1, 789),
(2, 2, 2, '', 1, 900);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(3) NOT NULL,
  `category_id` int(3) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `price` int(6) NOT NULL,
  `stock` int(5) NOT NULL,
  `short_desc` varchar(100) NOT NULL,
  `description` varchar(450) NOT NULL,
  `image` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `price`, `stock`, `short_desc`, `description`, `image`) VALUES
(1, 1, 'Figura Funko - Nier :Automata 2B', 789, 23, 'Una importación de Square Enix', 'Una importación de Square Enix\nUn Funko del miembro automatizado de infantería YoRHa\nIncluye placas estándar y de combate\nViene con sus armas, contrato virtuoso y tratado virtuoso y piezas de efecto acoplables\nUnidad de soporte táctico Pod 042 y una caja negra', ''),
(2, 2, 'Nendoroid Chainsaw Man Denji', 900, 19, '¡De la popular serie de manga \"Chainsaw Man\" viene un Nendoroid del personaje principal Denji! ', '¡De la popular serie de manga \"Chainsaw Man\" viene un Nendoroid del personaje principal Denji! Viene con una placa frontal estándar y una placa frontal para mostrarlo transformándose. Además, una cuerda de arranque que se adhiere a su pecho y una parte especial de la cabeza. se incluyen para mostrar a Denji en su estado transformado. ', '');

-- --------------------------------------------------------

--
<<<<<<< Updated upstream
=======
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'client');

-- --------------------------------------------------------

--
>>>>>>> Stashed changes
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(55) NOT NULL,
  `address` varchar(300) NOT NULL,
  `password` varchar(10) NOT NULL,
<<<<<<< Updated upstream
  `role` enum('user','admin') NOT NULL,
=======
  `role_id` int(1) NOT NULL DEFAULT 2,
>>>>>>> Stashed changes
  `phone_number` bigint(10) NOT NULL DEFAULT 1,
  `birth_date` date NOT NULL DEFAULT '0001-01-01',
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

<<<<<<< Updated upstream
INSERT INTO `users` (`id`, `name`, `last_name`, `username`, `email`, `address`, `password`, `role`, `phone_number`, `birth_date`, `status`) VALUES
(1, 'Augusto Misael', 'Zamudio Ponce', 'ironBael', 'forzabycats888@gmail.com', 'Región 221, Manzana 63, Lote 25, Calle 78, CP 77517', '1234567890', 'user', 9983117006, '2001-12-16', 1),
(2, 'Augusto Misael', 'Zamudio Ponce', 'ironBael2', 'forzabydark888@gmail.com', 'Región 221, Manzana 63, Lote 25, Calle 78, CP 77517', '1234567890', 'admin', 9983117006, '2001-12-16', 1),
(3, 'David Israel', 'Villalobos Sanchez', 'DIVS', 'davidisraelvillalobos@gmail.com', 'Región 221, Manzana 63, Lote 25, Calle 78, CP 77517', '1234554321', 'admin', 9983565388, '2002-01-01', 1);
=======
INSERT INTO `users` (`id`, `name`, `last_name`, `username`, `email`, `address`, `password`, `role_id`, `phone_number`, `birth_date`, `status`) VALUES
(1, 'Augusto Misael', 'Zamudio Ponce', 'ironBael', 'forzabycats888@gmail.com', 'Región 221, Manzana 63, Lote 25, Calle 78, CP 77517', '1234567890', 1, 9983117006, '2001-12-16', 1),
(2, 'Augusto Misael', 'Zamudio Ponce', 'ironBael2', 'forzabydark888@gmail.com', 'Región 221, Manzana 63, Lote 25, Calle 78, CP 77517', '1234567890', 2, 9983117006, '2001-12-16', 1),
(3, 'David Israel', 'Villalobos Sanchez', 'DIVS', 'davidisraelvillalobos@gmail.com', 'Región 221, Manzana 63, Lote 25, Calle 78, CP 77517', '1234554321', 3, 9983565388, '2002-01-01', 1);
>>>>>>> Stashed changes

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
  ADD KEY `id_seller` (`category_id`),
  ADD KEY `category_id` (`category_id`);

--
<<<<<<< Updated upstream
=======
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
>>>>>>> Stashed changes
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
<<<<<<< Updated upstream
  ADD KEY `role` (`role`);
=======
  ADD KEY `role` (`role_id`);
>>>>>>> Stashed changes

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
<<<<<<< Updated upstream
=======
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
>>>>>>> Stashed changes
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

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
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
<<<<<<< Updated upstream
=======

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
>>>>>>> Stashed changes
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
