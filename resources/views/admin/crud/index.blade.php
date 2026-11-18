@extends('layouts.admin')

@php $displayFields = array_slice($fields, 0, 5); @endphp

@section('title', $title)

@section('content')
<div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
    <h1>{{ $title }}</h1>
    <a href="{{ route("admin.{$routeBase}.create") }}" class="btn btn-gradient btn-sm" style="margin-left:auto;">+ {{ __('site.admin.add') }}</a>
</div>

<div class="card" style="margin-top:16px;overflow-x:auto;">
    <table class="table-x">
        <tr>
            <th>ID</th>
            @foreach($displayFields as $field)<th>{{ $field['label_bn'] }}</th>@endforeach
            <th>{{ __('site.admin.actions') }}</th>
        </tr>
        @forelse($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                @foreach($displayFields as $field)
                    <td @php($value = $item->{$field['name']})
                        @if($field['type'] ?? '' === 'boolean')
                        <span class="pill {{ $value ? 'pill-good' : 'pill' }}">{{ $value ? '✔' : '✖' }}</span>
                    @elseif($field['type'] ?? '' === 'image')
                        @if($value)<img src="{{ asset('storage/'.$value) }}" style="height:34px;border-radius:6px;">@else—@endif
                    @elseif($field['type'] ?? '' === 'json')
                        <span class="muted">{{ is_array($value) ? count($value).' items' : '—' }}</span>
                    @else
                        {{ \Illuminate\Support\Str::limit((string) $value, 60) }}
                    @endif
                </td>
                @endforeach
                <td style="display:flex;gap:6px;">
                    <a class="btn btn-outline btn-sm" href="{{ route("admin.{$routeBase}.edit", $item->id) }}">{{ __('site.admin.edit') }}</a>
                    <form method="POST" action="{{ route("admin.{$routeBase}.destroy", $item->id) }}" onsubmit="return confirm('{{ __('site.admin.delete') }}?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">{{ __('site.admin.delete') }}</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="{{ count($displayFields) + 2 }}" class="muted" style="text-align:center;">{{ __('site.admin.no_data') }}</td></tr>
        @endforelse
    </table>
</div>

<div class="pagination-x" style="margin-top:18px;">{{ $items->onEachSide(1)->links('vendor.pagination.custom') }}</div>
@endsection
