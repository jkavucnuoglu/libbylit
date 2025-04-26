<script setup>
import {onMounted, ref} from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import {useSeoMetaTags} from "@/Composables/useSeoMetaTags.js";
import {Icon} from "@iconify/vue";
import SimplePagination from "@/Components/SimplePagination.vue";

useSeoMetaTags({
    title: 'Suppliers',
})

const searchValue = ref('');

const search = () => {
    if (searchValue.value === '') {
        pagination.currentPage = 1;
        pagination.totalPages = Math.ceil(filteredItems.value.length / pagination.perPage);
        start.value = (pagination.currentPage - 1) * pagination.perPage;
        end.value = start.value + pagination.perPage;

        pagination.lastPage = pagination.totalPages;
        filteredItems.value = items.slice(start.value, end.value);
    }

    filteredItems.value = items.filter(item =>
        item.name.toLowerCase().includes(searchValue.value.toLowerCase()) ||
        item.phone.toLowerCase().includes(searchValue.value.toLowerCase()) ||
        item.email.toLowerCase().includes(searchValue.value.toLowerCase()) ||
        item.address.toLowerCase().includes(searchValue.value.toLowerCase()) ||
        item.website.toLowerCase().includes(searchValue.value.toLowerCase())
    )

    pagination.currentPage = 1;
    pagination.totalPages = Math.ceil(filteredItems.value.length / pagination.perPage);
    start.value = (pagination.currentPage - 1) * pagination.perPage;
    end.value = start.value + pagination.perPage;

    filteredItems.value = filteredItems.value.slice(start.value, end.value);
}

const pagination = {
    currentPage: 1,
    perPage: 4,
    totalPages: 0,
    firstPage: 1,
    lastPage: 0,
}

const start = ref((pagination.currentPage - 1) * pagination.perPage);
const end = ref(start + pagination.perPage);

const items = [
    {
        id: 1,
        name: 'Supplier 1',
        phone: '123-456-7890',
        email: 'OaWtM@example.com',
        address: '123 Main St, Anytown, USA',
        website: 'https://example.com'
    },
    {
        id: 2,
        name: 'Supplier 2',
        phone: '987-654-3210',
        email: 'YlTgM@example.com',
        address: '456 Elm St, Anytown, USA',
        website: 'https://example.com'
    },
    {
        id: 3,
        name: 'Supplier 3',
        phone: '555-555-5555',
        email: 'OaWtM@example.com',
        address: '789 Oak St, Anytown, USA',
        website: 'https://example.com'
    },
    {
        id: 4,
        name: 'Supplier 4',
        phone: '444-444-4444',
        email: 'YlTgM@example.com',
        address: '321 Maple St, Anytown, USA',
        website: 'https://example.com'
    },
    {
        id: 5,
        name: 'Supplier 5',
        phone: '333-333-3333',
        email: 'OaWtM@example.com',
        address: '654 Pine St, Anytown, USA',
        website: 'https://example.com'
    },
    {
        id: 6,
        name: 'Supplier 6',
        phone: '222-222-2222',
        email: 'YlTgM@example.com',
        address: '987 Cedar St, Anytown, USA',
        website: 'https://example.com'
    },
    {
        id: 7,
        name: 'Supplier 7',
        phone: '111-111-1111',
        email: 'OaWtM@example.com',
        address: '654 Pine St, Anytown, USA',
        website: 'https://example.com'
    },
    {
        id: 8,
        name: 'Supplier 8',
        phone: '999-999-9999',
        email: 'YlTgM@example.com',
        address: '321 Maple St, Anytown, USA',
        website: 'https://example.com'
    },
    {
        id: 9,
        name: 'Supplier 9',
        phone: '888-888-8888',
        email: 'OaWtM@example.com',
        address: '987 Cedar St, Anytown, USA',
        website: 'https://example.com'
    },
    {
        id: 10,
        name: 'Supplier 10',
        phone: '777-777-7777',
        email: 'YlTgM@example.com',
        address: '654 Pine St, Anytown, USA',
        website: 'https://example.com'
    },
]

const filteredItems = ref(items);

const goToPage = (page) => {
    pagination.currentPage = page;

    filteredItems.value = items.filter(item =>
        item.name.toLowerCase().includes(searchValue.value.toLowerCase()) ||
        item.phone.toLowerCase().includes(searchValue.value.toLowerCase()) ||
        item.email.toLowerCase().includes(searchValue.value.toLowerCase()) ||
        item.address.toLowerCase().includes(searchValue.value.toLowerCase()) ||
        item.website.toLowerCase().includes(searchValue.value.toLowerCase())
    )

    start.value = (page - 1) * pagination.perPage;
    end.value = start.value + pagination.perPage;

    pagination.totalPages = Math.ceil(filteredItems.value.length / pagination.perPage);
    pagination.lastPage = pagination.totalPages;

    filteredItems.value = filteredItems.value.slice(start.value, end.value);
}

onMounted(() => {
    search()
})

</script>

<template>
    <AppLayout>
        <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">Suppliers</h3>
                <p class="text-slate-500">Overview of the suppliers.</p>
            </div>
            <div class="ml-3">
                <div class="w-full max-w-sm min-w-[200px] relative">
                    <div class="relative">
                        <input
                            class="w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Search for Supplier..."
                            v-model="searchValue"
                            @keyup="search($event)"
                        />
                        <Icon icon="lucide:search" class="absolute top-3 right-3 w-4 h-4 text-slate-400"/>
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
                            Supplier #
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Supplier Name
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Phone Number
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Email Address
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Website
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
                <tr class="hover:bg-slate-50" v-for="(item, index) in filteredItems" :key="index">
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="block font-semibold text-sm text-slate-800">{{ item.id }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ item.name }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ item.phone }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ item.email }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ item.website }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <div class="flex justify-end">
                            <a :href="`/suppliers/${item.id}/edit`" class="block px-2 py-2 text-sm text-gray-700"
                               role="menuitem" tabindex="-1" :id="'menu-item-' + index">
                                <Icon icon="lucide:edit" class="w-4 h-4 text-blue-500"/>
                            </a>
                            <form method="post" action="`/suppliers/${item.id}/delete`">
                                <button
                                    class="block px-2 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                    :id="'menu-item-' + index">
                                    <Icon icon="lucide:trash" class="w-4 h-4 text-red-500"/>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <SimplePagination
            :current-page="pagination.currentPage"
            :per-page="pagination.perPage"
            :total-pages="pagination.totalPages"
            :first-page="pagination.firstPage"
            :last-page="pagination.lastPage"
            @update:current-page="goToPage"
        />
    </AppLayout>
</template>

<style scoped>

</style>
