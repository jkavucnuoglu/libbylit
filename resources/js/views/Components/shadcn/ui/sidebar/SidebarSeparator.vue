<script setup>
import Separator from '../separator/Separator.vue'
import { cn } from '@/lib/utils.js'

const props = defineProps({
  class: { type: null, required: false }
})
</script>

<template>
  <Separator
    data-sidebar="separator"
    :class="cn('mx-2 w-auto bg-sidebar-border', props.class)"
  >
    <slot />
  </Separator>
</template>
