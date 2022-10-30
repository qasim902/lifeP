<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {ref} from "vue";
import DangerButton from "../../Components/DangerButton.vue";


const props = defineProps({
    orders: {
        type: [Array],
        default: () => [],
    },
})

const openEditOrderPage = (id) => {
    window.location.href = route('orders-show',[id])
}

const openAddOrderPage = () => {
    window.location.href = route('orders-show')
}

const deleteOrder = (id) => {
    window.location.href = route('orders-delete',[id])
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 ">
                    <div>
                        <div class="flex justify-between h-16">
                            <div class="flex">
                                <p class="mb-4">Orders listing</p>
                            </div>
                            <div class="mr-3 relative" >

                                <PrimaryButton @click="openAddOrderPage" >
                                    Add
                                </PrimaryButton>
                            </div>
                        </div>

                    </div>
                    <table class="black-table border-2 shadow-md w-full table-auto">
                        <thead class="black-table">
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>Price</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Transactions</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="order in orders" class="black-table">
                            <td>
                                {{ order.id }}
                            </td>
                            <td>
                                {{ order.user.name }}
                            </td>
                            <td>{{ order.price }}</td>
                            <td>{{ order.tax }}</td>
                            <td>{{ order.total }}</td>
                            <td>{{ order.transactions.length }}</td>
                            <td>
                                <SecondaryButton @click="openEditOrderPage(order.id)"  class="mr-2">
                                    Edit
                                </SecondaryButton>
                                <DangerButton @click="deleteOrder(order.id)" >
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
td{
    text-align: center;
}
.black-table{
    border: 1px solid #111827;
}
</style>
