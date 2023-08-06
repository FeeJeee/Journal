@extends('layouts.app')

@section('content')
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
                    <td><a href="{{ route('subjects.show',$subject->id) }}">{{ $subject->title }}</td>
                    <td>
                        <form action="{{ route('subjects.destroy', $subject->id) }}" method="post">
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
            <a class="" aria-current="page" href="{{ route('subjects.create') }}">
                New Subject
            </a>
        </div>

        <div class="m-4">
            {{ $subjects->links() }}
        </div>
    </div>
@endsection
