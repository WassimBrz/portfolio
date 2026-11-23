<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\ProjectRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('admin/projects/Index', [
            'projects' => Project::orderBy('position')->get(['id', 'title', 'slug']),
        ]);
    }
    public function create(): Response
    {
        return Inertia::render('admin/projects/Create', [
            'tags' => Tag::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['tags', 'cover']);

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('projects', 'public');
        }

        $project = Project::create([
            ...$data,
            'position' => Project::max('position') + 1,
        ]);

        $project->tags()->sync($request->validated('tags', []));

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Projet créé.']);

        return to_route('admin.projects.index');
    }

    public function edit(Project $project): Response
    {
        return Inertia::render('admin/projects/Edit', [
            'project' => [
                ...$project->only('id', 'title', 'summary', 'content', 'demo_url', 'repo_url', 'cover_url'),
                'tags' => $project->tags()->pluck('tags.id'),
            ],
            'tags' => Tag::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $request->safe()->except(['tags', 'cover']);

        if ($request->hasFile('cover')) {
            if ($project->cover_path && str_starts_with($project->cover_path, 'projects/')) {
                Storage::disk('public')->delete($project->cover_path);
            }

            $data['cover_path'] = $request->file('cover')->store('projects', 'public');
        }

        $project->update($data);

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Projet modifié.']);
        return to_route('admin.projects.index');
    }

    public function destroy(Project $project): RedirectResponse
    {
        if ($project->cover_path && str_starts_with($project->cover_path, 'projects/')) {
            Storage::disk('public')->delete($project->cover_path);
        }

        $project->delete();

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Projet supprimé.']);

        return to_route('admin.projects.index');
    }
}
