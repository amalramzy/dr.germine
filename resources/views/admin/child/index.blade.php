@extends('layouts.master')
@section('content')
    <a class="btn btn-success" href="javascript:void(0)" id="createNewChild"> {{ __('messages.Create New Child') }}</a>
    <div class="row mt-3">
        <form style="display: inline-block" method="get" action="{{ route('children.index') }}">
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="gender" class="form-label">{{ __('messages.Gender') }}</label>
                    <select name="gender" id="gender" class="form-control" onchange="this.form.submit()">
                        <option value="">{{ __('messages.Gender') }}</option>

                        <option @if (isset($gender) && $gender == 'all') selected @endif value="all">{{ __('messages.All') }}</option>
                        <option @if (isset($gender) && $gender == 'male') selected @endif value="male">{{ __('messages.Male') }}</option>
                        <option @if (isset($gender) && $gender == 'female') selected @endif value="female">{{ __('messages.Female') }}</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
        <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline text-center">
            <thead>
                <tr>
                    <th>{{ __('messages.No') }}</th>
                    <th>{{ __('messages.Image') }}</th>
                    <th>{{ __('messages.Name') }}</th>
                    <th>{{ __('messages.Birthdate') }}</th>
                    <th>{{ __('messages.Gender') }}</th>
                    <th> {{ __('messages.Hospital') }}</th>
                    {{-- <th> {{__('messages.Age')}}</th> --}}
                    <th> {{ __('messages.Father Name') }}</th>
                    <th> {{ __('messages.Mother Name') }}</th>
                    <th> {{ __('messages.Phone Number') }}</th>
                    <th> {{ __('messages.Last Height') }}</th>
                    <th> {{ __('messages.Last Weight') }}</th>
                    <th> {{ __('messages.Last Head Size') }}</th>
                    <th> {{ __('messages.Last Reservation Time') }}</th>
                    {{-- <th> {{__('messages.History')}}</th> --}}
                    <th width="280px">{{ __('messages.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>


    <!-- sample modal content -->

    <div id="ajaxModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <form id="adminForm" name="adminForm" class="form-horizontal">
                    <input type="hidden" name="child_id" id="child_id">
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('messages.Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" value="">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="birthdate" class="form-label">{{ __('messages.Birthdate') }}</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate"
                                        value="" max={{ now()->toDateString('Y-m-d') }}>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">{{ __('messages.Gender') }}</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">{{ __('messages.Gender') }}</option>

                                        <option value="male">{{ __('messages.Male') }}</option>
                                        <option value="female">{{ __('messages.Female') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="hospital" class="form-label">{{ __('messages.Hospital') }}</label>
                                    <input type="text" id="hospital" name="hospital" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="image" class="form-label">{{ __('messages.Image') }}</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="user_id" class="form-label">{{ __('messages.Father') }}</label>
                                    <select name="user_id" id="user_id" class="form-control "
                                        style="width: 100%;height: 100%;">
                                        {{-- <option value=""></option> --}}
                                        @foreach (\App\Models\User::all() as $user)
                                            <option value="{{ $user->id }}">{{ $user->father }}</option>
                                        @endforeach
                                    </select>
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
    </div><!-- /.modal -->

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
        //     $(document).ready(function() {
        //     $('#user_id').select2();
        // });


        $(function() {
            $('.father').select2();

            $('#page-tage').html('{{ __('messages.Children') }}');

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
                ajax: "{{ isset($gender) ? route('children.index', ['gender' => $gender]) : route('children.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'birthdate',
                        name: 'birthdate'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    //   {data: 'day', name: 'day'},
                    {
                        data: 'hospital',
                        name: 'hospital'
                    },
                    //   {data: 'age', name: 'age'},
                    {
                        data: 'father',
                        name: 'father'
                    },
                    {
                        data: 'mother',
                        name: 'mother'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'last_height',
                        name: 'last_height'
                    },
                    {
                        data: 'last_weight',
                        name: 'last_weight'
                    },
                    {
                        data: 'last_head_size',
                        name: 'last_head_size'
                    },
                    {
                        data: 'last_reservation_time',
                        name: 'last_reservation_time'
                    },
                    //   {data: 'history', name: 'history'},
                    //   {data: 'user_id', name: 'user_id'},
                    {
                        data: 'action',
                        name: 'action',
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
            $('#createNewChild').click(function() {
                $('#saveBtn').val("create-child");
                $('#child_id').val('');
                $('#adminForm').trigger("reset");
                $('#modelHeading').html('{{ __('messages.Create New Child') }}');
                $('#ajaxModel').modal('show');
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.editChild', function() {
                var child_id = $(this).data('id');
                $.get("{{ route('children.index') }}" + '/' + child_id + '/edit', function(data) {
                    $('#modelHeading').html('{{ __('messages.Edit') }}');
                    $('#saveBtn').val("edit-child");
                    $('#ajaxModel').modal('show');
                    $('#child_id').val(data.id);
                    $('#name').val(data.name);
                    $('#gender').val(data.gender);
                    $('#hospital').val(data.hospital);
                    $('#user_id').val(data.user_id);
                    $('#birthdate').val(data.birthdate);
                    $('#image').val(data.image);
                })
            });


            /*------------------------------------------
            --------------------------------------------
            Create child Code
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                //   $('.father').select2();
                $(this).html("{{ __('messages.Sending..') }}");
                // Upload File logic
                let form_data = new FormData();
                let values = $('#adminForm').serializeArray();
                console.log(values)
                for (var item in values) {
                    form_data.append(values[item].name, values[item].value);
                }
                form_data.append('image', $('#image')[0].files[0])
                $.ajax({
                    data: form_data,
                    url: "{{ route('children.store') }}",
                    type: "POST",
                    contentType: false,
                    cache: false,
                    processData: false,
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

            });

            /*------------------------------------------
            --------------------------------------------
            Delete Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.deleteChild', function() {

                var child_id = $(this).data("id");
                if (confirm("{{ __('messages.Are You sure want to delete !') }}")) {
                    // event.preventDefault();
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('children.store') }}" + '/' + child_id,
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
        $('#user_id').select2({
            dropdownParent: $('#ajaxModel'),
            // theme: 'bootstrap4',
            theme: "classic"
        });
    </script>
@endsection
