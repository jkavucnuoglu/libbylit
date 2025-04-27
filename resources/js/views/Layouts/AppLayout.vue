<script setup>
import AppSidebarContent from '@/views/Components/AppSidebarContent.vue'
import AppTeamManager from '@/views/Components/AppTeamManager.vue'
import AppUserManager from '@/views/Components/AppUserManager.vue'
import Breadcrumb from '@/views/Components/shadcn/ui/breadcrumb/Breadcrumb.vue'
import BreadcrumbItem from '@/views/Components/shadcn/ui/breadcrumb/BreadcrumbItem.vue'
import BreadcrumbLink from '@/views/Components/shadcn/ui/breadcrumb/BreadcrumbLink.vue'
import BreadcrumbList from '@/views/Components/shadcn/ui/breadcrumb/BreadcrumbList.vue'
import Separator from '@/views/Components/shadcn/ui/separator/Separator.vue'
import { Sidebar, SidebarFooter, SidebarHeader, SidebarInset } from '@/views/Components/shadcn/ui/sidebar/index.js'
import SidebarMenu from '@/views/Components/shadcn/ui/sidebar/SidebarMenu.vue'
import SidebarMenuItem from '@/views/Components/shadcn/ui/sidebar/SidebarMenuItem.vue'
import SidebarProvider from '@/views/Components/shadcn/ui/sidebar/SidebarProvider.vue'
import SidebarTrigger from '@/views/Components/shadcn/ui/sidebar/SidebarTrigger.vue'
import Sonner from '@/views/Components/shadcn/ui/sonner/Sonner.vue'
import { useSeoMetaTags } from '@/views/Composables/useSeoMetaTags.js'

const props = defineProps({
  title: String,
})

useSeoMetaTags({
  title: props.title,
})
</script>

<template>
  <div>
    <Sonner position="top-center" />
    <SidebarProvider>
      <Sidebar collapsible="icon">
        <SidebarHeader>
          <SidebarMenu>
            <SidebarMenuItem>
              <AppTeamManager v-if="$page.props.jetstream.hasTeamFeatures" />
            </SidebarMenuItem>
          </SidebarMenu>
        </SidebarHeader>

        <AppSidebarContent />

        <SidebarFooter>
          <SidebarMenu>
            <SidebarMenuItem>
              <AppUserManager />
            </SidebarMenuItem>
          </SidebarMenu>
        </SidebarFooter>
      </Sidebar>

      <SidebarInset>
        <header
          class="flex h-16 shrink-0 items-center gap-2 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12"
        >
          <div class="flex items-center gap-2 px-4">
            <SidebarTrigger class="-ml-1" />
            <Separator orientation="vertical" class="mr-2 h-4 hidden md:block" />
            <Breadcrumb>
              <BreadcrumbList>
                <BreadcrumbItem>
                  <BreadcrumbLink>
                    {{ title }}
                  </BreadcrumbLink>
                </BreadcrumbItem>
              </BreadcrumbList>
            </Breadcrumb>
          </div>
        </header>
        <main class="flex flex-1 flex-col gap-4 p-4 pt-0">
          <slot />
        </main>
      </SidebarInset>
    </SidebarProvider>
  </div>
</template>
