@extends('layouts.guest')
@section('content')
    <div class="card" style="width: 30rem">
        <h5 class="card-header text-center"> {{__('Registration')}}</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <label for="name" class="form-label">{{__('Name')}}</label>
                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <!-- Surname -->
                <div class="mt-2">
                    <label for="surname" class="form-label">{{__('Surname')}}</label>
                    <input id="surname" class="form-control" type="text" name="surname" value="{{ old('surname') }}" required autofocus autocomplete="surname" />
                    <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                </div>

                <!-- Patronymic -->
                <div class="mt-2">
                    <label for="patronymic" class="form-label">{{__('Patronymic')}}</label>
                    <input id="patronymic" class="form-control" type="text" name="patronymic" value="{{ old('patronymic') }}" required autofocus autocomplete="patronymic" />
                    <x-input-error :messages="$errors->get('patronymic')" class="mt-2" />
                </div>

                <!-- Address -->
                <div class="mt-2">
                    <label for="city" class="form-label">{{__('City')}}</label>
                    <input id="address[city]" class="form-control" type="text" name="address[city]" value="{{ old('address.city') }}" required autofocus autocomplete="patronymic" />
                    <x-input-error :messages="$errors->get('address.city')" class="mt-2" />
                </div>

                <div class="mt-2">
                    <label for="street" class="form-label">{{__('Street')}}</label>
                    <input id="address[street]" class="form-control" type="text" name="address[street]" value="{{ old('address.street') }}" required autofocus autocomplete="patronymic" />
                    <x-input-error :messages="$errors->get('address.street')" class="mt-2" />
                </div>

                <div class="mt-2">
                    <label for="building" class="form-label">{{__('Building')}}</label>
                    <input id="address[building]" class="form-control" type="text" name="address[building]" value="{{ old('address.building') }}" required autofocus autocomplete="patronymic" />
                    <x-input-error :messages="$errors->get('address.building')" class="mt-2" />
                </div>

                <div class="mt-2">
                    <label for="birthdate" class="form-label">{{__('Birthdate')}}</label>
                    <input id="birthdate" class="form-control" type="text" name="birthdate" value="{{ old('birthdate') }}" required autofocus autocomplete="patronymic" />
                    <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                </div>

                <div class="mt-2">
                    <label for="group" class="form-label">{{__('Group')}}</label>
                    <x-select name="group_id" :options="$groups"></x-select>
                </div>

                <!-- Email Address -->
                <div class="mt-2">
                    <label for="email" class="form-label">{{__('Email')}}</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-2">
                    <label for="password" class="form-label">{{__('Password')}}</label>

                    <x-text-input id="password" class="form-control"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-2">
                    <label for="password_confirmation" class="form-label">{{__('Confirm Password')}}</label>

                    <input id="password_confirmation" class="form-control"
                           type="password"
                           name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-2">
                    <label for="role" class="form-label">{{ __('Role') }}</label>
                    <select class="form-select" name="role">
                        @foreach($user_roles as $role)
                            <option value="{{ $role->value }}" @selected(old('role') == $role->value)>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <div class="d-flex mt-3 justify-content-between">
                    <a class="mt-1" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


