@extends('layouts.app')

@section('content')
    @include('includes.filter',[
        'action' => route('subjects.index'),
        'method' => 'get',
    ])

    <div class="d-flex justify-content-center">
        <div class="card text-center" style="width: 40rem; min-height: 34rem;">
            <div class="card-header" style="height: 4rem">
                <div class="d-flex justify-content-between my-1">
                    <h5 class="ms-5 pt-1 ">Subjects</h5>
                    @can('create', App\Models\Subject::class)
                        <a class=" btn btn-primary me-5" aria-current="page" href="{{ route('subjects.create') }}">New subject</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center" >
                    <table class="table text-center" style="max-width: 30rem;">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Title</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <th scope="row">{{ $subject->id }}</th>
                                <td><a class="link-underline-light" href="{{ route('subjects.show',$subject->id) }}">{{ $subject->title }}</td>
                                <td>
                                    @can('delete', $subject)
                                        <form action="{{ route('subjects.destroy', $subject->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                DELETE
                                            </button>
                                        </form>
                                    @endcan
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
    </div>
@endsection
