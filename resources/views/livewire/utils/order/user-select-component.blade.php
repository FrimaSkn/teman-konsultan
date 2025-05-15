<div>
    {{-- Do your work, then step back. --}}

    <div class="form-group">

        <label for="keyword" class="col-md-4 col-form-label">@lang('Search User')</label>

        <div class="col-md-6">
            {{-- text input --}}
            <input type="search"
                autocomplete="off"
                wire:model.live.debounce.500ms="keyword"
                class="form-control">

            {{-- select list --}}
            @if (!empty($keyword) && $users->isNotEmpty())
                <div class="list-group" id="userList">
                    @forelse ($users as $user)
                        <a href="#"
                            class="list-group-item list-group-item-action"
                            wire:click="selectUser({{ $user->id }}, '{{ $user->name }}')">
                            {{ $user->name }}
                        </a>
                    @empty
                        <div class="list-group-item">
                            @lang('No results found')
                        </div>
                    @endforelse

                    {{-- pagination load more --}}
                    @if ($users->hasMorePages())
                        <div class="list-group-item">
                            <button wire:click="loadMore" class="btn btn-link">
                                @lang('Load more')
                            </button>
                        </div>
                    @endif
                </div>

            @endif
            <input type="hidden" name="user_id" id="user_id" wire:model="user_id">
        </div>

    </div>

</div>
