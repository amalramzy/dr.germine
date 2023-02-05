{{--<html lang="en">--}}

{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <!-- Tell the browser to be responsive to screen width -->--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="description" content="">--}}
{{--    <meta name="author" content="">--}}
{{--    <!-- Favicon icon -->--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('Icon.png')}}">--}}
{{--    @php--}}
{{--     date_default_timezone_set("Egypt");--}}
{{--    @endphp--}}
{{--    <title>Dr.Germaine Alfred  | {{$service->children_name}} 's prescription  {{date('d-m-Y',strtotime($service->edate))}}</title>--}}
{{--    <link rel="canonical" href="https://www.wrappixel.com/templates/xtremeadmin/" />--}}
{{--    <link href="{{asset('src/assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('dist/js/pages/chartist/chartist-init.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('src/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('src/assets/libs/c3/c3.min.css')}}" rel="stylesheet">--}}
{{--    <link href="https://printjs-4de6.kxcdn.com/print.min.css" rel='stylesheet'>--}}
{{--    <!-- Custom CSS -->--}}
{{--    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">--}}
{{--    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->--}}
{{--    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->--}}
{{--    <!--[if lt IE 9]>--}}
{{--    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>--}}
{{--    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}
{{--<![endif]-->--}}
{{--<link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">--}}
{{--<script src="https://kit.fontawesome.com/8c2459f9f4.js" crossorigin="anonymous"></script>	--}}
{{--<!--<script>window.open(".{{url('/rosheta',$service->id)}}.", '_blank')</script>-->--}}

{{--<link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}

{{--<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&family=Readex+Pro&display=swap" rel="stylesheet">--}}
{{--<script src="https://kit.fontawesome.com/8c2459f9f4.js" crossorigin="anonymous"></script>	--}}
{{--</head>--}}

{{--<body style="font-family: 'Cairo', sans-serif;--}}
{{--font-family: 'Readex Pro', sans-serif;"  onload="window.print()">--}}

{{--   --}}
{{--         --}}
{{--               --}}
{{--                    <!-- This is for the sidebar toggle which is visible on mobile only -->--}}
{{--             --}}
{{--                    <!-- ============================================================== -->--}}
{{--                    <!-- Logo -->--}}
{{--                    <!-- ============================================================== -->--}}
{{--                   --}}
{{--                        <!-- Logo icon -->--}}
{{--                       --}}
{{--                            <!-- dark Logo text -->--}}
{{--                          --}}
{{--                            <!-- Light Logo text -->--}}
{{--                          <img class="fixed-top" src="{{asset('Header.png')}}" width="100%" alt="homepage">--}}
{{--                  --}}
{{--            --}}
{{--                    <!-- ============================================================== -->--}}
{{--                    <!-- End Logo -->--}}
{{--                    <!-- ============================================================== -->--}}
{{--                    <!-- ============================================================== -->--}}
{{--                    <!-- Toggle which is visible on mobile only -->--}}
{{--                    <!-- ============================================================== -->--}}
{{--                    --}}
{{--             --}}
{{--                <!-- ============================================================== -->--}}
{{--                <!-- End Logo -->--}}
{{--                <!-- ============================================================== -->--}}
{{--               --}}
{{--          --}}
{{--  --}}
{{--<div style="height:260px" ></div>--}}
{{--<div class="container d-flex justify-content-center">--}}
{{--    <div class="row">--}}
{{--          <div class="col-md-4 text-start"> <h3>Name : {{$service->children_name}} {{$service->parent_name}}   </h3></div>--}}
{{--           <div class="col-md-4 text-start"> <h3> Age : {{$service->ageE}}</h3></div>--}}
{{--        <div class="col-md-4 " style=" text-align:end;">--}}
{{--            <h2>Date: {{$service->edate}}</h2>--}}
{{--        </div>--}}
{{--        --}}
{{--         <div class="col-md-3"><h2>B.wt : {{$service->weight}}KG </h2></div>--}}
{{--         <div class="col-md-3"><h2>L(HT) : {{$service->height}}CM</h2></div>--}}
{{--          <div class="col-md-3"><h2>HC : {{$service->head}}CM</h2></div>--}}
{{--          <div class="col-md-3" style=" text-align:end;"><h2>Temp : {{$service->temp}}°C</h2></div>--}}
{{--        @if($service->type != 'تطعيم')--}}
{{--        @if(count(json_decode($service->diags)) !=0)--}}
{{--        <div class="col-md-12 ">--}}
{{--             @php--}}
{{--                                                $numItems = count(json_decode($service->diags));--}}
{{--                                                $i = 0;--}}
{{--                                                @endphp--}}
{{--            <h2>Diagonoses : @foreach($service->diags as $diag)--}}
{{--            @if(++$i != $numItems)--}}
{{--{{$diag->diagonoses}} ---}}
{{--@else--}}
{{--{{$diag->diagonoses}}  --}}
{{--@endif--}}
{{--@endforeach </h2> --}}
{{--        </div>--}}
{{--      @endif--}}
{{--      @endif--}}
{{--      --}}

{{--    </div>--}}

{{--</div>--}}


{{--  <hr>--}}

{{--<div class="container "  >--}}
{{--    <div class="row">--}}
{{--        @php--}}
{{--                                                $numItems = count(json_decode($service->meds));--}}
{{--                                                $i = 0;--}}
{{--                                                @endphp--}}
{{--@foreach($service->meds as $mm)--}}

{{--@if($i == 5)--}}
{{--@php--}}
{{--                                          --}}
{{--                                                $i = 0;--}}
{{--                                                @endphp--}}
{{--<div class="col-md-12" style="height:650px"></div>--}}
{{--@else--}}
{{-- <div class="col-md-12 ">--}}
{{--     <div class="row">--}}
{{--         <div class="col-md-1">--}}
{{--              <h3 style=" text-align:end;font-size:25px;"> ℛ /</h3>--}}
{{--              </div>--}}
{{--         <div class="col-md-11">--}}
{{--               <h3 style=" text-align:start;font-size:30px;">  {{$mm->medicen_name}}  </h3>--}}
{{--         </div>--}}
{{--         --}}
{{--          --}}
{{--     </div>--}}
{{--   --}}
{{--</div>      --}}

{{--      <div class="col-md-6 text-center">--}}
{{--          --}}
{{--           @if($mm->days != null) <h3 style="font-size:30px; ">  لمدة {{$mm->days}} ايام </h3>@endif--}}
{{--        </div>--}}
{{--        <div class="col-md-6 text-center  " >--}}
{{--            --}}
{{--     @if($mm->dose != null)   <h3 style="font-size:30px;"> {{$mm->dose}} </h3>@endif--}}
{{--        </div>--}}
{{--<div class="col-md-12  " >--}}
{{--    <div class="row">--}}
{{--           <div class="col-md-3">--}}
{{--         @if($mm->med2 != null)     <h3 class="" style="text-align:;font-size:30px;">Alternative ℛ/</h3>@endif--}}
{{--              </div>--}}
{{--         <div class="col-md-9">--}}
{{--           @if($mm->med2 != null)    <h3 style=" text-align:;font-size:30px;">  {{$mm->med2}}  </h3>@endif--}}
{{--         </div>--}}
{{--         --}}
{{--         --}}
{{--          --}}
{{--     </div>--}}
{{--  --}}
{{--    </div>--}}
{{--    --}}

{{--    --}}
{{--      --}}
{{--<div class="col-md-12">--}}
{{--    <h3 class="text-center " style="font-size:30px;"> {{$mm->nots}} </h3>--}}
{{--<p> --}}
{{--<hr style="width:70%;margin-left:15%">--}}
{{--</p>--}}
{{--</div>--}}
{{--@endif--}}
{{--@php --}}
{{--$i++--}}
{{--@endphp--}}
{{--@endforeach--}}
{{--<div class="col-md-12  " >--}}
{{--    <h3  class="text-center " style="font-size:30px;" >   {{$service->doctor_comment}}</h3>--}}
{{--</div>--}}

{{--  </div>--}}

{{--</div>--}}

{{--<footer class="fixed-bottom" style="--}}
{{--  bottom: 0;">--}}
{{--    --}}
{{--    <img src="{{asset('Footer.png')}}" class="" width="100%"  alt="homepage">--}}
{{--</footer>--}}
{{-- --}}
{{--</body>--}}
{{--</html>--}}