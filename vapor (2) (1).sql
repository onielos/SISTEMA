-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 04:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vapor`
--

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `cc_name` varchar(255) DEFAULT NULL,
  `cc_brand` varchar(50) DEFAULT NULL,
  `cc_last` varchar(4) DEFAULT NULL,
  `cc_bin` varchar(6) DEFAULT NULL,
  `cc_type` varchar(50) DEFAULT NULL,
  `device` varchar(50) DEFAULT NULL,
  `fraud_score` decimal(5,2) DEFAULT NULL,
  `system_message` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `client` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`client`)),
  `response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`response`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `authorization_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`id`, `payment_id`, `status`, `message`, `cc_name`, `cc_brand`, `cc_last`, `cc_bin`, `cc_type`, `device`, `fraud_score`, `system_message`, `transaction_id`, `hash`, `comments`, `client`, `response`, `created_at`, `updated_at`, `authorization_id`) VALUES
(1, 1, 'success', 'Pago exitoso', 'Juan Pérez', 'Visa', '1234', '496078', 'credit', 'Chrome', 5.00, 'Autorizado', 'TX123456', 'HASH123456', 'Sin comentarios', '{}', '{\"success\":false,\"message\":\"Resultado incorrectos de CAM, dCVV, iCVV o CVV.\",\"data\":{\"attempt_id\":null,\"transaction_id\":\"4eebdeae-cb79-4032-b84b-6421a4cf468a\",\"transaction_reference\":\"503018002620\",\"transaction_time\":\"180037\",\"transaction_date\":\"0130\",\"transaction_stan\":\"002620\",\"transaction_batch\":\"000038\",\"response_approved\":false,\"response_fail\":false,\"response_incomplete\":false,\"response_code\":\"82\",\"response_time\":\"1.174\",\"comments\":[{\"code\":\"INFO\",\"message\":\"3D-Secure v.2.2.0\",\"value\":\"2.2.0\"},{\"code\":\"3DS\",\"message\":\"Transacci\\u00f3n segura autenticada con 3D Secure.\",\"value\":\"05\"},{\"code\":\"3DS\",\"message\":\"CAVV: AJkBBDiSBgAAAJJxNAMEdQAAAAA=\",\"value\":\"AJkBBDiSBgAAAJJxNAMEdQAAAAA=\"},{\"code\":\"3DS\",\"message\":\"XID: fc959964-3cfd-4e76-9937-274615b06eca\",\"value\":\"fc959964-3cfd-4e76-9937-274615b06eca\"},{\"code\":\"INFO\",\"message\":\"Autenticaci\\u00f3n completada exitosamente.\",\"value\":\"Y\"},{\"code\":\"CAVVF\",\"message\":\"Validaci\\u00f3n fallida de CAVV (autenticaci\\u00f3n): siempre que haya implementado el proceso VBV correctamente, la responsabilidad de esta transacci\\u00f3n debe permanecer con el Emisor por los c\\u00f3digos de raz\\u00f3n de contracargo cubiertos por Verified by Visa.\",\"value\":\"1\"}],\"transaction_type\":\"sale\",\"transaction_amount\":9999.99,\"transaction_auth\":null,\"transaction_terminal\":\"03791935\",\"transaction_merchant\":\" 0282002551\",\"response_cvn\":null,\"response_avs\":null,\"response_cavv\":\"1\",\"transaction_approved_amount\":9999.99},\"status\":402} ', '2025-02-02 20:16:27', '2025-02-05 17:18:51', '123456'),
(23, 23, 'success', 'Pago exitoso', 'María López', 'MasterCard', '5678', '496079', 'credit', 'Firefox', 4.00, 'Autorizado', 'TX002', 'HASH002', 'Sin comentarios', '{}', '{\"data\": [{\"comments\": \"Todo en orden.\"}]}', '2025-02-02 20:50:41', '2025-02-02 20:50:41', '123457'),
(24, 24, 'failed', 'Pago fallido', 'Carlos Sánchez', 'Visa', '9101', '496080', 'credit', 'Safari', 8.00, 'Rechazado', 'TX003', 'HASH003', 'Sin comentarios', '{}', '{\"data\": [{\"comments\": \"Error en la transacción.\"}]}', '2025-02-02 20:50:41', '2025-02-02 20:50:41', '123458'),
(25, 24, 'success', 'Pago exitoso', 'Ana Torres', 'American Express', '1122', '496081', 'credit', 'Edge', 2.00, 'Autorizado', 'TX004', 'HASH004', 'Sin comentarios', '{}', '{\"data\": [{\"comments\": \"Todo en orden.\"}]}', '2025-02-02 20:50:41', '2025-02-02 20:50:41', '123459'),
(26, 25, 'success', 'Pago exitoso', 'Luis Martínez', 'Visa', '3344', '496082', 'credit', 'Chrome', 3.00, 'Autorizado', 'TX005', 'HASH005', 'Sin comentarios', '{}', '{\"data\": [{\"comments\": \"Todo en orden.\"}]}', '2025-02-02 20:50:41', '2025-02-02 20:50:41', '123460'),
(27, 26, 'pending', 'Pago pendiente', 'Sofía Ruiz', 'MasterCard', '5566', '496083', 'credit', 'Firefox', 6.00, 'Pendiente', 'TX006', 'HASH006', 'Sin comentarios', '{}', '{\"data\": [{\"comments\": \"Esperando autorización.\"}]}', '2025-02-02 20:50:41', '2025-02-02 20:50:41', '123461'),
(28, 27, 'success', 'Pago exitoso', 'Javier Gómez', 'Visa', '7788', '496084', 'credit', 'Safari', 1.00, 'Autorizado', 'TX007', 'HASH007', 'Sin comentarios', '{}', '{\"data\": [{\"comments\": \"Todo en orden.\"}]}', '2025-02-02 20:50:41', '2025-02-02 20:50:41', '123462'),
(29, 28, 'success', 'Pago exitoso', 'Clara Jiménez', 'American Express', '9900', '496085', 'credit', 'Edge', 9.00, 'Autorizado', 'TX008', 'HASH008', 'Sin comentarios', '{}', '{\"data\": [{\"comments\": \"Todo en orden.\"}]}', '2025-02-02 20:50:41', '2025-02-02 20:50:41', '123463'),
(30, 29, 'failed', 'Pago fallido', 'Fernando Castro', 'Visa', '2233', '496086', 'credit', 'Chrome', 7.00, 'Rechazado', 'TX009', 'HASH009', 'Sin comentarios', '{}', '{\"data\": [{\"comments\": \"Error en la transacción.\"}]}', '2025-02-02 20:50:41', '2025-02-02 20:50:41', '123464'),
(31, 30, 'success', 'Pago exitoso', 'Patricia León', 'MasterCard', '4455', '496087', 'credit', 'Firefox', 0.50, 'Autorizado', 'TX010', 'HASH010', 'Sin comentarios', '{}', '{\"data\": [{\"comments\": \"Todo en orden.\"}]}', '2025-02-02 20:50:41', '2025-02-02 20:50:41', '123465');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `app_lang` varchar(10) DEFAULT NULL,
  `app_key` varchar(255) DEFAULT NULL,
  `app_hash` varchar(255) DEFAULT NULL,
  `app_url` varchar(255) DEFAULT NULL,
  `gateway_token` varchar(255) DEFAULT NULL,
  `mcc` varchar(10) DEFAULT NULL,
  `is_suspended` tinyint(4) DEFAULT 0,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `csv_modules` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`csv_modules`)),
  `conditional_rate` decimal(10,2) DEFAULT 0.00,
  `pending_fee` decimal(10,2) DEFAULT 0.00,
  `deleted_at` datetime DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `state` varchar(50) DEFAULT NULL,
  `activation_date` datetime DEFAULT NULL,
  `suspended_at` datetime DEFAULT NULL,
  `trial_started_at` datetime DEFAULT NULL,
  `is_demo` tinyint(4) DEFAULT 0,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `slug`, `plan_id`, `email`, `phone`, `address`, `currency`, `app_lang`, `app_key`, `app_hash`, `app_url`, `gateway_token`, `mcc`, `is_suspended`, `options`, `csv_modules`, `conditional_rate`, `pending_fee`, `deleted_at`, `paid_at`, `created_at`, `updated_at`, `state`, `activation_date`, `suspended_at`, `trial_started_at`, `is_demo`, `status`) VALUES
(3, 'Empresa C', 'empresa-c', 1, 'empresaC@email.com', '3456789012', 'Calle 789, Ciudad', 'USD', 'es', 'KEY34567', 'HASH34567', 'https://empresaC.com', 'TOKEN34567', 'MCC345', 0, '{}', NULL, NULL, 0.00, NULL, NULL, '2025-02-02 20:45:22', '2025-02-02 20:45:22', 'activo', NULL, NULL, NULL, 0, 'active'),
(4, 'Empresa D', 'empresa-d', 2, 'empresaD@email.com', '4567890123', 'Carrera 101, Ciudad', 'USD', 'es', 'KEY45678', 'HASH45678', 'https://empresaD.com', 'TOKEN45678', 'MCC456', 0, '{}', NULL, NULL, 0.00, NULL, NULL, '2025-02-02 20:45:22', '2025-02-02 20:45:22', 'activo', NULL, NULL, NULL, 0, 'active'),
(5, 'Empresa E', 'empresa-e', 1, 'empresaE@email.com', '5678901234', 'Calle 202, Ciudad', 'USD', 'es', 'KEY56789', 'HASH56789', 'https://empresaE.com', 'TOKEN56789', 'MCC567', 0, '{}', NULL, NULL, 0.00, NULL, NULL, '2025-02-02 20:45:22', '2025-02-02 20:45:22', 'activo', NULL, NULL, NULL, 0, 'active'),
(6, 'Empresa F', 'empresa-f', 2, 'empresaF@email.com', '6789012345', 'Avenida 303, Ciudad', 'USD', 'es', 'KEY67890', 'HASH67890', 'https://empresaF.com', 'TOKEN67890', 'MCC678', 0, '{}', NULL, NULL, 0.00, NULL, NULL, '2025-02-02 20:45:22', '2025-02-02 20:45:22', 'activo', NULL, NULL, NULL, 0, 'active'),
(7, 'Empresa G', 'empresa-g', 1, 'empresaG@email.com', '7890123456', 'Calle 404, Ciudad', 'USD', 'es', 'KEY78901', 'HASH78901', 'https://empresaG.com', 'TOKEN78901', 'MCC789', 0, '{}', NULL, NULL, 0.00, NULL, NULL, '2025-02-02 20:45:22', '2025-02-02 20:45:22', 'activo', NULL, NULL, NULL, 0, 'active'),
(8, 'Empresa H', 'empresa-h', 2, 'empresaH@email.com', '8901234567', 'Carrera 505, Ciudad', 'USD', 'es', 'KEY89012', 'HASH89012', 'https://empresaH.com', 'TOKEN89012', 'MCC890', 0, '{}', NULL, NULL, 0.00, NULL, NULL, '2025-02-02 20:45:22', '2025-02-02 20:45:22', 'activo', NULL, NULL, NULL, 0, 'active'),
(9, 'Empresa I', 'empresa-i', 1, 'empresaI@email.com', '9012345678', 'Calle 606, Ciudad', 'USD', 'es', 'KEY90123', 'HASH90123', 'https://empresaI.com', 'TOKEN90123', 'MCC901', 0, '{}', NULL, NULL, 0.00, NULL, NULL, '2025-02-02 20:45:22', '2025-02-02 20:45:22', 'activo', NULL, NULL, NULL, 0, 'active'),
(10, 'Empresa J', 'empresa-j', 2, 'empresaJ@email.com', '0123456789', 'Avenida 707, Ciudad', 'USD', 'es', 'KEY01234', 'HASH01234', 'https://empresaJ.com', 'TOKEN01234', 'MCC012', 0, '{}', NULL, NULL, 0.00, NULL, NULL, '2025-02-02 20:45:22', '2025-02-02 20:45:22', 'activo', NULL, NULL, NULL, 0, 'active'),
(1302, 'Empresa Test', 'empresa-test', 1, 'empresaTest@email.com', '1234567890', 'Calle 123, Ciudad', 'USD', 'es', 'KEY12345', 'HASH12345', 'https://empresaTest.com', 'TOKEN12345', 'MCC123', 0, '{}', NULL, NULL, 0.00, NULL, NULL, '2025-02-02 20:16:27', '2025-02-02 20:16:27', 'activo', NULL, NULL, NULL, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `gateway` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `lang` varchar(10) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `exchange_rate` decimal(10,4) DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `extra` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra`)),
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `paid_attempt_id` int(11) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `authorized_at` datetime DEFAULT NULL,
  `due_at` datetime DEFAULT NULL,
  `is_queued` tinyint(4) DEFAULT 0,
  `is_hook` tinyint(4) DEFAULT 0,
  `is_overdue` tinyint(4) DEFAULT 0,
  `is_check` tinyint(4) DEFAULT 0,
  `is_test` tinyint(4) DEFAULT 0,
  `expired_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `ref`, `uuid`, `gateway`, `status`, `type`, `currency`, `description`, `note`, `category`, `customer_name`, `customer_email`, `customer_phone`, `lang`, `amount`, `tax_amount`, `exchange_rate`, `content`, `extra`, `properties`, `company_id`, `user_id`, `paid_attempt_id`, `paid_at`, `authorized_at`, `due_at`, `is_queued`, `is_hook`, `is_overdue`, `is_check`, `is_test`, `expired_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'REF123456', '94fb09ae-e1a2-11ef-9d79-9408539af33c', 'Stripe', 'completed', 'sale', 'USD', 'Pago de servicio', 'Nota de prueba', 'Servicios', 'Juan Pérez', 'juan@email.com', '5551234567', 'ES', 150.00, 15.00, NULL, '{}', '{}', '{}', 1302, 1, NULL, '2025-02-02 14:16:27', '2025-02-02 14:16:27', '2025-02-02 14:16:27', 0, 0, 0, 0, 0, NULL, NULL, '2025-02-02 20:16:27', '2025-02-02 20:16:27'),
(22, 'REF001', '0cbc56ec-e1a7-11ef-9d79-9408539af33c', 'Stripe', 'completed', 'sale', 'USD', 'Pago por servicio uno', 'Nota uno', 'Servicios', 'Cliente Uno', 'clienteuno@email.com', '5550000101', 'ES', 100.00, 10.00, NULL, '{}', '{}', '{}', 6, 1, NULL, '2025-02-02 14:48:26', '2025-02-02 14:48:26', '2025-02-02 14:48:26', 0, 0, 0, 0, 0, NULL, NULL, '2025-02-02 20:48:26', '2025-02-02 20:48:26'),
(23, 'REF002', '0cbcca39-e1a7-11ef-9d79-9408539af33c', 'PayPal', 'completed', 'sale', 'USD', 'Pago por servicio dos', 'Nota dos', 'Servicios', 'Cliente Dos', 'clientedos@email.com', '5550000102', 'ES', 150.00, 15.00, NULL, '{}', '{}', '{}', 4, 1, NULL, '2025-02-02 14:48:26', '2025-02-02 14:48:26', '2025-02-02 14:48:26', 0, 0, 0, 0, 0, NULL, NULL, '2025-02-02 20:48:26', '2025-02-02 20:48:26'),
(24, 'REF003', '0cbccbd8-e1a7-11ef-9d79-9408539af33c', 'Stripe', 'pending', 'sale', 'USD', 'Pago por servicio tres', 'Nota tres', 'Servicios', 'Cliente Tres', 'clientetres@email.com', '5550000103', 'ES', 200.00, 20.00, NULL, '{}', '{}', '{}', 5, 1, NULL, '2025-02-02 14:48:26', '2025-02-02 14:48:26', '2025-02-02 14:48:26', 0, 0, 0, 0, 0, NULL, NULL, '2025-02-02 20:48:26', '2025-02-02 20:48:26'),
(25, 'REF004', '0cbccc7a-e1a7-11ef-9d79-9408539af33c', 'PayPal', 'failed', 'sale', 'USD', 'Pago por servicio cuatro', 'Nota cuatro', 'Servicios', 'Cliente Cuatro', 'clientecuatro@email.com', '5550000104', 'ES', 250.00, 25.00, NULL, '{}', '{}', '{}', 4, 1, NULL, '2025-02-02 14:48:26', '2025-02-02 14:48:26', '2025-02-02 14:48:26', 0, 0, 0, 0, 0, NULL, NULL, '2025-02-02 20:48:26', '2025-02-02 20:48:26'),
(26, 'REF005', '0cbccd22-e1a7-11ef-9d79-9408539af33c', 'Stripe', 'completed', 'sale', 'USD', 'Pago por servicio cinco', 'Nota cinco', 'Servicios', 'Cliente Cinco', 'clientecinco@email.com', '5550000105', 'ES', 300.00, 30.00, NULL, '{}', '{}', '{}', 5, 1, NULL, '2025-02-02 14:48:26', '2025-02-02 14:48:26', '2025-02-02 14:48:26', 0, 0, 0, 0, 0, NULL, NULL, '2025-02-02 20:48:26', '2025-02-02 20:48:26'),
(27, 'REF006', '0cbccdb6-e1a7-11ef-9d79-9408539af33c', 'PayPal', 'completed', 'sale', 'USD', 'Pago por servicio seis', 'Nota seis', 'Servicios', 'Cliente Seis', 'clienteseis@email.com', '5550000106', 'ES', 350.00, 35.00, NULL, '{}', '{}', '{}', 6, 1, NULL, '2025-02-02 14:48:26', '2025-02-02 14:48:26', '2025-02-02 14:48:26', 0, 0, 0, 0, 0, NULL, NULL, '2025-02-02 20:48:26', '2025-02-02 20:48:26'),
(28, 'REF007', '0cbcce52-e1a7-11ef-9d79-9408539af33c', 'Stripe', 'completed', 'sale', 'USD', 'Pago por servicio siete', 'Nota siete', 'Servicios', 'Cliente Siete', 'clientesiete@email.com', '5550000107', 'ES', 400.00, 40.00, NULL, '{}', '{}', '{}', 7, 1, NULL, '2025-02-02 14:48:26', '2025-02-02 14:48:26', '2025-02-02 14:48:26', 0, 0, 0, 0, 0, NULL, NULL, '2025-02-02 20:48:26', '2025-02-02 20:48:26'),
(29, 'REF008', '0cbccfa1-e1a7-11ef-9d79-9408539af33c', 'PayPal', 'completed', 'sale', 'USD', 'Pago por servicio ocho', 'Nota ocho', 'Servicios', 'Cliente Ocho', 'clienteocho@email.com', '5550000108', 'ES', 450.00, 45.00, NULL, '{}', '{}', '{}', 8, 1, NULL, '2025-02-02 14:48:26', '2025-02-02 14:48:26', '2025-02-02 14:48:26', 0, 0, 0, 0, 0, NULL, NULL, '2025-02-02 20:48:26', '2025-02-02 20:48:26'),
(30, 'REF009', '0cbcd02f-e1a7-11ef-9d79-9408539af33c', 'Stripe', 'pending', 'sale', 'USD', 'Pago por servicio nueve', 'Nota nueve', 'Servicios', 'Cliente Nueve', 'clientenueve@email.com', '5550000109', 'ES', 500.00, 50.00, NULL, '{}', '{}', '{}', 9, 1, NULL, '2025-02-02 14:48:26', '2025-02-02 14:48:26', '2025-02-02 14:48:26', 0, 0, 0, 0, 0, NULL, NULL, '2025-02-02 20:48:26', '2025-02-02 20:48:26'),
(31, 'REF010', '0cbcd0b5-e1a7-11ef-9d79-9408539af33c', 'PayPal', 'completed', 'sale', 'USD', 'Pago por servicio diez', 'Nota diez', 'Servicios', 'Cliente Diez', 'clientediez@email.com', '5550000010', 'ES', 550.00, 55.00, NULL, '{}', '{}', '{}', 10, 1, NULL, '2025-02-02 14:48:26', '2025-02-02 14:48:26', '2025-02-02 14:48:26', 0, 0, 0, 0, 0, NULL, NULL, '2025-02-02 20:48:26', '2025-02-02 20:48:26'),
(32, 'ref1', 'uuid-1', 'gateway1', 'completed', 'sale', 'LPS', 'Descripción 1', 'Nota 1', 'categoria1', 'Cliente 1', 'cliente1@example.com', '12345678', 'es', 2000.00, 0.00, NULL, NULL, NULL, NULL, 1302, NULL, NULL, '2025-02-05 11:57:05', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, '2025-02-05 17:57:05', '2025-02-05 17:57:05'),
(33, 'ref2', 'uuid-2', 'gateway2', 'completed', 'sale', 'LPS', 'Descripción 2', 'Nota 2', 'categoria2', 'Cliente 2', 'cliente2@example.com', '12345678', 'es', 1713.00, 0.00, NULL, NULL, NULL, NULL, 1302, NULL, NULL, '2025-02-05 11:57:05', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, '2025-02-05 17:57:05', '2025-02-05 17:57:05'),
(34, 'ref3', 'uuid-3', 'gateway3', 'completed', 'sale', 'USD', 'Descripción 3', 'Nota 3', 'categoria3', 'Cliente 3', 'cliente3@example.com', '12345678', 'es', 5.99, 0.00, NULL, NULL, NULL, NULL, 1302, NULL, NULL, '2025-02-05 11:57:05', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, '2025-02-05 17:57:05', '2025-02-05 17:57:05'),
(35, 'ref4', 'uuid-4', 'gateway4', 'completed', 'sale', 'USD', 'Descripción 4', 'Nota 4', 'categoria4', 'Cliente 4', 'cliente4@example.com', '12345678', 'es', 5.99, 0.00, NULL, NULL, NULL, NULL, 1302, NULL, NULL, '2025-02-05 11:57:05', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, '2025-02-05 17:57:05', '2025-02-05 17:57:05'),
(36, 'ref5', 'uuid-5', 'gateway5', 'completed', 'sale', 'USD', 'Descripción 5', 'Nota 5', 'categoria5', 'Cliente 5', 'cliente5@example.com', '12345678', 'es', 5.99, 0.00, NULL, NULL, NULL, NULL, 1302, NULL, NULL, '2025-02-05 11:57:05', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, '2025-02-05 17:57:05', '2025-02-05 17:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_path` text NOT NULL,
  `upload_date` text NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `file_name`, `file_path`, `upload_date`, `user`) VALUES
(1, 'processed_Copia de Transacciones Fraude al 15-01-25.xlsx', 'uploads/files/processed_Copia de Transacciones Fraude al 15-01-25.xlsx', '2025-02-21 03:50:55', 'admin'),
(2, 'processed_Copia de Transacciones Fraude al 15-01-25.xlsx', 'uploads/files/processed_Copia de Transacciones Fraude al 15-01-25.xlsx', '2025-02-21 04:13:09', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `displayname_user` varchar(255) NOT NULL,
  `username_user` varchar(100) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `picture_user` varchar(255) DEFAULT NULL,
  `rol_user` enum('Administrador','Empleado') DEFAULT 'Empleado',
  `status_user` int(2) NOT NULL,
  `last_login_user` datetime DEFAULT NULL,
  `date_created_user` datetime DEFAULT current_timestamp(),
  `date_updated_user` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `displayname_user`, `username_user`, `password_user`, `picture_user`, `rol_user`, `status_user`, `last_login_user`, `date_created_user`, `date_updated_user`) VALUES
(15, 'admin', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'uploads/users/user-default.png', 'Administrador', 1, '2025-02-20 19:36:27', '2025-02-07 21:22:46', '2025-02-20 19:36:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username_user` (`username_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1303;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
