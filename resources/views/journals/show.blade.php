@extends('layouts.app')

@section('content')
    {{ $group->title }}
    <ul>
        @foreach($group->users as $user)
            <li>
                <ul>
                    {{ $user->name }}
                    @foreach($user->subjects as $subject)
                        <li>
                            {{ $subject->title }}
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>

    <div class="d-flex align-items-center justify-content-center" >
        <table class="table text-center" style="max-width: 30rem;">
            <thead>
            {{ $group->title }}
            <tr>
                <th>    </th>
                @foreach($subjects as $subject)
                    <th>{{ $subject->title }}</th>
                @endforeach
            </tr>
            </thead>

            <tbody>
            @foreach($group->users as $user)
                <tr>
                    <th scope="row">{{ $user->name }}</th>
                        @foreach($subjects as $subject)
                            <th>{{ ($user->subjects->find($subject->id)) ? $user->subjects->find($subject->id)->pivot->grade : '' }}</th>
                        @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
