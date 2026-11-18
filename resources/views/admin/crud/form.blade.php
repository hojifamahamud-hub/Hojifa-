@extends('layouts.admin')

@section('title', $title.' — '.($item ? __('site.admin.edit') : __('site.admin.add')))

@section('content')
<a href="{{ route("admin.{$routeBase}.index") }}" class="muted">← {{__('site.admin.back')}}</a>
<h1 style="margin-top:8px;">{{ $title }} — {{ $item ? __('site.admin.edit') : __('site.admin.add') }}</h1>

<form method="POST" enctype="multipart/form-data"
      action="{{ $item ? route("admin.{$routeBase}.update", $item->id) : route("admin.{$routeBase}.store") }}"
      class="card card-p" style="max-width:760px;margin-top:14px;">
    @csrf
    @if($item) @method('PUT') @endif

    @foreach($fields as $field)
        @php($name = $field['name'])
        @php($type = $field['type'] ?? 'text')
        @php($value = $item?->{$name})
        <div style="margin-bottom:14px;">
            @if($type === 'boolean')
                <label style="display:flex;gap:8px;align-items:center;font-weight:600;font-size:14.5px;">
                    <input type="checkbox" name="{{ $name }}" value="1" @checked($item ? $value : ($name === 'active' || $name === 'featured'))>
                    {{ $field['label_bn'] }}
                </label>
            @elseif($type === 'textarea')
                <label class="label">{{ $field['label_bn'] }}</label>
                <textarea name="{{ $name }}" class="textarea" rows="5" @isset($field['required']) required @endisset>{{ old($name, is_array($value) ? json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : $value) }}</textarea>
            @elseif($type === 'image')
                <label class="label">{{ $field['label_bn'] }}</label>
                @if($value)<img src="{{ asset('storage/'.$value) }}" class="thumb" style="width:120px;aspect-ratio:auto;margin-bottom:8px;">@endif
                <input type="file" name="{{ $name }}" accept="image/*" class="input" style="padding:8px;">
            @elseif($type === 'json')
                <label class="label">{{ $field['label_bn'] }}</label>
                <textarea name="{{ $name }}" class="textarea" rows="4">{{ old($name, is_array($value) ? implode("\n", $value) : $value) }}</textarea>
            @elseif($type === 'number')
                <label class="label">{{ $field['label_bn'] }}</label>
                <input type="number" name="{{ $name }}" class="input" value="{{ old($name, $value ?? ($name === 'sort' ? '0' : ($name === 'level' ? '80' : ($name === 'rating' ? '5' : '')))) }}" @isset($field['required']) required @endisset>
            @elseif($type === 'date')
                <label class="label">{{ $field['label_bn'] }}</label>
                <input type="date" name="{{ $name }}" class="input" value="{{ old($name, $value?->format('Y-m-d')) }}">
            @else
                <label class="label">{{ $field['label_bn'] }} @unless(isset($field['required']) || $name === 'slug' || str_contains($name, '_en')) <span class="muted">({{ $field['label_en'] }})</span> @endunless</label>
                <input type="text" name="{{ $name }}" class="input" value="{{ old($name, $value) }}" @isset($field['required']) required @endisset>
            @endif
            @error($name)<p class="field-error">{{ $message }}</p>@enderror
        </div>
    @endforeach

    <div style="display:flex;gap:10px;">
        <button class="btn btn-gradient">{{ __('site.admin.save') }}</button>
        <a href="{{ route("admin.{$routeBase}.index") }}" class="btn btn-outline">{{ __('site.admin.cancel') }}</a>
    </div>
</form>
@endsection
