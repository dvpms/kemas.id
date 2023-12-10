@if ($announcements->count())
    @foreach ($announcements as $announcement)
        <div class="alert @if ($announcement->type == 'info') alert-primary @else alert-danger @endif m-0 d-flex align-items-center justify-content-center"
            role="alert">
            <b>{{ new \Illuminate\Support\HtmlString($announcement->message) }}</b>
        </div>
    @endforeach
@endif
