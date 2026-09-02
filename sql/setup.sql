-- Laboratory Exercise No. 4 - Database Setup
-- Run this in Navicat (query editor) on your Aiven MySQL connection,
-- or in your local MySQL client.

CREATE DATABASE IF NOT EXISTS mydb;
USE mydb;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    username VARCHAR(100) NOT NULL
);

INSERT INTO users (firstname, lastname, email, username)
VALUES
('Larissa', 'Galan', 'larissa.galan@example.com', 'larissagalan'),
('Sabina', 'Elumba', 'sabina.elumba@example.com', 'sabinaelumba'),
('Jeorge', 'Slaying', 'jeorge.slaying@example.com', 'jeorgeslaying'),
('Wasabi', 'Na', 'wasabi.na@example.com', 'wasabina'),
('Issa', 'Milley', 'issa.milley@example.com', 'issamilley');

SELECT * FROM users;
