<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import UpdateReportForm from "@/Pages/Reports/Partials/UpdateReportForm.vue";

const props = defineProps({
    report: Object,
    tags: Object,
    params : Object,
})
</script>

<template>
    <Head title="Edit Report"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Report - {{ report.serial_number }}</h2>
        </template>

        <div class="px-4 pb-4 sm:px-8 sm:pb-8">
            <UpdateReportForm :report="report" :tags="tags" :params="params"/>
        </div>
    </AuthenticatedLayout>
</template>
