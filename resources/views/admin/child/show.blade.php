@extends('layouts.master')
@section('content')

                  <div class="row">
                      <div class="col-lg-4 col-xl-4">
                          <div class="card text-center">
                              <div class="card-body">

                                  <img  @if($child->image == "" )src="{{asset('assets/images/admin/baby.jpg')}}" @endif src="{{$child->image}}" class="rounded-circle avatar-lg img-thumbnail"
                                  alt="profile-image">
                                  <h4 class="mb-0">{{$child->name}}</h4>
                                  <button class="btn btn-danger btn-xs waves-effect mb-2 waves-light" type="button" data-toggle="modal" data-target="#updateChild">{{__('messages.Edit Profile')}}</button>
                                  <br>
                                  <a href="{{route('active.reservation',['child'=>$child->id])}}" type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Add Previous Visit</a>
                                  <br>
                                  <button class="btn btn-danger btn-xs waves-effect mb-2 waves-light" type="button" data-toggle="modal" data-target="#show-upload">{{__('messages.Uploade Child History')}}</button>
                                  <br>
                                  <div class="info-child mt-3">
                                      <p class="text-muted mb-2 font-13"><strong>{{__('messages.Birthdate')}}</strong> <span class="ms-2">{{$child->birthdate}}</span></p>

                                      <p class="text-muted mb-2 font-13"><strong>{{__('messages.Gender')}}</strong> <span class="ms-2">{{$child->gender}}</span></p>

                                      <p class="text-muted mb-2 font-13"><strong>{{__('messages.Hospital')}}</strong><span class="ms-2">{{$child->hospital}}</span></p>
                                      <p>{{__('messages.Age')}} : {{$day}}{{__('messages.Day')}}  {{$month}}{{__('messages.Month')}} {{$year}}{{__('messages.Year')}}</p>
                                  </div>


                              </div>
                          </div> <!-- end card -->

                         <div class="card">
                             <div class="card-body">
                                  <h4 class="header-title mb-3">{{__('messages.Vaccination')}}</h4>

                                  <div class="inbox-widget" data-simplebar style="max-height: 350px;">
                                    @foreach($child->vaccinations as $key => $vaccine)
                                    <div class="inbox-item">
                                        <p class="inbox-item-author">{{$vaccine->name}}</p>
                                        {{-- <p class="inbox-item-text">I've finished it! See you so...</p>
                                        <p class="inbox-item-date">
                                            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                                        </p> --}}
                                   </div>
                                    @endforeach



                                 </div> <!-- end inbox-widget -->
                             </div>
                         </div> <!-- end card-->

                      </div> <!-- end col-->

                      <div class="col-lg-8 col-xl-8">
                          <div class="card">
                              <div class="card-body">
                                  <ul class="nav nav-pills nav-fill navtab-bg">
                                    <li class="nav-item">
                                        <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                            {{__('messages.Add Reservation')}}
                                        </a>
                                    </li>

                                      <li class="nav-item">
                                          <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                              {{__('messages.Reservation')}}
                                          </a>
                                      </li>
                                      <li class="nav-item">
                                        <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                            {{__('messages.Summary')}}
                                        </a>
                                    </li>
                                      @if(\App\Models\AvailableFollowUp::where('child_id',$child->id)->first() )
                                          <li class="nav-item">
                                              <a href="#follow_up" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                  {{__('messages.Follow Up Reservation')}}
                                              </a>
                                          </li>
                                      @endif

                                  </ul>
                                  <div class="tab-content">
                                      <div class="tab-pane" id="aboutme">
                                        @include('admin.child.summary')

                                      </div> <!-- end tab-pane -->
                                      <!-- end about me section content -->

                                      <div class="tab-pane show active" id="timeline">
                                        <div class="row">
                                            @foreach($reservations as $key => $reservation)

                                            <div class="col-md-6">

                                                <div class="card">
                                                    <div class="card-body">
                                                        <input type="hidden" name="reservation_id" id="reservation_id" value="{{$reservation->id}}">
                                                        <h4 class="header-title">{{ $reservation->type}}</h4>
                                                        @if($reservation->is_follow_up == "1")
                                                        <span style="font-weight: bolder">{{__('messages.Follow Up')}}</span>
                                                        @endif
                                                        <p class="sub-header">
                                                            {{$reservation->special_datetime}}
                                                        </p>
                                                        <div class="button-list">
                                                            <!-- Responsive modal -->
                                                                <a href="javascript:void(0)" data-url="{{route('reservation.show',$reservation->id)}}" data-toggle="modal" data-target="#showReservation{{$reservation->id}}" class="btn btn-info showReservation">{{__('messages.Show')}}</a>

                                                                {{-- <a href="javascript:void(0)" data-url="" data-toggle="modal" data-target="#showReservation{{$reservation->id}}" class="btn btn-success showReservation">{{__('messages.Edit')}}</a> --}}
                                                                 <form id="delete-form{{$reservation->id}}" method="POST" action="{{route('reservation.destroy',[$reservation->id])}}" >@csrf
                                                                        {{method_field('DELETE')}}
                                                                    </form>
                                                                        <a href="#" onclick="if(confirm('Do you want to delete?')){
                                                                            event.preventDefault();
                                                                            document.getElementById('delete-form{{$reservation->id}}').submit()
                                                                        }else{
                                                                            event.preventDefault();
                                                                        }
                                                                        ">
                                                                        <button type="submit" class="btn btn-danger delete">{{__('messages.Delete')}}</button>
                                                                    </a>

                                                                {{-- <a href="javascript:void(0)" data-url="" data-toggle="modal" data-target="#showReservation{{$reservation->id}}" class="btn btn-danger showReservation">{{__('messages.Delete')}}</a> --}}


                                                                <a href="{{route('reservation.edit.previous',['child'=>$child,'reservation'=>$reservation])}}"  class="btn btn-success showReservation">{{__('messages.Edit')}}</a>
                                                                {{-- <a href="javascript:void(0)" data-url="" data-toggle="modal" data-target="#showReservation{{$reservation->id}}" class="btn btn-danger showReservation">{{__('messages.Delete')}}</a> --}}

                                                            {{-- </button> --}}

                                                        </div>
                                                            @include('admin.child.reservation')
                                                                </div>
                                                            </div> <!-- end card-->

                                                        </div>
                                                        @endforeach
                                                    </div>
                                      </div>
                                      <!-- end timeline content-->

                                      <div class="tab-pane" id="settings">
                                          @include('admin.child.createReservation')
                                      </div>
                                      <!-- end settings content-->

                                      <div class="tab-pane" id="follow_up">
                                        {{-- @if($reservation->status === "pending")
                                      <span style="font-weight: bolder">{{__('messages.Reservations Follow Up are not allowed')}}</span>
                                        @else --}}

                                        @include('admin.child.createFollowUp')
                                        {{-- @endif --}}
                                      </div>


                                  </div> <!-- end tab-content -->
                              </div>
                          </div> <!-- end card-->

                      </div> <!-- end col -->
                  </div>
                  <!-- end row-->

   @include('admin.child.upload')
   @include('admin.child.edit')
 @endsection

