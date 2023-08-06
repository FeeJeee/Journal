@extends('layouts.app')

@section('content')
    @include('subjects.form', [
        'action' => route('subjects.store'),
        'method' => 'post'
    ])
@endsection

