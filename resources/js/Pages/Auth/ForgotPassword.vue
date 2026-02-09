<template>
  <GuestLayout>
    <Head title="Forgot Password" />

    <!-- Instructions -->
    <div class="mb-4 text-sm text-gray-600">
      Forgot your password? No problem. Just let us know your email address and 
      we will email you a password reset link that will allow you to choose a new one.
    </div>

    <!-- Success status -->
    <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <!-- Email -->
      <div>
        <TextInput
          id="email"
          type="email"
          v-model="form.email"
          required
          class="mt-1 block w-full"
          autocomplete="username"
          autofocus
        />
        <InputError :message="form.errors.email" class="mt-2" />
      </div>

      <!-- Submit Button -->
      <div class="mt-4 flex items-center justify-end">
        <PrimaryButton :disabled="form.processing" class="ms-4">
          Email Password Reset Link
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/vue3'

defineProps({
  status: String
})

const form = useForm({
  email: ''
})

const submit = () => {
  form.post(route('password.email'))
}
</script>
