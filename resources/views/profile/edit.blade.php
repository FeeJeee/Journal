@extends('layouts.app')
@section('content')
    <div class="card" style="width: 40rem;">
        <div class="card-body">
            <div class="d-flex justify-content-center mb-3">
                @inject('fileService', 'App\Services\FileService')
                <img src="{{ $fileService->userAvatar($user, 320, 320) }}"/>
            </div>

            <div class="card p-3">
                <div class="">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card mt-3 p-3">
                <div class="">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card mt-3 p-3">
                <div class="">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
