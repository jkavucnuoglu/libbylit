<script setup>
const props = defineProps({
    currentPage: { type: Number, required: true },
    perPage: { type: Number, required: true },
    totalPages: { type: Number, required: true },
    firstPage: { type: Number },
    lastPage: { type: Number },
});

const emit = defineEmits(['update:current-page']);
const goToPage = (page) => {
    console.log(page)
    if (page >= props.firstPage && page <= props.lastPage) {
        emit('update:current-page', page);
    }
};
</script>

<template>
    <div class="flex justify-end px-4 py-4">
        <!-- Previous Button -->
        <button
            class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            @click="goToPage(currentPage - 1)"
            :disabled="currentPage <= firstPage"
            :class="{ 'opacity-50 cursor-not-allowed': currentPage <= firstPage }"
        >
            Previous
        </button>

        <!-- Next Button -->
        <button
            class="flex items-center justify-center px-3 h-8 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            @click="goToPage(currentPage + 1)"
            :disabled="currentPage >= totalPages"
            :class="{ 'opacity-50 cursor-not-allowed': currentPage >= totalPages }"
        >
            Next
        </button>
    </div>
</template>

<style scoped>

</style>
