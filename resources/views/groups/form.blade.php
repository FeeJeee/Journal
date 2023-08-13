<form action="{{ $action }}" method="post">
    @csrf
    @method($method)
    <div class=" d-flex justify-content-center m-3">
        <div class="card border" style="min-width: 25rem;">
            <div class="card-header bg-transparent border-bottom text-center"><h5>Group</h5></div>
            <div class="card-body">
                <div class="d-flex flex-column">
                    <div class="">
                        <label for="title" class="form-label">Group title</label>
                        <input type="text" name="title" id="title" class="form-control " placeholder="{{ isset($group) ? $group->title : '' }}">
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
