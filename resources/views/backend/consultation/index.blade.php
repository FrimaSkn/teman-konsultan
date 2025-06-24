@extends('backend.layouts.app')

@section('title', __('Consultation Messages'))

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('Consultation Messages')
        </div>
        @if ($consultations->isEmpty())
            <div class="card-body">
                <p class="text-muted">
                    @lang('No consultation messages found.')
                </p>
            </div>
        @else
            <ul class="list-group list-group-flush">
                @foreach ($consultations as $consultation)
                    <li class="list-group-item {{ $consultation->is_read ? '' : 'active' }}">
                        <a href="{{ route('admin.consultation.show', $consultation) }}" class="row">
                            <div class="col-11">
                                <div>
                                    <strong>Subject: {{ $consultation->subject }}</strong>
                                </div>
                                <div>
                                    {{ $consultation->name }} ({{ $consultation->email }})
                                </div>
                                <div>{{ $consultation->area }}</div>
                                <p class="w-full text-xs italic truncate">{{ $consultation->message }}</p>
                            </div>
                            <div class="text-right col-1">
                                {{ $consultation->created_at->diffForHumans() }}
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    {{ $consultations->links() }}
@endsection
