<script setup>
import AppLayout from "@/views/Layouts/AppLayout.vue";
import {useSeoMetaTags} from "@/views/Composables/useSeoMetaTags.js";

useSeoMetaTags({
    title: 'Inventory',
})
</script>

<template>
    <AppLayout>
        Inventory
    </AppLayout>
</template>

<style scoped>

</style>
