@extends('layouts.app')

@section('content')
    @include('grades.form', [
        'action' => route('users.subjects.store', $user),
        'method' => 'post'
    ])
@endsection
