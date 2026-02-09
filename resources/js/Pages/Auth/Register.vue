<template>
  <GuestLayout>
    <Head title="Register" />

    <form @submit.prevent="submit">
      <!-- Name -->
      <div>
        <InputLabel for="name" value="Name" />
        <TextInput
          id="name"
          v-model="form.name"
          type="text"
          name="name"  
          class="mt-1 block w-full"
          autocomplete="name"
          autofocus
        />
        <InputError :message="form.errors.name" class="mt-2" />
      </div>

      <!-- Email -->
      <div class="mt-4">
        <InputLabel for="email" value="Email" />
        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          name="email"  
          class="mt-1 block w-full"
          autocomplete="username"
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
          name="password"  
          class="mt-1 block w-full"
          autocomplete="new-password"
        />
        <InputError :message="form.errors.password" class="mt-2" />
      </div>

      <!-- Confirm Password -->
      <div class="mt-4">
        <InputLabel for="password_confirmation" value="Confirm Password" />
        <TextInput
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          name="password_confirmation"  
          class="mt-1 block w-full"
          autocomplete="new-password"
        />
        <InputError :message="form.errors.password_confirmation" class="mt-2" />
      </div>

      <!-- Submit Buttons -->
      <div class="mt-4 flex items-center justify-end">
        <Link
          href="/login"
          class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Already registered?
        </Link>

        <PrimaryButton :disabled="form.processing" class="ms-4">
          Register
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  console.log('Submitting form data:', form.data()) // Debug log
  
  form.post('/register', {
    onFinish: () => {
      form.reset('password', 'password_confirmation')
    },
    onError: (errors) => {
      console.log('Form errors:', errors) // Debug log
    }
  })
}
</script>