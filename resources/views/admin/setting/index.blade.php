@extends('layouts.master')
@section('content')
                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                  
                                   

                                    <form   method="POST" action="{{ route('setting.update') }}" enctype="multipart/form-data">
                                        @csrf
                                        {{-- @foreach(\App\Models\Setting::all() as $data) --}}
                                        <div class="row">
                                            {{-- <input type="hidden" name="setting_id" id="setting_id" value="{{$data->id}}"> --}}
                                            <div class="col-md-4 mb-2">
                                             {{-- <input type="hidden" name="setting_id" id="setting_id" value="{{$follow_up->id}}"> --}}

                                                <label for="inputPassword4" class="form-label">{{$follow_up->name}}</label>
                                                 <input type="number" class="form-control" name="follow_up_days" id="inputPassword4" value="{{$follow_up->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {{-- <input type="hidden" name="setting_id" id="setting_id" value="{{$color_create->id}}"> --}}

                                                <label for="inputPassword4" class="form-label">{{$color_create->name}}</label>
                                                 <input type="color" class="form-control" name="color_create" id="inputPassword4" value="{{$color_create->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {{-- <input type="hidden" name="setting_id" id="setting_id" value="{{$color_edit->id}}"> --}}

                                                <label for="inputPassword4" class="form-label">{{$color_edit->name}}</label>
                                                 <input type="color" class="form-control" name="color_edit" id="inputPassword4" value="{{$color_edit->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {{-- <input type="hidden" name="setting_id" id="setting_id" value="{{$color_delete->id}}"> --}}

                                                <label for="inputPassword4" class="form-label">{{$color_delete->name}}</label>
                                                 <input type="color" class="form-control" name="color_delete" id="inputPassword4" value="{{$color_delete->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {{-- <input type="hidden" name="setting_id" id="setting_id" value="{{$color_main->id}}"> --}}

                                                <label for="inputPassword4" class="form-label">{{$color_main->name}}</label>
                                                 <input type="color" class="form-control" name="color_main" id="inputPassword4" value="{{$color_main->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {{-- <input type="hidden" name="setting_id" id="setting_id" value="{{$color_second->id}}"> --}}

                                                <label for="inputPassword4" class="form-label">{{$color_second->name}}</label>
                                                 <input type="color" class="form-control" name="color_second" id="inputPassword4" value="{{$color_second->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {{-- <input type="hidden" name="setting_id" id="setting_id" value="{{$color_second->id}}"> --}}

                                                <label for="image" class="form-label">{{$logo->name}}</label>
                                                 <input type="file" class="form-control" name="image" id="image">
                                                 @if($logo->image)
                                                 <img src="{{$logo->image}}" alt="" width="200px" height="100px">
                         
                                                 @else
                                                 <img src="{{$logo->value}}" alt="" width="200px" height="100px">
                         
                                                  @endif
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {{-- <input type="hidden" name="setting_id" id="setting_id" value="{{$color_second->id}}"> --}}

                                                <label for="photo" class="form-label">{{$gallery->name}}</label>
                                                 <input type="file" class="form-control" name="photo[]" id="photo" multiple>
                                                 <ul>
                                                    @if (count(array($gallery->photos)) > 0)
                                                          <li>
                                                           @foreach($gallery->photos ?? [] as $url)
                                                                    <img src="{{$url}}" height="100px" width="100px">
                                                           @endforeach
                                                         </li>                  
                                                    @endif
                                                    </ul>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {{-- <input type="hidden" name="setting_id" id="setting_id" value="{{$color_second->id}}"> --}}

                                                <label for="image2" class="form-label">{{$logo2->name}}</label>
                                                 <input type="file" class="form-control" name="image2" id="image2">
                                                 @if($logo2->image2)
                                                 <img src="{{$logo2->image2}}" alt="" width="200px" height="100px">
                         
                                                 @else
                                                 <img src="{{$logo2->value}}" alt="" width="200px" height="100px">
                         
                                                  @endif
                                                
                                            </div>
                                            <h4 style="border-top:#d0e0e6 solid 2px" class="p-3 mt-3">{{__('messages.Links')}}</h4>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$facebook->name}}</label>
                                                 <input type="url" class="form-control" name="facebook" id="inputPassword4" value="{{$facebook->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$youtube->name}}</label>
                                                 <input type="url" class="form-control" name="youtube" id="inputPassword4" value="{{$youtube->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$instagram->name}}</label>
                                                 <input type="url" class="form-control" name="instagram" id="inputPassword4" value="{{$instagram->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$tiktok->name}}</label>
                                                 <input type="url" class="form-control" name="tiktok" id="inputPassword4" value="{{$tiktok->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$ios_link->name}}</label>
                                                 <input type="text" class="form-control" name="ios_link" id="inputPassword4" value="{{$ios_link->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$android_link->name}}</label>
                                                 <input type="text" class="form-control" name="android_link" id="inputPassword4" value="{{$android_link->value}}">
                                                
                                            </div>
                                          
                                            <h4 style="border-top:#d0e0e6 solid 2px" class="p-3 mt-3">{{__('messages.Prescription Info')}}</h4>

                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$clinc->name}}</label>
                                                 <textarea  class="form-control" name="clinc" id="inputPassword4" >{{$clinc->value}}</textarea>
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$hospital->name}}</label>
                                                 <textarea  class="form-control" name="hospital" id="inputPassword4" >{{$hospital->value}}</textarea>
                                                
                                            </div>

                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$tel->name}}</label>
                                                 <input type="text" class="form-control" name="tel" id="inputPassword4" value="{{$tel->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$mobile->name}}</label>
                                                 <input type="text" class="form-control" name="mobile" id="inputPassword4" value="{{$mobile->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$email->name}}</label>
                                                 <input type="email" class="form-control" name="email" id="inputPassword4" value="{{$email->value}}">
                                                
                                            </div>

                          
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$doctor_name_english->name}}</label>
                                                 <input type="text" class="form-control" name="doctor_name_english" id="inputPassword4" value="{{$doctor_name_english->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$doctor_name_arabic->name}}</label>
                                                 <input type="text" class="form-control" name="doctor_name_arabic" id="inputPassword4" value="{{$doctor_name_arabic->value}}">
                                                
                                            </div>

                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$job_title1_english->name}}</label>
                                                 <input type="text" class="form-control" name="job_title1_english" id="inputPassword4" value="{{$job_title1_english->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$job_title1_arabic->name}}</label>
                                                 <input type="text" class="form-control" name="job_title1_arabic" id="inputPassword4" value="{{$job_title1_arabic->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$job_title2_english->name}}</label>
                                                 <input type="text" class="form-control" name="job_title2_english" id="inputPassword4" value="{{$job_title2_english->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$job_title2_arabic->name}}</label>
                                                 <input type="text" class="form-control" name="job_title2_arabic" id="inputPassword4" value="{{$job_title2_arabic->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$job_title3_english->name}}</label>
                                                 <input type="text" class="form-control" name="job_title3_english" id="inputPassword4" value="{{$job_title3_english->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$job_title3_arabic->name}}</label>
                                                 <input type="text" class="form-control" name="job_title3_arabic" id="inputPassword4" value="{{$job_title3_arabic->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$job_title4_english->name}}</label>
                                                 <input type="text" class="form-control" name="job_title4_english" id="inputPassword4" value="{{$job_title4_english->value}}">
                                                
                                            </div>
                                            <div class="col-md-4 mb-2">

                                                <label for="inputPassword4" class="form-label">{{$job_title4_arabic->name}}</label>
                                                 <input type="text" class="form-control" name="job_title4_arabic" id="inputPassword4" value="{{$job_title4_arabic->value}}">
                                                
                                            </div>

                                            
                                        </div>
                                        
                                      

                                      

                                    
                                            

                                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.Update') }}</button>

                                    </form>

                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

@endsection
@section('scripts') 
    <script type="text/javascript">
    $('#page-tage').html('{{__("messages.Settings")}}');

        </script>
        
        
@endsection