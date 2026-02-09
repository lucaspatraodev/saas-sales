<template>
    <label
        v-bind="$attrs"
        class="block text-sm font-medium text-gray-700"
    :class="$attrs.class"
  >
    {{ value || $slots.default?.()}}
</label>
</template >

    <script setup>
        defineProps({
            value: String
})
    </script>
