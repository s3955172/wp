CREATE DATABASE IF NOT EXISTS petsvictoria;

USE petsvictoria;

CREATE TABLE IF NOT EXISTS pets (
    petid INT AUTO_INCREMENT PRIMARY KEY,
    petname VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    caption VARCHAR(255),
    age DOUBLE NOT NULL,
    type VARCHAR(50) NOT NULL,
    location VARCHAR(255) NOT NULL,
    image VARCHAR(255)
);

-- Example data to populate the table (optional)
INSERT INTO pets (petname, description, caption, age, type, location, image)
VALUES
('Milo', 'Friendly and energetic cat who loves to play.', 'Milo the Cat', 10.1, 'Cat', 'Upper Ferntree Gully', 'cat1.jpeg'),
('Baxter', 'A loyal dog who enjoys long walks.', 'Baxter the Dog', 15.5, 'Dog', 'Melbourne CBD', 'dog1.jpeg'),
('Luna', 'A curious cat who enjoys chasing toys.', 'Luna the Cat', 8.4, 'Cat', 'Cape Woolamai', 'cat2.jpeg'),
('Willow', 'Loves running and fetching balls.', 'Willow the Dog', 24.7, 'Dog', 'Grampians', 'dog2.jpeg'),
('Oliver', 'Calm and affectionate dog.', 'Oliver the Dog', 36.3, 'Dog', 'Carlton', 'dog3.jpeg');
