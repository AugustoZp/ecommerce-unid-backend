-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-04-2023 a las 12:18:16
-- Versión del servidor: 10.3.38-MariaDB-log-cll-lve
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistuscc_Ecommerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(3) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `creation_date` date NOT NULL DEFAULT '0001-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `creation_date`) VALUES
(1, 'Furyuu', '', '2023-03-09'),
(2, 'Nendoroid', '', '2023-03-09'),
(3, 'Good Smile Company', '', '2023-03-09'),
(4, 'POP UP PARADE', '', '2023-03-09'),
(5, 'Taito', '', '2023-03-18'),
(6, 'Banpresto', '', '2023-03-09'),
(7, 'Mangas', '', '2023-03-20'),
(8, 'Funko', '', '2023-03-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `total_amount` int(6) NOT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT 1,
  `creation_date` date NOT NULL DEFAULT '0001-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `order_status`, `creation_date`) VALUES
(1, 2, 1779, 1, '2023-03-12'),
(2, 3, 1609, 1, '2023-03-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(3) NOT NULL,
  `order_id` int(3) NOT NULL,
  `product_id` int(3) NOT NULL,
  `image` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` tinyint(2) NOT NULL DEFAULT 1,
  `price` int(6) NOT NULL,
  `creation_date` date NOT NULL DEFAULT '0001-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `image`, `quantity`, `price`, `creation_date`) VALUES
(1, 1, 3, '', 1, 1779, '2023-03-12'),
(2, 2, 5, '', 1, 1609, '2023-03-18');

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
  `short_desc` varchar(500) NOT NULL,
  `description` varchar(1600) NOT NULL,
  `image` varchar(45) NOT NULL,
  `creation_date` date NOT NULL DEFAULT '0001-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `price`, `stock`, `short_desc`, `description`, `image`, `creation_date`) VALUES
(1, 8, 'Figura Funko - Nier :Automata 2B', 789, 23, 'Una importacion de Square Enix', 'Una importacion de Square Enix\r\nUn Funko del miembro automatizado de infanteria YoRHa\r\nIncluye placas estandar y de combate\r\nViene con sus armas, contrato virtuoso y tratado virtuoso y piezas de efecto acoplables\r\nUnidad de soporte tactico Pod 042 y una caja negra', '', '2023-03-18'),
(2, 2, 'Nendoroid Chainsaw Man Denji', 900, 19, 'De la popular serie de manga Chainsaw Man viene un Nendoroid del personaje principal Denji ', 'De la popular serie de manga Chainsaw Man viene un Nendoroid del personaje principal Denji Viene con una placa frontal estandar y una placa frontal para mostrarlo transformandose. Ademas, una cuerda de arranque que se adhiere a su pecho y una parte especial de la cabeza. se incluyen para mostrar a Denji en su estado transformado. ', '', '2023-03-18'),
(3, 1, 'Hatsune Miku Love Sailor', 1779, 2, 'Figura de Miku Hatsune con vestido de marinera de color violeta', 'Figura de Miku Hatsune con vestido de marinera de color violeta, la idol virtual de Vocaloid, fabricada por FuRyu para su serie Noodle Stopper Figure con 13 cm de altura.', '', '2023-03-01'),
(4, 6, 'Figura Rimuru Tempest - banpresto', 650, 2, 'Slime Rimuru Otherworlder', 'De That Time I Got Reincarnated as a Slime viene That Time I Got Reincarnated as a Slime Rimuru Otherworlder vol. 13 estatua. Esta figura esta hecha de PVC y mide aproximadamente 7 pulgadas de alto.', '', '2023-03-20'),
(5, 2, 'Figura Nendoroid - Nier :Automata A2', 1609, 4, 'Una importacion de Square Enix', 'el Android de batalla multiusos YoRHa Tipo A No.2A2. Viene con tres placas faciales, incluyendo una expresion estandar, una expresion de combate y una expresion berserk B Mode. Las partes opcionales incluyen su espada tipo 40 y hoja tipo 40 ambas con partes de efecto ataque incluidas junto con una hoja de efecto claro B Mode. Disfruta recreando todo tipo de poses del juego.', '', '2023-03-18'),
(6, 6, 'Rent-A-Girlfriend Ruka Sarashina Exhibition V', 650, 1, 'Del anime Rent A Girlfriend\r\n', 'Del anime Rent A Girlfriend llega Rent A Girlfrien...\r\n', '', '2023-03-20'),
(7, 7, 'Horimiya Manga Set [en Japones]', 3616, 1, 'PRODUCTO EN JAPONES\r\nPRODUCTO IMPORTADO DESDE JAPON', 'Kyoko Hori podria parecer una adolescente normal, pero es una persona completamente distinta despues de clases. En la ausencia de sus padres trabajadores, Hori ha sido como una madre para su pequenho hermano desde que ambos eran pequenhos; entre cuidar a su hermano, cocinar para ambos y los que haceres de la casa, ella no tiene mucho tiempo para tener la normal vida social de un adolescente. Un dia, conoce a alguien el cual tampoco muestra su verdadero ser en el instituto, un tranquilo y taciturno chico llamado Izumi Miyamura. Ella habia asumido que Izumi era un raton de biblioteca, y posiblemente un otaku, pero no podria haber estado mas equivocada. Fuera del instituto, Izumi es un sujeto amigable con gran cantidad de perforaciones corporales y tatuajes, y no es muy bueno en lo academico. Ahora ambos tienen una persona a la cual le pueden mostrar ambos lados de sus vidas.', '', '2023-03-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `creation_date` date NOT NULL DEFAULT '0001-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `creation_date`) VALUES
(1, 'admin', '2023-01-01'),
(2, 'user', '2023-01-01'),
(3, 'client', '2023-01-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(1) NOT NULL DEFAULT 2,
  `phone_number` bigint(10) NOT NULL DEFAULT 1,
  `birth_date` date NOT NULL DEFAULT '0001-01-01',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `creation_date` date NOT NULL DEFAULT '0001-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `username`, `email`, `address`, `password`, `role_id`, `phone_number`, `birth_date`, `status`, `creation_date`) VALUES
(1, 'Augusto Misael', 'Zamudio Ponce', 'ironBael', 'forzabycats888@gmail.com', 'Region 221, Manzana 63, Lote 25, Calle 78, CP 77517', '1234567890', 1, 9983117006, '2001-12-16', 1, '2001-12-16'),
(2, 'Augusto Misael', 'Zamudio Ponce', 'ironBael2', 'forzabydark888@gmail.com', 'Region 221, Manzana 63, Lote 25, Calle 78, CP 77517', '1234567890', 3, 9983117006, '2001-12-16', 1, '2023-03-01'),
(3, 'David Israel', 'Villalobos Sanchez', 'DIVS', 'davidisraelvillalobos@gmail.com', 'Region 221, Manzana 63, Lote 25, Calle 78, CP 77517', '1234554321', 3, 9983565388, '2002-01-01', 1, '2023-03-17'),
(4, 'Juan Andres', 'Realpozo Torres', 'Lepudini', 'pudin@gmail.com', 'Region 221 Manzana 63 Lote 25 Calle 78 CP 77517', 'awuita', 2, 9984994991, '2002-08-20', 1, '2023-03-20'),
(5, 'Gerardo', 'Casanova', 'Cascas', 'gerardoc@gmail.com', 'Region 221, Manzana 63, Lote 25, Calle 78, CP 77517', 'cascas', 2, 5454357384, '2002-04-24', 1, '2023-03-20'),
(6, 'Karen Sofia', 'Guillen Gonzalez', 'Kareng13', 'kareng13@gmail.com', 'No, gracias', 'kareng13', 2, 9983039421, '1998-07-13', 1, '2023-03-20'),
(7, 'Moana', 'Rivera Padilla', 'Mou', 'moanar@gmail.com', 'No, gracias', 'moamou', 2, 9984200835, '2001-10-21', 1, '2023-03-21'),
(8, 'Antonio ', 'Antonio', 'Antony', 'Antony@gmail.com', 'Despues de casa de Augusto', 'Antony', 2, 9984001356, '2002-02-11', 1, '2023-03-21'),
(9, 'wez', 'lambardo', 'lacasa1', 'awdawd@gmail.com', 'la casa', '11234', 2, 529984994991, '2023-04-14', 1, '2023-04-14'),
(10, 'Melina', 'Sanchez', 'MelinaS', 'MelinaSanchez@gmail.com', 'Region 221, Manzana 63, Lote 25, Calle 78, CP 77517', 'MelinaS00', 2, 9393949592, '2001-12-12', 1, '2023-04-14'),
(11, 'Jesus', 'Morales', 'JesusM', 'Jesus@gmail.com', 'Region 221, Manzana 63, Lote 25, Calle 78, CP 77517', 'JesusM12', 2, 9192939495, '1990-12-12', 1, '2023-04-14');

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
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
