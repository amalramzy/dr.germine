@extends('layouts.master', ['title' => __('messages.Current')])
@section('content')
    <div class="dataTables_wrapper dt-bootstrap5 no-footer" id="table">

        <h3 style="text-align:center">
            {{ isset($date) ? \Carbon\Carbon::createFromDate($date)->toDateString() : \Carbon\Carbon::today()->toDateString() }}</h3>
        </h3>
        @include('admin.reservation.dates_buttons', [
            'begining' => \Carbon\Carbon::today(),
            'end' => \Carbon\Carbon::today()->addDays(6),
            'url' => 'admin/visit-current/',
            'step' => 1,
        ]);


        <div class="my-4 row">
            <div class="col">

                <form style="display: inline-block" method="get" action="{{ route('visit.current') }}">

                    <select class="form-select" name="type" id="type2" onchange="this.form.submit()">
                        <option value="">{{ __('messages.filter') }}</option>

                        <option @if (isset($type) && $type == 'examanation') selected @endif value="examanation">
                            {{ __('medical.examination') }}</option>
                        <option @if (isset($type) && $type == 'vaccination') selected @endif value="vaccination">
                            {{ __('medical.vaccination') }}</option>
                        <option @if (isset($type) && $type == 'examination,vaccination') selected @endif value="examination,vaccination">
                            {{ __('medical.examination_vaccination') }}</option>
                    </select>
                </form>


                <form style="display: inline-block ;margin: auto 10px;" method="get" style="width:10%" class="my-2"
                    action="{{ route('visit.current') }}">
                    <label for="" style="display: inline-block">{{ __('messages.Visit Day') }}</label>
                    <input style="display: inline-block" class="form-control" onChange='this.form.submit()' type="date"
                        name="date" value="@if(isset($date) && $date){{$date}}@endif">
                </form>

                <a class="btn btn-danger" style="margin: auto 15px;" href="{{ route('status.cancel.all') }}"
                    onClick="return confirm('{{ __('messages.cancel_all_visits_todaty') }} ')">{{ __('messages.cancel_all_visits_todaty') }}</a>


                <a class="btn btn-danger mx-2" data-toggle="modal" data-target="#notification"
                    data-whatever="@getbootstrap"> {{ __('messages.send_notification_to_all_user_today') }}</a>
                @include('admin.reservation.modal', ['type' => 'notification'])

                <a class="btn btn-danger mx-2" href="{{ route('status.close.clinc') }}"
                    onClick="return confirm('{{ __('messages.Clinc_close') }}')"> <i
                        class="fas fa-close"></i>{{ __('messages.Clinc_close') }}</a>
            </div>

        </div>

        @if (isset($type))
            @include('admin.reservation.res_per_table', [
                'date' => $date ?? \Carbon\Carbon::today()->toDateString(),
                'type' => $type,
            ])
        @else
            @include('admin.reservation.res_per_slot_table', [
                'date' => $date ?? \Carbon\Carbon::today()->toDateString(),
            ])
        @endif





        <h3 class="mt-5" style="text-align:center">{{ __('messages.Reservation from secretary') }}</h3>


        <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
            <thead class="text-center">
                <tr>
                    <th>{{ __('messages.appointment') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.father') }}</th>
                    <th>{{ __('messages.mother') }}</th>
                    <th>{{ __('messages.phone') }}</th>
                    <th >{{ __('messages.Visit Type') }}</th>
                    <th >{{ __('messages.Secretarial Comment') }}</th>


                    <th>{{ __('messages.arrive_time') }}</th>
                    <th>{{ __('messages.enter_time') }}</th>
                    <th>{{ __('messages.finish_time') }}</th>
                    <th>{{ __('messages.canceled') }}</th>
                    <th>{{ __('messages.price') }}</th>
                    <th>{{ __('messages.Edit') }}</th>
                </tr>

            </thead>
            <tbody class="text-center">
            </tbody>
        </table>
    </div>


    <hr class="mt-3">
    <h3 style="text-align:center" class="mt-5 mb-5">{{ __('messages.Medical Rep Reservation') }}</h3>

    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
        <table class="table dt-responsive nowrap w-100 dataTable-rep no-footer dtr-inline">
            <thead>
                <tr>
                    <th>{{ __('messages.appointment') }}</th>
                    <th>{{ __('messages.Name') }}</th>
                    <th>{{ __('messages.phone') }}</th>

                    <th>{{ __('messages.comment Rep') }}</th>
                    <th>{{ __('medical.doctor_comment') }}</th>
                    <th>{{ __('messages.Secretarial Comment') }}</th>
                    <th>{{ __('messages.arrive_time') }}</th>
                    <th>{{ __('messages.enter_time') }}</th>
                    <th>{{ __('messages.finish_time') }}</th>
                    <th>{{ __('messages.canceled') }}</th>
                    <th>{{ __('messages.Edit') }}</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($represervations))


                @foreach ($represervations as $rep)
                    <tr>

                        <td> @if($rep->special_datetime != '')
                              {{\Carbon\Carbon::parse($rep->special_datetime)->translatedFormat('h:i a')}}
                              @else
                                {{\Carbon\Carbon::parse($rep->slots->from)->translatedFormat('h:i a')}}
                              @endif
                        </td>
                        <td>{{$rep->salePerson->name}}</td>
                        <td>{{$rep->salePerson->phone}}</td>
                        <td>{{$rep->comment}}</td>
                        <td>{{$rep->doctor_comment}}</td>
                        <td>{{$rep->secretarial_comment}}</td>
                        <td>
                            @if($rep->arrive_time)
                                {{\Carbon\Carbon::parse($rep->arrive_time)->translatedFormat('h:i a')}}
                            @else
                            {!! '<form method="POST" action= "'.route('rep.timeArrive.store',[$rep->id]).'">'.csrf_field().'<button  data-toggle="tooltip" data-id="'.$rep->id.'" data-original-title="Add" class="addTime " style= "border:none;background-color:transparent;color:#4ec0e7;"><i class="mdi mdi-eye-outline"></i></button></form>' !!}
                            @endif
                        </td>

                        <td>
                            @if($rep->enter_time)
                                {{\Carbon\Carbon::parse($rep->enter_time)->translatedFormat('h:i a')}}
                            @else
                                {!! '<form method="POST" action= "'.route('rep.timeEnter.store',[$rep->id]).'">'.csrf_field().'<button  data-toggle="tooltip" data-id="'.$rep->id.'" data-original-title="Add" class="addTime " style= "border:none;background-color:transparent;color:#4ec0e7;"><i class="mdi mdi-eye-outline"></i></button></form>' !!}
                            @endif
                        </td>
                        <td>
                            @if($rep->finish_time)
                                {{\Carbon\Carbon::parse($rep->finish_time)->translatedFormat('h:i a')}}

                            @else
                            {!! '<form method="POST" action= "'.route('rep.timeFinish.store',[$rep->id]).'">'.csrf_field().'<button  data-toggle="tooltip" data-id="'.$rep->id.'" data-original-title="Add" class="addTime " style= "border:none;background-color:transparent;color:#4ec0e7;"><i class="mdi mdi-eye-outline"></i></button></form>' !!}
                            @endif
                        </td>

                        <td>
                            @if($rep->status == "canceled")
                                {{$rep->status}}
                            @else
                                {!! '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$rep->id.'" data-original-title="Cancel" class="cancel cancelRepReservation"><i class="mdi mdi-close"></i></a>' !!}
                            @endif
                        </td>
                        <td>
                            {!!' <a href="'.route('rep.edit.all',[$rep->id]).'" data-toggle="tooltip"   data-original-title="Edit" class="edit editReservation"><i class="mdi mdi-square-edit-outline"></i></a>'!!}
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        // Initiate the Pusher JS library
        let pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            encrypted: true,
            cluster: 'eu'
        });
        var channel = pusher.subscribe('reservation-finished');

        channel.bind('App\\Events\\ReservationFinished', function(data) {
            // this is called when the event notification is received...
            // console.log('enter')
            location.reload();
        });
    </script>
    <script type="text/javascript">


        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $("#submit").click(function(e){
                e.preventDefault();
                let title = $('#notification input[name=title]').val();
                let body = $('#notification textarea').val();

                if(title !='' && body != '' && confirm("{{__('messages.are you sure to send message to all user today?')}}")){
                    $.ajax({
                    type: 'post',
                    url: '{{route("notify.sendalluser.today")}}',
                    data: {
                        '_token' : '{{csrf_token()}}',
                        'title' : title,
                        'description' : body,
                    },
                    success: function(data) {
                        $('#close').click();
                    },
                    error: function(reject) {
                    },
                });
                }else{
                    alert("{{__('messages.please fill inputs first !')}}");
                }

    });


        /*---------------------------------------
        --------------------------------------------
        Render DataTable
        --------------------------------------------
        --------------------------------------------*/
        var table = $('.dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [

                'excelHtml5',
                'pdfHtml5'
            ],
            language: {
                search: "{{ __('messages.Search') }}",
                url: "/dataTables/i18n/de_de.lang",
            },
            processing: true,
            serverSide: true,
            ajax: "{{ isset($type) && $type ? route('visit.current', ['type' => $type]) : (isset($date) && $date ? route('visit.current', ['date' => $date]) : route('visit.current')) }}",
            columns: [
            {
                    data: 'appointments',
                    name: 'appointments'
                },
                {
                    data: 'name',
                    name: 'name'
                },{
                    data: 'father',
                    name: 'father'
                },{
                    data: 'mother',
                    name: 'mother'
                },{
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'secretarial',
                    name: 'secretarial'
                },
                {
                    data: 'arrive_time',
                    name: 'arrive_time'
                },
                {
                    data: 'enter_time',
                    name: 'enter_time'
                },
                {
                    data: 'finish_time',
                    name: 'finish_time'
                },
                {
                    data: 'canceled',
                    name: 'canceled'
                },
                {
                    data: 'update-price',
                    name: 'update-price'
                },
                {
                    data: 'edit',
                    name: 'edit'
                },

                //   { orderable: false, searchable: false},
            ]
        });

        /*------------------------------------------
              --------------------------------------------
              canceled Product Code
              --------------------------------------------
              --------------------------------------------*/
        $('body').on('click', '.cancelReservation', function() {

        var reservation_id = $(this).data("id");
        if (confirm("{{ __('messages.Are You sure want to cancel !') }}")) {
            // event.preventDefault();
            $.ajax({
                type: "POST",
                url: "/admin/status/cancel/" + reservation_id,
                success: function(data) {
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        } else {
            event.preventDefault();
        }


        });

        $('body').on('click', '.cancelRepReservation', function() {

var represervation_id = $(this).data("id");
if (confirm("{{ __('messages.Are You sure want to cancel !') }}")) {
    // event.preventDefault();
    $.ajax({
        type: "POST",
        url: "/admin/status/store/" + represervation_id,
        success: function(data) {
            table.draw();
        },
        error: function(data) {
            console.log('Error:', data);
        }
    });
} else {
    event.preventDefault();
}


});

        });


    </script>
@endsection
