<script setup>
import {
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormMessage,
} from '@/views/Components/shadcn/ui/form/index.js';
import { Input } from '@/views/Components/shadcn/ui/input/index.js';
import { Textarea } from '@/views/Components/shadcn/ui/textarea/index.js';
import { computed } from 'vue';
import AutoFormLabel from './AutoFormLabel.vue';
import { beautifyObjectName } from './utils.js';

const props = defineProps({
  fieldName: { type: String, required: true },
  label: { type: String, required: false },
  required: { type: Boolean, required: false },
  config: { type: Object, required: false },
  disabled: { type: Boolean, required: false },
});
const inputComponent = computed(() =>
  props.config?.component === 'textarea' ? Textarea : Input,
);
</script>

<template>
  <FormField v-slot="slotProps" :name="fieldName">
    <FormItem v-bind="$attrs">
      <AutoFormLabel v-if="!config?.hideLabel" :required="required">
        {{ config?.label || beautifyObjectName(label ?? fieldName) }}
      </AutoFormLabel>
      <FormControl>
        <slot v-bind="slotProps">
          <component
            :is="inputComponent"
            type="text"
            v-bind="{ ...slotProps.componentField, ...config?.inputProps }"
            :disabled="disabled"
          />
        </slot>
      </FormControl>
      <FormDescription v-if="config?.description">
        {{ config.description }}
      </FormDescription>
      <FormMessage />
    </FormItem>
  </FormField>
</template>
