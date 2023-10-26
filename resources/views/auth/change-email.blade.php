@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Change Email Address') }}</div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('change.email.post') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email_verification_code"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Verification Code') }}</label>

                                <div class="col-md-6">
                                    <input id="email_verification_code" type="number"
                                           class="form-control @error('email_verification_code') is-invalid @enderror"
                                           name="email_verification_code" required minlength="4" maxlength="4"
                                           max="9999">

                                    @error('email_verification_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('New Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="new_email" type="email"
                                           class="form-control @error('new_email') is-invalid @enderror"
                                           name="new_email" value="{{ old('new_email') }}" required
                                           autocomplete="new_email" autofocus>

                                    @error('new_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Change Email') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
