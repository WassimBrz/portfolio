<script setup>
import { Head } from "@inertiajs/vue3";

defineProps({
    project: Object,
});
</script>

<template>
    <Head :title="project.title" />

    <article>
        <h1>{{ project.title }}</h1>
        <p>{{ project.summary }}</p>
        <img
            v-if="project.cover_url"
            :src="project.cover_url"
            alt=""
            width="1200"
            height="675"
            class="aspect-video w-full rounded-lg object-cover"
        />
        <ul>
            <li v-for="tag in project.tags" :key="tag">{{ tag }}</li>
        </ul>
        <div
            class="prose max-w-none dark:prose-invert prose-a:text-brand"
            v-html="project.content"
        ></div>
        <a v-if="project.demo_url" :href="project.demo_url">Démo</a>
        <a v-if="project.repo_url" :href="project.repo_url">Code</a>
    </article>
</template>
