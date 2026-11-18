<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->query('category');

        $projects = Project::query()
            ->when($categoryId, fn ($q) => $q->where('portfolio_category_id', $categoryId))
            ->with('category')
            ->orderBy('sort')
            ->orderByDesc('id')
            ->paginate(30);

        $categories = PortfolioCategory::query()->orderBy('sort')->get();

        return view('admin.projects.index', compact('projects', 'categories', 'categoryId'));
    }

    public function create()
    {
        return view('admin.projects.form', [
            'project' => null,
            'categories' => PortfolioCategory::query()->orderBy('sort')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        $project = Project::create($this->payload($data, $request));
        $this->storeImages($request, $project);

        return redirect()->route('admin.projects.index')->with('success', __('site.admin.saved'));
    }

    public function edit(Project $project)
    {
        $project->load('images');

        return view('admin.projects.form', [
            'project' => $project,
            'categories' => PortfolioCategory::query()->orderBy('sort')->get(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate($this->rules());

        $project->update($this->payload($data, $request, $project->id));
        $this->storeImages($request, $project);

        return redirect()->route('admin.projects.index')->with('success', __('site.admin.updated'));
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', __('site.admin.deleted'));
    }

    public function destroyImage(Request $request, ProjectImage $image)
    {
        $projectId = $image->project_id;
        $image->delete();

        return redirect()->route('admin.projects.edit', $projectId)->with('success', __('site.admin.deleted'));
    }

    protected function rules(): array
    {
        return [
            'title_bn' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'portfolio_category_id' => ['nullable', 'exists:portfolio_categories,id'],
            'client' => ['nullable', 'string', 'max:255'],
            'description_bn' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'live_url' => ['nullable', 'string', 'max:255'],
            'featured' => ['nullable', 'boolean'],
            'sort' => ['nullable', 'integer'],
            'active' => ['nullable', 'boolean'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'max:5120'],
            'before_image' => ['nullable', 'image', 'max:5120'],
            'after_image' => ['nullable', 'image', 'max:5120'],
            'metric_label' => ['nullable', 'array'],
            'metric_value' => ['nullable', 'array'],
        ];
    }

    protected function payload(array $data, Request $request, ?int $id = null): array
    {
        unset($data['images'], $data['before_image'], $data['after_image'], $data['metric_label'], $data['metric_value']);

        $data['featured'] = $request->boolean('featured');
        $data['active'] = $request->boolean('active');
        $data['metrics'] = $this->metricsFrom($request);
        $data['before_after'] = $this->beforeAfterFrom($request, $data);

        $base = Str::slug((string) ($request->input('slug') ?: $data['title_en'] ?: $data['title_bn'] ?: ''));
        if ($base === '') {
            $base = Str::lower(Str::random(8));
        }

        $slug = $base;
        $i = 1;
        while (Project::query()->where('slug', $slug)->when($id, fn ($q) => $q->where('id', '!=', $id))->exists()) {
            $slug = $base.'-'.(++$i);
        }
        $data['slug'] = $slug;

        return $data;
    }

    protected function metricsFrom(Request $request): array
    {
        $items = [];
        $labels = (array) $request->input('metric_label', []);
        $values = (array) $request->input('metric_value', []);

        foreach ($labels as $i => $label) {
            $label = trim((string) $label);
            $value = trim((string) ($values[$i] ?? ''));
            if ($label !== '' && $value !== '') {
                $items[] = ['label' => $label, 'value' => $value];
            }
        }

        return $items;
    }

    protected function beforeAfterFrom(Request $request, array $data): array
    {
        $payload = (array) ($data['before_after'] ?? []);

        if ($request->hasFile('before_image')) {
            $payload['before'] = $request->file('before_image')->storePublicly('uploads', 'public');
        }
        if ($request->hasFile('after_image')) {
            $payload['after'] = $request->file('after_image')->storePublicly('uploads', 'public');
        }

        if (empty($payload['before']) && empty($payload['after'])) {
            return [];
        }

        return $payload;
    }

    protected function storeImages(Request $request, Project $project): void
    {
        if (!$request->hasFile('images')) {
            return;
        }

        $sort = (int) $project->images()->max('sort');
        $current = (int) $project->images()->count();

        foreach ($request->file('images') as $file) {
            if (!$file || !$file->isValid()) {
                continue;
            }
            $path = $file->storePublicly('uploads', 'public');
            ProjectImage::create(['project_id' => $project->id, 'path' => $path, 'sort' => $sort + $current]);
            $sort++;
            $current++;
        }
    }
}
