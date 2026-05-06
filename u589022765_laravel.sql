-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-05-2026 a las 12:51:21
-- Versión del servidor: 11.8.6-MariaDB-log
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u589022765_laravel`
--

--
-- Volcado de datos para la tabla `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AndrewPhaft', 'no.reply.MatthewBernard@gmail.com', '87958644859', 'info', 'Howdy-ho! aygconsultores.com.mx \r\n \r\nDid you know that it is possible to send proposal lawfully and absolutely? \r\nWhen such appeals are sent, no personal data is used, and messages are sent to forms specifically designed to receive messages and appeals securely. Feedback Forms make sure that messages won\'t be seen as junk, as they are considered essential. \r\nWe offer you to test our service for free. \r\nWe can dispatch up to 50,000 messages for you. \r\n \r\nThe cost of sending one million messages is $59. \r\n \r\nThis message was automatically generated. \r\n \r\nContact us. \r\nTelegram - https://t.me/FeedbackFormEU \r\nWhatsApp - +375259112693 \r\nWhatsApp  https://wa.me/+375259112693 \r\nWe only use chat for communication.', 'new', '2026-03-13 01:19:54', NULL),
(2, 'Mohammad Abdallah', 'taurusfinv2@gmail.com', '86172334634', 'info', 'Greetings! \r\n \r\nI am working directly with a private INVESTOR portfolio that can provide funding for credible clients with feasible projects. Currently, we have investment funds for viable projects. \r\n \r\nWe are currently seeking means of expanding and relocating our business interest in the following sectors: Banking, Real Estate, Stock Speculation and Mining, Transportation, Health sector and Tobacco or any other sector you may suggest.  The interest rate and tenure are fantastic. \r\n \r\nSend me an email on : mohammadabdalla@fennelinvestmentgroup.com \r\n \r\nKindly respond accordingly if you have interest for possible corporation. \r\n \r\nRegards, \r\nMohammad Abdallah', 'new', '2026-03-30 19:37:37', NULL),
(3, 'Davidunoke', 'no.reply.Lars-ErikDavies@gmail.com', '89498629418', 'info', 'Salutations! aygconsultores.com.mx, \r\nWhile checking websites I found aygconsultores.com.mx. \r\nWe provide a platform that helps businesses connect with website owners through their contact pages. \r\nOur system is designed to support communication with websites. \r\nBusinesses can start using the platform with a modest budget. \r\nYou can test the system without any commitment. \r\nFeel free to reach out if you would like details. \r\n \r\nThanks for reading. \r\nContact us. \r\nTelegram - https://t.me/FeedbackFormEU \r\nWhatsApp - +375259112693 \r\nWhatsApp  https://wa.me/+375259112693', 'new', '2026-04-11 05:56:34', NULL),
(4, 'David Williams', 'davidwilliams28798@gmail.com', '338303358', 'courses', 'Hi,\r\n\r\nI recently came across your website and noticed a few areas where improvements could significantly enhance your visibility on Google.\r\n\r\nWith a well-planned SEO strategy, you can attract more relevant traffic, improve your search rankings, and generate higher-quality inquiries for your business.\r\n\r\nI’d be glad to share insights on how we can strengthen your online presence, along with details of my SEO services and pricing.\r\n\r\nLet me know a convenient time to connect.\r\n\r\nRegards,\r\n\r\nDavid', 'new', '2026-04-23 04:16:05', NULL);

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `category`, `hours`, `image`, `excerpt`, `description`, `featured`, `created_at`, `updated_at`) VALUES
(1, 'Construcción de equipos de alto rendimiento', 'coaching', 'liderazgo', 20, '/storage/images/7HqaNREAZ7VIZecaEwNximaSYunVgvnDGhfOQM0P.png', 'Este curso te proporcionará las herramientas y metodologías necesarias para construir equipos de trabajo altamente efectivos. Aprenderás a crear una cultura de trabajo con ventajas competitivas, identificar las características de los equipos de alto rendimiento y establecer sistemas de trabajo que maximicen el potencial de cada miembro del equipo. A través de ejercicios prácticos y casos de estudio, podrás aplicar lo aprendido directamente en tu entorno laboral.', NULL, 1, '2025-11-21 23:51:13', '2025-11-22 00:02:42'),
(2, 'Desarrollo de habilidades blandas', 'desarrollo-personal', 'desarrollo-personal', 15, '/storage/images/YGLw7BEh4SWChEUuhNmqNEkr4Fpu9flpHJip86Kl.jpg', 'Este curso está diseñado para desarrollar las competencias no técnicas que son fundamentales para el éxito profesional en cualquier campo. A través de un enfoque práctico, aprenderás a fortalecer tu inteligencia afectiva, desarrollar habilidades conceptuales e interpersonales, y dominar habilidades de proceso esenciales para la resolución de problemas y la toma de decisiones. El programa combina teoría con ejercicios prácticos que te permitirán aplicar lo aprendido de manera inmediata en tu entorno laboral.', NULL, 1, '2025-11-22 00:00:05', '2025-11-22 00:10:23'),
(3, 'Desarrollo de habilidades gerenciales', 'desarrollo-habilidades-gerenciales', 'liderazgo', 0, '/storage/images/dFhM9UCf6lxPdR1J0dfaxNDz0bGcJA7mbfLOl04f.png', 'Este curso está diseñado para desarrollar las habilidades esenciales que todo gerente o líder necesita para gestionar equipos y organizaciones de manera efectiva. A través de un enfoque práctico y orientado a resultados, aprenderás a identificar y fortalecer tus habilidades conceptuales, interpersonales y de proceso, fundamentales para el éxito en roles de liderazgo. El programa combina teoría con ejercicios prácticos que te permitirán aplicar lo aprendido de manera inmediata en tu entorno laboral.', NULL, 0, '2025-11-22 00:12:12', '2025-11-22 00:16:30'),
(4, 'El desarrollo y tecnicas de negociación', 'tecnicas-negociacion', 'comunicacion', 0, '/storage/images/bssNCH4GYlEtkXsESDRGtcUr9xzn6w5C70DHv2qZ.jpg', 'Este curso te proporcionará las herramientas y técnicas necesarias para desarrollar habilidades de negociación efectivas que te permitirán alcanzar acuerdos beneficiosos en cualquier contexto. Aprenderás a identificar y gestionar diferentes tipos de conflictos, prepararte adecuadamente para procesos de negociación, y aplicar estrategias colaborativas que generen valor para todas las partes involucradas. A través de ejercicios prácticos y simulaciones, podrás aplicar lo aprendido en situaciones reales de negociación.', NULL, 1, '2025-11-22 00:27:52', '2025-11-22 00:28:28');

--
-- Volcado de datos para la tabla `course_contents`
--

INSERT INTO `course_contents` (`id`, `course_id`, `parent_id`, `type`, `title`, `slug`, `summary`, `body`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'unit', 'Creación de cultura de trabajo con ventajas competitivas', NULL, 'Fundamentos para establecer una cultura de trabajo efectiva y competitiva.', NULL, 1, '2025-11-21 23:52:16', '2025-11-21 23:52:16'),
(2, 1, 1, 'unit', 'El rediseño del trabajo para crear una cultura del trabajo', NULL, NULL, NULL, 1, '2025-11-21 23:52:38', '2025-11-21 23:52:38'),
(3, 1, 1, 'unit', 'Identificación de los recursos que enriquecen el trabajo', NULL, NULL, NULL, 2, '2025-11-21 23:52:56', '2025-11-21 23:52:56'),
(4, 1, 1, 'section', 'Ponderación de los recursos que enriquecen el trabajo', NULL, NULL, NULL, 3, '2025-11-21 23:53:12', '2025-11-21 23:53:12'),
(5, 1, NULL, 'unit', 'Característica de una cultura de trabajo de alto rendimiento', NULL, 'Elementos clave que definen a los equipos de alto rendimiento.', NULL, 2, '2025-11-21 23:54:16', '2025-11-21 23:54:16'),
(6, 1, 5, 'unit', 'Alineamiento en el rendimiento', NULL, NULL, NULL, 1, '2025-11-21 23:54:29', '2025-11-21 23:54:29'),
(7, 1, 5, 'unit', 'Alineamiento psicológico', NULL, NULL, NULL, 2, '2025-11-21 23:54:53', '2025-11-21 23:55:26'),
(8, 1, 5, 'unit', 'Capacidad para aprender', NULL, NULL, NULL, 3, '2025-11-21 23:55:06', '2025-11-21 23:55:26'),
(9, 1, NULL, 'unit', 'El enriquecimiento del trabajo', NULL, 'Estrategias para potenciar y enriquecer las funciones laborales.', NULL, 3, '2025-11-21 23:55:51', '2025-11-21 23:55:51'),
(10, 1, 9, 'unit', 'Metodología y caso práctico con Dinámica grupal', NULL, NULL, NULL, 1, '2025-11-21 23:56:05', '2025-11-21 23:56:05'),
(11, 1, 9, 'unit', 'El sistema de campeonatos', NULL, NULL, NULL, 2, '2025-11-21 23:56:17', '2025-11-21 23:56:17'),
(12, 1, NULL, 'unit', 'El establecimiento de un sistema de trabajo de alto rendimiento', NULL, 'Implementación de sistemas que fomenten el alto desempeño.', NULL, 4, '2025-11-21 23:56:32', '2025-11-21 23:56:56'),
(13, 1, 12, 'unit', 'Funciones esenciales para diseñar un sistema de trabajo de alto rendimiento', NULL, NULL, NULL, 1, '2025-11-21 23:57:11', '2025-11-21 23:57:11'),
(14, 1, NULL, 'exercise', 'Ejercicio de práctica', NULL, 'Aplicación práctica de los conocimientos adquiridos.', NULL, 5, '2025-11-21 23:57:33', '2025-11-21 23:57:33'),
(15, 1, 14, 'exercise', 'Elaboración de estrategia personalizada', NULL, NULL, NULL, 1, '2025-11-21 23:57:49', '2025-11-21 23:57:49'),
(16, 2, NULL, 'unit', '1. Inteligencia Afectiva', NULL, 'Desarrollo de la autoconciencia emocional y su aplicación en el entorno profesional.', NULL, 1, '2025-11-22 00:03:34', '2025-11-22 00:03:34'),
(17, 2, NULL, 'unit', '2. Habilidades Conceptuales', NULL, 'Fortalecimiento del pensamiento estratégico y sistémico.', NULL, 2, '2025-11-22 00:03:49', '2025-11-22 00:03:49'),
(18, 2, NULL, 'unit', '3. Habilidades Interpersonales', NULL, NULL, NULL, 3, '2025-11-22 00:04:18', '2025-11-22 00:04:18'),
(19, 2, NULL, 'unit', '4. Habilidades de Proceso', NULL, NULL, NULL, 4, '2025-11-22 00:04:26', '2025-11-22 00:04:26'),
(20, 2, NULL, 'unit', '5. Ejercicio de Práctica', NULL, NULL, NULL, 5, '2025-11-22 00:04:37', '2025-11-22 00:04:37'),
(21, 2, 16, 'unit', '1.1. El autoconocimiento para lograr motivación', NULL, NULL, NULL, 1, '2025-11-22 00:04:55', '2025-11-22 00:04:55'),
(22, 2, 17, 'unit', '2.1. Desarrollo de pensamiento sistémico', NULL, NULL, NULL, 1, '2025-11-22 00:05:06', '2025-11-22 00:05:06'),
(23, 2, 17, 'unit', '2.2. Construcción de una cultura de desarrollo', NULL, NULL, NULL, 2, '2025-11-22 00:05:23', '2025-11-22 00:05:23'),
(24, 2, 18, 'unit', '3.1. Comunicación para generar confianza personal y profesional', NULL, NULL, NULL, 1, '2025-11-22 00:05:41', '2025-11-22 00:05:41'),
(26, 2, 19, 'section', '4.1. Diagnóstico y visión', NULL, NULL, NULL, 1, '2025-11-22 00:06:01', '2025-11-22 00:06:01'),
(27, 2, 19, 'section', '4.2. Proceso de solución de conflictos/habilidad maestra', NULL, NULL, NULL, 2, '2025-11-22 00:06:09', '2025-11-22 00:06:09'),
(28, 2, 19, 'unit', '4.3. Toma de decisiones y consenso', NULL, NULL, NULL, 3, '2025-11-22 00:06:20', '2025-11-22 00:06:20'),
(29, 2, 19, 'unit', '4.5. Resistencia al cambio y creatividad', NULL, NULL, NULL, 7, '2025-11-22 00:06:29', '2025-11-22 00:07:13'),
(30, 2, 19, 'section', '4.4. Negociación', NULL, NULL, NULL, 5, '2025-11-22 00:06:40', '2025-11-22 00:06:40'),
(31, 2, 19, 'unit', '4.6. Gestión del tiempo y manejo de estrés', NULL, NULL, NULL, 8, '2025-11-22 00:07:24', '2025-11-22 00:07:24'),
(32, 2, 20, 'section', 'Elaboración de estrategia personalizada', NULL, NULL, NULL, 1, '2025-11-22 00:07:34', '2025-11-22 00:07:34'),
(33, 2, 18, 'section', '3.2. Organización y productividad', NULL, NULL, NULL, 2, '2025-11-22 00:09:43', '2025-11-22 00:09:43'),
(34, 2, 18, 'section', '3.3. Pensamiento crítico', NULL, NULL, NULL, 3, '2025-11-22 00:09:54', '2025-11-22 00:09:54'),
(35, 3, NULL, 'unit', '1. Diagnóstico e Identificación de Habilidades Conceptuales', NULL, 'Evaluación y desarrollo del pensamiento estratégico y sistémico.', NULL, 1, '2025-11-22 00:16:51', '2025-11-22 00:16:51'),
(36, 3, NULL, 'section', '2. Identificación de Habilidades Interpersonales', NULL, 'Desarrollo de competencias para la gestión efectiva de relaciones profesionales.', NULL, 2, '2025-11-22 00:17:06', '2025-11-22 00:17:06'),
(37, 3, NULL, 'section', '3. Habilidades de Trabajo con el Sistema de Estudio', NULL, 'Aplicación de metodologías para el análisis y mejora de sistemas organizacionales.', NULL, 3, '2025-11-22 00:17:17', '2025-11-22 00:17:17'),
(38, 3, NULL, 'section', '4. Habilidades de Proceso', NULL, 'Desarrollo de competencias para la resolución de problemas y toma de decisiones gerenciales.', NULL, 4, '2025-11-22 00:17:28', '2025-11-22 00:17:28'),
(39, 3, NULL, 'section', '5. Ejercicio de Práctica', NULL, 'Aplicación práctica de los conocimientos adquiridos.', NULL, 5, '2025-11-22 00:17:39', '2025-11-22 00:17:39'),
(40, 3, 35, 'section', '1.1. Diagnóstico de necesidades', NULL, NULL, NULL, 1, '2025-11-22 00:17:51', '2025-11-22 00:17:51'),
(43, 3, 35, 'section', '1.2. El pensamiento sistémico', NULL, NULL, NULL, 2, '2025-11-22 00:18:37', '2025-11-22 00:18:37'),
(44, 3, 35, 'section', '1.3. Los planos de análisis', NULL, NULL, NULL, 3, '2025-11-22 00:18:48', '2025-11-22 00:18:48'),
(46, 3, 40, 'section', '1.1.1. Situación actual de la organización', NULL, NULL, NULL, 1, '2025-11-22 00:19:16', '2025-11-22 00:19:16'),
(47, 3, 36, 'section', '2.1. La confianza personal y profesional', NULL, NULL, NULL, 1, '2025-11-22 00:19:31', '2025-11-22 00:19:31'),
(48, 3, 36, 'section', '2.2. El optimismo y la proactividad', NULL, NULL, NULL, 2, '2025-11-22 00:19:40', '2025-11-22 00:19:40'),
(49, 3, 37, 'section', '3.1. El proceso esencial del sistema', NULL, NULL, NULL, 1, '2025-11-22 00:19:50', '2025-11-22 00:19:50'),
(50, 3, 38, 'section', '4.1. Proceso de Solución de problemas / Habilidad maestra', NULL, NULL, NULL, 1, '2025-11-22 00:20:03', '2025-11-22 00:20:03'),
(51, 3, 38, 'section', '4.2. Toma de decisiones y solución de problemas', NULL, NULL, NULL, 2, '2025-11-22 00:20:11', '2025-11-22 00:20:11'),
(52, 3, 38, 'section', '4.3. Consenso', NULL, NULL, NULL, 3, '2025-11-22 00:24:34', '2025-11-22 00:24:34'),
(53, 3, 38, 'section', '4.4. Negociación', NULL, NULL, NULL, 4, '2025-11-22 00:24:44', '2025-11-22 00:24:44'),
(54, 3, 38, 'section', '4.5. Trabajo en equipo', NULL, NULL, NULL, 5, '2025-11-22 00:24:52', '2025-11-22 00:24:52'),
(55, 3, 38, 'section', '4.6. Resistencia al cambio', NULL, NULL, NULL, 6, '2025-11-22 00:25:00', '2025-11-22 00:25:00'),
(57, 3, 38, 'section', '4.7. Gestión del tiempo', NULL, NULL, NULL, 7, '2025-11-22 00:25:32', '2025-11-22 00:25:32'),
(58, 3, 38, 'section', '4.8. El arte de las presentaciones efectivas', NULL, NULL, NULL, 8, '2025-11-22 00:25:47', '2025-11-22 00:25:47'),
(59, 3, 39, 'section', 'Elaboración de estrategia personalizada', NULL, NULL, NULL, 1, '2025-11-22 00:25:59', '2025-11-22 00:25:59'),
(60, 4, NULL, 'section', '1. Qué es la negociación', NULL, NULL, NULL, 1, '2025-11-22 00:28:50', '2025-12-02 01:52:52'),
(61, 4, 60, 'section', '1.1. La necesidad de negociar', NULL, NULL, NULL, 1, '2025-11-22 00:28:57', '2025-11-22 00:28:57'),
(62, 4, 60, 'section', '1.2. Por qué negociar mejor', NULL, NULL, NULL, 2, '2025-11-22 00:29:04', '2025-11-22 00:29:04'),
(63, 4, NULL, 'section', '2. Los conflictos', NULL, NULL, NULL, 2, '2025-11-22 00:33:49', '2025-11-22 00:33:49'),
(64, 4, 63, 'section', '2.1. Qué es un conflicto', NULL, NULL, NULL, 1, '2025-11-22 00:37:14', '2025-11-22 00:37:14'),
(65, 4, 63, 'section', '2.2. Tipos de conflictos', NULL, NULL, NULL, 2, '2025-11-22 00:37:24', '2025-11-22 00:37:24'),
(66, 4, NULL, 'section', '3. Preparación para la negociación', NULL, NULL, NULL, 3, '2025-11-22 00:37:35', '2025-11-22 00:37:35'),
(67, 4, 66, 'section', '3.1. Las necesidades y los factores para preparar la negociación', NULL, NULL, NULL, 1, '2025-11-22 00:37:43', '2025-11-22 00:37:43'),
(68, 4, 66, 'section', '3.2. Opciones de solución', NULL, NULL, NULL, 2, '2025-11-22 00:37:55', '2025-11-22 00:37:55'),
(69, 4, 66, 'section', '3.3. La contraparte', NULL, NULL, NULL, 3, '2025-11-22 00:38:04', '2025-11-22 00:38:04'),
(70, 4, 66, 'section', '3.4. Los factores, intereses y posiciones', NULL, NULL, NULL, 4, '2025-11-22 00:38:13', '2025-11-22 00:38:13'),
(71, 4, NULL, 'section', '4. El proceso de la negociación', NULL, NULL, NULL, 4, '2025-11-22 00:39:05', '2025-11-22 00:39:05'),
(72, 4, 71, 'section', '4.1. Manejo de objeciones', NULL, NULL, NULL, 1, '2025-11-22 00:39:12', '2025-11-22 00:39:12'),
(73, 4, 71, 'section', '4.2. El acuerdo y tácticas eficaces', NULL, NULL, NULL, 2, '2025-11-22 00:39:21', '2025-11-22 00:39:21'),
(74, 4, NULL, 'section', '5. Negociación colaborativa', NULL, NULL, NULL, 5, '2025-11-22 00:39:34', '2025-11-22 00:39:34'),
(75, 4, 74, 'section', '5.1. A negociar', NULL, NULL, NULL, 1, '2025-11-22 00:39:41', '2025-11-22 00:39:41'),
(76, 4, 74, 'section', '5.2. Plan de acción', NULL, NULL, NULL, 2, '2025-11-22 00:39:48', '2025-11-22 00:39:48');

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_01_01_000000_create_courses_table', 1),
(6, '2025_01_02_create_course_contents', 1),
(7, '2025_01_02_create_course_description', 1),
(8, '2025_01_03_create_contact', 1);

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin@aygconsultores.com.mx', NULL, '$2y$12$7/Su.mDQGmoDA6wqPtdGBecvOFmbNe.16u8idsxZKntIkKWmAWDW2', NULL, '2025-11-20 06:09:50', '2025-11-20 06:09:50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
