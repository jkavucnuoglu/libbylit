<script setup>
import { buttonVariants } from '@/views/Components/shadcn/ui/button/index.js';
import { cn } from '@/lib/utils.js';
import { AlertDialogCancel } from 'radix-vue';
import { computed } from 'vue';

const props = defineProps({
  asChild: { type: Boolean, required: false },
  as: { type: null, required: false },
  class: { type: null, required: false },
});

const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props;

  return delegated;
});
</script>

<template>
  <AlertDialogCancel
    v-bind="delegatedProps"
    :class="
      cn(buttonVariants({ variant: 'outline' }), 'mt-2 sm:mt-0', props.class)
    "
  >
    <slot />
  </AlertDialogCancel>
</template>
