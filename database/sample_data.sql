-- Sample data for Fashion Hub
-- Run this after creating the database tables

-- Insert sample users
INSERT INTO users (name, email, password, role) VALUES
('Admin User', 'admin@fashionhub.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('John Doe', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Jane Smith', 'jane@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

-- Insert sample products
INSERT INTO products (name, description, price, image, category, brand_style, size, color, stock, link) VALUES
('Premium Cotton T-Shirt', 'Luxurious cotton t-shirt with premium fit and comfort. Perfect for everyday wear.', 49.99, 'sample1.jpg', 'men', 'Casual Luxury', 'S, M, L, XL', 'White, Black, Navy', 50, NULL),
('Designer Denim Jacket', 'High-quality denim jacket with modern cut and premium stitching.', 129.99, 'sample2.jpg', 'men', 'Street Style', 'M, L, XL', 'Blue, Black', 30, NULL),
('Elegant Evening Dress', 'Stunning evening dress made from premium silk fabric with intricate detailing.', 299.99, 'sample3.jpg', 'women', 'Evening Wear', 'XS, S, M, L', 'Red, Black, Navy', 20, NULL),
('Luxury Cashmere Sweater', 'Ultra-soft cashmere sweater providing warmth and elegance.', 199.99, 'sample4.jpg', 'women', 'Winter Luxury', 'S, M, L', 'Cream, Gray, Black', 25, NULL),
('Classic Leather Boots', 'Handcrafted leather boots with premium materials and expert craftsmanship.', 249.99, 'sample5.jpg', 'men', 'Classic Style', '8, 9, 10, 11, 12', 'Brown, Black', 15, NULL),
('Designer Handbag', 'Premium leather handbag with gold hardware and spacious interior.', 399.99, 'sample6.jpg', 'women', 'Accessories', 'One Size', 'Black, Brown, Red', 10, NULL),
('Silk Scarf Collection', 'Beautiful silk scarf with artistic patterns and premium quality.', 89.99, 'sample7.jpg', 'women', 'Accessories', 'One Size', 'Multi-color', 40, NULL),
('Premium Watch', 'Elegant timepiece with stainless steel case and premium leather strap.', 499.99, 'sample8.jpg', 'men', 'Luxury Accessories', 'One Size', 'Silver, Gold', 8, NULL);