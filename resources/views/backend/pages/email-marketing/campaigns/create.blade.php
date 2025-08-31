@extends('backend.layouts.master')

@section('title')
    {{ localize('Create Email Campaign') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Create Email Campaign') }}</h2>
                            </div>
                            <div class="tt-page-actions">
                                <a href="{{ route('admin.email-marketing.campaigns.index') }}" class="btn btn-outline-primary">
                                    <i data-feather="arrow-left" class="me-1"></i>{{ localize('Back to Campaigns') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <form action="{{ route('admin.email-marketing.campaigns.store') }}" method="POST">
                        @csrf

                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ localize('Campaign Information') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ localize('Campaign Name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="subject" class="form-label">{{ localize('Email Subject') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="subject" name="subject"
                                           value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="template_id" class="form-label">{{ localize('Email Template') }}</label>
                                    <select class="form-select" id="template_id" name="template_id">
                                        <option value="">{{ localize('Select Template (Optional)') }}</option>
                                        @foreach($templates as $template)
                                            <option value="{{ $template->id }}" {{ old('template_id') == $template->id ? 'selected' : '' }}>
                                                {{ $template->name }} ({{ ucfirst($template->type) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('template_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">{{ localize('Email Content') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="content" name="content" rows="15" required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ localize('Audience Selection') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="audience_type" class="form-label">{{ localize('Audience Type') }} <span class="text-danger">*</span></label>
                                    <select class="form-select" id="audience_type" name="audience_type" required>
                                        <option value="">{{ localize('Select Audience') }}</option>
                                        <option value="all_subscribers" {{ old('audience_type') == 'all_subscribers' ? 'selected' : '' }}>
                                            {{ localize('All Subscribers') }} ({{ $audienceStats['subscribers'] ?? 0 }})
                                        </option>
                                        <option value="customers_only" {{ old('audience_type') == 'customers_only' ? 'selected' : '' }}>
                                            {{ localize('Customers Only') }} ({{ $audienceStats['customers'] ?? 0 }})
                                        </option>
                                        <option value="customers_with_orders" {{ old('audience_type') == 'customers_with_orders' ? 'selected' : '' }}>
                                            {{ localize('Customers with Orders') }} ({{ $audienceStats['customers_with_orders'] ?? 0 }})
                                        </option>
                                    </select>
                                    @error('audience_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div id="audience-count" class="alert alert-info" style="display: none;">
                                    <strong>{{ localize('Estimated Recipients') }}:</strong> <span id="recipient-count">0</span>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ localize('Scheduling') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="send_option" id="send_now" value="now" checked>
                                        <label class="form-check-label" for="send_now">
                                            {{ localize('Send Now') }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="send_option" id="schedule_later" value="schedule">
                                        <label class="form-check-label" for="schedule_later">
                                            {{ localize('Schedule for Later') }}
                                        </label>
                                    </div>
                                </div>

                                <div id="schedule-fields" style="display: none;">
                                    <div class="mb-3">
                                        <label for="scheduled_at" class="form-label">{{ localize('Schedule Date & Time') }}</label>
                                        <input type="datetime-local" class="form-control" id="scheduled_at" name="scheduled_at"
                                               value="{{ old('scheduled_at') }}" min="{{ date('Y-m-d\TH:i') }}">
                                        @error('scheduled_at')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.email-marketing.campaigns.index') }}" class="btn btn-outline-secondary">
                                        {{ localize('Cancel') }}
                                    </a>
                                    <div>
                                        <button type="submit" name="action" value="draft" class="btn btn-outline-primary me-2">
                                            <i data-feather="save" class="me-1"></i>{{ localize('Save as Draft') }}
                                        </button>
                                        <button type="submit" name="action" value="send" class="btn btn-primary">
                                            <i data-feather="send" class="me-1"></i>{{ localize('Create & Send') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ localize('Audience Statistics') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>{{ localize('Total Subscribers') }}:</span>
                                    <strong>{{ $audienceStats['subscribers'] ?? 0 }}</strong>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>{{ localize('Total Customers') }}:</span>
                                    <strong>{{ $audienceStats['customers'] ?? 0 }}</strong>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>{{ localize('Customers with Orders') }}:</span>
                                    <strong>{{ $audienceStats['customers_with_orders'] ?? 0 }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ localize('Tips') }}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i data-feather="check-circle" class="text-success me-2" style="width: 16px; height: 16px;"></i>
                                    {{ localize('Use a clear and compelling subject line') }}
                                </li>
                                <li class="mb-2">
                                    <i data-feather="check-circle" class="text-success me-2" style="width: 16px; height: 16px;"></i>
                                    {{ localize('Keep your content concise and engaging') }}
                                </li>
                                <li class="mb-2">
                                    <i data-feather="check-circle" class="text-success me-2" style="width: 16px; height: 16px;"></i>
                                    {{ localize('Include a clear call-to-action') }}
                                </li>
                                <li class="mb-0">
                                    <i data-feather="check-circle" class="text-success me-2" style="width: 16px; height: 16px;"></i>
                                    {{ localize('Test with a small group first') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle schedule option toggle
            const sendNow = document.getElementById('send_now');
            const scheduleLater = document.getElementById('schedule_later');
            const scheduleFields = document.getElementById('schedule-fields');

            function toggleScheduleFields() {
                if (scheduleLater.checked) {
                    scheduleFields.style.display = 'block';
                } else {
                    scheduleFields.style.display = 'none';
                }
            }

            sendNow.addEventListener('change', toggleScheduleFields);
            scheduleLater.addEventListener('change', toggleScheduleFields);

            // Handle audience type change
            const audienceType = document.getElementById('audience_type');
            const audienceCount = document.getElementById('audience-count');
            const recipientCount = document.getElementById('recipient-count');

            audienceType.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    const count = selectedOption.text.match(/\((\d+)\)/);
                    if (count) {
                        recipientCount.textContent = count[1];
                        audienceCount.style.display = 'block';
                    }
                } else {
                    audienceCount.style.display = 'none';
                }
            });

            // Initialize Feather icons
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
@endsection
