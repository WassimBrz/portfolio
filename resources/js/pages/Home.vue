<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ProjectCard from "@/components/ProjectCard.vue";
import { Button } from "@/components/ui/button";
import { contact } from "@/routes";
import { index as projectsIndex } from "@/routes/projects";

defineProps({
    author: String,
    projects: Array,
});
</script>

<template>
    <Head title="Accueil" />

    <section class="space-y-4 py-12 md:py-20">
        <p class="font-medium text-brand">Développeur web</p>
        <h1 class="font-display text-4xl font-bold md:text-6xl">
            Bonjour, je suis {{ author }}
        </h1>
        <p class="max-w-prose text-lg text-muted-foreground">
            Je construis des sites et des applications avec Laravel et Vue.js.
            Voici mes projets récents.
        </p>
    </section>

    <section class="space-y-6">
        <h2 class="font-display text-2xl font-bold">Projets récents</h2>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <ProjectCard
                v-for="project in projects"
                :key="project.slug"
                :project="project"
            />
        </div>
        <Link :href="projectsIndex()" class="inline-block text-brand underline">
            Tous les projets
        </Link>
    </section>

    <section class="my-16 rounded-lg bg-brand p-8 text-white">
        <h2 class="font-display text-2xl font-bold">Un projet en tête ?</h2>
        <p class="mt-2">Écrivez-moi, je réponds sous deux jours.</p>
        <Button as-child variant="secondary" class="mt-4">
            <Link :href="contact()">Me contacter</Link>
        </Button>
    </section>
</template>
