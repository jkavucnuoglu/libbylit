<script setup>
import { Link } from '@inertiajs/vue3'
import ApplicationLogo from './ApplicationLogo.vue'
</script>

<template>
  <Link href="/application/public">
    <ApplicationLogo class="block w-auto" />
  </Link>
</template>
