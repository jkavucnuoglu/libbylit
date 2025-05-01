<script setup>
import {defineProps, defineEmits} from 'vue';
import {ErrorMessage, Field} from "vee-validate";

const props = defineProps({
    label: {
        type: String,
        required: true
    },
    name: {
        type: String,
        required: true
    },
    modelValue: [
        String,
        Object,
        Array,
        Boolean,
        Number
    ],
    placeholder: {
        type: String,
        default: ''
    },
    formClass: {
        type: String,
        default: 'w-full block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none'
    },
    type: {
        type: String,
        default: 'text'
    },
    disableEdit: {
        type: Boolean,
        default: false
    },
    validationFunction: {
        type: Function,
        default: () => {
            return (value) => {
                return !!value || 'This field is required';
            }
        }
    },
    disabled: {
        type: Boolean,
        default: false
    },
    errorName: {
        type: String,
        required: true,
    }
});

defineEmits(['update:modelValue']);

const onInput = (event) => {
    emit('update:modelValue', event.target.value);
};

</script>

<template>

    <label class="block mb-1 text-sm text-slate-700">{{ label }}</label>
    <div class="mt-2">
        <div
            class="flex items-center rounded-md pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500"
            :class="{'bg-slate-100 cursor-not-allowed ': disabled, 'bg-white': !disableEdit}"
        >
            <Field
                :name="name"
                :value="props.modelValue"
                :type="type"
                :placeholder="placeholder"
                :disabled="disabled"
                :class="formClass, {'text-slate-700': disabled}"
                required
                @input="onInput"
                :rules="validationFunction"
            />
        </div>
        <ErrorMessage :name="errorName" class="text-red-500 text-sm"/>
    </div>
</template>

<style scoped>

</style>
