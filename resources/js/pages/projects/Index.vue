<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { show } from "@/routes/projects";
import ProjectCard from "@/components/ProjectCard.vue";

defineProps({
    projects: Array,
});
</script>

<template>
    <Head title="Projets" />

    <h1 class="py-8 font-display text-3xl font-bold md:text-4xl">
        Mes projets
    </h1>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <ProjectCard
            v-for="project in projects"
            :key="project.slug"
            :project="project"
        />
    </div>
</template>
