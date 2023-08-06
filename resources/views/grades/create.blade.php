@extends('layouts.app')

@section('content')
    @include('grades.form', [
        'action' => route('users.subjects.store', compact('user')),
        'method' => 'post'
    ])
@endsection

