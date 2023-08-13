<header class="py-2 border-bottom">
    <nav class="navbar navbar-expand-lg ">
        <div class="container p-2">
            <a class="navbar-brand ms-5" href="">Journal</a>
            <div class="d-flex flex-row align-items-center">
                <a class="nav-link active me-5"  href="{{ route('groups.index') }}">GROUPS</a>
                <a class="nav-link active me-5"  href="{{ route('subjects.index') }}">SUBJECTS</a>
                <a class="nav-link active me-5"  href="{{ route('users.index') }}">USERS</a>

                <div class="dropdown me-5">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                        <form class="dropdown-item" method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="link-body-emphasis link-underline-light" href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>


