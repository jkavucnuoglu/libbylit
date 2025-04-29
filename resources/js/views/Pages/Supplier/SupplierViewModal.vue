<script setup>
import { reactive, watch } from 'vue';
import { defineProps, defineEmits } from 'vue';
import Modal from '@/views/Components/Modal.vue';
import { useForm, Field, ErrorMessage } from 'vee-validate';

// Props
const props = defineProps({
    addEditSupplierModalActive: { type: Boolean, required: true },
    disableEdit: { type: Boolean, default: false },
    buttonText: { type: String, default: 'Create' },
    supplier: {
        type: Object,
        default: () => ({
            id: null,
            name: '',
            account_number: '',
            tax_id: '',
            email: '',
            phone: '',
            address: {
                address_line_1: '',
                address_line_2: '',
                city: '',
                state: '',
                postal_code: '',
                country: '',
            },
        }),
    },
    showButton: { type: Boolean, default: true },
    errors: { type: Object, default: () => ({}) },
});

// Reactive form values
const formValues = reactive({ ...props.supplier }); // Create a shallow copy of `props.supplier`

watch(
    () => props.supplier,
    (newSupplier) => {
        // Update `formValues` if the new values are different
        Object.assign(formValues, newSupplier);
    }
);


// Emits
const emit = defineEmits(['showAddEditSupplierModal', 'closeAddEditSupplierModal', 'submit']);
const showAddEditSupplierModal = () => emit('showAddEditSupplierModal');
const closeAddEditSupplierModal = () => emit('closeAddEditSupplierModal');
const onSubmit = () => {
    emit('submit', { ...formValues });
}

// Validations
const validateRequired = (value) => (!!value ? true : 'This field is required');
const validatePattern = (value, regex, message) => (regex.test(value) ? true : message);
const validateEmail = (value) => validatePattern(value, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 'Invalid email address');
const validatePhone = (value) =>
    validatePattern(value, /^\+?[1-9]\d{1,14}$/, 'Invalid phone number (must be E.164 format).');

const validateAddressLine1 = (value) =>
    validatePattern(value, /^[a-zA-Z0-9\s.,-]+$/, 'Invalid address (must contain only letters, numbers, spaces, and special characters).');

const validateCity = (value) =>
    validatePattern(value, /^[a-zA-Z\s]+$/, 'Invalid city name (must contain only letters and spaces).');

const validateState = (value) =>
    validatePattern(value, /^[A-Z]{2}$/, 'Invalid state code (must be 2 uppercase letters).');

const validateCountry = (value) =>
    validatePattern(value, /^[a-zA-Z\s]+$/, 'Invalid country name (must contain only letters and spaces).');

const validatePostalCode = (value) => {
    const postalCodeRegex = new RegExp(
        [
            /^[0-9]{5}(?:-[0-9]{4})?$/, // US ZIP
            /^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/, // CA Postal
            /^[A-Z]{1,2}[0-9][0-9A-Z]?\s?[0-9][A-Z]{2}$/, // UK Postcode
            /^[0-9]{5}$/, // EU Postal
        ]
            .map((r) => r.source)
            .join('|')
    );
    return validatePattern(value, postalCodeRegex, 'Invalid postal code.');
};
</script>

<template>
    <!-- Modal toggle -->
    <slot name="button" v-if="$slots.button" />
    <Modal
        :title="disableEdit ? 'View Supplier' : supplier.id ? 'Edit Supplier' : 'Create Supplier'"
        :active="addEditSupplierModalActive"
        :button-text="buttonText"
        :click-outside-close="true"
        :show-button="showButton"
        :show-footer="false"
        @showModal="showAddEditSupplierModal"
        @closeModal="closeAddEditSupplierModal"
        @submit="onSubmit"
    >
        <template #modal-body>
            <form>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-slate-700">Supplier Name <span
                        class="text-xs text-red-500">*</span></label>
                    <div class="mt-2">
                        <div
                            class="flex items-center rounded-md  pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                            :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}"
                        >
                            <Field v-model="formValues.name"
                                   name="name"
                                   type="text"
                                   :rules="validateRequired"
                                   :disabled="disableEdit"
                                   placeholder="ACME, Inc."
                                   class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                                   :class="{'text-slate-700': disableEdit}"
                                   required
                            />
                        </div>
                        <ErrorMessage name="name" class="text-red-500 text-sm"/>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-slate-700">Account Number</label>
                    <div class="mt-2">
                        <div
                            class="flex items-center rounded-md pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                            :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}"
                        >
                            <Field v-model="formValues.account_number"
                                   name="account_number"
                                   type="text"
                                   :rules="validateRequired"
                                   placeholder="1236325654-41545"
                                   class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                                   :disabled="disableEdit"
                                   :class="{'text-slate-700': disableEdit}"
                                   required
                            />
                        </div>
                        <ErrorMessage name="account_number" class="text-red-500 text-sm"/>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-slate-700">Tax ID</label>
                    <div class="mt-2">
                        <div
                            class="flex items-center rounded-md pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                            :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}"
                        >
                            <Field v-model="formValues.tax_id"
                                   name="tax_id"
                                   type="text"
                                   :rules="validateRequired"
                                   placeholder="777777777"
                                   class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                                   :disabled="disableEdit"
                                   :class="{'text-slate-700': disableEdit}"
                                   required
                            />
                        </div>
                        <ErrorMessage name="tax_id" class="text-red-500 text-sm"/>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-slate-700">Email Address</label>
                    <div class="mt-2">
                        <div
                            class="flex items-center rounded-md pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                            :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}"
                        >
                            <Field v-model="formValues.email"
                                   name="email"
                                   type="email"
                                   placeholder="info@acme-inc.com"
                                   class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                                   :rules="validateEmail"
                                   :disabled="disableEdit"
                                   :class="{'text-slate-700': disableEdit}"
                                   required
                            />
                        </div>
                        <ErrorMessage name="email" class="text-red-500 text-sm"/>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-slate-700">Phone Number</label>
                    <div
                        class="flex items-center rounded-md  pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                        :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}"
                    >
                        <Field
                            name="phone"
                            v-model="formValues.phone"
                            type="tel"
                            placeholder="+12345678900"
                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                            :rules="validatePhone"
                            :disabled="disableEdit"
                            :class="{'cursor-not-allowed': disableEdit}"
                            required
                        />
                    </div>
                    <ErrorMessage name="phone" class="text-red-500 text-sm"/>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-slate-700">Website URL</label>
                    <div
                        class="flex items-center rounded-md  pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                        :class="{'bg-slate-100 cursor-not-allowed ': disableEdit, 'bg-white': !disableEdit}"
                    >
                        <Field
                            name="url"
                            v-model="formValues.url"
                            type="url"
                            placeholder="https://www.acme-inc.com"
                            :disabled="disableEdit"
                            :class="{'cursor-not-allowed': disableEdit}"
                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none"
                        />
                    </div>
                    <ErrorMessage name="url" class="text-red-500 text-sm"/>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm text-slate-700">Address</label>
                    <div class="mt-2">
                        <div
                            class="flex flex-grow items-center  bg-white">
                            <Field
                                name="address_line_1"
                                v-model="formValues.address.address_line_1"
                                type="text"
                                placeholder="123 Main Street"
                                :rules="validateAddressLine1"
                                class="block min-w-0 grow py-1.5 px-3 mr-2 rounded-md mb-1 outline-1 -outline-offset-1 outline-gray-300 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                :class="{'bg-slate-100 cursor-not-allowed text-slate-700': disableEdit, 'bg-white': !disableEdit}"
                                :disabled="disableEdit"
                                required
                            />
                            <Field
                                name="address_line_2"
                                v-model="formValues.address.address_line_2"
                                placeholder="Apt, Suite, etc."
                                class="block min-w-0 w-1/8 grow py-1.5 px-3 rounded-md mb-1 outline-1 outline-gray-300 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                :class="{'bg-slate-100 cursor-not-allowed text-slate-700': disableEdit, 'bg-white': !disableEdit}"
                                :disabled="disableEdit"
                            />
                        </div>
                        <div
                            class="flex flex-grow items-center  bg-white">
                            <Field
                                name="city"
                                v-model="formValues.address.city"
                                placeholder="City"
                                :rules="validateCity"
                                class="block min-w-0 grow py-1.5 px-3 w-3/5 mr-2 rounded-md mb-1 outline-1 -outline-offset-1 outline-gray-300 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                :disabled="disableEdit"
                                :class="{'bg-slate-100 cursor-not-allowed text-slate-700': disableEdit, 'bg-white': !disableEdit}"
                                required
                            />
                            <Field
                                name="state"
                                type="text"
                                v-model="formValues.address.state"
                                placeholder="State"
                                maxlength="2"
                                :rules="validateState"
                                :disabled="disableEdit"
                                class="block w-1/8 min-w-0 grow py-1.5 px-3 mr-2 rounded-md mb-1 outline-1 -outline-offset-1 outline-gray-300 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                :class="{'bg-slate-100 cursor-not-allowed text-slate-700': disableEdit, 'bg-white': !disableEdit}"
                            />
                            <Field
                                name="postal_code"
                                v-model="formValues.address.postal_code"
                                :rules="validatePostalCode"
                                maxlength="10"
                                type="number"
                                placeholder="Postal Code / Zip Code"
                                class="block min-w-0 grow py-1.5 px-3 rounded-md mb-1 mr-2 outline-1 -outline-offset-1 outline-gray-300 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                :class="{'bg-slate-100 cursor-not-allowed text-slate-700': disableEdit, 'bg-white': !disableEdit}"
                                :disabled="disableEdit"
                            />
                            <Field
                                name="country"
                                type="text"
                                v-model="formValues.address.country"
                                placeholder="Country"
                                class="block min-w-0 grow py-1.5 px-3 w-1/5 rounded-md mb-1 outline-1 -outline-offset-1 outline-gray-300 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
                                :rules="validateCountry"
                                :disabled="disableEdit"
                                required
                                :class="{'bg-slate-100 cursor-not-allowed text-slate-700': disableEdit, 'bg-white': !disableEdit}"
                            />
                        </div>

                        <ErrorMessage name="address_line_1" class="text-red-500 text-sm block mb-1"/>
                        <ErrorMessage name="address_line_2" class="text-red-500 text-sm block mb-1"/>
                        <ErrorMessage name="city" class="text-red-500 text-sm block mb-1"/>
                        <ErrorMessage name="state" class="text-red-500 text-sm block mb-1"/>
                        <ErrorMessage name="postal_code" class="text-red-500 text-sm block mb-1"/>
                        <p class="text-xs text-gray-500" v-for="error in errors" :key="error">
                            {{ error }}
                        </p>
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
                </div>
            </form>
        </template>
    </Modal>
</template>
