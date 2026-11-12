<script setup>
import { Head } from "@inertiajs/vue3";

defineProps({
    projects: Array,
});
</script>

<template>
    <Head title="Projets" />

    <div class="p-4">
        <h1 class="text-xl font-semibold">Projets</h1>

        <ul>
            <li v-for="project in projects" :key="project.id">
                {{ project.title }}
            </li>
        </ul>
    </div>
</template>
