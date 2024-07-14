@if(session()->has('success'))
<!--begin::Alert-->
<div class="alert alert-primary d-flex align-items-center p-5">
    <!--begin::Icon-->
    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
    <!--end::Icon-->
    <!--begin::Wrapper-->
    <div class="d-flex flex-column">
        <!--begin::Title-->
        <h4 class="mb-1 text-dark">Success</h4>
        <!--end::Title-->
        <!--begin::Content-->
        <span>{{ session('success') }}</span>
        <!--end::Content-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Alert-->
@endif
@if(session()->has('error'))
<!--begin::Alert-->
<div class="alert alert-danger d-flex align-items-center p-5">
    <!--begin::Icon-->
    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
    <!--end::Icon-->
    <!--begin::Wrapper-->
    <div class="d-flex flex-column">
        <!--begin::Title-->
        <h4 class="mb-1 text-dark">Error</h4>
        <!--end::Title-->
        <!--begin::Content-->
        <span>{{ session('error') }}</span>
        <!--end::Content-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Alert-->
@endif