<!-- Modal -->
<div id="send-notification" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">{{__('messages.Send Notification')}}</h4>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
        <form action="{{ route('notify.sendUser',[$user->id])}}" method="POST">
            @csrf
            <input type="hidden" id="type" name="type" value="mine">

            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-12">
            <div class="mb-3">
                <label for="title" class="form-label">{{__('messages.Title')}}</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{__('messages.Description')}}</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.Save') }}</button>

            </div>
        </form>
      </div>
    </div>
  </div>