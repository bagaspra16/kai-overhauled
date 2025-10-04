#!/bin/bash

echo "🚀 Setting up KAI Admin Panel..."
echo "=================================="

# Check if we're in a Laravel project
if [ ! -f "artisan" ]; then
    echo "❌ Error: This doesn't appear to be a Laravel project (artisan file not found)"
    exit 1
fi

echo "📦 Installing dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

echo "🔧 Setting up environment..."
if [ ! -f ".env" ]; then
    cp .env.example .env
    echo "✅ Created .env file from .env.example"
fi

echo "🔑 Generating application key..."
php artisan key:generate

echo "🗄️  Running migrations..."
php artisan migrate --force

echo "🌱 Running seeders..."
php artisan db:seed --force

echo "🔗 Creating storage link..."
php artisan storage:link

echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo ""
echo "✅ Setup completed successfully!"
echo ""
echo "🎉 KAI Admin Panel is ready!"
echo "=================================="
echo "Admin Login Credentials:"
echo "Username: miklat"
echo "Password: miklat023116"
echo ""
echo "Admin Panel URL: http://your-domain/admin/login"
echo ""
echo "📝 Next steps:"
echo "1. Start your development server: php artisan serve"
echo "2. Visit http://localhost:8000/admin/login"
echo "3. Login with the credentials above"
echo ""
echo "🔒 Security Features Included:"
echo "- Rate limiting on login attempts"
echo "- Secure password hashing"
echo "- Role-based access control"
echo "- CSRF protection"
echo "- Session security"
echo ""
