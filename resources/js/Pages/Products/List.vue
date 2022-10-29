<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {ref} from "vue";
import DangerButton from "../../Components/DangerButton.vue";


const props = defineProps({
    products: {
        type: [Array],
        default: () => [],
    },
})

const openEditProductsPage = (id) => {
    window.location.href = route('products-show', [id])
}

const openAddProductsPage = () => {
    window.location.href = route('products-show')
}

const deleteProducts = (id) => {
    window.location.href = route('products-delete', [id])
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 ">
                    <div>
                        <div class="flex justify-between h-16">
                            <div class="flex">
                                <p class="mb-4">Products listing</p>
                            </div>
                            <div class="mr-3 relative">

                                <PrimaryButton @click="openAddProductsPage">
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
                            <th>Price</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="product in products" class="black-table">
                            <td>
                                {{ product.id }}
                            </td>
                            <td>
                                {{ product.name }}
                            </td>
                            <td>{{ product.price }}</td>
                            <td>{{ product.tax }}</td>
                            <td>{{ product.total }}</td>
                            <td class="desc">{{ product.description }}</td>
                            <td>
                                <SecondaryButton @click="openEditProductsPage(product.id)" class="mr-2">
                                    Edit
                                </SecondaryButton>
                                <DangerButton @click="deleteProducts(product.id)">
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

.desc {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
