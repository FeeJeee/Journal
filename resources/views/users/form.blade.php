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
                        <input type="text" name="name" id="name" class="form-control" value="{{ isset($user) ? $user->name : '' }}">
                    </div>
                    <div class="">
                        <label for="surname" class="form-label">User surname</label>
                        <input type="text" name="surname" id="surname" class="form-control" value="{{ isset($user) ? $user->surname : '' }}">
                    </div>
                    <div class="">
                        <label for="patronymic" class="form-label">User patronymic</label>
                        <input type="text" name="patronymic" id="patronymic" class="form-control" value="{{ isset($user) ? $user->patronymic : '' }}">
                    </div>

                    <div class="">
                        <label for="group" class="form-label">{{__('Group')}}</label>
                        <x-select name="group_id" :options="$groups" :user="isset($user) ? $user : null" ></x-select>
                    </div>

                    <div class="">
                        <label for="birthdate" class="form-label">Birthdate</label>
                        <input type="text" name="birthdate" id="birthdate" class="form-control" value="{{ isset($user) ? $user->birthdate : '' }}">
                    </div>
                    <div>
                        <label for="city" class="form-label">City</label>
                        <input type="text" name="address[city]" id="address[city]" class="form-control" value="{{ isset($user) ? $user->address['city'] : '' }}">

                        <label for="street" class="form-label">Street</label>
                        <input type="text" name="address[street]" id="address[street]" class="form-control" value="{{ isset($user) ? $user->address['street'] : '' }}">

                        <label for="building" class="form-label">Building</label>
                        <input type="text" name="address[building]" id="address[building]" class="form-control"  value="{{ isset($user) ? $user->address['building'] : '' }}">
                    </div>
                    <div class="">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ isset($user) ? $user->email : '' }}">
                    </div>
                    <div class="">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="{{ isset($user) ? $user->password : '' }}">
                    </div>
                    <div class="">
                        <label for="password_confirmation" class="form-label">Password confirmation</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ isset($user) ? $user->password : '' }}">
                    </div>
                        <label for="role" class="form-label">{{ __('Role') }}</label>
                            <select class="form-select" name="role">
                                @foreach($user_roles as $role)
                                    <option value="{{ $role->value }}" @selected(isset($user) && $role->value  == $user->role)>{{ $role->name }}</option>
                                @endforeach
                            </select>
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
