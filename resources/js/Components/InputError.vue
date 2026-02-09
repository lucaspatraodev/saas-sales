<template>
  <p
    v-if="message"
    v-bind="$attrs"
    class="text-sm text-red-600"
    :class="$attrs.class"
  >
    {{ message }}
  </p>
</template>

<script setup>
defineProps({
  message: String
})
</script>
