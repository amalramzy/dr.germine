@extends('layouts.master', ['title' => __('messages.Previous')])
@section('content')
    <h3 style="text-align:center">
        {{ $date? \Carbon\Carbon::createFromDate($date)->toDateString(): \Carbon\Carbon::today()->addDays(-1)->toDateString() }}
    </h3>
    @include('admin.reservation.dates_buttons', [
        'begining' => \Carbon\Carbon::today()->addDays(-6),
        'end' => \Carbon\Carbon::today()->addDays(-1),
        'url' => 'admin/visit-previous/',
        'step' => 1,
    ]);


    <div class="col">

        <form style="display: inline-block ;margin-right:5px;margin-left:5px" method="get"
            action="{{ route('visit.previous') }}">

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


        <form style="display: inline-block" method="get" style="width:10%" class="my-2"
            action="{{ route('visit.previous') }}">
            <label for="" style="display: inline-block">{{ __('messages.Visits Day') }}</label>
            <input style="display: inline-block" class="form-control" onChange='this.form.submit()' type="date"
                name="date">
        </form>


    </div>
        <table class="table dt-responsive nowrap w-100  no-footer dtr-inline dataTable text-center">
            <thead>
                <th>{{ __('messages.date_visit') }}</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.Type') }}</th>
                <th>{{ __('messages.secretarial_comment') }}</th>
                <th>{{ __('messages.patient_comment') }}</th>
                <th>{{ __('messages.Follow Up Date') }}</th>
                <th>{{ __('messages.Diagnostic') }}</th>
                {{-- <th>{{__('messages.arrive_time')}}</th>
                <th>{{__('messages.enter_time')}}</th>
                <th>{{__('messages.finish_time')}}</th> --}}
                <th>{{ __('messages.price') }}</th>
            </thead>
            <tbody>

            </tbody>
        </table>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                ajax: "{{ isset($type) && $type ? route('visit.previous', ['type' => $type]) : (isset($date) && $date ? route('visit.previous', ['date' => $date]) : route('visit.previous')) }}",
                columns: [
                    {
                        data: 'appointments',
                        name: 'appointments'
                    }, {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    //   {data: 'specialTime', name: 'specialTime'},
                    //   {data: 'slots', name: 'slots'},
                    {
                        data: 'secretarial_comment',
                        name: 'secretarial_comment'
                    },
                    {data: 'patient_comment', name: 'patient_comment'},
                    {data: 'follow-up', name: 'follow-up'},
                    {data: 'diagnostics', name: 'diagnostics'},
                     {data: 'update-price', name: 'update-price'},
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
        });



    </script>
@endsection
