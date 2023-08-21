@extends('layouts.app')

@section('content')
    @include('includes.filter',[
        'action' => route('users.index'),
        'method' => 'get',
    ])

    <div class="d-flex justify-content-center">
        <div class="card text-center" style="min-width: 50rem; min-height: 34rem;">
            <div class="card-header" style="height: 4rem">
                <div class="d-flex justify-content-between my-1">
                    <h5 class="ms-5 pt-1 ">Users</h5>
                    @can('create', App\Models\User::class)
                        <div>
                            <a class=" btn btn-primary me-2" aria-current="page" href="{{ route('users.create') }}">New User</a>
                        </div>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center" >
                    <table class="table text-center" >
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">avatar</th>
                            <th scope="col">Name</th>
                            <th scope="col">Birthdate</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>
                                    @inject('fileService', 'App\Services\FileService')
                                    <img src="{{ $fileService->userAvatar($user, 50, 50) }}"/>
                                </td>
                                <td><a class="link-underline-light" href="{{ route('users.show',$user->id) }}">{{ $user->fullName }}</td>
                                <td>{{ $user->birthdate }}</td>
                                <td>
                                    @can('edit', $user)
                                        <div class="">
                                            <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user) }}">Update</a>
                                        </div>
                                    @endcan
                                </td>

                                <td>
                                    @can('create', App\Models\User::class)
                                        <div>
                                            <a class=" btn btn-primary btn-sm" aria-current="page" href="{{ route('users.pdf', $user) }}">Export to PDF</a>
                                        </div>
                                    @endcan
                                </td>
                                @if(!($user->trashed()))
                                    <td>
                                        @can('delete', $user)
                                            <form action="{{ route('users.destroy', $user) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    DELETE
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                @else
                                    <td>
                                        @can('restore', $user)
                                            <a class="btn btn-secondary btn-sm" href="{{ route('users.restore', $user) }}">
                                                Restore
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('forceDelete', $user)
                                            <form action="{{ route('users.forceDelete', $user) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Force DELETE
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                @endif
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
