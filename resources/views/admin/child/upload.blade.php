   <!-- Modal -->
   <div id="show-upload" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
        <form action="{{ route('child.upload',[$child->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body p-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="child_tests" class="form-label">{{ __('messages.Uploade Child History') }}</label>
                        <input type="file" id="child_tests" name="child_tests"  class="form-control">
                    </div>
                </div>
            </div>
            </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-light">Upload</button>
        </div>
        </form>
      </div>
    </div>
  </div>