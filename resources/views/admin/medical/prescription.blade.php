<?php
    $language = str_replace('_', '-', app()->getLocale());
    if ($language == 'ar') {
        $textdir = 'rtl';
    } else {
        $textdir = 'ltr';
    }
    $date = Illuminate\Support\Carbon::parse($reservation->special_datetime)->translatedFormat('d-m-Y');
    $calc = date_diff(date_create($child->birthdate), date_create($date));
    $day  = $calc->format('%d days');
    $month  = $calc->format('%m months');
    $year  = $calc->format('%y years');

    $logo = \App\Models\Setting::where('id',7)->first();
//    $setting = \App\Models\Setting::where('key','logo')->first();
?>



    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="<?php echo $textdir; ?>">
<head>

    @include("partials.title-meta")
    {{-- @include('partials.style') --}}
    <!-- plugin css -->
    <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet"
          type="text/css"/>

    <link href="{{url('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <link href="{{url('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    @yield('styles')
    @include('partials.head-css')
<link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400&family=Readex+Pro:wght@200;300;400&display=swap');
    </style></head>
<body data-theme="light" data-layout-mode="horizontal" data-topbar-color="dark" data-menu-position="fixed" onload="window.print()">

<!-- Begin page -->
<div id="wrapper" class="main">
    {{-- <div class="content-page"> --}}
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
{{-- @section('content') --}}
    <div class="container text-center">

        <div class="row header-e" >
                <div class="col">
                    <div class="header-col1">
                        <h3>{{$doctor_name_english->value}}</h3>
                        <p>{{$job_title1_english->value}}</p>
                        <p>{{$job_title2_english->value}}</p>
                        <p>{{$job_title3_english->value}}</p>
                        <p class="title4" >{{$job_title4_english->value}}</p>
                      
                        <p style="font-size: 10px;">for Neonatal and Preterm Care (ESNPC)</p>
                    </div>
                    
                  </div>
                  <div class="col">
                    <span class="logo-sm">
                     @if($logo2->image2)
                     <img src="{{$logo2->image2}}" alt="" height="200px">

                    @else
                        <img src="{{$logo2->value}}" alt="" height="200px">
                      @endif         
                        </span>
                  </div>
                  <div class="col">
                    <div class="header-col2">
        
                    <h3>{{$doctor_name_arabic->value}}</h3>
                    <p>{{$job_title1_arabic->value}}</p>
                    <p>{{$job_title2_arabic->value}}</p>
                    <p>{{$job_title3_arabic->value}}</p>
                    <p>{{$job_title4_arabic->value}}</p>
                    <p>لرعاية حديثى الولادة والمبتسرين</p>
                    </div>
                  </div>
         
        </div>
        <div class="header-line" >
            <div class="row mt-3 head">
                <div class="col">
                    <p>Name: {{$child->name}} {{$user->father}} </p>
                </div>
                <div class="col">
                    <p>Age: {{$year}} {{$month}} {{$day}} </p>
    
                </div>
                <div class="col">
                    <p>Date: {{$date}} </p>
    
                </div>
    
            </div>
    
            <div class="row mt-2 head">
                <div class="col">
                    <p>B.wt : {{$reservation->weight}} KG </p>
                </div>
                <div class="col">
                    <p>L(HT): {{$reservation->height}} CM </p>
    
                </div>
                <div class="col">
                    <p>HC: {{$reservation->head_size}} CM </p>
    
                </div>
                <div class="col">
                    <p>Temp: {{$reservation->temperature}} C </p>
    
                </div>
    
            </div>
            <div class="row mt-2 head2" >
                <div class="col">
                    <p>Diagonoses : 
                        @foreach($reservation->diagnostics as $key => $diagn)
                        {{$diagn->name}} -
                        @endforeach
                    </p>
                </div>
              
    
            </div>
        </div>
        <div> 
            @foreach($reservation->medicines as $key => $medicine)
            
        

            <div class="row medical" >
                <div class="col">
                    <p><img src="{{asset('assets/images/icons/r.png')}}" >{{$medicine->name}} </p>
                </div>
            </div>
            @endforeach
            <div class="row" >
                <div class="col title-center" >
                    <h3 >ABC DEF GHI</h3>

                </div>
                
            </div>
           
        </div>
        <div>
<div class="row">
    <div class="col" style="border-top:#4ec0e7 solid 2px; ">
       
                <p class="footer-sheet"><img src="{{asset('assets/images/icons/icon1.png')}}"> Clinc : {{$clinc->value}}</p>
            
       
       {{-- <Span></Span> --}}
        {{-- <img  src="{{asset('assets/images/Footer.png')}}" height="200px"> --}}
    </div>
</div>
<div class="row">
    <div class="col">

    <p class="footer-sheet"><img src="{{asset('assets/images/icons/icon2.png')}}"> Tel.  :   {{$tel->value}}</p>
    <p class="footer-sheet"><img src="{{asset('assets/images/icons/icon4.png')}}"> Mob. : {{$mobile->value}}</p>


    </div>
    <div class="col">
        
            <p style="font-size: 14px;"  class="footer-sheet"><img src="{{asset('assets/images/icons/icon3.png')}}"> Hospital : {{$hospital->value}}</p>
            <p style="font-size: 14px;" class="footer-sheet"><img src="{{asset('assets/images/icons/icon5.png')}}"> Email : {{$email->value}}</p>

       
    </div>
</div>
<div class="row">
    <div class="col">
        <p class="footer-sheet">الاستشارة خلال اسبوع من تاريخ الكشف - نرجو احضار الروشتة في الاستشارة</p> 

    </div>
</div>
        </div>
      
      </div>
        

{{-- @endsection --}}
</div>
        </div>
    {{-- </div> --}}
</div>
<!-- Vendor js -->
<script src="{{url('assets/js/vendor.min.js')}}"></script>

<!-- Head js -->
<script src="{{ asset('assets/js/head.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="application/javascript" src="{{ mix('/js/app.js') }}"></script>

<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>


@yield('scripts')
</body>
@include('partials.lang')
</html>