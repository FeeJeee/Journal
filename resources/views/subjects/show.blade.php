@extends('layouts.app')

@section('content')
    <div class=" d-flex justify-content-center m-3">
        <div class="card border" style="min-width: 25rem;">
            <div class="card-header bg-transparent border-bottom text-center"><h5>{{ $subject->title }}</h5></div>
            <div class="card-body">
                <div class="d-flex flex-column text-center">
                    <div class="">
                        <div class="">
                            <a class="d-grid gap-2 btn btn-primary mb-2" href="{{ route('subjects.edit', $subject->id) }}">Update</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
