<script setup>
import Separator from '@/views/Components/shadcn/ui/separator/Separator.vue'
import AppLayout from '@/views/Layouts/AppLayout.vue'
import DeleteUserForm from '@/views/Pages/Profile/Partials/DeleteUserForm.vue'
import LinkedAccountsForm from '@/views/Pages/Profile/Partials/LinkedAccountsForm.vue'
import LogoutOtherBrowserSessionsForm from '@/views/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue'
import TwoFactorAuthenticationForm from '@/views/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue'
import UpdatePasswordForm from '@/views/Pages/Profile/Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from '@/views/Pages/Profile/Partials/UpdateProfileInformationForm.vue'

defineProps({
  confirmsTwoFactorAuthentication: {
    type: Boolean,
    default: false,
  },
  sessions: {
    type: Array,
    default: () => [],
  },
  availableOauthProviders: {
    type: Object,
    default: () => {},
  },
  activeOauthProviders: {
    type: Array,
    default: () => [],
  },
})
</script>

<template>
  <AppLayout title="Settings">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight">
        Profile Settings
      </h2>
    </template>

    <div>
      <div class="max-w-7xl">
        <div v-if="$page.props.jetstream.canUpdateProfileInformation">
          <UpdateProfileInformationForm :user="$page.props.auth.user" />
        </div>

        <div v-if="Object.keys(availableOauthProviders).length">
          <Separator class="my-8 hidden sm:block" />

          <LinkedAccountsForm
            :available-providers="availableOauthProviders"
            :active-providers="activeOauthProviders" class="mt-10 sm:mt-0"
          />
        </div>

        <div v-if="$page.props.jetstream.canUpdatePassword">
          <Separator class="my-8 hidden sm:block" />

          <UpdatePasswordForm class="mt-10 sm:mt-0" />
        </div>

        <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
          <Separator class="my-8 hidden sm:block" />
          <TwoFactorAuthenticationForm
            :requires-confirmation="confirmsTwoFactorAuthentication"
            class="mt-10 sm:mt-0"
          />
        </div>
        <div v-if="sessions.length > 0">
          <Separator class="my-8 hidden sm:block" />

          <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" />
        </div>
        <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
          <Separator class="my-8 hidden sm:block" />

          <DeleteUserForm class="mt-10 sm:mt-0" />
        </template>
      </div>
    </div>
  </AppLayout>
</template>
