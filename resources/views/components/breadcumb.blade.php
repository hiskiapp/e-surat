<div class="page-title-box">
    <h4 class="font-size-18">{{ $title }}</h4>
    <ol class="breadcrumb mb-0">
        @if(isset($li_1))
        <li class="breadcrumb-item">
            <a href="javascript: void(0);">
                {{ $li_1 }}
            </a>
        </li>
        @endif
        @if(isset($title_li))
        <li class="breadcrumb-item active">{{ $title_li }}</li>
        @else
        <li class="breadcrumb-item active">{{ $title }}</li>
        @endif
    </ol>
</div>