<script setup>
import {
    SidebarContent,
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/views/Components/shadcn/ui/sidebar/index.js'
import {Icon} from '@iconify/vue'
import {Link} from '@inertiajs/vue3'
import {useColorMode} from '@vueuse/core'
import {computed, inject} from 'vue'

const route = inject('route')
const mode = useColorMode({
    attribute: 'class',
    modes: {light: '', dark: 'dark'},
})

const navigationConfig = [
    {
        label: null,
        items: [
            {name: 'Dashboard', icon: 'lucide:layout-dashboard', route: 'dashboard'},
        ],
    },
    {
        label: 'Products',
        items: [
            {name: 'Suppliers', icon: 'lucide:truck', route: 'suppliers.index'},
            {name: 'Products', icon: 'lucide:boxes', route: 'products.index'},
        ],
    },
    {
        label: 'Production',
        items: [
            {name: 'Bill of Materials', icon: 'arcticons:reciper', route: 'suppliers.index'},
            {name: 'Batches', icon: 'lucide:boxes', route: 'products.index'},
        ],
    },
    // {
    //     label: 'API',
    //     items: [
    //         {name: 'API Tokens', icon: 'lucide:key', route: 'api-tokens.index'},
    //         {name: 'API Documentation', icon: 'lucide:book-heart', route: 'scribe', external: true},
    //     ],
    // },
    {
        label: null,
        class: 'mt-auto',
        items: [
            // {
            //     name: 'Support',
            //     icon: 'lucide:life-buoy',
            //     href: 'https://github.com/shipfastlabs/larasonic-vue/issues',
            //     external: true,
            // },
            // {
            //     name: 'Documentation',
            //     icon: 'lucide:book-marked',
            //     href: 'https://docs.larasonic.com',
            //     external: true,
            // },
        ],
    },
]

const isDarkMode = computed(() => mode.value === 'dark')

function renderLink(item) {
    if (item.external) {
        return {
            is: 'a',
            href: item.href || route(item.route),
            target: '_blank',
        }
    }
    return {
        is: Link,
        href: route(item.route),
    }
}
</script>

<template>
    <SidebarContent>
        <SidebarGroup v-for="(group, index) in navigationConfig" :key="index" :class="group.class">
            <SidebarGroupLabel v-if="group.label">
                {{ group.label }}
            </SidebarGroupLabel>
            <SidebarMenu>
                <SidebarMenuItem
                    v-for="item in group.items"
                    :key="item.name"
                    :class="{ 'font-semibold text-primary bg-secondary rounded': !item.external && route().current(item.route) }"
                >
                    <SidebarMenuButton as-child>
                        <component v-bind="renderLink(item)" :is="item.external ? 'a' : Link" prefetch>
                            <Icon :icon="item.icon"/>
                            {{ item.name }}
                        </component>
                    </SidebarMenuButton>
                </SidebarMenuItem>
                <SidebarMenuItem v-if="index === navigationConfig.length - 1">
                    <SidebarMenuButton @click="mode = isDarkMode ? 'light' : 'dark'">
                        <Icon :icon="isDarkMode ? 'lucide:moon' : 'lucide:sun'"/>
                        {{ isDarkMode ? 'Dark' : 'Light' }} Mode
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarGroup>
    </SidebarContent>
</template>
