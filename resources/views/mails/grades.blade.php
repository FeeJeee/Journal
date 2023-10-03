{{ $user->fullName }} <br>
<br>
@foreach($user->subjects as $subject)
    {{ $subject->title.': '.$subject->pivot->grade }} <br>
@endforeach
