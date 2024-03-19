<script setup>
import { computed } from 'vue';

const props = defineProps({
    disabled: Boolean,
    className: String,
});

const buttonClass = computed(() =>
    `bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 disabled:opacity-50 ${props.className}`
);
</script>

<template>
    <button
        :class="buttonClass"
        :disabled="disabled"
        @click.stop="$emit('click')"
    >
        <slot></slot>
    </button>
</template>
