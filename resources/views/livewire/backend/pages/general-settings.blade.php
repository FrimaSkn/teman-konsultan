<div>
    <form wire:submit="save">
        {{ $this->form }}

        <button type="submit" class="float-right mt-4 btn btn-sm btn-primary">
            @lang('Update')
        </button>
    </form>

    <x-filament-actions::modals />
</div>
