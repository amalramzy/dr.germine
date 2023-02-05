<?php
        $date = Illuminate\Support\Carbon::parse($reservation->special_datetime)->translatedFormat('l d-m-Y');
        $timeArrive = Illuminate\Support\Carbon::parse($reservation->arrive_time)->translatedFormat('h:i a');
        $timeEnter = Illuminate\Support\Carbon::parse($reservation->enter_time)->translatedFormat('h:i a');
        $timeFinish = Illuminate\Support\Carbon::parse($reservation->finish_time)->translatedFormat('h:i a');
        // $A = Illuminate\Support\Carbon::parse($reservation->arrive_time);
        // $E = Illuminate\Support\Carbon::parse($reservation->enter_time);
        $timeWait = Illuminate\Support\Carbon::parse($reservation->enter_time)->diffForHumans(Illuminate\Support\Carbon::parse($reservation->arrive_time));
        // $timeWait =$E->diff($A)->format('%H:%I:%S');
        // $F = Illuminate\Support\Carbon::parse($reservation->finish_time);
        $timeDetection = Illuminate\Support\Carbon::parse($reservation->finish_time)->diffForHumans(Illuminate\Support\Carbon::parse($reservation->enter_time))
        // $timeDetection = $F->diff($E)->format('%H:%I:%S');
    //    $vaccine = $reservation->vaccinations;


?>
                <!-- sample modal content -->

                <div id="showReservation{{$reservation->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-full-width">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="type">{{$reservation->type}}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <table class="table dt-responsive nowrap w-100 dataTableReservation no-footer dtr-inline">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="200px">{{__('messages.Reservation Date')}}</th>
                                                <th>{{__('messages.Vaccination')}}</th>
                                                <th>{{__('messages.Type')}}</th>
                                                <th>{{__('messages.arrive_time')}}</th>
                                                <th>{{__('messages.enter_time')}}</th>
                                                <th>{{__('messages.Waiting_time')}}</th>
                                                <th>{{__('messages.finish_time')}}</th>
                                                <th>{{__('messages.detection_time')}}</th>
                                                <th>{{__('messages.Price')}} </th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td>{{$date}}</td>

                                                <td>
                                                    @foreach($reservation->vaccinations as $key => $vacine)
                                                        {{$vacine->name}},
                                                    @endforeach
                                                </td>
                                                <td>{{$reservation->type}}</td>
                                                <td>{{$timeArrive}}</td>
                                                <td>{{$timeEnter}}</td>
                                                <td>{{$timeWait}}</td>
                                                <td>{{$timeFinish}}</td>
                                                <td>{{$timeDetection}}</td>
                                                <td>LE</td>

                                              </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <table class="table dt-responsive nowrap w-100 dataTableReservation no-footer dtr-inline">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{__('messages.Diagnostic')}}</th>
                                                {{-- <th>{{__('messages.Age')}}</th> --}}
                                                <th>{{__('messages.Weight')}}</th>
                                                <th>{{__('messages.Height')}}</th>
                                                <th>{{__('messages.Head Size')}}</th>
                                                <th>{{__('messages.Temperature')}}</th>
                                                <th>{{__('messages.Patient Comment')}}</th>
                                                <th>{{__('messages.Secretarial Comment')}}</th>
                                                <th>{{__('messages.Doctor Notes')}}</th>
                                                <th>{{__('messages.Doctor Comment')}}</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td>
                                                    @foreach($reservation->diagnostics as $key => $diagn)
                                                    {{$diagn->name}},
                                                    @endforeach

                                                </td>
                                                <td>{{$reservation->weight}}</td>
                                                <td>{{$reservation->height}}</td>
                                                <td>{{$reservation->head_size}}</td>
                                                <td>{{$reservation->temperature}}</td>
                                                <td>{{$reservation->patient_comment}}</td>
                                                <td>{{$reservation->secretarial_comment}}</td>
                                                <td>{{$reservation->doctor_notes}}</td>
                                                <td>{{$reservation->doctor_comment}}</td>

                                                {{-- <td>{{$timeFinish}}</td>
                                                <td>{{$timeDetection}}</td>
                                                <td>LE</td> --}}

                                              </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-center mt-3 mb-3">
                                    <button class="btn btn-success"><a href="{{route('medicalTest.show',$reservation->id)}}">{{__('messages.Printing medical Test')}}</a></button>
                                    <button class="btn btn-success"><a href="{{route('prescription.show',$reservation->id)}}">{{__('messages.Medication prescription printing')}}</a></button>
                                </div>

                                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <table class="table dt-responsive nowrap w-100 dataTableReservation no-footer dtr-inline">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{__('messages.Medicine')}}</th>
                                                <th>{{__('messages.Stand By')}}</th>
                                                <th>{{__('messages.Dose')}}</th>
                                                <th>{{__('messages.Period')}}</th>
                                                <th>{{__('messages.Notes')}}</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    @foreach($reservation->medicines as $key => $medicine)
                                                        {{$medicine->name}},
                                                    @endforeach
                                                </td>
                                                <td></td>
                                                <td>
                                                    @foreach(\App\Models\ReservationData::where('reservation_id',$reservation->id)->get() as $key => $reservationData)
                                                    {{$reservationData->dose_id}},
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach(\App\Models\ReservationData::where('reservation_id',$reservation->id)->get() as $key => $reservationData)
                                                    {{$reservationData->period}},
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach(\App\Models\ReservationData::where('reservation_id',$reservation->id)->get() as $key => $reservationData)
                                                    {{$reservationData->notes}},
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <table class="table dt-responsive nowrap w-100 dataTableReservation no-footer dtr-inline">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{__('messages.Medication prescription')}}</th>



                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>

                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <table class="table dt-responsive nowrap w-100 dataTableReservation no-footer dtr-inline">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{__('messages.Attached Images')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <table class="table dt-responsive nowrap w-100 dataTableReservation no-footer dtr-inline">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{__('messages.evaluation question')}}</th>
                                                <th>{{__('messages.Satisfaction rate')}}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <table class="table dt-responsive nowrap w-100 dataTableReservation no-footer dtr-inline">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{__('messages.Medical Test')}}</th>
                                                <th>{{__('messages.Image')}}</th>
                                                <th>{{__('messages.Doctor Comment')}}</th>



                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td></td>
                                                <td></td>
                                                <td></td>


                                              </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="$('#showReservation{{$reservation->id}}').modal('hide');">Close</button> --}}
                            </div>

                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->






