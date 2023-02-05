@extends('layouts.master')
@section('content')
                    <a class="btn btn-success" href="javascript:void(0)" id="createNewSlot"> {{__('messages.Create New Appointment')}}</a>
                    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">                        <thead>
                            <tr>
                                <th>{{__('messages.No')}}</th>
                                <th width="280px">{{__('messages.Date')}}</th>
                                {{-- <th > {{__('messages.fullDate')}}</th> --}}
                                <th >{{__('messages.From')}}</th>
                                <th>{{__('messages.To')}}</th>
                                <th > {{__('messages.Number')}}</th>

                                <th width="280px">{{__('messages.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    </div>

  <!-- sample modal content -->

  <div id="ajaxModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <form id="adminForm" name="adminForm" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="slot_id" id="slot_id">
                <div class="modal-body p-4">



                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="number" class="form-label">{{ __('messages.Number') }}</label>
                                    <input type="number" class="form-control" id="number" name="number" value="" maxlength="50" required="">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date" class="form-label">{{ __('messages.Date') }}</label>
                                    <input type="date" class="form-control" id="date" name="date" value="" maxlength="50" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="from" class="form-label">{{ __('messages.From') }}</label>
                                    <input type="time" id="from" name="from" required="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="to" class="form-label">{{ __('messages.To') }}</label>
                                    <input type="time" id="to" name="to" required="" class="form-control">
                                </div>
                            </div>
                       @if($clincCount == 1 )
                       @foreach($clincs as $key => $clinc)
                       <input type="hidden" name="clinc_id" id="clinc_id" value="{{$clinc->id}}">

                       @endforeach
                       @elseif($clincCount > 1)
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="city" class="form-label">{{ __('messages.Clinc') }}</label>
                                    <select name="clinc_id" id="clinc_id" class="form-control" >
                                        <option value="">{{ __('messages.Clinc') }}</option>
                                        @foreach ($clincs as $clinc)
                                           <option value="{{ $clinc->id }}">{{$clinc->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        </div>


                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-success waves-effect waves-light" id="saveBtn" value="create">{{ __('messages.Save') }}</button>
                </div>
            </form>

        </div>
    </div>
</div><!-- /.modal -->


                    <!-- Danger Alert Modal -->
                    <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content modal-filled bg-danger">
                                <div class="modal-body p-4">
                                    <div class="text-center" id="bank">
                                        <i class="dripicons-wrong h1 text-white"></i>
                                        <h4 class="mt-2 text-white">{{__("messages.Oh snap!")}}</h4>



                                            <ul id="errors_list">

                                            </ul>


                                        {{-- <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Close</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                </div><!-- /.modal -->

@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {
        $('#page-tage').html('{{__("messages.Doctor Appointments")}}');

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
          ajax: "{{ route('slots.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'date', name: 'date'},
            //   {data: 'fullDate', name: 'fullDate'},
              {data: 'from', name: 'from'},
              {data: 'to', name: 'to'},
              {data: 'number', name: 'number'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });


      /*------------------------------------------
      --------------------------------------------
      Click to Button
      --------------------------------------------
      --------------------------------------------*/
      $('#createNewSlot').click(function () {
          $('#saveBtn').val("create-slots");
          $('#slot_id').val('');
          $('#adminForm').trigger("reset");
          $('#modelHeading').html('{{__("messages.Create New Appointment")}}');
          $('#ajaxModel').modal('show');
      });

      /*------------------------------------------
      --------------------------------------------
      Click to Edit Button
      --------------------------------------------
      --------------------------------------------*/
      $('body').on('click', '.editSlot', function () {
        var slot_id = $(this).data('id');
        $.get("{{ route('slots.index') }}" +'/' + slot_id +'/edit', function (data) {
            $('#modelHeading').html('{{__("messages.Edit")}}');
            $('#saveBtn').val("edit-slot");
            $('#ajaxModel').modal('show');
            $('#slot_id').val(data.id);
            $('#date').val(data.date);
            $('#from').val(data.from);
            $('#to').val(data.to);
            $('#number').val(data.number);
        })
      });


      /*------------------------------------------
      --------------------------------------------
      Create Product Code
      --------------------------------------------
      --------------------------------------------*/
      $('#saveBtn').click(function (e) {
          e.preventDefault();
          $(this).html("{{ __('messages.Sending..') }}");

          $.ajax({
            data: $('#adminForm').serialize(),
            url: "{{ route('slots.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#adminForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();

            },
            error: function (xhr, status, error) {
                let err = JSON.parse(xhr.responseText);
                let item = err.errors;
                Object.keys(item).forEach(key => {
                    console.log(item[key].join(","))
                    $('#errors_list').append(
                        "<li class='text-white'>"+item[key].join(",")+"</li>"
                    );
                    $('#danger-alert-modal').modal('show');

                });

                $('#saveBtn').html('{{__("messages.Save")}}');
            }
        });
      });

      /*------------------------------------------
      --------------------------------------------
      Delete Product Code
      --------------------------------------------
      --------------------------------------------*/
      $('body').on('click', '.deleteSlot', function () {

          var slot_id = $(this).data("id");
          if(confirm("{{__('messages.Are You sure want to delete !')}}")){
            // event.preventDefault();
            $.ajax({
              type: "DELETE",
              url: "{{ route('slots.store') }}"+'/'+slot_id,
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
