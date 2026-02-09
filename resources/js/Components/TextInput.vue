<template>
  <input
    v-bind="$attrs"
    :type="type"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
    :class="$attrs.class"
    ref="input"
  />
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'

const props = defineProps({
  type: {
    type: String,
    default: 'text'
  },
  isFocused: {
    type: Boolean,
    default: false
  },
  modelValue: {
    type: [String, Number],
    default: ''
  }
})

const emit = defineEmits(['update:modelValue']) 

const input = ref(null)

// Auto-focus quando isFocused=true
onMounted(() => {
  if (props.isFocused) {
    input.value?.focus()
  }
})

watch(() => props.isFocused, (focused) => {
  if (focused) {
    input.value?.focus()
  }
})

defineExpose({
  focus: () => input.value?.focus()
})
</script>