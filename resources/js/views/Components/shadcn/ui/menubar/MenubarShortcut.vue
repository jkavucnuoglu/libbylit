<script setup>
import { cn } from '@/lib/utils.js';

const props = defineProps();
</script>

<template>
  <span
    :class="
      cn('ml-auto text-xs tracking-widest text-muted-foreground', props.class)
    "
  >
    <slot />
  </span>
</template>
