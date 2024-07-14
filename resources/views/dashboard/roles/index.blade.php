@extends('dashboard.layouts.app')
@section('page_title', 'Roles List')
@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <!--begin::Page title-->
                    @component('dashboard.components.breadcrumb')
                        @slot('titleBreadcrumb')
                            {{__('admin.Roles')}}
                        @endslot
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{__('admin.Roles')}}</li><!--end::Item-->
                    @endcomponent<!--end::Page title-->
                </div><!--end::Toolbar container-->
            </div><!--end::Toolbar-->

            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Row-->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                    @foreach($roles as $role)
                        <!--begin::Col-->
                        <div class="col-md-4">
                            <!--begin::Card-->
                            <div class="card card-flush h-md-100">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{ $role->name }}</h2>
                                    </div><!--end::Card title-->
                                </div><!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-1">
                                    <!--begin::Users-->
                                    <div class="fw-bold text-gray-600 mb-5">{{ __('admin.Total-admins-wr') }} : {{ $role->admins->count() }}</div><!--end::Users-->

                                    <!--begin::Permissions-->
                                    <div class="d-flex flex-column text-gray-600">
                                        @foreach( $role->permissions->shuffle()->take(5) as $permission)

                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span> {{ __( $permission->action ) . ' ' . __( str_replace("_", " " , $permission->category) ) }}
                                            </div>

                                        @endforeach

                                        @if( $role->permissions->count() - 5 > 0)
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>
                                                <em>{{ __("and") . ' ' . ( $role->permissions->count() - 5 ) . ' '. __("more") }} ...</em>
                                            </div>
                                        @endif
                                    </div>
                                    <!--end::Permissions-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->
                                <div class="card-footer flex-wrap pt-0">
                                    <a href="{{ route('roles.show',$role->id) }}" class="btn btn-light btn-active-primary my-1 me-2">{{ __("admin.view") }} {{{  __('admin.Role') }}}</a>

                                    <button type="button" class="btn btn-light btn-active-light-primary my-1 edit-role-btn" data-role-id="{{$role->id}}" >
                                        <span class="indicator-label">{{ __("admin.edit") }} {{ __('admin.Role') }}</span>
                                        <!-- begin :: Indicator -->
                                        <span class="indicator-progress">{{ __("admin.please-wait") }}
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span><!-- end   :: Indicator -->
                                    </button>
                                </div><!--end::Card footer-->
                            </div><!--end::Card-->
                        </div><!--end::Col-->
                    @endforeach

                    <!-- begin :: Add Role -->
                        <div class="col-md-4 my-10">
                            <!--begin::Card-->
                            <div class="card h-md-100">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-clear d-flex flex-column flex-center" id="add-role-btn" data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                                        <!--begin::Illustration-->
                                        <img src="{{ asset('dashboard-assets/media/illustrations/sketchy-1/4.png') }}" alt="" class="mw-100 mh-150px mb-7"><!--end::Illustration-->

                                        <!--begin::Label-->
                                        <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">{{ __("admin.add") }} {{ __("admin.Role") }}</div><!--end::Label-->
                                    </button><!--begin::Button-->
                                </div><!--begin::Card body-->
                            </div><!--begin::Card-->
                        </div><!-- end   :: Add Role -->
                    </div><!--end::Row-->
                    <!--begin::Modals-->

                    <!--begin::Modal - Add role-->
                    <div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-750px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">{{ __("admin.add") }} {{ __("admin.Role") }}</h2><!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                                        <i class="ki-duotone ki-cross fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div><!--end::Close-->
                                </div><!--end::Modal header-->

                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-lg-5 my-7">
                                    <!--begin::Form-->
                                    <form id="role_form_add" data-form-type="add" method="POST" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('roles.store') }}" data-redirection-url="/dashboard/roles">
                                    @csrf
                                    <!--begin::Scroll-->
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px" style="max-height: 637px;">
                                            <!-- begin :: Row -->
                                            <div class="row mb-8">
                                                <!-- begin :: Column -->
                                                <div class="col-md-6 fv-row">
                                                    <label class="fs-5 fw-bold mb-2">{{ __("admin.Name") }}</label>
                                                    <input type="text" class="form-control gui-input" name="name" id="name_inp"/>
                                                    <p class="invalid-feedback" id="name" ></p>
                                                </div><!-- end   :: Column -->
                                            </div><!-- end   :: Row -->

                                            <!--begin::Permissions-->
                                            <div class="fv-row">

                                                <div class="text-center m-auto" style="width:fit-content">
                                                    <p class="bg-danger invalid-feedback text-white rounded p-2" id="permissions" ></p>
                                                </div>

                                                <!--begin::Label-->
                                                <label class="fs-5 fw-bolder form-label mb-2">{{ __("admin.Role-Permissions") }}</label>
                                                <!--end::Label-->
                                                <!--begin::Table wrapper-->
                                                <div class="table-responsive">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                        <!--begin::Table body-->
                                                        <tbody class="text-gray-600 fw-bold">

                                                        <!--begin::Table row-->
                                                        <tr>
                                                            <td class="text-gray-800">{{ __('admin.Administrator-Access') }}
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="{{__("Allows a full access to the system")}}" aria-label="{{__("Allows a full access to the system")}}"></i></td>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <label class="form-check form-check-custom form-check-solid me-9">
                                                                    <input class="form-check-input" type="checkbox"  id="add-select-all" data-form-type="add" >
                                                                    <span class="form-check-label" for="add-select-all" >{{ __("admin.Select-all") }}</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                        </tr>
                                                        <!--end::Table row-->

                                                        @foreach($modules as $module)

                                                            <tr>
                                                                <!--begin::Label-->
                                                                <td class="text-gray-800"> {{ __(ucwords( str_replace('_' , ' ' , $module) ))  }} </td>
                                                                <!--end::Label-->
                                                                <!--begin::Input group-->
                                                                <td>
                                                                    <!--begin::Wrapper-->
                                                                    <div class="d-flex">
                                                                    @foreach($permissions->where('category', $module) as $permission)

                                                                        <!--begin::Checkbox-->
                                                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                            <input class="form-check-input add-checkbox" type="checkbox" id="add_{{$permission->name}}" data-id="{{$permission->id}}"  name="permissions[]" >
                                                                            <label  class="custom-control-label mx-4" for="add_{{$permission->name}}">{{ __($permission->action ) }}</label>
                                                                        </label><!--end::Checkbox-->
                                                                        @endforeach
                                                                    </div><!--end::Wrapper-->
                                                                </td><!--end::Input group-->
                                                            </tr>
                                                        @endforeach
                                                        </tbody><!--end::Table body-->
                                                    </table><!--end::Table-->
                                                </div><!--end::Table wrapper-->
                                            </div><!--end::Permissions-->
                                        </div><!--end::Scroll-->

                                        <!--begin::Actions-->
                                        <div class="text-center pt-4">
                                            <button type="submit" class="btn btn-primary" id="submit-btn" data-kt-roles-modal-action="submit">
                                                <span class="indicator-label">{{ __("admin.save") }}</span>
                                                <span class="indicator-progress">{{ __('admin.please-wait') }}
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                            <div class="btn btn-secondary" onclick="$('#kt_modal_add_role').modal('hide')" data-kt-roles-modal-action="close">
                                                {{__("admin.cancel")}}
                                            </div>
                                        </div><!--end::Actions-->

                                    </form><!--end::Form-->
                                </div><!--end::Modal body-->
                            </div><!--end::Modal content-->
                        </div><!--end::Modal dialog-->
                    </div><!--end::Modal - Add role-->


                    <!-- begin :: Update role modal -->
                    <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-750px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bolder">{{ __('admin.edit') }} {{ __('admin.Role') }}</h2><!--end::Modal title-->

                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" onclick="$('#kt_modal_update_role').modal('hide')" data-kt-roles-modal-action="close">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                                            </svg>
                                        </span>
                                    </div><!--end::Close-->
                                </div><!--end::Modal header-->

                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 my-7">
                                    <!--begin::Form-->
                                    <form id="role_form_update" data-form-type="update" class="form fv-plugins-bootstrap5 fv-plugins-framework" method="POST" data-redirection-url="/dashboard/roles" data-trailing="_edit" >
                                    @csrf
                                    @method('PUT')
                                    <!--begin::Scroll-->
                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px" style="max-height: 637px;">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-10 fv-plugins-icon-container">
                                                <!-- begin :: Row -->
                                                <div class="row mb-8">
                                                    <!-- begin :: Column -->
                                                    <div class="col-md-6 fv-row">
                                                        <label class="fs-5 fw-bold mb-2">{{ __("admin.Name") }}</label>
                                                        <input type="text" class="form-control" id="name_inp_edit" name="name" />
                                                        <p class="invalid-feedback" id="name_edit" ></p>
                                                    </div><!-- end   :: Column -->
                                                </div><!-- end   :: Row -->
                                                <!--end::Input group-->

                                                <!--begin::Permissions-->
                                                <div class="fv-row">
                                                    <div class="text-center m-auto" style="width:fit-content">
                                                        <p class="bg-danger invalid-feedback text-white rounded p-2" id="permissions_edit" ></p>
                                                    </div>
                                                    <!--begin::Label-->
                                                    <label class="fs-5 fw-bolder form-label mb-2">{{ __("admin.Role-Permissions") }}</label><!--end::Label-->

                                                    <!--begin::Table wrapper-->
                                                    <div class="table-responsive">
                                                        <!--begin::Table-->
                                                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                            <!--begin::Table body-->
                                                            <tbody class="text-gray-600 fw-bold">
                                                            <!--begin::Table row-->
                                                            <tr>
                                                                <td class="text-gray-800">{{ __('admin.Administrator-Access') }}
                                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Allows a full access to the system" aria-label="Allows a full access to the system"></i>
                                                                </td>
                                                                <td>
                                                                    <!--begin::Checkbox-->
                                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                                        <input class="form-check-input" type="checkbox" id="edit-select-all" data-form-type="update" >
                                                                        <span class="form-check-label" for="edit-select-all" >{{ __("admin.Select-all") }}</span>
                                                                    </label><!--end::Checkbox-->
                                                                </td>
                                                            </tr><!--end::Table row-->

                                                            @foreach($modules as $module)
                                                                <tr>
                                                                    <!--begin::Label-->
                                                                    <td class="text-gray-800"> {{ __(ucwords( str_replace('_' , ' ' , $module) ))  }} </td><!--end::Label-->
                                                                    <!--begin::Input group-->
                                                                    <td>
                                                                        <!--begin::Wrapper-->
                                                                        <div class="d-flex">
                                                                        @foreach($permissions->where('category', $module) as $permission)
                                                                            <!--begin::Checkbox-->
                                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                                <input class="form-check-input edit-checkbox" type="checkbox" id="edit_{{$permission->name}}" data-id="{{$permission->id}}"  name="permissions[]" >
                                                                                <label  class="custom-control-label mx-4" for="edit_{{$permission->name}}">{{ __($permission->action ) }}</label>
                                                                            </label><!--end::Checkbox-->
                                                                        @endforeach
                                                                        </div><!--end::Wrapper-->
                                                                    </td><!--end::Input group-->
                                                                </tr>
                                                            @endforeach

                                                            </tbody>
                                                            <!--end::Table body-->
                                                        </table>
                                                        <!--end::Table-->
                                                    </div>
                                                    <!--end::Table wrapper-->
                                                </div>
                                                <!--end::Permissions-->
                                            </div>
                                            <!--end::Scroll-->
                                        </div>

                                        <!--begin::Actions-->
                                        <div class="text-center pt-4 mt-1">
                                            <button type="submit" class="btn btn-primary" id="submit-btn" data-kt-roles-modal-action="submit">
                                                <span class="indicator-label">{{ __("admin.save") }}</span>
                                                <span class="indicator-progress">{{ __("admin.please-wait") }}
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                            <div class="btn btn-secondary" onclick="$('#kt_modal_update_role').modal('hide')" data-kt-roles-modal-action="close">
                                                {{__("admin.cancel")}}
                                            </div>
                                        </div><!--end::Actions-->
                                    </form><!--end::Form-->
                                </div><!--end::Modal body-->
                            </div><!--end::Modal content-->
                        </div><!--end::Modal dialog-->
                    </div><!-- end   :: Update role modal-->
                </div><!--end::Content container-->
            </div><!--end::Content-->
        </div><!--end::Content wrapper-->
    </div><!--end:::Main-->
@endsection
@push('scripts')

    <script>
        // start code for resetting add new role modal
        $("#add-role-btn").click( function () {
            $('.add-checkbox').prop('checked',false);
            removeValidationMessages();
        });// end code for resetting add new role modal
    </script>
    <script>var route = "{{ route('roles.index') }}"; </script>
    <script src="{{ asset('js/dashboard/forms/roles/common.js') }}"></script>
@endpush
