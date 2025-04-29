<script setup>
import Button from '../button/Button.vue'
import { cn } from '@/lib/utils.js'
import { PanelLeft } from 'lucide-vue-next'
import { useSidebar } from './utils.js'

const props = defineProps({
  class: { type: null, required: false }
})

const { toggleSidebar } = useSidebar()
</script>

<template>
  <Button
    data-sidebar="trigger"
    variant="ghost"
    size="icon"
    :class="cn('h-7 w-7', props.class)"
    @click="toggleSidebar"
  >
    <PanelLeft />
    <span class="sr-only">Toggle Sidebar</span>
  </Button>
</template>
