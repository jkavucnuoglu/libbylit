<script setup>
import { Button } from '@/views/Components/shadcn/ui/button/index.js';
import { Calendar } from '@/views/Components/shadcn/ui/calendar/index.js';
import {
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormMessage,
} from '@/views/Components/shadcn/ui/form/index.js';
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/views/Components/shadcn/ui/popover/index.js';
import { cn } from '@/lib/utils.js';

import { DateFormatter, getLocalTimeZone } from '@internationalized/date';
import { CalendarIcon } from 'lucide-vue-next';
import AutoFormLabel from './AutoFormLabel.vue';
import { beautifyObjectName } from './utils.js';

defineProps({
  fieldName: { type: String, required: true },
  label: { type: String, required: false },
  required: { type: Boolean, required: false },
  config: { type: Object, required: false },
  disabled: { type: Boolean, required: false },
});

const df = new DateFormatter('en-US', {
  dateStyle: 'long',
});
</script>

<template>
  <FormField v-slot="slotProps" :name="fieldName">
    <FormItem>
      <AutoFormLabel v-if="!config?.hideLabel" :required="required">
        {{ config?.label || beautifyObjectName(label ?? fieldName) }}
      </AutoFormLabel>
      <FormControl>
        <slot v-bind="slotProps">
          <div>
            <Popover>
              <PopoverTrigger as-child :disabled="disabled">
                <Button
                  variant="outline"
                  :class="
                    cn(
                      'w-full justify-start text-left font-normal',
                      !slotProps.componentField.modelValue &&
                        'text-muted-foreground',
                    )
                  "
                >
                  <CalendarIcon class="mr-2 h-4 w-4" :size="16" />
                  {{
                    slotProps.componentField.modelValue
                      ? df.format(
                          slotProps.componentField.modelValue.toDate(
                            getLocalTimeZone(),
                          ),
                        )
                      : "Pick a date"
                  }}
                </Button>
              </PopoverTrigger>
              <PopoverContent class="w-auto p-0">
                <Calendar initial-focus v-bind="slotProps.componentField" />
              </PopoverContent>
            </Popover>
          </div>
        </slot>
      </FormControl>

      <FormDescription v-if="config?.description">
        {{ config.description }}
      </FormDescription>
      <FormMessage />
    </FormItem>
  </FormField>
</template>
