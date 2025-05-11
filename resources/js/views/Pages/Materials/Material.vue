<script setup>
import {reactive, watch, onMounted} from "vue";
import AppLayout from "@/views/Layouts/AppLayout.vue";
import {ErrorMessage, Field} from "vee-validate";
import FormValueField from "@/views/Components/FormValueField.vue";
import {router} from "@inertiajs/vue3";
import {toast} from "vue-sonner";
import _ from 'lodash';
import ImageGallery from "@/views/Components/ImageGallery/ImageGallery.vue";
import VueMultiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.css'

const props = defineProps({
    units: {
        type: Object,
        default: () => []
    },
    categories: {
        type: Array,
        default: () => []
    },
    material: {
        type: Object,
        default: () => ({
            name: '',
            supplier_id: '',
            sku: '',
            upc: '',
            categories: [],
            images: '',
            min_stock: '',
            max_stock: '',
            stock_unit: '',
            width: '',
            height: '',
            depth: '',
            dimensions_unit: '',
            price: '',
            description: '',
        })
    },
    suppliers: Object,
    disableEdit: Boolean,
    errors: Object,
});

const formValues = reactive({...props.material});
formValues.categories = props.material.categories;

const validateRequired = (value) => {
    return !!value || 'This field is required';
};

const onSubmit = () => {
    if (formValues.id) {
        return router.post(
            route('materials.update', formValues.id),
            formValues,
            {
                onSuccess: () => {
                    toast.success('Material updated successfully');
                    router.visit(route('materials.index'));
                },
                onError: (errors) => {
                    toast.error('Error updating material');
                    console.error(errors);
                }
            }
        )
    }

    return router.post(
        route('materials.store'),
        formValues,
        {
            onSuccess: () => {
                toast.success('Material created successfully');
                // router.visit(route('materials.index'));
            },
            onError: (errors) => {
                Object.keys(errors).map()
                toast.error('Error creating material');
                console.error(errors);
            }
        }
    )
};

const resetForm = () => {
    formValues.name = '';
    formValues.description = '';
    formValues.price = '';
    formValues.sku = '';
    formValues.upc = '';
    formValues.images = '';
    formValues.min_stock = '';
    formValues.max_stock = '';
    formValues.stock_unit = '';
    formValues.width = '';
    formValues.height = '';
    formValues.depth = '';
    formValues.dimensions_unit = '';
}

const onCancel = () => {
    resetForm();
    router.visit(route('materials.index'));
}
const setValue = (name, value) => {
    formValues[name] = value;
};

const updateImages = (images) => {
    console.log(images)
    formValues.images = images;
}

</script>

<template>
    <AppLayout title="Create Materials" :breadcrumbs="[{ name: 'Materials', href: route('suppliers.index') }]">
        <form class=" mx-auto mt-4 w-10/12"
              @submit.prevent="onSubmit">
            <div class="w-full flex justify-between items-center mb-3 mt-1">
                <div v-if="!disableEdit && !formValues.id">
                    <h3 class="text-lg font-semibold text-slate-800 mb-3 dark:text-slate-50">Create Material</h3>
                    <p class="text-slate-500 text-xs mb-4 dark:text-slate-100">Use this form to add a new material to
                        the
                        inventory or catalog.
                        Enter all relevant details such as material name, category, price, description, and stock
                        quantity. You may also upload images and specify additional options like SKU, tags, or
                        variations (e.g., size, color). All required fields must be completed before submission to
                        ensure accurate material listing.</p>
                </div>
                <div v-else-if="!disableEdit && formValues.id">
                    <h3 class="text-lg font-semibold text-slate-800 mb-3 dark:text-slate-50">Edit {{
                            formValues.name
                        }}</h3>
                    <p class="text-slate-500 text-xs mb-4 dark:text-slate-100">Use this form to update the details of an
                        existing material.
                        You can modify fields such as material name, description, price, stock quantity, category, and
                        material images. Ensure that all changes accurately reflect the current material status. Any
                        updates made will be immediately reflected in the material listing upon saving.</p>
                </div>
                <div v-else-if="disableEdit && formValues.id">
                    <h3 class="text-lg font-semibold text-slate-800 mb-3 dark:text-slate-50">View {{
                            formValues.name
                        }}</h3>
                    <p class="text-slate-500 text-xs mb-4 dark:text-slate-100">View the details of the selected
                        material,
                        including its name,
                        category, price, description, and stock information. This form provides a read-only view of the
                        material's attributes, ensuring that no changes can be made. Use this page to review the
                        material's specifications and verify its current status in the inventory or catalog.</p>
                </div>
            </div>

            <div class="mb-8">
                <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                    Images
                </h6>

                <ImageGallery @update:images="updateImages"/>
            </div>

            <div
                class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white dark:bg-transparent dark:text-white  rounded-lg bg-clip-border px-3">
                <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                    General Information
                </h6>
                <div>
                    <div class="mb-4">
                        <FormValueField
                            name="name"
                            v-model="formValues.name"
                            type="text"
                            :validation-function="validateRequired"
                            label="Material Name"
                            placeholder="Material Name"
                            :disabled="disableEdit"
                            errorName="material_name"

                        />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm text-slate-800 dark:text-slate-200 ">Supplier <span
                            class="text-xs text-red-500">*</span></label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md  pl-3 py-1 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                :class="{'bg-slate-100 cursor-not-allowed ': disableEdit}"
                            >
                                <select name="supplier_id"
                                        v-model="formValues.supplier_id"
                                        class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-slate-800 placeholder:text-slate-500 sm:text-sm/6 focus:outline-none"
                                        :disabled="disableEdit"
                                        :class="{'': disableEdit}">
                                    <option value="">Select Supplier</option>
                                    <option v-for="supplier in suppliers" :value="supplier.id">{{
                                            supplier.name
                                        }}
                                    </option>
                                </select>
                            </div>
                            <ErrorMessage name="name" class="text-red-500 text-sm"/>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <div class="mb-4 w-full">
                            <FormValueField
                                name="sku"
                                v-model="formValues.sku"
                                type="text"
                                :validation-function="validateRequired"
                                label="SKU"
                                placeholder="ABC-12345-S-BL"
                                :disabled="disableEdit"
                                errorName="sku"
                            />
                        </div>
                        <div class="mb-4 w-full">
                            <FormValueField
                                name="upc"
                                v-model="formValues.upc"
                                type="text"
                                :validation-function="validateRequired"
                                label="UPC"
                                placeholder="978234567890"
                                :disabled="disableEdit"
                                errorName="upc"
                            />
                        </div>
                    </div>
                </div>

                <div class="mb-4 w-full">
                    <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                        Categories
                    </h6>
                    <VueMultiselect
                        v-model="formValues.categories"
                        :options="categories"
                        :multiple="true"
                        :close-on-select="false"
                        placeholder="Select categories"
                        label="name"
                        track-by="name"
                    />

                    <!--                    <FormValueField-->
                    <!--                        name="category"-->
                    <!--                        v-model="formValues.category"-->
                    <!--                        type="text"-->
                    <!--                        :validation-function="validateRequired"-->
                    <!--                        label="Category"-->
                    <!--                        :disabled="disableEdit"-->
                    <!--                        placeholder="Candle Wax"-->
                    <!--                        errorName="category"-->

                    <!--                    />-->
                </div>

                <div class="mb-4">
                    <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                        Material Details
                    </h6>
                    <label class="block mb-1 text-sm text-slate-800 dark:text-slate-200">Description</label>
                    <div class="border rounded-md p-2"
                         :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}">
                        <textarea v-model="formValues.description"
                                  :disabled="disableEdit"
                                  class="w-full block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                                  placeholder="Material Description"></textarea>
                    </div>
                </div>
                <div class="flex justify-between gap-3 mb-3 mt-1">
                    <div class="mb-4 w-1/2">
                        <div class="mt-2">
                            <label class="block mb-1 text-sm text-slate-800  dark:text-slate-200">Price</label>
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 has-[input:focus-within]:outline-2 has-[input:focus-within]:-outline-offset-2 has-[input:focus-within]:outline-indigo-600">
                                <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6">$</div>
                                <FormValueField
                                    name="price"
                                    v-model="formValues.price"
                                    type="number"
                                    :validation-function="validateRequired"
                                    placeholder="0.000, 00"
                                    :disabled="disableEdit"
                                    form-container-class="w-full pl-3 py-1"
                                    errorName="price"

                                />
                                <div class="grid shrink-0 grid-cols-1 focus-within:relative ml-auto">
                                    <select id="currency" name="currency" aria-label="Currency" class="col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pr-7 pl-3 text-base text-gray-500 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        <option>USD</option>
                                        <option>CAD</option>
                                        <option>EUR</option>
                                    </select>
                                    <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <div class="ml-4">
                            <label class="block text-sm text-slate-800 dark:text-slate-200 mb-3">&nbsp;</label>
                            <label class="inline-flex items-center"
                                   :class="{'cursor-not-allowed ': disableEdit, 'cursor-pointer': !disableEdit}"
                            >
                                <input type="checkbox" checked class="sr-only peer" v-model="formValues.is_active"
                                       :class="[{'text-slate-800 dark:text-slate-200 bg-slate-100 cursor-not-allowed': disableEdit, 'bg-white cursor-pointer': !disableEdit }]"
                                       :disabled="disableEdit"
                                >
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                <span
                                    class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Active</span>
                            </label>
                            <label class="inline-flex items-center ml-4"
                                   :class="{'cursor-not-allowed ': disableEdit, 'cursor-pointer': !disableEdit}"
                            >
                                <input type="checkbox" value="" class="sr-only peer"
                                       v-model="formValues.is_taxable"
                                       :class="[{'text-slate-800 dark:text-slate-200 bg-slate-100 cursor-not-allowed': disableEdit, 'bg-white cursor-pointer': !disableEdit }]"
                                       :disabled="disableEdit"
                                >
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                <span
                                    class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Taxable</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                        Inventory Settings
                    </h6>
                    <div class="flex gap-3">
                        <div class="mb-4 w-full">
                            <FormValueField
                                name="min_stock"
                                v-model="formValues.min_stock"
                                type="text"
                                :validation-function="validateRequired"
                                label="Min. Stock"
                                placeholder="0.00"
                                :disabled="disableEdit"
                                errorName="upc"

                            />
                        </div>
                        <div class="mb-4 w-full">
                            <FormValueField
                                name="max_stock"
                                v-model="formValues.max_stock"
                                type="text"
                                :validation-function="validateRequired"
                                label="Max Stock"
                                placeholder="0.00"
                                :disabled="disableEdit"
                                errorName="upc"

                            />
                        </div>
                        <div class="mb-4 flex-1">
                            <label class="block mb-1 text-sm text-slate-800 dark:text-slate-200">Stock Unit</label>
                            <div class="mt-2">
                                <div
                                    class="flex items-center rounded-md  pl-3 py-[3px] outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                    :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}"
                                >
                                    <Field name="supplier_id"
                                           v-model="formValues.stock_unit"
                                           as="select"
                                           :rules="validateRequired"
                                           class="block min-w-0 grow py-[10px] pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                                           :disabled="disableEdit"
                                           :class="{'text-slate-800 dark:text-slate-200': disableEdit}">
                                        <option value="">Select Unit</option>

                                        <template
                                            v-for="(unitCategory, index) in Object.keys(units).filter(category => ['quantity', 'weight', 'volume'].includes(category))">
                                            <optgroup :label="unitCategory">
                                                <option :key="index" :value="unit"
                                                        v-for="unit in Object.keys(units[unitCategory])">
                                                    {{ _.capitalize(unit) }}
                                                </option>
                                            </optgroup>
                                        </template>
                                    </Field>
                                </div>
                                <ErrorMessage name="name" class="text-red-500 text-sm"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                        Measurements
                    </h6>
                    <div class="flex gap-3">
                        <div class="mb-4 w-full">
                            <FormValueField
                                name="width"
                                v-model="formValues.width"
                                type="text"
                                :validation-function="validateRequired"
                                label="Width"
                                placeholder="0.00"
                                :disabled="disableEdit"
                                errorName="width"

                            />
                        </div>
                        <div class="mb-4 w-full">
                            <FormValueField
                                name="height"
                                v-model="formValues.height"
                                type="text"
                                :validation-function="validateRequired"
                                label="Height"
                                placeholder="0.00"
                                :disabled="disableEdit"
                                errorName="height"

                            />
                        </div>
                        <div class="mb-4 w-full">
                            <FormValueField
                                name="depth"
                                v-model="formValues.depth"
                                type="text"
                                :validation-function="validateRequired"
                                label="Depth"
                                placeholder="0.00"
                                :disabled="disableEdit"
                                errorName="depth"

                            />
                        </div>
                        <div class="mb-4 flex-1">
                            <label class="block mb-1 text-sm text-slate-800 dark:text-slate-200">Dimensions Unit</label>
                            <div class="mt-2">
                                <div
                                    class="flex items-center rounded-md  pl-3 py-[2px] outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                    :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}"
                                >
                                    <Field name="supplier_id"
                                           v-model="formValues.dimensions_unit"
                                           as="select"
                                           :rules="validateRequired"
                                           class="block min-w-0 grow py-[11px] pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                                           :disabled="disableEdit"
                                           :class="{'text-slate-800 dark:text-slate-200': disableEdit}">
                                        <option value="">Select Unit</option>

                                        <template
                                            v-for="(unitCategory, index) in Object.keys(units).filter(category => ['dimensions'].includes(category))">
                                            <optgroup :label="unitCategory">
                                                <option :key="index" :value="unit"
                                                        v-for="unit in Object.keys(units[unitCategory])">
                                                    {{ _.capitalize(unit) }}
                                                </option>
                                            </optgroup>
                                        </template>
                                    </Field>
                                </div>
                                <ErrorMessage name="name" class="text-red-500 text-sm"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex  mt-8">
                    <a
                        v-if="disableEdit"
                        href="/materials"
                        class="ml-auto flex items-center justify-center px-3 py-3 h-8 mr-2 text-sm font-medium text-gray-500 bg-white border border-slate-200 rounded hover:bg-gray-100 hover:text-gray-700"
                    >Close</a>
                    <button
                        v-else
                        type="button"
                        class="flex items-center justify-center px-3 py-3 h-8 mr-2 text-sm font-medium text-gray-500 bg-white border border-slate-200 rounded hover:bg-gray-100 hover:text-gray-700"
                        @click="onCancel"
                        :class="{'ml-auto': disableEdit}"
                    >
                        Cancel
                    </button>
                    <button
                        type="button"
                        class="ml-auto flex items-center justify-center px-3 py-3 h-8 mr-2 text-sm font-medium text-white bg-indigo-400 border border-slate-200 rounded hover:bg-indigo-600"
                        @click="onSubmit"
                        v-if="!disableEdit"
                    >
                        <template v-if="props.material.id">
                            <span>Update Material</span>
                        </template>
                        <template v-else>
                            <span>Create Material</span>
                        </template>
                    </button>
                </div>
            </div>
        </form>
    </AppLayout>
</template>

<style scoped>

</style>
