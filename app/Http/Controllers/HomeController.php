<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $projects = Project::published()
            ->orderBy('position')
            ->take(3)
            ->get()
            ->map(fn (Project $project) => [
                'title' => $project->title,
                'slug' => $project->slug,
                'summary' => $project->summary,
                'cover_url' => $project->cover_url,
            ]);

        return Inertia::render('Home', [
            'author' => 'Wassim Bourhanzour',
            'projects' => $projects,
        ]);
    }
}
