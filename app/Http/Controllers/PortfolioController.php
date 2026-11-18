<?php

namespace App\Http\Controllers;

use App\Models\PortfolioCategory;
use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request, string $categorySlug = null)
    {
        $categories = PortfolioCategory::active()->orderBy('sort')->get();

        $category = $categorySlug
            ? PortfolioCategory::where('slug', $categorySlug)->firstOrFail()
            : null;

        $projects = Project::query()
            ->with('category')
            ->active()
            ->when($category, fn ($q) => $q->where('portfolio_category_id', $category->id))
            ->orderBy('sort')
            ->latest('id')
            ->paginate(9);

        return view('portfolio.index', compact('categories', 'category', 'projects'));
    }

    public function show(Project $project)
    {
        abort_unless($project->active, 404);
        $project->load('category', 'images');

        $related = Project::active()
            ->where('id', '!=', $project->id)
            ->where('portfolio_category_id', $project->portfolio_category_id)
            ->limit(3)
            ->get();

        return view('portfolio.show', compact('project', 'related'));
    }
}
