@if(isset($breadcrumbs))
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item">
                    <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
@endif
