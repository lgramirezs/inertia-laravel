<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
    note: Object
})


</script>

<template>
    <AppLayout title="Notes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Nota
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg p-6">
                    <h3 class="pb-4"> {{ note.excerpt }} </h3>
                    <p>
                        {{ note.content }}
                    </p>
                </div>
            </div>
        </div>
    </AppLayout>

</template>

<style scoped>

</style>
