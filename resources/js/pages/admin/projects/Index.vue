<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { Button } from "@/components/ui/button";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { create, index } from "@/routes/admin/projects";

defineOptions({
    layout: {
        breadcrumbs: [{ title: "Projets", href: index() }],
    },
});

defineProps({
    projects: Array,
});
</script>

<template>
    <Head title="Projets" />

    <div class="space-y-4 p-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">Projets</h1>
            <Button as-child>
                <Link :href="create()">Nouveau projet</Link>
            </Button>
        </div>

        <Table>
            <TableHeader>
                <TableRow>
                    <TableHead>Titre</TableHead>
                    <TableHead>Adresse</TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="project in projects" :key="project.id">
                    <TableCell class="font-medium">{{
                        project.title
                    }}</TableCell>
                    <TableCell>/projets/{{ project.slug }}</TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>
