#!/bin/sh
set -e

echo "🚀 Iniciando SaaS Vendas - DEV MODE..."

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

# 3. Instalar Composer (com dev)
if [ ! -d vendor ]; then
  echo "📦 Instalando Composer..."
  composer install --no-interaction
else
  echo "✅ Composer dependencies OK"
fi

# 4. Instalar npm se necessário
if [ ! -d node_modules ]; then
  echo "📦 Instalando NPM..."
  npm install
else
  echo "✅ NPM dependencies OK"
fi

# 5. Permissions
echo "🔐 Configurando permissões..."
chown -R www-data:www-data storage bootstrap/cache public 2>/dev/null || true
chmod -R 775 storage bootstrap/cache public 2>/dev/null || true

# 6. Laravel setup (sem cache em dev)
echo "⚙️ Configurando Laravel..."
php artisan key:generate --no-interaction --force 2>/dev/null || true

echo "✅ SaaS Vendas rodando em DEV MODE"
echo "🌐 App: http://localhost:8000"
echo "📦 Para compilar assets: npm run dev"

# 7. Start supervisor (runs nginx and php-fpm)
exec supervisord -c /etc/supervisord.conf
