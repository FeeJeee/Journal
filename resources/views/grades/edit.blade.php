@extends('layouts.app')

@section('content')
    @include('grades.form', [
        'action' => route('users.subjects.update', compact('user', 'subject')),
        'method' => 'patch',
        'current_subject' => $subject
    ])
@endsection
