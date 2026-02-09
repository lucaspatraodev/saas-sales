<template>
  <div class="min-h-screen bg-gray-100">
    <Head title="SaaS Vendas - Multi-Tenant" />
    
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
          🚀 SaaS Vendas - Teste Técnico
        </h1>
        <p class="mt-1 text-sm text-gray-500">
          Laravel 12 + Vue 3 + Inertia + Docker + Multi-Tenant
        </p>
      </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="px-4 py-12 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg p-12 text-center">
          <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">
              Ambiente 100% Funcional ✅
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
              <div class="bg-green-100 p-3 rounded-lg">
                <div class="font-bold text-green-800">Postgres</div>
                <div class="text-xs">5432 ✓</div>
              </div>
              <div class="bg-green-100 p-3 rounded-lg">
                <div class="font-bold text-green-800">Redis</div>
                <div class="text-xs">6379 ✓</div>
              </div>
              <div class="bg-green-100 p-3 rounded-lg">
                <div class="font-bold text-green-800">Vite HMR</div>
                <div class="text-xs">5173 ✓</div>
              </div>
              <div class="bg-green-100 p-3 rounded-lg">
                <div class="font-bold text-green-800">Queue</div>
                <div class="text-xs">Worker ✓</div>
              </div>
            </div>
          </div>

          <div class="space-x-4">
            <!-- Links SEM route() - URLs diretas -->
            <Link
              v-if="!auth.user"
              href="/register"
              class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition"
            >
              🏪 Registrar Loja
            </Link>
            <Link
              v-else
              href="/dashboard"
              class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition"
            >
              📊 Dashboard Admin
            </Link>
            <Link
              v-if="!auth.user"
              href="/login"
              class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition"
            >
              Entrar
            </Link>
          </div>

          <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-blue-800">
              Próximo: Multi-Tenant + API RESTful + Vendas/Estoque
            </p>
          </div>
        </div>
      </div>
    </main>

    <footer class="bg-white border-t mt-12">
      <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
        Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }}) | Dockerizado 100%
      </div>
    </footer>
  </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js' 

defineProps({
  auth: {
    type: Object,
    default: () => ({})
  },
  laravelVersion: {
    type: String,
    default: '12.x'
  },
  phpVersion: {
    type: String,
    default: '8.3'
  }
})
</script>
