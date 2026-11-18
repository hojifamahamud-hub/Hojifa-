<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class CrudController extends Controller
{
    abstract protected function model(): string;

    abstract protected function title(): string;

    abstract protected function fields(): array;

    protected function routeBase(): string
    {
        return Str::kebab(Str::plural(class_basename($this->model())));
    }

    protected function indexQuery()
    {
        $model = $this->model();
        $query = $model::query();

        if (in_array('sort', $this->columnNames(), true)) {
            $query->orderBy('sort')->orderByDesc('id');
        } else {
            $query->latest('id');
        }

        return $query;
    }

    protected function columnNames(): array
    {
        return array_column($this->fields(), 'name');
    }

    public function index()
    {
        return view('admin.crud.index', [
            'title' => $this->title(),
            'fields' => $this->fields(),
            'routeBase' => $this->routeBase(),
            'items' => $this->indexQuery()->paginate(50),
        ]);
    }

    public function create()
    {
        return view('admin.crud.form', [
            'title' => $this->title(),
            'fields' => $this->fields(),
            'routeBase' => $this->routeBase(),
            'item' => null,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());
        $model = $this->model();
        $item = $model::create($this->payload($request));

        return redirect()->route('admin.'.$this->routeBase().'.index')
            ->with('success', __('site.admin.saved'));
    }

    public function edit(int $id)
    {
        $model = $this->model();
        $item = $model::query()->findOrFail($id);

        return view('admin.crud.form', [
            'title' => $this->title(),
            'fields' => $this->fields(),
            'routeBase' => $this->routeBase(),
            'item' => $item,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate($this->rules());
        $model = $this->model();
        $item = $model::query()->findOrFail($id);
        $item->update($this->payload($request, $id));

        return redirect()->route('admin.'.$this->routeBase().'.index')
            ->with('success', __('site.admin.updated'));
    }

    public function destroy(int $id)
    {
        $model = $this->model();
        $model::query()->findOrFail($id)->delete();

        return redirect()->route('admin.'.$this->routeBase().'.index')
            ->with('success', __('site.admin.deleted'));
    }

    protected function rules(): array
    {
        $rules = [];

        foreach ($this->fields() as $field) {
            $name = $field['name'];
            $type = $field['type'] ?? 'text';

            $rule = match ($type) {
                'boolean' => ['nullable', 'boolean'],
                'number' => ['nullable', 'numeric'],
                'json' => ['nullable', 'string'],
                'image' => ['nullable', 'image', 'max:4096'],
                'date' => ['nullable', 'date'],
                'textarea' => ['nullable', 'string'],
                default => ['nullable', 'string', 'max:255'],
            };

            if (!empty($field['required'])) {
                array_unshift($rule, 'required');
            }

            $rules[$name] = $rule;
        }

        return $rules;
    }

    protected function payload(Request $request, ?int $id = null): array
    {
        $data = [];

        foreach ($this->fields() as $field) {
            $name = $field['name'];
            $type = $field['type'] ?? 'text';

            if ($type === 'boolean') {
                $data[$name] = $request->boolean($name);
            } elseif ($type === 'number') {
                $data[$name] = $request->filled($name) ? $request->input($name) : 0;
            } elseif ($type === 'json') {
                $raw = (string) $request->input($name, '');
                $data[$name] = array_values(array_filter(
                    array_map('trim', preg_split('/\R/', $raw) ?: []),
                    fn ($line) => $line !== ''
                ));
            } elseif ($type === 'image') {
                if ($request->hasFile($name)) {
                    $data[$name] = $request->file($name)->storePublicly('uploads', 'public');
                }
            } else {
                $value = $request->input($name);
                $data[$name] = $value === '' ? null : $value;
            }
        }

        if (array_key_exists('slug', $data)) {
            $data['slug'] = $this->resolveSlug($request, $data, $id);
        }

        return $data;
    }

    protected function resolveSlug(Request $request, array $data, ?int $id): string
    {
        $base = (string) ($data['slug'] ?: ($data['title_en'] ?? '') ?: ($data['title_bn'] ?? '') ?: ($data['name_en'] ?? '') ?: ($data['name_bn'] ?? ''));
        $base = Str::slug($base);

        if ($base === '') {
            $base = Str::lower(Str::random(8));
        }

        $model = $this->model();
        $slug = $base;
        $i = 1;

        while ($model::query()->where('slug', $slug)
            ->when($id, fn ($q) => $q->where('id', '!=', $id))
            ->exists()) {
            $slug = $base.'-'.(++$i);
        }

        return $slug;
    }
}
