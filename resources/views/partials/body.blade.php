<a class="btn btn-success" href="javascript:void(0)" id="createNewArea"> {{__('messages.Create New Area')}}</a>

<div class="dataTables_wrapper dt-bootstrap5 no-footer">
    <table class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
        <thead>
        <tr>
            <th>{{__('messages.No')}}</th>
            <th>{{__('messages.Name')}}</th>
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
                <input type="hidden" name="area_id" id="area_id">
                <div class="modal-body p-4 ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name_en" class="form-label">{{ __('messages.Name En') }}</label>
                                <input type="text" class="form-control" id="name_en" name="name_en" value="" >

                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name_ar" class="form-label">{{ __('messages.Name Ar') }}</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar" value="">

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
