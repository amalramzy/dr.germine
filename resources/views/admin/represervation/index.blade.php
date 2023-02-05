@extends('layouts.master')
@section('content')


    <a class="btn btn-success" href="javascript:void(0)" id="createNewReservation"> {{__('messages.Add Reservation')}}</a>
    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
        <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
            <thead>
                <tr>
                    <th>{{ __('messages.No') }}</th>
                    <th>{{ __('messages.Appointments') }}</th>
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
            </tbody>
        </table>
    </div>
<<<<<<< HEAD

=======


        <!-- sample modal content -->

        <div id="ajaxModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <form id="adminForm" name="adminForm" class="form-horizontal" >
                        <input type="hidden" name="represervation_id" id="represervation_id">
                        <div class="modal-body p-4">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="salePerson_id" class="form-label">{{ __('messages.Sale Person') }}</label>
                                            <select name="salePerson_id" id="salePerson_id" class="form-control" >
                                                <option value="">{{ __('messages.Sale Person') }}</option>
                                                @foreach (\App\Models\SalePerson::all() as $saleperson)
                                                <option value="{{ $saleperson->id }}">{{$saleperson->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="mb-3">
                                            <label for="comment" class="form-label">{{__('messages.Comment')}}</label>
                                            <textarea id="comment" name="comment" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mt-3">
                                            <div class="form-check">
                                                <input type="radio" id="slots" name="age" class="form-check-input" value="slots">
                                                <label class="form-check-label" for="slots">{{__('messages.Solts')}}</label>
                                            </div>
                                            <div class="mt-3" id="showSlot" style="display: none">
                                                <select class="form-select" name="slot_id" id="slot_id">
                                                    <option value="null">{{__('messages.Select')}}</option>
                                                    @foreach ($slots as $slot)
                                                    <option value="{{ $slot->id }}">{{$slot->date}} - {{date('h:i a', strtotime($slot->from))}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-check mt-3">
                                                <input type="radio" id="datetime" name="age" class="form-check-input ddd" value="datetime">
                                                <label class="form-check-label " for="datetime">{{__('messages.Special Datetime')}}</label>
                                            </div>
                                            <div class="row mt-4" id="showDatetime" style="display: none">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="date" class="form-label">{{ __('messages.Date') }}</label>
                                                        <input type="datetime-local" class="form-control" id="date" name="date" value="" maxlength="50" >
                                                    </div>
                                                </div>

                                            </div>
                                </div>


                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button> --}}
                            <button type="submit" class="btn btn-success waves-effect waves-light" id="saveBtn" value="create">{{ __('messages.Save') }}</button>
                        </div>
                    </form>
>>>>>>> 86e5e95e46dac6ca0442258b09b2cad136344cba

    <!-- sample modal content -->
    <div id="ajaxModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <form id="adminForm" name="adminForm" class="form-horizontal">
                    <input type="hidden" name="represervation_id" id="represervation_id">
                    <div class="modal-body p-4">
                        <div class="row">

                                <div class="col-md-12">
                                    <label for="type" class="form-label">{{__('messages.Type')}}</label>
                                    <select name="type" class="form-select"  id="type">
                                        <option value="examanation">{{__('messages.Examanation')}}</option>
                                        <option value="vaccination" >{{__('messages.Vaccination')}}</option>
                                        <option value="examanation,vaccination" >{{__('messages.Examanation & Vaccination')}}</option>
                                    </select>
                                </div>

                            <div class="col-md-12">
                                <div class="mb-3 mt-3">
                                    <label for="salePerson_id" class="form-label">{{ __('messages.Sale Person') }}</label>
                                    <select name="salePerson_id" id="salePerson_id" class="form-control">
                                        <option value="">{{ __('messages.Sale Person') }}</option>
                                        @foreach (\App\Models\SalePerson::all() as $saleperson)
                                            <option value="{{ $saleperson->id }}">{{ $saleperson->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="mb-3">
                                    <label for="comment" class="form-label">{{ __('messages.Comment') }}</label>
                                    <textarea id="comment" name="comment" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-3">
                                    <div class="form-check">
                                        <input type="radio" id="slots" name="age" class="form-check-input"
                                            value="slots">
                                        <label class="form-check-label" for="slots">{{ __('messages.Solts') }}</label>
                                    </div>
                                    <div class="mt-3" id="showSlot" style="display: none">
                                        <select class="form-select" name="slot_id" id="slot_id">
                                            <option value="null">{{ __('messages.Select') }}</option>
                                            @foreach ($slots as $slot)
                                                <option value="{{ $slot->id }}">{{ $slot->date }} -
                                                    {{ date('h:i a', strtotime($slot->from)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input type="radio" id="datetime" name="age" class="form-check-input ddd"
                                            value="datetime">
                                        <label class="form-check-label "
                                            for="datetime">{{ __('messages.Special Datetime') }}</label>
                                    </div>
                                    <div class="row mt-4" id="showDatetime" style="display: none">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="date" class="form-label">{{ __('messages.Date') }}</label>
                                                <input type="datetime-local" class="form-control" id="date"
                                                    name="date" value="" maxlength="50">
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button> --}}
                                <button type="submit" class="btn btn-success waves-effect waves-light" id="saveBtn"
                                    value="create">{{ __('messages.Save') }}</button>
                            </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /.modal -->

    <!-- Danger Alert Modal -->
    <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-4">
                    <div class="text-center" id="bank">
                        <i class="dripicons-wrong h1 text-white"></i>
                        <h4 class="mt-2 text-white">{{ __('messages.Oh snap!') }}</h4>
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
        $(function() {
            $('#page-tage').html('{{ __('messages.Medical Rep Reservation') }}');
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

<<<<<<< HEAD
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
=======
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
>>>>>>> 86e5e95e46dac6ca0442258b09b2cad136344cba
                ],
                language: {
                    search: "{{ __('messages.Search') }}",
                    url: "/dataTables/i18n/de_de.lang",
                },
<<<<<<< HEAD
                processing: true,
                serverSide: true,
                ajax: "{{ route('represervation.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'appointments',
                        name: 'appointments'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },

                    {
                        data: 'comment',
                        name: 'comment'
                    },
                    {
                        data: 'doctor_comment',
                        name: 'doctor_comment'
                    },
                    {
                        data: 'secretarial_comment',
                        name: 'secretarial_comment'
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
                        data: 'edit',
                        name: 'edit',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Button
            --------------------------------------------
            --------------------------------------------*/
            $('#createNewReservation').click(function() {
                $('#saveBtn').val("create-reservation");
                $('#represervation_id').val('');
                $('#adminForm').trigger("reset");
                $('#modelHeading').html('{{ __('messages.Add Reservation') }}');
                $('#ajaxModel').modal('show');
            });
=======
          processing: true,
          serverSide: true,
          ajax: "{{ route('represervation.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'appointments', name: 'appointments'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

      /*------------------------------------------
      --------------------------------------------
      Click to Button
      --------------------------------------------
      --------------------------------------------*/
      $('#createNewReservation').click(function () {
          $('#saveBtn').val("create-reservation");
          $('#represervation_id').val('');
          $('#adminForm').trigger("reset");
          $('#modelHeading').html('{{__("messages.Add Reservation")}}');
          $('#ajaxModel').modal('show');
      });

      /*------------------------------------------
      --------------------------------------------
      Click to Edit Button
      --------------------------------------------
      --------------------------------------------*/
      $('body').on('click', '.editReservation', function () {
        var represervation_id = $(this).data('id');
        $.get("{{ route('represervation.index') }}" +'/' + represervation_id +'/edit', function (data) {
            $('#modelHeading').html('{{__("messages.Edit")}}');
            $('#saveBtn').val("edit-reservation");
            $('#ajaxModel').modal('show');
            $('#represervation_id').val(data.id);
            $('#salePerson_id').val(data.salePerson_id);
            $('#date').val(data.special_datetime);
            $('#slot_id').val(data.slot_id);
            $('#comment').val(data.comment);


        })
      });


      /*------------------------------------------
      --------------------------------------------
      Create child Code
      --------------------------------------------
      --------------------------------------------*/
      $('#saveBtn').click(function (e) {
          e.preventDefault();
          $(this).html("{{ __('messages.Sending..') }}");

          $.ajax({
            data: $('#adminForm').serialize(),
            url: "{{ route('represervation.store') }}",
            type: "POST",
            enctype: 'multipart/form-data',
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
>>>>>>> 86e5e95e46dac6ca0442258b09b2cad136344cba

            /*------------------------------------------
            --------------------------------------------
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.editReservation', function() {
                var represervation_id = $(this).data('id');
                $.get("{{ route('represervation.index') }}" + '/' + represervation_id + '/edit', function(
                    data) {
                    $('#modelHeading').html('{{ __('messages.Edit') }}');
                    $('#saveBtn').val("edit-reservation");
                    $('#ajaxModel').modal('show');
                    $('#represervation_id').val(data.id);
                    $('#salePerson_id').val(data.salePerson_id);
                    $('#date').val(data.special_datetime);
                    $('#slot_id').val(data.slot_id);
                    $('#comment').val(data.comment);


                })
            });


            /*------------------------------------------
            --------------------------------------------
            Create child Code
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html("{{ __('messages.Sending..') }}");

                $.ajax({
                    data: $('#adminForm').serialize(),
                    url: "{{ route('represervation.store') }}",
                    type: "POST",
                    enctype: 'multipart/form-data',
                    dataType: 'json',
                    success: function(data) {

                        $('#adminForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(xhr, status, error) {
                        let err = JSON.parse(xhr.responseText);
                        let item = err.errors;
                        Object.keys(item).forEach(key => {
                            console.log(item[key].join(","))
                            $('#errors_list').append(
                                "<li class='text-white'>" + item[key].join(",") +
                                "</li>"
                            );
                            $('#danger-alert-modal').modal('show');

                        });

                        $('#saveBtn').html('{{ __('messages.Save') }}');
                    }
                });

<<<<<<< HEAD
            });

            /*------------------------------------------
            --------------------------------------------
            Delete Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.deleteReservation', function() {

                var represervation_id = $(this).data("id");
                if (confirm("{{ __('messages.Are You sure want to delete !') }}")) {
                    // event.preventDefault();
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('represervation.store') }}" + '/' + represervation_id,
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

            /*------------------------------------------
            --------------------------------------------
            canceled Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.cancelReservation', function() {

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
            //slots
            $(function() {
                $("input[name='age']").click(function() {
                    if ($("#slots").is(":checked")) {
                        $("#showSlot").show();
                    } else {
                        $("#showSlot").hide();
                    }
                });
            });
            //specialtime
            $(function() {
                $("input[name='age']").click(function() {
                    if ($("#datetime").is(":checked")) {
                        $("#showDatetime").show();
                        $("#showSlot").hide();
                    } else {
                        $("#showDatetime").hide();
                    }
                });
            });
        });
    </script>
=======
                $('#saveBtn').html('{{__("messages.Save")}}');
            }
        });

    });

      /*------------------------------------------
      --------------------------------------------
      Delete Product Code
      --------------------------------------------
      --------------------------------------------*/
      $('body').on('click', '.deleteReservation', function () {

          var represervation_id = $(this).data("id");
          if(confirm("{{__('messages.Are You sure want to delete !')}}")){
            // event.preventDefault();
            $.ajax({
              type: "DELETE",
              url: "{{ route('represervation.store') }}"+'/'+represervation_id,
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

      /*------------------------------------------
      --------------------------------------------
      canceled Product Code
      --------------------------------------------
      --------------------------------------------*/
      $('body').on('click', '.cancelReservation', function () {

       var represervation_id = $(this).data("id");
       if(confirm("{{__('messages.Are You sure want to cancel !')}}")){
         // event.preventDefault();
         $.ajax({
           type: "POST",
           url: "/admin/status/store/"+represervation_id,
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
         //slots
    $(function() {
    $("input[name='age']").click(function() {
      if ($("#slots").is(":checked")) {
        $("#showSlot").show();
      } else {
        $("#showSlot").hide();
      }
    });
  });
  //specialtime
  $(function() {
    $("input[name='age']").click(function() {
      if ($("#datetime").is(":checked")) {
        $("#showDatetime").show();
        $("#showSlot").hide();
      } else {
        $("#showDatetime").hide();
      }
    });
  });
    });
  </script>
>>>>>>> 86e5e95e46dac6ca0442258b09b2cad136344cba
@endsection
