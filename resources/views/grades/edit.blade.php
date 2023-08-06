@extends('layouts.app')

@section('content')
    @include('grades.form', [
        'action' => route('users.subjects.update', compact('user', 'subject')),
        'method' => 'patch',
        'count_subject' => $subject
    ])
@endsection


