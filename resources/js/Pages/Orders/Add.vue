<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Multiselect from '@suadelabs/vue3-multiselect'
import SecondaryButton from "../../Components/SecondaryButton.vue";


const props = defineProps({
    order: {
        type: [Object],
        default: () => {
        },
    },
    products: {
        type: [Array],
        default: () => []
    }
})

const options = ref(props.products);

const form = useForm({
    price: props.order.price,
    id: props.order.id,
    tax: props.order.tax,
    total: props.order.total,
    products: props.order.order_products ?? [],
});

const submitForm = () => {
    form.post(route('orders-store'), {
        errorBag: 'submitForm',
        preserveScroll: true,
    });
}

const addProduct = () => {
    form.products.push({ product: null, quantity: 0})
}

const removeProduct = () => {
    form.products.pop()
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
                                <p class="mb-4">Orders Add</p>
                            </div>
                        </div>

                    </div>
                    <FormSection @submitted="submitForm">
                        <template #form>

                            <input type="hidden" v-model="form.id">
                            <div class="w-full col-span-6" v-if="form.products.length">
                                <div class="w-full col-span-6" v-for="product in form.products">
                                    <div class="col-span-3 sm:col-span-2 grid-cols-1">
                                        <InputLabel for="product" value="Product"/>
                                        <multiselect
                                            id="product"
                                            v-model="product.product"
                                            track-by="id"
                                            :options="options">
                                        </multiselect>
                                        <InputError :message="form.errors.products" class="mt-2"/>
                                    </div>
                                    <div class="col-span-3 sm:col-span-2 grid-cols-1">
                                        <InputLabel for="quantity" value="Quantity"/>
                                        <TextInput
                                            id="quantity"
                                            v-model="product.quantity"
                                            type="number"
                                            class="mt-1 block w-full"
                                        />
                                        <InputError :message="form.errors.quantity" class="mt-2"/>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="w-full col-span-6 text-center">
                                <h3>No product added</h3>
                            </div>
                            <!--                            <div class="col-span-6 sm:col-span-4 grid-cols-1">-->
                            <!--                                <InputLabel for="price" value="Price"/>-->
                            <!--                                <TextInput-->
                            <!--                                    id="price"-->
                            <!--                                    v-model="form.price"-->
                            <!--                                    type="number"-->
                            <!--                                    class="mt-1 block w-full"-->
                            <!--                                />-->
                            <!--                                <InputError :message="form.errors.price" class="mt-2"/>-->
                            <!--                            </div>-->
                            <!--                            <div class="col-span-6 sm:col-span-4 mt-2">-->
                            <!--                                <InputLabel for="tax" value="Tax"/>-->
                            <!--                                <TextInput-->
                            <!--                                    id="tax"-->
                            <!--                                    v-model="form.tax"-->
                            <!--                                    type="number"-->
                            <!--                                    class="mt-1 block w-full"-->
                            <!--                                />-->
                            <!--                                <InputError :message="form.errors.tax" class="mt-2"/>-->
                            <!--                            </div>-->
                            <!--                            <div class="col-span-6 sm:col-span-4 mt-2">-->
                            <!--                                <InputLabel for="total" value="Total"/>-->
                            <!--                                <TextInput-->
                            <!--                                    id="total"-->
                            <!--                                    v-model="form.total"-->
                            <!--                                    type="number"-->
                            <!--                                    class="mt-1 block w-full"-->
                            <!--                                />-->
                            <!--                                <InputError :message="form.errors.total" class="mt-2"/>-->
                            <!--                            </div>-->

                        </template>
                        <template #actions>
                            <SecondaryButton @click="addProduct" class="mr-3">
                                Add Product
                            </SecondaryButton>
                            <SecondaryButton @click="removeProduct" class="mr-3">
                                Remove Product
                            </SecondaryButton>
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save
                            </PrimaryButton>
                        </template>
                    </FormSection>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style src="@suadelabs/vue3-multiselect/dist/vue3-multiselect.css"></style>
<style scoped>
td {
    text-align: center;
}

.black-table {
    border: 1px solid #111827;
}
</style>
