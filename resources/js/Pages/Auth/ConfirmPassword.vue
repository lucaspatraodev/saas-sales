<template>
  <GuestLayout>
    <Head title="Confirm Password" />

    <!-- Instructions -->
    <div class="mb-4 text-sm text-gray-600">
      This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <form @submit.prevent="submit">
      <!-- Password -->
      <div class="mt-4">
        <InputLabel for="password" value="Password" />
        <TextInput
          id="password"
          type="password"
          v-model="form.password"
          required
          class="mt-1 block w-full"
          autocomplete="current-password"
          autofocus
        />
        <InputError :message="form.errors.password" class="mt-2" />
      </div>

      <!-- Submit Button -->
      <div class="mt-4 flex items-center justify-end">
        <PrimaryButton :disabled="form.processing" class="ms-4">
          Confirm
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
  password: ''
})

const submit = () => {
  form.post(route('password.confirm'), {
    onFinish: () => {
      form.reset('password')
    }
  })
}
</script>
