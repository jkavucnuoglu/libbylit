<script setup>
const props = defineProps({
    title: {type: String, required: false},
    buttonText: {type: String, default: "Create"},
    active: {type: Boolean, required: false},
    showButton: {type: Boolean, default: true},
    showBackdrop: {type: Boolean, default: true},
    clickOutsideClose: {type: Boolean, default: true},
    showFooter: {type: Boolean, default: true},
});

const emit = defineEmits(['closeModal', 'showModal', 'submit']);

const handleBackdropClick = (event) => {
    if (props.clickOutsideClose &&
        props.showBackdrop  &&
        event.target === event.currentTarget) {
        emit('closeModal');
    }
};

</script>

<template>
    <!-- Main modal -->
    <div :id="title"
         tabindex="-1"
         aria-hidden="true"
         class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 flex z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
         :class="{ 'hidden': !active, 'bg-slate-800/50': showBackdrop, 'bg-transparent': !showBackdrop }"
         @click="handleBackdropClick"
    >
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <slot name="header">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ title }}
                        </h3>
                        <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                @click="$emit('closeModal')">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </slot>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <slot name="modal-body">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Test
                        </div>
                    </slot>
                </div>
                <!-- Modal footer -->
                <div class="flex p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600"
                     v-if="showFooter"
                >
                    <button @click="$emit('closeModal')" type="button"
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Cancel
                    </button>
                    <button @click="emit('submit')" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-auto">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
