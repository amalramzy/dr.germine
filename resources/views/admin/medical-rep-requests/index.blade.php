@extends('layouts.master')
@section('content')
    <a class="btn btn-success" href="javascript:void(0)" id="createRepRequest"> {{ __('messages.Add Request') }}</a>

    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
        <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline text-center">
            <thead>
                <tr>
                    <th>{{ __('messages.No') }}</th>
                    <th>{{ __('messages.Medical Rep') }}</th>
                    <th>{{ __('messages.Request Time') }}</th>
                    <th>{{ __('messages.Comment') }}</th>
                    <th>{{ __('messages.Last Visit') }}</th>
                    <th>{{ __('messages.Rejection Reason') }}</th>
                    <th>{{ __('messages.Approve') }}</th>
                    <th>{{ __('messages.Reject') }}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div id="ajaxModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <form id="adminForm" name="adminForm" class="form-horizontal">
                    <input type="hidden" name="medical_rep_req_id" id="medical_rep_req_id">
                    <div class="modal-body">
                        <div class="row mb-0" id="sec-1">
                            <div class="col-md-12">
                                <label for="available_to" class="form-label">{{ __('messages.Rejection Reason') }}</label>
                                <textarea id="rejection_reason" name="rejection_reason" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-success waves-effect waves-light" id="saveBtn"
                            value="create">{{ __('messages.Reject') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div><!-- /.modal -->


    <!-- sample modal content -->
    <div id="ajaxModel2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading2"></h4>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <form id="adminForm2" name="adminForm2" class="form-horizontal">
                    <input type="hidden" name="medical_req_id" id="medical_req_id">
                    <div class="modal-body">
                        <div class="row" id="sec-3">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="radio" id="slots2" name="age" class="form-check-input"
                                        value="slots">
                                    <label class="form-check-label" for="slots">{{ __('messages.Solts') }}</label>
                                </div>
                                <div class="mt-3" id="showSlot2" style="display: none">
                                    <select class="form-select" name="slot_id" id="slot_id">
                                        <option value="00">{{ __('messages.Select') }}</option>
                                        @foreach ($slots as $slot)
                                            <option value="{{ $slot->id }}">{{ $slot->date }} -
                                                {{ date('h:i a', strtotime($slot->from)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-check mt-3">
                                    <input type="radio" id="datetime2" name="age" class="form-check-input ddd"
                                        value="datetime">
                                    <label class="form-check-label "
                                        for="datetime">{{ __('messages.Special Datetime') }}</label>
                                </div>
                                <div class="row mt-4" id="showDatetime2" style="display: none">
                                    <div class="col-md-6">
                                        <div class="">
                                            <label for="date" class="form-label">{{ __('messages.Date') }}</label>
                                            <input type="datetime-local" class="form-control" id="date" name="date"
                                                value="" maxlength="50">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-success waves-effect waves-light" id="saveBtn2"
                            value="create">{{ __('messages.Save') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div><!-- /.modal -->


    <div id="ajaxModel3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading3"></h4>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <form id="adminForm3" name="adminForm3" class="form-horizontal">
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="salePerson_id"
                                        class="form-label">{{ __('messages.Sale Person') }}</label>
                                    <select name="salePerson_id" id="SalePersonId" class="form-control"
                                        style="width: 100%;height: 100%;" required>
                                        <option value="">{{ __('messages.Choose Sale Person') }}</option>
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
                                <div class="form-check">
                                    <input type="radio" id="slots3" name="age" class="form-check-input"
                                        value="slots">
                                    <label class="form-check-label" for="slots">{{ __('messages.Solts') }}</label>
                                </div>
                                <div class="mt-3" id="showSlot3" style="display: none">
                                    <select class="form-select" name="slot_id" id="slot_id">
                                        <option value="00">{{ __('messages.Select') }}</option>
                                        @foreach ($slots as $slot)
                                            <option value="{{ $slot->id }}">{{ $slot->date }} -
                                                {{ date('h:i a', strtotime($slot->from)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-check mt-3">
                                    <input type="radio" id="datetime3" name="age" class="form-check-input ddd"
                                        value="datetime">
                                    <label class="form-check-label "
                                        for="datetime">{{ __('messages.Special Datetime') }}</label>
                                </div>
                                <div class="row mt-4" id="showDatetime3" style="display: none">
                                    <div class="col-md-6">
                                        <div class="">
                                            <label for="date" class="form-label">{{ __('messages.Date') }}</label>
                                            <input type="datetime-local" class="form-control" id="date"
                                                name="date" value="" maxlength="50">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button> --}}
                                <button type="submit" class="btn btn-success waves-effect waves-light" id="saveBtn3"
                                    value="create">{{ __('messages.Add') }}</button>
                            </div>
                        </div>
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
                ajax: "{{ route('medical-rep-requests.index') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'medical_rep_name',
                        name: 'medical_rep_name'
                    },
                    {
                        data: 'slot',
                        name: 'slot'
                    },
                    {
                        data: 'comment',
                        name: 'comment'
                    },
                    {
                        data: 'last_visit',
                        name: 'last_visit'
                    },
                    {
                        data: 'rejection_reason',
                        name: 'rejection_reason'
                    },
                    {
                        data: 'approve',
                        name: 'approve'
                    },
                    {
                        data: 'reject',
                        name: 'reject'
                    },

                ]
            });
            /*------------------------------------------
            --------------------------------------------
            Click to Rejection Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.rejectRquest', function() {
                var request_id = $(this).data('id');
                $.get("{{ route('medical-rep-requests.index') }}" + '/' + request_id + '/edit',

                    function(data) {
                        $('#modelHeading').html("{{ __('messages.Reject Request') }}");
                        $('#ajaxModel').modal('show');
                        $('#medical_rep_req_id').val(request_id);
                    })
            });

            /*------------------------------------------
            --------------------------------------------
            Reject Request
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('{{ __('messages.Sending..') }}');

                $.ajax({
                    data: $('#adminForm').serialize(),
                    url: "/admin/medical-rep-requests/reject",
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
                Click to Approved Button
                --------------------------------------------
                --------------------------------------------*/
            $('body').on('click', '.approveRquest', function() {
                var request_id = $(this).data('id');
                console.log(request_id);
                $.get("{{ route('medical-rep-requests.index') }}" + '/' + request_id + '/edit',

                    function(data) {
                        $('#modelHeading2').html("{{ __('messages.Approve Request') }}");
                        $('#ajaxModel2').modal('show');
                        $('#medical_req_id').val(request_id);
                    })
            });
            /*------------------------------------------
            --------------------------------------------
            Approve Request
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn2').click(function(e) {
                e.preventDefault();
                $(this).html('{{ __('messages.Sending..') }}');

                $.ajax({
                    data: $('#adminForm2').serialize(),
                    url: "/admin/medical-rep-requests/approve",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#adminForm2').trigger("reset");
                        $('#ajaxModel2').modal('hide');
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

            $(function() {
                $("input[name='age']").click(function() {
                    if ($("#slots2").is(":checked")) {
                        $("#showSlot2").show();
                    } else {
                        $("#showSlot2").hide();
                    }
                });
            });
            $(function() {
                $("input[name='age']").click(function() {
                    if ($("#datetime2").is(":checked")) {
                        $("#showDatetime2").show();
                        $("#showSlot2").hide();

                    } else {
                        $("#showDatetime2").hide();
                    }
                });
            });
            //vaccin show2
            $("#type2").change(function() {
                $value = $(this).val();
                if ($value == "examanation,vaccination" || $value == "vaccination") {
                    $("#showVaccin2").show();
                } else {
                    $("#showVaccin2").hide();
                }

            });



            /******************************************/
            $(function() {
                $("input[name='age']").click(function() {
                    if ($("#slots3").is(":checked")) {
                        $("#showSlot3").show();
                    } else {
                        $("#showSlot3").hide();
                    }
                });
            });
            $(function() {
                $("input[name='age']").click(function() {
                    if ($("#datetime3").is(":checked")) {
                        $("#showDatetime3").show();
                        $("#showSlot3").hide();

                    } else {
                        $("#showDatetime3").hide();
                    }
                });
            });
            //vaccin show3
            $("#type2").change(function() {
                $value = $(this).val();
                if ($value == "examanation,vaccination" || $value == "vaccination") {
                    $("#showVaccin3").show();
                } else {
                    $("#showVaccin3").hide();
                }

            });

            /*------------------------------------------
            --------------------------------------------
            Click to Create Button
            --------------------------------------------
            --------------------------------------------*/
            $('#createRepRequest').click(function() {
                // $('#rejectRquest').val("create-request");
                $('#user_id').val('');
                $('#adminForm3').trigger("reset");
                $('#modelHeading3').html('{{ __('messages.Add Request') }}');
                $('#ajaxModel3').modal('show');
            });
            /*------------------------------------------
            --------------------------------------------
            Create User Code
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn3').click(function(e) {
                e.preventDefault();
                $(this).html('{{ __('messages.Sending..') }}');

                $.ajax({
                    data: $('#adminForm3').serialize(),
                    url: "{{ route('medical-rep-requests.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#adminForm3').trigger("reset");
                        $('#ajaxModel3').modal('hide');
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
        });
        $('#SalePersonId').select2({
            dropdownParent: $('#ajaxModel3'),
            // theme: 'bootstrap4',
            theme: "classic"
        });
    </script>
@endsection
