<script setup>
import {onMounted, ref} from "vue";
import {router} from '@inertiajs/vue3'
import AppLayout from "@/views/Layouts/AppLayout.vue";
import SimplePagination from "@/views/Components/SimplePagination.vue";
import {Icon} from "@iconify/vue";
import {debounce} from 'lodash';

const props = defineProps({
    materials: Object,
    suppliers: Array,
    errors: Object,
});

const pagination = {
    currentPage: 1,
    lastPage: 10,
    total: 100,
    perPage: 10,
};

const goToPage = (page) => {
    pagination.currentPage = page;
};

const searchValue = ref('');
const items = ref(props.materials.data);
const filteredItems = ref(items);
const showMaterialViewModal = ref(false);

const search = debounce(() => {
    if (searchValue.value.length > 0) {
        filteredItems.value = items.value.filter(item => {
            return item.name.toLowerCase().includes(searchValue.value.toLowerCase());
        });
    } else {
        filteredItems.value = items.value;
    }
}, 300);

const showAddEditMaterialModal = () => {
    showMaterialViewModal.value = true;
};

const hideAddEditMaterialModal = () => {
    showMaterialViewModal.value = false;
};

const viewMaterial = (item) => {
    router.get(route('materials.show', item.id));
};

const editMaterial = (item) => {
    router.get(route('materials.edit', item.id));
};
</script>

<template>
    <AppLayout title="Materials" :breadcrumbs="[{ name: 'Materials', href: route('suppliers.index') }]">
        <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">Materials</h3>
                <p class="text-slate-500">Overview of the materials.</p>
            </div>
            <div class="ml-3">
                <div class="w-full max-w-sm min-w-[200px] relative flex items-center">
                    <a href="/materials/create"
                       class="flex items-center justify-center px-2 py-1 h-8 mr-2 text-sm font-medium text-gray-500 bg-white border border-slate-200 rounded hover:bg-gray-100 hover:text-gray-700">
                        Add Material
                    </a>
                    <div class="relative">
                        <input
                            class="w-full pr-11 h-8 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400"
                            placeholder="Search for Material..."
                            v-model="searchValue"
                            @keyup="search($event)"
                        />
                        <Icon icon="lucide:search" class="absolute top-2 right-3 w-4 h-4 text-slate-400"/>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
            <table class="w-full text-left table-auto min-w-max">
                <thead>
                <tr>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Name
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Supplier
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            SKU
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            UPC
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Category
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Price
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Taxable
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Active
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50 flex justify-end">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            <icon icon="lucide:more-vertical" class="w-4 h-4 text-slate-400"/>
                        </p>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="hover:bg-slate-50" v-if="!filteredItems.length">
                    <td class="p-4 border-b border-slate-200 py-5 text-center" colspan="9">
                        <div>
                            <p class="text-sm text-slate-500 mb-2">No Materials Found. </p>
                            <a href="/materials/create"
                                class="'flex items-center justify-center px-1 py-1 h-8 mr-2 text-sm font-medium text-gray-500 bg-white border border-slate-200 rounded hover:bg-gray-100 hover:text-gray-700'"
                            >
                                Add Material
                            </a>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50" v-for="(item, index) in filteredItems" :key="index">
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">
                            {{item.name}}
                        </p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">
                            <a :href="`/suppliers/${item.supplier.id}`">{{ item.supplier.name }}</a>
                        </p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ item.sku }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ item.upc }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ item.categories[0].name }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">$ {{ item.price }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ item.is_active }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ item.is_taxable }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <div class="flex justify-end">
                            <button @click="viewMaterial(item)" class="block px-2 py-2 text-sm text-gray-700"
                                    role="menuitem" tabindex="-1" :id="'menu-item-' + index">
                                <Icon icon="lucide:eye" class="w-4 h-4 test-slate-500"/>
                            </button>
                            <button
                                @click="editMaterial(item)"
                                class="block px-2 py-2 text-sm text-gray-700"
                                role="menuitem" tabindex="-1" :id="'menu-item-' + index">
                                <Icon icon="lucide:edit" class="w-4 h-4 text-blue-500"/>
                            </button>
                            <button
                                class="block px-2 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                :id="'menu-item-' + index"
                                @click="deleteMaterial(item)"
                            >
                                <Icon icon="lucide:trash" class="w-4 h-4 text-red-500"/>

                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <SimplePagination
            :config="pagination"
            @update:current-page="goToPage"
        />
    </AppLayout>
</template>

<style scoped>

</style>
