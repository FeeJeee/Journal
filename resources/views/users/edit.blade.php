@extends('layouts.app')

@section('content')
    @include('users.form', [
        'action' => route('users.update', compact('user')),
        'method' => 'patch',
    ])
@endsection


