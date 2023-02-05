@extends('layouts.master')
@section('content')


<div class="col-3">
    <form method="get" action="{{route('rep.visit.previous')}}">
        <label for="">{{__('messages.from')}}</label>
        <input type="date" name="from" class="form-control" placeholder="{{__('messages.from')}}" value="@if(isset($to) && $to){{$to}}@endif">
        <label for="">{{__('messages.to')}}</label>
         <input type="date" name="to" class="form-control" placeholder="{{__('messages.to')}}" value="@if(isset($from) && $from){{$from}}@endif">
        <div class="w-100  d-flex justify-content-end">
             <button class="btn btn-primary mt-2" type="submit" style="background-color:#7edb88;border-color:#7edb88">{{__('messages.search')}}</button>
        </div>
      </form>

</div>


    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
        <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
            <thead>
                <tr>
                    <th>{{__('messages.No')}}</th>
                    <th>{{__('messages.Name')}}</th>
                    <th>{{__('messages.Company')}}</th>
                    <th>{{__('messages.Medical')}}</th>
                    <th>{{__('messages.date_visit')}}</th>
                    <th> {{__('messages.Status')}}</th>
                    <th> {{__('messages.comment Rep')}}</th>
                    <th> {{__('messages.secretarial_comment')}}</th>
                    <th> {{__('messages.Doctor Comment')}}</th>
                    <th >{{__('messages.Edit')}}</th>
                    <th >{{__('messages.Delete')}}</th>
                </tr>
            </thead>
            <tbody class='text-center'>
            </tbody>
        </table>
    </div>

@endsection
@section('scripts')
  <script type="text/javascript">

    $(function () {
        $('#page-tage').html('{{__("messages.Medical Rep Reservation")}}');
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

                'excelHtml5',
                'pdfHtml5'
                ],
        language: {
                       search: "{{__('messages.Search')}}",
                       url: "/dataTables/i18n/de_de.lang",
                },
          processing: true,
          serverSide: true,
          ajax: "{{ (isset($to) && isset($from) && $to && $from) ? route('rep.visit.previous',['date' => $to .','. $from]) : route('rep.visit.previous')}}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'company', name: 'company'},
              {data: 'medicines', name: 'medicines'},
              {data: 'appointments', name: 'appointments'},
              {data: 'status', name: 'status'},
              {data: 'comment', name: 'comment'},
              {data: 'secretarial_comment', name: 'secretarial_comment'},
              {data: 'doctor_comment', name: 'doctor_comment'},
              {data: 'edit', name: 'edit'},
              {data: 'delete', name: 'delete' , orderable: false, searchable: false},
          ]
      });
    });


  </script>
@endsection
