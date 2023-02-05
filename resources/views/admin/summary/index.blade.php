@extends('layouts.master')
@section('content')
    <div class="container text-center mt-2">
        <div class="row">
            <div class="col-12">
                <h1 class="text-muted">{{ $title }}<h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="text-muted"> {{ $datePeriod }} <h3>
            </div>
        </div>

    </div>

    <div class="container mt-3 mb-3">
        <form style="display: inline-block ;margin: auto 10px;" method="get" style="width:10%" class="my-2"
            action="{{ route('summary.index') }}">
            <div class="row">
                <div class="col-5">
                    <label for="" style="display: inline-block">{{ __('messages.From') }}</label>
                    <input style="display: inline-block" class="form-control" type="date" name="from" @if (isset($from)) value="{{ $from }}" @endif required>
                </div>
                <div class="col-5">
                    <label for="" style="display: inline-block">{{ __('messages.To') }}</label>
                    <input style="display: inline-block" class="form-control" type="date" name="to" @if (isset($to)) value="{{ $to }}" @endif required>
                </div>
                <div class="col-2">
                    <label for="" style="visibility:hidden ">{{ __('messages.To') }}</label>
                    <button class="btn btn-primary" type="submit">{{ __('messages.Search For') }}</button>
                </div>
            </div>
        </form>
    </div>

    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
        <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline text-center">
            <thead>
                <tr>
                    <th>{{ __('messages.Date') }}</th>
                    <th>{{ __('messages.Number Of Reservations') }}</th>
                    <th>{{ __('messages.Number Of Vaccination') }}</th>
                    <th>{{ __('messages.Number Of Follow Ups') }}</th>
                    <th>{{ __('messages.Total Revenues') }}</th>
                    <th>{{ __('messages.Total Expenses') }}</th>
                    <th>{{ __('messages.Waiting Time Average') }}</th>
                    <th>{{ __('messages.Reservation Time Average') }}</th>
                    {{-- <th>{{ __('messages.Close Clinic') }}</th> --}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $datePeriod }}</td>
                    <td>{{ $reservationsCount }}</td>
                    <td>{{ $vaccinationCount }}</td>
                    <td>{{ $followUpsCount }}</td>
                    <td>{{ $totalRevenues }}</td>
                    <td>{{ $totalExpenses }}</td>
                    <td>{{ $waitingTimeAverage }} {{  __('messages.Minutes') }}</td>
                    <td>{{ $reservationTimeAverage }}  {{ __('messages.Minutes') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
{{-- @section('scripts')
    <script type="text/javascript">
        $(function() {
            $('#page-tage').html('{{ __('messages.Summary') }}');
            /*------------------------------------------
             --------------------------------------------
             Pass Header Token
             --------------------------------------------
             --------------------------------------------*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/
            var table = $('.dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                language: {
                    search: "{{ __('messages.Search') }}",
                    url: "/dataTables/i18n/de_de.lang",
                },
                processing: true,
                serverSide: true,
                // ajax: "{{ route('summary.index') }}",
                ajax: "{{ isset($from) && isset($to) ? route('summary.index', ['from' => $from, 'to' => $to]) : route('summary.index') }}",
                columns: [{
                        data: 'Date',
                        name: 'Date'
                    },
                    {
                        data: 'NumberOfReservations',
                        name: 'NumberOfReservations'
                    },
                    {
                        data: 'NumberOfVaccination',
                        name: 'NumberOfVaccination'
                    },
                    {
                        data: 'NumberOfFollowUps',
                        name: 'NumberOfFollowUps'
                    },
                    {
                        data: 'TotalRevenues',
                        name: 'TotalRevenues'
                    },
                    {
                        data: 'TotalExpenses',
                        name: 'TotalExpenses'
                    },
                    {
                        data: 'WaitingTimeAverage',
                        name: 'WaitingTimeAverage'
                    },
                    {
                        data: 'ReservationTimeAverage',
                        name: 'ReservationTimeAverage'
                    },
                    // {
                    //     data: 'CloseClinic',
                    //     name: 'CloseClinic'
                    // },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // },
                ]
            });

        });
    </script>
@endsection --}}
