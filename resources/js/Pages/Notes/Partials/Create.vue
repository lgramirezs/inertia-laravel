<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';


const form = useForm({
    'excerpt': '',
    'content': ''
})

const submit = () => {
    form.post(route('notes.store'), {
        preserveScroll: true,
    })
}

</script>

<template>
    <AppLayout title="Notes">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Crear nueva nota
                </h2>
                <Link :href="route('notes.index')">
                    Regresar
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit" class="flex flex-col gap-4">
                        <div>
                            <InputLabel for="excerpt" value="Extracto" />
                            <TextInput
                                id="excerpt"
                                v-model="form.excerpt"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="excerpt"
                            />
                            <InputError :message="form.errors.excerpt" class="mt-2" />
                        </div>
                        <div>
                            <textarea id="content" v-model="form.content" rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                            <InputError :message="form.errors.content" class="mt-2" />
                        </div>

                        <div>
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Guardar
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>

</template>

<style scoped>

</style>
