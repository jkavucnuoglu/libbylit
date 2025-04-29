<script setup>
const props = defineProps({
    config: {
        type: Object, default: {
            first_page_url: null,
            last_page_url: null,
            next_page_url: null,
            prev_page_url: null,
            total: 0,
            per_page: 0,
            current_page: 0,
            last_page: 0,
            from: 0,
            to: 0
        },
    }
});

const emit = defineEmits(['update:current-page']);
const goToPage = (page) => {
    if (page >= props.firstPage && page <= props.lastPage) {
        emit('update:current-page', page);
    }
};
</script>

<template>
    <div class="flex justify-end px-4 py-4">
        <a
            class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white mr-2"
            :href="props.config.first_page_url"

        >First Page</a>
        <a
            class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white mr-2"
            :href="props.config.prev_page_url || '#'"
        >Previous</a>
        <a
            class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white mr-2"
            :href="props.config.next_page_url || '#'"
        >Next</a>
        <a
            class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white mr-2"
            :href="props.config.last_page_url || '#'"
        >Last</a>
    </div>
</template>

<style scoped>

</style>
