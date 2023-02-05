<?php
   $logo = \App\Models\Setting::where('id',7)->first();
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

                                @if($logo->image)
                                <img src="{{$logo->image}}" alt="" height="60">


                                @else
                                <img src="{{$logo->value}}" alt="" height="60">

                                 @endif
                                <p class="text-muted mt-3">{{ __('messages.Dr Germaine Alfred Dashboard')}}</p>

                                <p class="text-muted mb-4">{{ __('messages.Enter your email address and password')}}</p>
                            </div>
                            @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{Session::get('error')}}
                            </div>
                            @endif

                            {{-- reset Password Form --}}
                            <form method="POST" action="{{ route('updatePassCustom') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            {{-- reset Password Form --}}


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

    <footer class="footer footer-alt text-center text-white" >
        <h3 class="copyright w-100 text-center"
        style="color:#fff;margin-bottom:5px;margin-top:1px; font-size:12px;">Copyright 2022
        <i style="backgroung-color:#fff;" class="far fa-copyright"></i> <a
            href="https://prominaagency.com/" target="_blank"> <img src="https://germainealfred.com/Icon2.png"
                style="display: inline-block;width: 20px;margin: 0 5px; ">ProMina Agency</a> All Rights Reserved
    </h3>
    </footer>

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
