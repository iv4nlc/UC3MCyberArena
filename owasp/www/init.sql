-- docker exec -it 2centweb-db-mysql mysql -u root -p
-- Enter password: rootpassword

CREATE DATABASE IF NOT EXISTS silent_boundary;
USE silent_boundary;
GRANT ALL PRIVILEGES ON silent_boundary.* TO '2centweb_user'@'%';
FLUSH PRIVILEGES;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(5) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES ('admin', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'); 
-- The password hash corresponds to: XXXXXXXXXXXXXXXX

CREATE DATABASE dgt;
GRANT SELECT ON dgt.* TO '2centweb_user'@'%';
FLUSH PRIVILEGES;
USE dgt;

CREATE TABLE vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(50),
    model VARCHAR(50),
    year INT
);

CREATE TABLE drivers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    license_number VARCHAR(50)
);

-- Insert some dummy data into vehicles
INSERT INTO vehicles (brand, model, year) VALUES
('Toyota', 'Corolla', 2019),
('Toyota', 'Camry', 2020),
('Toyota', 'Highlander', 2021),
('BMW', 'M3', 2020),
('BMW', 'X5', 2021),
('BMW', 'Z4', 2020),
('Audi', 'A4', 2021),
('Audi', 'Q5', 2020),
('Audi', 'A6', 2019),
('Audi', 'A8', 2020),
('Nissan', 'Altima', 2018),
('Nissan', 'Maxima', 2019),
('Nissan', '370Z', 2020),
('Ford', 'Focus', 2017),
('Ford', 'Mustang', 2021),
('Ford', 'Explorer', 2020),
('Chevrolet', 'Malibu', 2020),
('Chevrolet', 'Camaro', 2021),
('Chevrolet', 'Silverado', 2020),
('Mercedes', 'C-Class', 2019),
('Mercedes', 'S-Class', 2020),
('Mercedes', 'GLC', 2021),
('Honda', 'Civic', 2020),
('Honda', 'Accord', 2021),
('Honda', 'Pilot', 2020),
('Tesla', 'Model 3', 2021),
('Tesla', 'Model X', 2020),
('Tesla', 'Model Y', 2021),
('Hyundai', 'Elantra', 2020),
('Hyundai', 'Tucson', 2021),
('Hyundai', 'Santa Fe', 2020),
('Kia', 'Optima', 2020),
('Kia', 'Sportage', 2021),
('Kia', 'Sorrento', 2020),
('Volkswagen', 'Jetta', 2019),
('Volkswagen', 'Golf', 2021),
('Volkswagen', 'Passat', 2020),
('Mazda', 'CX-5', 2021),
('Mazda', 'Mazda3', 2020),
('Mazda', 'MX-5 Miata', 2020),
('Subaru', 'Outback', 2021),
('Subaru', 'Forester', 2020),
('Subaru', 'Impreza', 2020),
('Lexus', 'RX', 2021),
('Lexus', 'IS', 2020),
('Lexus', 'ES', 2021),
('Jaguar', 'XE', 2020),
('Jaguar', 'F-PACE', 2021),
('Land Rover', 'Discovery', 2020),
('Land Rover', 'Range Rover', 2021),
('Porsche', 'Cayenne', 2020),
('Porsche', 'Macan', 2021),
('Ferrari', '488 GTB', 2020),
('Ferrari', 'Portofino', 2021);

-- Insert some dummy data into drivers
INSERT INTO drivers (name, license_number) VALUES
('John Doe', 'A1234B'),
('Jane Smith', 'B5678C'),
('Michael Johnson', 'X9876Y'),
('Sarah Lee', 'Y1234Z'),
('David Brown', 'Z5678A'),
('Emma White', 'W1234X'),
('Chris Green', 'C9876Y'),
('Linda Blue', 'L5678Z');

CREATE DATABASE dgt_testing;
USE dgt_testing;
GRANT SELECT ON dgt_testing.* TO '2centweb_user'@'%';
FLUSH PRIVILEGES;

CREATE TABLE vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(50),
    model VARCHAR(50),
    year INT
);

CREATE TABLE drivers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    license_number VARCHAR(50)
);

CREATE TABLE secret (
    exercise VARCHAR(50),
    flag VARCHAR(100)
);

-- Insert data into vehicles (same as dgt)
INSERT INTO vehicles (brand, model, year) VALUES
('Toyota', 'Corolla', 2019),
('Toyota', 'Camry', 2020),
('Toyota', 'Highlander', 2021),
('BMW', 'M3', 2020),
('BMW', 'X5', 2021),
('BMW', 'Z4', 2020),
('Audi', 'A4', 2021),
('Audi', 'Q5', 2020),
('Audi', 'A6', 2019),
('Audi', 'A8', 2020),
('Nissan', 'Altima', 2018),
('Nissan', 'Maxima', 2019),
('Nissan', '370Z', 2020),
('Ford', 'Focus', 2017),
('Ford', 'Mustang', 2021),
('Ford', 'Explorer', 2020),
('Chevrolet', 'Malibu', 2020),
('Chevrolet', 'Camaro', 2021),
('Chevrolet', 'Silverado', 2020),
('Mercedes', 'C-Class', 2019),
('Mercedes', 'S-Class', 2020),
('Mercedes', 'GLC', 2021),
('Honda', 'Civic', 2020),
('Honda', 'Accord', 2021),
('Honda', 'Pilot', 2020),
('Tesla', 'Model 3', 2021),
('Tesla', 'Model X', 2020),
('Tesla', 'Model Y', 2021),
('Hyundai', 'Elantra', 2020),
('Hyundai', 'Tucson', 2021),
('Hyundai', 'Santa Fe', 2020),
('Kia', 'Optima', 2020),
('Kia', 'Sportage', 2021),
('Kia', 'Sorrento', 2020),
('Volkswagen', 'Jetta', 2019),
('Volkswagen', 'Golf', 2021),
('Volkswagen', 'Passat', 2020),
('Mazda', 'CX-5', 2021),
('Mazda', 'Mazda3', 2020),
('Mazda', 'MX-5 Miata', 2020),
('Subaru', 'Outback', 2021),
('Subaru', 'Forester', 2020),
('Subaru', 'Impreza', 2020),
('Lexus', 'RX', 2021),
('Lexus', 'IS', 2020),
('Lexus', 'ES', 2021),
('Jaguar', 'XE', 2020),
('Jaguar', 'F-PACE', 2021),
('Land Rover', 'Discovery', 2020),
('Land Rover', 'Range Rover', 2021),
('Porsche', 'Cayenne', 2020),
('Porsche', 'Macan', 2021),
('Ferrari', '488 GTB', 2020),
('Ferrari', 'Portofino', 2021);

-- Insert data into drivers (same as dgt)
INSERT INTO drivers (name, license_number) VALUES
('John Doe', 'A1234B'),
('Jane Smith', 'B5678C'),
('Michael Johnson', 'X9876Y'),
('Sarah Lee', 'Y1234Z'),
('David Brown', 'Z5678A'),
('Emma White', 'W1234X'),
('Chris Green', 'C9876Y'),
('Linda Blue', 'L5678Z');

-- Insert a secret flag (only in dgt_testing)
INSERT INTO secret (exercise, flag) VALUES
('DGT SQL Injection', 'XXXXXXXXXXXXXXXXXXX');