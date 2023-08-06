@extends('layouts.app')

@section('content')
    @include('subjects.form', [
        'action' => route('subjects.update', $subject->id),
        'method' => 'patch'
    ])

@endsection


