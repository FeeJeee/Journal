@extends('layouts.app')

@section('content')
    @include('includes.filter',[
        'action' => route('users.index'),
        'method' => 'get',
    ])

    <div class="d-flex justify-content-center">
        <div class="card text-center" style="width: 40rem; height: 33rem;">
            <div class="card-header">
                <div class="d-flex justify-content-between my-1">
                    <h5 class="ms-5 pt-1 ">Users</h5>
                    <a class=" btn btn-primary me-5" aria-current="page" href="{{ route('users.create') }}">New User</a>
                </div>
            </div>
            <div class="card-body">
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
                                <td><a class="link-underline-light" href="{{ route('users.show',$user->id) }}">{{ $user->fullName }}</td>
                                <td>{{ $user->birthdate }}</td>
                                <td>
                                    <div class="">
                                        <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">Update</a>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            DELETE
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-muted" style="height: 4rem;">
                <div class="d-flex justify-content-center pt-1">
                    <div class="d-flex flex-column">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
