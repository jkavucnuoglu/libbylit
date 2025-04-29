<script setup>
import { cn } from '@/lib/utils.js';

const props = defineProps({
  class: { type: null, required: false },
});
</script>

<template>
  <div :class="cn('text-sm [&_p]:leading-relaxed', props.class)">
    <slot />
  </div>
</template>
