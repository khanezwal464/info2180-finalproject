-- SQL File 

-- To install this database, from a terminal, type:
-- mysql -u USERNAME -p -h SERVERNAME dolphin_crm < schema.sql
--
-- Host: localhost    Database: dolphin_crm
-- ------------------------------------------------------

-- Database Creation
DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;
USE dolphin_crm;

-- Creation of Tables

-- User Table
DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` int NOT NULL auto_increment,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `role` enum('Admin', 'Member') NOT NULL,
  `date_time` datetime NOT NULL default current_timestamp,
  
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO users (firstname, lastname, password, email, role) VALUES 
  ('Alex', 'Robin', 'password123', 'admin@project2.com', 'Admin'),
  ('Lynne', 'Taylor', 'taylyn73265', 'lynnetaylor@gmail.com', 'Member'),
  ('Kenzie', 'McDonald', 'ruby4867!', 'kenzie.mcdonald3@gmail.com', 'Member');
SELECT LAST_INSERT_ID();

-- Contacts Table
CREATE TABLE `contacts` (
  `id` int NOT NULL auto_increment,
  `title` varchar(6) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `company` varchar(40) NOT NULL,
  `type` enum('Sales Lead', 'Support') NOT NULL,
  `assigned_to` int NOT NULL default '0',
  `created_by` int NOT NULL default '0',
  `created_at` datetime NOT NULL default current_timestamp,
  `updated_at` datetime NOT NULL default current_timestamp on update current_timestamp,
  
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by) VALUES 
  ('Mrs', 'Gwen', 'Claire', 'gwen.claire@gmail.com', '876-123-4567', 'RealCompCo', 'Support', last_insert_id(), 1);
