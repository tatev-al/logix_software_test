@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Profile</h1>
        @if($user)
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Surname:</strong> {{ $user->last_name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                </div>
                @if(substr(url()->current(), 37) == Auth::user()->id)
                    <div class="col-md-6 text-right">
                        <a href="{{ route('change.email', Auth::user()->id) }}" class="btn btn-primary">Change Email</a>
                    </div>
                @endif
            </div>
            @if(substr(url()->current(), 37) == Auth::user()->id)
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 mt-5">
                            <div class="card">
                                <div class="card-header">{{ __('Images') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('add.images.form') }}">
                                        @csrf
                                    </form>
                                </div>

                                <div class="image-container" style="display: flex;flex-wrap: wrap;margin-left: 35px; margin-right: 35px">
                                    @foreach(Auth::user()->userImages as $userImage)
                                        @if(isset($userImage->image))
                                            <img src="{{ asset('storage/' . $userImage->image) }}" alt="User Image"
                                                 style="max-width: 200px;max-height: 200px;height: auto;margin: 5px;">
                                        @else
                                            <p class="col-md-12 text-center m-3">No images loaded</p>
                                            @break
                                        @endif
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center m-3">
                                        <a href="{{ route('add.images.form', Auth::user()->id) }}"
                                           class="btn btn-primary">Add More Images</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection
