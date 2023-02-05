@include('partials.main')
    <head>

        @include("partials.title-meta")
        @include('partials.style')

        <!-- plugin css -->
        <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />

        @include('partials.head-css')

    </head>

    <!-- body start -->
    <body data-theme="light" data-layout-mode="horizontal" data-topbar-color="dark" data-menu-position="fixed">

        <!-- Begin page -->
        <div id="wrapper">

            
            <!-- Topbar Start -->
            @include('partials.menu')
            <!-- end Topbar -->

            @include('partials.topnav')
            <!-- end topnav-->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                           <!-- start page title -->
                           <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                   
                                    <h4 class="page-title">{{__('messages.Edit Doctor')}}</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                            <div class="card">
                                <div class="card-body">
                     
                        
                    <form method="POST" action="{{ route('doctors.update', [$doctor->id]) }}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name_en" class="form-label">{{ __('messages.Name En') }}</label>
                                <input type="text" class="form-control" id="name_en" name="name_en" value="{{$doctor->getTranslation('name', 'ar')}}" >

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name_ar" class="form-label">{{ __('messages.Name Ar') }}</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{$doctor->getTranslation('name', 'ar')}}">

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('messages.Email address') }}</label>
                                <input type="email" id="email" name="email" required="" class="form-control" value="{{$doctor->email}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('messages.Password') }}</label>
                                <input type="password" id="password" name="password" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="address" class="form-label">{{ __('messages.Address') }}</label>
                                <textarea id="address" name="address" required="" class="form-control">{{$doctor->address}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="bio" class="form-label">{{ __('messages.Bio') }}</label>
                                <textarea id="bio" name="bio" required="" class="form-control">{{$doctor->bio}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="document" class="form-label">{{ __('messages.Documents') }}</label>
                                
                                <input type="file" name="document[]" id="document"  class="form-control form-control-alternative @error('document') is-invalid @enderror" placeholder="{{ __('Documents') }}" multiple><br>
                                <ul>
                                    @if (count(array($doctor->documents)) > 0)
                                          <li>
                                           @foreach($doctor->documents ?? [] as $url)
                                                    <img src="{{$url}}" height="100px" width="100px">
                                           @endforeach
                                         </li>                  
                                    @endif
                                    </ul>

                            </div>
                        </div>

                    </div>
            
        
        
                    
                    <div class="col-md-12">
                        <button class="btn btn-success">{{ __('messages.Save') }}</button>
                   </div>
                   </form>
                                </div>
                            </div>
                    </div>
                
                </div>
            </div>
        </div>
         <!-- Vendor js -->
         <script src="{{asset('assets/js/vendor.min.js')}}"></script>

         <!-- Plugins js-->
         <script src="{{asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
         <script src="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
         <script src="{{asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
 
         <!-- Dashboard 2 init -->
         <script src="{{asset('assets/js/pages/dashboard-2.init.js')}}"></script>
 
         <!-- App js-->
         <script src="{{asset('assets/js/app.min.js')}}"></script>
    </body>
    @include('partials.lang')
    </html>