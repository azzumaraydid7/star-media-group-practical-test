# Star Media Group Project

A modern Laravel 12 web application built with Tailwind CSS and Alpine.js, featuring a responsive design and admin functionality.

## Features

- **Laravel 12** - Latest Laravel framework
- **Tailwind CSS** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **SQLite Database** - Default database (easily configurable)
- **Responsive Design** - Mobile-first approach
- **Admin Panel** - Built-in admin functionality
- **Authentication** - User registration and login
- **Log Viewer** - Built-in log management

## Requirements

Before you begin, ensure you have the following installed on your system:

- **PHP 8.2 or higher**
- **Composer** (PHP dependency manager)
- **Node.js 18+ and npm** (for frontend assets)
- **Git** (for version control)

## Quick Setup

The fastest way to get started is using the automated setup script:

```bash
# Clone the repository
git clone <repository-url>
cd star-media-group-sdn-bhd

# Run the automated setup
composer run setup
```

This will automatically:
- Install PHP dependencies
- Copy environment configuration
- Generate application key
- Run database migrations
- Install frontend dependencies
- Build frontend assets

## Manual Setup

If you prefer to set up the project manually:

### 1. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 2. Environment Configuration

```bash
# Copy the environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Database Setup

The project uses SQLite by default. The database file will be created automatically when you run migrations.

```bash
# Run database migrations
php artisan migrate

# (Optional) Seed the database with sample data
php artisan db:seed
```

### 4. Build Frontend Assets

```bash
# Build assets for production
npm run build

# Or run in development mode with hot reloading
npm run dev
```

## Running the Application

### Development Server

```bash
# Start the Laravel development server
php artisan serve
```

The application will be available at `http://localhost:8000`

### Frontend Development

For frontend development with hot reloading:

```bash
# In a separate terminal, run the Vite dev server
npm run dev
```

## Configuration

### Database Configuration

The project uses SQLite by default. To use a different database:

1. Update your `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

2. Run migrations:
```bash
php artisan migrate
```

### Admin User

To create an admin user, run the seeder:

```bash
php artisan db:seed --class=AdminUserSeeder
```

Default admin credentials:
- **Email:** admin@example.com
- **Password:** password123

## Available Scripts

- `composer run setup` - Complete project setup
- `composer run dev` - Start development servers
- `npm run dev` - Start Vite development server
- `npm run build` - Build production assets
- `php artisan serve` - Start Laravel development server
- `php artisan migrate` - Run database migrations
- `php artisan db:seed` - Seed the database

## Project Structure

```
├── app/                    # Application logic
├── config/                 # Configuration files
├── database/              # Migrations, seeders, factories
├── public/                # Public assets
├── resources/             # Views, CSS, JS
│   ├── views/            # Blade templates
│   └── css/              # Stylesheets
├── routes/                # Route definitions
├── storage/               # File storage
└── tests/                 # Test files
```

## Testing

Run the test suite:

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit
```

## Deployment

### Production Setup

1. Set environment to production in `.env`:
```env
APP_ENV=production
APP_DEBUG=false
```

2. Optimize the application:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

3. Build production assets:
```bash
npm run build
```

## Troubleshooting

### Common Issues

**Permission Issues:**
```bash
chmod -R 775 storage bootstrap/cache
```

**Clear Cache:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

**Regenerate Autoloader:**
```bash
composer dump-autoload
```

## Support

For support and questions:
- Check the [Laravel Documentation](https://laravel.com/docs)
- Review the application logs in `storage/logs/`
- Use the built-in log viewer at `/log-viewer` (admin access required)

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
