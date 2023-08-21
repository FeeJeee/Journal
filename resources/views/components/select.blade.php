<div>
    <select class="form-select" name="{{ $name }}">
        @foreach ($options as $option)
            <option value="{{ $option->id }}" @selected(isset($user) && $option == $user->group)>{{ $option->title }}</option>
        @endforeach
    </select>
</div>
