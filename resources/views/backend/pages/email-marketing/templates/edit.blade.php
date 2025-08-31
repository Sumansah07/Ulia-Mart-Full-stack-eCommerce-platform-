@extends('backend.layouts.master')

@section('title')
    {{ localize('Edit Email Template') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Edit Email Template') }}</h2>
                            </div>
                            <div class="tt-page-actions">
                                <a href="{{ route('admin.email-marketing.templates.index') }}" class="btn btn-outline-primary">
                                    <i data-feather="arrow-left" class="me-1"></i>{{ localize('Back to Templates') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <form action="{{ route('admin.email-marketing.templates.update', $template) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ localize('Template Information') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ localize('Template Name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name', $template->name) }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="subject" class="form-label">{{ localize('Email Subject') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="subject" name="subject" 
                                           value="{{ old('subject', $template->subject) }}" required>
                                    @error('subject')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">{{ localize('Template Type') }} <span class="text-danger">*</span></label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="">{{ localize('Select Type') }}</option>
                                        <option value="marketing" {{ old('type', $template->type) == 'marketing' ? 'selected' : '' }}>
                                            {{ localize('Marketing') }}
                                        </option>
                                        <option value="promotional" {{ old('type', $template->type) == 'promotional' ? 'selected' : '' }}>
                                            {{ localize('Promotional') }}
                                        </option>
                                        <option value="announcement" {{ old('type', $template->type) == 'announcement' ? 'selected' : '' }}>
                                            {{ localize('Announcement') }}
                                        </option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">{{ localize('Email Content') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="content" name="content" rows="15" required>{{ old('content', $template->content) }}</textarea>
                                    @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                               {{ old('is_active', $template->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            {{ localize('Active') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.email-marketing.templates.show', $template) }}" class="btn btn-outline-secondary">
                                        {{ localize('Cancel') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i data-feather="save" class="me-1"></i>{{ localize('Update Template') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ localize('Available Variables') }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-3">{{ localize('Click on any variable to copy it to clipboard') }}</p>
                            
                            @foreach($availableVariables as $category => $variables)
                                <div class="mb-3">
                                    <h6 class="text-capitalize">{{ localize(ucfirst($category)) }}</h6>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($variables as $variable => $description)
                                            <span class="badge bg-light text-dark border variable-badge" 
                                                  style="cursor: pointer;" 
                                                  onclick="copyToClipboard('{{ $variable }}')"
                                                  title="{{ $description }}">
                                                {{ $variable }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ localize('Actions') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.email-marketing.templates.preview', $template) }}" 
                                   class="btn btn-outline-info" target="_blank">
                                    <i data-feather="eye" class="me-2"></i>{{ localize('Preview Template') }}
                                </a>
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
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show success message
                const toast = document.createElement('div');
                toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed';
                toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999;';
                toast.innerHTML = `
                    <div class="d-flex">
                        <div class="toast-body">
                            Variable copied to clipboard!
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="this.parentElement.parentElement.remove()"></button>
                    </div>
                `;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
            });
        }

        // Initialize Feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
@endsection
