@extends('layouts.master')
@section('content')
    <a class="btn btn-success" href="javascript:void(0)" id="createNewUser"> {{ __('messages.Create New User') }}</a>
    <a class="btn btn-primary" href="/admin/users?block=1" id="BlockedUsers"> {{ __('messages.Blocked Users') }}</a>
    <div class="row mt-3">
        <form style="display: inline-block" method="get" action="{{ route('users.index') }}">
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="city" class="form-label">{{ __('messages.Area') }}</label>
                    <select name="choose_area_id" id="choose_area_id" class="form-control js-example-basic-single" onchange="this.form.submit()">
                        <option value="">{{ __('messages.Area') }}</option>
                        @foreach (\App\Models\Area::all() as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
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
                    <th>{{ __('messages.Father') }}</th>
                    <th>{{ __('messages.Mother') }}</th>
                    <th>{{ __('messages.Email') }}</th>
                    <th>{{ __('messages.Area') }}</th>
                    <th>{{ __('messages.Children') }}</th>
                    <th>{{ __('messages.Cancel Count') }}</th>
                    <th>{{ __('messages.Edit Count') }}</th>
                    <th>{{ __('messages.No Attended Count') }}</th>
                    <th>{{ __('messages.Change Password') }}</th>
                    <th>{{ __('messages.Block') }}</th>
                    <th>{{ __('messages.Registration Phone') }}</th>
                    <th>{{ __('messages.Additional Phone') }}</th>
                    <th>{{ __('messages.Created At') }}</th>
                    <th>{{ __('messages.Actions') }}</th>
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
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="modal-body p-4">
                        <div class="row" id="sec-1">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="father" class="form-label">{{ __('messages.Father') }}</label>
                                    <input type="text" class="form-control" id="father" name="father" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mother" class="form-label">{{ __('messages.Mother') }}</label>
                                    <input type="text" class="form-control" id="mother" name="mother" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="sec-2">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="city" class="form-label">{{ __('messages.Area') }}</label>
                                    <br>
                                    <select name="area_id" id="area_id" class="form-control js-example-basic-single"
                                        style="width: 100%;height: 100%;">
                                        <option value="">{{ __('messages.Area') }}</option>
                                        @foreach (\App\Models\Area::all() as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('messages.Email address') }}</label>
                                    <input type="email" id="email" name="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="pass-sec">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('messages.Password') }}</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="sec-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone1"
                                        class="form-label">{{ __('messages.Registration Phone') }}</label>
                                    <input type="tel" id="phone1" name="phone1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone2"
                                        class="form-label">{{ __('messages.Additional Phone') }}</label>
                                    <input type="tel" id="phone2" name="phone2" class="form-control">
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


    <div id="ajaxModel2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading2"></h4>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <form id="adminForm2" name="adminForm2" class="form-horizontal">
                    <input type="hidden" name="user_id" id="user_id2">
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('messages.Password') }}</label>
                                    <input type="password" id="password2" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="password"
                                        class="form-label">{{ __('messages.Confirmation Password') }}</label>
                                    <input type="password" id="confirmation_password" name="confirmation_password"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-success waves-effect waves-light" id="changePasswordBtn"
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
        $("#choose_area_id").change(function() {
            var id = $(this).children(":selected").attr("value");
            $(".dataTable").dataTable().fnDestroy();
        });

        $(function() {
            $('#page-tage').html('{{ __('messages.Users') }}');

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
                destroy: true,
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
                ajax: "{{ isset($block) && $block ? route('users.index', ['block' => $block]) : (isset($choose_area_id) && $choose_area_id ? route('users.index', ['choose_area_id' => $choose_area_id]) : route('users.index')) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'father',
                        name: 'father'
                    },
                    {
                        data: 'mother',
                        name: 'mother'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'area_id',
                        name: 'area'
                    },
                    {
                        data: 'children',
                        name: 'children'
                    },
                    {
                        data: 'cancel_count',
                        name: 'cancel_count'
                    },
                    {
                        data: 'edit_count',
                        name: 'edit_count'
                    },
                    {
                        data: 'no_attended_count',
                        name: 'no_attended_count'
                    },
                    {
                        data: 'change_password',
                        name: 'change_password'
                    },
                    {
                        data: 'block',
                        name: 'block'
                    },
                    {
                        data: 'phone1',
                        name: 'phone1'
                    },
                    {
                        data: 'phone2',
                        name: 'phone2'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
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
            $('#createNewUser').click(function() {
                $('#rejectRquest').val("create-user");
                $('#user_id').val('');
                $('#adminForm').trigger("reset");
                $('#modelHeading').html('{{ __('messages.Create New User') }}');
                $('#ajaxModel').modal('show');
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.editUser', function() {
                var user_id = $(this).data('id');
                $.get("{{ route('users.index') }}" + '/' + user_id + '/edit',

                    function(data) {
                        $('#modelHeading').html("{{ __('messages.Edit') }}");
                        $('#saveBtn').val("edit-user");
                        $('#ajaxModel').modal('show');
                        $('#user_id').val(data.id);
                        $('#father').val(data.father);
                        $('#mother').val(data.mother);
                        $('#email').val(data.email);
                        $('#area_id').val(data.area_id);
                        $('#phone1').val(data.phone1);
                        $('#phone2').val(data.phone2);
                        $('#pass-sec').hide();

                    })
            });

            /*------------------------------------------
              --------------------------------------------
              Click to Change Password Button
              --------------------------------------------
              --------------------------------------------*/
            $('body').on('click', '.changePassword', function() {
                var user_id = $(this).data('id');
                console.log("show");
                console.log(user_id);
                $.get("{{ route('users.index') }}" + '/' + user_id + '/edit',

                    function(data) {
                        $('#modelHeading2').html("{{ __('messages.Change Password') }}");
                        $('#changePasswordBtn').val("edit-user");
                        $('#ajaxModel2').modal('show');
                        $('#user_id2').val(data.id);
                    })
            });
            /*------------------------------------------
            --------------------------------------------
            Change Password
            --------------------------------------------
            --------------------------------------------*/
            $('#changePasswordBtn').click(function(e) {
                console.log("fun");
                console.log($('#adminForm2').serialize());
                e.preventDefault();
                $(this).html('{{ __('messages.Sending..') }}');

                $.ajax({
                    data: $('#adminForm2').serialize(),
                    url: "/admin/users/change-password",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log("done");
                        $('#adminForm2').trigger("reset");
                        $('#ajaxModel2').modal('hide');
                        table.draw();

                    },
                    error: function(xhr, status, error) {
                        console.log("error");
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

                        $('#changePasswordBtn').html('{{ __('messages.Save') }}');
                    }
                });
            });
            /*------------------------------------------
            --------------------------------------------
            Create User Code
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('{{ __('messages.Sending..') }}');

                $.ajax({
                    data: $('#adminForm').serialize(),
                    url: "{{ route('users.store') }}",
                    type: "POST",
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
            });

            /*------------------------------------------
            --------------------------------------------
            Delete Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.deleteUser', function() {

                var user_id = $(this).data("id");
                if (confirm("{{ __('messages.Are You sure want to delete !') }}")) {
                    // event.preventDefault();
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('users.store') }}" + '/' + user_id,
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
            Block User
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.blockUser', function() {
                var user_data = $(this).data("id");
                var nameArr = user_data.split('-');
                var user_id = nameArr[0];
                var is_blocked = nameArr[1];
                var message = "";
                if (is_blocked == 1) {
                    message = "{{ __('messages.Are You sure want to UnBlock !') }}";
                } else {
                    message = "{{ __('messages.Are You sure want to Block !') }}";
                }
                if (confirm(message)) {
                    // event.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "/admin/users/block/" + user_id,
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

        $('#area_id').select2({
            dropdownParent: $('#ajaxModel'),
            // theme: 'bootstrap4',
            theme: "classic"
        });
    </script>
@endsection
