@extends('layouts.app')
@section('content')
    <div class=" d-flex justify-content-center m-3">
        <div class="card border" style="min-width: 25rem;">
            <div class="card-header bg-transparent border-bottom text-center"><h5>{{ $group->title }}</h5></div>
            <div class="card-body text-success">
                <a href="{{ route('journals.show', $group->id) }}">Journal</a>
                <div class="d-flex flex-column text-center">
                    <div class="">
                        <div class="text-center">
                            <div>
                                <a href="{{ route('groups.edit', $group->id) }}">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary mb-2">
                                            UPDATE
                                        </button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
