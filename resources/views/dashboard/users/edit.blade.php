@extends('dashboard.layouts.app')
@section('page_title', __('admin.edit') .' '. __('admin.User') )

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar d-flex flex-stack mb-3 mb-lg-5" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            @component('dashboard.components.breadcrumb')
                @slot('titleBreadcrumb')
                    {{__('admin.Users')}}
                @endslot

                <li class="breadcrumb-item text-muted">
                    <a href="{{route('users.index')}}" class="text-muted text-hover-primary">{{__('users')}}</a>
                </li><!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li><!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">{{$user->first_name . ' '. $user->last_name}}</li><!--end::Item-->
            @endcomponent<!--end::Page title-->
        </div><!--end::Container-->
    </div><!--end::Toolbar-->

    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <div class="card mb-5 mb-xl-10">
            {{-- @dd($errors) --}}
            <!-- begin :: Card body -->
            <div class="card-body">
                {{-- @dd($errors) --}}
                <!-- begin :: Form -->
                <form action="{{ route('users.update', $user->id)}}" enctype="multipart/form-data" class="form" method="post" id="submitted-form" data-redirection-url="{{ route('users.index') }}" >
                @csrf
                @method('PUT')
                <!-- begin :: Card header -->
                    <div class="card-header d-flex align-items-center">
                        <h3 class="fw-bolder text-dark p-">{{ __('admin.edit') .' '. __('admin.User') }}</h3>
                    </div><!-- end   :: Card header -->

                    @include(checkView('dashboard.users.form'))

                    <div class="row mb-8">
                       
                        <!-- begin :: Column -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-5 fw-bold mb-2 required">{{ __("admin.Password-confirmation") }}</label>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password_confirmation_inp" name="password_confirmation"  autocomplete="off"/>
                                <label for="password_confirmation_inp">{{ __("admin.Enter-the") }} {{ __("admin.Password-confirmation") }}</label>
                            </div>
                            <p class="invalid-feedback" id="password_confirmation" ></p>
                        </div><!-- end   :: Column -->
                    </div><!-- end   :: Row -->
    
    
                    <!-- begin :: Form footer -->
                    <div class="form-footer">
                        <!-- begin :: Submit btn -->
                        <button type="submit" class="btn btn-primary" id="submit-btn">
                            <span class="indicator-label">{{ __("admin.edit") }}</span>
                            <!-- begin :: Indicator -->
                            <span class="indicator-progress">{{ __("admin.please-wait") }}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span><!-- end   :: Indicator -->
                        </button><!-- end   :: Submit btn -->
                        <a class="btn btn-secondary" href="{{ route('users.index')}}"> {{__("admin.cancel")}} </a>
                    </div><!-- end   :: Form footer -->
    
                </form><!-- end   :: Form -->
            </div><!-- end   :: Card body -->
        </div>
    </div>
    
    @endsection