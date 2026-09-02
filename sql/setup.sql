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
('Jarbie', 'De Leon', 'jarbie@example.com', 'dyarbe'),
('Mark James', 'Belen', 'james@example.com', 'dyems'),
('Dylan Andrew', 'Danar', 'dylan@example.com', 'Dylan'),
('Roy Jr.', 'Flauta', 'Roi@example.com', 'balong'),
('Russel', 'Militar', 'russel@example.com', 'russel');

SELECT * FROM users;
