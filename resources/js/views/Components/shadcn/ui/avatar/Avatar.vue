<script setup>
import { cn } from '@/lib/utils.js';
import { AvatarRoot } from 'radix-vue';
import { avatarVariant } from './index.js';

const props = defineProps({
  class: { type: null, required: false },
  size: { type: null, required: false, default: 'sm' },
  shape: { type: null, required: false, default: 'circle' },
});
</script>

<template>
  <AvatarRoot :class="cn(avatarVariant({ size, shape }), props.class)">
    <slot />
  </AvatarRoot>
</template>
