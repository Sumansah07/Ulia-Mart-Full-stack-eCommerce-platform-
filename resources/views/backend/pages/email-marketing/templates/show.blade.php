@extends('backend.layouts.master')

@section('title')
    {{ $template->name }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@php
    use Illuminate\Support\Str;
@endphp

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Email Template Details') }}</h2>
                            </div>
                            <div class="tt-page-actions">
                                <a href="{{ route('admin.email-marketing.templates.index') }}" class="btn btn-outline-secondary me-2">
                                    <i data-feather="arrow-left" class="me-1"></i>{{ localize('Back to Templates') }}
                                </a>
                                <a href="{{ route('admin.email-marketing.templates.preview', $template) }}" 
                                   class="btn btn-outline-info me-2" target="_blank">
                                    <i data-feather="eye" class="me-1"></i>{{ localize('Preview') }}
                                </a>
                                <a href="{{ route('admin.email-marketing.templates.edit', $template) }}" class="btn btn-primary">
                                    <i data-feather="edit-3" class="me-1"></i>{{ localize('Edit Template') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ localize('Template Content') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Subject') }}</label>
                                <div class="p-3 bg-light rounded">
                                    {{ $template->subject }}
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Content') }}</label>
                                <div class="p-3 bg-light rounded" style="min-height: 300px;">
                                    {!! nl2br(e($template->content)) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($template->campaigns->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ localize('Campaigns Using This Template') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ localize('Campaign Name') }}</th>
                                            <th>{{ localize('Status') }}</th>
                                            <th>{{ localize('Recipients') }}</th>
                                            <th>{{ localize('Created At') }}</th>
                                            <th class="text-end">{{ localize('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($template->campaigns as $campaign)
                                            <tr>
                                                <td>
                                                    <strong>{{ $campaign->name }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $campaign->status === 'sent' ? 'success' : ($campaign->status === 'scheduled' ? 'warning' : 'secondary') }}">
                                                        {{ ucfirst($campaign->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $campaign->total_recipients ?? 0 }}</td>
                                                <td>{{ $campaign->created_at->format('M d, Y') }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.email-marketing.campaigns.show', $campaign) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        {{ localize('View') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ localize('Template Information') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Name') }}</label>
                                <p class="mb-0">{{ $template->name }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Type') }}</label>
                                <p class="mb-0">
                                    <span class="badge bg-info">{{ ucfirst($template->type) }}</span>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Status') }}</label>
                                <p class="mb-0">
                                    <span class="badge bg-{{ $template->is_active ? 'success' : 'secondary' }}">
                                        {{ $template->is_active ? localize('Active') : localize('Inactive') }}
                                    </span>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Created By') }}</label>
                                <p class="mb-0">{{ $template->creator->name ?? localize('System') }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Created At') }}</label>
                                <p class="mb-0">{{ $template->created_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Last Updated') }}</label>
                                <p class="mb-0">{{ $template->updated_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ localize('Actions') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.email-marketing.templates.edit', $template) }}" 
                                   class="btn btn-primary">
                                    <i data-feather="edit-3" class="me-2"></i>{{ localize('Edit Template') }}
                                </a>
                                
                                <a href="{{ route('admin.email-marketing.templates.preview', $template) }}" 
                                   class="btn btn-outline-info" target="_blank">
                                    <i data-feather="eye" class="me-2"></i>{{ localize('Preview Template') }}
                                </a>

                                <form action="{{ route('admin.email-marketing.templates.duplicate', $template) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary w-100">
                                        <i data-feather="copy" class="me-2"></i>{{ localize('Duplicate Template') }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.email-marketing.templates.toggle-status', $template) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-{{ $template->is_active ? 'warning' : 'success' }} w-100">
                                        <i data-feather="{{ $template->is_active ? 'pause' : 'play' }}" class="me-2"></i>
                                        {{ $template->is_active ? localize('Deactivate') : localize('Activate') }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.email-marketing.templates.destroy', $template) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('{{ localize('Are you sure you want to delete this template?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger w-100">
                                        <i data-feather="trash-2" class="me-2"></i>{{ localize('Delete Template') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Initialize Feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
@endsection
