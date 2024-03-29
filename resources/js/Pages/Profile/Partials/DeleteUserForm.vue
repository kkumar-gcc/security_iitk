<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import {useForm} from '@inertiajs/vue3';
import {nextTick, ref} from 'vue';
import Panel from "primevue/panel";
import InputText from "primevue/inputtext";
import Dialog from "primevue/dialog";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <section class="space-y-6">
        <Panel toggleable>
            <template #header>
                <div class="flex flex-col justify-start">
                    <h2 class="text-lg font-medium">Delete Account</h2>
                    <p class="mt-1 text-sm">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
                        your account, please download any data or information that you wish to retain.
                    </p>
                </div>
            </template>
            <DangerButton @click="confirmUserDeletion">Delete Account</DangerButton>
        </Panel>
        <Dialog v-model:visible="confirmingUserDeletion" maximizable modal header="Are you sure you want to delete your account?" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please
                enter your password to confirm you would like to permanently delete your account.
            </p>

            <div class="flex flex-col gap-2 mt-6">
                <InputLabel class="sr-only" for="password" value="Password"/>
                <InputText
                    id="password"
                    ref="passwordInput"
                    type="password"
                    autocomplete="password"
                    v-model="form.password"
                    aria-describedby="password"
                    @keyup.enter="deleteUser"
                    placeholder="Password"
                    required
                />
                <InputError :message="form.errors.password"/>
            </div>

            <div class="mt-6 flex justify-end">
                <DangerButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    class="ms-3"
                    @click="deleteUser"
                >
                    Delete Account
                </DangerButton>
            </div>
        </Dialog>
    </section>
</template>
