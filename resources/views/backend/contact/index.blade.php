@extends('backend.layouts.app')

@section('title', __('Contact Us'))

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Contact Messages')
        </div>
        @if ($contacts->isEmpty())
            <div class="card-body">
                <p class="text-muted">
                    @lang('No contact messages found.')
                </p>
            </div>
        @else
            <ul class="list-group list-group-flush">
                @foreach ($contacts as $contact)
                    <li class="list-group-item {{ $contact->is_read ? '' : 'active' }}">
                        <a href="{{ route('admin.contact.show', $contact) }}" class="row">
                            <div class="col-11">
                                <div>
                                    <strong>Subject: {{ $contact->subject }}</strong>
                                </div>
                                <div>
                                    {{ $contact->name }} ({{ $contact->email }})
                                </div>
                                <p class="w-full text-xs italic truncate">{{ $contact->message }}</p>
                            </div>
                            <div class="text-right col-1">
                                {{ $contact->created_at->diffForHumans() }}
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    {{ $contacts->links() }}
@endsection
