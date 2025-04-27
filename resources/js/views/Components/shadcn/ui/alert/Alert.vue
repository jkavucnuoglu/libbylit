<script setup>
import { cn } from '@/lib/utils.js';
import { alertVariants } from './index.js';

const props = defineProps({
  class: { type: null, required: false },
  variant: { type: null, required: false },
});
</script>

<template>
  <div :class="cn(alertVariants({ variant }), props.class)" role="alert">
    <slot />
  </div>
</template>
