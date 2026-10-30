<div style="margin-top: 0.5rem;">
    <div style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.6; margin-bottom: 0.5rem;">
        {{ __('Google search preview') }}
    </div>

    <div style="border: 1px solid rgba(107, 114, 128, 0.25); border-radius: 0.5rem; padding: 1rem; background: #fff;">
        <div style="font-size: 0.8rem; color: #202124; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
            {{ $url }}
        </div>
        <div style="font-size: 1.15rem; line-height: 1.4; color: #1a0dab; margin-top: 0.25rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
            {{ $title }}
        </div>
        <div style="font-size: 0.875rem; line-height: 1.5; color: #4d5156; margin-top: 0.25rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
            {{ $description }}
        </div>
    </div>
</div>
