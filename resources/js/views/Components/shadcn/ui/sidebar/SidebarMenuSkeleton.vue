<script setup>
import { Skeleton } from '@/views/Components/shadcn/ui/skeleton/index.js'
import { cn } from '@/lib/utils.js'
import { computed } from 'vue'

const props = defineProps({
  showIcon: { type: Boolean, default: false },
  class: { type: null, required: false }
})

const width = computed(() => {
  return `${Math.floor(Math.random() * 40) + 50}%`
})
</script>

<template>
  <div
    data-sidebar="menu-skeleton"
    :class="cn('rounded-md h-8 flex gap-2 px-2 items-center', props.class)"
  >
    <Skeleton
      v-if="showIcon"
      class="size-4 rounded-md"
      data-sidebar="menu-skeleton-icon"
    />

    <Skeleton
      class="h-4 flex-1 max-w-(--skeleton-width)"
      data-sidebar="menu-skeleton-text"
      :style="{ '--skeleton-width': width }"
    />
  </div>
</template>
