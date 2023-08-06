@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-center" >
        <table class="table text-center" style="max-width: 30rem;">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope>Birthdate</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td><a href="{{ route('users.show',$user->id) }}">{{ $user->name }}</td>
                    <td>{{ $user->birthdate }}</td>
                    <td>
                        <div class="">
                            <a href="{{ route('users.edit', $user->id) }}">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary mb-2">
                                        UPDATE
                                    </button>
                                </div>
                            </a>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">
                                DELETE
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center">
        <div class="d-grid gap-2 ">
            <a class="" aria-current="page" href="{{ route('users.create') }}">
                New User
            </a>
        </div>

        <div class="m-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
