<script setup>
import {reactive} from "vue";
import AppLayout from "@/views/Layouts/AppLayout.vue";
import {ErrorMessage, Field} from "vee-validate";
import FormValueField from "@/views/Components/FormValueField.vue";
import WysiwygEditor from "@/views/Components/WysiwygEditor.vue";
import {Input} from "@/views/Components/shadcn/ui/input/index.js";
import {Select} from "@/views/Components/shadcn/ui/select/index.js";


const props = defineProps({
    product: {
        type: Object,
        default: () => ({
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
    },
    suppliers: Object,
    disableEdit: Boolean,
    errors: Object,
});

const formValues = reactive({...props.product});

const validateRequired = (value) => {
    return !!value || 'This field is required';
};

const onSubmit = () => {
    // Perform form submission logic here
    console.log('Form submitted with values:', formValues);
};

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            formValues.image = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};
</script>

<template>
    <AppLayout title="Create Products" :breadcrumbs="[{ name: 'Products', href: route('suppliers.index') }]">
        <form class="w-2/3 mx-auto mt-4"
              @submit.prevent="onSubmit">
            <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Create Products</h3>
                    <p class="text-slate-500">Create a new Product.</p>
                </div>
            </div>

            <div
                class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white rounded-lg bg-clip-border px-3">
                <div class="flex justify-between mb-3 mt-1 gap-3">
                    <div class="flex-grow">
                        <div class="mb-4">
                            <FormValueField
                                name="name"
                                :model-value="formValues.name"
                                type="text"
                                :validation-function="validateRequired"
                                label="Product Name"
                                placeholder="Product Name"
                                :disabled="disableEdit"
                                errorName="product_name"
                                @update:model-value="formValues.name = $event"
                            />
                        </div>
                        <div class="mb-4">
                            <label class="block mb-1 text-sm text-slate-700">Supplier <span
                                class="text-xs text-red-500">*</span></label>
                            <div class="mt-2">
                                <div
                                    class="flex items-center rounded-md  pl-3 py-1 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                    :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}"
                                >
                                    <Field name="supplier_id"
                                           v-model="formValues.supplier_id"
                                           as="select"
                                           :rules="validateRequired"
                                           class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                                           :disabled="disableEdit"
                                           :class="{'text-slate-700': disableEdit}">
                                        <option value="">Select Supplier</option>
                                        <option v-for="supplier in suppliers" :value="supplier.id">{{
                                                supplier.name
                                            }}
                                        </option>
                                    </Field>
                                </div>
                                <ErrorMessage name="name" class="text-red-500 text-sm"/>
                            </div>
                        </div>
                        <div class="mb-4">
                            <FormValueField
                                name="sku"
                                :model-value="formValues.sku"
                                type="text"
                                :validation-function="validateRequired"
                                label="SKU"
                                placeholder="ABC-12345-S-BL"
                                :disabled="disableEdit"
                                errorName="sku"
                                @update:model-value="formValues.sku"
                            />
                        </div>
                        <div class="mb-4">
                            <FormValueField
                                name="upc"
                                :model-value="formValues.upc"
                                type="text"
                                :validation-function="validateRequired"
                                label="UPC"
                                placeholder="978234567890"
                                :disabled="disableEdit"
                                errorName="upc"
                                @update:model-value="formValues.sku"
                            />
                        </div>
                    </div>
                    <div
                        class="flex-1 max-h-[275px] p-1 border border-slate-200 responsive overflow-hidden  rounded-xl">
                        <img :src="formValues.image" class="w-full mx-auto h-full" alt="Product Image"
                             v-if="formValues.image"/>
                        <div v-else class="flex items-center justify-center m-3 bg-slate-100 h-[240px] rounded">
                            <p class="text-slate-500 text-sm">No image selected</p>
                        </div>
                        <input type="file" accept="image/*"
                               class="absolute top-0 opacity-0 mt-2 text-sm h-[300px] w-[230px] text-slate-500 bg-white border border-slate-200 rounded-md cursor-pointer focus:outline-none focus:border-slate-400 hover:border-slate-400"
                               @change="onFileChange"/>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="mb-4 w-full">
                        <FormValueField
                            name="min_stock"
                            :model-value="formValues.min_stock"
                            type="text"
                            :validation-function="validateRequired"
                            label="Min. Stock"
                            placeholder="0.00"
                            :disabled="disableEdit"
                            errorName="upc"
                            @update:model-value="formValues.sku"
                        />
                    </div>
                    <div class="mb-4 w-full">
                        <FormValueField
                            name="max_stock"
                            :model-value="formValues.max_stock"
                            type="text"
                            :validation-function="validateRequired"
                            label="Max Stock"
                            placeholder="0.00"
                            :disabled="disableEdit"
                            errorName="upc"
                            @update:model-value="formValues.max_stock"
                        />
                    </div>
                    <div class="mb-4 flex-1">
                        <label class="block mb-1 text-sm text-slate-700">Stock Unit</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md  pl-3 py-[2px] outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}"
                            >
                                <Field name="supplier_id"
                                       v-model="formValues.supplier_id"
                                       as="select"
                                       :rules="validateRequired"
                                       class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                                       :disabled="disableEdit"
                                       :class="{'text-slate-700': disableEdit}">
                                    <option value="">Select Unit</option>
                                    <option v-for="unit in units" :value="formValues.stock_unit">{{ unit }}</option>
                                </Field>
                            </div>
                            <ErrorMessage name="name" class="text-red-500 text-sm"/>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="mb-4 w-full">
                        <FormValueField
                            name="width"
                            :model-value="formValues.width"
                            type="text"
                            :validation-function="validateRequired"
                            label="Width"
                            placeholder="0.00"
                            :disabled="disableEdit"
                            errorName="width"
                            @update:model-value="formValues.width"
                        />
                    </div>
                    <div class="mb-4 w-full">
                        <FormValueField
                            name="height"
                            :model-value="formValues.height"
                            type="text"
                            :validation-function="validateRequired"
                            label="Height"
                            placeholder="0.00"
                            :disabled="disableEdit"
                            errorName="height"
                            @update:model-value="formValues.height"
                        />
                    </div>
                    <div class="mb-4 w-full">
                        <FormValueField
                            name="length"
                            :model-value="formValues.length"
                            type="text"
                            :validation-function="validateRequired"
                            label="Length"
                            placeholder="0.00"
                            :disabled="disableEdit"
                            errorName="length"
                            @update:model-value="formValues.length"
                        />
                    </div>
                    <div class="mb-4 w-full">
                        <FormValueField
                            name="depth"
                            :model-value="formValues.depth"
                            type="text"
                            :validation-function="validateRequired"
                            label="Depth"
                            placeholder="0.00"
                            :disabled="disableEdit"
                            errorName="depth"
                            @update:model-value="formValues.depth"
                        />
                    </div>
                    <div class="mb-4 flex-1">
                        <label class="block mb-1 text-sm text-slate-700">Dimensions Unit</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md  pl-3 py-[2px] outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}"
                            >
                                <Field name="supplier_id"
                                       v-model="formValues.dimensions_unit"
                                       as="select"
                                       :rules="validateRequired"
                                       class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                                       :disabled="disableEdit"
                                       :class="{'text-slate-700': disableEdit}">
                                    <option value="">Select Unit</option>
                                    <option v-for="unit in units" :value="formValues.stock_unit">{{ unit }}</option>
                                </Field>
                            </div>
                            <ErrorMessage name="name" class="text-red-500 text-sm"/>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="mb-4 w-full">
                        <FormValueField
                            name="weight"
                            :model-value="formValues.weight"
                            type="text"
                            :validation-function="validateRequired"
                            label="Weight"
                            placeholder="0.00"
                            :disabled="disableEdit"
                            errorName="weight"
                            @update:model-value="formValues.weight"
                        />
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block mb-1 text-sm text-slate-700">Weight Unit</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md  pl-3 py-[2px] outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}"
                            >
                                <Field name="supplier_id"
                                       v-model="formValues.supplier_id"
                                       as="select"
                                       :rules="validateRequired"
                                       class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                                       :disabled="disableEdit"
                                       :class="{'text-slate-700': disableEdit}">
                                    <option value="">Select Unit</option>
                                    <option v-for="unit in units" :value="formValues.stock_unit">{{ unit }}</option>
                                </Field>
                            </div>
                            <ErrorMessage name="name" class="text-red-500 text-sm"/>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm text-slate-700">Description</label>
                    <div class="border rounded-md p-2">
                        <textarea v-model="formValues.description"
                                  class="w-full h-32 border rounded-md p-2"
                                  placeholder="Product Description"></textarea>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="mb-4 w-full">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer" v-model="formValues.is_active">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Active</span>
                        </label>
                        <label class="inline-flex items-center cursor-pointer ml-4">
                            <input type="checkbox" value="" class="sr-only peer" v-model="formValues.is_taxable">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Taxable</span>
                        </label>
                    </div>
                </div>
                <div class="flex flex-grow bg-white mt-8">
                    <button
                        type="button"
                        class="flex items-center justify-center px-3 py-3 h-8 mr-2 text-sm font-medium text-gray-500 bg-white border border-slate-200 rounded hover:bg-gray-100 hover:text-gray-700"
                        @click="emit('closeAddEditSupplierModal')"
                        :class="{'ml-auto': disableEdit}"
                    >
                        <template v-if="disableEdit">Close</template>
                        <template v-else>Cancel</template>
                    </button>
                    <button
                        type="button"
                        class="ml-auto flex items-center justify-center px-3 py-3 h-8 mr-2 text-sm font-medium text-white bg-indigo-400 border border-slate-200 rounded hover:bg-indigo-600"
                        @click="onSubmit"
                        v-if="!disableEdit"
                    >
                        Save Supplier
                    </button>
                </div>
            </div>
        </form>
    </AppLayout>
</template>

<style scoped>

</style>
