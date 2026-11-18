@extends('layouts.app')

@section('title', __('site.dashboard.client').' — '.site_name())

@section('content')
<section class="section">
    <div class="container-x">
        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
            <h1>{{ __('site.dashboard.client') }}</h1>
            <span class="pill">{{ $user->name }}</span>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;margin-top:20px;">
            <div class="card card-p"><div class="muted">{{ __('site.dashboard.total_due') }}</div><div style="font-size:26px;font-weight:800;color:var(--bad);">৳ {{ number_format($totalDue, 2) }}</div></div>
            <div class="card card-p"><div class="muted">{{ __('site.dashboard.total_paid') }}</div><div style="font-size:26px;font-weight:800;color:var(--good);">৳ {{ number_format($totalPaid, 2) }}</div></div>
            <div class="card card-p"><div class="muted">{{ __('site.dashboard.invoices') }}</div><div style="font-size:26px;font-weight:800;color:var(--brand);">{{ $invoices->count() }}</div></div>
            <div class="card card-p"><div class="muted">{{ __('site.dashboard.my_projects') }}</div><div style="font-size:26px;font-weight:800;">{{ $projects->count() }}</div></div>
        </div>

        <div style="display:grid;grid-template-columns:1fr;gap:24px;margin-top:28px;">
            <div class="card card-p">
                <h3>{{ __('site.dashboard.my_projects') }}</h3>
                <form method="POST" action="{{ route('client.projects.store') }}" style="margin:14px 0;display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:10px;">
                    @csrf
                    <input name="title" class="input" placeholder="{{ __('site.dashboard.task_title') }}" required>
                    <input name="category" class="input" placeholder="Category">
                    <input name="budget" type="number" min="0" step="0.01" class="input" placeholder="{{ __('site.dashboard.amount') }}">
                    <button class="btn btn-gradient">{{ __('site.dashboard.add_project') }}</button>
                </form>
                <div style="margin-top:14px;">
                    <textarea name="description" form="projectDesc" class="textarea" style="display:none;"></textarea>
                </div>
                @if($projects->count())
                    <table class="table-x">
                        <tr><th>{{ __('site.dashboard.task_title') }}</th><th>{{ __('site.dashboard.status') }}</th><th>{{ __('site.dashboard.amount') }}</th></tr>
                        @foreach($projects as $project)
                            <tr>
                                <td>
                                    <strong>{{ $project->title }}</strong>
                                    <div class="muted">{{ \Illuminate\Support\Str::limit((string) $project->description, 90) }}</div>
                                </td>
                                <td><span class="pill">{{ $project->status }}</span></td>
                                <td>৳ {{ number_format((float) $project->budget, 2) }}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p class="muted">{{ __('site.admin.no_data') }}</p>
                @endif
            </div>

            <div class="card card-p">
                <h3>{{ __('site.dashboard.invoices') }}</h3>
                @if($invoices->count())
                    <table class="table-x">
                        <tr><th>#</th><th>{{ __('site.dashboard.amount') }}</th><th>{{ __('site.dashboard.due') }}</th><th>{{ __('site.dashboard.status') }}</th><th>{{ __('site.admin.actions') }}</th></tr>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td><strong>{{ $invoice->number }}</strong></td>
                                <td>৳ {{ number_format((float) $invoice->amount, 2) }}</td>
                                <td>৳ {{ number_format($invoice->due, 2) }}</td>
                                <td>
                                    @if($invoice->status === 'paid')<span class="pill pill-good">{{ __('site.dashboard.paid') }}</span>
                                    @elseif($invoice->status === 'partial')<span class="pill pill-warn">Partial</span>
                                    @else<span class="pill pill-bad">{{ __('site.dashboard.due') }}</span>@endif
                                </td>
                                <td style="display:flex;gap:6px;flex-wrap:wrap;">
                                    <a class="btn btn-outline btn-sm" href="{{ route('client.invoice.show', $invoice) }}">{{ __('site.admin.view') }}</a>
                                    @if($invoice->due > 0)
                                        <a class="btn btn-gradient btn-sm" href="{{ route('client.pay.show', $invoice) }}">{{ __('site.payment.title') }}</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p class="muted">{{ __('site.admin.no_data') }}</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
