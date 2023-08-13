@extends('layouts.app')

@section('content')
    <div class=" d-flex justify-content-center m-3">
        <div class="card border" style="min-width: 45rem; min-height: 33rem;">
            <div class="card-header border-bottom text-center">
                <h5>{{ $group->title }}</h5>
            </div>

            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <table class="table text-center" style="max-width: 30rem;">
                        <thead>
                        <tr>
                            <th>Users</th>
                            @foreach($subjects as $subject)
                                <th>{{ $subject->title }}</th>
                            @endforeach
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th class="{{ $user->userColor }}" scope="row">{{ $user->name }}</th>
                                @foreach($subjects as $subject)
                                    <th>{{ $user->subjects->find($subject->id)?->pivot->grade ?? ' - ' }}</th>
                                @endforeach
                            </tr>
                        @endforeach
                        <tr>
                            <th scope="row">Average</th>
                            @foreach($subjects as $subject)
                                <th>{{ isset($subjects_avg[$subject->id]) ? $subjects_avg[$subject->id] : ' - ' }}</th>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex ms-5 ps-2">
                    @if(!empty($excellentUsers))
                        <ul class="me-3"> Excellent students:
                            @foreach($excellentUsers as $user)
                                <li>{{ $user->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if(!empty($goodUsers))
                        <ul class=""> Good students:
                            @foreach($goodUsers as $user)
                                <li>{{ $user->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="card-footer" style="height: 4rem;">
                <div class="d-flex justify-content-center pt-1">
                    <div class="d-flex flex-column">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
