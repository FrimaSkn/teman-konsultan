@if(isset($errors) && $errors->any())
    <x-utils.toast type="danger" class="header-message">
        @foreach($errors->all() as $error)
            {{ $error }}<br/>
        @endforeach
    </x-utils.toast>
@endif

@if(session()->get('flash_success'))
    <x-utils.toast type="success" class="header-message">
        {{ session()->get('flash_success') }}
    </x-utils.toast>
@endif

@if(session()->get('flash_warning'))
    <x-utils.toast type="warning" class="header-message">
        {{ session()->get('flash_warning') }}
    </x-utils.toast>
@endif

@if(session()->get('flash_info') || session()->get('flash_message'))
    <x-utils.toast type="info" class="header-message">
        {{ session()->get('flash_info') }}
    </x-utils.toast>
@endif

@if(session()->get('flash_danger'))
    <x-utils.toast type="danger" class="header-message">
        {{ session()->get('flash_danger') }}
    </x-utils.toast>
@endif

@if(session()->get('status'))
    <x-utils.toast type="success" class="header-message">
        {{ session()->get('status') }}
    </x-utils.toast>
@endif

@if(session()->get('resent'))
    <x-utils.toast type="success" class="header-message">
        @lang('A fresh verification link has been sent to your email address.')
    </x-utils.toast>
@endif

@if(session()->get('verified'))
    <x-utils.toast type="success" class="header-message">
        @lang('Thank you for verifying your e-mail address.')
    </x-utils.toast>
@endif
