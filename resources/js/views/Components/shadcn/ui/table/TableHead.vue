<script setup>
import { cn } from '@/lib/utils.js';

const props = defineProps({
  class: { type: null, required: false },
});
</script>

<template>
  <th
    :class="
      cn(
        'h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0',
        props.class,
      )
    "
  >
    <slot />
  </th>
</template>
