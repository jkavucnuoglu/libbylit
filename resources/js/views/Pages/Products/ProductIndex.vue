<script setup>
import {onMounted, ref} from "vue";
import {router} from '@inertiajs/vue3'
import AppLayout from "@/views/Layouts/AppLayout.vue";
import {useSeoMetaTags} from "@/views/Composables/useSeoMetaTags.js";
import {Icon} from "@iconify/vue";
import SimplePagination from "@/views/Components/SimplePagination.vue";
import ProductViewModal from "@/views/Pages/Product/ProductViewModal.vue";
import {toast} from "vue-sonner";
import {debounce} from 'lodash';

useSeoMetaTags({
    title: 'Products',
})

const props = defineProps({
    suppliers: Object,
});

const items = ref(props.suppliers.data || []);

const searchValue = ref('');
const disableEdit = ref(false);

const addEditProductModalActive = ref(false) // showAddEditProductModal

const showAddEditProductModal = () => {
    addEditProductModalActive.value = true
}

const closeAddEditProductModal = () => {
    reset();
    addEditProductModalActive.value = false
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

const viewProduct = (supplier) => {
    form.value = supplier
    disableEdit.value = true
    showAddEditProductModal();
}

const editProduct = (supplier) => {
    form.value = supplier
    disableEdit.value = false
    showAddEditProductModal();
}

const reset = () => {
    form.value = {
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
    }
    errors.value = {}
    disableEdit.value = false
}


const save = async (event) => {
    if (event?.id) {
        return router.put(
            route('suppliers.update', event.id),
            event,
            {
                onSuccess: () => {
                    closeAddEditProductModal();
                    search();
                    items.value = items.value.map(item => item.id === event.id ? {...item, ...event} : item);

                    toast.success(`Product #${event.id} updated successfully`);
                }
            }
        );
    }

    router.post(
        route('suppliers.store'),
        event,
        {
            onSuccess: () => {
                closeAddEditProductModal();
                search();
                items.value = items.value.map(item => {
                    if (item.id === event.id) {
                        return event
                    }
                    return item
                })

                toast.success("Product created successfully");
            },
            onError: (errors) => {
                for (const key in errors) {
                    toast.error(errors[key])
                }
            }
        }
    );
}

const deleteProduct = async (supplier) => {
    if (confirm('Are you sure you want to delete this supplier?')) {
        router.delete(route('suppliers.destroy', supplier.id), {
            onSuccess: (response) => {
                items.value = items.value.filter(item => item.id !== supplier.id)
                toast.success(response.props.flash.message);
            }
        });
    }
}

onMounted(() => {
    search();
});

</script>

<template>
    <AppLayout title="Products" :breadcrumbs="[{ name: 'Products', href: route('suppliers.index') }]">
        <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">Products</h3>
                <p class="text-slate-500">Overview of the suppliers.</p>
            </div>
            <div class="ml-3">
                <div class="w-full max-w-sm min-w-[200px] relative flex items-center">
                    <div class="inline-flex rounded-md shadow-xs" role="group">
                        <ProductViewModal
                            :add-edit-supplier-modal-active="addEditProductModalActive"
                            :supplier="form"
                            :show-button="items.length > 0"
                            :button-text="'Create'"
                            :disable-edit="disableEdit"
                            :errors="errors"
                            @show-add-edit-supplier-modal="showAddEditProductModal"
                            @close-add-edit-supplier-modal="closeAddEditProductModal"
                            @submit="save"
                        >
                            <template #button>
                                <button
                                    type="button"
                                    @click="showAddEditProductModal"
                                    class="flex items-center justify-center px-3 py-3 h-8 mr-2 text-sm font-medium text-gray-500 bg-white border border-slate-200 rounded hover:bg-gray-100 hover:text-gray-700"
                                >
                                    Create
                                </button>
                            </template>
                        </ProductViewModal>
                    </div>
                    <div class="relative">
                        <input
                            class="w-full pr-11 h-8 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400"
                            placeholder="Search for Product..."
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
                            Product Id
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Account #
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Product Name
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            Tax ID
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
                            <p class="text-sm text-slate-500 mb-2">No Products Found. </p>
                            <button
                                class="'flex items-center justify-center px-1 py-1 h-8 mr-2 text-sm font-medium text-gray-500 bg-white border border-slate-200 rounded hover:bg-gray-100 hover:text-gray-700'"
                                type="button"
                                @click="showAddEditProductModal">
                                Add Product
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50" v-for="(item, index) in filteredItems" :key="index">
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="block font-semibold text-sm text-slate-800">{{ item.id }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ item.account_number }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ item.name }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ item.tax_id }}</p>
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
                            <button @click="viewProduct(item)" class="block px-2 py-2 text-sm text-gray-700"
                                    role="menuitem" tabindex="-1" :id="'menu-item-' + index">
                                <Icon icon="lucide:eye" class="w-4 h-4 test-slate-500"/>
                            </button>
                            <button
                                @click="editProduct(item)"
                                class="block px-2 py-2 text-sm text-gray-700"
                                role="menuitem" tabindex="-1" :id="'menu-item-' + index">
                                <Icon icon="lucide:edit" class="w-4 h-4 text-blue-500"/>
                            </button>
                            <button
                                class="block px-2 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                :id="'menu-item-' + index"
                                @click="deleteProduct(item)"
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
