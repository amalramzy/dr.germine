@extends('layouts.master')
@section('content')
    <style>
        .input-group {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .check-margin10 {
            margin-left: 40px;
            /* Set as you wish */
        }
    </style>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewPerson"> {{ __('messages.Create New Parson') }}</a>
    <a class="btn btn-primary" href="/admin/sale-persons?block=1" id="BlockedReps"> {{ __('messages.Blocked Reps') }}</a>
    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
        <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline text-center">
            <thead>
                <tr>
                    <th>{{ __('messages.No') }}</th>
                    <th>{{ __('messages.Image') }}</th>
                    <th>{{ __('messages.Name') }}</th>
                    <th>{{ __('messages.Email') }}</th>
                    <th>{{ __('messages.Company') }}</th>
                    <th>{{ __('messages.Cancel Count') }}</th>
                    <th>{{ __('messages.Edit Count') }}</th>
                    <th>{{ __('messages.No Attended Count') }}</th>
                    <th>{{ __('messages.Change Password') }}</th>
                    <th>{{ __('messages.Block') }}</th>
                    <th>{{ __('messages.Phone Number') }}</th>
                    <th>{{ __('messages.Medicine') }}</th>
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
                <form id="adminForm" name="adminForm" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="person_id" id="person_id">
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('messages.Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" value=""
                                        maxlength="50" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="company" class="form-label">{{ __('messages.Company') }}</label>
                                    <input type="text" class="form-control" id="company" name="company" value=""
                                        maxlength="50" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">{{ __('messages.Phone Number') }}</label>
                                    <input type="tel" id="phone" name="phone" required="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('messages.Email address') }}</label>
                                    <input type="email" id="email" name="email" required="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12" id="pass-sec">
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('messages.Password') }}</label>
                                    <input type="password" id="password" name="password" required=""
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="image" class="form-label">{{ __('messages.Image') }}</label>
                                    <input type="file" id="image" name="image" required="" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="textbox-wrapper">
                                            <div class="textbox-all">
                                                <div class="textbox-region-1">
                                                    <div class="textbox-section">
                                                        <label for="medicines"
                                                            class="form-label">{{ __('messages.Medicine') }}</label>
                                                        <div class="input-group check-margin10">
                                                            <span class="input-group-btn">
                                                                <button id="1" type="button"
                                                                    class="btn btn-info add-textbox-sub"><i
                                                                        class="bi bi-plus-circle"></i></button>
                                                            </span>
                                                            <input name="medicines[]" type="text"
                                                                class="form-control no-left-border form-focus-info"
                                                                id="medicines">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
            $('#page-tage').html('{{ __('messages.Sale Person') }}');

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
                ajax: "{{ isset($block) ? route('sale-persons.index', ['block' => $block]) : route('sale-persons.index') }}",
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
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'company',
                        name: 'company'
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
                        data: 'phone',
                        name: 'email'
                    },
                    {
                        data: 'medicines',
                        name: 'medicines'
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
            $('#createNewPerson').click(function() {
                $('.med-ran').remove();
                $('#saveBtn').val("create-parson");
                $('#person_id').val('');
                $('#adminForm').trigger("reset");
                $('#modelHeading').html('{{ __('messages.Create New Parson') }}');
                $('#ajaxModel').modal('show');
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.editPerson', function() {
                $('.med-ran').remove();
                var person_id = $(this).data('id');
                $.get("{{ route('sale-persons.index') }}" + '/' + person_id + '/edit', function(data) {
                    var medicines = [];
                    medicines = data.medicines;
                    var medicinesSp = medicines.split(',');
                    console.log(medicinesSp);
                    $('#modelHeading').html("{{ __('messages.Edit') }}");
                    $('#saveBtn').val("edit-person");
                    $('#ajaxModel').modal('show');
                    $('#person_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#company').val(data.company);
                    $('#phone').val(data.phone);
                    $('#pass-sec').hide();
                    $('#medicines').val(medicinesSp[0]);
                    for (let i = 0; i < medicinesSp.length-1; i++) {
                        console.log(medicinesSp[i]);
                        $(".textbox-region-1").append('<div class="textbox-section med-ran"><label for="field-3b" class="control-label check-margin10"></label><div class="input-group check-margin10"><span class="input-group-btn"><button id="' +i +'" type="button" class="btn btn-warning remove-textbox-sub"><i class="bi bi-backspace"></i></button></span><input name="medicines[]" type="text" class="form-control no-left-border form-focus-warning" value="'+medicinesSp[i+1]+'"></div></div>');
                        // $('#medicines').val(medicinesSp[i]);
                    }

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
                $.get("{{ route('sale-persons.index') }}" + '/' + user_id + '/edit',

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
                    url: "/admin/sale-persons/change-password",
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
            Create Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('{{ __('messages.Sending..') }}');
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
                    url: "{{ route('sale-persons.store') }}",
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
            $('body').on('click', '.deletePerson', function() {

                var person_id = $(this).data("id");
                if (confirm("{{ __('messages.Are You sure want to delete !') }}")) {
                    // event.preventDefault();
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('sale-persons.store') }}" + '/' + person_id,
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
                        url: "/admin/sale-persons/block/" + user_id,
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
    <script type="text/javascript">
        $(function() {
            $('#addMedicines').on('click', function() {
                console.log($('#medicines').val());
                $('#answers').append('<p>' + $('#medicines').val() + '</p>');
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            var max = 10;
            var cnt = 1;
            var htg = 1;

            $(".add-textbox").on("click", function(e) {
                e.preventDefault();
                if (cnt < max) {
                    cnt++;
                    htg++;
                    //alert('#parent count: '+cnt+' - #parent created: '+htg);
                    $(".textbox-wrapper").append('<div class="textbox-all"><div class="textbox-region-' +
                        htg +
                        '"><div class="textbox-section"><label for="field-3a" class="control-label">Uraian</label><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-danger remove-textbox"><i class="bi bi-backspace"></i></button></span><input name="uraian[]" type="text" class="form-control no-left-border form-focus-danger"></div></div><div class="textbox-section"><label for="field-3b" class="control-label check-margin10">ss</label><div class="input-group check-margin10"><span class="input-group-btn"><button id="' +
                        htg +
                        '" type="button" class="btn btn-info add-textbox-sub"><i class="glyphicon glyphicon-plus"></i></button></span><input name="medicines[]" type="text" class="form-control no-left-border form-focus-info"></div></div></div></div>'
                    );
                }
            });

            var maxx = 10;

            $(".textbox-wrapper").on("click", ".add-textbox-sub", function(e) {
                e.preventDefault();

                var id = $(this).attr('id');
                //alert('#parent: '+id);

                if (isNaN(window['tes' + id])) {
                    window['tes' + id] = 1;
                } else {
                    window['tes' + id] += 1;
                }

                var cntt = window['tes' + id];

                if (cntt < maxx) {
                    cntt++;
                    //alert('#child count: '+cntt);
                    $(".textbox-region-" + id).append(
                        '<div class="textbox-section med-ran"><label for="field-3b" class="control-label check-margin10"></label><div class="input-group check-margin10"><span class="input-group-btn"><button id="' +
                        id +
                        '" type="button" class="btn btn-warning remove-textbox-sub"><i class="bi bi-backspace"></i></button></span><input name="medicines[]" type="text" class="form-control no-left-border form-focus-warning"></div></div>'
                    );
                }
            });

            $(".textbox-wrapper").on("click", ".remove-textbox", function(e) {
                e.preventDefault();
                $(this).parents(".textbox-all").remove();
                cnt--;
            });

            $(".textbox-wrapper").on("click", ".remove-textbox-sub", function(e) {
                e.preventDefault();
                $(this).parents(".textbox-section").remove();

                var id = $(this).attr('id');
                //alert('#parent remove: '+id);
                window['tes' + id] -= 1;
            });



        });
    </script>
@endsection
