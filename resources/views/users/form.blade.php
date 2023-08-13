<form action="{{ $action }}" method="post">
    @csrf
    @method($method)
    <div class=" d-flex justify-content-center m-3">
        <div class="card border" style="min-width: 25rem;">
            <div class="card-header bg-transparent border-bottom text-center"><h5>User</h5></div>
            <div class="card-body">
                <div class="d-flex flex-column">
                    <div class="">
                        <label for="name" class="form-label">User name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="{{ isset($user) ? $user->name : '' }}">
                    </div>
                    <div class="">
                        <label for="surname" class="form-label">User surname</label>
                        <input type="text" name="surname" id="surname" class="form-control" placeholder="{{ isset($user) ? $user->surname : '' }}">
                    </div>
                    <div class="">
                        <label for="patronymic" class="form-label">User patronymic</label>
                        <input type="text" name="patronymic" id="patronymic" class="form-control" placeholder="{{ isset($user) ? $user->patronymic : '' }}">
                    </div>
                    <label for="name" class="form-label">Group title</label>
                    <div>
                        <select name="group_id" id="group_id" class="form-select" aria-label="Default select example">
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" @selected(isset($user) && $group == $user->group)>{{ $group->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="">
                        <label for="birthdate" class="form-label">Birthdate</label>
                        <input type="text" name="birthdate" id="birthdate" class="form-control" placeholder="{{ isset($user) ? $user->birthdate : '' }}">
                    </div>
                    <div>
                        <label for="city" class="form-label">City</label>
                        <input type="text" name="address[city]" id="address[city]" class="form-control" placeholder="{{ isset($user) ? $user->address['city'] : '' }}">

                        <label for="street" class="form-label">Street</label>
                        <input type="text" name="address[street]" id="address[street]" class="form-control" placeholder="{{ isset($user) ? $user->address['street'] : '' }}">

                        <label for="building" class="form-label">Building</label>
                        <input type="text" name="address[building]" id="address[building]" class="form-control"  placeholder="{{ isset($user) ? $user->address['building'] : '' }}">

                        @if(!empty($user->address))
                            {{$user->fullAddress}}
                        @endif

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
