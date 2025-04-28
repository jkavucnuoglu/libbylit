<script setup>
import {onMounted, ref} from "vue";
import {router} from '@inertiajs/vue3'
import AppLayout from "@/views/Layouts/AppLayout.vue";
import {useSeoMetaTags} from "@/views/Composables/useSeoMetaTags.js";
import {Icon} from "@iconify/vue";
import SimplePagination from "@/views/Components/SimplePagination.vue";
import SupplierViewModal from "@/views/Pages/Supplier/SupplierViewModal.vue";
import {toast} from "vue-sonner";
import { debounce } from 'lodash';

useSeoMetaTags({
    title: 'Suppliers',
})

const props = defineProps({
    suppliers: Object,
});

const items = ref(props.suppliers.data || []);

const searchValue = ref('');
const disableEdit = ref(false);

const addEditSupplierModalActive = ref(false) // showAddEditSupplierModal

const showAddEditSupplierModal = () => {
    addEditSupplierModalActive.value = true
}

const closeAddEditSupplierModal = () => {
    reset();
    addEditSupplierModalActive.value = false
}

const errors = ref({})

const pagination = ref(props.suppliers || {
    current_page: props.suppliers.current_page || 1,
    per_page: props.suppliers.perPage || 10,
    total_pages: props.suppliers.lastPage || 1,
    first_page: 1,
    last_page: props.suppliers.lastPage || 1,
})

const filteredItems = ref(items);

const goToPage = (page) => {
    pagination.value.currentPage = page;
    router.get(route('suppliers.index'), {
        page: page,
        search: searchValue.value,
        perPage: pagination.value.perPage || 15
    }, {
        preserveState: true,
        replace: true
    });
}

const search = debounce(() => {
    router.get(route('suppliers.index'), {
        page: 1,
        search: searchValue.value,
        perPage: pagination.value.perPage
    }, {
        preserveState: true,
        replace: true
    });
}, 500);

const form = ref({
    name: '',
    account_number: '',
    tax_id: '',
    email: '',
    phone: '',
    url: '',
    address: {
        address_line_1: '',
        address_line_2: '',
        city: '',
        state: '',
        postal_code: '',
        country: ''
    }
})

const viewSupplier = (supplier) => {
    form.value = supplier
    disableEdit.value = true
    showAddEditSupplierModal();
}

const reset = () => {
    // form.value = {
    //     name: '',
    //     account_number: '',
    //     tax_id: '',
    //     email: '',
    //     phone: '',
    //     url: '',
    //     address: {
    //         address_line_1: '',
    //         address_line_2: '',
    //         city: '',
    //         state: '',
    //         postal_code: '',
    //         country: ''
    //     }
    // }
    // disableEdit.value = false
}

const editSupplier = (supplier) => {
    form.value = supplier
    disableEdit.value = false
    showAddEditSupplierModal();
}


const save = async (event) => {
    if (event?.id) {
        return router.put(
            route('suppliers.update', event.id),
            {
                name: event.name,
                email: event.email,
                phone: event.phone,
                address: {
                    address_line_1: event.address.address_line_1,
                    address_line_2: event.address.address_line_2,
                    city: event.address.city,
                    state: event.address.state,
                    postal_code: event.address.postal_code,
                    country: event.address.country
                }
            },
            {
                onSuccess: () => {
                    closeAddEditSupplierModal();
                    search();
                    items.value = items.value.map(item => {
                        if (item.id === event.id) {
                            return event
                        }
                        return item
                    })
                }
            }
        );
    }

    router.post(
        route('suppliers.store'),
        {
            name: form.value.name,
            email: form.value.email,
            phone: form.value.phone,
            address: {
                address_line_1: form.value.address.address_line_1,
                address_line_2: form.value.address.address_line_2,
                city: form.value.address.city,
                state: form.value.address.state,
                postal_code: form.value.address.postal_code,
                country: form.value.address.country
            }
        },
        {
            onSuccess: (response) => {
                items.value = response.props.suppliers.data
                pagination.value.current_page = response.props.suppliers.current_page
                pagination.value.per_page = response.props.suppliers.perPage
                pagination.value.total_pages = response.props.suppliers.lastPage
                pagination.value.first_page = 1
                pagination.value.last_page = response.props.suppliers.lastPage
                pagination.value.from = response.props.suppliers.from
                pagination.value.to = response.props.suppliers.to
                closeAddEditSupplierModal();
                search();

                toast.success("Supplier created successfully");
            },
            onError: (errors) => {
                for (const key in errors) {
                    toast.error(errors[key])
                }
            }
        }
    );
}

onMounted(() => {
    search();
});

</script>

<template>
    <AppLayout title="Suppliers" :breadcrumbs="[{ name: 'Suppliers', href: route('suppliers.index') }]">
        <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">Suppliers</h3>
                <p class="text-slate-500">Overview of the suppliers.</p>
            </div>
            <div class="ml-3">
                <div class="w-full max-w-sm min-w-[200px] relative flex items-center">
                    <div class="inline-flex rounded-md shadow-xs" role="group">
                        <SupplierViewModal
                            :add-edit-supplier-modal-active="addViewSupplierModalActive"
                            :supplier="form"
                            :show-button="items.length > 0"
                            :button-text="'Create'"
                            :errors="errors"
                            :disable-edit="disableEdit"
                            @show-add-edit-supplier-modal="showAddSupplierModal"
                            @close-add-edit-supplier-modal="closeAddEditSupplierModal"
                            @submit="save"
                        >
                            <template #button>
                                <button
                                    type="button"
                                    @click="showAddEditSupplierModal"
                                    class="flex items-center justify-center px-3 py-3 h-8 mr-2 text-sm font-medium text-gray-500 bg-white border border-slate-200 rounded hover:bg-gray-100 hover:text-gray-700"
                                >
                                    Create
                                </button>
                            </template>
                        </SupplierViewModal>
                    </div>
                    <div class="relative">
                        <input
                            class="w-full pr-11 h-8 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400"
                            placeholder="Search for Supplier..."
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
                <tr class="hover:bg-slate-50" v-if="!items.length">
                    <td class="p-4 border-b border-slate-200 py-5 text-center" colspan="6">
                        <div>
                            <p class="text-sm text-slate-500 mb-2">No Suppliers Found. </p>
                            <button
                                class="'flex items-center justify-center px-1 py-1 h-8 mr-2 text-sm font-medium text-gray-500 bg-white border border-slate-200 rounded hover:bg-gray-100 hover:text-gray-700'"
                                type="button"
                                @click="showAddEditSupplierModal">
                                Add Supplier
                            </button>
                        </div>
                    </td>
                </tr>
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
                        <p class="text-sm text-slate-500">{{ item.url }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <div class="flex justify-end">
                            <button @click="viewSupplier(item)" class="block px-2 py-2 text-sm text-gray-700"
                                    role="menuitem" tabindex="-1" :id="'menu-item-' + index">
                                <Icon icon="lucide:eye" class="w-4 h-4 text-fuchsia-500"/>
                            </button>
                            <button @click="editSupplier(item)" class="block px-2 py-2 text-sm text-gray-700"
                               role="menuitem" tabindex="-1" :id="'menu-item-' + index">
                                <Icon icon="lucide:edit" class="w-4 h-4 text-blue-500"/>
                            </button>
                            <form method="post" :action="`/suppliers/${item.id}/delete`">
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
            :config="pagination"
            @update:current-page="goToPage"
        />
    </AppLayout>
</template>

<style scoped>

</style>
