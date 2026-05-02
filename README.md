# Fashion Hub - Premium E-commerce Website

Fashion Hub is a college project e-commerce website for browsing premium fashion products, adding items to cart, and placing a simple order. It is built with PHP, SQLite, HTML, CSS, and JavaScript.

The project is designed to be easy to run for demonstration and viva. It uses SQLite, so no MySQL server is required.

## Project Overview

Fashion Hub provides a clean online shopping experience with:

- Home page with hero section, categories, featured products, and new arrivals
- Product listing page with category filter, search, and sorting
- Product detail page with image, description, size, color, quantity, and stock status
- 60 product records imported from the provided JSON product files
- User registration and login
- Session-based cart system
- Checkout page and order success page
- Responsive layout for desktop and mobile screens

## Tech Stack

- Backend: PHP
- Database: SQLite
- Frontend: HTML, CSS, JavaScript
- Styling: Custom CSS with glassmorphism design
- Data: SQL seed files generated from the JSON product data

## How to Run

1. Clone or download the project.

2. Open the project folder:

   ```bash
   cd clg-project-for-friends
   ```

3. Start the PHP development server:

   ```bash
   php -S localhost:8080
   ```

4. Open this URL in your browser:

   ```text
   http://localhost:8080
   ```

The SQLite database is created automatically in the system temp folder when the project runs.

## Demo Login

Sample users are included in the SQLite seed data.

```text
Email: john@example.com
Password: password
```

```text
Email: admin@fashionhub.com
Password: password
```

## Main Files

```text
index.php                  Home page
shop.php                   Product listing, search, filter, sort
product.php                Product detail page
category.php               Category-wise product page
cart.php                   Shopping cart page
checkout.php               Checkout page
login.php                  User login
register.php               User registration
logout.php                 User logout
order-success.php          Order success page

config/db.php              SQLite database connection and bootstrap
includes/auth.php          Session and authentication functions
includes/functions.php     Product, cart, and order helper functions
includes/header.php        Common page header
includes/navbar.php        Navigation bar
includes/footer.php        Common footer

assets/css/style.css       Main website styling
assets/css/glass.css       Glass effect styling
assets/css/responsive.css  Mobile responsive styling
assets/js/cart.js          Cart AJAX actions
assets/js/main.js          Navigation and UI behavior
assets/js/ui.js            Scroll animations

database/fashion_hub_sqlite.sql  SQLite table structure
database/sample_data_sqlite.sql  Sample users and products
uploads/                         Product images
```

## Database Tables

- users: stores user accounts
- products: stores product catalog details
- cart: stores cart items for logged-in users
- orders: stores order summary
- order_items: stores products inside each order
- wishlist: extra table for possible future improvement

## Features for Presentation

- Dynamic product data from SQLite database
- Product search and category filtering
- Price sorting
- User login and registration
- Password hashing using PHP
- AJAX add-to-cart, update quantity, and remove item
- Checkout flow with order creation
- Mobile responsive design
- Product images and brand-style product details

## Viva Explanation

Fashion Hub is a dynamic e-commerce website created as a college project. It allows users to browse fashion products, view product details, register or login, add products to cart, update cart quantity, and place an order. The backend is built using PHP, and SQLite is used as the database so the project can run easily without external server setup.

## Simple Flow

1. User opens the home page.
2. Products are loaded from the SQLite database.
3. User can search, filter, or open a product.
4. User logs in or registers.
5. User adds products to cart.
6. Cart data is saved using the logged-in user session.
7. User checks out and an order is created.
8. Cart is cleared after successful order.

## Future Scope

- Admin panel for managing products
- Online payment integration
- Wishlist page
- Order history page
- Better product image upload system

## Presentation Line

"Fashion Hub is a dynamic PHP and SQLite based e-commerce website for fashion products, featuring product browsing, filtering, login, cart management, and checkout in a responsive user interface."

## Note

This project is created for educational purposes and college presentation. It focuses on demonstrating full-stack web development basics using PHP, SQLite, HTML, CSS, and JavaScript.
