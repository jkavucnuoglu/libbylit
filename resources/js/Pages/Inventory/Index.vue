<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {useSeoMetaTags} from "@/Composables/useSeoMetaTags.js";

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
