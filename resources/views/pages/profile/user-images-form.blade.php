@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">{{ __('Add Images') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('add.images.post') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="user_images"
                                       class="col-md-5 col-form-label text-md-right">{{ __('Upload Images') }}</label>

                                <div class="col-md-6">
                                    <input id="user_images" type="file"
                                           class="form-control-file @error('user_images.*') is-invalid @enderror"
                                           name="user_images[]" multiple>

                                    @error('user_images.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save Changes') }}
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
