# SaaS Vendas - Docker Development Setup

## Para rodar em Desenvolvimento

```bash
# Build e inicia os containers em modo dev
docker compose -f docker-compose.dev.yml up -d

# Ver logs
docker compose -f docker-compose.dev.yml logs -f

# Parar containers
docker compose -f docker-compose.dev.yml down
```

## Serviços disponíveis

- **App**: http://localhost:8000
- **Vite Dev Server**: http://localhost:5173 (hot reload de assets)
- **PostgreSQL**: localhost:5432
- **Redis**: localhost:6379

## O que está incluído

- **app**: Laravel + Nginx + PHP-FPM
- **vite**: Servidor de desenvolvimento Vite para hot reload
- **postgres**: Banco de dados
- **redis**: Cache e filas
- **worker**: Queue worker para processos assíncronos

## Primeiro acesso

1. Aguarde a compilação inicial
2. Acesse http://localhost:8000
3. Os assets serão compilados pelo serviço Vite em hot-reload

## Para produção

Use o `Dockerfile` e `docker-compose.yml` padrão.
