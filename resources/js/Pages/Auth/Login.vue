<template>
  <GuestLayout>
    <Head title="Log in" />

    <!-- Status message -->
    <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <!-- Email -->
      <div>
        <InputLabel for="email" value="Email" />
        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          autocomplete="username"
          autofocus
        />
        <InputError :message="form.errors.email" class="mt-2" />
      </div>

      <!-- Password -->
      <div class="mt-4">
        <InputLabel for="password" value="Password" />
        <TextInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          autocomplete="current-password"
        />
        <InputError :message="form.errors.password" class="mt-2" />
      </div>

      <!-- Remember Me -->
      <div class="mt-4 block">
        <label class="flex items-center">
          <Checkbox v-model="form.remember" name="remember" />
          <span class="ms-2 text-sm text-gray-600">Remember me</span>
        </label>
      </div>

      <!-- Submit Buttons -->
      <div class="mt-4 flex items-center justify-end">
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Forgot your password?
        </Link>

        <PrimaryButton :class="form.processing ? 'opacity-25' : ''" :disabled="form.processing" class="ms-4">
          Log in
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import Checkbox from '@/Components/Checkbox.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

defineProps({
  canResetPassword: {
    type: Boolean,
    default: true
  },
  status: String
})

const form = useForm({
  email: '',
  password: '',
  remember: false
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => {
      form.reset('password')
    }
  })
}
</script>