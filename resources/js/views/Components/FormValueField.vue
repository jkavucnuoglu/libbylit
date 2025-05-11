<script setup>
import {defineProps, defineEmits} from 'vue';
import {ErrorMessage, Field} from "vee-validate";

// Props
const props = defineProps({
    label: {
        type: String,
    },
    name: {
        type: String,
        required: true,
    },
    modelValue: [String, Object, Array, Boolean, Number], // Two-way bound modelValue for v-model
    placeholder: {
        type: String,
        default: '',
    },
    formClass: {
        type: String,
        default: 'w-full block min-w-0 grow py-1.5 rounded-md px-4 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 focus:outline-none',
    },
    formContainerClass: {
        type: String,
        default: 'mt-2 flex items-center rounded-md pl-3 py-1 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500',
    },
    type: {
        type: String,
        default: 'text',
    },
    options: {
        type: Array,
        default: [],
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    validationFunction: {
        type: Function,
        default: () => {
            return (value) => !!value || 'This field is required';
        },
    },
    errorName: {
        type: String,
        required: true,
    },
});

// Emits
const emit = defineEmits(['update:modelValue']); // Update event for v-model

// Emit value when Field changes
const onInput = (event) => {
    emit('update:modelValue', event.target.value);
};
</script>

<template>
    <label class="block mb-1 text-sm text-slate-800  dark:text-slate-200" v-if="label">{{ label }}</label>
    <div :class="formContainerClass">
        <template v-if="type === 'checkbox'">
            <Field
                type="checkbox"
                :name="name"
                :value="modelValue"
                @input="onInput"
                class="rounded-md px-4"
                :class="[formClass, {'text-slate-700 bg-slate-100 cursor-not-allowed': disabled, 'bg-white': !disabled }]"
            />
        </template>
        <template v-else-if="type === 'radio' && options !== null">
            <div class="flex items-center">
                <label
                    v-for="option in options"
                    :key="option.value"
                    class="flex items-center mr-4 cursor-pointer text-slate-800  dark:text-slate-200"
                >
                    <Field
                        type="radio"
                        :name="name"
                        :value="option.value"
                        @input="onInput"
                        :disabled="disabled"
                        :class="[formClass, {'text-slate-700 bg-slate-100 cursor-not-allowed': disabled, 'bg-white': !disabled }]"
                    />
                    <span class="ml-2 text-sm text-gray-900">{{ option.text }}</span>
                </label>
            </div>
        </template>
        <template v-else-if="type === 'select' && options !== null">
            <select
                :name="name"
                :value="modelValue"
                @input="onInput"
                :disabled="disabled"
                class="rounded"
                :class="[formClass, {'text-slate-700 bg-slate-100 cursor-not-allowed': disabled, 'bg-white': !disabled }]"
            >
                <option v-for="option in options" :key="`${name.toLowerCase()}-${option.id}`" :value="option.id"
                        :disabled="disabled">
                    {{ option.name }}
                </option>
            </select>
        </template>
        <template v-else-if="type === 'textarea'">
                <textarea
                    :name="name"
                    :value="modelValue"
                    @input="onInput"
                    :disabled="disabled"
                    :class="[formClass, {'text-slate-700 bg-slate-100 cursor-not-allowed': disabled, 'bg-white': !disabled }]"
                ></textarea>
        </template>
        <template v-else-if="type === 'text' || type === 'email'">
            <Field
                :name="name"
                :value="props.modelValue"
                :type="type"
                :rules="validationFunction"
                :placeholder="placeholder"
                :disabled="disabled"
                :class="[formClass, {'text-slate-700 bg-slate-100 cursor-not-allowed': disabled, 'bg-white': !disabled }]"
                required
                class=""
                @input="onInput"
            />
        </template>
        <template v-else-if="type === 'password'">
            <Field
                :name="name"
                :value="props.modelValue"
                :type="type"
                :rules="validationFunction"
                :placeholder="placeholder"
                :disabled="disabled"
                :class="[formClass, {'text-slate-700 bg-slate-100 cursor-not-allowed': disabled, 'bg-white': !disabled }]"
                required
                class=""
                @input="onInput"
            />
        </template>
        <template v-else-if="type === 'number'">
            <input
                :name="name"
                :value="props.modelValue"
                type="number"
                step="0.01"
                :rules="validationFunction"
                :placeholder="placeholder"
                :disabled="disabled"
                :class="[formClass, {'text-slate-700 bg-slate-100 cursor-not-allowed': disabled, 'bg-white': !disabled }]"
                required
                class=""
                @input="onInput"
            />
        </template>
        <ErrorMessage :name="errorName" class="text-red-500 text-sm"/>
    </div>
</template>
