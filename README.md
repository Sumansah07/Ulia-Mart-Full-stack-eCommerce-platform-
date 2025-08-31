# Ulia Mart Laravel E-Commerce Platform

A robust, modular, and feature-rich e-commerce solution built with Laravel 10.

## Features

- Multi-vendor support
- Modular payment gateways (Stripe, PayPal, Paystack, Razorpay, Mollie, Duitku, Iyzico, Midtrans, MercadoPago, etc.)
- Social login (Facebook, Google, etc.)
- PWA (Progressive Web App) support
- Coupon and discount management
- Product import/export (Excel)
- Role-based permissions (Spatie)
- Responsive frontend (Blade templates)
- Admin panel for site management
- Email marketing and newsletter
- Multi-language support
- Order tracking and delivery management

## Requirements

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL or compatible database

## Installation

1. **Clone the repository**
   ```powershell
   git clone <your-repo-url>
   cd uliaa.infiniteitsolutionsnepal.com
   ```

2. **Install PHP dependencies**
   ```powershell
   composer install
   ```

3. **Install Node dependencies**
   ```powershell
   npm install
   ```

4. **Copy and configure `.env`**
   ```powershell
   cp .env.example .env
   # Edit .env with your database and mail settings
   ```

5. **Generate application key**
   ```powershell
   php artisan key:generate
   ```

6. **Run migrations and seeders**
   ```powershell
   php artisan migrate --seed
   ```

7. **Build frontend assets**
   ```powershell
   npm run prod
   ```

8. **Start the development server**
   ```powershell
   php artisan serve
   ```

## Usage

- Access the frontend at `http://localhost:8000`
- Admin panel: `/admin` (default credentials set during installation)
- API endpoints: `/api/*`

## Testing

Run unit and feature tests:
```powershell
php artisan test
```

## Folder Structure

- `app/` - Application logic (Controllers, Models, Services)
- `resources/views/` - Blade templates for frontend and backend
- `Modules/` - Modular features (e.g., PaymentGateway)
- `public/` - Public assets
- `routes/` - Route definitions
- `database/` - Migrations, seeders, factories
- `config/` - Configuration files

## Contribution

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/YourFeature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/YourFeature`)
5. Create a new Pull Request

## License

This project is licensed under the MIT License.