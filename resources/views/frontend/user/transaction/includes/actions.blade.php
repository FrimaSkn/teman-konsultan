{{-- @dd($model->id) --}}
<x-utils.form-button
        action="{{ route('frontend.user.transaction.show', $model->order_number) }}"
        method="GET"
        button-class="btn btn-info btn-sm"
        icon="fas fa-sync-alt"
        name="confirm-item"
    >
        @lang('Deatil')
</x-utils.form-button>
