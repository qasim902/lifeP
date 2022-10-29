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

const props = defineProps({
    orders: {
        type: [Array],
        default: () =>[],
    },
    transactionVal:{
        type: [Object],
        default: () => {
        }
    }
})
const options = ref(props.orders);

const form = useForm({
    id: props.transactionVal.id,
    order_id: props.transactionVal.order_id,
    total: props.transactionVal.total,
    status: props.transactionVal.status,
});


const submitForm = () => {
    form.post(route('transactions-store'), {
        errorBag: 'submitForm',
        preserveScroll: true,
    });
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transaction
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 ">
                    <div>
                        <div class="flex justify-between h-16">
                            <div class="flex">
                                <p class="mb-4">Transaction Add</p>
                            </div>
                        </div>

                    </div>
                    <FormSection @submitted="submitForm">
                        <template #form>

                            <input type="hidden" v-model="form.id">
                            <div class="col-span-6 sm:col-span-4 grid-cols-1">
                                <InputLabel for="order" value="Order"/>
                                <multiselect
                                    id="order"
                                    v-model="form.order_id"
                                    :options="options">
                                </multiselect>
                                <InputError :message="form.errors.order_id" class="mt-2"/>
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
<style src="@suadelabs/vue3-multiselect/dist/vue3-multiselect.css"></style>
