CREATE DATABASE IF NOT EXISTS socialnet;
USE socialnet;

CREATE TABLE IF NOT EXISTS account (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    fullname VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    description TEXT
);

-- Default user for the teacher
-- Username: admin
-- Password: admin123
INSERT INTO account (username, fullname, password, description) 
VALUES ('admin', 'Administrator', '$2y$12$a050QMgYXuzsqioErpf/4.fWEz2JVkijsuTi3IqgyXvv4IeVjQdta', 'Default administrator account.');
