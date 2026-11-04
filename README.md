# Laravel eCommerce – Figurines Store

A web-based e-commerce application built with **Laravel** for browsing and buying collectible figurines. Developed as a school project (*TP0 – Synthèse*) to practice full-stack web development with PHP and the Laravel framework.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

**Live site:** [http://tp4.4d6.2262843.techinfo-cstj.ca/](http://tp4.4d6.2262843.techinfo-cstj.ca/)

---

## About

This project is an online store where users can browse a catalog of figurines, view product details, and manage a shopping cart. It follows the MVC architecture provided by Laravel and uses a relational database to store products, users, and orders.

## Features

- Product catalog with images, descriptions, and prices
- Product detail pages
- Shopping cart (add, update, remove items)
- User registration and login
- Stripe payment integration
- Admin management of products *(if applicable)*

## Tech Stack

| Layer    | Technology                             |
|----------|----------------------------------------|
| Backend  | PHP, Laravel                           |
| Frontend | Blade templates, HTML, CSS, JavaScript |
| Database | MySQL *(or SQLite, adjust as needed)*  |
| Payments | Stripe                                 |
| Tooling  | Composer, npm, Artisan                 |

## Requirements

Make sure you have these installed:

- [PHP](https://www.php.net/downloads) 8.1 or higher
- [Composer](https://getcomposer.org/)
- [Node.js and npm](https://nodejs.org/)
- A database server such as MySQL (XAMPP, WAMP, or Laragon all work)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Fernan-Garcia/laravel_eCommerce.git
   cd laravel_eCommerce/TP0Synthese_eCommerceFigurines
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install frontend dependencies**
   ```bash
   npm install
   ```

4. **Set up the environment file**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your database** in the `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run the migrations** (add `--seed` if your project has seeders)
   ```bash
   php artisan migrate --seed
   ```

7. **Build the assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```
   Then open **http://localhost:8000** in your browser.

## Project Structure

```
laravel_eCommerce/
└── TP0Synthese_eCommerceFigurines/
    ├── app/          # Models, controllers, and application logic
    ├── database/     # Migrations, seeders, and factories
    ├── resources/    # Blade views, CSS, and JavaScript
    ├── routes/       # Web routes
    └── public/       # Public assets and entry point
```

<!--
## Screenshots

Add screenshots of the app in a `screenshots/` folder and link them here:

![Home page](screenshots/home.png)
![Product page](screenshots/product.png)
![Cart](screenshots/cart.png)
-->

## What I Learned

- Building an application with the MVC pattern in Laravel
- Designing database tables with migrations and Eloquent relationships
- Creating dynamic pages with Blade templates
- Handling authentication, forms, and validation
- Integrating Stripe for payments
- Managing a project with Git and GitHub

## Author

**Fernando Garcia**
GitHub: [@Fernan-Garcia](https://github.com/Fernan-Garcia)

---

*This project was created for educational purposes.*
