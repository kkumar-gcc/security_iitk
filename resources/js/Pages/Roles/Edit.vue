<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import UpdateRoleForm from "@/Pages/Roles/Partials/UpdateRoleForm.vue";

defineProps({
    role: {
        type: Object,
    },
    permissions: {
        type: Array,
    },
})
</script>

<template>
    <Head title="Edit Role"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Role - {{ role.name }}</h2>
        </template>

        <div class="px-4 pb-4 sm:px-8 sm:pb-8">
            <UpdateRoleForm :permissions="permissions" :role="role"/>
        </div>
    </AuthenticatedLayout>
</template>
