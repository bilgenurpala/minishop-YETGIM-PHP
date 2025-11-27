CREATE DATABASE IF NOT EXISTS urun_katalogu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE urun_katalogu;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_is_admin (is_admin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    image VARCHAR(255) DEFAULT 'no-image.png',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_product (user_id, product_id),
    INDEX idx_user_id (user_id),
    INDEX idx_product_id (product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (name, email, password, is_admin) VALUES
('Admin', 'admin@minishop.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Ahmet Yılmaz', 'ahmet@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0);

INSERT INTO products (name, description, price, stock, image, status) VALUES
('Kablosuz Kulaklık', 'Yüksek ses kalitesi ve uzun pil ömrü ile kablosuz kulaklık', 299.99, 50, 'no-image.png', 'active'),
('Akıllı Saat', 'Spor ve sağlık takibi yapabilen akıllı saat', 899.00, 30, 'no-image.png', 'active'),
('Laptop Çantası', 'Su geçirmez, 15.6 inç uyumlu laptop çantası', 149.90, 100, 'no-image.png', 'active'),
('Wireless Mouse', 'Ergonomik tasarım, sessiz tıklama özellikli kablosuz mouse', 89.99, 75, 'no-image.png', 'active'),
('USB-C Hub', '7 in 1 USB-C dönüştürücü hub, HDMI, USB 3.0, SD kart okuyucu', 199.00, 40, 'no-image.png', 'active'),
('Mekanik Klavye', 'RGB aydınlatmalı mekanik oyuncu klavyesi', 549.00, 25, 'no-image.png', 'active');
