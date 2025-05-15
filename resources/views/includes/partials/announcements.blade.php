@if($announcements->count())
    @foreach($announcements as $announcement)
        <x-frontend.alert :type="$announcement->type" :dismissable="false">
            {{ (new \Illuminate\Support\HtmlString($announcement->message)) }}
        </x-frontend.alert>
    @endforeach
@endif
