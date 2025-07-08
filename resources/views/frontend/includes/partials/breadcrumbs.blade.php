@if (Breadcrumbs::has() && !Route::is('frontend.home'))
    <nav id="breadcrumbs" aria-label="breadcrumb">
        <ol class="container mb-0 breadcrumb">
            @foreach (Breadcrumbs::current() as $crumb)
                @if ($crumb->url() && !$loop->last)
                    <li class="breadcrumb-item">
                        <x-utils.link :href="$crumb->url()" :text="$crumb->title()" />
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $crumb->title() }}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
