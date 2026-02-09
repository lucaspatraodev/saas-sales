<template>
  <GuestLayout>
    <Head title="Reset Password" />

    <form @submit.prevent="submit">
      <!-- Email -->
      <div>
        <InputLabel for="email" value="Email" />
        <TextInput
          id="email"
          type="email"
          v-model="form.email"
          required
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
          type="password"
          v-model="form.password"
          required
          class="mt-1 block w-full"
          autocomplete="new-password"
          autofocus
        />
        <InputError :message="form.errors.password" class="mt-2" />
      </div>

      <!-- Confirm Password -->
      <div class="mt-4">
        <InputLabel for="password_confirmation" value="Confirm Password" />
        <TextInput
          id="password_confirmation"
          type="password"
          v-model="form.password_confirmation"
          required
          class="mt-1 block w-full"
          autocomplete="new-password"
        />
        <InputError :message="form.errors.password_confirmation" class="mt-2" />
      </div>

      <!-- Submit Button -->
      <div class="mt-4 flex items-center justify-end">
        <PrimaryButton :disabled="form.processing" class="ms-4">
          Reset Password
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
import { Head } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  token: String,
  email: String
})

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: ''
})

const submit = () => {
  form.post(route('password.store'), {
    onFinish: () => {
      form.reset('password', 'password_confirmation')
    }
  })
}
</script>
