<script setup>
    import { ref } from 'vue';

    const props = defineProps({
        title: String,
        items: Array,
    });

    const open = ref(false);

    const toggleDropdown = () => {
        open.value = !open.value;
    };
</script>

<template>
    <div class="relative inline-block text-left">
        <div>
            <button
                type="button"
                class="inline-flex w-full justify-center gap-x-1.5 bg-transparent px-3 py-2 text-sm font-semibold text-gray-900"
                id="menu-button"
                aria-expanded="true"
                aria-haspopup="true"
                @click="toggleDropdown"
            >
                <slot name="button-title" v-if="$slots['button-title']" />
                <span class="text-gray-900" v-else>
                    {{ title }}
                    <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon"
                         :class="{'rotate-180': open }"
                    >
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>
        </div>

        <div class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                v-show="open"
        >
            <div class="py-1" role="none">
                <slot name="dropdown-items" v-if="$slots['dropdown-items']">
                    <template v-for="(item, index) in items" :key="index">
                        <a :href="item.link" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" :id="'menu-item-' + index">{{ item.title }}</a>
                    </template>
                </slot>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
