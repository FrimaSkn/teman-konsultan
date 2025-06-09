<div>
    <form wire:submit="save">
        {{ $this->form }}

        <button type="submit">
            Update
        </button>
    </form>

    <x-filament-actions::modals />
</div>
