<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import DangerButton from '@/Components/DangerButton.vue';
import { router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

// defineProps({
//     notes: Array
// })

// const input = ref('');

const props = defineProps({
    notes: Array,
    queryParams: Object
})

const query = ref(props?.queryParams?.q ?? '');


let timer= null;

watch(query, (newValue) => {
    clearTimeout(timer);
    timer = setTimeout(() => {
        router.get(route('notes.index', {q: newValue}), {
            preserveScroll: true,
        })
    },400);
});

const submit = (note) => {
    if (confirm('Está seguro de eliminar este registro?')) {
        router.delete(route('notes.destroy', note), {
            preserveScroll: true,
        })
    }
}

// const search = () => {
//     let q = input.value;
//     router.get(route('notes.index', {q}), {
//         preserveScroll: true,
//     })
// }

</script>

<template>
    <AppLayout title="Notes">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Notes
                </h2>
                <Link :href="route('notes.create')">
                    Crear nueva nota
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg flex flex-col py-6 px-3 mb-3">
                    <input id="search" type="text" v-model="query" placeholder="Buscar"
                    class="rounded-md text-sm border-gray-300 placeholder:opacity-60" autocomplete="off">
                    <!-- <form @submit.prevent="search">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Buscar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="search" id="default-search" v-model="input" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Buscar" required>
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Buscar</button>
                        </div>
                    </form> -->
                </div>
                <div class="bg-white shadow-xl sm:rounded-lg flex flex-col gap-4 p-6">
                    <template v-for="(note) in notes" :key="note.id">
                        <div class="w-full h-auto rounded-lg shadow-xl p-6">
                            <h3 class="pb-4"> {{ note.excerpt }} </h3>
                            <div class="mt-3 flex space-x-3">
                                <Link class="bg-blue-600 text-white rounded-lg p-3 hover:bg-blue-500" :href="route('notes.show', note.id)">
                                    Ver nota completa
                                </Link>
                                <Link class="bg-yellow-600 text-white rounded-lg p-3 hover:bg-yellow-500" :href="route('notes.edit', note.id)">
                                    Editar registro
                                </Link>
                                <DangerButton @click="submit(note.id)"
                                    class="ml-3">
                                    Eliminar
                                </DangerButton>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </AppLayout>

</template>


