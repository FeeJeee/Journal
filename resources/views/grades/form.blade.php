<form action="{{ $action }}" method="post">
    @csrf
    @method($method)
    {{--    {{ dd($subjects) }}--}}
    <div class=" d-flex justify-content-center m-3">
        <div class="card border" style="min-width: 25rem;">
            <div class="card-header bg-transparent border-bottom text-center"><h5>{{ $user->name }}</h5></div>
            <div class="card-body text-success">
                <div class="d-flex flex-column">
                    <input type="text" value="{{ $user->id }}" name="user_id" id="user_id" class="form-control" hidden>
                    @if(isset($current_subject))
                        <input type="text" value="{{ $subject->id }}" name="subject_id" id="subject_id" class="form-control" hidden>
                        <div class="">
                            <label for="title" class="form-label">Subject title: {{ $current_subject->title }} </label>
                        </div>
                    @else
                        <div>
                            <select name="subject_id" id="subject_id" class="form-select" aria-label="Default select example">
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }} @selected(isset($current_subject) && $subject == $current_subject)">{{ $subject->title }}</option>
                                    {{ $user->name }}
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="">
                        <label for="title" class="form-label">Grade </label>
                        <input type=""  name="grade" id="grade" class="form-control" placeholder="{{ isset($current_subject) ?  $current_subject->pivot->grade : '' }}">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary d-grid gap-2 mt-4">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
