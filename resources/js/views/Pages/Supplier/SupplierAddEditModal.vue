<script setup>
import { ref } from 'vue'
import Modal from "@/views/Components/Modal.vue";

const props = defineProps({
    addEditSupplierModalActive: { type: Boolean, required: true },
    supplier: { type: Object, default: {
            name: '',
            email: '',
            phone: '',
            address: ''
        }}
})

const form = ref(props.supplier.id ? props.supplier : {
    name: props.supplier.name,
    email: props.supplier.email,
    phone: props.supplier.phone,
    address: props.supplier.address
})


const emit = defineEmits(['showAddEditSupplierModal', 'closeAddEditSupplierModal', 'submit:supplier'])

const errors = ref({})

const save = async () => {
    $emit('submit:supplier', form.value)
}
</script>

<template>
    <Modal
        name="Add Supplier"
        :active="addEditSupplierModalActive"
    >
        <template #modal-body>
            <form @submit.prevent="save">
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Name</label>
                    <input v-model="form.name" class="input input-bordered w-full" required />
                    <div v-if="errors.name" class="text-red-500 text-sm">{{ errors.name }}</div>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Email</label>
                    <input v-model="form.email" type="email" class="input input-bordered w-full" />
                    <div v-if="errors.email" class="text-red-500 text-sm">{{ errors.email }}</div>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Phone</label>
                    <input v-model="form.phone" class="input input-bordered w-full" />
                    <div v-if="errors.phone" class="text-red-500 text-sm">{{ errors.phone }}</div>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Address</label>
                    <input v-model="form.address" class="input input-bordered w-full" />
                    <div v-if="errors.address" class="text-red-500 text-sm">{{ errors.address }}</div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Save</button>
                </div>
            </form>
        </template>
    </Modal>
</template>
