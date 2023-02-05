        <!-- sample modal content -->

        <div id="updateChild" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <form action="{{ route('child.updateProfile',["id" => $child->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="modal-body p-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('messages.Name') }}</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$child->name}}" >
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="birthdate" class="form-label">{{ __('messages.Birthdate') }}</label>
                                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{$child->birthdate}}" max={{ now()->toDateString('Y-m-d') }}>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">{{ __('messages.Gender') }}</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="">{{__('messages.Gender')}}</option>

                                                    <option value="male" @if($child->gender == "male")selected @endif  >{{__('messages.Male')}}</option>
                                                    <option value="female" @if($child->gender == "female")selected @endif >{{__('messages.Female')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="hospital" class="form-label">{{ __('messages.Hospital') }}</label>
                                            <input type="text" id="hospital" name="hospital" class="form-control" value="{{$child->hospital}}">
                                        </div>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">{{ __('messages.Image') }}</label>
                                            <input type="file" id="image" name="image"  class="form-control">
                                        </div>
                                    </div>
                            
                                
                                </div>
                                
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success waves-effect waves-light" id="saveBtn" value="create">{{ __('messages.Save') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div><!-- /.modal -->

 