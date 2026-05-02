CREATE DATABASE fashion_hub;

USE fashion_hub;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('user','admin') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  description TEXT,
  price DECIMAL(10,2),
  image VARCHAR(255),
  category VARCHAR(50),
  brand_style VARCHAR(50),
  size VARCHAR(50),
  color VARCHAR(50),
  stock INT DEFAULT 0,
  link VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cart (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  product_id INT,
  quantity INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  total DECIMAL(10,2),
  status VARCHAR(50) DEFAULT 'Pending',
  address TEXT,
  phone VARCHAR(20),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  product_id INT,
  quantity INT,
  price DECIMAL(10,2)
);

CREATE TABLE wishlist (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  product_id INT
);