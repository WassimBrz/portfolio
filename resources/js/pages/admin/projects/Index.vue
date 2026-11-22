<script setup>
import { Head, Link } from "@inertiajs/vue3";
import DeleteProjectDialog from "@/components/DeleteProjectDialog.vue";
import { Button } from "@/components/ui/button";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { create, index, edit } from "@/routes/admin/projects";

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
                    <div class="flex items-center justify-end gap-2">
                        <Button as-child variant="outline" size="sm">
                            <Link :href="edit(project)">Modifier</Link>
                        </Button>
                        <DeleteProjectDialog :project="project" />
                    </div>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>
