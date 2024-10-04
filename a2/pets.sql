CREATE DATABASE IF NOT EXISTS petsvictoria;

USE petsvictoria;

CREATE TABLE IF NOT EXISTS pets (
    petid INT AUTO_INCREMENT PRIMARY KEY,
    petname VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    caption VARCHAR(255),
    age DOUBLE,
    type VARCHAR(50),
    location VARCHAR(100),
    image TEXT
);
