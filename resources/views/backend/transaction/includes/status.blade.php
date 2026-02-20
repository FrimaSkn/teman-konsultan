<div class="btn-group status-dropdown">
  <button type="button" data-toggle="dropdown" aria-expanded="false"
    @class([
        'py-1 px-2 badge badge-pill dropdown-toggle text-capitalize',
        'badge-secondary' => $value == 'pending',
        'badge-success' => $value == 'paid',
        'badge-danger' => $value == 'failed',
        'badge-warning' => $value == 'cancelled'
        ])
  >
    {{ $value }}
  </button>
  <div class="dropdown-menu">
    <button wire:click="updateStatus({{ $row->id }}, 'pending')" class="dropdown-item text-secondary">pending</button>
    <button wire:click="updateStatus({{ $row->id }}, 'paid')" class="dropdown-item text-success">paid</button>
    <button wire:click="updateStatus({{ $row->id }}, 'failed')" class="dropdown-item text-danger">failed</button>
    <button wire:click="updateStatus({{ $row->id }}, 'cancelled')" class="dropdown-item text-warning">cancelled</button>
  </div>
</div>
