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
import { Badge } from "@/components/ui/badge";
import ProjectController from "@/actions/App/Http/Controllers/Admin/ProjectController";

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
                    <TableHead>État</TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="project in projects" :key="project.id">
                    <TableCell class="font-medium">{{
                        project.title
                    }}</TableCell>
                    <TableCell>/projets/{{ project.slug }}</TableCell>
                    <TableCell>
                        <Badge v-if="project.published_at">Publié</Badge>
                        <Badge v-else variant="secondary">Brouillon</Badge>
                    </TableCell>
                    <TableCell>
                        <Form
                            v-bind="
                                ProjectController.togglePublished.form(project)
                            "
                            class="inline"
                        >
                            <Button type="submit" variant="outline" size="sm">
                                {{
                                    project.published_at
                                        ? "Dépublier"
                                        : "Publier"
                                }}
                            </Button>
                        </Form>

                        <Button as-child variant="outline" size="sm">
                            <Link :href="edit(project)">Modifier</Link>
                        </Button>
                        <DeleteProjectDialog :project="project" />
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>
