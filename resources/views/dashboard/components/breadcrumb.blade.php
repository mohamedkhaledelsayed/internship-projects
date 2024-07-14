<div class="page-title d-flex flex-column me-5 py-2">
    <!--begin::Title-->
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">
        {{$titleBreadcrumb ?? ''}}
    </h1><!--end::Title-->

    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{route('index')}}" class="text-muted text-hover-primary">{{__('admin.Home')}}</a>
        </li><!--end::Item-->

        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li><!--end::Item-->

        {{ $slot ?? ''}}
    </ul><!--end::Breadcrumb-->
</div>
