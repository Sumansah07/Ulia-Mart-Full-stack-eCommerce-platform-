@extends('backend.layouts.master')

@section('title')
    {{ localize('Email Templates') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
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
                                <h2 class="h5 mb-lg-0">{{ localize('Email Templates') }}</h2>
                            </div>
                            <!-- <div class="tt-page-actions">
                                <a href="{{ route('admin.email-marketing.templates.create-defaults') }}"
                                   class="btn btn-outline-secondary me-2"
                                   onclick="return confirm('{{ localize('This will create default email templates. Continue?') }}')">
                                    <i data-feather="download" class="me-1"></i>{{ localize('Create Defaults') }}
                                </a>
                                <a href="{{ route('admin.email-marketing.templates.create') }}" class="btn btn-primary">
                                    <i data-feather="plus" class="me-1"></i>{{ localize('Add Template') }}
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Filters -->
                            <form method="GET" class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control"
                                           placeholder="{{ localize('Search templates...') }}"
                                           value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <select name="type" class="form-select">
                                        <option value="">{{ localize('All Types') }}</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                                {{ ucfirst($type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="status" class="form-select">
                                        <option value="">{{ localize('All Status') }}</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                            {{ localize('Active') }}
                                        </option>
                                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                            {{ localize('Inactive') }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-secondary">
                                        <i data-feather="search" class="me-1"></i>{{ localize('Filter') }}
                                    </button>
                                </div>
                                <div class="col-md-3 text-end">
                                    <a href="{{ route('admin.email-marketing.templates.index') }}" class="btn btn-outline-secondary">
                                        {{ localize('Clear Filters') }}
                                    </a>
                                </div>
                            </form>

                            <!-- Templates Table -->
                            <div class="table-responsive" style="min-height: 440px;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ localize('Name') }}</th>
                                            <th>{{ localize('Subject') }}</th>
                                            <th>{{ localize('Type') }}</th>
                                            <th>{{ localize('Status') }}</th>
                                            <th>{{ localize('Created By') }}</th>
                                            <th>{{ localize('Created At') }}</th>
                                            <th class="text-end">{{ localize('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($templates as $template)
                                            <tr>
                                                <td>
                                                    <strong>{{ $template->name }}</strong>
                                                </td>
                                                <td>{{ Str::limit($template->subject, 50) }}</td>
                                                <td>
                                                    <span class="badge bg-info">{{ ucfirst($template->type) }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $template->is_active ? 'success' : 'secondary' }}">
                                                        {{ $template->is_active ? localize('Active') : localize('Inactive') }}
                                                    </span>
                                                </td>
                                                <td>{{ $template->creator->name ?? localize('System') }}</td>
                                                <td>{{ $template->created_at->format('M d, Y') }}</td>
                                                <td class="text-end">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle"
                                                                type="button" data-bs-toggle="dropdown">
                                                            {{ localize('Actions') }}
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{ route('admin.email-marketing.templates.show', $template) }}">
                                                                    <i data-feather="eye" class="me-2"></i>{{ localize('View') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{ route('admin.email-marketing.templates.preview', $template) }}"
                                                                   target="_blank">
                                                                    <i data-feather="monitor" class="me-2"></i>{{ localize('Preview') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{ route('admin.email-marketing.templates.edit', $template) }}">
                                                                    <i data-feather="edit" class="me-2"></i>{{ localize('Edit') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form method="POST"
                                                                      action="{{ route('admin.email-marketing.templates.duplicate', $template) }}"
                                                                      class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i data-feather="copy" class="me-2"></i>{{ localize('Duplicate') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <form method="POST"
                                                                      action="{{ route('admin.email-marketing.templates.toggle-status', $template) }}"
                                                                      class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i data-feather="{{ $template->is_active ? 'eye-off' : 'eye' }}" class="me-2"></i>
                                                                        {{ $template->is_active ? localize('Deactivate') : localize('Activate') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form method="POST"
                                                                      action="{{ route('admin.email-marketing.templates.destroy', $template) }}"
                                                                      class="d-inline"
                                                                      onsubmit="return confirm('{{ localize('Are you sure you want to delete this template?') }}')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger">
                                                                        <i data-feather="trash" class="me-2"></i>{{ localize('Delete') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i data-feather="inbox" class="mb-2" style="width: 48px; height: 48px;"></i>
                                                        <p>{{ localize('No email templates found') }}</p>
                                                        <a href="{{ route('admin.email-marketing.templates.create') }}" class="btn btn-primary">
                                                            {{ localize('Create Your First Template') }}
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            @if($templates->hasPages())
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $templates->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
