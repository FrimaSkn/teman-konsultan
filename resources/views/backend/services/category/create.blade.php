@extends('backend.layouts.app')

@section('title', __('Create category'))

@section('content')
    {{-- <x-forms.post :action="route('admin.services-category.store')">
        <x-backend.card>

            <x-slot name="header">
                @lang('Create category')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.services-category.index')" :text="__('Cancel')" />
            </x-slot>


            <x-slot name="body">
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="100" required />
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="float-right btn btn-sm btn-primary" type="submit">@lang('Create Service')</button>
            </x-slot>

        </x-backend.card>
    </x-forms.post> --}}

    <x-backend.card>
        <x-slot name="header">
            @lang('Create category')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.services-category.index')" :text="__('Cancel')" />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.services.category-create />
        </x-slot>
    </x-backend.card>
@endsection
