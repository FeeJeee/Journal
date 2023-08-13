@extends('layouts.app')

@section('content')
    <div class=" d-flex justify-content-center m-3">
        <div class="card border" style="min-width: 25rem;">
            <div class="card-header bg-transparent border-bottom text-center">
                <h5>{{ $group->title }}</h5>
                <a class="link-underline-light" href="{{ route('journals.show',$group) }}">Journal</a>
            </div>
            <div class="card-body text-success">
                <div class="d-flex flex-column text-center">
                    <div class="">
                        <div class="text-center">
                            <div>
                                <a class="d-grid gap-2 btn btn-primary mb-2" href="{{ route('groups.edit', $group->id) }}" role="button">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
