<script setup>
import { cn } from '@/lib/utils.js';

const props = defineProps({
  class: { type: null, required: false },
});
</script>

<template>
  <div :class="cn('animate-pulse rounded-md bg-muted', props.class)" />
</template>
