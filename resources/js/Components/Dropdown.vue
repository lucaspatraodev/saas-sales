<template>
  <div class="relative">
    <slot />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import { TransitionRoot, TransitionChild } from '@headlessui/vue'

const props = defineProps({
  align: {
    type: String,
    default: 'right'
  },
  width: {
    type: String,
    default: '48'
  },
  contentClasses: {
    type: String,
    default: 'py-1 bg-white'
  }
})

const open = ref(false)
const toggleOpen = () => {
  open.value = !open.value
}

const close = () => {
  open.value = false
}

// Alignment classes
const alignmentClasses = computed(() => {
  if (props.align === 'left') {
    return 'ltr:origin-top-left rtl:origin-top-right start-0'
  } else if (props.align === 'right') {
    return 'ltr:origin-top-right rtl:origin-top-left end-0'
  }
  return 'origin-top'
})

// Width classes
const widthClasses = computed(() => {
  if (props.width === '48') {
    return 'w-48'
  }
  return ''
})

// Provide context para subcomponentes
provide('dropdown', {
  open: readonly(open),
  toggleOpen,
  close
})
</script>
