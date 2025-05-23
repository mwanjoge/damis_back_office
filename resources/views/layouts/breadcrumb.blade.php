<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light p-2 rounded shadow-sm mb-3">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$loop->last)
                <li class="breadcrumb-item">
                    <a href="{{ $breadcrumb['url'] }}" class="text-primary">{{ $breadcrumb['name'] }}</a>
                </li>
            @else
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    {{ $breadcrumb['name'] }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>
