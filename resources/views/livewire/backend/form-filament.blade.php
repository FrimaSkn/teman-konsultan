<div>
    <form wire:submit="create">
        {{ $this->form }}

        <button type="submit" class="float-right btn btn-sm btn-primary">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />
</div>
