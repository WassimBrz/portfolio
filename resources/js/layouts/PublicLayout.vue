<script setup>
import { Link } from "@inertiajs/vue3";
import { Toaster } from "@/components/ui/sonner";
import { about, contact, home } from "@/routes";
import { index as projectsIndex } from "@/routes/projects";
</script>

<template>
    <div class="mx-auto flex min-h-screen max-w-5xl flex-col px-4">
        <header
            class="flex flex-col gap-3 py-6 sm:flex-row sm:items-center sm:justify-between"
        >
            <Link :href="home()" class="font-display text-xl font-bold">
                Wassim Bourhanzour
            </Link>
            <nav class="flex gap-5 text-sm font-medium">
                <Link :href="projectsIndex()" class="hover:text-brand">
                    Projets
                </Link>
                <Link :href="about()" class="hover:text-brand">À propos</Link>
                <Link :href="contact()" class="hover:text-brand">Contact</Link>
            </nav>
        </header>

        <main class="flex-1">
            <slot />
        </main>

        <footer
            class="flex flex-col gap-2 border-t py-6 text-sm text-muted-foreground sm:flex-row sm:justify-between"
        >
            <p>© Wassim Bourhanzour</p>
        </footer>

        <Toaster />
    </div>
</template>
