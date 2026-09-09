-- Run this in Navicat on the Aiven defaultdb connection.
-- This repairs the missing login table without changing existing product data.

USE defaultdb;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL DEFAULT '',
    lastname VARCHAR(100) NOT NULL DEFAULT '',
    email VARCHAR(150) NOT NULL DEFAULT '',
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (firstname, lastname, email, username, password)
SELECT 'Pantry', 'Admin', 'admin@marrows.local', 'dyarbe', '$2y$12$7CuHD/kbieCVtC.ZiN0q/OXm4gnuAA5AO9nw99dYQeLBSRPhLKD0y'
WHERE NOT EXISTS (
    SELECT 1 FROM users WHERE username = 'dyarbe'
);

SELECT id, firstname, lastname, email, username FROM users;
