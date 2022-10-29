<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    user:{
        type: [Object],
        default: () => {
        }
    }
})
const form = useForm({
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
    password: null,
});

const submitForm = () => {
    form.post(route('users-store'), {
        errorBag: 'submitForm',
        preserveScroll: true,
    });
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 ">
                    <div>
                        <div class="flex justify-between h-16">
                            <div class="flex">
                                <p class="mb-4">User Add</p>
                            </div>
                        </div>

                    </div>
                    <FormSection @submitted="submitForm">
                        <template #form>

                            <input type="hidden" v-model="form.id">

                            <div class="col-span-6 sm:col-span-4 mt-2">
                                <InputLabel for="name" value="Name"/>
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="form.errors.name" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 mt-2">
                                <InputLabel for="email" value="Email"/>
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="form.errors.email" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 mt-2">
                                <InputLabel for="password" value="Password"/>
                                <TextInput
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="off"
                                />
                                <InputError :message="form.errors.password" class="mt-2"/>
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
