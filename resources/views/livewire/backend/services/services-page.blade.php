<div>
    <form wire:submit="save">
        {{ $this->form }}

        <button type="submit" class="float-right mt-6 btn btn-sm btn-primary">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />
</div>
