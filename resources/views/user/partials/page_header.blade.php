@php
    $current_user = getAuthUser('web');
    $current_guard = isset($current_user) ? 'user' : 'admin';
@endphp
<div class="d-md-flex justify-content-between align-items-center">
    <h5 class="mb-0">{{ $current_page_name }}</h5>
    <nav aria-label="breadcrumb" class="d-inline-block">
        <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
            <li class="breadcrumb-item text-capitalize"><a
                    href="{{ route($current_guard.'.dashboard') }}">{{ __('user.dashboard') }}</a></li>
            @foreach ($sub_pages as $name => $link)
                <li class="breadcrumb-item text-capitalize @if ($loop->last) active @endif">
                    @if ($loop->last)
                        {{ $name }}
                    @else
                        <a href="{{ $link }}">{{ $name }}</a>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</div>
