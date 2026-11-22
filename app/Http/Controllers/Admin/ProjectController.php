<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\ProjectRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;

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
        $project = Project::create([
            ...$request->safe()->except('tags'),
            'position' => Project::max('position') + 1,
        ]);

        $project->tags()->sync($request->validated('tags', []));

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Projet créé.']);

        return to_route('admin.projects.index');
    }
}
