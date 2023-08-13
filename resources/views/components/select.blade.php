<div>
    <select class="" name="{{ $name }}">
        @foreach ($options as $option)
            <option value="{{ $option->id }}" @selected(old($name) == $option->id)>{{ $option->title }}</option>
        @endforeach
    </select>
</div>
