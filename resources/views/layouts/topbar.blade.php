<?php
   $logo = \App\Models\Setting::where('id',7)->first();
//    $setting = \App\Models\Setting::where('key','logo')->first();
?>
<!-- Topbar Start -->

<div class="navbar-custom">
    <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-end mb-0">


{{--                <li class="dropdown d-none d-lg-inline-block">--}}
{{--                    <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">--}}
{{--                        <i class="fe-maximize noti-icon"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="dropdown notification-list topbar-dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">--}}
{{--                        <i class="fe-bell noti-icon"></i>--}}
{{--                        <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-end dropdown-lg">--}}
{{--        --}}
{{--                        <!-- item-->--}}
{{--                        <div class="dropdown-item noti-title">--}}
{{--                            <h5 class="m-0">--}}
{{--                                <span class="float-end">--}}
{{--                                    <a href="" class="text-dark">--}}
{{--                                        <small>Clear All</small>--}}
{{--                                    </a>--}}
{{--                                </span>Notification--}}
{{--                            </h5>--}}
{{--                        </div>--}}
{{--        --}}
{{--                        <div class="noti-scroll" data-simplebar>--}}
{{--        --}}
{{--                            <!-- item-->--}}
{{--                            <a href="javascript:void(0);" class="dropdown-item notify-item active">--}}
{{--                                <div class="notify-icon">--}}
{{--                                    <img src="{{ asset('assets/images/users/user-1.jpg')}}" class="img-fluid rounded-circle" alt="" /> </div>--}}
{{--                                <p class="notify-details">Cristina Pride</p>--}}
{{--                                <p class="text-muted mb-0 user-msg">--}}
{{--                                    <small>Hi, How are you? What about our next meeting</small>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--        --}}
{{--                            <!-- item-->--}}
{{--                            <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                                <div class="notify-icon bg-primary">--}}
{{--                                    <i class="mdi mdi-comment-account-outline"></i>--}}
{{--                                </div>--}}
{{--                                <p class="notify-details">Caleb Flakelar commented on Admin--}}
{{--                                    <small class="text-muted">1 min ago</small>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--        --}}
{{--                            <!-- item-->--}}
{{--                            <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                                <div class="notify-icon">--}}
{{--                                    <img src="{{ asset('assets/images/users/user-4.jpg')}}" class="img-fluid rounded-circle" alt="" /> </div>--}}
{{--                                <p class="notify-details">Karen Robinson</p>--}}
{{--                                <p class="text-muted mb-0 user-msg">--}}
{{--                                    <small>Wow ! this admin looks good and awesome design</small>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--        --}}
{{--                            <!-- item-->--}}
{{--                            <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                                <div class="notify-icon bg-warning">--}}
{{--                                    <i class="mdi mdi-account-plus"></i>--}}
{{--                                </div>--}}
{{--                                <p class="notify-details">New user registered.--}}
{{--                                    <small class="text-muted">5 hours ago</small>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--        --}}
{{--                            <!-- item-->--}}
{{--                            <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                                <div class="notify-icon bg-info">--}}
{{--                                    <i class="mdi mdi-comment-account-outline"></i>--}}
{{--                                </div>--}}
{{--                                <p class="notify-details">Caleb Flakelar commented on Admin--}}
{{--                                    <small class="text-muted">4 days ago</small>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--        --}}
{{--                            <!-- item-->--}}
{{--                            <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
{{--                                <div class="notify-icon bg-secondary">--}}
{{--                                    <i class="mdi mdi-heart"></i>--}}
{{--                                </div>--}}
{{--                                <p class="notify-details">Carlos Crouch liked--}}
{{--                                    <b>Admin</b>--}}
{{--                                    <small class="text-muted">13 days ago</small>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--        --}}
{{--                        <!-- All-->--}}
{{--                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">--}}
{{--                            View all--}}
{{--                            <i class="fe-arrow-right"></i>--}}
{{--                        </a>--}}
{{--        --}}
{{--                    </div>--}}
{{--                </li>--}}

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        {{-- <img src="assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle"> --}}
                        <span class="pro-user-name ms-1">
                            @if(\Illuminate\Support\Facades\Auth::guard('admin')->user())
                            {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}
                            @elseif(\Illuminate\Support\Facades\Auth::guard('doctor')->user())
                            {{\Illuminate\Support\Facades\Auth::guard('doctor')->user()->name}}
                             @endif
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                        <!-- item-->
                        {{-- <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>Settings</span>
                        </a> --}}
                        {{-- <a href="@if(session()->get('locale') == 'en'){{route('changeLang')}}"></a> --}}

                        <!-- item-->
                        <div class="mt-2">
                            {{-- <select class="form-control changeLang" style="text-align: center">

                                <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>{{__('messages.English')}}</option>
                                <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>{{__('messages.Arabic')}}</option>
                            </select> --}}
                            @if( session()->get('locale') == 'ar')
                                <a class="dropdown-item notify-item" href="{{ url('lang/change?lang=en')}}">English</a>
                            @else

                                <a class="dropdown-item notify-item" href="{{ url('lang/change?lang=ar')}}">Arabic</a>
                           @endif
                        </div>


                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        @if(\Illuminate\Support\Facades\Auth::guard('admin')->user())
                        <a href="{{route('admin.logout')}}" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>{{__('messages.Logout')}}</span>
                        </a>
                        @elseif(\Illuminate\Support\Facades\Auth::guard('doctor')->user())
                        <a href="{{route('doctor.logout')}}" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>{{__('messages.Logout')}}</span>
                        </a>
                        @endif


                    </div>
                </li>



            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{route('dashboard')}}" class="logo logo-light text-center">
                    <span class="logo-sm">
                        @if($logo->image)
                        <img src="{{$logo->image}}" alt="" height="50">


                        @else
                        <img src="{{$logo->value}}" alt="" height="50">

                         @endif
                        </span>
                    <span class="logo-lg">
                        @if($logo->image)
                        <img src="{{$logo->image}}" alt="" height="50">


                        @else
                        <img src="{{$logo->value}}" alt="" height="50">

                         @endif                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect waves-light">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <!-- Mobile menu toggle (Horizontal Layout)-->
                    <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

                {{-- <li class="dropdown d-none d-xl-block">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        Create New
                        <i class="mdi mdi-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="fe-briefcase me-1"></i>
                            <span>New Projects</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="fe-user me-1"></i>
                            <span>Create Users</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="fe-bar-chart-line- me-1"></i>
                            <span>Revenue Report</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="fe-settings me-1"></i>
                            <span>Settings</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="fe-headphones me-1"></i>
                            <span>Help & Support</span>
                        </a>

                    </div>
                </li> --}}

                {{-- <li class="dropdown dropdown-mega d-none d-xl-block">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        Mega Menu
                        <i class="mdi mdi-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-megamenu">
                        <div class="row">
                            <div class="col-sm-8">

                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="text-dark mt-0">UI Components</h5>
                                        <ul class="list-unstyled megamenu-list">
                                            <li>
                                                <a href="javascript:void(0);">Widgets</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Nestable List</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Range Sliders</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Masonry Items</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Sweet Alerts</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Treeview Page</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Tour Page</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <h5 class="text-dark mt-0">Applications</h5>
                                        <ul class="list-unstyled megamenu-list">
                                            <li>
                                                <a href="javascript:void(0);">eCommerce Pages</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">CRM Pages</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Email</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Calendar</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Team Contacts</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Task Board</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Email Templates</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <h5 class="text-dark mt-0">Extra Pages</h5>
                                        <ul class="list-unstyled megamenu-list">
                                            <li>
                                                <a href="javascript:void(0);">Left Sidebar with User</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Menu Collapsed</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Small Left Sidebar</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">New Header Style</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Search Result</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Gallery Pages</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Maintenance & Coming Soon</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="text-center mt-3">
                                    <h3 class="text-dark">Special Discount Sale!</h3>
                                    <h4>Save up to 70% off.</h4>
                                    <button class="btn btn-primary rounded-pill mt-3">Download Now</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </li> --}}
            </ul>
        {{-- <div class="clearfix"></div> --}}
    </div>
</div>
<!-- end Topbar -->
