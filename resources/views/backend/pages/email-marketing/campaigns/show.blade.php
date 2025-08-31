@extends('backend.layouts.master')

@section('title')
    {{ $campaign->name }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
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
                                <h2 class="h5 mb-lg-0">{{ localize('Campaign Details') }}</h2>
                            </div>
                            <div class="tt-page-actions">
                                <a href="{{ route('admin.email-marketing.campaigns.index') }}" class="btn btn-outline-secondary me-2">
                                    <i data-feather="arrow-left" class="me-1"></i>{{ localize('Back to Campaigns') }}
                                </a>
                                <a href="{{ route('admin.email-marketing.campaigns.preview', $campaign) }}" 
                                   class="btn btn-outline-info me-2" target="_blank">
                                    <i data-feather="eye" class="me-1"></i>{{ localize('Preview') }}
                                </a>
                                @if($campaign->status === 'draft')
                                    <a href="{{ route('admin.email-marketing.campaigns.edit', $campaign) }}" class="btn btn-primary">
                                        <i data-feather="edit-3" class="me-1"></i>{{ localize('Edit Campaign') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ localize('Campaign Content') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Subject') }}</label>
                                <div class="p-3 bg-light rounded">
                                    {{ $campaign->subject }}
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Content') }}</label>
                                <div class="p-3 bg-light rounded" style="min-height: 300px;">
                                    {!! nl2br(e($campaign->content)) !!}
                                </div>
                            </div>

                            @if($campaign->template)
                                <div class="mb-3">
                                    <label class="form-label fw-bold">{{ localize('Template Used') }}</label>
                                    <div class="p-3 bg-light rounded">
                                        <a href="{{ route('admin.email-marketing.templates.show', $campaign->template) }}" 
                                           class="text-decoration-none">
                                            {{ $campaign->template->name }}
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($campaign->status === 'sent' && $campaign->send_statistics)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ localize('Sending Statistics') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <h3 class="text-primary">{{ $campaign->total_recipients ?? 0 }}</h3>
                                            <p class="text-muted mb-0">{{ localize('Total Recipients') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <h3 class="text-success">{{ $campaign->emails_sent ?? 0 }}</h3>
                                            <p class="text-muted mb-0">{{ localize('Emails Sent') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <h3 class="text-danger">{{ $campaign->emails_failed ?? 0 }}</h3>
                                            <p class="text-muted mb-0">{{ localize('Failed') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            @php
                                                $successRate = $campaign->total_recipients > 0 
                                                    ? round(($campaign->emails_sent / $campaign->total_recipients) * 100, 1) 
                                                    : 0;
                                            @endphp
                                            <h3 class="text-info">{{ $successRate }}%</h3>
                                            <p class="text-muted mb-0">{{ localize('Success Rate') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ localize('Campaign Information') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Name') }}</label>
                                <p class="mb-0">{{ $campaign->name }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Status') }}</label>
                                <p class="mb-0">
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
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Audience Type') }}</label>
                                <p class="mb-0">{{ ucfirst(str_replace('_', ' ', $campaign->audience_type)) }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Recipients') }}</label>
                                <p class="mb-0">{{ $recipientCount ?? $campaign->total_recipients ?? 0 }}</p>
                            </div>

                            @if($campaign->scheduled_at)
                                <div class="mb-3">
                                    <label class="form-label fw-bold">{{ localize('Scheduled At') }}</label>
                                    <p class="mb-0">{{ $campaign->scheduled_at->format('M d, Y \a\t g:i A') }}</p>
                                </div>
                            @endif

                            @if($campaign->sent_at)
                                <div class="mb-3">
                                    <label class="form-label fw-bold">{{ localize('Sent At') }}</label>
                                    <p class="mb-0">{{ $campaign->sent_at->format('M d, Y \a\t g:i A') }}</p>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Created By') }}</label>
                                <p class="mb-0">{{ $campaign->creator->name ?? localize('System') }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ localize('Created At') }}</label>
                                <p class="mb-0">{{ $campaign->created_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ localize('Actions') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                @if($campaign->status === 'draft')
                                    <a href="{{ route('admin.email-marketing.campaigns.edit', $campaign) }}" 
                                       class="btn btn-primary">
                                        <i data-feather="edit-3" class="me-2"></i>{{ localize('Edit Campaign') }}
                                    </a>
                                    
                                    <form action="{{ route('admin.email-marketing.campaigns.send', $campaign) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('{{ localize('Are you sure you want to send this campaign?') }}')">
                                        @csrf
                                        <button type="submit" class="btn btn-success w-100">
                                            <i data-feather="send" class="me-2"></i>{{ localize('Send Campaign') }}
                                        </button>
                                    </form>
                                @endif
                                
                                <a href="{{ route('admin.email-marketing.campaigns.preview', $campaign) }}" 
                                   class="btn btn-outline-info" target="_blank">
                                    <i data-feather="eye" class="me-2"></i>{{ localize('Preview Campaign') }}
                                </a>

                                <form action="{{ route('admin.email-marketing.campaigns.duplicate', $campaign) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary w-100">
                                        <i data-feather="copy" class="me-2"></i>{{ localize('Duplicate Campaign') }}
                                    </button>
                                </form>

                                @if($campaign->status === 'draft')
                                    <form action="{{ route('admin.email-marketing.campaigns.destroy', $campaign) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('{{ localize('Are you sure you want to delete this campaign?') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i data-feather="trash-2" class="me-2"></i>{{ localize('Delete Campaign') }}
                                        </button>
                                    </form>
                                @endif
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
