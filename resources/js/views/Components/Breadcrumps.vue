<template>
    <nav aria-label="Breadcrumb" class="flex items-center font-size-sm text-slate-500">

        <ol class="flex list-none p-0 m-0">
            <!-- Loop through breadcrumb items -->
            <li
                v-for="(crumb, index) in breadcrumbs"
                :key="index"
                class="breadcrumb-item"
            >
                <!-- Link for all except the last item -->
                <template v-if="index !== breadcrumbs.length - 1">
                    <a
                        :href="crumb.link"
                        class="text-decoration-none text-slate-500 hover:text-slate-700 hover:text-decoration-underline"
                    >
                        {{ crumb.label }}
                    </a>
                </template>
                <!-- Disable link for the last item -->
                <template v-else>
                    <span class="font-weight-bold text-slate-700">{{ crumb.label }}</span>
                </template>
            </li>
        </ol>
    </nav>
</template>

<script>
import { ref } from 'vue';

export default {
    props: {
        breadcrumbs: {
            type: Array,
            required: true,
            default: () => [],
        },
    },
};
</script>

<style scoped>
/* Basic breadcrumb styles */

.breadcrumb-list {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: '/';
    margin: 0 8px;
    color: #999;
}
</style>
