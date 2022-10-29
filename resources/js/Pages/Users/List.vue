<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {ref} from "vue";
import DangerButton from "../../Components/DangerButton.vue";


const props = defineProps({
    users: {
        type: [Array],
        default: () => [],
    },
})

const openEditUsersPage = (id) => {
    window.location.href = route('users-show', [id])
}

const openAddUsersPage = () => {
    window.location.href = route('users-show')
}

const deleteUsers = (id) => {
    window.location.href = route('users-delete', [id])
}
const toggleUsers = (id) => {
    window.location.href = route('users-toggle', [id])
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 ">
                    <div>
                        <div class="flex justify-between h-16">
                            <div class="flex">
                                <p class="mb-4">Users listing</p>
                            </div>
                            <div class="mr-3 relative">
                                <PrimaryButton @click="openAddUsersPage">
                                    Add
                                </PrimaryButton>
                            </div>
                        </div>

                    </div>
                    <table class="black-table border-2 shadow-md w-full table-auto">
                        <thead class="black-table">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in users" class="black-table">
                            <td>
                                {{ user.id }}
                            </td>
                            <td>
                                {{ user.name }}
                            </td>
                            <td>{{ user.email }}</td>
                            <td>
                                <SecondaryButton @click="openEditUsersPage(user.id)" class="mr-2">
                                    Edit
                                </SecondaryButton>
                                <DangerButton @click="deleteUsers(user.id)">
                                    Delete
                                </DangerButton>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style scoped>
td {
    text-align: center;
}

.black-table {
    border: 1px solid #111827;
}
</style>
