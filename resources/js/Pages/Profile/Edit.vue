<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    responses: Array,
    nodesData: Array,
});

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>
        <br>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        nodeName
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Latest Block
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sync
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="response in responses" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{ response.nodeData.nodeName }}
                    </td>
                    <td class="px-6 py-4">
                        {{ response.nodeData.serverName }}
                    </td>
                    <td class="px-6 py-4">
                        {{ response.response.result.sync_info.latest_block_height }}
                    </td>
                    <td class="px-6 py-4">
                        {{ !response.response.result.sync_info.catching_up }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

<!--        <div class="py-12">-->
<!--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">-->
<!--                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">-->
<!--                    <UpdateProfileInformationForm-->
<!--                        :must-verify-email="mustVerifyEmail"-->
<!--                        :status="status"-->
<!--                        class="max-w-xl"-->
<!--                    />-->
<!--                </div>-->

<!--                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">-->
<!--                    <UpdatePasswordForm class="max-w-xl" />-->
<!--                </div>-->

<!--                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">-->
<!--                    <DeleteUserForm class="max-w-xl" />-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </AuthenticatedLayout>
</template>
