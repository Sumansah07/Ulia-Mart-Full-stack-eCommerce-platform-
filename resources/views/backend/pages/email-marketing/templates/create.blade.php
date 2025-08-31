@extends('backend.layouts.master')

@section('title')
    {{ localize('Create Email Template') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Create Email Template') }}</h2>
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

            <div class="row g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form action="{{ route('admin.email-marketing.templates.store') }}" method="POST" class="pb-650">
                        @csrf
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Template Information') }}</h5>

                                <div class="mb-4">
                                    <label for="name" class="form-label">{{ localize('Template Name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control" 
                                           placeholder="{{ localize('Enter template name') }}" required>
                                </div>

                                <div class="mb-4">
                                    <label for="type" class="form-label">{{ localize('Template Type') }}</label>
                                    <select name="type" id="type" class="form-select" required>
                                        <option value="">{{ localize('Select template type') }}</option>
                                        <option value="marketing">{{ localize('Marketing') }}</option>
                                        <option value="promotional">{{ localize('Promotional') }}</option>
                                        <option value="announcement">{{ localize('Announcement') }}</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="subject" class="form-label">{{ localize('Email Subject') }}</label>
                                    <input type="text" name="subject" id="subject" class="form-control" 
                                           placeholder="{{ localize('Enter email subject') }}" required>
                                    <small class="text-muted">{{ localize('You can use variables like {{COMPANY_NAME}}, {{CUSTOMER_NAME}}, etc.') }}</small>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                                        <label class="form-check-label" for="is_active">
                                            {{ localize('Active Template') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4" id="section-2">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Email Content') }}</h5>
                                
                                <div class="mb-4">
                                    <label for="content" class="form-label">{{ localize('Email Body') }}</label>
                                    <textarea id="content" class="editor form-control" name="content" rows="15"></textarea>
                                    <small class="text-muted">{{ localize('Use HTML for rich formatting. Available variables are listed in the sidebar.') }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button class="btn btn-primary" type="submit">
                                <i data-feather="save" class="me-1"></i> {{ localize('Create Template') }}
                            </button>
                            <a href="{{ route('admin.email-marketing.templates.index') }}" class="btn btn-secondary ms-2">
                                {{ localize('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>

                <!--right sidebar-->
                <div class="col-xl-3 order-1 order-md-1 order-lg-1 order-xl-2">
                    <div class="card tt-sticky-sidebar">
                        <div class="card-body">
                            <h5 class="mb-4">{{ localize('Template Guide') }}</h5>
                            <div class="tt-vertical-step">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#section-1" class="active">{{ localize('Template Information') }}</a>
                                    </li>
                                    <li>
                                        <a href="#section-2">{{ localize('Email Content') }}</a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="mt-4">
                                <h6>{{ localize('Available Variables') }}</h6>
                                <div class="accordion" id="variablesAccordion">
                                    @foreach($availableVariables as $category => $variables)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" 
                                                        data-bs-toggle="collapse" 
                                                        data-bs-target="#collapse{{ ucfirst($category) }}">
                                                    {{ ucfirst($category) }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ ucfirst($category) }}" 
                                                 class="accordion-collapse collapse" 
                                                 data-bs-parent="#variablesAccordion">
                                                <div class="accordion-body">
                                                    @foreach($variables as $variable => $description)
                                                        <div class="mb-2">
                                                            <code class="variable-code" 
                                                                  style="cursor: pointer; font-size: 11px;"
                                                                  onclick="insertVariable('{{ $variable }}')"
                                                                  title="{{ localize('Click to insert') }}">{{ $variable }}</code>
                                                            <br>
                                                            <small class="text-muted">{{ $description }}</small>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-4">
                                <h6>{{ localize('Tips') }}</h6>
                                <ul class="list-unstyled small text-muted">
                                    <li>• {{ localize('Use descriptive template names') }}</li>
                                    <li>• {{ localize('Test your templates before using') }}</li>
                                    <li>• {{ localize('Keep content concise and engaging') }}</li>
                                    <li>• {{ localize('Use variables for personalization') }}</li>
                                </ul>
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
    function insertVariable(variable) {
        if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.content) {
            CKEDITOR.instances.content.insertText(variable);
        } else {
            const textarea = document.getElementById('content');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const text = textarea.value;
            textarea.value = text.substring(0, start) + variable + text.substring(end);
            textarea.selectionStart = textarea.selectionEnd = start + variable.length;
            textarea.focus();
        }
    }

    // Add click effect to variable codes
    document.addEventListener('DOMContentLoaded', function() {
        const variableCodes = document.querySelectorAll('.variable-code');
        variableCodes.forEach(code => {
            code.addEventListener('click', function() {
                // Visual feedback
                this.style.backgroundColor = '#28a745';
                this.style.color = 'white';
                setTimeout(() => {
                    this.style.backgroundColor = '';
                    this.style.color = '';
                }, 200);
            });
        });
    });
</script>
@endsection
