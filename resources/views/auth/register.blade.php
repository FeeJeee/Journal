<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname -->
        <div>
            <x-input-label for="surname" :value="__('Surname')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="surname" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Patronymic -->
        <div>
            <x-input-label for="patronymic" :value="__('Patronymic')" />
            <x-text-input id="patronymic" class="block mt-1 w-full" type="text" name="patronymic" :value="old('patronymic')" required autofocus autocomplete="patronymic" />
            <x-input-error :messages="$errors->get('patronymic')" class="mt-2" />
        </div>

        <!-- Address -->
        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="address[city]" class="block mt-1 w-full" type="text" name="address[city]" :value="old('address.city')" required autofocus autocomplete="address[city]" />
            <x-input-error :messages="$errors->get('address.city')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="street" :value="__('Street')" />
            <x-text-input id="address[street]" class="block mt-1 w-full" type="text" name='address[street]' :value="old('address.street')" required autofocus autocomplete="address[street]" />
            <x-input-error :messages="$errors->get('address.street')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="building" :value="__('Building')" />
            <x-text-input id="address[building]" class="block mt-1 w-full" type="text" name="address[building]" :value="old('address.building')" required autofocus autocomplete="address[building]" />
            <x-input-error :messages="$errors->get('address.building')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="birthdate" :value="__('Birthdate')" />
            <x-text-input id="birthdate" class="block mt-1 w-full" type="text" name="birthdate" :value="old('birthdate')" required autofocus autocomplete="birthdate" />
            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="group_id" :value="__('Group')"/>
            <x-select name="group_id" :options="$groups"></x-select>
        </div>


{{--        <div>--}}
{{--            <x-input-label for="group" :value="__('Group')" />--}}
{{--            <select name="group_id" id="group_id" class="form-select" aria-label="Default select example">--}}
{{--                @foreach($groups as $group)--}}
{{--                    <option value="{{ $group->id }}" @selected(isset($user) && $group == $user->group)>{{ $group->title }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

