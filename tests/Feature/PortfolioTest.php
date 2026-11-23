<?php

use App\Models\Project;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;


test('the projects page lists the published projects', function () {
    Project::factory()->count(2)->create();

    $this->get('/projets')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('projects/Index')
            ->has('projects', 2)
        );
});

test('a project page shows its title', function () {
    Project::factory()->create(['title' => 'Météo Wavre', 'slug' => 'meteo-wavre']);

    $this->get('/projets/meteo-wavre')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('projects/Show')
            ->where('project.title', 'Météo Wavre')
        );
});

test('guests cannot open the admin', function () {
    $this->get('/admin/projets')->assertRedirect('/login');
});

test('the author can create a project', function () {
    $this->actingAs(User::factory()->create())
        ->post('/admin/projets', [
            'title' => 'Mon portfolio',
            'summary' => 'Le site que vous lisez.',
        ])
        ->assertRedirect('/admin/projets')
        ->assertInertiaFlash('toast.message', 'Projet créé.');

    expect(Project::where('slug', 'mon-portfolio')->exists())->toBeTrue();
});

test('a project without title is refused', function () {
    $this->actingAs(User::factory()->create())
        ->post('/admin/projets', ['title' => '', 'summary' => 'Un résumé.'])
        ->assertSessionHasErrors('title');

    expect(Project::count())->toBe(0);
});
