# 📦 SaaS Vendas - Sistema de Gestão Multi-Tenant

Sistema de gestão de vendas e estoque **SaaS** com múltiplas lojas isoladas. API RESTful + React SPA + PostgreSQL + Redis.

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![React](https://img.shields.io/badge/React-18-61DAFB?style=flat&logo=react)](https://reactjs.org)
[![Docker](https://img.shields.io/badge/Docker-2496ED?style=flat&logo=docker)](https://docker.com)

## 🚀 Pré-requisitos

```bash
# WSL2 / Linux
Docker 20.10+
Docker Compose 2.0+
Git 2.30+

## 🛠️ Instalação Rápida (Docker)

# 1. Clonar repositório
git clone <repo-url> saas-vendas
cd saas-vendas

# 2. Configurar ambiente
cp .env.example .env
docker compose build

# 3. Iniciar stack completa
docker compose up -d

# 4. Instalar dependências
docker compose exec app composer install
docker compose exec app npm ci
docker compose exec app npm run build

# 5. Executar migrações + seeders
docker compose exec app php artisan migrate --seed
docker compose exec app php artisan db:seed --class=TenantSeeder

# 6. Iniciar queue worker
docker compose exec app php artisan queue:work &

