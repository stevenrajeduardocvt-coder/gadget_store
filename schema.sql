CREATE DATABASE IF NOT EXISTS gadget_store;
USE gadget_store;

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL,
    category_description TEXT
);
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'customer',
    date_joined TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(150) NOT NULL,
    category_id INT,
    price DECIMAL(10, 2) NOT NULL,
    stock_quantity INT DEFAULT 0,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_price DECIMAL(10, 2) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

INSERT INTO categories (category_name, category_description) VALUES 
('Laptops', 'High performance portable computers'),
('Peripherals', 'Mice, Keyboards, and Audio equipment'),
('Monitors', 'High refresh rate gaming displays');

INSERT INTO users (username, email, password, role) VALUES 
('admin_steven', 'steven.eduardo@example.com', 'admin_pass_123', 'admin'),
('juan_customer', 'juan.dela.cruz@example.com', 'customer_pass_456', 'customer'),
('maria_clara', 'maria.clara@example.com', 'customer_pass_789', 'customer');

INSERT INTO products (product_name, category_id, price, stock_quantity) VALUES 
('ROG Zephyrus G14', 1, 85000.00, 5),
('Logitech G Pro Wireless', 2, 5500.00, 20),
('Samsung Odyssey G7', 3, 32000.00, 8),
('Keychron K2 V2', 2, 4500.00, 15);

INSERT INTO orders (user_id, total_price, status) VALUES 
(2, 90500.00, 'Completed'),
(3, 4500.00, 'Shipped');

INSERT INTO order_items (order_id, product_id, quantity, unit_price) VALUES 
(1, 1, 1, 85000.00), 
(1, 2, 1, 5500.00), 
(2, 4, 1, 4500.00);  