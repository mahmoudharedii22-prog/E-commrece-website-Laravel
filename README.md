# E-Commerce Backend System

A modular e-commerce backend built with **Laravel** — handling product catalogue management, shopping cart operations, and order processing, structured for scalability and clean separation of concerns.

> **Status: In Progress** — Core modules are functional; additional features are actively being developed.

---

## Features

- **Product Management** — Full CRUD for products with category organisation and inventory tracking
- **Shopping Cart** — Session and user-scoped cart operations (add, update quantity, remove items)
- **Order Processing** — Order creation from cart, order status management, and order history per user
- **Authentication** — User registration and login with protected routes
- **RESTful API** — Clean API endpoints designed for frontend or mobile client integration
- **Blade Frontend** — Server-rendered views for browsing and cart interaction

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Framework | Laravel |
| Database | MySQL |
| Frontend | Blade Templates |
| Architecture | MVC + Service Layer |

---

## Architecture

```
app/
├── Http/
│   ├── Controllers/    # Route handlers — delegating to services
│   └── Middleware/     # Auth and role guards
├── Models/
│   ├── Product.php
│   ├── Cart.php
│   ├── Order.php
│   └── OrderItem.php
├── Services/           # Business logic (cart calculation, order creation)
└── ...
resources/
└── views/              # Blade templates for frontend
routes/
├── web.php             # Web routes (Blade views)
└── api.php             # API routes
```

---

## Getting Started

```bash
# 1. Clone the repository
git clone https://github.com/mahmoudharedii22-prog/E-commrece-website-Laravel.git
cd E-commrece-website-Laravel

# 2. Install dependencies
composer install
npm install && npm run build

# 3. Set up environment
cp .env.example .env
php artisan key:generate

# 4. Configure your database in .env
# DB_DATABASE=ecommerce
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Run migrations and seed
php artisan migrate
php artisan db:seed

# 6. Start the server
php artisan serve
```

---

## Planned Features

- [ ] Payment gateway integration
- [ ] Product search and filtering
- [ ] Admin dashboard for order and inventory management
- [ ] API resource transformers for clean JSON output
- [ ] Feature tests for core workflows

---

## Author

**Mahmoud Sayed Ali Harredy**
[LinkedIn](https://www.linkedin.com/in/mahmoud-haredi) · [GitHub](https://github.com/mahmoudharedii22-prog)
