-- Create authentication database
CREATE DATABASE IF NOT EXISTS authentication;
USE authentication;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255),
    role VARCHAR(50),
    email VARCHAR(255)
);

-- Create user_spii table
CREATE TABLE IF NOT EXISTS user_spii (
    id INT PRIMARY KEY,
    user_id INT,
    social_security_number VARCHAR(11),
    credit_card_number VARCHAR(19),
    expiration_date DATE,
    billing_address VARCHAR(255),
    date_of_birth DATE
);

-- Insert demo data into users table
INSERT INTO users (id, username, password, role, email) VALUES
(1, 'admin', 'super secure password', 'admin', 'admin@demonstrations.com'),
(2, 'caydn', 'rainy sunday dogs and cats', 'user', 'caydn@gmail.com'),
(3, 'user', 'password', 'user', 'user@gmail.com');

-- Insert demo data into user_spii table
INSERT INTO user_spii (id, user_id, social_security_number, credit_card_number, expiration_date, billing_address, date_of_birth) VALUES
(1, 1, '123-45-6789', '1234-5678-9012-3456', '2024-03-01', '1234 Nunya Business Blvd, Provo, Utah, 84604', '2000-01-01'),
(2, 2, '987-65-4321', '9876-5432-1098-7654', '2024-05-01', '5678 Go Away Blvd, Provo, Utah, 84604', '2000-02-01'),
(3, 3, '091-28-3765', '0918-3746-5091-8273', '2024-07-01', '9012 Your Mom Blvd, Provo, Utah, 84604', '2000-03-01');

-- Create chats database
CREATE DATABASE IF NOT EXISTS chat;
USE chat;

-- Create messages table
CREATE TABLE IF NOT EXISTS chats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    messages TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Verify data was inserted correctly
USE authentication;
SELECT 'Users Table:' as '';
SELECT * FROM users;
SELECT 'User SPII Table:' as '';
SELECT * FROM user_spii;
USE chats;
SELECT 'Messages Table:' as '';
SELECT * FROM messages;