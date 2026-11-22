<script setup>
import { Form } from "@inertiajs/vue3";
import { ref } from "vue";
import ProjectController from "@/actions/App/Http/Controllers/Admin/ProjectController";
import { Button } from "@/components/ui/button";
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import { Spinner } from "@/components/ui/spinner";

defineProps({
    project: Object,
});

const open = ref(false);
</script>

<template>
    <Dialog v-model:open="open">
        <DialogTrigger as-child>
            <Button
                variant="link"
                size="sm"
                class="cursor-pointer text-destructive"
            >
                Supprimer</Button
            >
        </DialogTrigger>

        <DialogContent>
            <DialogHeader>
                <DialogTitle>Supprimer le projet</DialogTitle>
                <DialogDescription>
                    Voulez-vous vraiment supprimer « {{ project.title }} » ?
                    Cette action est définitive.
                </DialogDescription>
            </DialogHeader>

            <Form
                v-bind="ProjectController.destroy.form(project)"
                v-slot="{ processing }"
                @success="open = false"
            >
                <DialogFooter>
                    <DialogClose as-child>
                        <Button type="button" variant="outline">
                            Annuler
                        </Button>
                    </DialogClose>
                    <Button
                        type="submit"
                        variant="destructive"
                        :disabled="processing"
                    >
                        <Spinner v-if="processing" />
                        Supprimer
                    </Button>
                </DialogFooter>
            </Form>
        </DialogContent>
    </Dialog>
</template>
