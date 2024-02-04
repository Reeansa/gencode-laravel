<div class="page-header">
    @unless ($breadcrumbs->isEmpty())
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if (!is_null($breadcrumb->url) && !$loop->last)
                        <a href="{{ $breadcrumb->url }}" class="breadcrumb-item">{{ $breadcrumb->title }}</a>
                    @else
                        <span class="breadcrumb-item active">{{ $breadcrumb->title }}</span>
                    @endif
                @endforeach
            </nav>
        </div>
    @endunless
</div>
