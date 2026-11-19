@extends('layouts.admin')

@section('title', __('site.admin.settings'))

@php $groupIcons = ['brand' => '🎨', 'hero' => '🚀', 'home' => '🏠', 'pricing' => '💰', 'contact' => '📞', 'popup' => '✉️', 'payment' => '💳', 'ai' => '🤖', 'seo' => '🔍', 'footer' => '🦶']; @endphp

@section('content')
<h1>{{ __('site.admin.settings') }}</h1>

<form method="POST" enctype="multipart/form-data" action="{{ route('admin.settings.update') }}" style="margin-top:16px;">
    @csrf
    @foreach($groups as $group)
        <div class="card card-p" style="margin-bottom:18px;max-width:860px;">
            <h3>{{ $groupIcons[$group] }} {{ ucfirst($group) }}</h3>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:14px;margin-top:10px;">
                @foreach(collect($fields)->where('group', $group) as $field)
                    @php
                        $key = $field['key'] ?? null;
                        $type = $field['type'];
                        $value = $key ? setting($key) : null;
                    @endphp
                    <div @if($type === 'textarea' || $type === 'heading') style="grid-column:1/-1;" @endif>
                        @if($type === 'heading')
                            <h4 style="margin:6px 0 0;font-size:14px;color:var(--muted);">{{ $field['label_bn'] }}</h4>
                        @elseif($type === 'boolean')
                            <label style="display:flex;gap:8px;align-items:center;font-weight:600;font-size:14.5px;">
                                <input type="checkbox" name="{{ $key }}" value="1" @checked($value === '1' || $value === 'true')>
                                {{ $field['label_bn'] }}
                            </label>
                        @elseif($type === 'select')
                            <label class="label">{{ $field['label_bn'] }}</label>
                            <select name="{{ $key }}" class="select">
                                @foreach($field['options'] as $option)
                                    <option value="{{ $option }}" @selected($value === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                        @elseif($type === 'image')
                            <label class="label">{{ $field['label_bn'] }}</label>
                            @if($value)<img src="{{ asset('storage/'.$value) }}" style="height:40px;border-radius:6px;margin-bottom:6px;">@endif
                            <input type="file" name="{{ $key }}" accept="image/*" class="input" style="padding:8px;">
                        @elseif($type === 'number')
                            <label class="label">{{ $field['label_bn'] }}</label>
                            <input type="number" name="{{ $key }}" class="input" value="{{ $value }}">
                        @elseif($type === 'textarea')
                            <label class="label">{{ $field['label_bn'] }}</label>
                            <textarea name="{{ $key }}" class="textarea" rows="3">{{ $value }}</textarea>
                        @else
                            <label class="label">{{ $field['label_bn'] }}</label>
                            <input type="text" name="{{ $key }}" class="input" value="{{ $value }}">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <button class="btn btn-gradient">{{ __('site.admin.save') }}</button>
</form>
@endsection
