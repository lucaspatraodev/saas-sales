<template>
  <Transition
    :show="show"
    leave="duration-200"
  >
    <Dialog
      as="div"
      id="modal"
      class="fixed inset-0 z-50 flex transform items-center overflow-y-auto px-4 py-6 transition-all sm:px-0"
      @close="handleClose"
    >
      <TransitionChild
        enter="ease-out duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in duration-200"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="absolute inset-0 bg-gray-500/75" />
      </TransitionChild>

      <TransitionChild
        enter="ease-out duration-300"
        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        enter-to="opacity-100 translate-y-0 sm:scale-100"
        leave="ease-in duration-200"
        leave-from="opacity-100 translate-y-0 sm:scale-100"
        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      >
        <DialogPanel
          :class="[
            'mb-6 transform overflow-hidden rounded-lg bg-white shadow-xl transition-all sm:mx-auto sm:w-full',
            maxWidthClass
          ]"
        >
          <slot />
        </DialogPanel>
      </TransitionChild>
    </Dialog>
  </Transition>
</template>

<script setup>
import {
  Dialog,
  DialogPanel,
  TransitionRoot,
  TransitionChild,
} from '@headlessui/vue'

defineProps({
  show: {
    type: Boolean,
    default: false
  },
  maxWidth: {
    type: String,
    default: '2xl'
  },
  closeable: {
    type: Boolean,
    default: true
  }
})

defineEmits(['close'])

const emit = defineEmits()
const props = defineProps()

const handleClose = () => {
  if (props.closeable) {
    emit('close')
  }
}

const maxWidthClass = computed(() => {
  const maxWidthClasses = {
    sm: 'sm:max-w-sm',
    md: 'sm:max-w-md',
    lg: 'sm:max-w-lg',
    xl: 'sm:max-w-xl',
    '2xl': 'sm:max-w-2xl',
  }
  return maxWidthClasses[props.maxWidth] || 'sm:max-w-2xl'
})
</script>
