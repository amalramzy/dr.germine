@extends('layouts.master',['title'=>__("messages.Reservation")])
@section('content')
    @include('admin.reservation.table')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
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
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                language: {
                    search: "{{__('messages.Search')}}",
                    url: "/dataTables/i18n/de_de.lang",
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('reservation.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'type', name: 'type'},
                    //   {data: 'specialTime', name: 'specialTime'},
                    //   {data: 'slots', name: 'slots'},
                    {data: 'appointments', name: 'appointments'},
                    {data: 'arrive_time', name: 'arrive_time'},
                    {data: 'enter_time', name: 'enter_time'},
                    {data: 'finish_time', name: 'finish_time'},
                    {data: 'canceled', name: 'canceled'},
                    {data: 'edit', name: 'edit'},
                    //   { orderable: false, searchable: false},
                ]
            });

               /*------------------------------------------
      --------------------------------------------
      canceled Product Code
      --------------------------------------------
      --------------------------------------------*/
      $('body').on('click', '.cancelReservation', function () {
       
       var reservation_id = $(this).data("id");
       if(confirm("{{__('messages.Are You sure want to cancel !')}}")){
         // event.preventDefault();
         $.ajax({
           type: "POST",
           url: "/admin/status/cancel/"+reservation_id,
           success: function (data) {
               table.draw();
           },
           error: function (data) {
               console.log('Error:', data);
           }
       });
       }else{
         event.preventDefault();
       }
       
     
   });

        });
    </script>
@endsection
