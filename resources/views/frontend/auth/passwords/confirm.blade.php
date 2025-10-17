@extends('frontend.layouts.app')

@section('title', __('Please confirm your password before continuing.'))

@section('content')
    <div class="container min-h-[40svh] py-10 flex items-center justify-center">
        <div class="w-full max-w-lg">
            <x-forms.post :action="route('frontend.auth.password.confirm')">
                <div class="mb-4 text-xl font-medium">@lang('Please confirm your password before continuing.')</div>
                   <div class="grid grid-cols-3">
                        <div class="relative col-span-3 my-3">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 uppercase">password</label>
                            <input type="password" id="password" name="password" class="shadow-xs bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                        </div>
                    </div>

                <div class="mb-0 form-group row">
                    <div class="col-md-6 offset-md-4">
                        <button class="px-6 pt-1 pb-1.5 uppercase bg-secondary rounded-lg hover:bg-opacity-90 text-primary font-bold text-nowrap inline-flex items-center" type="submit">@lang('Confirm Password')</button>
                    </div>
                </div><!--form-group-->
            </x-forms.post>
        </div>
    </div>
@endsection
