<?php
   $setting = \App\Models\Setting::where('id',7)->first();
?>
@include('partials.main')

<head>
    @include('partials.title-meta')
    @include('partials.style')

    @include('partials.head-css')

</head>

<body class="authentication-bg authentication-bg-pattern">
    
<div class="col-md-1 mt-3 mb-2 p-4">
        <select class="form-control changeLang">
            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>EN</option>
            <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>AR</option>
        </select>
    </div>
    
    
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
              
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern">
                      
                       
                        <div class="card-body p-4">
                            
                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            @if($setting->image)
                                            <img src="{{$setting->image}}" alt="" height="60">

                                            @else
                                            <img src="{{$setting->logo}}" alt="" height="60">

                                            @endif
                                        </span>
                                    </a>
                
                                    <a href="" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            @if($setting->image)
                                            <img src="{{$setting->image}}" alt="" height="60">

                                            @else
                                            <img src="{{$setting->logo}}" alt="" height="60">

                                            @endif
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">{{ __('messages.Doctor Enter your email address and password')}}</p>
                            </div>
                            @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{Session::get('error')}}
                            </div>
                            @endif
                            <form method="POST" action="{{route('doctor.login')}}">
                                @csrf
                                <div class="{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                    <label for="emailaddress" class="form-label">{{ __('messages.Email address') }}</label>
                                    <input class="form-control" name="email" type="email" id="emailaddress" placeholder="{{__('messages.Enter your email')}}">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="{{ $errors->has('password') ? ' is-invalid' : '' }} mb-3">
                                    <label for="password" class="form-label">{{ __('messages.Password') }}</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="{{__('messages.Enter your password')}}">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        {{-- <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label> --}}
                                    </div>
                                </div>

                                <div class="text-center d-grid">
                                    <button class="btn" style="background-color: #4ec0e7;color:white;" type="submit">{{ __('messages.Log In') }}</button>
                                </div>

                            </form>

                            

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

    
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->


    {{-- <footer class="footer footer-alt text-center text-white" >
        2015 - <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="" class="text-white">Coderthemes</a> 
    </footer> --}}

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js')}}"></script>
    
</body>
<script type="text/javascript">
      
    var url = "{{ route('changeLang') }}";
  
    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });

   
  
</script>
</html>