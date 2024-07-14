@extends('dashboard.layouts.app')
@section('page_title', $role->name)
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

                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('roles.index')}}" class="text-muted text-hover-primary">{{__('admin.Roles')}}</a>
                    </li><!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li><!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">{{$role->name}}</li><!--end::Item-->
                @endcomponent<!--end::Page title-->
                </div><!--end::Toolbar container-->
            </div><!--end::Toolbar-->

            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row">
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
                            <!--begin::Card-->
                            <div class="card card-flush">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="mb-0">{{$role->name}}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div><!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Permissions-->
                                    <div class="d-flex flex-column text-gray-600">
                                        @foreach($role->permissions as $permission)
                                        <div class="d-flex align-items-center py-2">
                                            <span class="bullet bg-primary me-3"></span> {{ __( $permission->action ) . ' ' . __( str_replace("_", " " , $permission->category) ) }}
                                        </div>
                                        @endforeach
                                    </div><!--end::Permissions-->
                                </div><!--end::Card body-->

                                <!--begin::Card footer-->
                                <div class="card-footer pt-0">
                                    <button type="button" class="btn btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">{{ __('admin.edit') }} {{ __('admin.Role') }}</button>
                                </div><!--end::Card footer-->
                            </div><!--end::Card-->

                            <!--begin::Modal-->
                            <!-- begin :: Update role modal -->
                            <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-750px">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header">
                                            <!-- begin :: Modal title -->
                                            <h2 class="fw-bolder">{{ __('admin.edit') }} {{ __('admin.Role') }}</h2><!-- end   :: Modal title -->

                                            <!-- begin :: Close -->
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
                                            <form id="role_form_update" data-form-type="update" class="form fv-plugins-bootstrap5 fv-plugins-framework" method="POST" data-redirection-url="/dashboard/roles/{{ $role['id'] }}" data-trailing="_edit" >
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
                                                                <input type="text" class="form-control gui-input" id="name_inp_edit" name="name" value="{{ $role['name'] }}" />
                                                                <p class="invalid-feedback" id="name_edit" ></p>
                                                            </div><!-- end   :: Column -->
                                                        </div><!-- end   :: Row -->
                                                        <!--end::Input group-->

                                                        <!--begin::Permissions-->
                                                        <div class="fv-row">

                                                            <div class="text-center m-auto" style="width:fit-content">
                                                                <p class="bg-danger invalid-feedback text-white rounded p-2" id="abilities_edit" ></p>
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
                                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Allows a full access to the system" aria-label="Allows a full access to the system"></i></td>
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
                                                                            <td class="text-gray-800"> {{ __((str_replace("_", " " , ucwords( $module ))))  }} </td><!--end::Label-->

                                                                            <!--begin::Input group-->
                                                                            <td>
                                                                                <!--begin::Wrapper-->
                                                                                <div class="d-flex">
                                                                                @foreach($permissions->where('category', $module) as $permission)
                                                                                    <!--begin::Checkbox-->
                                                                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                                        <input class="form-check-input edit-checkbox" @if($role->permissions->contains('id', $permission->id)) checked @endif type="checkbox" id="edit_{{$permission->name}}" value="{{$permission->id}}" data-id="{{$permission->id}}"  name="permissions[]" >
                                                                                        <label  class="custom-control-label mx-4" for="edit_{{$permission->name}}">{{ __($permission->action ) }}</label>
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
                            <!--end::Modal-->
                        </div>
                        <!--end::Sidebar-->
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid ms-lg-10">
                            <!--begin::Card-->
                            <div class="card card-flush mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header pt-5">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="d-flex align-items-center">{{__('admin.Admins-Assigned')}}
                                            <span class="text-gray-600 fs-6 ms-1">( {{ $role->admins->count() }} )</span></h2>
                                    </div><!--end::Card title-->
                                </div><!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_roles_view_table">
                                        <thead>
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-50px">#</th>
                                            <th class="min-w-150px">{{__('admin.Admin')}}</th>
                                            <th class="min-w-125px">{{__('admin.Joined-Date')}}</th>
                                            <th class="text-end min-w-100px">{{__('admin.Actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                        @foreach($role->admins as $admin)
                                        <tr>
                                            <td>{{$admin->id}}</td>
                                            <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="#">
                                                        <div class="symbol-label">
                                                            <img src="{{asset('dashboard-assets/media/avatars/300-6.jpg')}}" alt="Emma Smith" class="w-100" />
                                                        </div>
                                                    </a>
                                                </div><!--end::Avatar-->

                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:void(0);" class="text-gray-800 text-hover-primary mb-1">{{$admin->first_name . ' ' . $admin->last_name}}</a>
                                                    <span>{{$admin->email}}</span>
                                                </div>
                                                <!--begin::User details-->
                                            </td>
                                            <td>{{$admin->createsince}}</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{__('admin.Actions')}}
                                                    <i class="ki-duotone ki-down fs-5 m-0"></i>
                                                </a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="{{route('admins.edit', $admin->id)}}" class="menu-link px-3 d-flex justify-content-between" >
                                                            <span>{{__('admin.edit')}}</span>

                                                            <span>  <i class="fa fa-edit text-primary"></i> </span>
                                                        </a>
                                                    </div><!--end::Menu item-->
                                                </div><!--end::Menu-->
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table><!--end::Table-->
                                </div><!--end::Card body-->
                            </div><!--end::Card-->
                        </div><!--end::Content-->
                    </div><!--end::Layout-->
                </div><!--end::Content container-->
            </div><!--end::Content-->
        </div><!--end::Content wrapper-->
    </div><!--end:::Main-->
@endsection

<script src="{{ asset('js/dashboard/forms/roles/common.js') }}"></script>
<script>
    let roleId = "{{ $role['id'] }}"
</script>

