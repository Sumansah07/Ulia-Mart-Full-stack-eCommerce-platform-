@extends('backend.layouts.master')

@section('title')
    {{ localize('Send Bulk Emails') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Quick Send Emails') }}</h2>
                            </div>
                            <div class="tt-page-actions">
                                <a href="{{ route('admin.email-marketing.templates.index') }}" class="btn btn-outline-primary me-2">
                                    <i data-feather="layout" class="me-1"></i>{{ localize('Email Templates') }}
                                </a>
                                <a href="{{ route('admin.email-marketing.campaigns.index') }}" class="btn btn-primary">
                                    <i data-feather="send" class="me-1"></i>{{ localize('Email Campaigns') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form action="{{ route('admin.newsletters.send') }}" method="POST" enctype="multipart/form-data"
                        class="pb-650">
                        @csrf
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Basic Information') }}</h5>

                                <!-- Template Selection -->
                                @if($templates->count() > 0)
                                <div class="mb-4">
                                    <label for="template_id" class="form-label">{{ localize('Use Email Template') }} <small class="text-muted">({{ localize('Optional') }})</small></label>
                                    <select class="form-select form-control select2" name="template_id" id="template_id">
                                        <option value="">{{ localize('Select a template or write custom content') }}</option>
                                        @foreach ($templates as $template)
                                            <option value="{{ $template->id }}" data-subject="{{ $template->subject }}" data-content="{{ htmlspecialchars($template->content) }}">
                                                {{ $template->name }} ({{ ucfirst($template->type) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">{{ localize('Selecting a template will populate the subject and content fields') }}</small>
                                </div>
                                @endif

                                <!-- Audience Selection -->
                                <div class="mb-4">
                                    <label class="form-label">{{ localize('Select Audience') }}</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card border">
                                                <div class="card-body text-center">
                                                    <h6 class="card-title">{{ localize('Newsletter Subscribers') }}</h6>
                                                    <p class="text-muted mb-2">{{ $subscribers->count() }} {{ localize('subscribers') }}</p>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="select_all_subscribers">
                                                        <label class="form-check-label" for="select_all_subscribers">
                                                            {{ localize('Select All') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border">
                                                <div class="card-body text-center">
                                                    <h6 class="card-title">{{ localize('All Customers') }}</h6>
                                                    <p class="text-muted mb-2">{{ $users->count() }} {{ localize('customers') }}</p>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="select_all_users">
                                                        <label class="form-check-label" for="select_all_users">
                                                            {{ localize('Select All') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border">
                                                <div class="card-body text-center">
                                                    <h6 class="card-title">{{ localize('Customers with Orders') }}</h6>
                                                    <p class="text-muted mb-2">{{ $customersWithOrders->count() }} {{ localize('customers') }}</p>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="select_all_customers">
                                                        <label class="form-check-label" for="select_all_customers">
                                                            {{ localize('Select All') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden select fields for different audiences -->
                                <div class="mb-4" id="subscriber_section" style="display: none;">
                                    <label for="subscriber_emails" class="form-label">{{ localize('Newsletter Subscribers') }}</label>
                                    <select class="form-select form-control select2"
                                        data-placeholder="{{ localize('Select Subscribers') }}" data-toggle="select2"
                                        name="subscriber_emails[]" multiple id="subscriber_emails">
                                        @foreach ($subscribers as $subscriber)
                                            @if ($subscriber->email)
                                                <option value="{{ $subscriber->email }}">
                                                    {{ $subscriber->email }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4" id="user_section" style="display: none;">
                                    <label for="user_emails" class="form-label">{{ localize('All Customers') }}</label>
                                    <select class="form-select form-control select2"
                                        data-placeholder="{{ localize('Select Customers') }}" data-toggle="select2"
                                        name="user_emails[]" multiple id="user_emails">
                                        @foreach ($users as $user)
                                            @if ($user->email)
                                                <option value="{{ $user->email }}">
                                                    {{ $user->name }} ({{ $user->email }})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4" id="customer_section" style="display: none;">
                                    <label for="customer_emails" class="form-label">{{ localize('Customers with Orders') }}</label>
                                    <select class="form-select form-control select2"
                                        data-placeholder="{{ localize('Select Customers') }}" data-toggle="select2"
                                        name="customer_emails[]" multiple id="customer_emails">
                                        @foreach ($customersWithOrders as $customer)
                                            @if ($customer->email)
                                                <option value="{{ $customer->email }}">
                                                    {{ $customer->name }} ({{ $customer->email }})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="subject" class="form-label">{{ localize('Email Subject') }}</label>
                                    <input type="text" name="subject" id="subject" class="form-control" required>
                                </div>

                                <div class="mb-4">
                                    <label for="content" class="form-label">{{ localize('Email Body') }}</label>
                                    <textarea id="content" class="editor form-control" name="content"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button class="btn btn-primary" type="submit">
                                <i data-feather="save" class="me-1"></i> {{ localize('Send Emails') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!--right sidebar-->
                <div class="col-xl-3 order-1 order-md-1 order-lg-1 order-xl-2">
                    <div class="card tt-sticky-sidebar d-none d-xl-block">
                        <div class="card-body">
                            <h5 class="mb-4">{{ localize('Quick Send Emails') }}</h5>
                            <div class="tt-vertical-step">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#section-1" class="active">{{ localize('Basic Information') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-4">
                                <h6>{{ localize('Quick Stats') }}</h6>
                                <ul class="list-unstyled small">
                                    <li>{{ localize('Subscribers') }}: {{ $subscribers->count() }}</li>
                                    <li>{{ localize('All Customers') }}: {{ $users->count() }}</li>
                                    <li>{{ localize('Customers with Orders') }}: {{ $customersWithOrders->count() }}</li>
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
    $(document).ready(function() {
        // Handle template selection
        $('#template_id').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            if (selectedOption.val()) {
                var subject = selectedOption.data('subject');
                var content = selectedOption.data('content');

                $('#subject').val(subject);
                if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.content) {
                    CKEDITOR.instances.content.setData(content);
                } else {
                    $('#content').val(content);
                }
            }
        });

        // Handle audience selection checkboxes
        $('#select_all_subscribers').on('change', function() {
            if ($(this).is(':checked')) {
                $('#subscriber_section').show();
                $('#subscriber_emails option').prop('selected', true);
                $('#subscriber_emails').trigger('change');
            } else {
                $('#subscriber_section').hide();
                $('#subscriber_emails option').prop('selected', false);
                $('#subscriber_emails').trigger('change');
            }
        });

        $('#select_all_users').on('change', function() {
            if ($(this).is(':checked')) {
                $('#user_section').show();
                $('#user_emails option').prop('selected', true);
                $('#user_emails').trigger('change');
            } else {
                $('#user_section').hide();
                $('#user_emails option').prop('selected', false);
                $('#user_emails').trigger('change');
            }
        });

        $('#select_all_customers').on('change', function() {
            if ($(this).is(':checked')) {
                $('#customer_section').show();
                $('#customer_emails option').prop('selected', true);
                $('#customer_emails').trigger('change');
            } else {
                $('#customer_section').hide();
                $('#customer_emails option').prop('selected', false);
                $('#customer_emails').trigger('change');
            }
        });

        // Form validation
        $('form').on('submit', function(e) {
            var hasSubscribers = $('#subscriber_emails').val() && $('#subscriber_emails').val().length > 0;
            var hasUsers = $('#user_emails').val() && $('#user_emails').val().length > 0;
            var hasCustomers = $('#customer_emails').val() && $('#customer_emails').val().length > 0;

            if (!hasSubscribers && !hasUsers && !hasCustomers) {
                e.preventDefault();
                alert('{{ localize("Please select at least one audience group") }}');
                return false;
            }
        });
    });
</script>
@endsection
