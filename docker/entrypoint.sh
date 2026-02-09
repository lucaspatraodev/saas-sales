#!/bin/sh
set -e

echo "🚀 Iniciando SaaS Vendas..."

# 1. Aguardar MySQL (até 30s)
echo "⏳ Aguardando MySQL..."
for i in {1..30}; do
  if nc -z mysql 3306; then
    echo "✅ MySQL OK!"
    break
  fi
  sleep 1
done

# 2. Copiar .env se não existir
if [ ! -f .env ]; then
  cp .env.example .env
  echo "📋 .env criado"
fi

cd /var/www/html

# 3. Instalar Composer (com dev para desenvolvimento)
echo "📦 Instalando Composer..."
composer install --no-interaction

# 4. Compilar assets Vite
echo "📦 Compilando assets Vite..."
npm install
npm run build

# 5. Permissions
echo "🔐 Configurando permissões..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# 6. Laravel setup (sem cache em dev)
echo "⚙️ Configurando Laravel..."
php artisan key:generate --no-interaction --force

echo "✅ SaaS Vendas rodando."
echo "🌐 App: http://localhost:8000"

# 6. Start supervisor (runs nginx and php-fpm)
exec supervisord -c /etc/supervisord.conf
