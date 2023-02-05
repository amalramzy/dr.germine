
@extends('layouts.master')
@section('content')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                    @if(!$errors->isEmpty())
                                        <div class="text-danger pb-4">Ops...
                                            @foreach ($errors->all() as $e)
                                                <li class="text-danger">{{ $e }}</li>
                                            @endforeach
                                        </div>
                                    @endif

                                        <ul class="nav nav-pills navtab-bg nav-justified">
                                            <li class="nav-item">
                                                <a href="#messages1" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                    {{__('messages.Notifications to users')}}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#home1" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                    {{__('messages.Notifications to everyone')}}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#profile1" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                                    {{__('messages.Notifications to delegates')}}
                                                </a>
                                            </li>

                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="home1">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">

                                                                <p></p>
                                                                <div class="row">
                                                                    <div class="col-lg-12">

                                                                        <form   method="POST" action="{{ route('notify.sendalluser') }}">
                                                                            @csrf
                                                                            <input type="hidden" id="type" name="type" value="general">

                                                                            <div class="mb-3">
                                                                                <label for="title" class="form-label">{{__('messages.Title')}}</label>
                                                                                <input type="text" id="title" name="title" class="form-control">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="description" class="form-label">{{__('messages.Description')}}</label>
                                                                                <textarea id="description" name="description" class="form-control"></textarea>
                                                                            </div>


                                                                            <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.Save') }}</button>

                                                                        </form>
                                                                    </div> <!-- end col -->


                                                                </div>
                                                                <!-- end row-->

                                                            </div> <!-- end card-body -->
                                                        </div> <!-- end card -->
                                                    </div><!-- end col -->
                                                </div>
                                                <!-- end row -->
                                            </div>

                                            <div class="tab-pane" id="profile1">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">

                                                                <p></p>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <form   method="POST" action="{{ route('notify.sendallperson') }}">
                                                                            @csrf
                                                                            <input type="hidden" id="type" name="type" value="general">

                                                                            <div class="mb-3">
                                                                                <label for="title" class="form-label">{{__('messages.Title')}}</label>
                                                                                <input type="text" id="title" name="title" class="form-control">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="description" class="form-label">{{__('messages.Description')}}</label>
                                                                                <textarea id="description" name="description" class="form-control"></textarea>
                                                                            </div>
                                                                            <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.Save') }}</button>

                                                                        </form>
                                                                    </div> <!-- end col -->


                                                                </div>
                                                                <!-- end row-->

                                                            </div> <!-- end card-body -->
                                                        </div> <!-- end card -->
                                                    </div><!-- end col -->
                                                </div>
                                                <!-- end row -->
                                            </div>

                                            <div class="tab-pane" id="messages1">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">

                                                            <form   method="POST" action="{{ route('notify.sendselectuser') }}">
                                                                @csrf
                                                                <input type="hidden" id="type" name="type" value="general">

                                                                    <div class="row">
                                                                        <div class="col-lg-12">


                                                                                <div class="mb-3">
                                                                                    <label for="title" class="form-label">{{__('messages.Title')}}</label>
                                                                                    <input type="text" id="title" name="title" class="form-control">
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="description" class="form-label">{{__('messages.Description')}}</label>
                                                                                    <textarea id="description" name="description" class="form-control"></textarea>
                                                                                </div>

                                                                        </div> <!-- end col -->


                                                                    </div>
                                                                    <hr>
                                                                    <!-- end row-->
                                                                    <h4 class="header-title">{{__('messages.Targeting')}}</h4>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h4 class="header-title mt-5 mt-sm-3">{{__('messages.Area')}}</h4>
                                                                            <div class="mt-3">
                                                                                <select class="form-select" name="area_id" id="area_id">
                                                                                    <option selected>{{__('messages.All')}}</option>
                                                                                    @foreach (\App\Models\Area::all() as $area)
                                                                                    <option value="{{ $area->id }}">{{$area->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="mt-3">
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" id="customCheck1" value="male" name="gender[]">
                                                                                    <label class="form-check-label" for="customCheck1">{{__('messages.Male')}}</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" id="customCheck2" value="female" name="gender[]">
                                                                                    <label class="form-check-label" for="customCheck2">{{__('messages.Female')}}</label>
                                                                                </div>
                                                                            </div>
                                                                            <h4 class="header-title mt-5 mt-sm-3">{{__('messages.Age')}}</h4>
                                                                            <div class="mt-3">
                                                                                <div class="form-check">
                                                                                    <input type="radio" id="all" name="age" class="form-check-input" value="all">
                                                                                    <label class="form-check-label" for="all">{{__('messages.All')}}</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="radio" id="select" name="age" class="form-check-input ddd" value="select">
                                                                                    <label class="form-check-label " for="select">{{__('messages.Select')}}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div> <!-- end col -->


                                                                        <br>
                                                                        <div id="showAge" style="display: none">
                                                                            <div class="row mt-4">
                                                                                <div class="col-md-3">

                                                                                    <label for="day" class="form-label">{{ __('messages.From') }}</label>

                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="mb-3">
                                                                                        {{-- <label for="year" class="form-label">{{ __('messages.Year') }}</label> --}}
                                                                                        <input type="number" class="form-control" id="year" name="year1" value="" placeholder="{{ __('messages.Year') }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-3">
                                                                                        <div class="mb-3">
                                                                                            {{-- <label for="month" class="form-label">{{ __('messages.Month') }}</label> --}}
                                                                                            <input type="number" class="form-control" id="month" name="month1" value="" placeholder="{{ __('messages.Month') }}">
                                                                                        </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="mb-3">
                                                                                        {{-- <label for="day" class="form-label">{{ __('messages.From') }}</label> --}}
                                                                                        <input type="number" class="form-control" id="day" name="day1" value="" placeholder="{{ __('messages.Day') }}" >
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="row" >
                                                                                <div class="col-md-3">
                                                                                    <label for="day" class="form-label">{{ __('messages.To') }}</label>

                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="mb-3">
                                                                                        {{-- <label for="year" class="form-label">{{ __('messages.Year') }}</label> --}}
                                                                                        <input type="number" class="form-control" id="year" name="year2" value="" placeholder="{{ __('messages.Year') }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                        <div class="mb-3">
                                                                                            {{-- <label for="month" class="form-label">{{ __('messages.Month') }}</label> --}}
                                                                                            <input type="number" class="form-control" id="month" name="month2" value="" placeholder="{{ __('messages.Month') }}">
                                                                                        </div>
                                                                                </div>

                                                                                <div class="col-md-3">
                                                                                    <div class="mb-3">
                                                                                        {{-- <label for="day" class="form-label">{{ __('messages.From') }}</label> --}}
                                                                                        <input type="number" class="form-control" id="day" name="day2" value="" placeholder="{{ __('messages.Day') }}" >
                                                                                    </div>
                                                                            </div>
                                                                            </div>
                                                                        </div>




                                                                    </div>
                                                                    <!-- end row-->

                                                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-4">{{ __('messages.Save') }}</button>

                                                                </form>
                                                            </div> <!-- end card-body -->
                                                        </div> <!-- end card -->
                                                    </div><!-- end col -->
                                                </div>
                                                <!-- end row -->

                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>

@endsection
@section('scripts')
    <script type="text/javascript">
    $('#page-tage').html('{{__("messages.Notification")}}');

    $(function() {
    $("input[name='age']").click(function() {
      if ($("#select").is(":checked")) {
        $("#showAge").show();
      } else {
        $("#showAge").hide();
      }
    });
  });

        </script>


@endsection
