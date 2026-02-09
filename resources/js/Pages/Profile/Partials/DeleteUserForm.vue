<template>
  <section class="space-y-6">
    <!-- Header -->
    <header>
      <h2 class="text-lg font-medium text-gray-900">Delete Account</h2>
      <p class="mt-1 text-sm text-gray-600">
        Once your account is deleted, all of its resources and data will be permanently 
        deleted. Before deleting your account, please download any data or information 
        that you wish to retain.
      </p>
    </header>

    <!-- Delete Button -->
    <DangerButton @click="confirmUserDeletion">
      Delete Account
    </DangerButton>

    <!-- Delete Confirmation Modal -->
    <Modal :show="confirmingUserDeletion" @close="closeModal">
      <form @submit.prevent="deleteUser" class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
          Are you sure you want to delete your account?
        </h2>

        <p class="mt-1 text-sm text-gray-600">
          Once your account is deleted, all of its resources and data will be permanently 
          deleted. Please enter your password to confirm you would like to permanently 
          delete your account.
        </p>

        <!-- Password Input -->
        <div class="mt-6">
          <InputLabel for="password" value="Password" class="sr-only" />
          <TextInput
            id="password"
            ref="passwordInput"
            type="password"
            v-model="form.password"
            required
            class="mt-1 block w-3/4"
            autocomplete="current-password"
            autofocus
            placeholder="Password"
          />
          <InputError :message="form.errors.password" class="mt-2" />
        </div>

        <!-- Modal Actions -->
        <div class="mt-6 flex justify-end">
          <SecondaryButton @click="closeModal" class="ms-3">
            Cancel
          </SecondaryButton>
          <DangerButton :class="form.processing ? 'opacity-25' : ''" :disabled="form.processing">
            Delete Account
          </DangerButton>
        </div>
      </form>
    </Modal>
  </section>
</template>

<script setup>
import DangerButton from '@/Components/DangerButton.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Modal from '@/Components/Modal.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { useForm, router } from '@inertiajs/vue3'
import { ref } from 'vue'

defineProps({
  className: String
})

const confirmingUserDeletion = ref(false)
const passwordInput = ref(null)

const form = useForm({
  password: ''
})

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true
  nextTick(() => passwordInput.value?.focus())
}

const deleteUser = () => {
  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value?.focus(),
    onFinish: () => form.reset()
  })
}

const closeModal = () => {
  confirmingUserDeletion.value = false
  form.clearErrors()
  form.reset()
}
</script>
