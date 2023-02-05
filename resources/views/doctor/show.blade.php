@extends('layouts.master')
@section('content') 
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-between mb-2">
                                            <div class="col-auto">
                                               
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <ul class="nav nav-pills nav-fill navtab-bg">
                                                              <li class="nav-item">
                                                                  <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                                      {{__('messages.Documents')}}
                                                                  </a>
                                                              </li>
                                                             
                                                                {{-- <li class="nav-item">
                                                                    <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                                        {{__('messages.Reservation')}}
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                  <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                                      About Me
                                                                  </a>
                                                              </li> --}}
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div class="tab-pane" id="aboutme">
                          
                                                                </div> <!-- end tab-pane -->
                                                                <!-- end about me section content -->
                          
                                                                <div class="tab-pane show active" id="timeline">
                          
                                          
                                                                  <div class="row">
                                                                  
                                                                  </div>
                                                                                                          
                                                                 
                                                                </div>
                                                                <!-- end timeline content-->
                          
                                                                <div class="tab-pane" id="settings">
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
                                                                <!-- end settings content-->
                          
                                                            </div> <!-- end tab-content -->
                                                        </div>
                                                    </div> <!-- end card-->
                          
                                                </div> <!-- end col -->
                                            
                                        </div>
                

                                        

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex  mb-3">
                                            <img class="d-flex me-3 rounded-circle avatar-xl" src="{{ asset('assets/images/admin/admin.jpg')}}" alt="Generic placeholder image">
                                            <div class="w-100">
                                                <h4 class="mt-0 mb-1">{{$doctor->name}}</h4>
         
                                            </div>
                                        </div>
    
                                        <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle me-1"></i>{{__('messages.Personal Information')}}</h5>
                                        <div class="">
                                            <h4 class="font-13 text-muted text-uppercase">{{__('messages.Email')}}</h4>
                                            <p class="mb-3">
                                                {{$doctor->email}}
                                            </p>
    
                                            <h4 class="font-13 text-muted text-uppercase mb-1">{{__('messages.Bio')}}</h4>
                                            <p class="mb-3">{{$doctor->bio}}</p>
    
                                            {{-- <h4 class="font-13 text-muted text-uppercase mb-1">{{__('messages.Area')}}</h4>
                                            <p class="mb-3">{{$user->area_id}}</p> --}}
    
                                            <h4 class="font-13 text-muted text-uppercase mb-1">{{__('messages.Address')}}</h4>
                                            <p class="mb-3">{{$doctor->address}}</p>
    
                             
    
                                        </div>
                                    </div>
                                </div> <!-- end card-->
                            </div>
                        </div>
                        <!-- end row -->
                    




      

@endsection