<template>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <button @click.prevent="modalOpen = true" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add user</button>
    </div>

    <TransitionRoot as="template" :show="modalOpen">
        <Dialog class="relative z-10" @close="modalOpen = false">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl sm:p-6">
                            <div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">Add User</DialogTitle>
                                </div>
                            </div>

                            <div class="p-6 flex flex-col gap-y-4">
                                <!-- Name  -->
                                <div>
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <input v-model="form.name" type="text" name="name" id="name" class="block w-full rounded-md border-0 py-3 pr-10 ring-1  focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6" :class="form.errors?.name ? 'text-red-900 ring-red-300 focus:ring-red-500' : ''" placeholder="John Doe" aria-invalid="true"/>
                                        <div v-if="form.errors?.name" class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <InputError class="mt-2 text-sm text-red-600" :message="form.errors?.name"></InputError>
                                </div>

                                <!-- Role  -->
                                <div>
                                    <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Role</label>
                                    <select id="location" v-model="form.role_id" name="location" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option v-for="(role, id) in roles" :value="id">{{ role.charAt(0).toUpperCase() + role.slice(1) }}</option>
                                    </select>
                                </div>

                                <!-- Email  -->
                                <div>
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <input v-model="form.email" type="email" name="email" id="email" class="block w-full rounded-md border-0 py-3 pr-10 ring-1 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6" :class="form.errors?.email ? 'text-red-900 ring-red-300 focus:ring-red-500' : ''" placeholder="you@example.com" aria-invalid="true"/>
                                        <div v-if="form.errors?.email" class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <InputError class="mt-2 text-sm text-red-600" :message="form.errors?.email"></InputError>
                                </div>

                                <!-- Phone  -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Phone</label>
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <span class="text-gray-500 sm:text-sm">+91</span>
                                        </div>
                                        <input v-model="form.phone" type="tel" name="phone" id="phone" class="block w-full rounded-md border-0 py-3 pl-10 pr-10 ring-1 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6" :class="form.errors?.email ? 'text-red-900 ring-red-300 focus:ring-red-500' : ''" placeholder="000-000-0000" aria-invalid="true"/>
                                        <div v-if="form.errors?.email" class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <InputError class="mt-2 text-sm text-red-600" :message="form.errors?.email"></InputError>
                                </div>

                                <!-- Description  -->
                                <div>
                                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <div class="mt-2">
                                            <textarea v-model="form.description" rows="4" name="description" id="description" class="block w-full rounded-md border-0 py-3 pr-10 ring-1 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6" :class="form.errors?.description ? 'text-red-900 ring-red-300 focus:ring-red-500' : ''" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua" aria-invalid="true"/>
                                        </div>
                                        <div v-if="form.errors?.description"  class="pointer-events-none absolute inset-y-0 right-0 flex items-top pt-3 pr-3">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                    <InputError class="mt-2 text-sm text-red-600" :message="form.errors?.description"></InputError>
                                </div>

                                <!-- Profile Photo  -->
                                <div class="mt-5">
                                    <div class="col-span-full">
                                        <div class="mt-2 flex justify-center rounded-lg border ring-1 ring-inset px-6 py-5 relative"
                                             :class="form.errors?.photo ? 'ring-red-300 focus:ring-red-500' : ''"
                                        >
                                            <div class="text-center">
                                                <div v-if="uploadedPhoto.length" class="max-h-40 min-h-full">
                                                    <img :src="uploadedPhoto" alt="" srcset="" class="max-h-40 object-contain">
                                                    <span class="absolute text-sm cursor-pointer right-2 bottom-2 hover:underline text-indigo-600" @click="resetPhoto">CHANGE</span>
                                                </div>
                                                <div v-else class="flex flex-col justify-center items-center">
                                                    <div class="flex text-sm leading-6 text-gray-600">
                                                        <label for="file-upload"
                                                               class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                            <span>Upload a Profile Pic</span>
                                                            <input @input="addFiles" id="file-upload" name="file-upload" type="file"
                                                                   class="sr-only">
                                                        </label>
                                                    </div>
                                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, up to 10MB</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <InputError class="mt-2 text-sm text-red-600" :message="form.errors?.photo"></InputError>
                                </div>
                            </div>

                            <div class="mt-5 sm:mt-6 sm:px-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                                <button type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2" @click="submit">Submit</button>
                                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0" @click="modalOpen = false" ref="cancelButtonRef">Cancel</button>
                            </div>

                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>

import {ExclamationCircleIcon} from "@heroicons/vue/24/outline/index.js";
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from "@headlessui/vue";
import {ref, watch} from "vue";
import {router, useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    roles: {
        type: Object,
        required: true
    }
});

const modalOpen = ref(false);
const form = useForm({
    name: null,
    email: null,
    phone: null,
    role_id: null,
    description: null,
    photo: null
});
const uploadedPhoto = ref('');
const addFiles = (event) => {
    uploadedPhoto.value = URL.createObjectURL(event.target.files[0])
    form.photo = event.target.files[0];
};

const resetPhoto = () => {
    uploadedPhoto.value = '';
    form.photo = null;
};

const submit = () => {
    axios.post(route('users.store'), form,{
        headers: {
        'Content-Type': 'multipart/form-data'
    }})
        .then(() => {
            modalOpen.value = false;
            router.visit(route('users.index') , {
                only: ['users']
            })
        })
        .catch((error) => {
            let errors = error.response.data.errors;
            form.errors = {
                name: errors.name ? errors.name[0] : null,
                email: errors.email ? errors.email[0] : null,
                phone: errors.phone ? errors.phone[0] : null,
                role: errors.role ? errors.role[0] : null,
                description: errors.description ? errors.description[0] : null,
                photo: errors.photo ? errors.photo[0] : null,
            };
        });
};

watch(() => modalOpen.value, (value) => {
    if (value) {
        form.reset()
        form.clearErrors()
    }
});
</script>

<style lang="scss" scoped>

</style>
