<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {computed, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";


const props = defineProps({
    product: {
        type: [Object],
        default: () => {
        },
    },
})


const form = useForm({
    price: props.product.price,
    id: props.product.id,
    name: props.product.name,
    description: props.product.description,
    tax: props.product.tax,
    total: props.product.total,
});

const submitForm = () => {
    form.post(route('products-store'), {
        errorBag: 'submitForm',
        preserveScroll: true,
    });
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
                                <p class="mb-4">Products Add</p>
                            </div>
                        </div>

                    </div>
                    <FormSection @submitted="submitForm">
                        <template #form>

                            <input type="hidden" v-model="form.id">
                            <div class="col-span-6 sm:col-span-4 grid-cols-1">
                                <InputLabel for="name" value="Name"/>
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="form.errors.name" class="mt-2"/>
                            </div>

                            <div class="col-span-6 sm:col-span-4 grid-cols-1">
                                <InputLabel for="price" value="Price"/>
                                <TextInput
                                    id="price"
                                    v-model="form.price"
                                    type="number"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="form.errors.price" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 mt-2">
                                <InputLabel for="tax" value="Tax"/>
                                <TextInput
                                    id="tax"
                                    v-model="form.tax"
                                    type="number"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="form.errors.tax" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 mt-2">
                                <InputLabel for="total" value="Total"/>
                                <TextInput
                                    id="total"
                                    v-model="form.total"
                                    type="number"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="form.errors.total" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 grid-cols-1">
                                <InputLabel for="description" value="Description"/>
                                <TextInput
                                    id="description"
                                    v-model="form.description"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="form.errors.description" class="mt-2"/>
                            </div>

                        </template>
                        <template #actions>
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
<style scoped>
td {
    text-align: center;
}

.black-table {
    border: 1px solid #111827;
}
</style>
