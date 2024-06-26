<script setup>
import {ref} from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {Link} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Toast from 'primevue/toast';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <Toast />
        <div class="min-h-screen">
            <nav class="bg-white border-b">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 md:-my-px md:ms-10 md:flex">
                                <NavLink :active="route().current('dashboard')" :href="route('dashboard')">
                                    Dashboard
                                </NavLink>
                                <NavLink
                                    :active="route().current('reports.index')" :href="route('reports.index')"
                                    v-if="can('access own reports | access all reports')"
                                >
                                    Reports
                                </NavLink>
                                <NavLink :active="route().current('attachments.index')"
                                         :href="route('attachments.index')">
                                    Attachments
                                </NavLink>
                                <NavLink :active="route().current('tags.index')" :href="route('tags.index')">
                                    Tags
                                </NavLink>
                                <NavLink v-if="can('access roles')" :active="route().current('roles.index')" :href="route('roles.index')">
                                    Roles
                                </NavLink>
                                <NavLink v-if="can('access users')" :active="route().current('users.index')" :href="route('users.index')">
                                    Users
                                </NavLink>
                            </div>
                        </div>
                        <div
                            class="hidden space-x-8 md:-my-px md:ms-10 md:flex justify-end flex-1 items-center"
                        >
                            <div v-if="can('create reports')">
                                <div class="ms-3 relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <PrimaryButton>
                                                    New Report
                                                </PrimaryButton>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('reports.create', {'type': 'normal'})">Normal Report</DropdownLink>
                                            <DropdownLink :href="route('reports.create')">New Report</DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:flex md:items-center md:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                class="inline-flex items-center px-3 py-3 border rounded-full text-sm leading-4 font-medium focus:outline-none transition ease-in-out duration-150"
                                                type="button"
                                            >
                                                {{ $page.props.auth.user.name.substring(0, 2).toUpperCase() }}
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile</DropdownLink>
                                        <DropdownLink :href="route('logout')" as="button" method="post">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center md:hidden">
                            <div v-if="can('create reports')">
                                <div class="ms-3 relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <PrimaryButton>
                                                    New Report
                                                </PrimaryButton>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('reports.create', {'type': 'normal'})">Normal Report</DropdownLink>
                                            <DropdownLink :href="route('reports.create')">New Report</DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                            <button
                                class="inline-flex items-center justify-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out"
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                            >
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        d="M4 6h16M4 12h16M4 18h16"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        d="M6 18L18 6M6 6l12 12"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="md:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :active="route().current('dashboard')" :href="route('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :active="route().current('reports.index')" :href="route('reports.index')"
                            v-if="can('access own reports | access all reports')"
                        >
                            Reports
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :active="route().current('attachments.index')"
                                           :href="route('attachments.index')">
                            Attachments
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :active="route().current('tags.index')"
                                           :href="route('tags.index')">
                            Tags
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :active="route().current('roles.index')"
                                           :href="route('roles.index')"
                                           v-if="can('access roles')"
                        >
                            Roles
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :active="route().current('users.index')"
                                           :href="route('users.index')"
                                           v-if="can('access users')"
                        >
                            Users
                        </ResponsiveNavLink>
                    </div>


                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-surface-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-surface-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile</ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" as="button" method="post">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white">
                <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"/>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot/>
            </main>
        </div>
    </div>
</template>
