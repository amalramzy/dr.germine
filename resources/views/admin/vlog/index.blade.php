@extends('layouts.master')
@section('content')
    <a class="btn btn-success" href="javascript:void(0)" id="createNewVlog"> {{__('messages.Create New Vlog')}}</a>

    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
        <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
            <thead>
            <tr>
                <th>{{__('messages.No')}}</th>
                <th>{{__('messages.Title')}}</th>
                <th>{{__('messages.Content')}}</th>

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
            <form id="adminForm" name="adminForm" class="form-horizontal">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <input type="hidden" name="vlog_id" id="vlog_id">
                    <div class="modal-body p-4 ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title_en" class="form-label">{{ __('messages.Title En') }}</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" value="" >

                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title_ar" class="form-label">{{ __('messages.Title Ar') }}</label>
                                    <input type="text" class="form-control" id="title_ar" name="title_ar" value="">

                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content_en" class="form-label">{{ __('messages.Content En') }}</label>
                                    <textarea  class="form-control" id="content_en" name="content_en" > </textarea>

                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content_ar" class="form-label">{{ __('messages.Content Ar') }}</label>
                                    <textarea   class="form-control" id="content_ar" name="content_ar" > </textarea>

                                </div>

                            </div>
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="video" class="form-label">{{ __('messages.Video') }}</label>
                                    <input type="file" id="video" name="video"  class="form-control">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-success waves-effect waves-light" id="saveBtn" value="create">{{__('messages.Save')}}</button>
                    </div>
                </div>

            </form>

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
            $('#page-tage').html('{{__("messages.Vlog")}}');
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
                       search: "{{__('messages.Search')}}",
                       url: "/dataTables/i18n/de_de.lang",
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('vlog.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'content', name: 'content'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Button
            --------------------------------------------
            --------------------------------------------*/
            $('#createNewVlog').click(function () {
                $('#saveBtn').val("create-vlog");
                $('#vlog_id').val('');
                $('#adminForm').trigger("reset");
                $('#modelHeading').html('{{__("messages.Create New Vlog")}}');
                $('#ajaxModel').modal('show');
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.editVlog', function () {
                var vlog_id = $(this).data('id');
                $.get("{{ route('vlog.index') }}" +'/' + vlog_id +'/edit', function (data) {
                    $('#modelHeading').html('{{__("messages.Edit")}}');
                    $('#saveBtn').val("edit-blog");
                    $('#ajaxModel').modal('show');
                    $('#vlog_id').val(data.id);
                    // console.log(data.name.en)
                    $('#title_en').val(data.title.en);
                    $('#title_ar').val(data.title.ar);
                    $('#content_en').val(data.content.en);
                    $('#content_ar').val(data.content.ar);
                })
            });

            /*------------------------------------------
            --------------------------------------------
            Create Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('{{__("messages.Sending..")}}');
                // Upload File logic
                let form_data = new FormData();
                let values =$('#adminForm').serializeArray();
                console.log(values)
                for ( var item in  values) {
                    form_data.append(values[item].name, values[item].value);
                }
                form_data.append('video',$('#video')[0].files[0])
                $.ajax({
                    data: form_data,
                    url: "{{ route('vlog.store') }}",
                    type: "POST",
                    contentType: false,
                    cache: false,
                    processData:false,
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
            $('body').on('click', '.deleteVlog', function () {

                var vlog_id = $(this).data("id");
                if(confirm('{{__("messages.Are You sure want to delete !")}}')){
                    // event.preventDefault();
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('vlog.store') }}"+'/'+vlog_id,
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
