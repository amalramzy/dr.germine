<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

{{--                    @if(\Illuminate\Support\Facades\Auth::guard('admin')->user()->type == "admin")--}}
                        <li class="nav-item ">
                            <div >
                                <a href="{{route('active.reservation')}}" class="nav-link">{{__('messages.Doctor')}}</a>
                            </div>
                        </li>
{{--                    @endif--}}

{{--                    <li class="nav-item ">--}}
{{--                        <div >--}}
{{--                            <a href="{{route('admins.index')}}" class="nav-link"> {{ __('messages.Admins')}}</a>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    {{-- <li class="nav-item ">
                        <div >
                            <a href="{{route('doctors.index')}}" class="nav-link">{{ __('messages.Doctors')}}</a>
                        </div>
                    </li> --}}
                    {{-- <li class="nav-item ">
                        <div >
                            <a href="{{route('area.index')}}" class="nav-link"> {{ __('messages.Area')}}</a>
                        </div>
                    </li> --}}
{{--                    <li class="nav-item ">--}}
{{--                        <div >--}}
{{--                            <a href="{{route('setting.index')}}" class="nav-link">{{__('messages.Settings')}}</a>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    {{-- <li class="nav-item ">
                        <div >
                            <a href="{{route('blog.index')}}" class="nav-link"> {{__('messages.Blog')}}</a>
                        </div>
                    </li> --}}
                    {{-- <li class="nav-item ">
                        <div >
                            <a href="{{route('vlog.index')}}" class="nav-link"> {{__('messages.Vlog')}}</a>
                        </div>
                    </li> --}}
                    {{-- <li class="nav-item ">
                        <div >
                            <a href="{{route('clinc.index')}}" class="nav-link"> {{__('messages.Clinc')}}</a>
                        </div>
                    </li> --}}

                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-grid me-1"></i> {{__('messages.Features')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">

                            <a href="{{route('clinc.index')}}" class="dropdown-item"><i class="fe-home"></i> {{__('messages.Clinc')}}</a>
                            <a href="{{route('blog.index')}}" class="dropdown-item"><i class="fe-message-square me-1"></i> {{__('messages.Blog')}}</a>

                            <a href="{{route('vlog.index')}}" class="dropdown-item"><i class="fe-video"></i> {{__('messages.Vlog')}} </a>

                            <a href="{{route('doctors.index')}}" class="dropdown-item"><i class="fe-rss me-1"></i> {{__('messages.Doctors')}} </a>

                        </div>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-arrow-down-circle me-1"></i> {{__('messages.Visits')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="{{route('visit.current')}}" class="dropdown-item"><i class="fe-file-text me-1"></i>{{__('messages.Current')}} </a>

                            <a href="{{route('available.followUp')}}" class="dropdown-item"><i class="fe-clipboard me-1"></i> {{__('messages.Available Follow Ups')}}</a>

                            {{-- <a href="{{route('reservation.index')}}" class="dropdown-item"><i class="fe-calendar"></i> {{__('messages.Reservation')}}</a> --}}
                            <a href="{{route('visit.previous')}}" class="dropdown-item"><i class="fe-clock me-1"></i> {{__('messages.Previous')}}</a>


{{--                            <a href="{{route('represervation.index')}}" class="dropdown-item"><i class="fe-rss me-1"></i>{{__('messages.Medical Rep Visits')}} </a>--}}
                            <a href="{{route('rep.visit.previous')}}" class="dropdown-item"><i class="fe-shopping-bag me-1"></i>{{__('messages.Medical Rep Visits Pervious')}} </a>

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-arrow-down-circle me-1"></i> {{__('messages.Users')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">

                            <a href="{{route('users.index')}}" class="dropdown-item"><i class="fe-user"></i> {{__('messages.User')}}</a>
                            <a href="{{route('children.index')}}" class="dropdown-item"><i class="fe-github me-1"></i> {{__('messages.Child')}}</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-arrow-down-circle me-1"></i> {{__('messages.Sale Person')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="{{route('sale-persons.index')}}" class="dropdown-item"><i class="fe-users me-1"></i>{{__('messages.Sale Person')}} </a>
                            <a href="{{route('medical-rep-requests.index')}}" class="dropdown-item"><i class="fe-watch me-1"></i>{{__('messages.Sale Person Requests')}} </a>

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-arrow-down-circle me-1"></i> {{__('messages.Medicalest')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">

                            <a href="{{route('diagnostic.index')}}" class="dropdown-item"><i class="fe-archive me-1"></i> {{__('messages.Diagnostic')}}</a>
                            <a href="{{route('medicine.index')}}" class="dropdown-item"><i class="fe-activity me-1"></i> {{__('messages.Medicine')}}</a>

                            <a href="{{route('dose.index')}}" class="dropdown-item"><i class="fe-message-square me-1"></i> {{__('messages.Dose')}}</a>
                            <a href="{{route('vaccination.index')}}" class="dropdown-item"><i class="fe-briefcase me-1"></i>{{__('messages.Vaccination')}} </a>
                            <a href="{{route('ministry.index')}}" class="dropdown-item"><i class="fe-folder-plus me-1"></i>{{__('messages.Ministry Vaccination')}}</a>

                            <a href="{{route('medicaltest.index')}}" class="dropdown-item"><i class="fe-zoom-in me-1"></i>{{__('messages.Medical Test')}} </a>


                            {{--                                <a href="{{route('xrays.index')}}" class="dropdown-item"><i class="fe-activity me-1"></i> {{__('messages.X-rays')}}</a>--}}

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-arrow-down-circle me-1"></i> {{__('messages.Input')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">

                            <a href="{{route('opening.index')}}" class="dropdown-item"><i class="fe-user"></i>{{ __('messages.Doctor Arrives')}}</a>
                            <a href="{{route('slots.index')}}" class="dropdown-item"><i class="fe-message-square me-1"></i> {{ __('messages.Doctor Appointments')}}</a>

                            <a href="{{route('evaluation.index')}}" class="dropdown-item"><i class="fe-bookmark me-1"></i>{{__('messages.Evaluation')}} </a>
                            <a href="{{route('area.index')}}" class="dropdown-item"><i class="fe-map-pin me-1"></i> {{ __('messages.Areas')}}</a>

                        </div>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-arrow-down-circle me-1"></i> {{__('messages.Expenses')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">


                            <a href="{{route('expenses.index')}}" class="dropdown-item"><i class="fe-trending-down me-1"></i>{{__('messages.Expenses')}} </a>
                            <a href="{{route('revenues.index')}}" class="dropdown-item"><i class="fe-dollar-sign me-1"></i>{{__('messages.Revenues')}} </a>
                            <a href="{{route('summary.index')}}" class="dropdown-item"><i class="fe-rss me-1"></i>{{__('messages.Summary')}} </a>

                        </div>
                    </li>
                        <li class="nav-item ">
                            <div >
                                <a href="{{route('notify.index')}}" class="nav-link arrow-none"> {{__('messages.Notification')}}</a>
                            </div>
                        </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-ui" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-briefcase me-1"></i> UI Elements <div class="arrow-down"></div>
                        </a>

                        <div class="dropdown-menu mega-dropdown-menu dropdown-mega-menu-xl" aria-labelledby="topnav-ui">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div>
                                        <a href="ui-buttons.html" class="dropdown-item">Buttons</a>
                                        <a href="ui-cards.html" class="dropdown-item">Cards</a>
                                        <a href="ui-avatars.html" class="dropdown-item">Avatars</a>
                                        <a href="ui-portlets.html" class="dropdown-item">Portlets</a>
                                        <a href="ui-tabs-accordions.html" class="dropdown-item">Tabs & Accordions</a>
                                        <a href="ui-modals.html" class="dropdown-item">Modals</a>
                                        <a href="ui-progress.html" class="dropdown-item">Progress</a>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <a href="ui-notifications.html" class="dropdown-item">Notifications</a>
                                        <a href="ui-placeholders.html" class="dropdown-item">Placeholders</a>
                                        <a href="ui-offcanvas.html" class="dropdown-item">Offcanvas</a>
                                        <a href="ui-spinners.html" class="dropdown-item">Spinners</a>
                                        <a href="ui-images.html" class="dropdown-item">Images</a>
                                        <a href="ui-carousel.html" class="dropdown-item">Carousel</a>
                                        <a href="ui-list-group.html" class="dropdown-item">List Group</a>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <a href="ui-video.html" class="dropdown-item">Embed Video</a>
                                        <a href="ui-dropdowns.html" class="dropdown-item">Dropdowns</a>
                                        <a href="ui-ribbons.html" class="dropdown-item">Ribbons</a>
                                        <a href="ui-tooltips-popovers.html" class="dropdown-item">Tooltips & Popovers</a>
                                        <a href="ui-general.html" class="dropdown-item">General UI</a>
                                        <a href="ui-typography.html" class="dropdown-item">Typography</a>
                                        <a href="ui-grid.html" class="dropdown-item">Grid</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-layers me-1"></i> Components <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-extendedui"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fe-pocket me-1"></i> Extended UI <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-extendedui">
                                    <a href="extended-nestable.html" class="dropdown-item">Nestable List</a>
                                    <a href="extended-range-slider.html" class="dropdown-item">Range Slider</a>
                                    <a href="extended-dragula.html" class="dropdown-item">Dragula</a>
                                    <a href="extended-animation.html" class="dropdown-item">Animation</a>
                                    <a href="extended-sweet-alert.html" class="dropdown-item">Sweet Alert</a>
                                    <a href="extended-tour.html" class="dropdown-item">Tour Page</a>
                                    <a href="extended-scrollspy.html" class="dropdown-item">Scrollspy</a>
                                    <a href="extended-loading-buttons.html" class="dropdown-item">Loading Buttons</a>
                                </div>
                            </div>
                            <a href="widgets.html" class="dropdown-item"><i class="fe-gift me-1"></i> Widgets</a>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fe-bookmark me-1"></i> Forms <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-form">
                                    <a href="forms-elements.html" class="dropdown-item">General Elements</a>
                                    <a href="forms-advanced.html" class="dropdown-item">Advanced</a>
                                    <a href="forms-validation.html" class="dropdown-item">Validation</a>
                                    <a href="forms-pickers.html" class="dropdown-item">Pickers</a>
                                    <a href="forms-wizard.html" class="dropdown-item">Wizard</a>
                                    <a href="forms-masks.html" class="dropdown-item">Masks</a>
                                    <a href="forms-quilljs.html" class="dropdown-item">Quilljs Editor</a>
                                    <a href="forms-file-uploads.html" class="dropdown-item">File Uploads</a>
                                    <a href="forms-x-editable.html" class="dropdown-item">X Editable</a>
                                    <a href="forms-image-crop.html" class="dropdown-item">Image Crop</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fe-bar-chart-2 me-1"></i> Charts <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                    <a href="charts-apex.html" class="dropdown-item">Apex Charts</a>
                                    <a href="charts-flot.html" class="dropdown-item">Flot Charts</a>
                                    <a href="charts-morris.html" class="dropdown-item">Morris Charts</a>
                                    <a href="charts-chartjs.html" class="dropdown-item">Chartjs Charts</a>
                                    <a href="charts-peity.html" class="dropdown-item">Peity Charts</a>
                                    <a href="charts-chartist.html" class="dropdown-item">Chartist Charts</a>
                                    <a href="charts-c3.html" class="dropdown-item">C3 Charts</a>
                                    <a href="charts-sparklines.html" class="dropdown-item">Sparklines Charts</a>
                                    <a href="charts-knob.html" class="dropdown-item">Jquery Knob Charts</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fe-grid me-1"></i> Tables <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-table">
                                    <a href="tables-basic.html" class="dropdown-item">Basic Tables</a>
                                    <a href="tables-datatables.html" class="dropdown-item">Data Tables</a>
                                    <a href="tables-editable.html" class="dropdown-item">Editable Tables</a>
                                    <a href="tables-responsive.html" class="dropdown-item">Responsive Tables</a>
                                    <a href="tables-footables.html" class="dropdown-item">FooTable</a>
                                    <a href="tables-bootstrap.html" class="dropdown-item">Bootstrap Tables</a>
                                    <a href="tables-tablesaw.html" class="dropdown-item">Tablesaw Tables</a>
                                    <a href="tables-jsgrid.html" class="dropdown-item">JsGrid Tables</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fe-cpu me-1"></i> Icons <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                    <a href="icons-material-symbols.html" class="dropdown-item">Material Symbols Icons</a>
                                    <a href="icons-two-tone.html" class="dropdown-item">Two Tone Icons</a>
                                    <a href="icons-feather.html" class="dropdown-item">Feather Icons</a>
                                    <a href="icons-mdi.html" class="dropdown-item">Material Design Icons</a>
                                    <a href="icons-dripicons.html" class="dropdown-item">Dripicons</a>
                                    <a href="icons-font-awesome.html" class="dropdown-item">Font Awesome 5</a>
                                    <a href="icons-themify.html" class="dropdown-item">Themify</a>
                                    <a href="icons-simple-line.html" class="dropdown-item">Simple Line</a>
                                    <a href="icons-weather.html" class="dropdown-item">Weather</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fe-map me-1"></i> Maps <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-map">
                                    <a href="maps-google.html" class="dropdown-item">Google Maps</a>
                                    <a href="maps-vector.html" class="dropdown-item">Vector Maps</a>
                                    <a href="maps-mapael.html" class="dropdown-item">Mapael Maps</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-package me-1"></i> Pages <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Auth Style 1 <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                    <a href="auth-login.html" class="dropdown-item">Log In</a>
                                    <a href="auth-register.html" class="dropdown-item">Register</a>
                                    <a href="auth-signin-signup.html" class="dropdown-item">Signin - Signup</a>
                                    <a href="auth-recoverpw.html" class="dropdown-item">Recover Password</a>
                                    <a href="auth-lock-screen.html" class="dropdown-item">Lock Screen</a>
                                    <a href="auth-logout.html" class="dropdown-item">Logout</a>
                                    <a href="auth-confirm-mail.html" class="dropdown-item">Confirm Mail</a>
                                </div>
                            </div>

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth2"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Auth Style 2 <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-auth2">
                                    <a href="auth-login-2.html" class="dropdown-item">Log In 2</a>
                                    <a href="auth-register-2.html" class="dropdown-item">Register 2</a>
                                    <a href="auth-signin-signup-2.html" class="dropdown-item">Signin - Signup 2</a>
                                    <a href="auth-recoverpw-2.html" class="dropdown-item">Recover Password 2</a>
                                    <a href="auth-lock-screen-2.html" class="dropdown-item">Lock Screen 2</a>
                                    <a href="auth-logout-2.html" class="dropdown-item">Logout 2</a>
                                    <a href="auth-confirm-mail-2.html" class="dropdown-item">Confirm Mail 2</a>
                                </div>
                            </div>

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-error"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Errors <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-error">
                                    <a href="pages-404.html" class="dropdown-item">Error 404</a>
                                    <a href="pages-404-two.html" class="dropdown-item">Error 404 Two</a>
                                    <a href="pages-404-alt.html" class="dropdown-item">Error 404-alt</a>
                                    <a href="pages-500.html" class="dropdown-item">Error 500</a>
                                    <a href="pages-500-two.html" class="dropdown-item">Error 500 Two</a>
                                </div>
                            </div>

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Utility <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                    <a href="pages-starter.html" class="dropdown-item">Starter</a>
                                    <a href="pages-timeline.html" class="dropdown-item">Timeline</a>
                                    <a href="pages-sitemap.html" class="dropdown-item">Sitemap</a>
                                    <a href="pages-invoice.html" class="dropdown-item">Invoice</a>
                                    <a href="pages-faqs.html" class="dropdown-item">FAQs</a>
                                    <a href="pages-search-results.html" class="dropdown-item">Search Results</a>
                                    <a href="pages-pricing.html" class="dropdown-item">Pricing</a>
                                    <a href="pages-maintenance.html" class="dropdown-item">Maintenance</a>
                                    <a href="pages-coming-soon.html" class="dropdown-item">Coming Soon</a>
                                    <a href="pages-gallery.html" class="dropdown-item">Gallery</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-sidebar me-1"></i> Layouts <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-layout">
                            <a href="layouts-vertical.html" class="dropdown-item">Vertical</a>
                            <a href="layouts-detached.html" class="dropdown-item">Detached</a>
                            <a href="layouts-two-column.html" class="dropdown-item">Two Column Menu</a>
                            <a href="layouts-two-tone-icons.html" class="dropdown-item">Two Tones Icons</a>
                            <a href="layouts-preloader.html" class="dropdown-item">Preloader</a>
                        </div>
                    </li> --}}
                </ul> <!-- end navbar-->
            </div> <!-- end .collapsed-->
        </nav>
    </div> <!-- end container-fluid -->
</div>
