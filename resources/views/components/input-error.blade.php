@props(['messages'])

@if ($messages)
    <ul style="list-style-type: none; padding: 0" {{ $attributes->merge(['class' => 'pt-1 m-0 text-danger']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
