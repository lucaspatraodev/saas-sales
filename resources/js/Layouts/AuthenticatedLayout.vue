<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="border-b border-gray-100 bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
          <div class="flex">
            <!-- Logo -->
            <div class="flex shrink-0 items-center">
              <Link href="/">
                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
              </Link>
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
              <NavLink href="/dashboard" :active="$page.url === '/dashboard'">
                Dashboard
              </NavLink>
            </div>
          </div>

          <!-- User Dropdown (Desktop) -->
          <div class="hidden sm:ms-6 sm:flex sm:items-center">
            <div class="relative ms-3">
              <Dropdown>
                <template #trigger>
                  <span class="inline-flex rounded-md">
                    <button
                      type="button"
                      class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                    >
                      {{ auth.user.name }}
                      <svg
                        class="-me-0.5 ms-2 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </button>
                  </span>
                </template>

                <Dropdown.Content>
                  <Dropdown.Link href="/profile">Profile</Dropdown.Link>
                  <Dropdown.Link 
                    :href="`/logout`"
                    method="post"
                    as="button"
                  >
                    Log Out
                  </Dropdown.Link>
                </Dropdown.Content>
              </Dropdown>
            </div>
          </div>

          <!-- Mobile menu button -->
          <div class="flex flex-col md:hidden">
            <button
              @click="showingNavigationDropdown = !showingNavigationDropdown"
              class="text-gray-500 hover:text-gray-700"
            >
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path v-if="!showingNavigationDropdown" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Mobile Navigation -->
      <div v-if="showingNavigationDropdown" class="sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
          <ResponsiveNavLink href="/dashboard" :active="$page.url === '/dashboard'">
            Dashboard
          </ResponsiveNavLink>
        </div>

        <div class="border-t border-gray-200 pb-1 pt-4">
          <div class="px-4">
            <div class="text-base font-medium text-gray-800">
              {{ auth.user.name }}
            </div>
            <div class="text-sm font-medium text-gray-500">
              {{ auth.user.email }}
            </div>
          </div>

          <div class="mt-3 space-y-1">
            <ResponsiveNavLink href="/profile">Profile</ResponsiveNavLink>
            <ResponsiveNavLink 
              :href="`/logout`" 
              method="post" 
              as="button"
            >
              Log Out
            </ResponsiveNavLink>
          </div>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header v-if="$slots.header" class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <slot name="header" />
      </div>
    </header>

    <!-- Page Content -->
    <main>
      <slot />
    </main>
  </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import Dropdown from '@/Components/Dropdown.vue'
import NavLink from '@/Components/NavLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'

defineProps({
  header: {
    type: String,
    default: null,
  },
})

const page = usePage()
const auth = page.props.auth
const showingNavigationDropdown = ref(false)
</script>
