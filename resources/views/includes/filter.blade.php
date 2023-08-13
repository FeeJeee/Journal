<form action="{{ $action }}" method="get">
    @csrf()
    @method($method)
    <div class="d-flex justify-content-center mt-3">
        @if(isset($users))
            <label class="mt-1 me-3">name</label>
            <div class="d-flex">
                <input class="form-control me-3" type="text" value="{{ request()->name }}" name="name" id="task-name"
                       style="width: 15rem;">
            </div>

            <label class="mt-1 me-3">date start</label>
            <div class="d-flex">
                <input class="form-control me-3" type="text" value="{{ request()->dateStart }}" name="dateStart" id="dateStart" style="width: 15rem;">
            </div>

            <label class="mt-1 me-3">date end</label>
            <div class="d-flex">
                <input class="form-control me-3" type="text" value="{{ request()->dateEnd }}" name="dateEnd" id="dateEnde" style="width: 15rem;">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>

        @elseif(isset($subjects))
            <label class="mt-1 me-3">title</label>
            <div class="d-flex">
                <input class="form-control me-3" type="text" value="{{ request()->title }}" name="title" id="title" style="width: 30rem;">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>

        @elseif(isset($groups))
            <label class="mt-1 me-3">title</label>
            <div class="d-flex">
                <input class="form-control me-3" type="text" value="{{ request()->title }}" name="title" id="title" style="width: 30rem;">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        @endif

    </div>
</form>

