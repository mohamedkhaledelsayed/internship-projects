
 <!--begin::Sidebar-->
 <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
     <!--begin::Wrapper-->
     <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper">
         <div class="hover-scroll-y my-5 my-lg-2 mx-4" data-kt-scroll="true"
             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper"
             data-kt-scroll-offset="5px">
             <!--begin::Sidebar menu-->
             <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
                 class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-3 mb-5">
                 <!--begin:Menu item-->
                 <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                     <!--begin:Menu link-->
                     <a class="menu-link {{ prefixActive('dashboard') }}" href="{{ route('index') }}">

                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-outline ki-home-2 fs-2"></i>
                             </span>
                             <span class="menu-title">{{ __('admin.Dashboard') }}</span>
                     </a>
                     </span>
                     <!--end:Menu link-->
                     <!--begin:Menu sub-->
                     <div class="menu-sub menu-sub-accordion">
                         <!--begin:Menu item-->
                         <div class="menu-item">
                             <!--begin:Menu link-->
                             <a class="menu-link {{ prefixActive('admins') }}" href="{{ route('admins.index') }}">
                                 <span class="menu-bullet">
                                     <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{ __('admin.Admins') }}</span>
                             </a>
                             <!--end:Menu link-->
                         </div>
                         <!--end:Menu item-->
                         <!--begin:Menu item-->
                         <div class="menu-item">
                             <!--begin:Menu link-->
                             <a class="menu-link {{ prefixActive('roles') }}" href="{{ route('roles.index') }}">
                                 <span class="menu-bullet">
                                     <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{ __('admin.Roles & Permissions') }}</span>
                             </a>
                             <!--end:Menu link-->
                         </div>
                         <!--end:Menu item-->

                         <!--begin:Menu item-->
                         <div class="menu-item">
                             <!--begin:Menu link-->
                             <a class="menu-link {{ prefixActive('users') }}" href="{{ route('users.index') }}">
                                 <span class="menu-bullet">
                                     <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{ __('admin.Users') }}</span>
                             </a>
                             <!--end:Menu link-->
                         </div>
                         <!--end:Menu item-->

                         <!--begin:Menu item-->
                         {{-- <div class="menu-item">
                             <!--begin:Menu link-->
                             <a class="menu-link {{ prefixActive('categories') }}"
                                 href="{{ route('categories.index') }}">
                                 <span class="menu-bullet">
                                     <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{ __('admin.categories') }}</span>
                             </a>
                             <!--end:Menu link-->
                         </div> --}}
                         <!--end:Menu item-->
                         <!--begin:Menu item-->
                         {{-- <div class="menu-item">
                             <!--begin:Menu link-->
                             <a class="menu-link {{ prefixActive('services') }}" href="{{ route('services.index') }}">
                                 <span class="menu-bullet">
                                     <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{ __('admin.services') }}</span>
                             </a>
                             <!--end:Menu link-->
                         </div> --}}
                         <!--end:Menu item-->
                         <!--begin:Menu item-->
                         {{-- <div class="menu-item">
                             <!--begin:Menu link-->
                             <a class="menu-link {{ prefixActive('experiences') }}"
                                 href="{{ route('experiences.index') }}">
                                 <span class="menu-bullet">
                                     <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{ __('admin.experiences') }}</span>
                             </a>
                             <!--end:Menu link-->
                         </div> --}}
                         <!--end:Menu item-->
                         <!--begin:Menu item-->
                         {{-- <div class="menu-item">
                             <!--begin:Menu link-->
                             <a class="menu-link {{ prefixActive('brands') }}" href="{{ route('brands.index') }}">
                                 <span class="menu-bullet">
                                     <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{ __('admin.brands') }}</span>
                             </a>
                             <!--end:Menu link-->
                         </div> --}}
                         <!--end:Menu item-->
                         <!--begin:Menu item-->
                         {{-- <div class="menu-item">
                             <!--begin:Menu link-->
                             <a class="menu-link {{ prefixActive('awards') }}" href="{{ route('awards.index') }}">
                                 <span class="menu-bullet">
                                     <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{ __('admin.awards') }}</span>
                             </a>
                             <!--end:Menu link-->
                         </div> --}}
                         <!--end:Menu item-->
                         <!--begin:Menu item-->
                         {{-- <div class="menu-item">
                             <!--begin:Menu link-->
                             <a class="menu-link {{ prefixActive('regions') }}" href="{{ route('regions.index') }}">
                                 <span class="menu-bullet">
                                     <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{ __('admin.regions') }}</span>
                             </a>
                             <!--end:Menu link-->
                         </div> --}}
                         <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ prefixActive('settings') }}" href="{{ route('settings.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('admin.settings') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                         {{-- <!--begin:Menu item-->
                         <div class="menu-item">
                             <!--begin:Menu link-->
                             <a class="menu-link {{ prefixActive('packages') }}" href="{{ route('packages.index') }}">
                                 <span class="menu-bullet">
                                     <span class="bullet bullet-dot"></span>
                                 </span>
                                 <span class="menu-title">{{ __('admin.packages') }}</span>
                             </a>
                             <!--end:Menu link-->
                         </div>
                         <!--end:Menu item--> --}}
                     </div>
                     <!--end:Menu sub-->
                 </div>
                 <!--end:Menu item-->


             </div>
             <!--end::Sidebar menu-->

         </div>
     </div>
     <!--end::Wrapper-->
 </div>
 <!--end::Sidebar-->
