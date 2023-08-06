@extends('layouts.app')

@section('content')
    @include('users.form', [
        'action' => route('users.store'),
        'method' => 'post',
    ])
@endsection

