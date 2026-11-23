<script setup>
import { Link } from "@inertiajs/vue3";
import { Badge } from "@/components/ui/badge";
import { show } from "@/routes/projects";

defineProps({
    project: Object,
});
</script>

<template>
    <article class="overflow-hidden rounded-lg border bg-card">
        <img
            v-if="project.cover_url"
            :src="project.cover_url"
            alt=""
            width="1200"
            height="675"
            loading="lazy"
            class="aspect-video w-full object-cover"
        />
        <div class="space-y-2 p-4">
            <h3 class="font-display text-lg font-bold">
                <Link :href="show(project)" class="hover:text-brand">
                    {{ project.title }}
                </Link>
            </h3>
            <p class="text-sm text-muted-foreground">{{ project.summary }}</p>
            <ul v-if="project.tags" class="flex flex-wrap gap-2">
                <li v-for="tag in project.tags" :key="tag">
                    <Badge variant="secondary">{{ tag }}</Badge>
                </li>
            </ul>
        </div>
    </article>
</template>
