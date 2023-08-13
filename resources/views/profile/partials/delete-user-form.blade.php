<section class="space-y-6">
    <header>
        <h2 class="">
            {{ __('Delete Account') }}
        </h2>

        <p class="">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>


    <!-- Кнопка-триггер модального окна -->

{{--    <div class="d-grid gap-2 mt-4">--}}
{{--        <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#exampleModal">--}}
{{--            {{ __('Delete') }}--}}
{{--        </button>--}}
{{--    </div>--}}
{{--    <!-- Модальное окно -->--}}
{{--    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog" style="min-width: 35rem;">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="p-3">--}}
{{--                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">--}}
{{--                        @csrf--}}
{{--                        @method('delete')--}}

{{--                        <h3 class="">--}}
{{--                            {{ __('Are you sure you want to delete your account?') }}--}}
{{--                        </h3>--}}

{{--                        <p class="">--}}
{{--                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}--}}
{{--                        </p>--}}

{{--                        <div class="mt-6">--}}
{{--                            <label for="password">{{ __('Password') }}</label>--}}

{{--                            <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Password') }}"/>--}}

{{--                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />--}}
{{--                        </div>--}}

{{--                        <div class="d-flex">--}}
{{--                            <div class="mt-2">--}}
{{--                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancle') }} </button>--}}
{{--                                <button type="button" class="btn btn-danger">{{ __('Delete') }} </button>--}}
{{--                            </div>--}}



{{--                            --}}{{--                        <x-secondary-button x-on:click="$dispatch('close')">--}}
{{--                            --}}{{--                            {{ __('Cancel') }}--}}
{{--                            --}}{{--                        </x-secondary-button>--}}

{{--                            --}}{{--                        <x-danger-button class="ml-3">--}}
{{--                            --}}{{--                            {{ __('Delete Account') }}--}}
{{--                            --}}{{--                        </x-danger-button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

</section>
