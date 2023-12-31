@extends('layouts.app')

@section('content')
    <div class="card text-center" style="width: 40rem; height: 33rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between my-1">
                <h5 class="ms-5 me-2 pt-1 ">{{ $user->fullName}}</h5>
                <div class="d-flex">
                    @can('edit-create-grade', $user)
                    <a class=" btn btn-primary me-3" href="{{ route('users.subjects.create', $user) }}" role="button">Add subject</a>
                    @endcan
                    @can('edit', $user)
                        <a class=" btn btn-primary me-5" href="{{ route('users.edit', $user->id) }}" role="button">Update user</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-center" >
                <table class="table text-center" style="max-width: 30rem;">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Subject title</th>
                        <th scope>Grade</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subjects as $subject)
                        <tr>
                            <th scope="row">{{ $subject->id }}</th>
                            <td>{{ $subject->title }}</td>
                            <td>{{ $subject->pivot->grade }}</td>
                            <td>
                                <div class="">
                                    @can('edit-create-grade', $user)
                                        <a class="btn btn-primary btn-sm" href="{{ route('users.subjects.edit',compact('user', 'subject')) }}" role="button">Update</a>
                                    @endcan
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('users.subjects.destroy', compact('user', 'subject')) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    @can('edit-create-grade', $user)
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            DELETE
                                        </button>
                                    @endcan
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
                    {{ $subjects->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
