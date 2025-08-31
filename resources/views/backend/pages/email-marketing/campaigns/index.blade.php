@extends('backend.layouts.master')

@section('title')
    {{ localize('Email Campaigns') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
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
                                <h2 class="h5 mb-lg-0">{{ localize('Email Campaigns') }}</h2>
                            </div>
                            <div class="tt-page-actions">
                                <a href="{{ route('admin.email-marketing.campaigns.create') }}" class="btn btn-primary">
                                    <i data-feather="plus" class="me-1"></i>{{ localize('Create Campaign') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Filters -->
                            <form action="{{ route('admin.email-marketing.campaigns.index') }}" method="GET" class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" 
                                           value="{{ request('search') }}" 
                                           placeholder="{{ localize('Search campaigns...') }}">
                                </div>
                                
                                <div class="col-md-3">
                                    <select class="form-select" name="status">
                                        <option value="">{{ localize('All Status') }}</option>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <select class="form-select" name="audience_type">
                                        <option value="">{{ localize('All Audience Types') }}</option>
                                        @foreach($audienceTypes as $type)
                                            <option value="{{ $type }}" {{ request('audience_type') == $type ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' ', $type)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i data-feather="search"></i>{{ localize('Filter') }}
                                        </button>
                                        <a href="{{ route('admin.email-marketing.campaigns.index') }}" class="btn btn-outline-secondary">
                                            {{ localize('Clear Filters') }}
                                        </a>
                                    </div>
                                </div>
                            </form>

                            <!-- Campaigns Table -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ localize('Name') }}</th>
                                            <th>{{ localize('Subject') }}</th>
                                            <th>{{ localize('Status') }}</th>
                                            <th>{{ localize('Audience') }}</th>
                                            <th>{{ localize('Recipients') }}</th>
                                            <th>{{ localize('Sent') }}</th>
                                            <th>{{ localize('Created At') }}</th>
                                            <th class="text-end">{{ localize('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($campaigns as $campaign)
                                            <tr>
                                                <td>
                                                    <strong>{{ $campaign->name }}</strong>
                                                </td>
                                                <td>{{ Str::limit($campaign->subject, 40) }}</td>
                                                <td>
                                                    @php
                                                        $statusColors = [
                                                            'draft' => 'secondary',
                                                            'scheduled' => 'warning',
                                                            'sending' => 'info',
                                                            'sent' => 'success',
                                                            'failed' => 'danger'
                                                        ];
                                                    @endphp
                                                    <span class="badge bg-{{ $statusColors[$campaign->status] ?? 'secondary' }}">
                                                        {{ ucfirst($campaign->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ ucfirst(str_replace('_', ' ', $campaign->audience_type)) }}</td>
                                                <td>{{ $campaign->total_recipients ?? 0 }}</td>
                                                <td>{{ $campaign->emails_sent ?? 0 }}</td>
                                                <td>{{ $campaign->created_at->format('M d, Y') }}</td>
                                                <td class="text-end">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" 
                                                                type="button" data-bs-toggle="dropdown">
                                                            {{ localize('Actions') }}
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" 
                                                                   href="{{ route('admin.email-marketing.campaigns.show', $campaign) }}">
                                                                    <i data-feather="eye" class="me-2"></i>{{ localize('View') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" 
                                                                   href="{{ route('admin.email-marketing.campaigns.preview', $campaign) }}" 
                                                                   target="_blank">
                                                                    <i data-feather="monitor" class="me-2"></i>{{ localize('Preview') }}
                                                                </a>
                                                            </li>
                                                            @if($campaign->status === 'draft')
                                                                <li>
                                                                    <a class="dropdown-item" 
                                                                       href="{{ route('admin.email-marketing.campaigns.edit', $campaign) }}">
                                                                        <i data-feather="edit-3" class="me-2"></i>{{ localize('Edit') }}
                                                                    </a>
                                                                </li>
                                                                <li><hr class="dropdown-divider"></li>
                                                                <li>
                                                                    <form action="{{ route('admin.email-marketing.campaigns.send', $campaign) }}" 
                                                                          method="POST" class="d-inline"
                                                                          onsubmit="return confirm('{{ localize('Are you sure you want to send this campaign?') }}')">
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item text-success">
                                                                            <i data-feather="send" class="me-2"></i>{{ localize('Send Now') }}
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @endif
                                                            <li>
                                                                <form action="{{ route('admin.email-marketing.campaigns.duplicate', $campaign) }}" 
                                                                      method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i data-feather="copy" class="me-2"></i>{{ localize('Duplicate') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            @if($campaign->status === 'draft')
                                                                <li><hr class="dropdown-divider"></li>
                                                                <li>
                                                                    <form action="{{ route('admin.email-marketing.campaigns.destroy', $campaign) }}" 
                                                                          method="POST" class="d-inline"
                                                                          onsubmit="return confirm('{{ localize('Are you sure you want to delete this campaign?') }}')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item text-danger">
                                                                            <i data-feather="trash-2" class="me-2"></i>{{ localize('Delete') }}
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <i data-feather="mail" class="mb-3" style="width: 48px; height: 48px; opacity: 0.3;"></i>
                                                        <h5 class="text-muted">{{ localize('No campaigns found') }}</h5>
                                                        <p class="text-muted mb-3">{{ localize('Create your first email campaign to get started') }}</p>
                                                        <a href="{{ route('admin.email-marketing.campaigns.create') }}" class="btn btn-primary">
                                                            {{ localize('Create Your First Campaign') }}
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            @if($campaigns->hasPages())
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $campaigns->links() }}
                                </div>
                            @endif
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
