@extends('backend.layouts.app')

@section('title', __('Create Service'))

@section('content')
    <x-forms.post :action="route('admin.services.store')">
        <x-backend.card>

            <x-slot name="header">
                @lang('Create Service')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.services.index')" :text="__('Cancel')" />
            </x-slot>


            <x-slot name="body">
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Type')</label>

                    <div class="col-md-10">
                        <select name="type" class="form-control" required x-on:change="userType = $event.target.value">
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" {{ old('type') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="100" required />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Description')</label>

                    <div class="col-md-10">
                        <textarea type="text" name="description" class="form-control" placeholder="{{ __('Description') }}" value="{{ old('description') }}" required>{{ old('description') }}</textarea>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="float-right btn btn-sm btn-primary" type="submit">@lang('Create Service')</button>
            </x-slot>

        </x-backend.card>
    </x-forms.post>
@endsection
