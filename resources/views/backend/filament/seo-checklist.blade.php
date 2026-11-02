<div style="margin-top: 0.5rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 0.75rem;">
        <div>
            <div style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.6;">
                {{ __('SEO checklist') }}
            </div>
            <div style="font-size: 0.8rem; opacity: 0.7;">
                {{ $passed }} / {{ $total }} {{ __('checks passed') }}
            </div>
        </div>

        <div style="min-width: 8rem;">
            <div style="height: 0.5rem; width: 100%; border-radius: 9999px; background: rgba(107, 114, 128, 0.2); overflow: hidden;">
                <div style="height: 100%; width: {{ $score }}%; background: {{ $score >= 80 ? '#36D399' : ($score >= 50 ? '#FBBD23' : '#F87272') }};"></div>
            </div>
            <div style="font-size: 0.75rem; text-align: right; margin-top: 0.25rem; font-weight: 600;">
                {{ $score }}%
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0.5rem 1rem;">
        @foreach ($checks as $check)
            <div style="display: flex; align-items: flex-start; gap: 0.5rem; font-size: 0.8rem;">
                <span style="flex-shrink: 0; font-weight: 700; color: {{ $check['ok'] ? '#36D399' : '#F87272' }};">
                    {{ $check['ok'] ? '✓' : '✕' }}
                </span>
                <span>
                    <span style="display: block;">{{ $check['label'] }}</span>
                    <span style="display: block; opacity: 0.6;">{{ $check['hint'] }}</span>
                </span>
            </div>
        @endforeach
    </div>
</div>
