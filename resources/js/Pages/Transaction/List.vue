<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {ref} from "vue";
import DangerButton from "../../Components/DangerButton.vue";


const props = defineProps({
    transactions: {
        type: [Array],
        default: () => [],
    },
})

const openEditTransactionsPage = (id) => {
    window.location.href = route('transactions-show', [id])
}

const openAddTransactionsPage = () => {
    window.location.href = route('transactions-show')
}

const deleteTransactions = (id) => {
    window.location.href = route('transactions-delete', [id])
}
const toggleTransactions = (id) => {
    window.location.href = route('transactions-toggle', [id])
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transactions
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 ">
                    <div>
                        <div class="flex justify-between h-16">
                            <div class="flex">
                                <p class="mb-4">Transactions listing</p>
                            </div>
                            <div class="mr-3 relative">
                                <PrimaryButton @click="openAddTransactionsPage">
                                    Add
                                </PrimaryButton>
                            </div>
                        </div>

                    </div>
                    <table class="black-table border-2 shadow-md w-full table-auto">
                        <thead class="black-table">
                        <tr>
                            <th>Id</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="transaction in transactions" class="black-table">
                            <td>
                                {{ transaction.id }}
                            </td>
                            <td>
                                {{ transaction.order_id }}
                            </td>
                            <td>{{ transaction.total }}</td>
                            <td>{{ transaction.status }}</td>
                            <td>
                                <SecondaryButton @click="openEditTransactionsPage(transaction.id)" class="mr-2">
                                    Edit
                                </SecondaryButton>
                                <PrimaryButton @click="toggleTransactions(transaction.id)" class="mr-2">
                                    Toggle
                                </PrimaryButton>
                                <DangerButton @click="deleteTransactions(transaction.id)">
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
