<script setup>
import FormSection from '@/views/Components/FormSection.vue'
import InputError from '@/views/Components/InputError.vue'
import { Avatar, AvatarFallback, AvatarImage } from '@/views/Components/shadcn/ui/avatar/index.js'
import Button from '@/views/Components/shadcn/ui/button/Button.vue'
import Input from '@/views/Components/shadcn/ui/input/Input.vue'
import Label from '@/views/Components/shadcn/ui/label/Label.vue'
import { useForm } from '@inertiajs/vue3'
import { inject } from 'vue'

const route = inject('route')

const form = useForm({
  name: '',
})

function createTeam() {
  form.post(route('teams.store'), {
    errorBag: 'createTeam',
    preserveScroll: true,
  })
}
</script>

<template>
  <FormSection @submitted="createTeam">
    <template #title>
      Team Details
    </template>

    <template #description>
      Create a new team to collaborate with others on projects.
    </template>

    <template #form>
      <div class="col-span-6">
        <Label>
          Team Owner
        </Label>

        <div class="flex items-center mt-2">
          <Avatar>
            <AvatarImage :src="$page.props.auth.user.profile_photo_path ?? ''" :alt="$page.props.auth.user.name" />
            <AvatarFallback class="rounded-full bg-secondary p-2">
              {{ $page.props.auth.user.name.charAt(0) }}
            </AvatarFallback>
          </Avatar>

          <div class="ms-4 leading-tight">
            <div class="text-gray-900 dark:text-white">
              {{ $page.props.auth.user.name }}
            </div>
            <div class="text-sm text-gray-700 dark:text-gray-300">
              {{ $page.props.auth.user.email }}
            </div>
          </div>
        </div>
      </div>

      <div class="col-span-6 sm:col-span-4">
        <Label for="name" value="">
          Team Name
        </Label>
        <Input id="name" v-model="form.name" type="text" class="block w-full mt-1" autofocus />
        <InputError :message="form.errors.name" class="mt-2" />
      </div>
    </template>

    <template #actions>
      <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Create
      </Button>
    </template>
  </FormSection>
</template>
