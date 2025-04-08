
-- User Profile Table
CREATE TABLE IF NOT EXISTS user_profiles (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    phone VARCHAR(15),
    address TEXT,
    role ENUM('Admin', 'Customer') DEFAULT 'Customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products Table
CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock_quantity INT NOT NULL,
    category VARCHAR(50),
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    quantity INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_profiles(user_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);



Classic White Tee
A clean-cut, timeless white t-shirt made from 100% cotton.
images/classic_white_tee.jpg
Black Hoodie
Cozy unisex black hoodie with fleece lining.
images/black_hoodie.jpg

Denim Jacket
Classic blue denim jacket with a vintage vibe.
images/denim_jacket.jpg

Graphic Tee - Mountain Scene
Soft cotton tee featuring a bold mountain graphic.
images/mountain_graphic_tee.jpg

Oversized Sweatshirt
Warm oversized sweatshirt in earthy tones.
images/oversized_sweatshirt.jpg

Plaid Flannel Shirt
Red and black plaid shirt, great for layering.
images/plaid_flannel.jpg

Puffer Vest
Lightweight puffer vest perfect for chilly days.
images/puffer_vest.jpg

V-Neck Sweater
Soft knit v-neck sweater available in multiple colors.
images/vneck_sweater.jpg

Long Sleeve Henley
Stretchy and stylish long sleeve henley shirt.
images/henley_shirt.jpg

Linen Button-Up
Breathable linen button-up shirt, ideal for summer.
images/linen_buttonup.jpg

Windbreaker Jacket
Water-resistant windbreaker with hood.
images/windbreaker.jpg

Crewneck Tee - Abstract Print
Modern abstract print on high-quality cotton tee.
images/abstract_tee.jpg

Tie-Dye Hoodie
Trendy tie-dye hoodie with front pouch pocket.
images/tiedye_hoodie.jpg