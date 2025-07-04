<div>
    <form wire:submit="create">
        {{ $this->form }}

         <button type="submit" class="float-right mt-4 btn btn-sm btn-primary">
            Create
        </button>
    </form>

    <x-filament-actions::modals />
</div>
