<nav id="sidebar">
    <div class="sidebar-header">
        <h3>{{ appName() }}</h3>
        <strong>TK</strong>
    </div>

    <ul class="list-unstyled components">
        <li class="{{ activeMenu('frontend.user.dashboard') }}">
            <a href="{{ route('frontend.user.dashboard') }}">
                <i class="fas fa-book"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="{{ activeMenu('frontend.user.subscription.*') }}">
            <a href="{{ route('frontend.user.subscription.index') }}">
                <i class="fa fa-bookmark"></i>
                {{ __('Subscriptions') }}
            </a>
        </li>
        <li class="{{ activeMenu('frontend.user.transaction.*') }}">
            <a href="{{ route('frontend.user.transaction.index') }}">
                <i class="fa fa-credit-card"></i>
                {{ __('Transactions') }}
            </a>
        </li>
        <li class="{{ activeMenu('frontend.user.account') }}">
            <a href="{{ route('frontend.user.account') }}">
                <i class="fa fa-user"></i>
                {{ __('My Account') }}
            </a>
        </li>
        <li class="px-4">
            <hr>
        </li>
        <li>
            <a href="{{ route('frontend.home') }}">
                <i class="fa fa-home"></i>
                {{ __('Home') }}
            </a>
        </li>
        <li>
            <x-utils.link
                :text="__('Logout')"
                class=""
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <x-slot name="text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>

                    @lang('Logout')
                    <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                </x-slot>
            </x-utils.link>
        </li>
    </ul>
</nav>
