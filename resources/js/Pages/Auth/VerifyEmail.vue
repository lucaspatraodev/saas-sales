<template>
  <GuestLayout>
    <Head title="Email Verification" />

    <!-- Welcome message -->
    <div class="mb-4 text-sm text-gray-600">
      Thanks for signing up! Before getting started, could you verify your email address 
      by clicking on the link we just emailed to you? If you didn't receive the email, 
      we will gladly send you another.
    </div>

    <!-- Success status -->
    <div v-if="status === 'verification-link-sent'" class="mb-4 text-sm font-medium text-green-600">
      A new verification link has been sent to the email address you provided during registration.
    </div>

    <!-- Action buttons -->
    <form @submit.prevent="submit">
      <div class="mt-4 flex items-center justify-between">
        <PrimaryButton :disabled="form.processing">
          Resend Verification Email
        </PrimaryButton>

        <Link
          :href="route('logout')"
          method="post"
          as="button"
          class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Log Out
        </Link>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

defineProps({
  status: String
})

const form = useForm({})

const submit = () => {
  form.post(route('verification.send'))
}
</script>
