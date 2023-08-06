@extends('layouts.app')

@section('content')
    <div class=" d-flex justify-content-center m-3">
        <div class="card border" style="min-width: 25rem;">
            <div class="card-header bg-transparent border-bottom text-center"><h5>{{ $user->name }}</h5></div>
            <div class="card-body text-success">
                <div class="d-flex flex-column">
                    <div class="">
                        <div class="m-2">Birthdate: {{ $user->birthdate }}</div>
                        <div class="m-2">Group: {{ $user->group->title }}</div>
                        <div class="d-flex align-items-center justify-content-center" >
                            <table class="table text-center" style="max-width: 40rem;">
                                <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Subject title</th>
                                    <th scope>Grade</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subjects as $subject)
                                    <tr>
                                        <th scope="row">{{ $subject->id}}</th>
                                        <td><a href="{{ route('subjects.show',$subject->id) }}">{{ $subject->title }}</td>
                                        <td>{{ $subject->pivot->grade }}</td>
                                        <td>
                                            <div class="">
                                                <a href="{{ route('users.subjects.edit', compact('user', 'subject')) }}">
                                                    <div class="d-grid gap-2">
                                                        <button type="submit" class="btn btn-primary mb-2">
                                                            UPDATE
                                                        </button>
                                                    </div>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{ route('users.subjects.destroy', compact('user', 'subject')) }}" method="post">
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

                        <div class="">
                            <a href="{{ route('users.subjects.create', $user) }}">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary mb-2">
                                        ADD SUBJECT
                                    </button>
                                </div>
                            </a>
                        </div>

                        <div class="">
                            <a href="{{ route('users.edit', $user->id) }}">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary mb-2">
                                        UPDATE
                                    </button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
