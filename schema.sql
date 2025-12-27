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
  ('Alex', 'Robin', ('$2y$10$Xg6HrW0r4FBRoWvuKlYf3euwulrclgyancg89anAnkOVzDsd7kI2K'), 'admin@project2.com', 'Admin'),
  ('Lynne', 'Taylor', SHA2('taylyn73265', 256), 'lynnetaylor@gmail.com', 'Member'),
  ('Kenzie', 'McDonald', SHA2('ruby4867!', 256), 'kenzie.mcdonald3@gmail.com', 'Member'),
  ('Ryan', 'Williams', SHA2('ryan@8365', 256), 'willryan12@gmail.com', 'Member'),
  ('Eve', 'Anderson', SHA2('fwf25dsh#', 256), 'eveanderson@gmail.com', 'Member');


-- Contacts Table
DROP TABLE IF EXISTS contacts;
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
  ('Mrs', 'Gwen', 'Claire', 'gwen.claire@gmail.com', '876-123-4567', 'Real Company ', 'Sales Lead', 3, 1),
  ('Mr', 'Fredrick', 'Gayle', 'fgayle@gmail.com', '876-135-2468', 'Real Company', 'Support', 4, 1),
  ('Mr', 'Zane', 'Periwinkle', 'zane.peri@gmail.com', '876-246-1357', 'Fun Co', 'Support', 2, 1),
  ('Ms', 'Andrine', 'Thompson', 'andrinethompson@gmail.com', '876-147-2580', 'Fun Co', 'Sales Lead', 2, 1),
  ('Mrs', 'Nevah', 'Havendale', 'nevah.havendale@gmail.com', '876-470-1470', 'Fun Co', 'Support', 3, 1);



-- Notes Table
DROP TABLE IF EXISTS notes;
CREATE TABLE `notes` (
  `id` int NOT NULL auto_increment,
  `contact_id` int NOT NULL default '0',
  `comment` text NOT NULL,
  `created_by` int NOT NULL default '0',
  `created_at` datetime NOT NULL default current_timestamp,
  
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO notes (contact_id, comment, created_by) VALUES 
  ('1', 'Test text for a note added by a user', '3'),
  ('3', 'More test text for a note added by a user', '2');
