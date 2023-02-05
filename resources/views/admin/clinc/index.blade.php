@extends('layouts.master')
@section('content')
                    <a class="btn btn-success" href="javascript:void(0)" id="createNewClinc"> {{__('messages.Create New Clinc')}}</a>
                    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">                      <thead>
                            <tr>
                                <th>{{__('messages.No')}}</th>
                                <th width="280px">{{__('messages.Name')}}</th>
                                {{-- <th >{{__('messages.Title')}}</th>
                                <th>{{__('messages.Location Url')}}</th> --}}
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
                <input type="hidden" name="clinc_id" id="clinc_id">
                <div class="modal-body p-4">



                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('messages.Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" value="" maxlength="50" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">{{ __('messages.Title') }}</label>
                                    <input type="text" id="title" name="title" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="location_url" class="form-label">{{ __('messages.Location Url') }}</label>
                                    <input type="text" name="location_url" class="form-control" id="location_url" value="">
                                </div>

                            </div>


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
        $('#page-tage').html('{{__("messages.Doctor Arrives")}}');



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
          ajax: "{{ route('clinc.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
            //   {data: 'title', name: 'title'},
            //   {data: 'location_url', name: 'location_url'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

      /*------------------------------------------
      --------------------------------------------
      Click to Button
      --------------------------------------------
      --------------------------------------------*/
      $('#createNewClinc').click(function () {
          $('#saveBtn').val("create-clinc");
          $('#clinc_id').val('');
          $('#adminForm').trigger("reset");
          $('#modelHeading').html('{{__("messages.Create New Clinc")}}');
          $('#ajaxModel').modal('show');
      });

      /*------------------------------------------
      --------------------------------------------
      Click to Edit Button
      --------------------------------------------
      --------------------------------------------*/
      $('body').on('click', '.editClinc', function () {
        var clinc_id = $(this).data('id');
        $.get("{{ route('clinc.index') }}" +'/' + clinc_id +'/edit', function (data) {
            $('#modelHeading').html('{{__("messages.Edit")}}');
            $('#saveBtn').val("edit-open");
            $('#ajaxModel').modal('show');
            $('#clinc_id').val(data.id);
            $('#name').val(data.name);
            $('#title').val(data.title);
            $('#location_url').val(data.location_url);
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
            url: "{{ route('clinc.store') }}",
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
      $('body').on('click', '.deleteClinc', function () {

          var clinc_id = $(this).data("id");
          if(confirm("{{__('messages.Are You sure want to delete !')}}")){
            // event.preventDefault();
            $.ajax({
              type: "DELETE",
              url: "{{ route('clinc.store') }}"+'/'+clinc_id,
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
