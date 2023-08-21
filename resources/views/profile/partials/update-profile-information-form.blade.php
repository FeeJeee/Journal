<section>
    <header>
        <h2>
            {{ __('Profile Information') }}
        </h2>

        <p>
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="form-label">{{__('Name')}}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="surname" class="form-label">{{__('Surname')}}</label>
            <input id="surname" name="surname" type="text" class="form-control" value="{{ old('surname', $user->surname) }}" required autofocus autocomplete="surname" />
            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
        </div>

        <div>
            <label for="patronymic" class="form-label">{{__('Patronymic')}}</label>
            <input id="patronymic" name="patronymic" type="text" class="form-control" value="{{ old('patronymic', $user->patronymic) }}" required autofocus autocomplete="patronymic" />
            <x-input-error class="mt-2" :messages="$errors->get('patronymic')" />
        </div>

        <div>
            <label for="birthdate" class="form-label">{{__('Birthdate')}}</label>
            <input id="birthdate" name="birthdate" type="text" class="form-control" value="{{ old('birthdate', $user->birthdate) }}" required autofocus autocomplete="birthdate" />
            <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
        </div>

        <div>
            <label for="city" class="form-label">{{__('City')}}</label>
            <input id="address[city]" name="address[city]" type="text" class="form-control" value="{{ old('address[city]', $user->address['city']) }}" required autofocus autocomplete="city" />
            <x-input-error class="mt-2" :messages="$errors->get('address[city]')" />
        </div>

        <div>
            <label for="street" class="form-label">{{__('Street')}}</label>
            <input id="address[street]" name="address[street]" type="text" class="form-control" value="{{ old('address[street]', $user->address['street']) }}" required autofocus autocomplete="street" />
            <x-input-error class="mt-2" :messages="$errors->get('address[street]')" />
        </div>

        <div>
            <label for="building" class="form-label">{{__('Building')}}</label>
            <input id="address[building]" name="address[building]" type="text" class="form-control" value="{{ old('address[building]', $user->address['building']) }}" required autofocus autocomplete="building" />
            <x-input-error class="mt-2" :messages="$errors->get('address[building]')" />
        </div>

        <div>
            <label for="group" class="form-label">{{__('Group')}}</label>
            <select name="group_id" id="group_id" class="form-select" aria-label="Default select example">
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" @selected(isset($user) && $group == $user->group)>{{ $group->title }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="email" class="form-label">{{__('Email')}}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="avatar" class="form-label">{{ __('Change avatar')}}</label>
            <input class="form-control" type="file" accept="image/png,image/jpeg" name="avatar" id="avatar">
        </div>

        <div class="flex items-center gap-4">
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary ">
                    {{ __('Save') }}
                </button>
            </div>


            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
