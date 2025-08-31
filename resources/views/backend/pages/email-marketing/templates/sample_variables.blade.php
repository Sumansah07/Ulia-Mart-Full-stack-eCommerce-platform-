@extends('backend.layouts.master')

@section('title')
    {{ localize('Edit Variables Values') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0">{{ localize('Edit Variables Values') }}</h2>
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
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ localize('Sample Variables for Email Template Preview') }}</h5>
                            <p class="text-muted mb-0">{{ localize('These values will be used when previewing email templates') }}</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.email-marketing.templates.sample-variables.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    @foreach($sampleVariables as $key => $value)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{{ $key }}</label>
                                            <input type="text" class="form-control" name="variables[{{ trim($key, '{}') }}]" value="{{ $value }}" placeholder="{{ localize('Enter value for') }} {{ $key }}">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i data-feather="save" class="me-1"></i>{{ localize('Save Changes') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection