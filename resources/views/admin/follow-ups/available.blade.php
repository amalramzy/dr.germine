@extends('layouts.master')
@section('content')
    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
        <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline text-center">
            <thead>
                <tr>
                    <th>{{ __('messages.No') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.Father') }}</th>
                    <th>{{ __('messages.Mother') }}</th>
                    <th>{{ __('messages.Registration Phone') }}</th>

                    <th>{{ __('messages.Reservation Date Time') }}</th>
                    <th>{{ __('messages.Available To') }}</th>
                    <th>{{ __('messages.Available For') }}</th>
                    <th>{{ __('messages.Follow Up Reservation') }}</th>
                    <th>{{ __('messages.Actions') }}</th>
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
                    <input type="hidden" name="follow_up_id" id="follow_up_id">
                    <div class="modal-body">
                        <div class="row mb-0" id="sec-1">
                            <div class="col-md-12">
                                <label for="available_to"
                                    class="form-label">{{ __('messages.Follow Up Available To') }}</label>
                                <input type="date" class="form-control" id="available_to" name="available_to"
                                    value="">
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
                    <input type="hidden" name="child_id" id="child_id" value="">
                    <input type="hidden" name="is_follow_up" id="is_follow_up" value="1">
                    <div class="modal-body p-4">
                        <div class="row" id="sec-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <h4 class="header-title mt-5 mt-sm-3">{{ __('messages.Type') }}</h4>
                                    <div class="mt-3">
                                        <select class="form-select" name="type" id="type2">
                                            <option value="examanation">{{ __('messages.Examanation') }}</option>
                                            <option value="vaccination">{{ __('messages.Vaccination') }}</option>
                                            <option value="examanation,vaccination">
                                                {{ __('messages.Examanation & Vaccination') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="sec-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="mt-3">
                                        @foreach (\App\Models\Vaccination::get() as $vaccine)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1"
                                                    value="{{ $vaccine->id }}" name="vaccin_id[]">
                                                <label class="form-check-label"
                                                    for="customCheck1">{{ $vaccine->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="sec-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="patient_comment"
                                        class="form-label">{{ __('messages.Patient Comment') }}</label>
                                    <textarea id="patient_comment" name="patient_comment" class="form-control"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="secretarial_comment"
                                        class="form-label">{{ __('messages.Secretarial Comment') }}</label>
                                    <textarea id="secretarial_comment" name="secretarial_comment" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

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
                        <button type="submit" class="btn btn-success waves-effect waves-light" id="saveBtn2"
                            value="create">{{ __('messages.Save') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div><!-- /.modal -->
@endsection


@section('scripts')
    <script type="text/javascript">
        $(function() {
            $('#page-tage').html('{{ __('messages.Follow Up') }}');

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
                ajax: "{{ route('available.followUp') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'child',
                        name: 'child'
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
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'reservation_date',
                        name: 'reservation_date'
                    },
                    {
                        data: 'available_to',
                        name: 'available_to'
                    },
                    {
                        data: 'available_for',
                        name: 'available_for'
                    },
                    {
                        data: 'follow_up_reservation',
                        name: 'follow_up_reservation'
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
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.editAvailableDate', function() {
                var follow_up_id = $(this).data('id');
                $.get("{{ route('follow-up.index') }}" + '/' + follow_up_id + '/edit',

                    function(data) {
                        $('#modelHeading').html("{{ __('messages.Edit') }}");
                        $('#saveBtn').val("edit-follow-up");
                        $('#ajaxModel').modal('show');
                        $('#follow_up_id').val(data.id);
                        $('#available_to').val(data.available_to);
                    })
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
                    url: "{{ route('follow-up.store') }}",
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
            $('body').on('click', '.deleteFollowUp', function() {

                var follow_up_id = $(this).data("id");
                if (confirm("{{ __('messages.Are You sure want to delete !') }}")) {
                    // event.preventDefault();
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('follow-up.store') }}" + '/' + follow_up_id,
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
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.createFollowUp', function() {
                var follow_up_id = $(this).data('id');
                // console.log(follow_up_id);
                $.get("{{ route('follow-up.index') }}" + '/' + follow_up_id + '/edit',

                    function(data) {
                        $('#modelHeading2').html("{{ __('messages.save') }}");
                        $('#saveBtn').val("edit-follow-up");
                        $('#child_id').val(data.child_id);
                        $('#ajaxModel2').modal('show');
                    })
            });

            /*------------------------------------------
            --------------------------------------------
            Create follow up Code
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn2').click(function(e) {
                console.log("scscsc");
                e.preventDefault();
                $(this).html("{{ __('messages.Sending..') }}");

                $.ajax({
                    data: $('#adminForm2').serialize(),
                    url: "{{ route('reservation.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#adminForm2').trigger("reset");
                        $('#saveBtn2').html('{{ __('messages.Save') }}');
                        if (data.success == true) {
                            var url = "{{ route('visit.current') }}"
                            location.href = url;
                        }
                        // $('#ajaxModel').modal('hide');
                        // table.draw();

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

        });
    </script>
@endsection
