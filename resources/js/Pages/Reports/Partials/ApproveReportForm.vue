<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import {useForm} from '@inertiajs/vue3';
import {ref} from 'vue';
import {useToast} from "primevue/usetoast";
import Check from "@/Components/icons/Check.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Dialog from "primevue/dialog";

const props = defineProps({
    reports: {
        type: Object,
    }
})
const confirmingReportApprove = ref(false);
const form = useForm({});
const confirmReportApprove = () => {
    confirmingReportApprove.value = true;
};

const toast = useToast();

const approveReports = () => {
    const reportIds = props.reports.map(report => report.id);
    form.post(route('reports.massApprove', { reports: reportIds }), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            confirmingReportApprove.value = false;
            toast.add({severity: 'success', summary: 'Success', detail: 'Reports approved successfully', life: 3000});
        },
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <section class="space-y-6">
        <SecondaryButton @click="confirmReportApprove"><Check/></SecondaryButton>
        <Dialog v-model:visible="confirmingReportApprove" modal header=" " :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <h2 class="text-lg font-medium">
                Are you sure you want to approve report - {{ reports.length }} reports?
            </h2>
            <div class="mt-6 flex justify-end">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    class="ms-3"
                    @click="approveReports"
                >
                    Approve Reports
                </PrimaryButton>
            </div>
        </Dialog>
    </section>
</template>
